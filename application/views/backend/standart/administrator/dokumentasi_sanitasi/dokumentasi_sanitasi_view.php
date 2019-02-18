
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
      Dokumentasi Sanitasi      <small><?= cclang('detail', ['Dokumentasi Sanitasi']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/dokumentasi_sanitasi'); ?>">Dokumentasi Sanitasi</a></li>
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
                     <h3 class="widget-user-username">Dokumentasi Sanitasi</h3>
                     <h5 class="widget-user-desc">Detail Dokumentasi Sanitasi</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_dokumentasi_sanitasi" id="form_dokumentasi_sanitasi" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Kode Dss </label>

                        <div class="col-sm-8">
                           <?= _ent($dokumentasi_sanitasi->kode_dss); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Sanitasi </label>

                        <div class="col-sm-8">
                           <?= _ent($dokumentasi_sanitasi->text_kecamatan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label"> File </label>
                        <div class="col-sm-8">
                             <?php if (is_image($dokumentasi_sanitasi->file)): ?>
                              <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/dokumentasi_sanitasi/' . $dokumentasi_sanitasi->file; ?>">
                                <img src="<?= BASE_URL . 'uploads/dokumentasi_sanitasi/' . $dokumentasi_sanitasi->file; ?>" class="image-responsive" alt="image dokumentasi_sanitasi" title="file dokumentasi_sanitasi" width="40px">
                              </a>
                              <?php else: ?>
                              <label>
                                <a href="<?= BASE_URL . 'administrator/file/download/dokumentasi_sanitasi/' . $dokumentasi_sanitasi->file; ?>">
                                 <img src="<?= get_icon_file($dokumentasi_sanitasi->file); ?>" class="image-responsive" alt="image dokumentasi_sanitasi" title="file <?= $dokumentasi_sanitasi->file; ?>" width="40px"> 
                               <?= $dokumentasi_sanitasi->file ?>
                               </a>
                               </label>
                              <?php endif; ?>
                        </div>
                    </div>
                                       
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Tanggal Dokumentasi </label>

                        <div class="col-sm-8">
                           <?= _ent($dokumentasi_sanitasi->dokumen_tanggal); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Keterangan </label>

                        <div class="col-sm-8">
                           <?= _ent($dokumentasi_sanitasi->dokumentasi_nama); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('dokumentasi_sanitasi_update', function() use ($dokumentasi_sanitasi){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit dokumentasi_sanitasi (Ctrl+e)" href="<?= site_url('administrator/dokumentasi_sanitasi/edit/'.$dokumentasi_sanitasi->kode_dss); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Dokumentasi Sanitasi']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/dokumentasi_sanitasi/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Dokumentasi Sanitasi']); ?></a>
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
