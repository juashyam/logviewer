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
namespace Juashyam\LogViewer\Block\Adminhtml\Report;

use Juashyam\LogViewer\Block\Adminhtml\AbstractTree as AbstractTreeAlias;
use Magento\Framework\Exception\FileSystemException;

/**
 * Class Tree
 * @package Juashyam\LogViewer\Block\Adminhtml\Report
 */
class Tree extends AbstractTreeAlias
{
    /**
     * System report directory
     */
    const REPORT = 'report';

    /**
     * Placeholder name for the root node which holds all the files and directories related to system report in a tree
     */
    const ROOT = "System Report";

    /**
     * URL to view system report file
     *
     * @return string
     */
    public function getFileViewUrl()
    {
        return $this->getUrl('lviewer/report/view/');
    }

    /**
     * Placeholder name for the root node
     *
     * @return mixed|string
     */
    public function getRootName()
    {
        return self::ROOT;
    }

    /**
     * Get Full directory path to the system report
     *
     * @return mixed|string
     * @throws FileSystemException
     */
    public function getFullDirectoryPath()
    {
        return $this->config->getBaseDirectoryPath() . self::REPORT . DIRECTORY_SEPARATOR;
    }
}
