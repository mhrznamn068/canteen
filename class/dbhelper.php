<?php
	Class dbhelper{
		private $query;
		private $conn;
		private $affected_rows;
		private $last_insert_id;
		function __construct() {
	      $this->dbConnection();
	   }

		private function dbConnection(){
			$this->conn=new mysqli('localhost','root','','canteenmgmt') or die(mysqli_error());
		}

		public function executeRawQuery($query,$array_type){
			$this->query=$query;
			// echo $this->query;
			$query=$this->conn->query($this->query);

			$result=[];
			if($array_type=="row"){
				$result=$query->fetch_array(MYSQLI_ASSOC);
			}else{
				$result=$this->getQueryResourceResult($query);
			}

			return $result;
		}

		public function insertIntoDb($table,$fields){

			$separatedResult=$this->indexValueSeparataion($fields);
			$datas=[$this->arrayToString($separatedResult['index']),$this->arrayToString($this->prepareValues($separatedResult['value']))];

			$this->query="INSERT INTO $table ($datas[0]) values ($datas[1])";
			$this->conn->query($this->query);
			// mysqli_query($this->conn,) or die(mysqli_error());
			// $result = $mysqli->query($query);

			$this->last_insert_id= $this->conn->insert_id;
			$this->affected_rows= $this->conn->affected_rows;

		}

	public function updateDb($tablename,$field,$value,$data){

			$dataStringed=urldecode($this->arrayToStringWithKey($this->prepareValues($data)));

			$this->query="Update $tablename set ".$dataStringed." where $field=$value";
			$this->conn->query($this->query);
			$this->affected_rows= $this->conn->affected_rows;
	}



		public function last_insert_id(){
			return $this->last_insert_id;
		}

		public function prepareValues($where){
			$fixed=[];
			foreach($where as $key=>$wh){
				$fixed[$key]="'".$wh."'";
			}
			return $fixed;
		}

		public function selectFromDb($tablename,$fields="*",$where="",$array_type="",$limit="",$sortby="",$ordertype="desc",$upper_limit=""){

			if($fields=="")
				$fields="*";
			$this->query="SELECT $fields FROM $tablename";

			if($where!=""){
				$where =$this->prepareValues($where);
				$whereStringed=urldecode($this->arrayToStringWithKey($where,'and'));
				
				if($whereStringed!="")
					$this->query.=" where ".$whereStringed;
			}

			if($sortby!=""){
				$this->query.=" ORDER BY $sortby $ordertype ";
			
			}
			$query=$this->conn->query($this->query);



			$result=[];
			if($array_type=="row"){
				$result=$query->fetch_array(MYSQLI_ASSOC);
			}else{
				$result=$this->getQueryResourceResult($query);
			}

			return $result;
		}

		private function getQueryResourceResult($resource){

			$result=[];

			while($res=$resource->fetch_array(MYSQLI_ASSOC)){
				array_push($result, $res);
			}
			return $result;

		}

		private function indexValueSeparataion($array){

			$result=['value'=>[],'index'=>[]];

			foreach($array as $key=>$arr){

				array_push($result['value'], $arr);
				array_push($result['index'], $key);
				
			}
			return $result;

		}

		private function arrayToString($array){
				return implode(',', $array);
		}

		private function arrayToStringWithKey($array,$spearator=','){
				return http_build_query($array,''," ".$spearator." ");
		}

		public function last_query(){
			echo $this->query;
		}

	
		public function affected_rows(){
			return $this->affected_rows;
		}



	}


?>