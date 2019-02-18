
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/Dokumentasi_air_bersih/add';
       return false;
   });

   $('*').bind('keydown', 'Ctrl+f', function assets() {
       $('#sbtn').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
       $('#reset').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+b', function assets() {

       $('#reset').trigger('click');
       return false;
   });
}

jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Dokumentasi Air Bersih<small><?= cclang('list_all'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dokumentasi Air Bersih</li>
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
                     <div class="row pull-right">
                        <?php is_allowed('dokumentasi_air_bersih_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['Dokumentasi Air Bersih']); ?>  (Ctrl+a)" href="<?=  site_url('administrator/dokumentasi_air_bersih/add'); ?>"><i class="fa fa-plus-square-o" ></i> <?= cclang('add_new_button', ['Dokumentasi Air Bersih']); ?></a>
                        <?php }) ?>
                        <?php is_allowed('dokumentasi_air_bersih_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Dokumentasi Air Bersih" href="<?= site_url('administrator/dokumentasi_air_bersih/export'); ?>"><i class="fa fa-file-excel-o" ></i> <?= cclang('export'); ?> XLS</a>
                        <?php }) ?>
                        <?php is_allowed('dokumentasi_air_bersih_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Dokumentasi Air Bersih" href="<?= site_url('administrator/dokumentasi_air_bersih/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> <?= cclang('export'); ?> PDF</a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Dokumentasi Air Bersih</h3>
                     <h5 class="widget-user-desc"><?= cclang('list_all', ['Dokumentasi Air Bersih']); ?>  <i class="label bg-yellow"><?= $dokumentasi_air_bersih_counts; ?>  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_dokumentasi_air_bersih" id="form_dokumentasi_air_bersih" action="<?= base_url('administrator/dokumentasi_air_bersih/index'); ?>">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <th>Nama Air Bersih</th>
                           <th>File</th>
                           <th>Tanggal</th>
                           <th>Keterangan</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_dokumentasi_air_bersih">
                     <?php foreach($dokumentasi_air_bersihs as $dokumentasi_air_bersih): ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $dokumentasi_air_bersih->kode_dabs; ?>">
                           </td>
                           
                           <td><?= _ent($dokumentasi_air_bersih->text_kecamatan); ?></td>
                             
                           <td>
                              <?php if (!empty($dokumentasi_air_bersih->file)): ?>
                                <?php if (is_image($dokumentasi_air_bersih->file)): ?>
                                <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/dokumentasi_air_bersih/' . $dokumentasi_air_bersih->file; ?>">
                                  <img src="<?= BASE_URL . 'uploads/dokumentasi_air_bersih/' . $dokumentasi_air_bersih->file; ?>" class="image-responsive" alt="image dokumentasi_air_bersih" title="file dokumentasi_air_bersih" width="40px">
                                </a>
                                <?php else: ?>
                                  <a href="<?= BASE_URL . 'administrator/file/download/dokumentasi_air_bersih/' . $dokumentasi_air_bersih->file; ?>">
                                   <img src="<?= get_icon_file($dokumentasi_air_bersih->file); ?>" class="image-responsive image-icon" alt="image dokumentasi_air_bersih" title="file <?= $dokumentasi_air_bersih->file; ?>" width="40px"> 
                                 </a>
                                <?php endif; ?>
                              <?php endif; ?>
                           </td>
                            
                           <td><?= _ent($dokumentasi_air_bersih->dokumen_tanggal); ?></td> 
                           <td><?= _ent($dokumentasi_air_bersih->dokumentasi_nama); ?></td> 
                           <td width="200">
                              <?php is_allowed('dokumentasi_air_bersih_view', function() use ($dokumentasi_air_bersih){?>
                              <a href="<?= site_url('administrator/dokumentasi_air_bersih/view/' . $dokumentasi_air_bersih->kode_dabs); ?>" class="label-default"><i class="fa fa-newspaper-o"></i> <?= cclang('view_button'); ?>
                              <?php }) ?>
                              <?php is_allowed('dokumentasi_air_bersih_update', function() use ($dokumentasi_air_bersih){?>
                              <a href="<?= site_url('administrator/dokumentasi_air_bersih/edit/' . $dokumentasi_air_bersih->kode_dabs); ?>" class="label-default"><i class="fa fa-edit "></i> <?= cclang('update_button'); ?></a>
                              <?php }) ?>
                              <?php is_allowed('dokumentasi_air_bersih_delete', function() use ($dokumentasi_air_bersih){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/dokumentasi_air_bersih/delete/' . $dokumentasi_air_bersih->kode_dabs); ?>" class="label-default remove-data"><i class="fa fa-close"></i> <?= cclang('remove_button'); ?></a>
                               <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($dokumentasi_air_bersih_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           Dokumentasi Air Bersih data is not available
                           </td>
                         </tr>
                      <?php endif; ?>
                     </tbody>
                  </table>
                  </div>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">
                     <div class="col-sm-2 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="bulk" id="bulk" placeholder="Site Email" >
                           <option value="">Bulk</option>
                           <option value="delete">Delete</option>
                        </select>
                     </div>
                     <div class="col-sm-2 padd-left-0 ">
                        <button type="button" class="btn btn-flat" name="apply" id="apply" title="<?= cclang('apply_bulk_action'); ?>"><?= cclang('apply_button'); ?></button>
                     </div>
                     <div class="col-sm-3 padd-left-0  " >
                        <input type="text" class="form-control" name="q" id="filter" placeholder="<?= cclang('filter'); ?>" value="<?= $this->input->get('q'); ?>">
                     </div>
                     <div class="col-sm-3 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value=""><?= cclang('all'); ?></option>
                            <option <?= $this->input->get('f') == 'air_bersih_sumsel_id' ? 'selected' :''; ?> value="air_bersih_sumsel_id">Air Bersih Sumsel Id</option>
                           <option <?= $this->input->get('f') == 'file' ? 'selected' :''; ?> value="file">File</option>
                           <option <?= $this->input->get('f') == 'dokumen_tanggal' ? 'selected' :''; ?> value="dokumen_tanggal">Dokumen Tanggal</option>
                           <option <?= $this->input->get('f') == 'dokumentasi_nama' ? 'selected' :''; ?> value="dokumentasi_nama">Dokumentasi Nama</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/dokumentasi_air_bersih');?>" title="<?= cclang('reset_filter'); ?>">
                        <i class="fa fa-undo"></i>
                        </a>
                     </div>
                  </div>
                  </form>                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                        <?= $pagination; ?>
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

<!-- Page script -->
<script>
  $(document).ready(function(){
   
    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_dokumentasi_air_bersih').serialize();

      if (bulk.val() == 'delete') {
         swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
            cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
               document.location.href = BASE_URL + '/administrator/dokumentasi_air_bersih/delete?' + serialize_bulk;      
            }
          });

        return false;

      } else if(bulk.val() == '')  {
          swal({
            title: "Upss",
            text: "<?= cclang('please_choose_bulk_action_first'); ?>",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Okay!",
            closeOnConfirm: true,
            closeOnCancel: true
          });

        return false;
      }

      return false;

    });/*end appliy click*/


    //check all
    var checkAll = $('#check_all');
    var checkboxes = $('input.check');

    checkAll.on('ifChecked ifUnchecked', function(event) {   
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });

  }); /*end doc ready*/
</script>