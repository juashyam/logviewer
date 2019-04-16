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
namespace Juashyam\LogViewer\Block\Adminhtml\Log;

use Juashyam\LogViewer\Block\Adminhtml\AbstractTree as AbstractTreeAlias;
use Magento\Framework\Exception\FileSystemException;

/**
 * Class Tree
 * @package Juashyam\LogViewer\Block\Adminhtml\Log
 */
class Tree extends AbstractTreeAlias
{
    /**
     * System log directory
     */
    const LOG = 'log';

    /**
     * Placeholder name for the root node which holds all the files and directories related to system log in a tree
     */
    const ROOT = "System Log";

    /**
     * URL to view system log file
     *
     * @return string
     */
    public function getFileViewUrl()
    {
        return $this->getUrl('lviewer/log/view/');
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
     * Get Full directory path to the system log
     *
     * @return mixed|string
     * @throws FileSystemException
     */
    public function getFullDirectoryPath()
    {
        return $this->config->getBaseDirectoryPath() . self::LOG . DIRECTORY_SEPARATOR;
    }
}