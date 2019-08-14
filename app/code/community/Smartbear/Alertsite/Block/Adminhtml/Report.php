<?php
/**
 * Smartbear_Alertsite_Block_Adminhtml_Notifications
 * Notifications block. Displays a note at the top of adminhtml pages.
 *
 * @category
 * @package     Smartbear_Alertsite
 */
class Smartbear_Alertsite_Block_Adminhtml_Report extends Mage_Adminhtml_Block_Template
{

    public function getConfigJson()
    {
        $options = new stdClass();

        /** @var $api Smartbear_Alertsite_Model_Alertsiteapi */
        $api = Mage::getSingleton('alertsite/alertsiteapi');
        $api->setRequestIp(Mage::helper('core/http')->getRemoteAddr());
        $api->login();

        $options->customer = intval(str_replace('C', '', $api->getCustomerId())) - 10000;
        $options->session = $api->getSessionId();

        //Get the time zone and offset
        $time_zone = Mage::app()->getStore()->getConfig('general/locale/timezone');
        $timeoffset = Mage::getModel('core/date')->calculateOffset($time_zone)/60/60;

        $options->timezone = $timeoffset;
        $options->user = $api->getUsername();

        return json_encode($options);
    }

    public function getDejaclickDeviceId()
    {
        /** @var $api Smartbear_Alertsite_Model_Alertsiteapi */
        $api = Mage::getSingleton('alertsite/alertsiteapi');
        return $api->getDejaclickDeviceId();
    }

    public function getSiteDeviceId()
    {
        /** @var $api Smartbear_Alertsite_Model_Alertsiteapi */
        $api = Mage::getSingleton('alertsite/alertsiteapi');
        return $api->getDeviceId();
    }

}