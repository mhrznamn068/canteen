 <?php
    include('../class/canteenmgmt.php');
    include('../class/orderHelper.php');
    include('partials/header.php');
    include('partials/sidebar.php');
    //echo $orders->getTodaysOrderDetail()['totalorder'];
 ?>      
 
    <div id="wrapper">

       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                 	
                    <h1 class="page-header">Daily Report  </h1>

                </div>
                <!-- /.col-lg-12 -->
            </div>  
            <div class="row">
               <div class="col-lg-12">
                    <div class="panel panel-default">
                       
                  		<div class="panel-body tableContainer">
                            <div class="dataTable_wrapper ">

                            <div class="filter_table">
                             	
                            </div>
                            Today's date : <?php echo date('Y-m-d'); ?><br /><br />
		                    <table class="datatable table table-striped table-bordered table-hover">
		                    	<thead>
			                    	<tr>
			                    		<th>
			                    			S.N.
			                    		</th>
			                    		
			                    		<th>
			                    			Order by
			                    		</th>
			                    		<th>
			                    			Total price
			                    		</th>
			                    		<th>
			                    			Action
			                    		</th>
			                    	</tr>
		                    	</thead>
		                    	<tbody>
		                    	<?php
		                    	$count=1;
		                    		foreach($orders->getTodaysOrders() as $key=>$order){
		                    			if($order['status']==0)
		                    				$color='';
		                    			else if ($order['status']==1)
		                    				$color='green';
		                    			else if ($order['status']==2)
		                    				$color='red';
		                    			echo "
		                    				<tr class='$color' data-order_id='".$order['order_id']."'>
		                    					<td>$count</td>
		                    					<td >".$order['order_placed_by']."</td>
		                    					<td >Rs. ".$order['total_price']."</td>
		                    					<td>
		                    						<a title='View detail' href='javascript:' class='item_detail'><i class='glyphicon glyphicon-list-alt'></i></a>
		                    						";
		                    			if($order['status']==0  || $order['status']==2)			
                							echo "<a title='Approve' href='javascript:' class='item_approve'><i class='glyphicon glyphicon-ok'></i></a>";

                						if($order['status']==0 || $order['status']==1 )
	      	          						echo "<a title='Reject' href='javascript:' class='item_reject'><i class='glyphicon glyphicon-remove'></i></a>
		                    					";	
		                    					
	                    						echo"</td>
		                    				</tr>
		                    			";
		                    			$count++;
		                    		}
		                    	?>
		                    	</tbody>
		                    	<tfoot>
			                    	<tr>
			                    		<th>
			                    			S.N.
			                    		</th>
			                    		
			                    		<th>
			                    			Order by
			                    		</th>
			                    		<th>
			                    			Total price
			                    		</th>
			                    		<th>
			                    			Action
			                    		</th>
			                    	</tr>
		                    	</tfoot>
		                    </table>
                		</div>
                		<div class="row legends">
							<div class="" style="padding:10px;">
							Legends
	                       <div class="legendContainer">
                					
                					<div class="legend"><div class="legenddiv pending"></div><div class="legendTitle">Pending</div> <div class="clear"></div></div>

                					<div class="legend"><div class="legenddiv green"></div><div class="legendTitle">Approved</div> <div class="clear"></div></div>
                					
                					<div class="legend"><div class="legenddiv red"></div><div class="legendTitle">Rejected</div> <div class="clear"></div></div>
                					 <div class="clear"></div>
                					
                			</div>
                			</div>
                		</div>
							<div>
                            	<fieldset>
	                             	<legend>Report Summary</legend>
	                             	<table class="table  table-striped">
			                     		<?php
			                     			$detail=$orders->getTodaysOrderDetail()
			                     		?>
			                     		<tr><td>Total Collection</td> <td>:</td> <td>Rs. <?php echo $detail['totalCollection']; ?></td></tr>
			                     		<tr><td>Total Orders</td> <td>:</td> <td><?php echo $detail['totalorder']; ?></td></tr>
			                     		<tr><td>Total Approved Orders</td> <td>:</td> <td><?php echo $detail['totalApprovedorder']; ?></td></tr>
			                     		<tr><td>Total Rejected Orders</td> <td>:</td> <td><?php echo $detail['totalRejectedorder']; ?></td></tr>
		                 		
		                 			</table>
                            	</fieldset>	
	                 		
	                 	</div>
                	</div>
                </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
          
           
            <!-- /.row -->
        </div>
    </div>
        <!-- /#page-wrapper -->
<?php
include('partials/footer.php');
?>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order detail</h4>
      </div>
      <div class="modal-body">
        		<div class="row">
        			 <div class="col-lg-12">
        					<div class="row  order_items">
        						<table class="table">
        							<tr><td>Order placed by </td><td>: </td><td><span class='placed_by'></span></td></tr>
        							<tr><td>Identification number </td><td>:</td><td> <span class='identification_no'></td></span></tr>
        							<tr><td>Total cost </td><td>: </td><td><span class='total_cost'></span></td></tr>

        						</table>
        						
        					</div>
        			 </div>
        		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
		
var bindEvent=function(){
	$('.item_approve').on('click',function(){
			var orderid=$(this).parents('tr').attr('data-order_id');
			var param={'order_id':orderid,'status':1};
			$.post('<?php echo base_url(); ?>formProcessing/requestProcess.php?func=approveReject_order',param,function(data){
				window.location.reload();
			});
		})
	$('.item_reject').on('click',function(){
			var orderid=$(this).parents('tr').attr('data-order_id');
			var param={'order_id':orderid,'status':2};
			$.post('<?php echo base_url(); ?>formProcessing/requestProcess.php?func=approveReject_order',param,function(data){
				window.location.reload();
			});
		})


	$('.item_detail').on('click',function(){
		
		var orderid=$(this).parents('tr').attr("data-order_id");
		$.get('<?php echo base_url(); ?>formProcessing/requestProcess.php?func=getOrderDetail&orderid='+orderid,function(data){
			var heading=getOrderHeadings();
			$('#myModal').modal('show');

			heading=getOrderHeadings();
			$('.order_items table.order_detail').remove();
			$('.order_items').append("<table class='datatable order_detail table table-striped table-bordered table-hover'><thead>"+heading+"</thead><tbody></tbody></table>");
			data=JSON.parse(data);
			html=[];

			$('.placed_by').text(data.detail.order_placed_by);
			$('.identification_no').text(data.detail.identification_no);
			$('.total_cost').text(data.detail.total_price);
			data.orderItems.forEach(function(x,i){
				html.push("<tr>");
				html.push("<td>"+(i+1)+"</td>");
				html.push("<td>"+x.item_title+"</td>");
				html.push("<td>"+x.item_price+"</td>");
				html.push("<td>"+x.item_quantity+"</td>");
				html.push("<td>"+(x.item_quantity*x.item_price)+"</td>");
				html.push("</tr>");
			})
			$('.order_items table.order_detail tbody').html(html.join(""));
		});
		
	})
}


var getOrderHeadings=function(){
	html=[];
	html.push("<tr>");
	html.push("<td>S.N.</td>");
	html.push("<td>Item</td>");
	html.push("<td>Rate</td>");
	html.push("<td>Quantity</td>");
	html.push("<td>Total</td></tr>");
	return html.join("");
}


</script>>