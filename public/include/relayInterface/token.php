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

	class token {
		//創建Token與存檔
		public function saveToken($uid,$conn){			
			$thisAction = new \basisObject\creatToken;
			$code = $thisAction->saveToken($conn, $uid);
			//釋放物件
			$thisAction = null;
			return $code;
		}	
	}
?>