<?php
    include("..\includes\dbconnection.php");
    session_start();
    if(isset($_SESSION['admin_email']) && ($_SESSION['timeout'] + 10 * 60 > time())){
        $_SESSION['timeout'] = time();
?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Ayur Naturals</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/gentelella/1.3.0/css/custom.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'><link rel="stylesheet" href="css/index-style.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon" sizes="16x16">

  <style type="text/css">
    .stock-out-btn{
        background: #de5959;
        color: white;
    }
    .stock-in-btn{
        background: #59de81;
    }
    .stock-out-btn, .stock-in-btn{
        border: none;
        height: 50px;
        width: 80px;
    }
    .oss{
        color: red;
    }
  </style>

</head>
<body>
<!-- partial:index.partial.html -->
<body class="nav-md">

<div class="container body">
  <div class="main_container">
    <div class="col-md-3 left_col">
      <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
          <a href="index.php" class="site_title"><i class="fa fa-dashboard"></i> <span>Admin</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
          <div class="profile_pic">
            <img src="images/aditya.jpg" alt="..." class="img-circle profile_img">
          </div>
          <div class="profile_info">
            <span>Welcome,</span>
            <h2><?php echo $_SESSION['admin_email']; ?></h2>
          </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
              <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="index.php">Dashboard</a></li>
                  <li><a href="index.php?all_products">All Products</a></li>
                  <li><a href="index.php?insert_products">Insert Products</a></li>
                </ul>
              </li>
              <li><a><i class="fa fa-shopping-cart"></i> Orders <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="index.php">New Orders</a></li>
                  <li><a href="index.php?shipped_orders">Shipped Orders</a></li>
                  <li><a href="index.php?fulfilled_orders">Fulfilled Orders</a></li>
                </ul>
              </li>
              <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="index.php?update_slider">Update Slider</a></li>
                </ul>
              </li>
              <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <!-- <li><a href="tables.html">Tables</a></li>
                  <li><a href="tables_dynamic.html">Table Dynamic</a></li> -->
                </ul>
              </li>
              <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <!-- <li><a href="chartjs.html">Chart JS</a></li>
                  <li><a href="chartjs2.html">Chart JS2</a></li>
                  <li><a href="morisjs.html">Moris JS</a></li>
                  <li><a href="echarts.html">ECharts</a></li>
                  <li><a href="other_charts.html">Other Charts</a></li> -->
                </ul>
              </li>
              <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <!-- <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                  <li><a href="fixed_footer.html">Fixed Footer</a></li> -->
                </ul>
              </li>
            </ul>
          </div>
          <div class="menu_section">
            <h3>Live On</h3>
            <ul class="nav side-menu">
              <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <!-- <li><a href="e_commerce.html">E-commerce</a></li>
                  <li><a href="projects.html">Projects</a></li>
                  <li><a href="project_detail.html">Project Detail</a></li>
                  <li><a href="contacts.html">Contacts</a></li>
                  <li><a href="profile.html">Profile</a></li> -->
                </ul>
              </li>
              <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <!-- <li><a href="page_403.html">403 Error</a></li>
                  <li><a href="page_404.html">404 Error</a></li>
                  <li><a href="page_500.html">500 Error</a></li>
                  <li><a href="plain_page.html">Plain Page</a></li>
                  <li><a href="login.html">Login Page</a></li>
                  <li><a href="pricing_tables.html">Pricing Tables</a></li> -->
                </ul>
              </li>
              <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="#level1_1">Level One</a>
                    <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li class="sub_menu"><a href="level2.html">Level Two</a>
                        </li>
                        <li><a href="#level2_1">Level Two</a>
                        </li>
                        <li><a href="#level2_2">Level Two</a>
                        </li>
                      </ul>
                    </li>
                    <li><a href="#level1_2">Level One</a>
                    </li>
                </ul>
                </li>
                <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
            </ul>
          </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
          <a data-toggle="tooltip" data-placement="top" title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="Logout" href="adminn_loginn.php">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
          </a>
        </div>
        <!-- /menu footer buttons -->
      </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>

          <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="images/aditya.jpg" alt=""><?php echo $_SESSION['admin_email']; ?>
                <span class=" fa fa-angle-down"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="javascript:;"> Profile</a></li>
                <li>
                  <a href="javascript:;">
                    <span class="badge bg-red pull-right">50%</span>
                    <span>Settings</span>
                  </a>
                </li>
                <li><a href="javascript:;">Help</a></li>
                <li><a href="adminn_loginn.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
              </ul>
            </li>

            <li role="presentation" class="dropdown">
              <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-green">6</span>
              </a>
              <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                <li>
                  <a>
                    <span class="image"><img src="images/aditya.jpg" alt="Profile Image" /></span>
                    <span>
                          <span><?php echo $_SESSION['admin_email']; ?></span>
                    <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                  </a>
                </li>
                <li>
                  <a>
                    <span class="image"><img src="images/aditya.jpg" alt="Profile Image" /></span>
                    <span>
                          <span><?php echo $_SESSION['admin_email']; ?></span>
                    <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                  </a>
                </li>
                <li>
                  <a>
                    <span class="image"><img src="images/aditya.jpg" alt="Profile Image" /></span>
                    <span>
                          <span><?php echo $_SESSION['admin_email']; ?></span>
                    <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                  </a>
                </li>
                <li>
                  <a>
                    <span class="image"><img src="images/aditya.jpg" alt="Profile Image" /></span>
                    <span>
                          <span><?php echo $_SESSION['admin_email']; ?></span>
                    <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                  </a>
                </li>
                <li>
                  <div class="text-center">
                    <a>
                      <strong>See All Alerts</strong>
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
      <?php
        if(empty($_GET) or isset($_GET['default_page'])){
          include("new_orders.php");
        }elseif (isset($_GET['update_slider'])) {
          include("slider_update.php");
        }elseif(isset($_GET['insert_products'])) {
          include("insert_product.php");
        }elseif(isset($_GET['shipped_orders'])) {
          include("shipped_orders.php");
        }elseif(isset($_GET['fulfilled_orders'])) {
          include("fulfilled_orders.php");
        }elseif(isset($_GET['all_products'])) {
          include("all_products.php");
        }
      ?>
    </div>
    <!-- /page content -->


  </div>
</div>
  </body>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script><script  src="js/script.js"></script>

</body>
</html>

<?php
    }
    else{
        echo "<script>window.open('admin_login.php','_self')</script>";
    }
?>
