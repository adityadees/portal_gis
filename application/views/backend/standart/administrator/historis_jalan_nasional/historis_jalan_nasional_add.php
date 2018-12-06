
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
        Historis Jalan Nasional        <small><?= cclang('new', ['Historis Jalan Nasional']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/historis_jalan_nasional'); ?>">Historis Jalan Nasional</a></li>
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
                            <h3 class="widget-user-username">Historis Jalan Nasional</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Historis Jalan Nasional']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_historis_jalan_nasional', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_historis_jalan_nasional', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="jalan_id" class="col-sm-2 control-label">Jalan Id 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="jalan_id" id="jalan_id" data-placeholder="Select Jalan Id" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('jalan_nasional') as $row): ?>
                                    <option value="<?= $row->jalan_id ?>"><?= $row->jalan_id; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Jalan Id</b> Max Length : 11.</small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="historis_vefektif" class="col-sm-2 control-label">Historis Vefektif 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="historis_vefektif" id="historis_vefektif" placeholder="Historis Vefektif" value="<?= set_value('historis_vefektif'); ?>">
                                <small class="info help-block">
                                <b>Input Historis Vefektif</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="historis_tahun" class="col-sm-2 control-label">Historis Tahun 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-2">
                                <select  class="form-control chosen chosen-select-deselect" name="historis_tahun" id="historis_tahun" data-placeholder="Select Historis Tahun" >
                                    <option value=""></option>
                                    <?php for ($i = 1970; $i < date('Y')+100; $i++){ ?>
                                    <option value="<?= $i;?>"><?= $i; ?></option>
                                    <?php }; ?>  
                                </select>
                                <small class="info help-block">
                                <b>Input Historis Tahun</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="historis_vpenanganan" class="col-sm-2 control-label">Historis Vpenanganan 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="historis_vpenanganan" id="historis_vpenanganan" placeholder="Historis Vpenanganan" value="<?= set_value('historis_vpenanganan'); ?>">
                                <small class="info help-block">
                                <b>Input Historis Vpenanganan</b> Max Length : 50.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="historis_sdana" class="col-sm-2 control-label">Historis Sdana 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="historis_sdana" id="historis_sdana" placeholder="Historis Sdana" value="<?= set_value('historis_sdana'); ?>">
                                <small class="info help-block">
                                <b>Input Historis Sdana</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="historis_ket" class="col-sm-2 control-label">Historis Ket 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="historis_ket" id="historis_ket" placeholder="Historis Ket" value="<?= set_value('historis_ket'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="historis_namakeg" class="col-sm-2 control-label">Historis Namakeg 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datepicker" name="historis_namakeg"  placeholder="Historis Namakeg" id="historis_namakeg">
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
              window.location.href = BASE_URL + 'administrator/historis_jalan_nasional';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_historis_jalan_nasional = $('#form_historis_jalan_nasional');
        var data_post = form_historis_jalan_nasional.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/historis_jalan_nasional/add_save',
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