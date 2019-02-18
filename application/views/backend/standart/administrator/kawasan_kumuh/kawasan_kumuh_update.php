
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo(){
     
       // Binding keys
       $('*').bind('keydown', 'Ctrl+s', function assets() {
          $('#btn_save').trigger('click');
           return false;
       });
    
       $('*').bind('keydown', 'Ctrl+x', function assets() {
          $('#btn_cancel').trigger('click');
           return false;
       });
    
      $('*').bind('keydown', 'Ctrl+d', function assets() {
          $('.btn_save_back').trigger('click');
           return false;
       });
        
    }
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Kawasan Kumuh        <small>Edit Kawasan Kumuh</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/kawasan_kumuh'); ?>">Kawasan Kumuh</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header ">
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Kawasan Kumuh</h3>
                            <h5 class="widget-user-desc">Edit Kawasan Kumuh</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/kawasan_kumuh/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_kawasan_kumuh', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_kawasan_kumuh', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="kawasan_kumuh_id" class="col-sm-2 control-label">Kawasan Kumuh Id 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="kawasan_kumuh_id" id="kawasan_kumuh_id" placeholder="Kawasan Kumuh Id" value="<?= set_value('kawasan_kumuh_id', $kawasan_kumuh->kawasan_kumuh_id); ?>">
                                <small class="info help-block">
                                <b>Input Kawasan Kumuh Id</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tipology" class="col-sm-2 control-label">Tipology 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tipology" id="tipology" placeholder="Tipology" value="<?= set_value('tipology', $kawasan_kumuh->tipology); ?>">
                                <small class="info help-block">
                                <b>Input Tipology</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="luas" class="col-sm-2 control-label">Luas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="luas" id="luas" placeholder="Luas" value="<?= set_value('luas', $kawasan_kumuh->luas); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="no_kawasan" class="col-sm-2 control-label">No Kawasan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="no_kawasan" id="no_kawasan" placeholder="No Kawasan" value="<?= set_value('no_kawasan', $kawasan_kumuh->no_kawasan); ?>">
                                <small class="info help-block">
                                <b>Input No Kawasan</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama_kawas" class="col-sm-2 control-label">Nama Kawas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_kawas" id="nama_kawas" placeholder="Nama Kawas" value="<?= set_value('nama_kawas', $kawasan_kumuh->nama_kawas); ?>">
                                <small class="info help-block">
                                <b>Input Nama Kawas</b> Max Length : 100.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kelurahan" class="col-sm-2 control-label">Kelurahan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kelurahan" id="kelurahan" placeholder="Kelurahan" value="<?= set_value('kelurahan', $kawasan_kumuh->kelurahan); ?>">
                                <small class="info help-block">
                                <b>Input Kelurahan</b> Max Length : 100.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tambahan" class="col-sm-2 control-label">Tambahan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tambahan" id="tambahan" placeholder="Tambahan" value="<?= set_value('tambahan', $kawasan_kumuh->tambahan); ?>">
                                <small class="info help-block">
                                <b>Input Tambahan</b> Max Length : 100.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kawasan_st" class="col-sm-2 control-label">Kawasan St 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="kawasan_st" id="kawasan_st" placeholder="Kawasan St" value="<?= set_value('kawasan_st', $kawasan_kumuh->kawasan_st); ?>">
                                <small class="info help-block">
                                <b>Input Kawasan St</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="peruntukan" class="col-sm-2 control-label">Peruntukan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="peruntukan" id="peruntukan" placeholder="Peruntukan" value="<?= set_value('peruntukan', $kawasan_kumuh->peruntukan); ?>">
                                <small class="info help-block">
                                <b>Input Peruntukan</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="wilayah_da" class="col-sm-2 control-label">Wilayah Da 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="wilayah_da" id="wilayah_da" placeholder="Wilayah Da" value="<?= set_value('wilayah_da', $kawasan_kumuh->wilayah_da); ?>">
                                <small class="info help-block">
                                <b>Input Wilayah Da</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="prioritas" class="col-sm-2 control-label">Prioritas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="prioritas" id="prioritas" placeholder="Prioritas" value="<?= set_value('prioritas', $kawasan_kumuh->prioritas); ?>">
                                <small class="info help-block">
                                <b>Input Prioritas</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tingkat_ke" class="col-sm-2 control-label">Tingkat Ke 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tingkat_ke" id="tingkat_ke" placeholder="Tingkat Ke" value="<?= set_value('tingkat_ke', $kawasan_kumuh->tingkat_ke); ?>">
                                <small class="info help-block">
                                <b>Input Tingkat Ke</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="dampingan" class="col-sm-2 control-label">Dampingan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="dampingan" id="dampingan" placeholder="Dampingan" value="<?= set_value('dampingan', $kawasan_kumuh->dampingan); ?>">
                                <small class="info help-block">
                                <b>Input Dampingan</b> Max Length : 25.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kab_kota" class="col-sm-2 control-label">Kab Kota 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kab_kota" id="kab_kota" placeholder="Kab Kota" value="<?= set_value('kab_kota', $kawasan_kumuh->kab_kota); ?>">
                                <small class="info help-block">
                                <b>Input Kab Kota</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="objectid" class="col-sm-2 control-label">Objectid 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="objectid" id="objectid" placeholder="Objectid" value="<?= set_value('objectid', $kawasan_kumuh->objectid); ?>">
                                <small class="info help-block">
                                <b>Input Objectid</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="nama_kaw" class="col-sm-2 control-label">Nama Kaw 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_kaw" id="nama_kaw" placeholder="Nama Kaw" value="<?= set_value('nama_kaw', $kawasan_kumuh->nama_kaw); ?>">
                                <small class="info help-block">
                                <b>Input Nama Kaw</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="luas_kaw" class="col-sm-2 control-label">Luas Kaw 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="luas_kaw" id="luas_kaw" placeholder="Luas Kaw" value="<?= set_value('luas_kaw', $kawasan_kumuh->luas_kaw); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kecamatan" class="col-sm-2 control-label">Kecamatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="Kecamatan" value="<?= set_value('kecamatan', $kawasan_kumuh->kecamatan); ?>">
                                <small class="info help-block">
                                <b>Input Kecamatan</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="shape_leng" class="col-sm-2 control-label">Shape Leng 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="shape_leng" id="shape_leng" placeholder="Shape Leng" value="<?= set_value('shape_leng', $kawasan_kumuh->shape_leng); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="shape_area" class="col-sm-2 control-label">Shape Area 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="shape_area" id="shape_area" placeholder="Shape Area" value="<?= set_value('shape_area', $kawasan_kumuh->shape_area); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="luas_ha" class="col-sm-2 control-label">Luas Ha 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="luas_ha" id="luas_ha" placeholder="Luas Ha" value="<?= set_value('luas_ha', $kawasan_kumuh->luas_ha); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kawasan_ku" class="col-sm-2 control-label">Kawasan Ku 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kawasan_ku" id="kawasan_ku" placeholder="Kawasan Ku" value="<?= set_value('kawasan_ku', $kawasan_kumuh->kawasan_ku); ?>">
                                <small class="info help-block">
                                <b>Input Kawasan Ku</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                            <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->
<!-- Page script -->
<script>
    $(document).ready(function(){
      
             
      $('#btn_cancel').click(function(){
        swal({
            title: "Are you sure?",
            text: "the data that you have created will be in the exhaust!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/kawasan_kumuh';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_kawasan_kumuh = $('#form_kawasan_kumuh');
        var data_post = form_kawasan_kumuh.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_kawasan_kumuh.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#kawasan_kumuh_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            $('.data_file_uuid').val('');
    
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/
      
       
       
           
    
    }); /*end doc ready*/
</script>