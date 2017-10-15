<?php
class BlogController {

	public function add() {
			if (!isset($_SESSION['me']) || $_SESSION['me']['id'] <=0) {
				header('Location:index.php?c=UserCenter&a=login');
			}
			include "./view/blog/add.html";
	}
	public function doAdd() {
		$upload =L("Upload");
		$filename = $upload->run('image');
		$content  = $_POST['content'];
 		$user_id  = $_SESSION['me']['id'];
 	  	$blogModel = new BlogModel();
		$status = $blogModel->addBlog($user_id, $content,$filename);
		if ($status) {
			header('Refresh:1,Url=index.php?c=Blog&a=lists');
			echo '添加成功，1秒后跳转到list';
			die();
		}	
	}
	public function image() {
		include "./view/blog/image.html";
	}
	public function doImage() {
		$upload =L("Upload");
		$filename = $upload->run('photo');
		echo $filename;
	}
	public function lists() {
			$blogModel = new BlogModel();
			$userModel = new UserModel();
			$p =isset($_GET['p']) ? $_GET['p'] : 1;
			$pageNum = 5;
			$offset = ($p - 1) *$pageNum;
			$count = $blogModel->getBlogCount();
			$allpage = ceil($count['num']/$pageNum);			
			$data = $blogModel->getBlogLists($offset,$pageNum);
			// foreach ($data as $key => &$value) {
			// 	$user_info = $userModel->getUserInfoById($value['user_id']);
			// 	//$data[$key]['user_name'] = $user_info['name'];
			// 	$value['user_name'] = $user_info['name'];
			// }
			foreach ($data as $key => $value) {
				$user_info = $userModel->getUserInfoById($value['user_id']);
				$data[$key]['user_name'] = $user_info['name'];
			}
			include "./view/blog/lists.html";
	}
	public function Info() {			
			$id = $_GET['id'];
			$blogModel= new BlogModel();
			$info= $blogModel->getUserInfoById($id);
			include "./view/blog/info.html";
	}
}