<?php
	class BlogModel {
		public $mysqli;
		function __construct() {
			$this->mysqli = new mysqli("127.0.0.1","root","","ztstu");
			$this->mysqli->query('set names utf8');
		}
		function addBlog($user_id, $content) {
			$sql = "insert into blog(content,user_id) value ('{$content}', {$user_id})";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		function getBlogLists() {
			$sql = "select * from blog";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data;
		}
		function getUserInfoByName($name) {
			$sql = "select * from user where name = '{$name}'";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0];
		}
	}
	