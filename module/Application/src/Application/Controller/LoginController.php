<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use systemInterface\appInterface;

class LoginController extends AbstractActionController
{
	public $viewContnet;
	public $conn;
	public function __construct(){
		$this->viewContnet = array();
	}
	//登入
    public function loginAction()
    {
		$VTs = new appInterface;
		//先初始化
		$VTs->initialization();
		//進行登入的處理
		$this->viewContnet["pageContent"] = $VTs->login();
		//結束資料庫連線
		$VTs->dbClose();
		//釋放物件
		$VTs = null;
		
		return new ViewModel($this->viewContnet);
    }
	//登出
	public function logoutAction()
    {
		$VTs = new appInterface;
		$VTs->logout();
	}
}
