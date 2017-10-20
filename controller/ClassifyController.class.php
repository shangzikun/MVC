<?php
	class ClassifyController {
		public function __construct() {
		}
		public function add () {
			if (!isset($_SESSION['me']) || $_SESSION['me']['id'] <=0) {
				header('Location:index.php?c=UserCenter&a=login');
			}
			$classifyModel = new ClassifyModel();
			$classify = $classifyModel->getLists();
			include "./view/classify/add.html";
		}
		public function doAdd() {
			$classifyModel = new ClassifyModel();
			$name  = $_POST['name'] ? $_POST['name'] : '';
 			$pid   = $_POST['pid'] ? $_POST['pid'] : 0 ;
			$status = $classifyModel->addClassify($name, $pid);
			if ($status) {
				header('Refresh:1,Url=index.php?c=Blog&a=add');
				echo '添加成功';
			}	
	    }
	    public function delete() {
		$id = $_GET['id'] ? (int)$_GET['id'] : 0;
		$classifyModel = new ClassifyModel();
		$res = $classifyModel->delClassify();
		if (!is_int($id) || !$id) {
		echo $id;
		header('Refresh:3,Url=index.php?c=User&a=lists');
		echo "参数不合法，3秒后跳转到list";
		die();
		}				
		header ('Refresh:1,Url=index.php?c=User&a=lists');//三秒后跳转
 		echo "删除成功，1秒后跳转到list";
	}
	}