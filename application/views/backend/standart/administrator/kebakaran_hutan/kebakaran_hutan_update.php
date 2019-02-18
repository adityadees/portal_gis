
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
        Kebakaran Hutan        <small>Edit Kebakaran Hutan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/kebakaran_hutan'); ?>">Kebakaran Hutan</a></li>
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
                            <h3 class="widget-user-username">Kebakaran Hutan</h3>
                            <h5 class="widget-user-desc">Edit Kebakaran Hutan</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/kebakaran_hutan/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_kebakaran_hutan', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_kebakaran_hutan', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="kebakaran_kode" class="col-sm-2 control-label">Nama Wilayah 
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="kebakaran_kode" id="kebakaran_kode" data-placeholder="Select Kebakaran Kode" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('air_bersih') as $row): ?>
                                    <option <?=  $row->air_bersih_id ==  $kebakaran_hutan->kebakaran_kode ? 'selected' : ''; ?> value="<?= $row->air_bersih_id ?>"><?= $row->text_kecamatan; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Kebakaran Kode</b> Max Length : 11.</small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="kecamatan_rawan" class="col-sm-2 control-label">Kecamatan Rawan 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="kecamatan_rawan" id="kecamatan_rawan" placeholder="Kecamatan Rawan" value="<?= set_value('kecamatan_rawan', $kebakaran_hutan->kecamatan_rawan); ?>">
                                <small class="info help-block">
                                <b>Input Kecamatan Rawan</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="kecamatan_sangat_rawan" class="col-sm-2 control-label">Kecamatan Sangat Rawan 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="kecamatan_sangat_rawan" id="kecamatan_sangat_rawan" placeholder="Kecamatan Sangat Rawan" value="<?= set_value('kecamatan_sangat_rawan', $kebakaran_hutan->kecamatan_sangat_rawan); ?>">
                                <small class="info help-block">
                                <b>Input Kecamatan Sangat Rawan</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="desa_rawan" class="col-sm-2 control-label">Desa Rawan 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="desa_rawan" id="desa_rawan" placeholder="Desa Rawan" value="<?= set_value('desa_rawan', $kebakaran_hutan->desa_rawan); ?>">
                                <small class="info help-block">
                                <b>Input Desa Rawan</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="desa_sangat_rawan" class="col-sm-2 control-label">Desa Sangat Rawan 
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="desa_sangat_rawan" id="desa_sangat_rawan" placeholder="Desa Sangat Rawan" value="<?= set_value('desa_sangat_rawan', $kebakaran_hutan->desa_sangat_rawan); ?>">
                                <small class="info help-block">
                                <b>Input Desa Sangat Rawan</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="tahun" class="col-sm-2 control-label">Tahun 
                            </label>
                            <div class="col-sm-2">
                                <select  class="form-control chosen chosen-select-deselect" name="tahun" id="tahun" data-placeholder="Select Tahun" >
                                    <option value=""></option>
                                    <?php for ($i = 1970; $i < date('Y')+100; $i++){ ?>
                                    <option <?=  $i ==  $kebakaran_hutan->tahun ? 'selected' : ''; ?> value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php }; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Tahun</b> Max Length : 4.</small>
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
              window.location.href = BASE_URL + 'administrator/kebakaran_hutan';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_kebakaran_hutan = $('#form_kebakaran_hutan');
        var data_post = form_kebakaran_hutan.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_kebakaran_hutan.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#kebakaran_hutan_image_galery').find('li').attr('qq-file-id');
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