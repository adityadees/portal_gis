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



  <div class="col-md-12">
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




    
    var jalan = new google.maps.Data({map: map});
    jalan.loadGeoJson('<?= base_url(); ?>/asset/mapgeojson/geojson/jalan 2019.geojson');

    var air_bersih = new google.maps.Data({map: map});
    air_bersih.loadGeoJson('<?= base_url(); ?>/asset/mapgeojson/geojson/Air_Bersih_Sumsel_2017.geojson');

    var bendung = new google.maps.Data({map: map});
    bendung.loadGeoJson('<?= base_url(); ?>/asset/mapgeojson/geojson/Bendung_DI_Sumsel.geojson');


    var jembatan = new google.maps.Data({map: map});
    jembatan.loadGeoJson('<?= base_url(); ?>/asset/mapgeojson/geojson/Jembatan_PT_250K.geojson');


    var sanitasi = new google.maps.Data({map: map});
    sanitasi.loadGeoJson('<?= base_url(); ?>/asset/mapgeojson/geojson/Sanitasi_Sumsel.geojson');



    var stanplat = new google.maps.Data({map: map});
    stanplat.loadGeoJson('<?= base_url(); ?>/asset/mapgeojson/geojson/stanplat.geojson');


    var sungai = new google.maps.Data({map: map});
    sungai.loadGeoJson('<?= base_url(); ?>/asset/mapgeojson/geojson/sungai_l.geojson');

    var sungaipol = new google.maps.Data({map: map});
    sungaipol.loadGeoJson('<?= base_url(); ?>/asset/mapgeojson/geojson/sungai_poly.geojson');

    var tol = new google.maps.Data({map: map});
    tol.loadGeoJson('<?= base_url(); ?>/asset/mapgeojson/geojson/Tol_LN_2017_Sumatera_Selatan_PUBMTR_geo.geojson');


    var icons = {

      jembatan: {
        name: 'Jembatan',
        icon: "<?= base_url(); ?>/asset/mapgeojson/icons/bridge_modern.png"
      }, 
      bendung: {
        name: 'Bendungan',
        icon: "<?= base_url(); ?>/asset/mapgeojson/icons/waterdrop.png"
      }, 
      stanplat: {
        name: 'Air Bersih',
        icon: "<?= base_url(); ?>/asset/mapgeojson/icons/bus.png"
      },

    };


    air_bersih.setStyle({
      fillColor: 'green',
      strokeColor: 'green',
      strokeWeight: 1
    });
    jembatan.setStyle({
      fillColor: 'blue',
      strokeColor: 'blue',
      strokeWeight: 1,
      icon:icons.jembatan.icon
    });
    bendung.setStyle({
      fillColor: 'blue',
      strokeColor: 'blue',
      strokeWeight: 1,
      icon:icons.bendung.icon
    });
    stanplat.setStyle({
      fillColor: 'blue',
      strokeColor: 'blue',
      strokeWeight: 1,
      icon:icons.stanplat.icon
    });


    sanitasi.setStyle({
      fillColor: 'red',
      strokeColor: 'red',
      strokeWeight: 1
    });
    sungai.setStyle({
      fillColor: 'purple',
      strokeColor: 'purple',
      strokeWeight: 1
    });
    sungaipol.setStyle({
      fillColor: 'brown',
      strokeColor: 'brown',
      strokeWeight: 1
    });
    tol.setStyle({
      fillColor: 'cyan',
      strokeColor: 'cyan',
      strokeWeight: 4
    });


    $('#jalan').click(function(){
      jalan.setMap($(this).is(':checked') ? map : null);
    });

    $('#air_bersih').click(function(){
      air_bersih.setMap($(this).is(':checked') ? map : null);
    });
    $('#bendung').click(function(){
      bendung.setMap($(this).is(':checked') ? map : null);
    });

    $('#jembatan').click(function(){
      jembatan.setMap($(this).is(':checked') ? map : null);
    });

    $('#sanitasi').click(function(){
      sanitasi.setMap($(this).is(':checked') ? map : null);
    });
    $('#stanplat').click(function(){
      stanplat.setMap($(this).is(':checked') ? map : null);
    });
    $('#sungai').click(function(){
      sungai.setMap($(this).is(':checked') ? map : null);
    });
    $('#sungaipol').click(function(){
      sungaipol.setMap($(this).is(':checked') ? map : null);
    });
    $('#tol').click(function(){
      tol.setMap($(this).is(':checked') ? map : null);
    });

    $('#jalan,#air_bersih,#bendung,#jembatan,#sanitasi,#stanplat,#sungai,#sungaipol,#tol').removeAttr('disabled');

    $('#all').click(function(){
      jalan.setMap($(this).is(':checked') ? map : null);
      air_bersih.setMap($(this).is(':checked') ? map : null);
      bendung.setMap($(this).is(':checked') ? map : null);
      jembatan.setMap($(this).is(':checked') ? map : null);
      sanitasi.setMap($(this).is(':checked') ? map : null);
      stanplat.setMap($(this).is(':checked') ? map : null);
      sungai.setMap($(this).is(':checked') ? map : null);
      sungaipol.setMap($(this).is(':checked') ? map : null);
      tol.setMap($(this).is(':checked') ? map : null);
    });



    $(document).ready(function() {
      $('#all').click(function() {
        var checked = $(this).prop('checked');
        $('#checkboxes').find('input:checkbox').prop('checked', checked);
      });
    })



    var ced = google.maps.event.addListener(jalan, 'click', function(event) {
      var aab=event.feature.l.ID;
      infowindow.setContent('<div class="col-md-12"><div class="row"><div class="col-md-12"><table class="table table-striped"><tr><th>ID</th><td>'+aab+'</td></tr><tr><th>Latitude</th><td>'+ event.latLng.lat()+'</td></tr><tr><th>Longitude</th><td>'+ event.latLng.lng()+'</td></tr></table></div></div><div class="row"><div class="col-md-12"><button type="button" class="btn btn-info col-md-12" data-toggle="modal" data-target="#myModal'+aab+'">Detail</button></div></div></div>');
      console.log(event.feature.l)
      infowindow.setPosition(event.latLng);
      infowindow.open(map);

    });

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