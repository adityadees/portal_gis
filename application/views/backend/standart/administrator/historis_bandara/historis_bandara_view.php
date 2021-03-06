
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
      Historis Bandara      <small><?= cclang('detail', ['Historis Bandara']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/historis_bandara'); ?>">Historis Bandara</a></li>
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
                     <h3 class="widget-user-username">Historis Bandara</h3>
                     <h5 class="widget-user-desc">Detail Historis Bandara</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_historis_bandara" id="form_historis_bandara" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Kode Historis Bandara Sumsel </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_bandara->kode_historis_bandara_sumsel); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Bandara </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_bandara->nama_termi); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Volume Efektif </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_bandara->historis_vefektif); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Historis Tahun </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_bandara->historis_tahun); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Kegiatan </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_bandara->historis_namakeg); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Volume Penanganan </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_bandara->historis_vpenanganan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Sumber Dana </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_bandara->historis_sdana); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Historis Ket </label>

                        <div class="col-sm-8">
                           <?= _ent($historis_bandara->historis_ket); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('historis_bandara_update', function() use ($historis_bandara){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit historis_bandara (Ctrl+e)" href="<?= site_url('administrator/historis_bandara/edit/'.$historis_bandara->kode_historis_bandara_sumsel); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Historis Bandara']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/historis_bandara/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Historis Bandara']); ?></a>
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
