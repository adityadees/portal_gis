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
          <a class="page-scroll" href="<?= site_url('grafik'); ?>">Grafik</a>
        </li>
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
                Jalan Nasional
                <div class="material-switch pull-right">
                  <input id="jalan_nasional" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="jalan_nasional" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                Jalan Provinsi
                <div class="material-switch pull-right">
                  <input id="jalan_provinsi" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="jalan_provinsi" class="label-success"></label>
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
                Pelabuhan
                <div class="material-switch pull-right">
                  <input id="pelabuhan" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="pelabuhan" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                Terminal
                <div class="material-switch pull-right">
                  <input id="terminal" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="terminal" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                Statsiun
                <div class="material-switch pull-right">
                  <input id="stasiun" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="stasiun" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                Bandara
                <div class="material-switch pull-right">
                  <input id="bandara" name="someSwitchOption001" type="checkbox" checked="checked"/>
                  <label for="bandara" class="label-success"></label>
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
              <li class="list-group-item">
                Kebencanaan
                <div class="material-switch pull-right">
                  <input id="kebencanaan" name="someSwitchOption001" type="checkbox" checked="checked" />
                  <label for="kebencanaan" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                Penataan Ruang
                <div class="material-switch pull-right">
                  <input id="penataanruang" name="someSwitchOption001" type="checkbox" checked="checked" />
                  <label for="penataanruang" class="label-success"></label>
                </div>
              </li>
              <li class="list-group-item">
                Penurunan Greenhouse
                <div class="material-switch pull-right">
                  <input id="greenhouse" name="someSwitchOption001" type="checkbox" checked="checked" />
                  <label for="greenhouse" class="label-success"></label>
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

    $('#jalan_nasional,#jalan_provinsi,#air_bersih,#bendung,#jembatan,#sanitasi,#pelabuhan,#terminal,#stasiun,#bandara,#sungai,#sungaipol,#tol').removeAttr('disabled');

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
        var idlink="<?php echo $i['maplink_var']; ?>";

        infowindow.setContent('<div class="col-md-12"><div class="row"><div class="col-md-12"><table class="table table-striped"><tr><th>ID</th><td>'+aab+'</td></tr><tr><th>Nama</th><td><?php if($i['maplink_var']=='jalan_nasional'){ ?>' +event.feature.l.Nama_Ruas+'<?php } else if($i['maplink_var']=='jalan_provinsi') {?>'+event.feature.l.Nama_Ruas+'<?php } else if($i['maplink_var']=='bendung') {?>'+event.feature.l.nama+'<?php } else if($i['maplink_var']=='jembatan') {?>'+event.feature.l.Field5+'<?php } else if($i['maplink_var']=='sanitasi') {?>'+event.feature.l.TEXT_KEC+'<?php } else if($i['maplink_var']=='pelabuhan') {?>'+event.feature.l.NAMA_TERMI+'<?php } else if($i['maplink_var']=='terminal') {?>'+event.feature.l.NAMA_TERMI+'<?php } else if($i['maplink_var']=='stasiun') {?>'+event.feature.l.NAMA_TERMI+'<?php } else if($i['maplink_var']=='bandara') {?>'+event.feature.l.NAMA_TERMI+'<?php } else if($i['maplink_var']=='sungai') {?>'+event.feature.l.TEXT_SUNGA+'<?php } else if($i['maplink_var']=='sungaipol') {?>'+event.feature.l.NAMASUNGAI+'<?php } else if($i['maplink_var']=='tol') {?>'+event.feature.l.Ruas+'<?php } else if($i['maplink_var']=='air_bersih') {?>'+event.feature.l.TEXT_KEC+'<?php } else {}?></td></tr><tr><th>Latitude</th><td>'+ event.latLng.lat()+'</td></tr><tr><th>Longitude</th><td>'+ event.latLng.lng()+'</td></tr></table></div></div><div class="row"><div class="col-md-12"><button type="button" class="btn btn-info col-md-12" data-toggle="modal" data-target="#myModal'+aab+idlink+'">Detail</button></div></div></div>');
        console.log(event.feature.l)
        infowindow.setPosition(event.latLng);
        infowindow.open(map);
      });
    <?php endforeach; ?>

    <?php foreach ($map_link->result_array() as $i) : ?>
      <?php echo $i['maplink_var']; ?>.addListener('mouseover', function (event) {
        <?php echo $i['maplink_var']; ?>.revertStyle();
        <?php echo $i['maplink_var']; ?>.overrideStyle(event.feature, {
          <?php if($i['maplink_type']=='Polylines'){ echo "strokeColor: 'red',strokeWeight: 8,";} else if($i['maplink_type']=='Polygons'){ echo "fillColor: 'yellow',";} else {} ?>
          visibility: 'off'

        });   
      });

      <?php echo $i['maplink_var']; ?>.addListener('mouseout', function (event) {
        <?php echo $i['maplink_var']; ?>.revertStyle();
      });
    <?php endforeach; ?>

  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAogXD-AHrsmnWinZIyhRORJ84bgLwDPpg&callback=initMap">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
$this->load->view('frontend/map/modals/jalan_nasional');
$this->load->view('frontend/map/modals/jalan_provinsi');
$this->load->view('frontend/map/modals/air_bersih');
$this->load->view('frontend/map/modals/bendung');
$this->load->view('frontend/map/modals/jembatan');
$this->load->view('frontend/map/modals/sanitasi');
$this->load->view('frontend/map/modals/pelabuhan');
$this->load->view('frontend/map/modals/terminal');
$this->load->view('frontend/map/modals/stasiun');
$this->load->view('frontend/map/modals/bandara');
$this->load->view('frontend/map/modals/sungai');
$this->load->view('frontend/map/modals/sungaipol');
$this->load->view('frontend/map/modals/tol');
?>