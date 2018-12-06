
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
        Sanitasi Sumsels        <small>Edit Sanitasi Sumsels</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/sanitasi_sumsels'); ?>">Sanitasi Sumsels</a></li>
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
                            <h3 class="widget-user-username">Sanitasi Sumsels</h3>
                            <h5 class="widget-user-desc">Edit Sanitasi Sumsels</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/sanitasi_sumsels/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_sanitasi_sumsels', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_sanitasi_sumsels', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="air_bersih_id" class="col-sm-2 control-label">Air Bersih Id 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="air_bersih_id" id="air_bersih_id" placeholder="Air Bersih Id" value="<?= set_value('air_bersih_id', $sanitasi_sumsels->air_bersih_id); ?>">
                                <small class="info help-block">
                                <b>Input Air Bersih Id</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kabupaten_kota" class="col-sm-2 control-label">Kabupaten Kota 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kabupaten_kota" id="kabupaten_kota" placeholder="Kabupaten Kota" value="<?= set_value('kabupaten_kota', $sanitasi_sumsels->kabupaten_kota); ?>">
                                <small class="info help-block">
                                <b>Input Kabupaten Kota</b> Max Length : 30.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kecamatan" class="col-sm-2 control-label">Kecamatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="kecamatan" id="kecamatan" data-placeholder="Select Kecamatan" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('districts') as $row): ?>
                                    <option <?=  $row->id ==  $sanitasi_sumsels->kecamatan ? 'selected' : ''; ?> value="<?= $row->id ?>"><?= $row->name; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Kecamatan</b> Max Length : 30.</small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="kode_wilayah" class="col-sm-2 control-label">Kode Wilayah 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kode_wilayah" id="kode_wilayah" placeholder="Kode Wilayah" value="<?= set_value('kode_wilayah', $sanitasi_sumsels->kode_wilayah); ?>">
                                <small class="info help-block">
                                <b>Input Kode Wilayah</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kode_kecamatan" class="col-sm-2 control-label">Kode Kecamatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kode_kecamatan" id="kode_kecamatan" placeholder="Kode Kecamatan" value="<?= set_value('kode_kecamatan', $sanitasi_sumsels->kode_kecamatan); ?>">
                                <small class="info help-block">
                                <b>Input Kode Kecamatan</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="text_kecamatan" class="col-sm-2 control-label">Text Kecamatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="text_kecamatan" name="text_kecamatan" rows="10" cols="80"> <?= set_value('text_kecamatan', $sanitasi_sumsels->text_kecamatan); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="luas" class="col-sm-2 control-label">Luas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="luas" id="luas" placeholder="Luas" value="<?= set_value('luas', $sanitasi_sumsels->luas); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="sanitasi" class="col-sm-2 control-label">Sanitasi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="sanitasi" id="sanitasi" placeholder="Sanitasi" value="<?= set_value('sanitasi', $sanitasi_sumsels->sanitasi); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="air_bersih" class="col-sm-2 control-label">Air Bersih 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="air_bersih" id="air_bersih" placeholder="Air Bersih" value="<?= set_value('air_bersih', $sanitasi_sumsels->air_bersih); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kk_mbr" class="col-sm-2 control-label">Kk Mbr 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kk_mbr" id="kk_mbr" placeholder="Kk Mbr" value="<?= set_value('kk_mbr', $sanitasi_sumsels->kk_mbr); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kk_nonmbr" class="col-sm-2 control-label">Kk Nonmbr 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kk_nonmbr" id="kk_nonmbr" placeholder="Kk Nonmbr" value="<?= set_value('kk_nonmbr', $sanitasi_sumsels->kk_nonmbr); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="perkebunan" class="col-sm-2 control-label">Perkebunan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="perkebunan" id="perkebunan" placeholder="Perkebunan" value="<?= set_value('perkebunan', $sanitasi_sumsels->perkebunan); ?>">
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
      
      CKEDITOR.replace('text_kecamatan'); 
      var text_kecamatan = CKEDITOR.instances.text_kecamatan;
                   
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
              window.location.href = BASE_URL + 'administrator/sanitasi_sumsels';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#text_kecamatan').val(text_kecamatan.getData());
                    
        var form_sanitasi_sumsels = $('#form_sanitasi_sumsels');
        var data_post = form_sanitasi_sumsels.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_sanitasi_sumsels.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#sanitasi_sumsels_image_galery').find('li').attr('qq-file-id');
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