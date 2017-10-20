<?php
	class ClassifyModel {
		public $mysqli;
		function __construct() {
			$this->mysqli = new mysqli("127.0.0.1","root","","ztstu");
			$this->mysqli->query('set names utf8');
		}
		function addClassify($name,$pid) {
			$sql = "insert into classify(name,pid) value ('{$name}',{$pid})";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		function delClassify() {
			$id = $_GET['id'] ? (int)$_GET['id'] : 0;
			$sql = "delete from classify where id ={$id}";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		function getLists() {
			$sql = "select * from classify where pid = 0";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			foreach ($data as $key => $value) {
				$sqlChild = "select * from classify where pid = {$value['id']}";
				$resChild = $this->mysqli->query($sqlChild);
				$child = $resChild->fetch_all(MYSQL_ASSOC);
				$data[$key]['child'] = $child;
			}
			return $data;
		}
		public function getClassifyInfoById($id) {
			$sql = "select * from classify where id = {$id}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return isset($data[0]) ? $data[0] : 0;
		}
	}