<?php		
	namespace SystemToolsService;
	
	
	class clsTools {
		#modIO
		//讀取INI檔資料 GetINIInfo(strIniFile, sSection, sKeyName, sDefaultValue = "") As String
		public function GetINIInfo($strIniFile,$sSection,$sKeyName,$sDefaultValue = "",$originDataArray = false){
			if($originDataArray){
				return parse_ini_file($strIniFile);
			}else{
				$iniContent = parse_ini_file($strIniFile,true);
				foreach($iniContent[$sSection] as $i => $content){
					if($i == $sKeyName){
						return ($content)?$content:$sDefaultValue;
					}
				}
			}
		}
		#modIO結束
		
		#modDataFormate
		//日期轉換
		public function DateTime(){
			
			
		}
		
		//資料庫轉換資料
		public function Data2Array($DBQueryData){
			$data = null;
			if($DBQueryData){
				$i=0;
				if( $DBQueryData and $DBQueryData->num_rows){
					while ($ar = $DBQueryData->fetch_array(MYSQLI_ASSOC)) {
						$j=0;
						foreach($ar as $key=>$val){
							//echo $key."=>".$val;
							if( !empty($pk) ){
								$p = $ar[$pk];
								if($kind==0) $data[$p][$key]=$val;
								elseif($kind==1) $data[$p][$j]=$val;
							}
							else{
								if($kind==0) $data[$i][$key]=$val;
								elseif($kind==1) $data[$i][$j]=$val;
							}
							$j++;
						}
						$i++;
					}
				}
			}
			return $data;
		}
		#modDataFormate結束
		
		#DataInformationSecurity
		//資訊全重複檢查是否有遺漏的，並取代為HTML CODE
		public function replacePackage($arr){
			$tmpArr = array();
			if(!empty($arr)){
				foreach($arr as $i => $content){
					//若是多維陣列，再次處理
					if(is_array($content)){
						$arr[$i] = $this->replacePackage($content);
					}else{
						$arr[$i] = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
					}
				}
			}
			$tmpArr = $arr;
			return $tmpArr;
		}
		#DataInformationSecurity結束
		
		#modArrayDebug
		public function debug($DataArray){
			echo "<pre>";
			print_r($DataArray);
			echo "</pre>";
		}
		#modArrayDebug結束
	}
?>