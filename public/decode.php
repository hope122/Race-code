<?php
	//跨網域請求
	header("Access-Control-Allow-Origin: *");
	include("include/config.php");
	use modelUI\basisUI;
	
	$basis = new basisUI;
	$conn = $basis->connDB();
	
	$strSQL = "select access_token from token where login_code = '".$_POST["requestTokenCode"]."'";
	$data = $basis->Data2Array($conn,$strSQL);
	//$basis->debug($data[0]);
	echo json_encode($data[0]);
?>