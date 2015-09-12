<?php		
	namespace SystemDBService;
	
	//取得檔案名稱
	$thisName = pathinfo(__FILE__, PATHINFO_FILENAME);
	$filePath = glob(__DIR__ ."\\".$thisName."\\*.php");
	
	if(!empty($filePath)){
		foreach($filePath as $content){
			include_once($content);
		}
	}
	
?>