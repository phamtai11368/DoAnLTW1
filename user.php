<?php
		include "db.php";
		include "config.php";
class User{
	public $username;
	public $password;
	public function __construct($username,$password){
		$this->username = $username;
		$this->password = md5($password);
	}
	public function login(){
		
		$username = $this->username;
		$password = $this->password;
		$db = new Db;
		$us = $db->getUserByUSName($username);
		if($us != NULL)
		{
			if($username == $us[0]['Username'] && $password == $us[0]['Password'])
			{
				return true;
			}
		}
	}
}
