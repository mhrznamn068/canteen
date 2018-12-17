 <?php
    include('class/canteenmgmt.php');
    include('class/itemhelper.php');
    include('partials/header.php');
    include('partials/sidebar.php');
 ?>      
    <div id="wrapper">

       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Order placement</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel-body">
                        <div class='message-box'>
                          
                        </div>
                        <form role="form" method="post" action="formProcessing/loginProcess.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control fname" placeholder="Full name" name="uname" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control identification" placeholder="Identification number" name="identification" type="text" autofocus>
                                </div>
                                 <div class="login-panel panel panel-default" style="margin-top:0;">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Select Items</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <select class="form-control items" name="items" id="sel1">
                                                    <option value="0">Select Item</option>
                                                   <?php
                                                        foreach($items->getAllItems(1) as $item){

                                                            echo "<option data-title='".$item['item_title']."'  data-price='".$item['item_price']."' value='".$item['item_id']."'>".$item['item_title']."</option>";
                                                        }
                                                   ?>
                                              </select>
                                          </div>
                                          <div class="col-lg-3">
                                                 <button type="button" class="btn btn-default select_item" >Select Item</button>
                                          </div>
                                        </div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-lg-12">
                                                <div class="dataTable_wrapper ">
                                                    <table class="sale_item datatable table table-striped table-bordered table-hover">
                                                       
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div cols='col-lg-12' style="margin-left:10px;">
                                                Total Price : <span class='totalprice'>0</span> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success placeOrder btn-block" value="Submit" />
                                
                            </fieldset>
                        </form>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
    </div>
        <!-- /#page-wrapper -->
<?php
include('partials/footer.php');
?>


<script>
    $('.select_item').on('click',function(){
        var item=$( ".items option:selected" ).text();
        var item_price=$( ".items option:selected" ).attr('data-price');
        var itemid=$('.items').val();
        $('.sale_item').append("<tr data-item_id='"+itemid+"'><td>"+item+"</td><td>"+item_price+"</td><td><input class='form-control order-input' placeholder='Quantity' name='item_quantiry' type='text'><a href='javascript:' class='del_item'><i class='glyphicon glyphicon-remove'></i></a></td>/tr>");
        bindevent();
    })

    var bindevent=function(){
        $('.del_item').off('click').on('click',function(){

            $(this).parents('tr').remove();
            calculateTotal();
        })

        $('.order-input').on('change',function(){

                calculateTotal();
        })


    }
    var calculateTotal=function(){
        var total=0;
        $('.sale_item tr').each(function(){
            
            price=parseFloat(($(this).find('td:nth-child(2)').text())=="" ? 0 : $(this).find('td:nth-child(2)').text() );
            Quantity=parseFloat($(this).find('td:nth-child(3) input').val() == "" ? 0 : $(this).find('td:nth-child(3) input').val());
            total+= (price* Quantity);
            
        })
         $('.totalprice').text('Rs. '+total);


    }

    $('.placeOrder').on('click',function(e){
        e.preventDefault();
        var param={func:'newOrder',orders:[],fullname:'',Identification:'',totalprice:''}
        param.fullname=$('.fname').val();
        param.Identification=$('.identification').val();


        total=0;
        $('.sale_item tr').each(function(){
            var orderDetail={};
            orderDetail.item_price=parseFloat(($(this).find('td:nth-child(2)').text())=="" ? 0 : $(this).find('td:nth-child(2)').text() );
            orderDetail.item_quantity=parseFloat($(this).find('td:nth-child(3) input').val() == "" ? 0 : $(this).find('td:nth-child(3) input').val());
            orderDetail.item_id=$(this).attr('data-item_id');
            param.orders.push(orderDetail);
             total+= (orderDetail.item_price* orderDetail.item_quantity);

        })

         param.totalprice=total;

            param.orders=JSON.stringify(param.orders);
            $.post('<?php echo base_url(); ?>formProcessing/requestProcess.php',param,function(data){
                data=JSON.parse(data);
                $('.message-box').html(' <div class="alert alert-success fade in"> \
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> \
                              <strong>'+data.message+'</strong> \
                            </div>');
                resetForm();
            })

    })

    var resetForm=function(){
        $('.fname').val('');
        $('.totalprice').text(0);
        $('.identification').val('');
        $('.sale_item').html('');
        $('.items').val(0);
    }

</script>

<style>
.order-input{
    width:95%;
    display: inline;
    margin-right: 7px;
}
</style>