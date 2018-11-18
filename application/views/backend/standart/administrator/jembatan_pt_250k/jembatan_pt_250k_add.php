
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
        Jembatan Pt 250k        <small><?= cclang('new', ['Jembatan Pt 250k']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/jembatan_pt_250k'); ?>">Jembatan Pt 250k</a></li>
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
                            <h3 class="widget-user-username">Jembatan Pt 250k</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Jembatan Pt 250k']); ?></h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_jembatan_pt_250k', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_jembatan_pt_250k', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="jembatan_id" class="col-sm-2 control-label">Jembatan Id 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="jembatan_id" id="jembatan_id" placeholder="Jembatan Id" value="<?= set_value('jembatan_id'); ?>">
                                <small class="info help-block">
                                <b>Input Jembatan Id</b> Max Length : 11.</small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="field1-field18" class="col-sm-2 control-label">Field1-field18 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="field1-field18" name="field1-field18" rows="5" cols="80"><?= set_value('Field1-field18'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed2" class="col-sm-2 control-label">Filed2 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed2" id="filed2" placeholder="Filed2" value="<?= set_value('filed2'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed3" class="col-sm-2 control-label">Filed3 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed3" id="filed3" placeholder="Filed3" value="<?= set_value('filed3'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed4" class="col-sm-2 control-label">Filed4 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed4" id="filed4" placeholder="Filed4" value="<?= set_value('filed4'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed5" class="col-sm-2 control-label">Filed5 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed5" id="filed5" placeholder="Filed5" value="<?= set_value('filed5'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed6" class="col-sm-2 control-label">Filed6 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed6" id="filed6" placeholder="Filed6" value="<?= set_value('filed6'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed7" class="col-sm-2 control-label">Filed7 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed7" id="filed7" placeholder="Filed7" value="<?= set_value('filed7'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed8" class="col-sm-2 control-label">Filed8 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed8" id="filed8" placeholder="Filed8" value="<?= set_value('filed8'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed9" class="col-sm-2 control-label">Filed9 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed9" id="filed9" placeholder="Filed9" value="<?= set_value('filed9'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed10" class="col-sm-2 control-label">Filed10 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed10" id="filed10" placeholder="Filed10" value="<?= set_value('filed10'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed11" class="col-sm-2 control-label">Filed11 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed11" id="filed11" placeholder="Filed11" value="<?= set_value('filed11'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed12" class="col-sm-2 control-label">Filed12 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed12" id="filed12" placeholder="Filed12" value="<?= set_value('filed12'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed13" class="col-sm-2 control-label">Filed13 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed13" id="filed13" placeholder="Filed13" value="<?= set_value('filed13'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed14" class="col-sm-2 control-label">Filed14 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed14" id="filed14" placeholder="Filed14" value="<?= set_value('filed14'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed15" class="col-sm-2 control-label">Filed15 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed15" id="filed15" placeholder="Filed15" value="<?= set_value('filed15'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed16" class="col-sm-2 control-label">Filed16 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed16" id="filed16" placeholder="Filed16" value="<?= set_value('filed16'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed17" class="col-sm-2 control-label">Filed17 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed17" id="filed17" placeholder="Filed17" value="<?= set_value('filed17'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="filed18" class="col-sm-2 control-label">Filed18 
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="filed18" id="filed18" placeholder="Filed18" value="<?= set_value('filed18'); ?>">
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
            CKEDITOR.replace('field1-field18'); 
      var field1-field18 = CKEDITOR.instances.field1-field18;
                   
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
              window.location.href = BASE_URL + 'administrator/jembatan_pt_250k';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#field1-field18').val(field1-field18.getData());
                    
        var form_jembatan_pt_250k = $('#form_jembatan_pt_250k');
        var data_post = form_jembatan_pt_250k.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/jembatan_pt_250k/add_save',
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
            field1-field18.setData('');
                
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