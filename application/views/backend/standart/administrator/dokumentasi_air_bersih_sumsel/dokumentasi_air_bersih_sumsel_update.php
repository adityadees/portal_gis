
<!-- Fine Uploader Gallery CSS file
    ====================================================================== -->
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('core_template/fine_upload'); ?>
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
        Dokumentasi Air Bersih Sumsel        <small>Edit Dokumentasi Air Bersih Sumsel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/dokumentasi_air_bersih_sumsel'); ?>">Dokumentasi Air Bersih Sumsel</a></li>
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
                            <h3 class="widget-user-username">Dokumentasi Air Bersih Sumsel</h3>
                            <h5 class="widget-user-desc">Edit Dokumentasi Air Bersih Sumsel</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/dokumentasi_air_bersih_sumsel/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_dokumentasi_air_bersih_sumsel', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_dokumentasi_air_bersih_sumsel', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="air_bersih_sumsel_id" class="col-sm-2 control-label">Air Bersih Sumsel Id 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="air_bersih_sumsel_id" id="air_bersih_sumsel_id" data-placeholder="Select Air Bersih Sumsel Id" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('air_bersih') as $row): ?>
                                    <option <?=  $row->air_bersih_id ==  $dokumentasi_air_bersih_sumsel->air_bersih_sumsel_id ? 'selected' : ''; ?> value="<?= $row->air_bersih_id ?>"><?= $row->air_bersih_id; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="file" class="col-sm-2 control-label">File 
                            </label>
                            <div class="col-sm-8">
                                <div id="dokumentasi_air_bersih_sumsel_file_galery"></div>
                                <div id="dokumentasi_air_bersih_sumsel_file_galery_listed">
                                <?php foreach ((array) explode(',', $dokumentasi_air_bersih_sumsel->file) as $idx => $filename): ?>
                                    <input type="hidden" class="listed_file_uuid" name="dokumentasi_air_bersih_sumsel_file_uuid[<?= $idx ?>]" value="" /><input type="hidden" class="listed_file_name" name="dokumentasi_air_bersih_sumsel_file_name[<?= $idx ?>]" value="<?= $filename; ?>" />
                                <?php endforeach; ?>
                                </div>
                                <small class="info help-block">
                                <b>Extension file must</b> JPG,PNG.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="dokumen_tanggal" class="col-sm-2 control-label">Dokumen Tanggal 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="dokumen_tanggal"  placeholder="Dokumen Tanggal" id="dokumen_tanggal" value="<?= set_value('dokumentasi_air_bersih_sumsel_dokumen_tanggal_name', $dokumentasi_air_bersih_sumsel->dokumen_tanggal); ?>">
                            </div>
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
              window.location.href = BASE_URL + 'administrator/dokumentasi_air_bersih_sumsel';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_dokumentasi_air_bersih_sumsel = $('#form_dokumentasi_air_bersih_sumsel');
        var data_post = form_dokumentasi_air_bersih_sumsel.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_dokumentasi_air_bersih_sumsel.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#dokumentasi_air_bersih_sumsel_image_galery').find('li').attr('qq-file-id');
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
      
       
       
              var params = {};
       params[csrf] = token;

       $('#dokumentasi_air_bersih_sumsel_file_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/dokumentasi_air_bersih_sumsel/upload_file_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/dokumentasi_air_bersih_sumsel/delete_file_file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'administrator/dokumentasi_air_bersih_sumsel/get_file_file/<?= $dokumentasi_air_bersih_sumsel->kode_dabs; ?>',
             refreshOnRequest:true
           },
          validation: {
              allowedExtensions: ["jpg","png"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#dokumentasi_air_bersih_sumsel_file_galery').fineUploader('getUuid', id);
                   $('#dokumentasi_air_bersih_sumsel_file_galery_listed').append('<input type="hidden" class="listed_file_uuid" name="dokumentasi_air_bersih_sumsel_file_uuid['+id+']" value="'+uuid+'" /><input type="hidden" class="listed_file_name" name="dokumentasi_air_bersih_sumsel_file_name['+id+']" value="'+xhr.uploadName+'" />');
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#dokumentasi_air_bersih_sumsel_file_galery_listed').find('.listed_file_uuid[name="dokumentasi_air_bersih_sumsel_file_uuid['+id+']"]').remove();
                  $('#dokumentasi_air_bersih_sumsel_file_galery_listed').find('.listed_file_name[name="dokumentasi_air_bersih_sumsel_file_name['+id+']"]').remove();
                }
              }
          }
      }); /*end file galery*/
                  
    
    }); /*end doc ready*/
</script>