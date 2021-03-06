<?php
/**
 * Copyright © 2015 Cedcommerce. All rights reserved.
 */
namespace Ced\DevTool\Model;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
class Controllercall  implements ObserverInterface
{
    protected $_devtoolData;
    protected $_registry = null;
    public $models = array();
	public $collections = array();
    public $actions = array();
	
    public function __construct (
        \Ced\DevTool\Helper\Data $devtoolData,
        \Magento\Framework\Registry $registry
    ) {
		
       $this->_devtoolData = $devtoolData;
        $this->_registry = $registry;
    }

	/**
     * bindCustomerLogin
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $action = $observer->getControllerAction();
        $actionArray = array();
        $actionArray['Controller Name'] = $action->getRequest()->getControllerName();
        $actionArray['Action Name'] = $action->getRequest()->getActionName();
        $actionArray['Module Name'] = $action->getRequest()->getRouteName();
        $actionArray['Path Info'] = $action->getRequest()->getPathInfo();
        $this->actions[] = $actionArray;
        $this->_devtoolData->addDevToolData($this->_devtoolData->_requestKey , $this->actions);
    }
}