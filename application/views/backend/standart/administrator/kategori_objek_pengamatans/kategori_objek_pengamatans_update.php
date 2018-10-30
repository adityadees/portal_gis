
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
        Kategori Objek Pengamatans        <small>Edit Kategori Objek Pengamatans</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/kategori_objek_pengamatans'); ?>">Kategori Objek Pengamatans</a></li>
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
                            <h3 class="widget-user-username">Kategori Objek Pengamatans</h3>
                            <h5 class="widget-user-desc">Edit Kategori Objek Pengamatans</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/kategori_objek_pengamatans/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_kategori_objek_pengamatans', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_kategori_objek_pengamatans', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="NAMA_KOP" class="col-sm-2 control-label">NAMA KOP 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="NAMA_KOP" id="NAMA_KOP" placeholder="NAMA KOP" value="<?= set_value('NAMA_KOP', $kategori_objek_pengamatans->NAMA_KOP); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="NAMA_ICON_FILE" class="col-sm-2 control-label">NAMA ICON FILE 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="kategori_objek_pengamatans_NAMA_ICON_FILE_galery"></div>
                                <input class="data_file data_file_uuid" name="kategori_objek_pengamatans_NAMA_ICON_FILE_uuid" id="kategori_objek_pengamatans_NAMA_ICON_FILE_uuid" type="hidden" value="<?= set_value('kategori_objek_pengamatans_NAMA_ICON_FILE_uuid'); ?>">
                                <input class="data_file" name="kategori_objek_pengamatans_NAMA_ICON_FILE_name" id="kategori_objek_pengamatans_NAMA_ICON_FILE_name" type="hidden" value="<?= set_value('kategori_objek_pengamatans_NAMA_ICON_FILE_name', $kategori_objek_pengamatans->NAMA_ICON_FILE); ?>">
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
              window.location.href = BASE_URL + 'administrator/kategori_objek_pengamatans';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_kategori_objek_pengamatans = $('#form_kategori_objek_pengamatans');
        var data_post = form_kategori_objek_pengamatans.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_kategori_objek_pengamatans.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#kategori_objek_pengamatans_image_galery').find('li').attr('qq-file-id');
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

       $('#kategori_objek_pengamatans_NAMA_ICON_FILE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/kategori_objek_pengamatans/upload_NAMA_ICON_FILE_file',
              params : params
          },
          deleteFile: {
              enabled: true, // defaults to false
              endpoint: BASE_URL + '/administrator/kategori_objek_pengamatans/delete_NAMA_ICON_FILE_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'administrator/kategori_objek_pengamatans/get_NAMA_ICON_FILE_file/<?= $kategori_objek_pengamatans->KODE_KOP; ?>',
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
                   var uuid = $('#kategori_objek_pengamatans_NAMA_ICON_FILE_galery').fineUploader('getUuid', id);
                   $('#kategori_objek_pengamatans_NAMA_ICON_FILE_uuid').val(uuid);
                   $('#kategori_objek_pengamatans_NAMA_ICON_FILE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#kategori_objek_pengamatans_NAMA_ICON_FILE_uuid').val();
                  $.get(BASE_URL + '/administrator/kategori_objek_pengamatans/delete_NAMA_ICON_FILE_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#kategori_objek_pengamatans_NAMA_ICON_FILE_uuid').val('');
                  $('#kategori_objek_pengamatans_NAMA_ICON_FILE_name').val('');
                }
              }
          }
      }); /*end NAMA_ICON_FILE galey*/
              
       
           
    
    }); /*end doc ready*/
</script>