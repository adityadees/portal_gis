
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
      Historis Kawasan Kumuh      <small><?= cclang('detail', ['Historis Kawasan Kumuh']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/historis_kawasan_kumuh'); ?>">Historis Kawasan Kumuh</a></li>
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
                     <h3 class="widget-user-username">Historis Kawasan Kumuh</h3>
                     <h5 class="widget-user-desc">Detail Historis Kawasan Kumuh</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_historis_kawasan_kumuh" id="form_historis_kawasan_kumuh" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Kode Historis Kk </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_kawasan_kumuh->kode_historis_kk); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Kawasan Kumuh </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_kawasan_kumuh->nama_kaw); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Volume Efektif </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_kawasan_kumuh->historis_vefektif); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Historis Tahun </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_kawasan_kumuh->historis_tahun); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Kegiatan </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_kawasan_kumuh->historis_namakeg); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Volume Penanganan </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_kawasan_kumuh->historis_vpenanganan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Sumber Dana </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_kawasan_kumuh->historis_sdana); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Historis Ket </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_kawasan_kumuh->historis_ket); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Maplinks Id </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_kawasan_kumuh->maplinks_id); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('historis_kawasan_kumuh_update', function() use ($historis_kawasan_kumuh){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit historis_kawasan_kumuh (Ctrl+e)" href="<?= site_url('administrator/historis_kawasan_kumuh/edit/'.$historis_kawasan_kumuh->kode_historis_kk); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Historis Kawasan Kumuh']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/historis_kawasan_kumuh/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Historis Kawasan Kumuh']); ?></a>
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
