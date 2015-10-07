<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use System_APService\clsSystem;

class NewsController extends AbstractActionController
{
	public $viewContnet;
	public $conn;
	public function __construct(){
		$this->viewContnet = array();
	}
    public function indexAction()
    {
		$VTs = new clsSystem;
		//先初始化
		$VTs->initialization();
		
		//-----------BI開始------------
	
		//取得公告資料
		$strSQL = "select * from news";
		$data = $VTs->QueryData($strSQL);
		
		//debug，印出資料用
		if(!Empty($data)){
			//$VTs->debug($data);
			foreach( $data as $arr ){
				$VTs->debug($arr);
				if($arr['uid']==1){
					echo "第一則";
				}
			}
		}else{
			
		}
		
		//-----------BI結束------------ 
		
		//關閉資料庫連線
		$VTs->DBClose();
		//釋放
		$VTs=null;
		
		return new ViewModel($this->viewContnet);
    }
}
