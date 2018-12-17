<?php

	Class userClass {

		private $db;

		function __construct() {
			$this->db=new dbhelper();
	   	}

	   	public function login(){

	   		$username=$_POST['uname'];
	   		$password=$_POST['password'];
	   		$where=['user_name'=>$username,'user_pass'=>hash('sha1',$password)];
	   		$users=$this->db->selectFromDb('tbl_user','*',$where,'row');
	   		// echo $this->db->last_query();
	   		if(sizeof($users)>0){
	   			$_SESSION['userloggedin']=true;
	   			$_SESSION['userdetail']=$users;
	   			redirect(base_url()."admin");		
	   		}else{
	   			redirect(base_url()."login.php");	
	   		}

	   	}

		public function addUser(){

		}

		public function getUserDetail(){

		}

		public function logout(){
			session_start();
			
			$_SESSION['userloggedin']=false;
			$_SESSION="";
			session_destroy();
			
			redirect(base_url()."login.php");
		}



	}

?>