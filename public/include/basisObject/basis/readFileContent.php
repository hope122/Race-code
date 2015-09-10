<?php		
	namespace basisObject;
	
	class readFileContent {
		//讀取INI檔案
		public function readIni($iniPath,$fileName){
			$iniFile = parse_ini_file($iniPath.'/'.$fileName.'.ini',true);
			return $iniFile;
		}
	}
?>