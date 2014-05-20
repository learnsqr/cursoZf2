<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Developer;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module extends \Zend\View\Helper\AbstractHelper
{   

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getViewHelperConfig()
    {
    	return array('services' => array('markdown' => $this));
    }
    
	public function __invoke($string = null)
    {
        if (!class_exists('Michelf\Markdown')) require_once __DIR__ . '/vendor/php-markdown/Michelf/Markdown.inc.php';
        return \Michelf\Markdown::defaultTransform($string);
    }
}
