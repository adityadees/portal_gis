
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
      Fitur Kategori Objek Pengamatans      <small><?= cclang('detail', ['Fitur Kategori Objek Pengamatans']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/fitur_kategori_objek_pengamatans'); ?>">Fitur Kategori Objek Pengamatans</a></li>
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
                     <h3 class="widget-user-username">Fitur Kategori Objek Pengamatans</h3>
                     <h5 class="widget-user-desc">Detail Fitur Kategori Objek Pengamatans</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_fitur_kategori_objek_pengamatans" id="form_fitur_kategori_objek_pengamatans" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">KODE FKOP </label>

                        <div class="col-sm-8">
                           <?= _ent($fitur_kategori_objek_pengamatans->KODE_FKOP); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">KATEGORI OBJEK PENGAMATAN </label>

                        <div class="col-sm-8">
                           <?= _ent($fitur_kategori_objek_pengamatans->NAMA_KOP); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">JENIS PLOT </label>

                        <div class="col-sm-8">
                           <?= _ent($fitur_kategori_objek_pengamatans->NAMA_JP); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('fitur_kategori_objek_pengamatans_update', function() use ($fitur_kategori_objek_pengamatans){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit fitur_kategori_objek_pengamatans (Ctrl+e)" href="<?= site_url('administrator/fitur_kategori_objek_pengamatans/edit/'.$fitur_kategori_objek_pengamatans->KODE_FKOP); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Fitur Kategori Objek Pengamatans']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/fitur_kategori_objek_pengamatans/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Fitur Kategori Objek Pengamatans']); ?></a>
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
