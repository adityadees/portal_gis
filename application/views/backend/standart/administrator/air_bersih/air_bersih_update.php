
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
        Air Bersih        <small>Edit Air Bersih</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/air_bersih'); ?>">Air Bersih</a></li>
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
                            <h3 class="widget-user-username">Air Bersih</h3>
                            <h5 class="widget-user-desc">Edit Air Bersih</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/air_bersih/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_air_bersih', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_air_bersih', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="air_bersih_id" class="col-sm-2 control-label">Air Bersih Id 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="air_bersih_id" id="air_bersih_id" placeholder="Air Bersih Id" value="<?= set_value('air_bersih_id', $air_bersih->air_bersih_id); ?>">
                                <small class="info help-block">
                                <b>Input Air Bersih Id</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kabupaten_kota" class="col-sm-2 control-label">Kabupaten Kota 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kabupaten_kota" id="kabupaten_kota" placeholder="Kabupaten Kota" value="<?= set_value('kabupaten_kota', $air_bersih->kabupaten_kota); ?>">
                                <small class="info help-block">
                                <b>Input Kabupaten Kota</b> Max Length : 30.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kecamatan" class="col-sm-2 control-label">Kecamatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="Kecamatan" value="<?= set_value('kecamatan', $air_bersih->kecamatan); ?>">
                                <small class="info help-block">
                                <b>Input Kecamatan</b> Max Length : 30.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kode_wilayah" class="col-sm-2 control-label">Kode Wilayah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kode_wilayah" id="kode_wilayah" placeholder="Kode Wilayah" value="<?= set_value('kode_wilayah', $air_bersih->kode_wilayah); ?>">
                                <small class="info help-block">
                                <b>Input Kode Wilayah</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kode_kecamatan" class="col-sm-2 control-label">Kode Kecamatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kode_kecamatan" id="kode_kecamatan" placeholder="Kode Kecamatan" value="<?= set_value('kode_kecamatan', $air_bersih->kode_kecamatan); ?>">
                                <small class="info help-block">
                                <b>Input Kode Kecamatan</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="text_kecamatan" class="col-sm-2 control-label">Text Kecamatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="text_kecamatan" id="text_kecamatan" placeholder="Text Kecamatan" value="<?= set_value('text_kecamatan', $air_bersih->text_kecamatan); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="luas" class="col-sm-2 control-label">Luas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="luas" id="luas" placeholder="Luas" value="<?= set_value('luas', $air_bersih->luas); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="air_bers_1" class="col-sm-2 control-label">Air Bers 1 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="air_bers_1" id="air_bers_1" placeholder="Air Bers 1" value="<?= set_value('air_bers_1', $air_bersih->air_bers_1); ?>">
                                <small class="info help-block">
                                </small>
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
              window.location.href = BASE_URL + 'administrator/air_bersih';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_air_bersih = $('#form_air_bersih');
        var data_post = form_air_bersih.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_air_bersih.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#air_bersih_image_galery').find('li').attr('qq-file-id');
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