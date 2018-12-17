<?php
	
    session_start();
	
	include('dbhelper.php');
	Class canteenmgmt{
		function __construct($login=true) {
			if($login==true)
				$this->checkValidUser();
	   	}

	   	private function checkValidUser(){
	   		if(!$_SESSION['userloggedin'] && $_SESSION['userloggedin']!=true){
	   			redirect(base_url()."login.php");
	   		}
	   	}

	}

	function base_url(){
	   	 return "http://localhost:85/canteenmgmt/";
	}
	
	function redirect($url){
	   	header('location:'.$url);
	}

?>