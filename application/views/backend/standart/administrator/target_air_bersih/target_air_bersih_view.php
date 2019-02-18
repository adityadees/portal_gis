
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+e', function assets() {
      $('#btn_edit').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
      $('#btn_back').trigger('click');
       return false;
   });
    
}


jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Target Air Bersih      <small><?= cclang('detail', ['Target Air Bersih']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/target_air_bersih'); ?>">Target Air Bersih</a></li>
      <li class="active"><?= cclang('detail'); ?></li>
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
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/view.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Target Air Bersih</h3>
                     <h5 class="widget-user-desc">Detail Target Air Bersih</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_target_air_bersih" id="form_target_air_bersih" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Target Id </label>

                        <div class="col-sm-8">
                           <?= _ent($target_air_bersih->target_id); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Daerah </label>

                        <div class="col-sm-8">
                           <?= _ent($target_air_bersih->text_kecamatan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Target Tahun </label>

                        <div class="col-sm-8">
                           <?= _ent($target_air_bersih->target_tahun); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Target Volume </label>

                        <div class="col-sm-8">
                           <?= _ent($target_air_bersih->target_volume); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Satuan </label>

                        <div class="col-sm-8">
                           <?= _ent($target_air_bersih->target_satuan); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('target_air_bersih_update', function() use ($target_air_bersih){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit target_air_bersih (Ctrl+e)" href="<?= site_url('administrator/target_air_bersih/edit/'.$target_air_bersih->target_id); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Target Air Bersih']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/target_air_bersih/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Target Air Bersih']); ?></a>
                     </div>
                    
                  </div>
               </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>
</section>
<!-- /.content -->
