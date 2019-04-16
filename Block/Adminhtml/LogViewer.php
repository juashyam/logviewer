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

use Juashyam\LogViewer\Model\Config;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Serialize\SerializerInterface;

/**
 * Class LogViewer
 * @package Juashyam\LogViewer\Block\Adminhtml
 */
class LogViewer extends \Magento\Backend\Block\Template
{
    /**
     * @var Config
     */
    public $config;

    /**
     * @var SerializerInterface
     */
    public $serializer;

    /**
     * AbstractTree constructor.
     * @param Context $context
     * @param SerializerInterface $serializer
     * @param Config $config
     * @param array $data
     */
    public function __construct(
        Context $context,
        SerializerInterface $serializer,
        Config $config,
        array $data = []
    ) {
        $this->config = $config;
        $this->serializer = $serializer;
        parent::__construct($context, $data);
    }
}
