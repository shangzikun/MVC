<?php
	class BlogModel {
		public $mysqli;
		function __construct() {
			$this->mysqli = new mysqli("127.0.0.1","root","","ztstu");
			$this->mysqli->query('set names utf8');
		}
		function addBlog($user_id, $content,$image='') {
			$sql = "insert into blog(content,user_id,image) value ('{$content}', {$user_id},'{$image}')";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		function getBlogLists($offset,$limit) {
			$sql = "select * from blog limit {$offset},{$limit}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data;
		}
		// function getUserInfoByName($name) {
		// 	$sql = "select * from user where name = '{$name}'";
		// 	$res = $this->mysqli->query($sql);
		// 	$data = $res->fetch_all(MYSQL_ASSOC);
		// 	return $data[0];
		// }
		function getUserInfoById($id) {
			$sql = "select * from blog where id = '{$id}'";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return isset($data[0]) ? $data[0] :array();
		}
		function getBlogCount() {
			$sql = "select count(*) as num from blog ";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0];
		}
	}
	