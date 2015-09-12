<?php		
	namespace SystemDBService;
	
	class clsDB_MySQL {
		//定義共用變數
		public $conn;
		//CreateDBConnection(sServer, sDatabase, sUser, sPassWord) as boolean
		//資料庫連線
		public function CreateDBConnection($sServer,$sDatabase,$sUser,$sPassWord){			
			$this->conn = new \mysqli($sServer, $sUser, $sPassWord,$sDatabase);
			if ($this->conn->connect_error) {
				$this->conn = false;
			}
			//回傳
			return $this->conn;
		}
		
		//用於單純INSERT、UPDATE、DELETE等
		//ExecuteNonQuery(sSqlText)
		public function ExecuteNonQuery($sSqlText){
			if( !empty($sSqlText) ){
				$stmt = $this->conn->query($sSqlText);
				return ($stmt)?true:false;
			}
		}
		
		//讀取資料 QueryData(sSqlText) as DataTable
		public function QueryData($sSqlText){
			$data = NULL;
			if( !empty($sSqlText) ){
				$stmt = $this->conn->query($sSqlText);
				$data = $stmt->fetch_array(MYSQLI_ASSOC);
			}
			return $data;	
		}
		
		//建立Transcation機制 CreateMySqlTranscation
		public function Transcation(){
			$sSqlText = 'START TRANSACTION';
			$this->ExecuteNonQuery($sSqlText);
		}
		
		//Commit Transction機制 CommitMySqlTranscation
		public function Commit(){
			$sSqlText = 'COMMIT';
			$this->ExecuteNonQuery($sSqlText);
		}
		
		//Rollback Transction機制 RollbackMySqlTranscation
		public function Rollback(){
			$sSqlText = 'ROLLBACK';
			$this->ExecuteNonQuery($sSqlText);
		}
		
		//關閉資料庫連線 CloseConnection
		public function DBClose(){
			$this->conn->close();
		}
		
	}
?>