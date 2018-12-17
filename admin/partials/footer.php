

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() ?>themes/3rdparty/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url() ?>themes/3rdparty/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url() ?>themes/3rdparty/raphael/raphael-min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url() ?>themes/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url() ?>themes/3rdparty/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>themes/3rdparty/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>themes/3rdparty/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
     <script>
        var datatable="";
        $(document).ready(function() {
            datatable=$('.datatable').DataTable({
                    responsive: true,
                    "bSort" : false,
                    fnDrawCallback:bindEvent
            });
        });
    </script>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
     
    </div>
    <h4>All Rights Reserved @Aman</h4>
  </div>
</nav>
</body>

</html>
