
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
      Stasiun      <small><?= cclang('detail', ['Stasiun']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/stasiun'); ?>">Stasiun</a></li>
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
                     <h3 class="widget-user-username">Stasiun</h3>
                     <h5 class="widget-user-desc">Detail Stasiun</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_stasiun" id="form_stasiun" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Kode Sanitasi Sumsel </label>

                        <div class="col-sm-8">
                           <?= _ent($stasiun->kode_sanitasi_sumsel); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Stasiun Id </label>

                        <div class="col-sm-8">
                           <?= _ent($stasiun->stasiun_id); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Termi </label>

                        <div class="col-sm-8">
                           <?= _ent($stasiun->nama_termi); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Klasifikasi </label>

                        <div class="col-sm-8">
                           <?= _ent($stasiun->klasifikasi); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Stasiun Dtampung </label>

                        <div class="col-sm-8">
                           <?= _ent($stasiun->stasiun_dtampung); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('stasiun_update', function() use ($stasiun){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit stasiun (Ctrl+e)" href="<?= site_url('administrator/stasiun/edit/'.$stasiun->kode_sanitasi_sumsel); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Stasiun']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/stasiun/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Stasiun']); ?></a>
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