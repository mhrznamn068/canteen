<?php
	if(isset($_POST['func']) && $_POST['func'])
		$func=$_POST['func'];
	else
		$func=$_GET['func'];
	include('../class/dbhelper.php');
	class requestProcess{

		private $db;
		function __construct() {
			$this->db=new dbhelper();
	   	}

		public function addItem(){	
			//print_r($_POST);
			$toadd=[];
			$item_id=$_POST['item_id'];
			$toadd['item_title']=$_POST['item_title'];
			$toadd['item_category']=$_POST['item_category'];
			$toadd['item_price']=$_POST['item_price'];

			if(isset($_POST['is_special']))
				$toadd['is_special']=$_POST['is_special'];
			else{
				$toadd['is_special']=0;
			}
			if($item_id==0)
				$this->db->insertIntoDb('tbl_item',$toadd);	
			else
				$this->db->updateDb('tbl_item','item_id',$item_id,$toadd);	

			echo $this->db->last_query();
		}

		public function addCategory(){	
			//print_r($_POST);
			$toadd=[];
			$category_id=$_POST['category_id'];
			$toadd['category_title']=$_POST['cat_title'];

			if($category_id==0)
				$this->db->insertIntoDb('tbl_category',$toadd);	
			else
				$this->db->updateDb('tbl_category','category_id',$category_id,$toadd);	

			echo $this->db->last_query();
		}

		public function getallitems(){

			$items=$this->db->selectFromDb('tbl_item INNER JOIN tbl_category ON (tbl_category.category_id=tbl_item.item_category) ','','','','','item_id');
			echo  json_encode($items);

		}
		public function getallcategories(){

			
			$categories=$this->db->selectFromDb('tbl_category','','','','','category_id');
			echo  json_encode($categories);

		}

		public function activateDeactivateItem(){

			$item_id=$_POST['item_id'];
			$toadd=[];
			$toadd['item_status']=$_POST['status'];
			$this->db->updateDb('tbl_item','item_id',$item_id,$toadd);
			echo $this->db->affected_rows();
		}

		public function newOrder(){

			$toadd=[];
			$toadd['order_placed_by']=$_POST['fullname'];
			$toadd['identification_no']=$_POST['Identification'];
			$toadd['total_price']=$_POST['totalprice'];
			$toadd['status']=0;
			$this->db->insertIntoDb('tbl_order',$toadd);	
		
			$order_id=$this->db->last_insert_id();

			$orders=json_decode($_POST['orders'], True);
			foreach($orders as $order){
				$toadd=[];
				$toadd=$order;
				$toadd['order_id']=$order_id;

				$this->db->insertIntoDb('tbl_order_detail',$toadd);
			}
			$message=['status'=>'success','message'=>'Your order has been placed successfully'];
			echo json_encode($message);

		}

		public function approveReject_order(){
		
			$order_id=$_POST['order_id'];
			$status=$_POST['status'];
			$update['status']=$status;
			$affected_rows=$this->db->updateDb('tbl_order','order_id',$order_id,$update);
			// echo $this->db->last_query();
			echo $affected_rows;
		}

		public function getAllOrders(){
			$where="";
			if(isset($_GET['display']) && strtolower($_GET['display'])=='pending'){
				$where=['status'=>0];
			}

			if(isset($_GET['ordertype']) && $_GET['ordertype']!=3){

				$where=['status'=>$_GET['ordertype']];
			}


			$orders=$this->db->selectFromDb('tbl_order','',$where,'','','status,order_id');
			echo json_encode($orders);
		}


		public function getTodaysOrderDetail($where){
			$detail=[];
			$today=date('Y-m-d 00:00:00');
			$detail['totalorder']=$this->db->executeRawQuery('SELECT count(*) as totalcount FROM tbl_order where '.$where,'row')['totalcount'];
			$detail['totalApprovedorder']=$this->db->executeRawQuery('SELECT count(*) as totalcount FROM tbl_order where '.$where.' and status=1','row')['totalcount'];
			$detail['totalRejectedorder']=$this->db->executeRawQuery('SELECT count(*) as totalcount FROM tbl_order where '.$where.' and status=2','row')['totalcount'];
			$detail['totalCollection']=$this->db->executeRawQuery('SELECT SUM(total_price) as totalcost FROM tbl_order where '.$where.' and status=1','row')['totalcost'];
			return $detail;

		}

		public function getOrderDatewise(){
			
			$today=date('Y-m-d 00:00:00');
			$from=$_POST['from'];
			$to=$_POST['to'];
			$from = date("Y-m-d h:i:s",strtotime($from));
			$to = date("Y-m-d h:i:s",strtotime($to));
			$where =' created_date between "'.$from.'" and "'.$to.'"';
			$data['orders']=$this->db->executeRawQuery('SELECT * FROM tbl_order where '.$where.' order by status,order_id DESC','');
			$data['detail']=$this->getTodaysOrderDetail($where);
			echo  json_encode($data); 


		}


		public function getOrderDetail(){
			$orderid=$_GET['orderid'];
			$where=['order_id'=>$orderid];
			$data['orderItems']=$this->db->selectFromDb('tbl_order_detail INNER JOIN tbl_item on (tbl_item.item_id=tbl_order_detail.item_id) ',"*",$where);
			$data['detail']=$this->db->selectFromDb('tbl_order',"*",$where,'row');
			echo json_encode($data);
		}

	}


	$requestProcess=new requestProcess();
	$requestProcess->$func();

?>
