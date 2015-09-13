<?php		
	namespace basisObject;
	//創建Token與其相關
	class creatToken {
		//創建請求access_Token的Code
		private function requestTokenCode($uid){
			$code = md5($uid.time().date("Y-m-d H:i:s"));
			return $code;
		}
		//創建請求access_Token
		private function token($uid){
			$tokenStr = md5($uid.time());
			return $tokenStr;
		}
		public function saveToken($conn, $uid){
			$basis = new \relayInterface\basis;
			$strSQL = "select uid from token where uid='".$uid."'";
			$data= $basis->Data2Array($conn,$strSQL);
			
			//取得Token
			$token = $this->token($uid);
			//取得登入的CODE
			$log_code = $this->requestTokenCode($uid);
			
			if(empty($data)){
				$strSQL = "insert into token(uid,login_code,access_token,login_from) values('".$uid."','".$log_code."','".$token."','".$_SERVER["REMOTE_ADDR"]."')";
			}else{
				$strSQL = "update token set login_code='".$log_code."',access_token='".$token."',login_from='".$_SERVER["REMOTE_ADDR"]."',login_date='".date("Y-m-d H:i:s")."' where uid='".$uid."'";
			}
			$basis->execute($conn,$strSQL);
			return $log_code;
		}
	}
?>