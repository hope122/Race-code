<?php
	include('include/System_APService/System_APService.php');
	
	use System_APService\clsSystem;
	$VTc = new clsSystem;
	$VTc->initialization();
	$VTs = $VTc->GetVariablesDefine("SystemToolsService");
	
	$strIniFile = __DIR__ . '\\include\\connDB.ini';
	$sSection = 'connDB';
	
	echo $VTs->GetINIInfo($strIniFile,$sSection,'servername','');
?>