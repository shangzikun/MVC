<?php

class UserModel {
	public $mysqli;
	public function __construct() {
			header("Content-type: text/html;charset=utf-8");//显示汉字
			$this->mysqli = new mysqli("localhost","root","","ztstu");//连接数据库)
			$this->mysqli->query('set names utf8');
	}
	public function addUser($name,$age,$password,$image) {
			$sql = "insert into user(name,age,password,image) value ('{$name}', {$age}, '{$password}','{$image}')";
			$res = $this->mysqli->query($sql);
			return $res;
	}
	public function getUserLists() {
			$sql = "select * from user";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data;
	}
	public function getUserInfoById($id) {
			$sql = "select * from user where id = {$id}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return isset($data[0]) ? $data[0] :array();
		}
	public function getUserInfoByName($name) {
			$sql = "select * from user where name = '{$name}'";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return isset($data[0]) ? $data[0] :array();
		}
}	