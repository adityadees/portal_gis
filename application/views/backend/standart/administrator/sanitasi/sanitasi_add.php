
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
        Sanitasi        <small><?= cclang('new', ['Sanitasi']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/sanitasi'); ?>">Sanitasi</a></li>
        <li class="active"><?= cclang('new'); ?></li>
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
                            <h3 class="widget-user-username">Sanitasi</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Sanitasi']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_sanitasi', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_sanitasi', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="air_bersih_id" class="col-sm-2 control-label">Air Bersih Id 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="air_bersih_id" id="air_bersih_id" placeholder="Air Bersih Id" value="<?= set_value('air_bersih_id'); ?>">
                                <small class="info help-block">
                                <b>Input Air Bersih Id</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kabupaten_kota" class="col-sm-2 control-label">Kabupaten Kota 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kabupaten_kota" id="kabupaten_kota" placeholder="Kabupaten Kota" value="<?= set_value('kabupaten_kota'); ?>">
                                <small class="info help-block">
                                <b>Input Kabupaten Kota</b> Max Length : 30.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kecamatan" class="col-sm-2 control-label">Kecamatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="Kecamatan" value="<?= set_value('kecamatan'); ?>">
                                <small class="info help-block">
                                <b>Input Kecamatan</b> Max Length : 30.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kode_wilayah" class="col-sm-2 control-label">Kode Wilayah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kode_wilayah" id="kode_wilayah" placeholder="Kode Wilayah" value="<?= set_value('kode_wilayah'); ?>">
                                <small class="info help-block">
                                <b>Input Kode Wilayah</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kode_kecamatan" class="col-sm-2 control-label">Kode Kecamatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kode_kecamatan" id="kode_kecamatan" placeholder="Kode Kecamatan" value="<?= set_value('kode_kecamatan'); ?>">
                                <small class="info help-block">
                                <b>Input Kode Kecamatan</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="luas" class="col-sm-2 control-label">Luas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="luas" id="luas" placeholder="Luas" value="<?= set_value('luas'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="sanitasi" class="col-sm-2 control-label">Sanitasi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="sanitasi" name="sanitasi" rows="5" cols="80"><?= set_value('Sanitasi'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="air_bersih" class="col-sm-2 control-label">Air Bersih 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="air_bersih" name="air_bersih" rows="5" cols="80"><?= set_value('Air Bersih'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kk_mbr" class="col-sm-2 control-label">Kk Mbr 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="kk_mbr" name="kk_mbr" rows="5" cols="80"><?= set_value('Kk Mbr'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kk_nonmbr" class="col-sm-2 control-label">Kk Nonmbr 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="kk_nonmbr" name="kk_nonmbr" rows="5" cols="80"><?= set_value('Kk Nonmbr'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="perkebunan" class="col-sm-2 control-label">Perkebunan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="perkebunan" name="perkebunan" rows="5" cols="80"><?= set_value('Perkebunan'); ?></textarea>
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
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
    $(document).ready(function(){
                  CKEDITOR.replace('sanitasi'); 
      var sanitasi = CKEDITOR.instances.sanitasi;
            CKEDITOR.replace('air_bersih'); 
      var air_bersih = CKEDITOR.instances.air_bersih;
            CKEDITOR.replace('kk_mbr'); 
      var kk_mbr = CKEDITOR.instances.kk_mbr;
            CKEDITOR.replace('kk_nonmbr'); 
      var kk_nonmbr = CKEDITOR.instances.kk_nonmbr;
            CKEDITOR.replace('perkebunan'); 
      var perkebunan = CKEDITOR.instances.perkebunan;
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
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
              window.location.href = BASE_URL + 'administrator/sanitasi';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
                $('#sanitasi').val(sanitasi.getData());
                $('#air_bersih').val(air_bersih.getData());
                $('#kk_mbr').val(kk_mbr.getData());
                $('#kk_nonmbr').val(kk_nonmbr.getData());
                $('#perkebunan').val(perkebunan.getData());
                    
        var form_sanitasi = $('#form_sanitasi');
        var data_post = form_sanitasi.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/sanitasi/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
                        sanitasi.setData('');
            air_bersih.setData('');
            kk_mbr.setData('');
            kk_nonmbr.setData('');
            perkebunan.setData('');
                
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