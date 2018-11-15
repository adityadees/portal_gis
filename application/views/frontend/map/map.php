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
        <li>
          <a class="page-scroll" href="<?= site_url('peta'); ?>">Map</a>
        </li>
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
   <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Map</li>
    </ol>
  </section>



  <div class="col-md-12" style="margin-top: -100px">
    <div class="col-md-2">
      <div class="row">

        <div class="panel panel-default">
          <div class="panel-heading">
            All
            <div class="material-switch pull-right">
              <input id="all" name="someSwitchOption001" type="checkbox" checked="checked"/>
              <label for="all" class="label-success"></label>
            </div>
          </div>
          <div id="checkboxes">

            <ul class="list-group">

              <li class="list-group-item">
                Jalan
                <div class="material-switch pull-right">
                  <input id="jalan" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="jalan" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                Air
                <div class="material-switch pull-right">
                  <input id="air_bersih" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="air_bersih" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                Bendung
                <div class="material-switch pull-right">
                  <input id="bendung" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="bendung" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                Jembatan
                <div class="material-switch pull-right">
                  <input id="jembatan" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="jembatan" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                Sanitasi
                <div class="material-switch pull-right">
                  <input id="sanitasi" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="sanitasi" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                Stanplat
                <div class="material-switch pull-right">
                  <input id="stanplat" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="stanplat" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                Sungai
                <div class="material-switch pull-right">
                  <input id="sungai" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="sungai" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                Sungai Pol
                <div class="material-switch pull-right">
                  <input id="sungaipol" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="sungaipol" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                TOL
                <div class="material-switch pull-right">
                  <input id="tol" name="someSwitchOption001" type="checkbox" checked="checked" />
                  <label for="tol" class="label-success"></label>
                </div>
              </li>


            </ul>
          </div>
          
        </div>   

      </div>
    </div>
    <div class="col-md-10">
      <div id="map"></div>
    </div>
  </div>
</div>

</body>
</html>

<script>
  var map;

  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: {lat: -2.9365327, lng: 104.4950964}
    });
    var infowindow = new google.maps.InfoWindow();

    


    <?php foreach ($map_link->result_array() as $i) : ?>
      var <?= $i['maplink_var']; ?> = new google.maps.Data({map: map});
      <?= $i['maplink_var']; ?>.loadGeoJson('<?= base_url().'/asset/mapgeojson/geojson/'.$i['maplink_url']; ?>');
    <?php endforeach; ?>

    var icons = {
      <?php foreach ($map_link->result_array() as $i) : ?>
        <?= $i['maplink_var']; ?>: {
          name: "<?= $i['maplink_nama']; ?>",
          icon: "<?= base_url(); ?>asset/mapgeojson/icons/<?= $i['maplink_icon']; ?>"
        }, 
      <?php endforeach; ?>
    };

    <?php foreach ($map_link->result_array() as $i) : ?>
     <?= $i['maplink_var']; ?>.setStyle({
      fillColor: ' <?= $i['maplink_fcolor']; ?>',
      strokeColor: ' <?= $i['maplink_scolor']; ?>',
      strokeWeight:  <?= $i['maplink_sweight']; ?>,
      <?php if($i['maplink_type']=='Markers'){ ?>icon:icons.<?= $i['maplink_var']; ?>.icon <?php } ?>
    });
   <?php endforeach; ?>

   <?php foreach ($map_link->result_array() as $i) : ?>
     $('#<?= $i['maplink_var'];?>').click(function(){
      <?= $i['maplink_var'];?>.setMap($(this).is(':checked') ? map : null);
    });
   <?php endforeach; ?>

   $('#jalan,#air_bersih,#bendung,#jembatan,#sanitasi,#stanplat,#sungai,#sungaipol,#tol').removeAttr('disabled');

   $('#all').click(function(){
    <?php foreach ($map_link->result_array() as $i) : ?>
      <?= $i['maplink_var']; ?>.setMap($(this).is(':checked') ? map : null);
      tol.setMap($(this).is(':checked') ? map : null);
    <?php endforeach; ?>
  });

   $(document).ready(function() {
    $('#all').click(function() {
      var checked = $(this).prop('checked');
      $('#checkboxes').find('input:checkbox').prop('checked', checked);
    });
  })

   <?php foreach ($map_link->result_array() as $i) : ?>
     google.maps.event.addListener(<?= $i['maplink_var']; ?>, 'click', function(event) {
      var aab=event.feature.l.ID;
      infowindow.setContent('<div class="col-md-12"><div class="row"><div class="col-md-12"><table class="table table-striped"><tr><th>ID</th><td>'+aab+'</td></tr><tr><th>Latitude</th><td>'+ event.latLng.lat()+'</td></tr><tr><th>Longitude</th><td>'+ event.latLng.lng()+'</td></tr></table></div></div><div class="row"><div class="col-md-12"><button type="button" class="btn btn-info col-md-12" data-toggle="modal" data-target="#myModal'+aab+'">Detail</button></div></div></div>');
      console.log(event.feature.l)
      infowindow.setPosition(event.latLng);
      infowindow.open(map);
    });
   <?php endforeach; ?>

   jalan.data.addListener('mouseover', function (event) {
    jalan.data.revertStyle();
    jalan.data.overrideStyle(event.feature, {
      strokeColor: 'red',
      strokeWeight: 8,
      visibility: 'off'

    });   
  });

   jalan.data.addListener('mouseout', function (event) {
    jalan.data.revertStyle();
  });


 }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAogXD-AHrsmnWinZIyhRORJ84bgLwDPpg&callback=initMap">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<?php foreach($jalan->result_array() as $i) : ?>
  <div id="myModal<?= $i['jalan_id']; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ruas Jalan</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['jalan_id']; ?>">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['jalan_id']; ?>">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['jalan_id']; ?>">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['jalan_id']; ?>" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['jalan_id']; ?></td>
              </tr>
              <tr>
                <th>Status</th>
                <td><?= $i['jalan_status'];?></td>
              </tr>
              <tr>
                <th>Fungsi</th>
                <td><?= $i['jalan_fungsi'];?></td>
              </tr>
              <tr>
                <th>Sumber</th>
                <td><?= $i['jalan_sumber'];?></td>
              </tr>
              <tr>
                <th>No. Ruas</th>
                <td><?= $i['jalan_no_ruas'];?></td>
              </tr>
              <tr>
                <th>Nama Ruas</th>
                <td><?= $i['jalan_nama_ruas'];?></td>
              </tr>
              <tr>
                <th>Panjang</th>
                <td><?= $i['jalan_panjang'];?></td>
              </tr>
              <tr>
                <th>Layer</th>
                <td><?= $i['jalan_layer'];?></td>
              </tr>
            </table> 
          </div>
          <div id="menu1<?= $i['jalan_id']; ?>" class="tab-pane fade">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Volume Efektif</th>
                  <th>Volume Penanganan</th>
                  <th>Sumber Dana</th>
                  <th>Ket</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kode=$i['jalan_id'];
                $ghistoris=$this->modelgeojson->get_data_historis($kode);
                $no=0;
                foreach ($ghistoris->result_array() as $j) :
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $j['historis_tahun']; ?></td>
                    <td><?= $j['historis_vefektif']; ?></td>
                    <td><?= $j['historis_vpenanganan']; ?></td>
                    <td><?= $j['historis_sdana']; ?></td>
                    <td><?= $j['historis_ket']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          <div id="menu2<?= $i['jalan_id']; ?>" class="tab-pane fade">
            <h5 class="text-center">Belum ada dokumentasi</h5>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php endforeach; ?>




<?php foreach($air_bersih->result_array() as $i) : ?>
  <div id="myModal<?= $i['air_bersih_id']; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Air Bersih</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['air_bersih_id']; ?>">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['air_bersih_id']; ?>">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['air_bersih_id']; ?>">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['air_bersih_id']; ?>" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['air_bersih_id']; ?></td>
              </tr>
              <tr>
                <th>kabupaten_kota</th>
                <td><?= $i['kabupaten_kota'];?></td>
              </tr>
              <tr>
                <th>kecamatan</th>
                <td><?= $i['kecamatan'];?></td>
              </tr>
              <tr>
                <th>kode_wilayah</th>
                <td><?= $i['kode_wilayah'];?></td>
              </tr>
              <tr>
                <th>kode_kecamatan</th>
                <td><?= $i['kode_kecamatan'];?></td>
              </tr>
              <tr>
                <th>text_kecamatan</th>
                <td><?= $i['text_kecamatan'];?></td>
              </tr>
              <tr>
                <th>luas</th>
                <td><?= $i['luas'];?></td>
              </tr>
              <tr>
                <th>air_bers_1</th>
                <td><?= $i['air_bers_1'];?></td>
              </tr>
            </table> 
          </div>
          <div id="menu1<?= $i['air_bersih_id']; ?>" class="tab-pane fade">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Volume Efektif</th>
                  <th>Volume Penanganan</th>
                  <th>Sumber Dana</th>
                  <th>Ket</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kode=$i['air_bersih_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_air_bersih($kode);
                $no=0;
                foreach ($ghistoris->result_array() as $j) :
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $j['historis_tahun']; ?></td>
                    <td><?= $j['historis_vefektif']; ?></td>
                    <td><?= $j['historis_vpenanganan']; ?></td>
                    <td><?= $j['historis_sdana']; ?></td>
                    <td><?= $j['historis_ket']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          <div id="menu2<?= $i['air_bersih_id']; ?>" class="tab-pane fade">
            <h5 class="text-center">Belum ada dokumentasi</h5>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php endforeach; ?>





<?php foreach($tol->result_array() as $i) : ?>
  <div id="myModal<?= $i['tol_ln_2017_sumatera_selatan_pubtr_geo_id']; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Jalan TOL</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['tol_ln_2017_sumatera_selatan_pubtr_geo_id']; ?>">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['tol_ln_2017_sumatera_selatan_pubtr_geo_id']; ?>">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['tol_ln_2017_sumatera_selatan_pubtr_geo_id']; ?>">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['tol_ln_2017_sumatera_selatan_pubtr_geo_id']; ?>" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['tol_ln_2017_sumatera_selatan_pubtr_geo_id']; ?></td>
              </tr>
              <tr>
                <th>jalanrencana</th>
                <td><?= $i['jalanrencana'];?></td>
              </tr>
              <tr>
                <th>ruas</th>
                <td><?= $i['ruas'];?></td>
              </tr>
              <tr>
                <th>status_tol</th>
                <td><?= $i['status_tol'];?></td>
              </tr>
              <tr>
                <th>pemilik</th>
                <td><?= $i['pemilik'];?></td>
              </tr>

            </table> 
          </div>
          <div id="menu1<?= $i['tol_ln_2017_sumatera_selatan_pubtr_geo_id']; ?>" class="tab-pane fade">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Volume Efektif</th>
                  <th>Volume Penanganan</th>
                  <th>Sumber Dana</th>
                  <th>Ket</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kode=$i['tol_ln_2017_sumatera_selatan_pubtr_geo_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_tol($kode);
                $no=0;
                foreach ($ghistoris->result_array() as $j) :
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $j['historis_tahun']; ?></td>
                    <td><?= $j['historis_vefektif']; ?></td>
                    <td><?= $j['historis_vpenanganan']; ?></td>
                    <td><?= $j['historis_sdana']; ?></td>
                    <td><?= $j['historis_ket']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          <div id="menu2<?= $i['tol_ln_2017_sumatera_selatan_pubtr_geo_id']; ?>" class="tab-pane fade">
            <h5 class="text-center">Belum ada dokumentasi</h5>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php endforeach; ?>




<?php foreach($bendung->result_array() as $i) : ?>
  <div id="myModal<?= $i['bendungan_id']; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Bendungan</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['bendungan_id']; ?>">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['bendungan_id']; ?>">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['bendungan_id']; ?>">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['bendungan_id']; ?>" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['bendungan_id']; ?></td>
              </tr>
              <tr>
                <th>Status</th>
                <td><?= $i['nama'];?></td>
              </tr>
              
            </table> 
          </div>
          <div id="menu1<?= $i['bendungan_id']; ?>" class="tab-pane fade">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Volume Efektif</th>
                  <th>Volume Penanganan</th>
                  <th>Sumber Dana</th>
                  <th>Ket</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kode=$i['bendungan_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_bendung($kode);
                $no=0;
                foreach ($ghistoris->result_array() as $j) :
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $j['historis_tahun']; ?></td>
                    <td><?= $j['historis_vefektif']; ?></td>
                    <td><?= $j['historis_vpenanganan']; ?></td>
                    <td><?= $j['historis_sdana']; ?></td>
                    <td><?= $j['historis_ket']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          <div id="menu2<?= $i['bendungan_id']; ?>" class="tab-pane fade">
            <h5 class="text-center">Belum ada dokumentasi</h5>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php endforeach; ?>




<?php foreach($jembatan->result_array() as $i) : ?>
  <div id="myModal<?= $i['jembatan_id']; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Jembatan</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['jembatan_id']; ?>">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['jembatan_id']; ?>">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['jembatan_id']; ?>">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['jembatan_id']; ?>" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['jembatan_id']; ?></td>
              </tr>
              <tr>
                <th>field1</th>
                <td><?= $i['field1-field18'];?></td>
              </tr>
              <tr>
                <th>filed2</th>
                <td><?= $i['filed2'];?></td>
              </tr>
              <tr>
                <th>filed3</th>
                <td><?= $i['filed3'];?></td>
              </tr>
              <tr>
                <th>filed4</th>
                <td><?= $i['filed4'];?></td>
              </tr>
              <tr>
                <th>filed5</th>
                <td><?= $i['filed5'];?></td>
              </tr>
              <tr>
                <th>filed6</th>
                <td><?= $i['filed6'];?></td>
              </tr>
              <tr>
                <th>filed7</th>
                <td><?= $i['filed7'];?></td>
              </tr>
              <tr>
                <th>filed8</th>
                <td><?= $i['filed8'];?></td>
              </tr>
              <tr>
                <th>filed9</th>
                <td><?= $i['filed9'];?></td>
              </tr>
              <tr>
                <th>filed10</th>
                <td><?= $i['filed10'];?></td>
              </tr>
              <tr>
                <th>filed11</th>
                <td><?= $i['filed11'];?></td>
              </tr>
              <tr>
                <th>filed12</th>
                <td><?= $i['filed12'];?></td>
              </tr>
              <tr>
                <th>filed13</th>
                <td><?= $i['filed13'];?></td>
              </tr>
              <tr>
                <th>filed14</th>
                <td><?= $i['filed14'];?></td>
              </tr>
              <tr>
                <th>filed15</th>
                <td><?= $i['filed15'];?></td>
              </tr>
              <tr>
                <th>filed16</th>
                <td><?= $i['filed16'];?></td>
              </tr>
              <tr>
                <th>filed17</th>
                <td><?= $i['filed17'];?></td>
              </tr>
              <tr>
                <th>filed18</th>
                <td><?= $i['filed18'];?></td>
              </tr>
            </table> 
          </div>
          <div id="menu1<?= $i['jembatan_id']; ?>" class="tab-pane fade">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Volume Efektif</th>
                  <th>Volume Penanganan</th>
                  <th>Sumber Dana</th>
                  <th>Ket</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kode=$i['jembatan_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_jembatan($kode);
                $no=0;
                foreach ($ghistoris->result_array() as $j) :
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $j['historis_tahun']; ?></td>
                    <td><?= $j['historis_vefektif']; ?></td>
                    <td><?= $j['historis_vpenanganan']; ?></td>
                    <td><?= $j['historis_sdana']; ?></td>
                    <td><?= $j['historis_ket']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          <div id="menu2<?= $i['jembatan_id']; ?>" class="tab-pane fade">
            <h5 class="text-center">Belum ada dokumentasi</h5>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php endforeach; ?>






<?php foreach($sanitasi->result_array() as $i) : ?>
  <div id="myModal<?= $i['air_bersih_id']; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sanitasi</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['air_bersih_id']; ?>">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['air_bersih_id']; ?>">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['air_bersih_id']; ?>">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['air_bersih_id']; ?>" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['air_bersih_id']; ?></td>
              </tr>
              <tr>
                <th>kabupaten_kota</th>
                <td><?= $i['kabupaten_kota'];?></td>
              </tr>
              <tr>
                <th>kecamatan</th>
                <td><?= $i['kecamatan'];?></td>
              </tr>
              <tr>
                <th>kode_wilayah</th>
                <td><?= $i['kode_wilayah'];?></td>
              </tr>
              <tr>
                <th>kode_kecamatan</th>
                <td><?= $i['kode_kecamatan'];?></td>
              </tr>
              <tr>
                <th>text_kecamatan</th>
                <td><?= $i['text_kecamatan'];?></td>
              </tr>
              <tr>
                <th>luas</th>
                <td><?= $i['luas'];?></td>
              </tr>
              <tr>
                <th>sanitasi</th>
                <td><?= $i['sanitasi'];?></td>
              </tr>
              <tr>
                <th>air_bersih</th>
                <td><?= $i['air_bersih'];?></td>
              </tr>
              <tr>
                <th>kk_mbr</th>
                <td><?= $i['kk_mbr'];?></td>
              </tr>
              <tr>
                <th>kk_nonmbr</th>
                <td><?= $i['kk_nonmbr'];?></td>
              </tr>
              <tr>
                <th>perkebunan</th>
                <td><?= $i['perkebunan'];?></td>
              </tr>
            </table> 
          </div>
          <div id="menu1<?= $i['air_bersih_id']; ?>" class="tab-pane fade">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Volume Efektif</th>
                  <th>Volume Penanganan</th>
                  <th>Sumber Dana</th>
                  <th>Ket</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kode=$i['air_bersih_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_sanitasi($kode);
                $no=0;
                foreach ($ghistoris->result_array() as $j) :
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $j['historis_tahun']; ?></td>
                    <td><?= $j['historis_vefektif']; ?></td>
                    <td><?= $j['historis_vpenanganan']; ?></td>
                    <td><?= $j['historis_sdana']; ?></td>
                    <td><?= $j['historis_ket']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          <div id="menu2<?= $i['air_bersih_id']; ?>" class="tab-pane fade">
            <h5 class="text-center">Belum ada dokumentasi</h5>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php endforeach; ?>



<?php foreach($stanplat->result_array() as $i) : ?>
  <div id="myModal<?= $i['stanplat_id']; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Stanplat</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['stanplat_id']; ?>">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['stanplat_id']; ?>">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['stanplat_id']; ?>">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['stanplat_id']; ?>" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['stanplat_id']; ?></td>
              </tr>
              <tr>
                <th>nama_terminal</th>
                <td><?= $i['nama_termi'];?></td>
              </tr>
              <tr>
                <th>klasifikasi</th>
                <td><?= $i['klasifikasi'];?></td>
              </tr>
            </table> 
          </div>
          <div id="menu1<?= $i['stanplat_id']; ?>" class="tab-pane fade">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Volume Efektif</th>
                  <th>Volume Penanganan</th>
                  <th>Sumber Dana</th>
                  <th>Ket</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kode=$i['stanplat_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_stanplat($kode);
                $no=0;
                foreach ($ghistoris->result_array() as $j) :
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $j['historis_tahun']; ?></td>
                    <td><?= $j['historis_vefektif']; ?></td>
                    <td><?= $j['historis_vpenanganan']; ?></td>
                    <td><?= $j['historis_sdana']; ?></td>
                    <td><?= $j['historis_ket']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          <div id="menu2<?= $i['stanplat_id']; ?>" class="tab-pane fade">
            <h5 class="text-center">Belum ada dokumentasi</h5>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php endforeach; ?>




<?php foreach($sungai->result_array() as $i) : ?>
  <div id="myModal<?= $i['sungai_id']; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sungai</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['sungai_id']; ?>">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['sungai_id']; ?>">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['sungai_id']; ?>">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['sungai_id']; ?>" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['sungai_id']; ?></td>
              </tr>
              <tr>
                <th>fnode_</th>
                <td><?= $i['fnode_'];?></td>
              </tr>
              <tr>
                <th>tnode</th>
                <td><?= $i['tnode'];?></td>
              </tr>
              <tr>
                <th>lpoly_</th>
                <td><?= $i['lpoly_'];?></td>
              </tr>
              <tr>
                <th>length</th>
                <td><?= $i['length'];?></td>
              </tr>
              <tr>
                <th>sungai_</th>
                <td><?= $i['sungai_'];?></td>
              </tr>
              <tr>
                <th>saluran</th>
                <td><?= $i['saluran'];?></td>
              </tr>
              <tr>
                <th>text_sungai</th>
                <td><?= $i['text_sungai'];?></td>
              </tr>
              <tr>
                <th>klasifikasi</th>
                <td><?= $i['klasifikasi'];?></td>
              </tr>
            </table> 
          </div>
          <div id="menu1<?= $i['sungai_id']; ?>" class="tab-pane fade">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Volume Efektif</th>
                  <th>Volume Penanganan</th>
                  <th>Sumber Dana</th>
                  <th>Ket</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kode=$i['sungai_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_sungai($kode);
                $no=0;
                foreach ($ghistoris->result_array() as $j) :
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $j['historis_tahun']; ?></td>
                    <td><?= $j['historis_vefektif']; ?></td>
                    <td><?= $j['historis_vpenanganan']; ?></td>
                    <td><?= $j['historis_sdana']; ?></td>
                    <td><?= $j['historis_ket']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          <div id="menu2<?= $i['sungai_id']; ?>" class="tab-pane fade">
            <h5 class="text-center">Belum ada dokumentasi</h5>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php endforeach; ?>






<?php foreach($sungaipol->result_array() as $i) : ?>
  <div id="myModal<?= $i['sungai_poly_id']; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sungai Pol</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['sungai_poly_id']; ?>">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['sungai_poly_id']; ?>">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['sungai_poly_id']; ?>">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['sungai_poly_id']; ?>" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['sungai_poly_id']; ?></td>
              </tr>
              <tr>
                <th>cbase</th>
                <td><?= $i['cbase'];?></td>
              </tr>
              <tr>
                <th>Nama Sungai</th>
                <td><?= $i['namasungai'];?></td>
              </tr>
              <tr>
                <th>Sumber</th>
                <td><?= $i['sumber'];?></td>
              </tr>
             
            </table> 
          </div>
          <div id="menu1<?= $i['sungai_poly_id']; ?>" class="tab-pane fade">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Volume Efektif</th>
                  <th>Volume Penanganan</th>
                  <th>Sumber Dana</th>
                  <th>Ket</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kode=$i['sungai_poly_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_sungaipol($kode);
                $no=0;
                foreach ($ghistoris->result_array() as $j) :
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $j['historis_tahun']; ?></td>
                    <td><?= $j['historis_vefektif']; ?></td>
                    <td><?= $j['historis_vpenanganan']; ?></td>
                    <td><?= $j['historis_sdana']; ?></td>
                    <td><?= $j['historis_ket']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          <div id="menu2<?= $i['sungai_poly_id']; ?>" class="tab-pane fade">
            <h5 class="text-center">Belum ada dokumentasi</h5>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php endforeach; ?>


