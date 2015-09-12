<?php
	//宣告命名空間
	namespace System_APService;
	
	//先載入各物件
	$systemApPath = glob( __DIR__ ."\\*\\*\\*.php");
	
	if(!empty($systemApPath)){
		foreach($systemApPath as $systemApContent){
			include_once($systemApContent);
			//print_r($systemApContent);
		}
	}
	//載入結束
	//引用物件命名空間
	use SystemDBService\clsDB_MySQL;
	use SystemToolsService\clsTools;
	//引用完畢
	
	class clsSystem{
		//資料庫連線參數
		public $SystemDBService;
		//相關工具
		public $SystemToolsService;
		//使用者資訊
		public $userInfo;
		
		//供呼叫程式初始化設定
		public function initialization(){
			@session_start();
			
			//相關工具設定
			//基礎的資安防護
			$VTs = new clsTools;
			if(!empty($_POST)){
				$_POST = $VTs->replacePackage($_POST);
			}
			
			if(!empty($_GET)){
				$_GET = $VTs->replacePackage($_GET);
			}
			//結束基礎的資安防護

			//取得資料庫設定值
			$strIniFile = __DIR__ . '\\..\\connDB.ini';
			$sSection = 'connDB';
			
			$sServer = $VTs->GetINIInfo($strIniFile,$sSection,'servername','');
			$sUser = $VTs->GetINIInfo($strIniFile,$sSection,'user','');
			$sPassWord = $VTs->GetINIInfo($strIniFile,$sSection,'password','');
			$sDatabase = $VTs->GetINIInfo($strIniFile,$sSection,'defaultDB','');
			//存到變數，以重複利用
			$this->SystemToolsService = $VTs;
			//釋放
			$VTs = null;
			//相關工具設定結束
			
			//建立資料庫連線
			$VTc = new clsDB_MySQL;
			$VTc->CreateDBConnection($sServer,$sDatabase,$sUser,$sPassWord);
			//存到變數，以重複利用
			$this->SystemDBService = $VTc;
			//釋放
			$VTs = null;
			//結束
			
		}
		
		public function GetVariablesDefine($VariablesName){
			if(isset($this->$VariablesName)){
				return $this->$VariablesName;
			}else{
				return null;
			}
		}
				
		/*
		//處理取得主要頁面內容
		public function pages($dirName,$pageName){
			$basis = new basis;
			return $basis->getPageContent($dirName,$pageName);
		}
		
		//處理登入事件
		public function login(){
			$userlogin = new userlogin;
			return $userlogin->processLogin($this->conn);
		}
		
		//處理登出事件
		public function logout(){
			@session_destroy();
			return true;
		}
		
		public function dbClose(){
			$basis = new basis;
			$basis->close($this->conn);
		}*/
	}
	
	
?>