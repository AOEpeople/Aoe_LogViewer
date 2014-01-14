<?php

class Aoe_LogViewer_Helper_Data extends Mage_Core_Helper_Abstract
{
    const REGISTRY_CURRENT_LOG_ID = 'Aoe_LogViewer_CurrentLogId';
    const REGISTRY_CURRENT_COMMAND_ID = 'Aoe_LogViewer_CurrentCommandId';

    public function getCurrentLogId()
    {
        return Mage::registry(self::REGISTRY_CURRENT_LOG_ID);
    }

    public function setCurrentLogId($id)
    {
        Mage::unregister(self::REGISTRY_CURRENT_LOG_ID);
        Mage::register(self::REGISTRY_CURRENT_LOG_ID, $id);
    }

    public function getCurrentCommandId()
    {
        return Mage::registry(self::REGISTRY_CURRENT_COMMAND_ID);
    }

    public function setCurrentCommandId($id)
    {
        Mage::unregister(self::REGISTRY_CURRENT_COMMAND_ID);
        Mage::register(self::REGISTRY_CURRENT_COMMAND_ID, $id);
    }

    /**
     * @param bool $throwException
     *
     * @return Aoe_LogViewer_Model_Command_Abstract|null
     */
    public function getCurrentCommand($throwException = true)
    {
        $logId = $this->getCurrentLogId();
        /* @var $log Aoe_LogViewer_Model_Log_Abstract */
        $log = Mage::getModel('aoe_logviewer/log_collection')->getItemById($logId);
        if (is_null($log)) {
            if ($throwException) {
                Mage::throwException(sprintf('Could not find log with id "%s"', $logId));
            } else {
                Mage::log(sprintf('Could not find log with id "%s"', $logId), Zend_Log::ERR);
                return null;
            }
        }

        // get command
        $commandId = $this->getCurrentCommandId();
        /* @var $command Aoe_LogViewer_Model_Command_Abstract */
        $command = $log->getCommandCollection()->getItemById($commandId);
        if (is_null($command)) {
            if ($throwException) {
                Mage::throwException(sprintf('Could not find log command with id "%1$s/%2$s"', $logId, $commandId));
            } else {
                Mage::log(sprintf('Could not find log command with id "%1$s/%2$s"', $logId, $commandId), Zend_Log::ERR);
                return null;
            }
        }

        return $command;
    }
}
