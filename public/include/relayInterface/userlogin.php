<?php
	namespace relayInterface;
	//取得檔案名稱
	$thisRelayName = pathinfo(__FILE__, PATHINFO_FILENAME);
	//取得這個CLASS會使用到的類別
	$modelPath = glob(dirname(__DIR__)."\\basisObject\\".$thisRelayName."\\*.php");
	//載入
	if(!empty($modelPath)){
		foreach($modelPath as $content){
			//print_r($content);
			include($content);
		}
	}

	class userlogin {
		//啟用LOGIN
		public function processLogin($conn){
			//設定資訊陣列
			$uidInfo = array();
			//資訊狀態
			$uidInfo["status"] = false;
			
			if(!empty($_POST)){
				$userAc = $_POST["userAc"];
				$userPw = $_POST["userPw"];
				
				//使用基礎物件
				$basis = new basis;
				$strSQL = "select * from account where userAc = '".$userAc."' and userPw = md5('".$userPw."')";
				$data = $basis->Data2Array($conn,$strSQL);
				
				if(!empty($data)){
					$uid = $data[0]["uid"];
					//產生Token並存到資料表中，會回傳requestTokenCode，以供後續Oauth使用
					$token = new token;
					$requestTokenCode = $token->saveToken($uid,$conn);
					
					//紀錄SESSION
					$_SESSION["uid"] = $uid;
					$_SESSION["name"] = $data[0]["userName"];
					$_SESSION["mail"] = $data[0]["userMail"];
					$_SESSION["requestTokenCode"] = $requestTokenCode;
					
					$uidInfo["requestTokenCode"] = $requestTokenCode;
					$uidInfo["status"] = true;
				}				
			}			
			//紀錄LOG
			$log = new log;
			$log->saveLog('loginAction','system','creatToken',$uidInfo["status"]);
			//釋放物件
			$log = null;
			$basis = null;
			
			return json_encode($uidInfo);
		}	
	}
?>