# EC_Interface
Interface permettant de se connecter à ElectricityCost

L'intégration de l'interface se fait via composer:

`"require": {
        "hbedek/ec-interface": "dev-main"
    },`


## Fichier plugin.php

Ici il y a plusieurs modifications à faire.


Pour afficher la configuration nécessaire à Electricity Cost:
`<legend><i class="fas fa-cogs"></i> {{Calculer le coût de l'équipement}}</legend>
<label>{{Nécessite le plugin Electricity Cost}}</label>
<?php
	echo Plugin::getConfigEqHtml();
?>`

`Plugin::getConfigEqHtml()` doit renvoyer vers la fonction :

`public static function isPluginInstalled()
{
    return ECInterfaceImpl::isPluginInstalled();
}`


A rajouter au chargement des JS:
`<?php include_file('desktop', 'LightGroup', 'js', 'LightGroup'); ?>
<?php
if (Plugin::isPluginInstalled()) {
	include_file('desktop', 'ECConfig', 'js', 'ElectricityCost');
}
?>
<!-- Inclusion du fichier javascript du core - NE PAS MODIFIER NI SUPPRIMER -->
<?php include_file('core', 'plugin.template', 'js'); ?>`

`Plugin::isPluginInstalled()` doit renvoyer vers la fonction: 
`public static function getConfigEqHtml()
   {
      $elecApi = new ECInterfaceImpl();
      return $elecApi->getConfigEqHtml();
   }`

## Fichier plugin.class.php

### Création des commandes
A la création des commandes, il faut appeler:
`$elecApi = new ECInterfaceImpl();
$elecApi->createECCmds($this, $needRefreshCmd);`
Avec `$this` le contexte de la classe plugin.class.php
Avec `$needRefreshCmd` un booléen pour créer ou non une commande refresh.

Cette fonction va créer toutes les commandes nécessaire à Electricity Cost

### Rafraîchissement 
