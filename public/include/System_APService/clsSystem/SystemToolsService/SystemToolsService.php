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
		
		#DataInformationSecurity
		//資訊兒全重複檢查是否有遺漏的，並取代為HTML CODE
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
		
	}
?>