<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ProductStock | Dashboard
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Developed By KARTHIK PKS">
    <meta name="keywords" content="Product, Stock, Customer, Stock Managment, Responsive">
    <!-- bootstrap 3.0.2 -->
    <link href="
                <?php echo base_url().'/assets/'?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="
                <?php echo base_url().'/assets/'?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="
                <?php echo base_url().'/assets/'?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="
                <?php echo base_url().'/assets/'?>css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="
                <?php echo base_url().'/assets/'?>css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="
                <?php echo base_url().'/assets/'?>css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <!-- <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <link href="
                <?php echo base_url().'/assets/'?>css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="
                <?php echo base_url().'/assets/'?>css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="
                <?php echo base_url().'/assets/'?>css/style.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="skin-black">
    <!-- header logo: style can be found in header.less -->
    
    <header class="header">
      <a href="index.html" class="logo">
        TripperMe
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- User Information section-->
        
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation
          </span>
          <span class="icon-bar">
          </span>
          <span class="icon-bar">
          </span>
          <span class="icon-bar">
          </span>
        </a>
        <div class="navbar-right">

          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user">
                </i>
                <span>
                  <?php 
$user_display_name = ($this->session->userdata('user_display_name') ? : 'Guest ');
echo strlen($user_display_name) > 20 ? substr($user_display_name,0,20)."..." : $user_display_name;
?>
                  <i class="caret">
                  </i>
                </span>
              </a>
              <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                <li class="divider">
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-user fa-fw pull-right">
                    </i>
                    Profile
                  </a>
                  <a data-toggle="modal" href="#modal-user-settings">
                    <i class="fa fa-cog fa-fw pull-right">
                    </i>
                    Settings
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a href="
                           <?php echo base_url().'dashboard/do_logout'?>">
                    <i class="fa fa-ban fa-fw pull-right">
                    </i> Logout
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <div class="wrapper row-offcanvas row-offcanvas-left">
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="
                        <?php echo base_url().'/assets/'?>img/26115.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Hello, 
                <?php 
$user_display_name = ($this->session->userdata('user_display_name') ? : 'Guest ');
echo strlen($user_display_name) > 15 ? substr($user_display_name,0,10)."..." : $user_display_name;
?>
              </p>
              <a href="#">
                <i class="fa fa-circle text-success">
                </i> Online
              </a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat">
                  <i class="fa fa-search">
                  </i>
                </button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="active">
              <a href="index.html">
                <i class="fa fa-dashboard">
                </i>
                <span>Dashboard
                </span>
              </a>
            </li>
            <!--<li><a href="general.html"><i class="fa fa-gavel"></i><span>Reports</span></a></li>-->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <aside class="right-side">
