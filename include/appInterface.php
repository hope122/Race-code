<?php
	//app所有物件接由此使用生成
	
	//宣告命名空間
	namespace systemInterface;
	
	//先載入各中繼物件
	$modelUIPath = glob( __DIR__ ."\\relayInterface\\*.php");
	
	if(!empty($modelUIPath)){
		foreach($modelUIPath as $content){
			include_once($content);
		}
	}
	//載入結束
	
	//引用中繼物件命名空間
	use relayInterface\basis;
	use relayInterface\token;
	use relayInterface\log;
	use relayInterface\userlogin;
	//引用完畢
	
	class appInterface{
		//資料庫連線參數
		public $conn;
		//使用者資訊
		public $userInfo;
		
		//供呼叫程式初始化設定
		public function initialization(){
			@session_start();
			
			//基礎的資安防護
			$basis = new basis;
			$basis->getAndPostProcess();
			//結束基礎的資安防護
			
			//建立資料庫連線
			$this->conn = $basis->connDB();
			//結束
			
		}
		
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
		}
	}
	
	
?>