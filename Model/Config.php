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
namespace Juashyam\LogViewer\Model;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\RequestInterface as RequestInterfaceAlias;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\UrlInterface;

/**
 * Class Config
 * @package Juashyam\LogViewer\Model
 */
class Config
{
    const QUERY_PARAM = 'file';

    /**
     * @var DirectoryList
     */
    private $directoryList;

    /**
     * @var File
     */
    private $driverFile;

    /**
     * @var RequestInterfaceAlias
     */
    private $request;

    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * Config constructor.
     * @param DirectoryList $directoryList
     * @param File $driverFile
     * @param RequestInterfaceAlias $request
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        DirectoryList $directoryList,
        File $driverFile,
        RequestInterfaceAlias $request,
        UrlInterface $urlBuilder
    ) {
        $this->directoryList = $directoryList;
        $this->driverFile = $driverFile;
        $this->request = $request;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Query parameter to view file
     *
     * @return string
     */
    public function getQueryParameter()
    {
        return self::QUERY_PARAM;
    }

    /**
     * @return DirectoryList
     */
    public function getDirectoyList()
    {
        return $this->directoryList;
    }

    /**
     * @return File
     */
    public function getDriverFile()
    {
        return $this->driverFile;
    }

    /**
     * Base directory path which contains system log and reports
     *
     * @return mixed
     * @throws FileSystemException
     */
    public function getBaseDirectoryPath()
    {
        return $this->directoryList->getPath(DirectoryList::VAR_DIR) . DIRECTORY_SEPARATOR;
    }

    /**
     * URL to download a file
     *
     * @param $filename
     * @return string
     */
    public function getFileDownloadUrl($filename)
    {
        return $this->urlBuilder->getUrl('lviewer/download/index') . self::QUERY_PARAM . DIRECTORY_SEPARATOR
            . $filename;
    }

    /**
     * Hash of a file which is currently being viewed
     *
     * @return mixed
     */
    public function getCurrentFileHash()
    {
        return $this->request->getParam(self::QUERY_PARAM);
    }

    /**
     * File name which is currently being viewed
     *
     * @return bool|string|null
     */
    public function getCurrentFileName()
    {
        $fileName = null;

        if ($encodedFileName = $this->getCurrentFileHash()) {
            $fileName = base64_decode($encodedFileName);
        }

        return $fileName;
    }
}
