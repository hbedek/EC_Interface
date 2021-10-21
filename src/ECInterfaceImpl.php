<?php


class ECInterfaceImpl
{
    protected $version = 3.0;
    public static function isPluginInstalled()
    {
        $filename = '/var/www/html/plugins/ElectricityCost/core/class/Utils/ECInterface.php';
        if (file_exists($filename)) {
            return true;
        } else {
            return false;
        }
    }
    public function getConfigEqHtml()
    {
        if ($this->isPluginInstalled()) {
            include_once '/var/www/html/plugins/ElectricityCost/core/class/Utils/ECInterface.php';
            $html = ECInterface::getConfigEqHtml();
            return $html;
        } else {
            return '<label>Le plugin Electricity Cost n\'est pas installé sur votre Jeedom</label>';
        }
    }
    public function createECCmds($context, $needRefreshCmd)
    {
        if ($this->isPluginInstalled()) {
            include_once '/var/www/html/plugins/ElectricityCost/core/class/Utils/ECInterface.php';
            ECInterface::createECCmds($context, $needRefreshCmd);
        }
    }

    public function refreshECCmds($context)
    {
        if ($this->isPluginInstalled() && $this->verifyVersionCompatibility()) {
            include_once '/var/www/html/plugins/ElectricityCost/core/class/Utils/ECInterface.php';
            ECInterface::refreshECCmds($context);
        }
    }
    public function isCostAvailable($context)
    {
        if ($this->isPluginInstalled()) {
            include_once '/var/www/html/plugins/ElectricityCost/core/class/Utils/ECInterface.php';
            return ECInterface::isCostAvailable($context);
        }
    }

    public function verifyVersionCompatibility()
    {
        if (ECInterfaceImpl::isPluginInstalled() == true) {
            include_once '/var/www/html/plugins/ElectricityCost/core/class/Utils/ECInterface.php';
            $elecAPI = new ECInterface();
            if ($elecAPI->isVersionCompatible($this->version)) {
                return true;
            } else {
                log::add('ECInterface', 'error', 'La version de ce plugin n\'est pas compatible avec la version de Electricity Cost. Vérifiez que les deux plugins soient à jour');
            }
        }
    }

    public function updateConsumptionForPower($context, $powerCmdName, $consumptionCmdName, $powerUnite)
    {
        if ($this->isPluginInstalled() && $this->verifyVersionCompatibility()) {
            ECInterface::updateConsumptionForPower($context, $powerCmdName, $consumptionCmdName, $powerUnite);
        }
    }

    public function updateTotalPriceForConsumption($context, $consumptionCdmName, $totalCostCmdName)
    {
        if ($this->isPluginInstalled() && $this->verifyVersionCompatibility()) {
            ECInterface::updateTotalPriceForConsumption($context, $consumptionCdmName, $totalCostCmdName);
        }
    }

    public function resetHistoryForContext($context)
    {
        if ($this->isPluginInstalled() && $this->verifyVersionCompatibility()) {
            ECInterface::resetHistoryForContext($context);
        }
    }

    public function isHCContract($context)
    {
        if ($this->isPluginInstalled() && $this->verifyVersionCompatibility()) {
            return ECInterface::isHCContract($context);
        }
        return false;
    }

    public function refreshCronEqs($context) {
        if ($this->isPluginInstalled() && $this->verifyVersionCompatibility()) {
            ElectricityCost::refreshCronEqs($context);
        }
    }
}
