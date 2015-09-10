<?php		
	namespace basisObject;
	//取得頁面檔案內容
	class getPageContent {
		public function getContent($pageType,$pageName){
			$pagePath = dirname(__DIR__)."\\..\\pageContent\\".$pageType."\\".$pageName.".html";
			//echo $pagePath;
			$pageContent = '';
			if(file_exists($pagePath)){
				$pageContent = file_get_contents($pagePath);
			}
			return $pageContent;
		}
	}
?>