<?php
	//自动加载
	function __autoload($class) {	//当实例化一个不存在的类的时候php会自动执行
		if (strpos($class, "Controller" )!== false) {
			$dir = 'controller';
		} else if (strpos($class, "Model")!== false) {
			$dir = 'model';
		} else {
			die($class."not exist");
		}
		include "./{$dir}/{$class}.class.php";
	}
	//实例化library对象
	function L($name) {
		include "./library/{$name}.class.php";
		$obj = new $name();
		return $obj;
	}
	//验证码生成随机数
	function getRandom($len) {
		$base="0123456789abcdefgh";
		$max=strlen($base);
		mt_rand();
		$res='';
		for ($i=0; $i<$len ; $i++) { 
		$res .=$base[mt_rand(0,$max-1)];
		}
		return $res;
	}
