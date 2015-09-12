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
		public function DateTime($changeType,$Date=null){
			$dateStr = "";
			$dateStyle = "";
			if($Date != null or $Date != ''){
				//先檢查日期是用哪種分割的
				if($strpos($Date,"/") !== false){
					$dateArr = explode("/",$Date);
					$dateStyle = "/";
				}else if($strpos($Date,"-") !== false){
					$dateArr = explode("-",$Date);
					$dateStyle = "-";
				}else{//不符合現在有的格式
					return false;
				}
				
				switch($changeType){
					//西元轉民國(年月日)
					case "ADyyyyMMdd_RCyyyMMdd":
						$dateStr = ($dateArr[0]-1911).$dateStyle.($dateArr[1]).$dateStyle.($dateArr[2]);
					break;
					//西元轉民國(年月)
					case "ADyyyyMM_RCyyyMM":
						$dateStr = ($dateArr[0]-1911).$dateStyle.($dateArr[1]);
					break;
					//民國轉西元(年月日)
					case "RCyyyMMdd_ADyyyyMMdd":
						$dateStr = ($dateArr[0]+1911).$dateStyle.($dateArr[1]).$dateStyle.($dateArr[2]);
					break;
					//日期轉時間秒數?
					case "CTime":
						$dateStr = strtotime($Date);
					break;
					//取得現在時間秒數?
					case "CTime_Now":
						$dateStr = time();
					break;
				}
				return $dateStr;
			}
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