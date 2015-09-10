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

	class log {
		//存檔
		public function saveLog($action,$executor,$execute_content=null,$execute=1){
			$execute = ($execute)?1:0;
			$logAction = new \basisObject\creatLog;
			$logAction->saveLog($action,$executor,$execute_content,$execute);
			//釋放物件
			$logAction = null;
		}	
		//產生LOG SQL
		public function logSQL($action,$executor,$execute_content=null,$execute=1){
			$execute = ($execute)?1:0;
			$logAction = new \basisObject\creatLog;
			$saveLogs = $logAction->saveLogSQL($action,$executor,$execute_content,$execute);
			//釋放物件
			$logAction = null;
			return $saveLogs;
		}	
	}
?>