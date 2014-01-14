<?php

/**
 * Log output block
 *
 * @author Fabrizio Branca
 * @since  2013-01-22
 */
class Aoe_LogViewer_Block_Adminhtml_Logoutput extends Mage_Adminhtml_Block_Template
{
    /**
     * Get relevant path to template
     *
     * @return string
     */
    public function getTemplate()
    {
        $command = $this->getCommand();
        if ($command instanceof Aoe_LogViewer_Model_Command_Abstract) {
            return parent::getTemplate();
        } else {
            return '';
        }
    }
}
