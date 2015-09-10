<?php
	//跨網域請求
	header("Access-Control-Allow-Origin: *");
	include("include/config.php");
	use modelUI\basisUI;
	
	$basis = new basisUI;
	$conn = $basis->connDB();
	
	$strSQL = "select b.uid,b.userName,b.userMail,login_date from token a ";
	$strSQL .= "left join account b on a.uid = b.uid ";
	$strSQL .= " where a.access_token = '".$_POST["access_token"]."'";
	$data = $basis->Data2Array($conn,$strSQL);
	//$basis->debug($data[0]);
	echo json_encode($data[0]);
?>