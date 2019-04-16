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
namespace Juashyam\LogViewer\Controller\Adminhtml\Download;

use Juashyam\LogViewer\Model\Config;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\App\ResponseInterface as ResponseInterfaceAlias;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem\DirectoryList;

/**
 * Class Index
 * @package Juashyam\LogViewer\Controller\Adminhtml\Download
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * @var FileFactory
     */
    private $downloader;

    /**
     * @var DirectoryList
     */
    private $directory;

    /**
     * @var Config
     */
    private $config;

    /**
     * Add category constructor
     *
     * @param Context $context
     * @param FileFactory $fileFactory
     * @param DirectoryList $directory
     * @param Config $config
     */
    public function __construct(
        Context $context,
        FileFactory $fileFactory,
        DirectoryList $directory,
        Config $config
    ) {
        $this->downloader = $fileFactory;
        $this->directory = $directory;
        $this->config = $config;
        parent::__construct($context);
    }

    /**
     * Add new category form
     *
     * @return ResponseInterfaceAlias
     * @throws FileSystemException
     */
    public function execute()
    {
        if ($encodedFileName = $this->_request->getParam($this->config->getQueryParameter())) {
            $fileName = base64_decode($encodedFileName);
            $file = $this->config->getBaseDirectoryPath() . $fileName;

            return $this->downloader->create(
                $fileName,
                file_get_contents($file)
            );
        }
    }
}
