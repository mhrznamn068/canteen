<?php
	
	class itemHelper{

		private $db;

		function __construct() {
			$this->db=new dbhelper();
	   	}

		public function getAllItems($status=0){

			if($status!=0)
				$where['item_status']=$status;
			else
				$where="";

			$item_list=$this->db->selectFromDb('tbl_item INNER JOIN tbl_category ON (tbl_category.category_id=tbl_item.item_category) ','',$where,'','','item_id');
			return $item_list;

		}


		public function getSpecialItems($status=0){

			$where['is_special']=1;
		

			$item_list=$this->db->selectFromDb('tbl_item INNER JOIN tbl_category ON (tbl_category.category_id=tbl_item.item_category) ','',$where,'','','item_id');
			return $item_list;

		}

	}


	$items=new itemHelper();

?>