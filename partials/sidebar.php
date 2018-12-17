  <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Canteen Management System</a>
            </div>
            <!-- /.navbar-header -->

            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
      


                          <li>
                             <a href="javascript:"><i class="fa fa-dashboard fa-fw"></i> Todays Specials</a>
                            <ul class="nav nav-second-level in itemlists">
                               
                        <?php

                            foreach($items->getSpecialItems() as $item){
                                echo "<li><a href='javascript:''>".$item['item_title']."</a> <span>Rs. ".$item['item_price']."</span></li>";
                            }
                        ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>


        <style type="text/css">
        .itemlists li{
            position: relative;
        }

        .itemlists li span{
            position: absolute;
            right: 10px;
            top:10px;
        }
        </style>