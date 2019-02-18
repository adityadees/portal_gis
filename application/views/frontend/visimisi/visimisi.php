<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= get_option('site_description'); ?>">
  <meta name="keywords" content="<?= get_option('keywords'); ?>">
  <meta name="author" content="<?= get_option('author'); ?>">

  <title> <?= isset($title) ? $title : site_name() ?></title>

  <link href="<?= theme_asset(); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?= theme_asset(); ?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

  <link href="<?= theme_asset(); ?>/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <link href="<?= theme_asset(); ?>/css/creative.css" rel="stylesheet">

  <link rel="stylesheet" href="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>flag-icon/css/flag-icon.css" rel="stylesheet" media="all" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

      <script src="<?= theme_asset(); ?>/vendor/jquery/jquery.min.js"></script>
      <style>
      #map{
       border: 1px solid #C0C0C0;
       width: 100%;
       height: 500px;
     }

     .gm-style-iw {
      width: 300px; 
      min-height: 150px;
    }


    .material-switch > input[type="checkbox"] {
      display: none;   
    }

    .material-switch > label {
      cursor: pointer;
      height: 0px;
      position: relative; 
      width: 40px;  
    }

    .material-switch > label::before {
      background: rgb(0, 0, 0);
      box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
      border-radius: 8px;
      content: '';
      height: 16px;
      margin-top: -8px;
      position:absolute;
      opacity: 0.3;
      transition: all 0.4s ease-in-out;
      width: 40px;
    }
    .material-switch > label::after {
      background: rgb(255, 255, 255);
      border-radius: 16px;
      box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
      content: '';
      height: 24px;
      left: -4px;
      margin-top: -8px;
      position: absolute;
      top: -4px;
      transition: all 0.3s ease-in-out;
      width: 24px;
    }
    .material-switch > input[type="checkbox"]:checked + label::before {
      background: inherit;
      opacity: 0.5;
    }
    .material-switch > input[type="checkbox"]:checked + label::after {
      background: inherit;
      left: 20px;
    }
    
    .tab-content > .tab-pane:not(.active) {
      display: block;
      height: 0;
      overflow-y: hidden;
    }
  </style>
</head>




<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
      </button>
      <a class="navbar-brand page-scroll" href="#page-top"><?= site_name(); ?></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <?php foreach (get_menu('top-menu') as $menu):?>
          <li>
            <a class="page-scroll" href="<?= site_url($menu->link); ?>"><?= $menu->label; ?></a>
          </li>
        <?php endforeach; ?>
        <?php if (!app()->aauth->is_loggedin()): ?>
        <li>
          <a class="page-scroll" href="<?= site_url('administrator/login'); ?>"><i class="fa fa-sign-in"></i> <?= cclang('login'); ?></a>
        </li>
        <?php else: ?>
          <li>
            <a class="page-scroll dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
              <img src="<?= BASE_URL.'uploads/user/'.(!empty(get_user_data('avatar')) ? get_user_data('avatar') :'default.png'); ?>" class="img-circle img-user" alt="User Image"> 
              <?= get_user_data('full_name'); ?>
              <span class="caret"></span>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="<?= site_url('administrator/user/profile'); ?>">My Profile</a>
              <a class="dropdown-item" href="<?= site_url('administrator/dashboard'); ?>">Dashboard</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?= site_url('administrator/auth/logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
          </li>
        <?php endif; ?>
        <li class="dropdown ">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
           <span class="flag-icon <?=get_current_initial_lang(); ?>"></span> <?= get_current_lang(); ?> </a>
           <ul class="dropdown-menu" role="menu">
             <?php foreach (get_langs() as $lang): ?>
               <li><a href="<?= site_url('web/switch_lang/'.$lang['folder_name']); ?>"><span class="flag-icon <?= $lang['icon_name']; ?>"></span> <?= $lang['name']; ?></a></li>
             <?php endforeach; ?>
           </ul>
         </li>
       </ul>
     </div>
   </div>
 </nav>

 <body>
     
  <div class="content-wrapper">
   <section class="content-header" style="margin-top:-50px;">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Visi Misi</li>
    </ol>
  </section>

<section id="services" style="margin-top:-220px;">         
<div class="container ui-sortable" style="">            

<div class="row text-center ui-sortable" style="">
<div class="col-md-12 ui-sortable" style="">
<p class="text-muted" style=""> <img src="<?= base_url()?>asset/img/visi.png" class="img-responsive"></p>
</div>

<div class="col-md-12 ui-sortable" style="">
<p class="text-muted" style=""> 
<br>
<img src="<?= base_url()?>asset/img/misi.png" class="img-responsive">
</p>
</div>
</div>
</div>
</section>
          

  </div> 


</body>
</html>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



