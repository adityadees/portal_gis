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
        height: 100%;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      .gm-style-iw {
        width: 300px; 
        min-height: 150px;
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
    <div id="map"></div>
    <script>
      var map;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: -2.9365327, lng: 104.4950964}
        });
        var infowindow = new google.maps.InfoWindow();

        var data_layer = new google.maps.Data({map: map});
        var data_layer_2 = new google.maps.Data({map: map});
        var data_layer_3 = new google.maps.Data({map: map});
        var data_layer_4 = new google.maps.Data({map: map});
        var data_layer_5 = new google.maps.Data({map: map});
        var data_layer_6 = new google.maps.Data({map: map});
        var data_layer_7 = new google.maps.Data({map: map});
        var data_layer_8 = new google.maps.Data({map: map});
        var data_layer_9 = new google.maps.Data({map: map});
        var data_layer_10 = new google.maps.Data({map: map});
        var data_layer_11 = new google.maps.Data({map: map});
        data_layer.loadGeoJson(
          '<?= base_url(); ?>/asset/mapgeojson/hasiljson/air_bersih_sumsel.geojson');
        data_layer_2.loadGeoJson(
          '<?= base_url(); ?>/asset/mapgeojson/hasiljson/bendung_di_sumsel.geojson');

        data_layer_2.loadGeoJson(
          '<?= base_url(); ?>/asset/mapgeojson/hasiljson/di DI_Prov.Sumsel_Join.geojson');

        data_layer_3.loadGeoJson(
          '<?= base_url(); ?>/asset/mapgeojson/hasiljson/jalan 2019 jalan_2019.geojson');

        data_layer_4.loadGeoJson(
          '<?= base_url(); ?>/asset/mapgeojson/hasiljson/jalan_50K.geojson');

        data_layer_5.loadGeoJson(
          '<?= base_url(); ?>/asset/mapgeojson/hasiljson/Jembatan_PT_250K.geojson');

        data_layer_6.loadGeoJson(
          '<?= base_url(); ?>/asset/mapgeojson/hasiljson/rp_jan2016.geojson');

        data_layer_7.loadGeoJson(
          '<?= base_url(); ?>/asset/mapgeojson/hasiljson/Sanitasi_Sumsel.geojson');

        data_layer_8.loadGeoJson(
          '<?= base_url(); ?>/asset/mapgeojson/hasiljson/stanplat.geojson');

        data_layer_9.loadGeoJson(
          '<?= base_url(); ?>/asset/mapgeojson/hasiljson/sungai_l.geojson');

        data_layer_10.loadGeoJson(
          '<?= base_url(); ?>/asset/mapgeojson/hasiljson/sungai_poly.geojson');

        data_layer_11.loadGeoJson(
          '<?= base_url(); ?>/asset/mapgeojson/hasiljson/Tol_LN_2017_Sumatera_Selatan_PUBMTR_geo.geojson');


        data_layer.setStyle({
          fillColor: 'green',
          strokeWeight: 1
        });
        data_layer_2.setStyle({
          fillColor: 'blue',
          strokeWeight: 2
        });

        map.data.loadGeoJson('<?= base_url(); ?>/asset/mapgeojson/newjson.geojson');

        var ced = google.maps.event.addListener(map.data, 'click', function(event) {
          var aab=event.feature.f;
          infowindow.setContent('<div class="col-md-12"><div class="row"><div class="col-md-12"><table class="table table-striped"><tr><th>ID</th><td>'+aab+'</td></tr><tr><th>Latitude</th><td>'+ event.latLng.lat()+'</td></tr><tr><th>Longitude</th><td>'+ event.latLng.lng()+'</td></tr></table></div></div><div class="row"><div class="col-md-12"><button type="button" class="btn btn-info col-md-12" data-toggle="modal" data-target="#myModal'+aab+'">Detail</button></div></div></div>');
          console.log(event.feature.f)
          infowindow.setPosition(event.latLng);
          infowindow.open(map);

        });
        map.data.addListener('mouseover', function (event) {
          map.data.revertStyle();
          map.data.overrideStyle(event.feature, {
            strokeColor: 'red',
            strokeWeight: 8

          });
        });

        map.data.addListener('mouseout', function (event) {
          map.data.revertStyle();
        });


      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAogXD-AHrsmnWinZIyhRORJ84bgLwDPpg&callback=initMap">
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>



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