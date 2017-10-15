<?php
class UserController {

	public function add() {
			include "./view/user/add.html";
	}
	public function doAdd() {
		
		$name  = $_POST['username'] ? $_POST['username'] : '';
 		$age   = $_POST['age'] ? $_POST['age'] : 0 ;
 		$password = $_POST['password'] ? $_POST['password'] : 0;	
		if (empty($name) || empty($age) ||empty($password)) {       
       		header ('Refresh:3,Url=index.php?c=User&a=lists');//三秒后跳转
       		echo "发布失败,3秒后跳转到list";
       		die();
   		}   
 	  	$userModel = new UserModel();
		$status = $userModel->addUser($name, $age, $password);
		if ($status) {
			header('Refresh:1,Url=index.php?c=User&a=lists');
			echo '发布成功，1秒后跳转到list';
			die();
		}	
	}
	public function lists() {
			$userModel = new UserModel();
			$data = $userModel->getUserLists();
			include "./view/user/lists.html";
	}
}	