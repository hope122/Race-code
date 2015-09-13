<?php
	include('include/System_APService/System_APService.php');
	
	use System_APService\clsSystem;
	$VTs = new clsSystem;
	$VTs->initialization();
	//執行查詢
	$strSQL = "select * from account";
	$data = $VTs->QueryData($strSQL);
	
	//資料轉換
	$data = $VTs->Data2Array($data);
	//debug，印出資料用
	$VTs->debug($data);
	
	//日期轉換
	$date = date("Y-m-d");
	echo $VTs->DateTime("ADyyyyMMdd_RCyyyMMdd",$date);
	
	/*
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
	*/
?>