<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>EY</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo $gbl_site_name; ?> </b>Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['admin'].' !!'; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['admin'].' !!'; ?> 
                  <!--<small>Member since Nov. 2012</small>-->
                </p>
              </li>
              <!-- Menu Body 
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="change_password.php" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="logout.php" ><i class="glyphicon glyphicon-off"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['admin'].' !!'; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
          
    
      <?php include('config/navigation.php'); ?>
      <ul class="sidebar-menu">
        <?php foreach($sitemenu as $menuitem): ?>
        <?php if(in_array($_SESSION['admin_id_level'], $menuitem['access'])): ?>
        <li class="treeview <?php echo ${$menuitem['active_flag']}; ?>">
          <a href="/<?php echo $menuitem['url']; ?>">
            <i class="fa <?php echo $menuitem['class']; ?>"></i>
            <span><?php echo $menuitem['title']; ?></span>
            <?php if(isset($menuitem['items'])): ?>
            <i class="fa fa-angle-left pull-right"></i>
            <?php endif; ?>
          </a>
          <?php if(isset($menuitem['items'])): ?>
          <ul class="treeview-menu">
            <?php foreach($menuitem['items'] as $submenu): ?>
            <li>
              <a href="/<?php echo $submenu['url']; ?>">
                <i class="fa <?php echo menu_is_active_by_file($submenu['url']); ?>"></i>
                <?php echo $submenu['title'] ?>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </li>
        <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    
    
        </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
 
      

<script type="text/javascript">

function ajaxindicatorstart(text)
{
  if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
  jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="img/ajax-loader.gif"><div>'+text+'</div></div><div class="bg"></div></div>');
  }

  jQuery('#resultLoading').css({
    'width':'100%',
    'height':'100%',
    'position':'fixed',
    'z-index':'10000000',
    'top':'0',
    'left':'0',
    'right':'0',
    'bottom':'0',
    'margin':'auto'
  });

  jQuery('#resultLoading .bg').css({
    'background':'#000000',
    'opacity':'0.7',
    'width':'100%',
    'height':'100%',
    'position':'absolute',
    'top':'0'
  });

  jQuery('#resultLoading>div:first').css({
    'width': '250px',
    'height':'75px',
    'text-align': 'center',
    'position': 'fixed',
    'top':'0',
    'left':'0',
    'right':'0',
    'bottom':'0',
    'margin':'auto',
    'font-size':'16px',
    'z-index':'10',
    'color':'#ffffff'

  });

    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop()
{
    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}
    

jQuery(document).ajaxStart(function () {
    //show ajax indicator
ajaxindicatorstart('loading data.. please wait..');
}).ajaxStop(function () {
//hide ajax indicator
ajaxindicatorstop();
});
</script>

<script>

function updatetest(mode){
if(mode)
{
mode='live';
}
else
{
mode='test';
}
$('#api_mode').val(mode);
console.log(mode);
}


//$(this).closest("form").submit();

</script>
