
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
      Bandara      <small><?= cclang('detail', ['Bandara']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/bandara'); ?>">Bandara</a></li>
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
                     <h3 class="widget-user-username">Bandara</h3>
                     <h5 class="widget-user-desc">Detail Bandara</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_bandara" id="form_bandara" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Kode Sanitasi Sumsel </label>

                        <div class="col-sm-8">
                           <?= _ent($bandara->kode_sanitasi_sumsel); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Bandara Id </label>

                        <div class="col-sm-8">
                           <?= _ent($bandara->bandara_id); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Termi </label>

                        <div class="col-sm-8">
                           <?= _ent($bandara->nama_termi); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Klasifikasi </label>

                        <div class="col-sm-8">
                           <?= _ent($bandara->klasifikasi); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('bandara_update', function() use ($bandara){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit bandara (Ctrl+e)" href="<?= site_url('administrator/bandara/edit/'.$bandara->kode_sanitasi_sumsel); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Bandara']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/bandara/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Bandara']); ?></a>
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
