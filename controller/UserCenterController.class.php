<?php
	class UserCenterController {
		public function login() {
				include "./view/usercenter/login.html";
		}
		public function doLogin() {
				$name = $_POST['username'];
				$password = $_POST['password'];
				$userModel =  new UserModel();
				$userInfo = $userModel->getUserInfoByName($name);
			if ($userInfo['password'] == $password) {
				unset($userInfo['password']); //一般来说 密码对外开放
				$_SESSION['me'] = $userInfo;
				header('Refresh:1,Url=index.php?c=Blog&a=lists');
				echo '登录成功';
				die();
			} else {
				header('Refresh:2,Url=index.php?c=Blog&a=lists');
				echo '登录不成功';
				die();
			}
		}
		public function reg () {
			include "./view/usercenter/reg.html";
		}
		public function doReg() {
			$upload =L("Upload");
			$filename = $upload->run('photo');
			$name 	= $_POST['username'];
			$age 	= $_POST['age'] ? $_POST['age'] : 0;
			$password = $_POST['password'];
			if (empty($name) || empty($password)) {
				header('Refresh:3,Url=index.php?c=UserCenter&a=reg');
				echo '注册不成功';
				die();
			}
			$userModel = new UserModel();
			$userInfo = $userModel->getUserInfoByName($name);
			if (!empty($userInfo)) {
				header('Refresh:1,Url=index.php?c=UserCenter&a=reg');
				echo '用户名已存在，注册失败';
				die();
			}
			$status = $userModel->addUser($name , $age, $password,$filename);
			if ($status) {
				header('Refresh:1,Url=index.php?c=UserCenter&a=login');
				echo '注册成功，1秒后跳转';
				die();
			} else {
				header('Refresh:2,Url=index.php?c=UserCenter&a=reg');
				echo '注册失败，2秒后跳转';
				die();
			}
		}
		public function logout () {
				unset($_SESSION['me']);
				header('Refresh:1,Url=index.php?c=Blog&a=lists');
				echo '注销成功';
				die();
		}	
	}