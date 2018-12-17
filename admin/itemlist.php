 <?php
    include('../class/canteenmgmt.php');
    include('../class/itemhelper.php');
    include('../class/categoryHelper.php');
    include('partials/header.php');
    include('partials/sidebar.php');
 ?>      
 
    <div id="wrapper">

       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                 	
                    <h1 class="page-header">Items <span class='font-small add_new_item'>[ Add ]</span> </h1>

                </div>
                <!-- /.col-lg-12 -->
            </div>  
            <div class="row">
               <div class="col-lg-12">
                    <div class="panel panel-default">
                       
                  		<div class="panel-body">
                            <div class="dataTable_wrapper ">
		                    <table class="datatable table table-striped table-bordered table-hover">
		                    	<thead>
			                    	<tr>
			                    		<th>
			                    			S.N.
			                    		</th>
			                    		<th>
			                    			Item
			                    		</th>
			                    		<th>
			                    			Category
			                    		</th><th>
			                    			Action
			                    		</th>
			                    	</tr>
		                    	</thead>
		                    	<tbody>
		                    	<?php
		                    	$count=1;
		                    		foreach($items->getAllItems() as $key=>$item){
		                    			echo "
		                    				<tr data-item_price='".$item['item_price']."' data-item_id='".$item['item_id']."' data-isspecial='".$item['is_special']."'>
		                    					<td>$count</td>
		                    					<td>".$item['item_title']."</td>
		                    					<td  data-selected='".$item['category_id']."'>".$item['category_title']."</td>
		                    					<td>
		                    						<a title='Edit' href='javascript:' class='item_edit'><i class='glyphicon glyphicon-edit'></i></a>
		                    					";	
		                    					if($item['item_status']==1)	
		                    						echo "<a title='Deactivate' href='javascript:' class='deactivate_item'><i class='glyphicon glyphicon-eye-open'></i></a>";
												else
													echo "<a title='Activate' href='javascript:' class='activate_item'><i class='glyphicon glyphicon-eye-close'></i></a>";
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
			                    			Item
			                    		</th>
			                    		<th>
			                    			Category
			                    		</th><th>
			                    			Action
			                    		</th>
			                    	</tr>
		                    	</tfoot>
		                    </table>
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
        <h4 class="modal-title">Add Item</h4>
      </div>
      <div class="modal-body">
        		<div class="row">
        			 <div class="col-lg-12">
        				<form class="item_form" role='form'>
        					<input type="hidden" name="item_id" class="item_id" value="0">
        					<input type="hidden" name="func" value="addItem">
        			 		 <fieldset>
                                <div class="form-group">
                                    <input class="form-control item_title" placeholder="Item title" name="item_title" type="text" autofocus>
                                </div> 
                                <div class="form-group">
                                    <input class="form-control item_price" placeholder="Item price" name="item_price" type="text" autofocus>
                                </div>
                                <div class="form-group">
								  <select class="form-control item_category" name="item_category" id="sel1">
								  		<option value="0">Select Category</option>
									   <?php
									   		foreach($categories->getAllCategories() as $cat){

									   			echo "<option value='".$cat['category_id']."'>".$cat['category_title']."</option>";
									   		}
									   ?>
								  </select>
								</div>
								 <div class="checkbox">
                                    <label>
                                        <input name="is_special" class="is_special" type="checkbox" value="1">Is special
                                    </label>
                                </div>
                            </fieldset>
        				</form>
        			 </div>
        		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default save_item" >Save</button>
      </div>
    </div>

  </div>
</div>


<script>


	var bindEvent=function(){

		$('.deactivate_item').on('click',function(){
			var item_id=$(this).parents('tr').attr('data-item_id');
			var param={'item_id':item_id,'func':'activateDeactivateItem','status':0}
			$.post('<?php echo base_url(); ?>formProcessing/requestProcess.php',param,function(data){
				loadAllItems();
			});

		})

		$('.activate_item').on('click',function(){
			var item_id=$(this).parents('tr').attr('data-item_id');
			var param={'item_id':item_id,'func':'activateDeactivateItem','status':1}
			$.post('<?php echo base_url(); ?>formProcessing/requestProcess.php',param,function(data){
				loadAllItems();
			});

		})

		$('.item_edit').on('click',function(){
			resetForm();
			var item_title=$(this).parents('tr').find('td:nth-child(2)').text();
			var item_cat=$(this).parents('tr').find('td:nth-child(3)').attr('data-selected');
			var item_special=$(this).parents('tr').attr('data-isspecial');
			var item_id=$(this).parents('tr').attr('data-item_id');
			var item_price=$(this).parents('tr').attr('data-item_price');
			$('.item_title').val(item_title);
			$('.item_category').val(item_cat);
			$('.item_id').val(item_id);
			$('.item_price').val(item_price);

			if(item_special==1)
				$('.is_special').prop('checked','checked');
			else
				$('.is_special').prop('checked',false);

			$('#myModal').modal('show')
		})

	}


	var resetForm=function(){
		$('.item_title').val('');
		$('.item_price').val('');
		$('.item_category').val(0);
		$('.item_id').val('0');
		$('.is_special').attr('checked',false);
	}




	var loadAllItems=function(){
		$.post('<?php echo base_url(); ?>formProcessing/requestProcess.php',{'func':'getallitems'},function(data){
			regenerateTable(JSON.parse(data));
		});
	}
var regenerateTable=function(data){
		datatable.clear();
		datatable.destroy();
		var html=[];
		var count=1;
		data.forEach(function(x){
			html.push("<tr  data-item_price='"+x.item_price+"'   data-item_id='"+x.item_id+"' data-isspecial='"+x.is_special+"'><td>"+count+"</td><td>"+x.item_title+"</td><td data-selected='"+x.category_id+"'>"+x.category_title+"</td><td><a title='Edit' href='javascript:' class='item_edit'><i class='glyphicon glyphicon-edit'></i></a>");
			if(x.item_status==1)
				html.push("<a title='Deactivate' href='javascript:' class='deactivate_item'><i class='glyphicon glyphicon-eye-open'></i></a>");
			else
				html.push("<a title='Activate' href='javascript:' class='activate_item'><i class='glyphicon glyphicon-eye-close'></i></a>");
			html.push('</td></tr>');
			count++;
		})
		$('.datatable tbody').html('');
		resetTableHeader();
		$('.datatable tbody').html(html.join(""));
		//datatable.draw()
		 datatable="";
		  datatable=$('.datatable').DataTable({
                    responsive: true,
                    fnDrawCallback:bindEvent
            });
		
		 $('#myModal').modal('hide')
	}

	
	var resetTableHeader=function(){
		html=[];
		html.push('<th>S.N.</th>');
		html.push('<th>Item</th>');
		html.push('<th>Category</th>');
		html.push('<th>Action</th>');
		$('.dataTable thead').html(html.join(""));
		$('.dataTable tfoot').html(html.join(""));
	}
$(document).ready(function(){


	

	$('.save_item').on('click',function(){


			$.post('<?php echo base_url(); ?>formProcessing/requestProcess.php',$('.item_form').serialize(),function(data){
				loadAllItems();
			})

		})


	$('.add_new_item').on('click',function(){
		resetForm();
		// alert('add new');
		$('#myModal').modal('show')
	})
	bindEvent();

})

</script>