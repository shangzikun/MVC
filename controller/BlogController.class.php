<?php
class BlogController {

	public function add() {
			if (!isset($_SESSION['me']) || $_SESSION['me']['id'] <=0) {
				header('Location:index.php?c=UserCenter&a=login');
			}
			$classifyModel = new ClassifyModel();
			$classify = $classifyModel->getLists();
			include "./view/blog/add.html";
	}
	public function doAdd() {
		$upload =L("Upload");
		$filename = $upload->run('image');
		$content  = $_POST['content'];
 		$user_id  = $_SESSION['me']['id'];
 		$classify = $_POST['classify'];
		$title = $_POST['title'];
		$data = array(
				'user_id' 	=> $user_id,
				'content' 	=> $content,
				'classify' 	=> $classify,
				'title' 	=> $title,
				'image' 	=> $filename,
				);
 	  	$blogModel = new BlogModel();
		$status = $blogModel->addBlog($data);
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
			/*
				get p 当前第几页
				每页显示的个数  $pageNum =  3; 
				通过 p + pageNum  求偏移量  
				获取列表的方法支持 offset  limit 
				获取总条数 / pageNum ceil 向上取整 为了页面中显示页码
			 */
			$blogModel = new BlogModel();
			$userModel = new UserModel();
			$ClassifyModel = new ClassifyModel();
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
				$classify_info = $ClassifyModel->getClassifyInfoById($value['classify_id']);
				$data[$key]['name'] = $classify_info['name'];
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