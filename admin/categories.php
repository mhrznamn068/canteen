 <?php
    include('../class/canteenmgmt.php');
    include('../class/categoryHelper.php');
    include('partials/header.php');
    include('partials/sidebar.php');
 ?>      
 
    <div id="wrapper">

       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                 	
                    <h1 class="page-header">Category <span class='font-small add_new_item'>[ Add ]</span> </h1>

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
			                    			Category
			                    		</th><th>
			                    			Action
			                    		</th>
			                    	</tr>
		                    	</thead>
		                    	<tbody>
		                    	<?php
		                    	$count=1;
		                    		foreach($categories->getAllCategories() as $key=>$cat){
		                    			echo "
		                    				<tr data-category_id='".$cat['category_id']."'>
		                    					<td>$count</td>
		                    					<td >".$cat['category_title']."</td>
		                    					<td>
		                    						<a title='Edit' href='javascript:' class='item_edit'><i class='glyphicon glyphicon-edit'></i></a>
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
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">
        		<div class="row">
        			 <div class="col-lg-12">
        				<form class="item_form" role='form'>
        					<input type="hidden" name="category_id" class="category_id" value="0">
        					<input type="hidden" name="func" value="addcategory">
        			 		 <fieldset>
                                <div class="form-group">
                                    <input class="form-control cat_title" placeholder="Category title" name="cat_title" type="text" autofocus>
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
			$.post('<?php echo base_url(); ?>formProcessing/requestprocess.php',param,function(data){
				loadAllItems();
			});

		})

		$('.activate_item').on('click',function(){
			var item_id=$(this).parents('tr').attr('data-item_id');
			var param={'item_id':item_id,'func':'activateDeactivateItem','status':1}
			$.post('<?php echo base_url(); ?>formProcessing/requestprocess.php',param,function(data){
				loadAllItems();
			});

		})

		$('.item_edit').on('click',function(){
			resetForm();
			var category_title=$(this).parents('tr').find('td:nth-child(2)').text();
			var category_id=$(this).parents('tr').attr('data-category_id');
			$('.cat_title').val(category_title);
			$('.category_id').val(category_id);

			$('#myModal').modal('show')
		})

	}

	var resetForm=function(){
		$('.cat_title').val('');
		$('.category_id').val('');
	}


	var loadAllItems=function(){
		$.post('<?php echo base_url(); ?>formProcessing/requestprocess.php',{'func':'getallcategories'},function(data){
			regenerateTable(JSON.parse(data));
		});
	}


	var resetTableHeader=function(){
		html=[];
		html.push('<th>S.N.</th>');
		html.push('<th>Category</th>');
		html.push('<th>Action</th>');
		$('.dataTable thead').html(html.join(""));
		$('.dataTable tfoot').html(html.join(""));
	}

	var regenerateTable=function(data){
		datatable.clear();
		datatable.destroy();
		var html=[];
		var count=1;
		data.forEach(function(x){
			html.push("<tr  data-category_id='"+x.category_id+"'><td>"+count+"</td><td>"+x.category_title+"</td><td><a title='Edit' href='javascript:' class='item_edit'><i class='glyphicon glyphicon-edit'></i></a>");
			
			html.push('</td></tr>');
			count++;
		})
		$('.datatable tbody').html('');
		resetTableHeader();
		$('.datatable tbody').html(html.join(""));
		//datatable.draw()
		 datatable="";
		  datatable=$('.datatable').DataTable({
                    responsive: true
            });
		bindEvent();
		 $('#myModal').modal('hide')
	}


$(document).ready(function(){

	$('.save_item').on('click',function(){


			$.post('<?php echo base_url(); ?>formProcessing/requestprocess.php',$('.item_form').serialize(),function(data){
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