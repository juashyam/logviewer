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

use Magento\Framework\Exception\FileSystemException;

/**
 * Class AbstractView
 * @package Juashyam\LogViewer\Block\Adminhtml
 */
class Content extends LogViewer
{
    /**
     * Get log file content
     *
     * @return string
     * @throws FileSystemException
     */
    public function getFileContent()
    {
        $result = null;

        if ($fileHash = $this->_request->getParam($this->config->getQueryParameter())) {
            $contents = '';
            $result['download'] = $this->config->getFileDownloadUrl($fileHash);

            $pathLogfile = $this->config->getBaseDirectoryPath() . $this->config->getCurrentFileName();

            //tail the length file content
            $lengthBefore = 500000;

            try {
                $handle = fopen($pathLogfile, 'r');
                fseek($handle, -$lengthBefore, SEEK_END);
                if (!$handle) {
                    return "Log file is not readable or does not exist at this moment. File path is "
                        . $pathLogfile;
                }

                if (filesize($pathLogfile) > 0) {
                    $contents = fread($handle, filesize($pathLogfile));
                    if ($contents === false) {
                        return "Log file is not readable or does not exist at this moment. File path is "
                            . $pathLogfile;
                    }
                    fclose($handle);
                }
            } catch (\Exception $e) {
                return $e->getMessage() . $pathLogfile;
            }

            $result['content'] = nl2br($this->_escaper->escapeHtml($contents));
        }

        return $result;
    }
}
