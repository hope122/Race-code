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

	class basis {
		
		//資料庫連線
		public function connDB($database=null){
			//DB設定檔案路徑
			$dbIniPath = dirname(__DIR__);
			$fileName = 'connDB';
			
			//先取得DB設定檔案
			$readIni = new \basisObject\readFileContent;
			
			//取得設定檔案內容
			$connDBIni = $readIni->readIni($dbIniPath,$fileName);
			$connDBIni = $connDBIni["connDB"];
			
			//如果沒有傳入，就用預設值
			if(!$database){
				$database = $connDBIni["defaultDB"];
			}
			
			//建立連線
			$connAction = new \basisObject\creatConnDB;
			$conn = $connAction->connDB($connDBIni["servername"],$connDBIni["user"],$connDBIni["password"],$database);
			
			//釋放物件
			$connAction = null;
			
			return $conn;
		}
		
		//執行結果並回傳陣列
		public function Data2Array($conn,$strSQL, $kind=0, $pk=NULL){
			$execute = new \basisObject\executeSQL;
			$data = $execute->Data2Array($conn, $strSQL, $kind=0, $pk=NULL);
			
			//釋放物件
			$execute = null;
			return $data;
			
		}
		//單純執行SQL(用於單純INSERT、UPDATE、DELETE等)
		public function execute($conn,$strSQL){
			$execute = new \basisObject\executeSQL;
			if(!$execute->execute($conn, $strSQL)){
				//錯誤紀錄
				$basis = new \relayInterface\basis;
				$log = new \relayInterface\log;
				$logSQL = $log->logSQL('sqlError','system',htmlspecialchars($strSQL,ENT_QUOTES),0);
				$conn = $basis->connDB();
				$conn->query($logSQL);
			}
			//釋放物件
			$execute = null;
		}
				
		//關閉資料庫
		public function close($conn){
			$conn->close();
		}
		
		//取得頁面
		public function getPageContent($pageType,$pageName){
			$pageClass = new \basisObject\getPageContent;
			$pageContent = $pageClass->getContent($pageType,$pageName);
			//釋放物件
			$pageClass = null;
			return $pageContent;
		}
		
		//除錯用
		public function debug($data){
			echo '<pre>';
			print_r($data);
			echo '</pre>';
		}
		
		//資安問題解決
		public function getAndPostProcess(){
			$informationSecurity = new \basisObject\informationSecurity;
			
			if(!empty($_POST)){
				$_POST = $informationSecurity->replacePackage($_POST);
			}
			
			if(!empty($_GET)){
				$_GET = $informationSecurity->replacePackage($_GET);
			}
			//釋放物件
			$informationSecurity = null;
		}
		
	}
?>