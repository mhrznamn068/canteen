<?php
	
	class orderHelper{

		private $db;

		function __construct() {
			$this->db=new dbhelper();
	   	}

		public function getAllOrders(){
			$where="";
			if(isset($_GET['display']) && strtolower($_GET['display'])=='pending'){
				$where=['status'=>0];
			}
			$orders=$this->db->selectFromDb('tbl_order','',$where,'','','status,order_id');
			return $orders;

		}

		public function getTodaysOrders(){
			$where="";
			$today=date('Y-m-d 00:00:00');
	

			$orders=$this->db->executeRawQuery('SELECT * FROM tbl_order where created_date>"'.$today.'" order by status,order_id DESC','');

			return $orders; 

		}


		public function getTodaysOrderDetail(){
			$detail=[];
			$today=date('Y-m-d 00:00:00');
			$detail['totalorder']=$this->db->executeRawQuery('SELECT count(*) as totalcount FROM tbl_order where created_date>"'.$today.'"','row')['totalcount'];
			$detail['totalApprovedorder']=$this->db->executeRawQuery('SELECT count(*) as totalcount FROM tbl_order where created_date>"'.$today.'" and status=1','row')['totalcount'];
			$detail['totalRejectedorder']=$this->db->executeRawQuery('SELECT count(*) as totalcount FROM tbl_order where created_date>"'.$today.'" and status=2','row')['totalcount'];
			$detail['totalCollection']=$this->db->executeRawQuery('SELECT SUM(total_price) as totalcost FROM tbl_order where created_date>"'.$today.'" and status=1','row')['totalcost'];
			return $detail;

		}

	}


	$orders=new orderHelper();

?>