
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
        Tambah Historis Penanganan Infrastruktur        <small><?= cclang('update'); ?> Tambah Historis Penanganan Infrastruktur</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/form_tambah_historis_penanganan_infrastruktur'); ?>">Tambah Historis Penanganan Infrastruktur</a></li>
        <li class="active"><?= cclang('update'); ?></li>
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
                            <h3 class="widget-user-username">Tambah Historis Penanganan Infrastruktur</h3>
                            <h5 class="widget-user-desc">Edit Tambah Historis Penanganan Infrastruktur</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/form_tambah_historis_penanganan_infrastruktur/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_form_tambah_historis_penanganan_infrastruktur', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_form_tambah_historis_penanganan_infrastruktur', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="tahun" class="col-sm-2 control-label">Tahun 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-2">
                                <select  class="form-control chosen chosen-select-deselect" name="tahun" id="tahun" data-placeholder="Select Tahun" >
                                    <option value=""></option>
                                    <?php for ($i = 1970; $i < date('Y')+100; $i++){ ?>
                                    <option <?=  $i ==  $form_tambah_historis_penanganan_infrastruktur->tahun ? 'selected' : ''; ?> value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php }; ?> 
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="panjang_efektif" class="col-sm-2 control-label">Panjang Efektif 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="panjang_efektif" value="<?= set_value('panjang_efektif', $form_tambah_historis_penanganan_infrastruktur->panjang_efektif); ?>" id="panjang_efektif" placeholder=""  >
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="panjang_penanganan" class="col-sm-2 control-label">Panjang Penanganan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="panjang_penanganan" value="<?= set_value('panjang_penanganan', $form_tambah_historis_penanganan_infrastruktur->panjang_penanganan); ?>" id="panjang_penanganan" placeholder=""  >
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="latitude" class="col-sm-2 control-label">Latitude 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="latitude" value="<?= set_value('latitude', $form_tambah_historis_penanganan_infrastruktur->latitude); ?>" id="latitude" placeholder=""  >
                                <small class="info help-block">
                                <b>Format Latitude must</b> Decimal.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="longitude" class="col-sm-2 control-label">Longitude 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="longitude" value="<?= set_value('longitude', $form_tambah_historis_penanganan_infrastruktur->longitude); ?>" id="longitude" placeholder=""  >
                                <small class="info help-block">
                                <b>Format Longitude must</b> Decimal.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="no_kontrak" class="col-sm-2 control-label">No Kontrak 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_kontrak" value="<?= set_value('no_kontrak', $form_tambah_historis_penanganan_infrastruktur->no_kontrak); ?>" id="no_kontrak" placeholder=""  >
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="penyedia_jasa" class="col-sm-2 control-label">Penyedia Jasa 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="penyedia_jasa" value="<?= set_value('penyedia_jasa', $form_tambah_historis_penanganan_infrastruktur->penyedia_jasa); ?>" id="penyedia_jasa" placeholder=""  >
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
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="cancel (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_field_data'); ?></i>
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
              window.location.href = BASE_URL + 'administrator/form_tambah_historis_penanganan_infrastruktur';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_form_tambah_historis_penanganan_infrastruktur = $('#form_form_tambah_historis_penanganan_infrastruktur');
        var data_post = form_form_tambah_historis_penanganan_infrastruktur.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_form_tambah_historis_penanganan_infrastruktur.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#form_tambah_historis_penanganan_infrastruktur_image_galery').find('li').attr('qq-file-id');
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