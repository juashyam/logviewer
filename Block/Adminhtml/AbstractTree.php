<?php
/**
 * This file is part of the juashyam/logviewer library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Shyam Kumar <kumar.30.shyam@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 * @link https://packagist.org/packages/juashyam/logviewer Packagist
 * @link https://github.com/juashyam/logviewer GitHub
 */
namespace Juashyam\LogViewer\Block\Adminhtml;

use Magento\Framework\Exception\FileSystemException as FileSystemExceptionAlias;

/**
 * Class AbstractTree
 *
 * Abstract class to generate tree for system logs / reports
 * @package Juashyam\LogViewer\Block\Adminhtml
 */
abstract class AbstractTree extends LogViewer
{
    /**
     * Placeholder ID for the root node
     */
    const ROOT_ID = "juashyam";

    /**
     * Absolute directory path to the file
     *
     * @return mixed
     */
    abstract public function getFullDirectoryPath();

    /**
     * URL to view file
     *
     * @return mixed
     */
    abstract public function getFileViewUrl();

    /**
     * Placeholder name for the root node
     *
     * @return mixed
     */
    abstract public function getRootName();

    /**
     * JSON data for the tree
     *
     * @return array|string[]
     * @throws FileSystemExceptionAlias
     */
    public function getTreeJson()
    {
        $result = null;

        // Absolute directory path to the system log/report
        $directoryPath = $this->getFullDirectoryPath();

        if ($this->config->getDriverFile()->isExists($directoryPath)) {
            /**
             * Read all the files and directories recursively inside the absolute directory path, and assign them as
             * children to the root node to hold
             */
            if ($files = $this->readDirectoryRecursively($directoryPath)) {
                $data = [
                    [
                        "text"      => $this->getRootName(),
                        "id"        => "juashyam",
                        "cls"       => "folder active-category",
                        "allowDrop" => false,
                        "allowDrag" => false,
                        "expanded"  => true,
                        "directory" => false,
                        "children"  => $files
                    ]
                ];

                $result = $this->serializer->serialize($data);
            }
        }

        return $result;
    }

    /**
     * Read directory recursively
     *
     * @param string $path
     * @return string[]
     * @throws FileSystemException
     */
    public function readDirectoryRecursively($path = null)
    {
        $result = [];

        try {
            $flag = '#.DS_Store#';

            $files = new \FilesystemIterator($path);
            foreach ($files as $file) {
                // Exclude files matching to the flag
                if (preg_match($flag, $file)) {
                    continue;
                }

                // Relative path to the system log/report
                $relativePath = str_replace($this->config->getBaseDirectoryPath(), '', $file->getPathname());

                // Convert relative path into the hash
                $pathName = base64_encode($relativePath);

                $fileData = [
                    "text"      => $file->getFilename(),
                    "id"        => $pathName,
                    "cls"       => "folder active-category",
                    "allowDrop" => false,
                    "allowDrag" => false,
                    "expanded"  => false,
                    "directory" => false
                ];

                if ($file->isDir()) {
                    $fileData["directory"] = true;
                    $fileData["children"] = $this->readDirectoryRecursively($file->getPathname());
                }

                $result[] = $fileData;
            }
        } catch (\Exception $e) {
            throw new FileSystemException(new \Magento\Framework\Phrase($e->getMessage()), $e);
        }

        return $result;
    }

    /**
     * Return current file's hash
     *
     * @return mixed|string
     */
    public function getCurrentFileId()
    {
        return $this->config->getCurrentFileHash() ?? self::ROOT_ID;
    }
}
