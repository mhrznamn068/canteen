 <?php
    include('../class/canteenmgmt.php');
    include('../class/orderHelper.php');
    include('partials/header.php');
    include('partials/sidebar.php');
 ?>      
 
    <div id="wrapper">

       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                 	
                    <h1 class="page-header">Orders  </h1>

                </div>
                <!-- /.col-lg-12 -->
            </div>  
            <div class="row">
               <div class="col-lg-12">
                    <div class="panel panel-default">
                       
                  		<div class="panel-body tableContainer">
                            <div class="dataTable_wrapper ">

                            <div class="filter_table">
                             	<select class="form-control items" name="items" id="sel1">
                                    <option value="0">Filter orders</option>
                                  	<option>Pending</option>
	                            	<option>Approved</option>
	                            	<option>Rejected</option>
                          		</select>
                            </div>
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
		                    		foreach($orders->getAllOrders() as $key=>$order){
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
	                       
                					Lengends
                					<div><div class="legenddiv pending"></div><div class="legendTitle">Pending</div> <div class="clear"></div></div><div><div class="legenddiv green"></div><div class="legendTitle">Approved</div> <div class="clear"></div></div>
                					<div><div class="legenddiv red"></div><div class="legendTitle">Rejected</div> <div class="clear"></div></div>
                					
                					
                			</div>
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
var loadType="<?php echo (isset($_GET['display'])) ? $_GET['display'] : ''  ?>";
if(loadType=='pending'){
	$('.filter_table').remove();
	$('.legends').remove();
}

var loadOrders=function(){
	loadType="<?php echo (isset($_GET['display'])) ? $_GET['display'] : ''  ?>";
	switch(loadType){
		case 'pending':
			loadType=0;
			break;
		case 'rejected':
			loadType=2;
			break;
		case 'approved':
			loadType=0;
		default:
			loadType=3;
	}
	var param={'ordertype':loadType};
	$.get('<?php echo base_url(); ?>formProcessing/requestProcess.php?func=getAllOrders',param,function(data){
		data=JSON.parse(data);
		datatable.clear();
		datatable.destroy();
		$('.datatable').remove();
		var html=[];
		var count=1;
		data.forEach(function(x){
			if(x.status==0)
		                    				color='';
		                    			else if (x.status==1)
		                    				color='green';
		                    			else if (x.status==2)
		                    				color='red';
				html.push("<tr class='"+color+"' data-order_id='"+x.order_id+"'><td>"+count+"</td><td>"+x.order_placed_by+"</td><td >Rs. "+x.total_price+"</td><td><a title='View detail' href='javascript:' class='item_edit'><i class='glyphicon glyphicon-list-alt'></i></a>");
			if(x.status==0 || x.status==2)
				html.push("<a title='Approve' href='javascript:' class='item_approve'><i class='glyphicon glyphicon-ok'></i></a>");
			if(x.status==0 || x.status==1)
				html.push("<a title='Reject' href='javascript:' class='item_reject'><i class='glyphicon glyphicon-remove'></i></a>");
			html.push('</td></tr>');


			count++;
		})

		heading=getHeadings();
		$('.tableContainer').append("<table class='datatable table table-striped table-bordered table-hover'><thead>"+heading+"</thead><tbody></tbody><tfoot>"+heading+"</tfoot></table>");
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

	});
}

$(document).ready(function(){
	var loadType="<?php echo (isset($_GET['display'])) ? $_GET['display'] : ''  ?>";
	if(loadType=='pending'){
		setInterval(loadOrders,2000);
	}
})

var bindEvent=function(){
	$('.item_approve').on('click',function(){
			var orderid=$(this).parents('tr').attr('data-order_id');
			var param={'order_id':orderid,'status':1};
			$.post('<?php echo base_url(); ?>formProcessing/requestProcess.php?func=approveReject_order',param,function(data){
				loadOrders();
			});
		})
	$('.item_reject').on('click',function(){
			var orderid=$(this).parents('tr').attr('data-order_id');
			var param={'order_id':orderid,'status':2};
			$.post('<?php echo base_url(); ?>formProcessing/requestProcess.php?func=approveReject_order',param,function(data){
				loadOrders();
			});
		})
}

	
</script>