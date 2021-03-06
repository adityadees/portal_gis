
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
      Jalan Nasional      <small><?= cclang('detail', ['Jalan Nasional']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/jalan_nasional'); ?>">Jalan Nasional</a></li>
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
                     <h3 class="widget-user-username">Jalan Nasional</h3>
                     <h5 class="widget-user-desc">Detail Jalan Nasional</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_jalan_nasional" id="form_jalan_nasional" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Kode Jalan </label>

                        <div class="col-sm-8">
                           <?= _ent($jalan_nasional->kode_jalan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Jalan Id </label>

                        <div class="col-sm-8">
                           <?= _ent($jalan_nasional->jalan_id); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Jalan Status </label>

                        <div class="col-sm-8">
                           <?= _ent($jalan_nasional->jalan_status); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Jalan Fungsi </label>

                        <div class="col-sm-8">
                           <?= _ent($jalan_nasional->jalan_fungsi); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Jalan Sumber </label>

                        <div class="col-sm-8">
                           <?= _ent($jalan_nasional->jalan_sumber); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Jalan No Ruas </label>

                        <div class="col-sm-8">
                           <?= _ent($jalan_nasional->jalan_no_ruas); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Jalan Nama Ruas </label>

                        <div class="col-sm-8">
                           <?= _ent($jalan_nasional->jalan_nama_ruas); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Jalan Panjang (KM) </label>

                        <div class="col-sm-8">
                           <?= _ent($jalan_nasional->jalan_panjang); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Jalan Layer </label>

                        <div class="col-sm-8">
                           <?= _ent($jalan_nasional->jalan_layer); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Jalan Kegiatan </label>

                        <div class="col-sm-8">
                           <?= _ent($jalan_nasional->jalan_kegiatan); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('jalan_nasional_update', function() use ($jalan_nasional){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit jalan_nasional (Ctrl+e)" href="<?= site_url('administrator/jalan_nasional/edit/'.$jalan_nasional->kode_jalan); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Jalan Nasional']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/jalan_nasional/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Jalan Nasional']); ?></a>
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
