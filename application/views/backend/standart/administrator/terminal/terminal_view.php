
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
      Terminal      <small><?= cclang('detail', ['Terminal']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/terminal'); ?>">Terminal</a></li>
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
                     <h3 class="widget-user-username">Terminal</h3>
                     <h5 class="widget-user-desc">Detail Terminal</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_terminal" id="form_terminal" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Kode Sanitasi Sumsel </label>

                        <div class="col-sm-8">
                           <?= _ent($terminal->kode_sanitasi_sumsel); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Terminal Id </label>

                        <div class="col-sm-8">
                           <?= _ent($terminal->terminal_id); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama Termi </label>

                        <div class="col-sm-8">
                           <?= _ent($terminal->nama_termi); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Klasifikasi </label>

                        <div class="col-sm-8">
                           <?= _ent($terminal->klasifikasi); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Terminal Dtampung </label>

                        <div class="col-sm-8">
                           <?= _ent($terminal->terminal_dtampung); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('terminal_update', function() use ($terminal){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit terminal (Ctrl+e)" href="<?= site_url('administrator/terminal/edit/'.$terminal->kode_sanitasi_sumsel); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Terminal']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/terminal/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Terminal']); ?></a>
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