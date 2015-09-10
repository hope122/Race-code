<?php		
	namespace basisObject;
	//創建LOG
	class creatLog {
		public function saveLog($adtion, $executor, $execute_content, $execute_status){
			
			$strSQL = "insert into systemlog(action,executor,execute_content,request,execute_status) ";
			$strSQL .= "values('".$adtion."','".$executor."','".$execute_content."','".$_SERVER["REMOTE_ADDR"]."','".$execute_status."')";
			//echo $strSQL;
			$basis = new \relayInterface\basis;
			$conn = $basis->connDB();
			$result = $basis->execute($conn,$strSQL);
			
			//關閉資料庫
			$basis->close($conn);
		}
		public function saveLogSQL($adtion, $executor, $execute_content, $execute_status){
			$strSQL = "insert into systemlog(action,executor,execute_content,request,execute_status) ";
			$strSQL .= "values('".$adtion."','".$executor."','".$execute_content."','".$_SERVER["REMOTE_ADDR"]."','".$execute_status."')";
			return $strSQL;
		}
	}
?>