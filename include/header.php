<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo $gbl_sd_payment_base_url; ?>">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $gbl_site_name; ?> Site</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-formhelpers-min.css" media="screen">
<link rel="stylesheet" href="css/bootstrap-theme-min.css" media="screen">
<link rel="stylesheet" href="css/bootstrapValidator-min.css"/>
<link rel="stylesheet" href="css/daterangepicker.css"/>
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
<link rel="stylesheet" href="css/bootstrap-side-notes.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" href="css/submenu2.css">
<link rel="stylesheet" href="css/tabs.css">
<!-- <link rel="stylesheet" href="http://davidstutz.github.io/bootstrap-multiselect/css/bootstrap-multiselect.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<!--###############################################-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
<link rel="stylesheet" href="plugins/morris/morris.css">
<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
<!--###############################################-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/2.5.34/jodit.min.css">
<style type="text/css">
.col-centered {
    display:inline-block;
    float:none;
    text-align:left;
    margin-right:-4px;
}
.row-centered {
	margin-left: 9px;
	margin-right: 9px;
}
table tr td a{color: #428bca;
    text-decoration: underline;
    font-size:10px;
}
:hover.table-bordered > thead > tr > th,.table-bordered > thead > tr > th ,.table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td
{
padding:5px;font-size:11px;
}

h2, .h2 {
    font-size: 24px;
}
body {
    color: #333;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 12px;
    line-height: 1.42857;
}
rect text{display:none;}
.form-horizontal .has-feedback .form-control-feedback {
    right: 15px;
    top: -5px;
}
div.dataTables_wrapper div.dataTables_length select {
    display: inline-block;
    width: auto;
}
select.input-sm {
    height: auto;
    line-height: 30px;
}
.card-block{padding-top:10px;padding-bottom:10px;}
.bg-success {
    background-color: #5cb85c;
    color: #fff;
}
.bg-danger {
    background-color: #d9534f;
    color: #fff;
}
.bg-info {
    background-color: #5bc0de;
    color: #fff;
}
.bg-warning {
    background-color: #f0ad4e;
    color: #fff;
}

/* make sidebar nav vertical */ 
@media (min-width: 768px) {
  .sidebar-nav .navbar .navbar-collapse {
    padding: 0;
    max-height: none;
  }
  .sidebar-nav .navbar ul {
    float: none;
  }
  .sidebar-nav .navbar ul:not {
    display: block;
  }
  .sidebar-nav .navbar li {
    float: none;
    display: block;
  }
  .sidebar-nav .navbar li a {
    padding-top: 12px;
    padding-bottom: 12px;
  }
}

.fragment {
margin-left:460px;
    font-size: 14px;
    font-family: tahoma;
    background-color:#C5DAD0;
    height: auto;
    width:15%;
    border: 1px solid #ccc;
    color:#09B769;
    display: block;
    padding: 10px;
    box-sizing: border-box;
    text-decoration: none;
    position: relative;
}

.fragment1 {
margin-left:0;
margin-top:20px;
    font-size: 14px;
    font-family: tahoma;
    background-color:#C5DAD0;
    height: auto;
    width:50%;
    border: 1px solid #ccc;
    color:#09B769;
    display: block;
    padding: 10px;
    box-sizing: border-box;
    text-decoration: none;
    position: relative;
}


.fragment1:hover {

  text-decoration:none;
    color:#09B769;
}

.fragment h3 {
    padding: 0;
    margin: 0;
    color: #369;
}
.fragment h4 {
    padding: 0;
    margin: 0;
    color: #000;
}
.box-body {
    
    overflow-x: auto !important;
	padding: 15px;
}
</style>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap-min.js"></script>
<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/daterangepicker.js"></script>
<script src="js/bootstrap-formhelpers-min.js"></script>
<script type="text/javascript" src="js/bootstrapValidator-min.js"></script>
<script src="js/jquery.table2excel.js"></script>
<script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<!--####################################-->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="plugins/knob/jquery.knob.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>

<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<!--#########################################-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/2.5.34/jodit.min.js"></script>
</head>
