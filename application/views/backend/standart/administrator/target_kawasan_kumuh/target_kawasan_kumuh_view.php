
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
      Target Kawasan Kumuh      <small><?= cclang('detail', ['Target Kawasan Kumuh']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/target_kawasan_kumuh'); ?>">Target Kawasan Kumuh</a></li>
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
                     <h3 class="widget-user-username">Target Kawasan Kumuh</h3>
                     <h5 class="widget-user-desc">Detail Target Kawasan Kumuh</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_target_kawasan_kumuh" id="form_target_kawasan_kumuh" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Target Id </label>

                        <div class="col-sm-8">
                           <?= _ent($target_kawasan_kumuh->target_id); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Kawasan Kumuh </label>

                        <div class="col-sm-8">
                           <?= _ent($target_kawasan_kumuh->nama_kawas); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Target Tahun </label>

                        <div class="col-sm-8">
                           <?= _ent($target_kawasan_kumuh->target_tahun); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Target Volume </label>

                        <div class="col-sm-8">
                           <?= _ent($target_kawasan_kumuh->target_volume); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Satuan </label>

                        <div class="col-sm-8">
                           <?= _ent($target_kawasan_kumuh->target_satuan); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('target_kawasan_kumuh_update', function() use ($target_kawasan_kumuh){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit target_kawasan_kumuh (Ctrl+e)" href="<?= site_url('administrator/target_kawasan_kumuh/edit/'.$target_kawasan_kumuh->target_id); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Target Kawasan Kumuh']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/target_kawasan_kumuh/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Target Kawasan Kumuh']); ?></a>
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
