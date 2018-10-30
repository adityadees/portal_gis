
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
      Tambah Dokumentasi      <small><?= cclang('detail', 'Tambah Dokumentasi'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/form_tambah_dokumentasi'); ?>">Tambah Dokumentasi</a></li>
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
                     <h3 class="widget-user-username">Tambah Dokumentasi</h3>
                     <h5 class="widget-user-desc">Detail Tambah Dokumentasi</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_form_tambah_dokumentasi" id="form_form_tambah_dokumentasi" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label"> File </label>
                        <div class="col-sm-8">
                             <?php if (is_image($form_tambah_dokumentasi->file)): ?>
                              <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/form_tambah_dokumentasi/' . $form_tambah_dokumentasi->file; ?>">
                                <img src="<?= BASE_URL . 'uploads/form_tambah_dokumentasi/' . $form_tambah_dokumentasi->file; ?>" class="image-responsive" alt="image form_tambah_dokumentasi" title="File form_tambah_dokumentasi" width="40px">
                              </a>
                              <?php else: ?>
                              <label>
                                <a href="<?= BASE_URL . 'administrator/file/download/form_tambah_dokumentasi/' . $form_tambah_dokumentasi->file; ?>">
                                 <img src="<?= get_icon_file($form_tambah_dokumentasi->file); ?>" class="image-responsive" alt="image form_tambah_dokumentasi" title="File <?= $form_tambah_dokumentasi->file; ?>" width="40px"> 
                               <?= $form_tambah_dokumentasi->file ?>
                               </a>
                               </label>
                              <?php endif; ?>
                        </div>
                    </div>
                                      
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('form_tambah_dokumentasi_update', function() use ($form_tambah_dokumentasi){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="<?= cclang('update', 'form_tambah_dokumentasi'); ?> (Ctrl+e)" href="<?= site_url('administrator/form_tambah_dokumentasi/edit/'.$form_tambah_dokumentasi->id); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', 'Form Tambah Dokumentasi'); ?></a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/form_tambah_dokumentasi/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list', 'Form Tambah Dokumentasi'); ?></a>
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
