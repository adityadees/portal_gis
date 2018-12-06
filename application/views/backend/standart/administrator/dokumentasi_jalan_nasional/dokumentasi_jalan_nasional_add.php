
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
        Dokumentasi Jalan Nasional        <small><?= cclang('new', ['Dokumentasi Jalan Nasional']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/dokumentasi_jalan_nasional'); ?>">Dokumentasi Jalan Nasional</a></li>
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
                            <h3 class="widget-user-username">Dokumentasi Jalan Nasional</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Dokumentasi Jalan Nasional']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_dokumentasi_jalan_nasional', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_dokumentasi_jalan_nasional', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="dokumentasi_jalan_id" class="col-sm-2 control-label">Dokumentasi Jalan Id 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="dokumentasi_jalan_id" id="dokumentasi_jalan_id" data-placeholder="Select Dokumentasi Jalan Id" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('jalan_nasional') as $row): ?>
                                    <option value="<?= $row->jalan_id ?>"><?= $row->jalan_id; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Dokumentasi Jalan Id</b> Max Length : 11.</small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="file" class="col-sm-2 control-label">File 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="dokumentasi_jalan_nasional_file_galery"></div>
                                <input class="data_file" name="dokumentasi_jalan_nasional_file_uuid" id="dokumentasi_jalan_nasional_file_uuid" type="hidden" value="<?= set_value('dokumentasi_jalan_nasional_file_uuid'); ?>">
                                <input class="data_file" name="dokumentasi_jalan_nasional_file_name" id="dokumentasi_jalan_nasional_file_name" type="hidden" value="<?= set_value('dokumentasi_jalan_nasional_file_name'); ?>">
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
                              <input type="text" class="form-control pull-right datepicker" name="dokumen_tanggal"  placeholder="Dokumen Tanggal" id="dokumen_tanggal">
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
              window.location.href = BASE_URL + 'administrator/dokumentasi_jalan_nasional';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_dokumentasi_jalan_nasional = $('#form_dokumentasi_jalan_nasional');
        var data_post = form_dokumentasi_jalan_nasional.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/dokumentasi_jalan_nasional/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id_file = $('#dokumentasi_jalan_nasional_file_galery').find('li').attr('qq-file-id');
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            if (typeof id_file !== 'undefined') {
                    $('#dokumentasi_jalan_nasional_file_galery').fineUploader('deleteFile', id_file);
                }
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
                
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

       $('#dokumentasi_jalan_nasional_file_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/dokumentasi_jalan_nasional/upload_file_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/dokumentasi_jalan_nasional/delete_file_file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          multiple : false,
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
                   var uuid = $('#dokumentasi_jalan_nasional_file_galery').fineUploader('getUuid', id);
                   $('#dokumentasi_jalan_nasional_file_uuid').val(uuid);
                   $('#dokumentasi_jalan_nasional_file_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#dokumentasi_jalan_nasional_file_uuid').val();
                  $.get(BASE_URL + '/administrator/dokumentasi_jalan_nasional/delete_file_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#dokumentasi_jalan_nasional_file_uuid').val('');
                  $('#dokumentasi_jalan_nasional_file_name').val('');
                }
              }
          }
      }); /*end file galery*/
              
 
       
    
    
    }); /*end doc ready*/
</script>