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

    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet">


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
      <li class="active">Grafik</li>
    </ol>
  </section>




  <div class="col-md-12" style="margin-top:-100px;">
    <div class="col-md-2">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a data-toggle="pill" href="#jalan_nasionaln">Jalan Nasional</a></li>
        <li><a data-toggle="pill" href="#jalan_provinsin">Jalan Provinsi</a></li>
        <li><a data-toggle="pill" href="#jalan_permukimann">Jalan Permukiman</a></li>
        <li><a data-toggle="pill" href="#air_bersihn">Air</a></li>
        <li><a data-toggle="pill" href="#irigasin">Irigasi</a></li>
        <li><a data-toggle="pill" href="#jembatann">Jembatan</a></li>
        <li><a data-toggle="pill" href="#sanitasin">Sanitasi</a></li>
        <li><a data-toggle="pill" href="#pelabuhann">Pelabuhan</a></li>
        <li><a data-toggle="pill" href="#terminaln">Terminal</a></li>
        <li><a data-toggle="pill" href="#stasiunn">Stasiun</a></li>
        <li><a data-toggle="pill" href="#bandaran">Bandara</a></li>
        <li><a data-toggle="pill" href="#sungain">Sungai</a></li>
        <li><a data-toggle="pill" href="#sungaipoln">Sungai Pol</a></li>
        <li><a data-toggle="pill" href="#toln">TOL</a></li>
        <li><a data-toggle="pill" href="#kebencanaann">Kebencanaan</a></li>
        <li><a data-toggle="pill" href="#penataan_ruangn">Penataan Ruang</a></li>
        <li><a data-toggle="pill" href="#greenhousen">Penurunan Greenhouse</a></li>
        <li><a data-toggle="pill" href="#kawasan_kumuhn">Kawasan Kumuh</a></li>

      </ul>
    </div>
    
    <div class="col-md-10">
      <div class="tab-content">
        <div id="jalan_nasionaln" class="tab-pane fade in active">
          <h3>Jalan Nasional</h3>
          <div class="row">
            <div class="col-md-12 ">
              <div id="jalan_nasional" style="width: 800px; height: 500px;"></div>
            </div>
          </div>
          
                    <div class="row">
              <div class="col-md-12">
                        <table id="jalan_nasional_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Jalan</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($jalan_nasional_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['jalan_nama_ruas']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div>
        <div id="jalan_provinsin" class="tab-pane fade">
          <h3>Jalan Provinsi</h3>
          <div class="row">
            <div class="col-md-12 ">
              <div id="jalan_provinsi" style="width: 800px; height: 500px;"></div>
            </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                        <table id="jalan_provinsi_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Jalan</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($jalan_provinsi_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['jalan_nama_ruas']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
          
        </div>
        <div id="jalan_permukimann" class="tab-pane fade">
          <h3>Jalan Permukiman</h3>
          <div class="row">
            <div class="col-md-12 ">
              <div id="jalan_permukiman" style="width: 800px; height: 500px;"></div>
            </div>
          </div>
                    <div class="row">
              <div class="col-md-12">
                        <table id="jalan_permukiman_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Jalan</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($jalan_permukiman_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['jalan_nama_ruas']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div>
        <div id="air_bersihn" class="tab-pane fade">
          <h3>Air Bersih</h3>
            <div class="row">
            <div class="col-md-12 ">
              <div id="air_bersih" style="width: 800px; height: 500px;"></div>
            </div>
          </div>
              <div class="row">
              <div class="col-md-12">
                        <table id="air_bersih_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Daerah</th>
                   <th>Tahun</th>
                   <th>Volume Penangan (km)</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($air_bersih_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['text_kecamatan']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vpenanganan']." km"; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div>  
        
          
              <div id="irigasin" class="tab-pane fade">
          <h3>Irigasi</h3>
            <div class="row">
            <div class="col-md-12 ">
              <div id="irigasi" style="width: 800px; height: 500px;"></div>
            </div>
          </div>
              <div class="row">
              <div class="col-md-12">
                        <table id="irigasi_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Irigasi</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan (ha)</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($irigasi_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['nama']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']." ha"; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div>
        
                <div id="jembatann" class="tab-pane fade">
          <h3>Jembatan</h3>
            <div class="row">
            <div class="col-md-12 ">
              <div id="jembatan" style="width: 800px; height: 500px;"></div>
            </div>
          </div>
              <div class="row">
              <div class="col-md-12">
                        <table id="jembatan_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Jembatan</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan (km)</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($jembatan_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['field5']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div>
        
        <div id="sanitasin" class="tab-pane fade">
          <h3>Sanitasi</h3>
            <div class="row">             
            <div class="col-md-12 ">               
            <div id="sanitasi" style="width: 800px; height: 500px;"></div>
            </div>           
            </div>
                <div class="row">
              <div class="col-md-12">
                        <table id="sanitasi_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Sanitasi</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($sanitasi_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['text_kecamatan']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div>
        
        

        <div id="pelabuhann" class="tab-pane fade">
          <h3>Pelabuhan</h3>
             <div class="row">             
            <div class="col-md-12 ">               
            <div id="pelabuhan" style="width: 800px; height: 500px;"></div>
            </div>           
            </div>
                <div class="row">
              <div class="col-md-12">
                        <table id="pelabuhan_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Pelabuhan</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($pelabuhan_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['nama_termi']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div>
        <div id="terminaln" class="tab-pane fade">
          <h3>Terminal</h3>
             <div class="row">             
            <div class="col-md-12 ">               
            <div id="terminal" style="width: 800px; height: 500px;"></div>
            </div>           
            </div>
                <div class="row">
              <div class="col-md-12">
                        <table id="terminal_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Terminal</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($terminal_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['nama_termi']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div>
        <div id="stasiunn" class="tab-pane fade">
          <h3>Stasiun</h3>
            <div class="row">            
            <div class="col-md-12 ">               
            <div id="stasiun" style="width: 800px; height: 500px;"></div>             </div>          
            </div>
                <div class="row">
              <div class="col-md-12">
                        <table id="stasiun_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Stasiun</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($stasiun_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['nama_termi']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div>
        <div id="bandaran" class="tab-pane fade">
          <h3>Bandara</h3>
             <div class="row">             
            <div class="col-md-12 ">               
            <div id="bandara" style="width: 800px; height: 500px;"></div>
            </div>           
            </div>
                <div class="row">
              <div class="col-md-12">
                        <table id="bandara_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Bandara</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($bandara_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['nama_termi']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div>
        <div id="sungain" class="tab-pane fade">
          <h3>Sungai</h3>
             <div class="row">             
            <div class="col-md-12 ">               
            <div id="sungai" style="width: 800px; height: 500px;"></div>
            </div>           
            </div>
                <div class="row">
              <div class="col-md-12">
                        <table id="sungai_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Sungai</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($sungai_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['text_sungai']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div>
        <div id="sungaipoln" class="tab-pane fade">
          <h3>Sungai Pol</h3>
            <div class="row">            
            <div class="col-md-12 ">              
            <div id="sungaipol" style="width: 800px; height: 500px;"></div>             </div>       
            </div>
                <div class="row">
              <div class="col-md-12">
                        <table id="sungaipol_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Sungai Poly</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($sungaipol_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['namasungai']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div>
        
        
        <div id="toln" class="tab-pane fade">
          <h3>Tol</h3>
           <div class="row">             
            <div class="col-md-12 ">               
            <div id="tol" style="width: 800px; height: 500px;"></div>
            </div>           
            </div>
                <div class="row">
              <div class="col-md-12">
                        <table id="tol_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Tol</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($tol_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['ruas']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div> 
        <div id="kebencanaann" class="tab-pane fade">
          <h3>Kebencanaan</h3>
            <div class="row">             
            <div class="col-md-12 ">               
            <div id="kebencanaan" style="width: 800px; height: 500px;"></div>
            </div>           
            </div>
        </div>
        <div id="penataan_ruangn" class="tab-pane fade">
          <h3>Penataan Ruang</h3>
            <div class="row">             <div class="col-md-12 ">               <div id="penataan_ruang" style="width: 800px; height: 500px;"></div>             </div>           </div>
        </div>
        <div id="greenhouse" class="tab-pane fade">
          <h3>Green House</h3>
             <div class="row">             
            <div class="col-md-12 ">               
            <div id="greenhouse" style="width: 800px; height: 500px;"></div>
            </div>           
            </div>
        </div> 
        
              
        <div id="kawasan_kumuhn" class="tab-pane fade">
          <h3>Kawasan Kumuh</h3>
             <div class="row">             
            <div class="col-md-12 ">               
            <div id="kawasan_kumuh" style="width: 800px; height: 500px;"></div>
            </div>           
            </div>
                <div class="row">
              <div class="col-md-12">
                        <table id="kawasan_kumuh_t" class="table table-striped table-bordered">
               <thead>
               <tr>
                   <th>Nama Kawasan Kumuh</th>
                   <th>Tahun</th>
                   <th>Volume Efektif</th>
                   <th>Volume Penangan</th>
                   <th>Target</th>
               </tr>
               </thead>
               <tbody>
               <?php foreach($kawasan_kumuh_table->result_array() as $i ) : ?>
                  <tr>
                   <th><?= $i['nama_kaw']; ?></th>
                   <th><?= $i['historis_tahun']; ?></th>
                   <th><?= $i['historis_vefektif']; ?></th>
                   <th><?= $i['historis_vpenanganan']; ?></th>
                   <th><?= $i['target_volume']; ?></th>
               </tr>
               <?php endforeach; ?>
               </tbody>
           </table>
              </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>

</body>
</html>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>



<script>
    $(document).ready(function() {
    $('#jalan_nasional_t').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    $('#jalan_provinsi_t').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    $('#jalan_permukiman_t').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    
    $('#air_bersih_t').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    $('#irigasi_t').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    $('#jembatan_t').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    
    $('#pelabuhan_t').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    $('#terminal_t').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    $('#bandara_t').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    
    $('#stasiun_t').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    $('#sungai_t').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    $('#sungaipol_t').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    $('#kawasan_kumuh_t').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>


<?php $this->load->view('frontend/grafik/modals/jalan_provinsi'); ?>
<?php $this->load->view('frontend/grafik/modals/jalan_nasional'); ?>
<?php $this->load->view('frontend/grafik/modals/jalan_permukiman'); ?>
<?php $this->load->view('frontend/grafik/modals/air_bersih'); ?>
<?php $this->load->view('frontend/grafik/modals/irigasi'); ?>
<?php $this->load->view('frontend/grafik/modals/jembatan'); ?>
<?php $this->load->view('frontend/grafik/modals/sanitasi'); ?>
<?php $this->load->view('frontend/grafik/modals/sungai'); ?>
<?php $this->load->view('frontend/grafik/modals/sungaipol'); ?>
<?php $this->load->view('frontend/grafik/modals/tol'); ?>
<?php $this->load->view('frontend/grafik/modals/pelabuhan'); ?>
<?php $this->load->view('frontend/grafik/modals/terminal'); ?>
<?php $this->load->view('frontend/grafik/modals/stasiun'); ?>
<?php $this->load->view('frontend/grafik/modals/bandara'); ?>
<?php $this->load->view('frontend/grafik/modals/kawasan_kumuh'); ?>


