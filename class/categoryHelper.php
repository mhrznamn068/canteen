<?php
	
	class categoryHelper{

		private $db;

		function __construct() {
			$this->db=new dbhelper();
	   	}

		public function getAllCategories(){

			$categories=$this->db->selectFromDb('tbl_category','','','','','category_id');
			return $categories;

		}

	}


	$categories=new categoryHelper();

?>