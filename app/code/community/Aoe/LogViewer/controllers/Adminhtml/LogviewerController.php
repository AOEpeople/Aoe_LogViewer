<?php

/**
 * Logviewer controller
 *
 * @author Fabrizio Branca
 * @since  2013-01-19
 */
class Aoe_LogViewer_Adminhtml_LogviewerController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $logId = $this->getRequest()->get('log');
        $commandId = $this->getRequest()->get('command');

        if ($this->getRequest()->isPost()) {
            $this->_redirect(
                '*/*/*',
                array(
                    'log'     => $logId,
                    'command' => $commandId
                )
            );
        } else {
            /** @var $helper Aoe_LogViewer_Helper_Data */
            $helper = Mage::helper('aoe_logviewer');
            $helper->setCurrentLogId($logId);
            $helper->setCurrentCommandId($commandId);

            $this->loadLayout();
            $this->renderLayout();
        }
    }
}
