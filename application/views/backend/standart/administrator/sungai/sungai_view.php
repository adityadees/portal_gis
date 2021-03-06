
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
      Sungai      <small><?= cclang('detail', ['Sungai']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/sungai'); ?>">Sungai</a></li>
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
                     <h3 class="widget-user-username">Sungai</h3>
                     <h5 class="widget-user-desc">Detail Sungai</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_sungai" id="form_sungai" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Kode Sungai </label>

                        <div class="col-sm-8">
                           <?= _ent($sungai->kode_sungai); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Sungai Id </label>

                        <div class="col-sm-8">
                           <?= _ent($sungai->sungai_id); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Fnode  </label>

                        <div class="col-sm-8">
                           <?= _ent($sungai->fnode_); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Tnode </label>

                        <div class="col-sm-8">
                           <?= _ent($sungai->tnode); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Lpoly  </label>

                        <div class="col-sm-8">
                           <?= _ent($sungai->lpoly_); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Length </label>

                        <div class="col-sm-8">
                           <?= _ent($sungai->length); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Sungai  </label>

                        <div class="col-sm-8">
                           <?= _ent($sungai->sungai_); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Saluran </label>

                        <div class="col-sm-8">
                           <?= _ent($sungai->saluran); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Text Sungai </label>

                        <div class="col-sm-8">
                           <?= _ent($sungai->text_sungai); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Klasifikasi </label>

                        <div class="col-sm-8">
                           <?= _ent($sungai->klasifikasi); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('sungai_update', function() use ($sungai){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit sungai (Ctrl+e)" href="<?= site_url('administrator/sungai/edit/'.$sungai->kode_sungai); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Sungai']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/sungai/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Sungai']); ?></a>
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
