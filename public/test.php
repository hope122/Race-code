<?php
	include('include/System_APService/System_APService.php');
	
	use System_APService\clsSystem;
	$VTc = new clsSystem;
	$VTc->initialization();
	$VTs = $VTc->GetVariablesDefine("SystemToolsService");
	$DBc = $VTc->GetVariablesDefine("SystemDBService");
	
	//取INI資料
	$strIniFile = __DIR__ . '\\include\\connDB.ini';
	$sSection = 'connDB';
	//顯示結果
	echo $VTs->GetINIInfo($strIniFile,$sSection,'servername','');
	
	//執行查詢
	$strSQL = "select * from account";
	$data = $DBc->QueryData($strSQL);
	//資料轉換
	$data = $VTs->Data2Array($data);
	//debug，印出資料用
	$VTs->debug($data);
	
?>