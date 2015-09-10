<?php		
	namespace basisObject;
	//資料庫連線
	class creatConnDB {
		public function connDB($servername,$userAD,$password,$database){			
			$conn = new \mysqli($servername, $userAD, $password,$database);
			if ($conn->connect_error) {
				$conn = false;
			}
			//回傳
			return $conn;
		}
	}
?>