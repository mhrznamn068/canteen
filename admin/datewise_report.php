 <?php
    include('../class/canteenmgmt.php');
    include('../class/orderHelper.php');
    include('partials/header.php');
    include('partials/sidebar.php');
$date= date("Y-m-d");
    //echo $orders->getTodaysOrderDetail()['totalorder'];
 ?>      
 
    <div id="wrapper">

       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                 	
                    <h1 class="page-header">Datewise Report  </h1>

                </div>
                <!-- /.col-lg-12 -->
            </div>  
            <div class="row">
               <div class="col-lg-12">
                    <div class="panel panel-default">
                       
                  		<div class="panel-body tableContainer">
                            <div class="dataTable_wrapper ">

                            <div class="">
                             	  	Today's date :   <?php echo $date; ?><br /><br />
                            		<div class="row">
	                            		<div class="col-lg-4">
		                            		<div class="form-group">
			                                    <input  data-provide="datepicker" class="form-control date_start" placeholder="Starting date" name="date_start" type="text">
			                                </div>
		                                </div>
		                                <div class="col-lg-4">
			                                <div class="form-group">
			                                    <input  data-provide="datepicker" class="form-control date_end" placeholder="Ending date" name="date_end" type="text">
			                                </div>
		                                </div>
		                                <div class="col-lg-2">
			                                <div class="form-group">
			                                    <input style="padding:4px 16px;" class="btn btn-lg btn-success btn-block filterByDate" Value='Filter' name="filter" type="submit">
			                                </div>
		                                </div>
	                                </div>
                        			
                            </div>
                          	<div class="reportDetail" style="display:none;">
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
                		</div>
                		<div class="row legends"  style="display:none">
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

                		<div class="reportSummary" style="display:none">
                             <fieldset>
                             	<legend>Report Summary</legend>
                             	<table class="table  table-striped">
	                     		<?php
	                     			$detail=$orders->getTodaysOrderDetail()
	                     		?>
	                     		<tr><td>Total Collection</td> <td>:</td> <td>Rs. <span class='totalCollection'><?php echo $detail['totalCollection']; ?></span></td></tr>
	                     		<tr><td>Total Orders</td> <td>:</td> <td><span class='totalOrder'><?php echo $detail['totalorder']; ?></span></td></tr>
	                     		<tr><td>Total Approved Orders</td> <td>:</td> <td><span class='totalApproved'><?php echo $detail['totalApprovedorder']; ?></span></td></tr>
	                     		<tr><td>Total Rejected Orders</td> <td>:</td> <td><span class='totalRejected'><?php echo $detail['totalRejectedorder']; ?></span></td></tr>
	                 		
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
<script>


var getHeadings=function(){

	html='<tr> \
			                    		<th>\
			                    			S.N.\
			                    		</th>\
			                    		\
			                    		<th>\
			                    			Order by\
			                    		</th>\
			                    		<th>\
			                    			Total price\
			                    		</th>\
			                    		<th>\
			                    			Action\
			                    		</th>\
			                    	</tr>';
			                    	return html;
}

$(document).ready(function(){
	$('.filterByDate').on('click',function(){
		 var date_start=$('.date_start').val();
		 var date_end=$('.date_end').val();
		 var param={'func':'getOrderDatewise','from':date_start,'to':date_end};
		 $.post('<?php echo base_url(); ?>formProcessing/requestProcess.php',param,function(data){
				data=JSON.parse(data);
				datatable.clear();
				datatable.destroy();
				$('.datatable').remove();
				var html=[];
				var count=1;
				data.orders.forEach(function(x){
					if(x.status==0)
						color='';
					else if (x.status==1)
						color='green';
					else if (x.status==2)
						color='red';
					html.push("<tr class='"+color+"' data-order_id='"+x.order_id+"'><td>"+count+"</td><td>"+x.order_placed_by+"</td><td >Rs. "+x.total_price+"</td><td><a title='View detail' href='javascript:' class='item_detail'><i class='glyphicon glyphicon-list-alt'></i></a>");
					if(x.status==0 || x.status==2)
					html.push("<a title='Approve' href='javascript:' class='item_approve'><i class='glyphicon glyphicon-ok'></i></a>");
					if(x.status==0 || x.status==1)
					html.push("<a title='Reject' href='javascript:' class='item_reject'><i class='glyphicon glyphicon-remove'></i></a>");
					html.push('</td></tr>');


					count++;
				})

				heading=getHeadings();
				$('.reportDetail').append("<table class='datatable table table-striped table-bordered table-hover'><thead>"+heading+"</thead><tbody></tbody><tfoot>"+heading+"</tfoot></table>");
				$('.datatable tbody').html('');
				// resetTableHeader();
				$('.datatable tbody').html(html.join(""));
				//datatable.draw()
				datatable="";
	  			datatable=$('.datatable').DataTable({
                    responsive: true,
                    "bSort" : false,
                    fnDrawCallback:bindEvent
            	});

	  			$('.legends').show();
	  			$('.reportSummary').show();
	  			$('.reportDetail').show();

	  			$('.totalCollection').text(data.detail.totalCollection);
	  			$('.totalApproved').text(data.detail.totalApprovedorder);
	  			$('.totalRejected').text(data.detail.totalRejectedorder);
	  			$('.totalOrder').text(data.detail.totalorder);
		});
	})
})



var bindEvent=function(){
	$('.item_approve').on('click',function(){
			var orderid=$(this).parents('tr').attr('data-order_id');
			var param={'order_id':orderid,'status':1};
			$.post('<?php echo base_url(); ?>formProcessing/requestProcess.php?func=approveReject_order',param,function(data){
				$('.filterByDate').trigger('click');
			});
		})
	$('.item_reject').on('click',function(){
			var orderid=$(this).parents('tr').attr('data-order_id');
			var param={'order_id':orderid,'status':2};
			$.post('<?php echo base_url(); ?>formProcessing/requestProcess.php?func=approveReject_order',param,function(data){
				$('.filterByDate').trigger('click');
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
</script>