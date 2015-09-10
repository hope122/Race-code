<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use relayInterface\basis;
use systemInterface\appInterface;

class IndexController extends AbstractActionController
{
	public $viewContnet;
	public $conn;
	public function __construct(){
		/*$basisUI = new basisUI;
		$this->conn = $basisUI->connDB('oauth');*/
		$this->viewContnet = array();
	}
    public function indexAction()
    {
		$VTs = new appInterface;
		//先初始化
		$VTs->initialization();
		//頁面資料夾名稱
		$dirName='index';
		//頁面檔名
		$pageName='login_page';
		//取得頁面
		$this->viewContnet['pageContent'] = $VTs->pages($dirName,$pageName);
		
		//結束資料庫連線
		$VTs->dbClose();
		//釋放物件
		$VTs = null;
		//$basis = new basis;
		//$this->viewContnet['pageContent'] = $basis->getPageContent('index','login_page');
		/*if(!$_SESSION["uid"]){
			$this->viewContnet['pageContent'] = $basis->getPageContent('index','login_page');
		}else{
			$isLoginContent = $basis->getPageContent('index','after_login');
			$isLoginContent = str_replace("@@requestTokenCode@@",$_SESSION["requestTokenCode"],$isLoginContent);
			$this->viewContnet['pageContent']= $isLoginContent;
			//header("location: http://127.0.0.1:120/auth_back.php?requestTokenCode=".$_SESSION["requestTokenCode"]);
			//exit();
		}*/
		//$basisUI->debug($_SESSION);
		return new ViewModel($this->viewContnet);
    }
}
