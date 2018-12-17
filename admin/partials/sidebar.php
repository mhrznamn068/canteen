  <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">Canteen Management System</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
          
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>formProcessing/logout.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li> -->
                        <!-- <li class="divider"></li> -->
                        <li><a href="<?php echo base_url(); ?>formprocessing/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="<?php echo base_url(); ?>admin/index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                      
                        <li>
                            <a href="<?php echo base_url(); ?>admin/itemlist.php"><i class="fa fa-files-o fa-fw"></i> Items</a>
                            
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/categories.php"><i class="fa fa-files-o fa-fw"></i> Category</a>
                            
                            <!-- /.nav-second-level -->
                        </li>  
                        <li>
                            <a href="javascript:"><i class="fa fa-files-o fa-fw"></i> Orders</a>
                            <ul class="nav nav-second-level itemlists">
                               
                                        <li><a href='<?php echo base_url(); ?>admin/orders.php?display=all'>All</a> </li>
                                        <li><a href='<?php echo base_url(); ?>admin/orders.php?display=pending'>Pending</a> </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>  
                        <li>
                            <a href="javascript:"><i class="fa fa-files-o fa-fw"></i> Reports</a>
                            <ul class="nav nav-second-level itemlists">
                               
                                        <li><a href='<?php echo base_url(); ?>admin/daily_report.php'>Daily Report</a> </li>
                                        <li><a href='<?php echo base_url(); ?>admin/datewise_report.php'>Datewise Report</a> </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>