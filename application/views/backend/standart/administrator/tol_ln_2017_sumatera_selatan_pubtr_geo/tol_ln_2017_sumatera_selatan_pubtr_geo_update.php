
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
        Tol Ln 2017 Sumatera Selatan Pubtr Geo        <small>Edit Tol Ln 2017 Sumatera Selatan Pubtr Geo</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/tol_ln_2017_sumatera_selatan_pubtr_geo'); ?>">Tol Ln 2017 Sumatera Selatan Pubtr Geo</a></li>
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
                            <h3 class="widget-user-username">Tol Ln 2017 Sumatera Selatan Pubtr Geo</h3>
                            <h5 class="widget-user-desc">Edit Tol Ln 2017 Sumatera Selatan Pubtr Geo</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/tol_ln_2017_sumatera_selatan_pubtr_geo/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_tol_ln_2017_sumatera_selatan_pubtr_geo', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_tol_ln_2017_sumatera_selatan_pubtr_geo', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="tol_ln_2017_sumatera_selatan_pubtr_geo_id" class="col-sm-2 control-label">Tol Ln 2017 Sumatera Selatan Pubtr Geo Id 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="tol_ln_2017_sumatera_selatan_pubtr_geo_id" id="tol_ln_2017_sumatera_selatan_pubtr_geo_id" placeholder="Tol Ln 2017 Sumatera Selatan Pubtr Geo Id" value="<?= set_value('tol_ln_2017_sumatera_selatan_pubtr_geo_id', $tol_ln_2017_sumatera_selatan_pubtr_geo->tol_ln_2017_sumatera_selatan_pubtr_geo_id); ?>">
                                <small class="info help-block">
                                <b>Input Tol Ln 2017 Sumatera Selatan Pubtr Geo Id</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="jalanrencana" class="col-sm-2 control-label">Jalanrencana 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jalanrencana" id="jalanrencana" placeholder="Jalanrencana" value="<?= set_value('jalanrencana', $tol_ln_2017_sumatera_selatan_pubtr_geo->jalanrencana); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="ruas" class="col-sm-2 control-label">Ruas 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ruas" id="ruas" placeholder="Ruas" value="<?= set_value('ruas', $tol_ln_2017_sumatera_selatan_pubtr_geo->ruas); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="status_tol" class="col-sm-2 control-label">Status Tol 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="status_tol" id="status_tol" placeholder="Status Tol" value="<?= set_value('status_tol', $tol_ln_2017_sumatera_selatan_pubtr_geo->status_tol); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="pemilik" class="col-sm-2 control-label">Pemilik 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="pemilik" id="pemilik" placeholder="Pemilik" value="<?= set_value('pemilik', $tol_ln_2017_sumatera_selatan_pubtr_geo->pemilik); ?>">
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
              window.location.href = BASE_URL + 'administrator/tol_ln_2017_sumatera_selatan_pubtr_geo';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_tol_ln_2017_sumatera_selatan_pubtr_geo = $('#form_tol_ln_2017_sumatera_selatan_pubtr_geo');
        var data_post = form_tol_ln_2017_sumatera_selatan_pubtr_geo.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_tol_ln_2017_sumatera_selatan_pubtr_geo.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#tol_ln_2017_sumatera_selatan_pubtr_geo_image_galery').find('li').attr('qq-file-id');
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