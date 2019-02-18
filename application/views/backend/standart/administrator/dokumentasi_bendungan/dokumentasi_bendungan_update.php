
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
        Dokumentasi Bendungan        <small>Edit Dokumentasi Bendungan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/dokumentasi_bendungan'); ?>">Dokumentasi Bendungan</a></li>
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
                            <h3 class="widget-user-username">Dokumentasi Bendungan</h3>
                            <h5 class="widget-user-desc">Edit Dokumentasi Bendungan</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/dokumentasi_bendungan/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_dokumentasi_bendungan', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_dokumentasi_bendungan', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="bendung_disumsel_id" class="col-sm-2 control-label">Nama Bendungan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="bendung_disumsel_id" id="bendung_disumsel_id" data-placeholder="Select Bendung Disumsel Id" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('bendungan') as $row): ?>
                                    <option <?=  $row->bendungan_id ==  $dokumentasi_bendungan->bendung_disumsel_id ? 'selected' : ''; ?> value="<?= $row->bendungan_id ?>"><?= $row->nama; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Bendung Disumsel Id</b> Max Length : 11.</small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="file" class="col-sm-2 control-label">File 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="dokumentasi_bendungan_file_galery"></div>
                                <input class="data_file data_file_uuid" name="dokumentasi_bendungan_file_uuid" id="dokumentasi_bendungan_file_uuid" type="hidden" value="<?= set_value('dokumentasi_bendungan_file_uuid'); ?>">
                                <input class="data_file" name="dokumentasi_bendungan_file_name" id="dokumentasi_bendungan_file_name" type="hidden" value="<?= set_value('dokumentasi_bendungan_file_name', $dokumentasi_bendungan->file); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                  
                                                <div class="form-group ">
                            <label for="dokumen_tanggal" class="col-sm-2 control-label">Tanggal Dokumentasi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="dokumen_tanggal"  placeholder="Tanggal Dokumentasi" id="dokumen_tanggal" value="<?= set_value('dokumentasi_bendungan_dokumen_tanggal_name', $dokumentasi_bendungan->dokumen_tanggal); ?>">
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div>
                       
                                                 
                                                <div class="form-group ">
                            <label for="dokumentasi_nama" class="col-sm-2 control-label">Dokumentasi Nama 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="dokumentasi_nama" id="dokumentasi_nama" placeholder="Dokumentasi Nama" value="<?= set_value('dokumentasi_nama', $dokumentasi_bendungan->dokumentasi_nama); ?>">
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
              window.location.href = BASE_URL + 'administrator/dokumentasi_bendungan';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_dokumentasi_bendungan = $('#form_dokumentasi_bendungan');
        var data_post = form_dokumentasi_bendungan.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_dokumentasi_bendungan.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#dokumentasi_bendungan_image_galery').find('li').attr('qq-file-id');
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

       $('#dokumentasi_bendungan_file_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/dokumentasi_bendungan/upload_file_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/administrator/dokumentasi_bendungan/delete_file_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'administrator/dokumentasi_bendungan/get_file_file/<?= $dokumentasi_bendungan->kode_dbd; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#dokumentasi_bendungan_file_galery').fineUploader('getUuid', id);
                   $('#dokumentasi_bendungan_file_uuid').val(uuid);
                   $('#dokumentasi_bendungan_file_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#dokumentasi_bendungan_file_uuid').val();
                  $.get(BASE_URL + '/administrator/dokumentasi_bendungan/delete_file_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#dokumentasi_bendungan_file_uuid').val('');
                  $('#dokumentasi_bendungan_file_name').val('');
                }
              }
          }
      }); /*end file galey*/
              
       
           
    
    }); /*end doc ready*/
</script>