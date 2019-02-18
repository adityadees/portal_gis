
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
        Jalan Permukiman        <small><?= cclang('new', ['Jalan Permukiman']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/jalan_permukiman'); ?>">Jalan Permukiman</a></li>
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
                            <h3 class="widget-user-username">Jalan Permukiman</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Jalan Permukiman']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_jalan_permukiman', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_jalan_permukiman', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="jalan_id" class="col-sm-2 control-label">Jalan Id 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="jalan_id" id="jalan_id" placeholder="Jalan Id" value="<?= set_value('jalan_id'); ?>">
                                <small class="info help-block">
                                <b>Input Jalan Id</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jalan_status" class="col-sm-2 control-label">Jalan Status 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jalan_status" id="jalan_status" placeholder="Jalan Status" value="<?= set_value('jalan_status'); ?>">
                                <small class="info help-block">
                                <b>Input Jalan Status</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jalan_fungsi" class="col-sm-2 control-label">Jalan Fungsi 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jalan_fungsi" id="jalan_fungsi" placeholder="Jalan Fungsi" value="<?= set_value('jalan_fungsi'); ?>">
                                <small class="info help-block">
                                <b>Input Jalan Fungsi</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jalan_sumber" class="col-sm-2 control-label">Jalan Sumber 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="jalan_sumber" name="jalan_sumber" rows="5" cols="80"><?= set_value('Jalan Sumber'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jalan_no_ruas" class="col-sm-2 control-label">Jalan No Ruas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jalan_no_ruas" id="jalan_no_ruas" placeholder="Jalan No Ruas" value="<?= set_value('jalan_no_ruas'); ?>">
                                <small class="info help-block">
                                <b>Input Jalan No Ruas</b> Max Length : 20.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jalan_nama_ruas" class="col-sm-2 control-label">Jalan Nama Ruas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="jalan_nama_ruas" name="jalan_nama_ruas" rows="5" cols="80"><?= set_value('Jalan Nama Ruas'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jalan_panjang" class="col-sm-2 control-label">Jalan Panjang (KM) 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="jalan_panjang" id="jalan_panjang" placeholder="Jalan Panjang (KM)" value="<?= set_value('jalan_panjang'); ?>">
                                <small class="info help-block">
                                <b>Input Jalan Panjang</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jalan_layer" class="col-sm-2 control-label">Jalan Layer 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jalan_layer" id="jalan_layer" placeholder="Jalan Layer" value="<?= set_value('jalan_layer'); ?>">
                                <small class="info help-block">
                                <b>Input Jalan Layer</b> Max Length : 20.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jalan_kegiatan" class="col-sm-2 control-label">Jalan Kegiatan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jalan_kegiatan" id="jalan_kegiatan" placeholder="Jalan Kegiatan" value="<?= set_value('jalan_kegiatan'); ?>">
                                <small class="info help-block">
                                <b>Input Jalan Kegiatan</b> Max Length : 100.</small>
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
            CKEDITOR.replace('jalan_sumber'); 
      var jalan_sumber = CKEDITOR.instances.jalan_sumber;
            CKEDITOR.replace('jalan_nama_ruas'); 
      var jalan_nama_ruas = CKEDITOR.instances.jalan_nama_ruas;
                   
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
              window.location.href = BASE_URL + 'administrator/jalan_permukiman';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#jalan_sumber').val(jalan_sumber.getData());
                $('#jalan_nama_ruas').val(jalan_nama_ruas.getData());
                    
        var form_jalan_permukiman = $('#form_jalan_permukiman');
        var data_post = form_jalan_permukiman.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/jalan_permukiman/add_save',
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
            jalan_sumber.setData('');
            jalan_nama_ruas.setData('');
                
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