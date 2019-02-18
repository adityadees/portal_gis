
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+a', function assets() {
       window.location.href = BASE_URL + '/administrator/Historis_jalan_nasional/add';
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
      Historis Jalan Nasional<small><?= cclang('list_all'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Historis Jalan Nasional</li>
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
                        <?php is_allowed('historis_jalan_nasional_add', function(){?>
                        <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="<?= cclang('add_new_button', ['Historis Jalan Nasional']); ?>  (Ctrl+a)" href="<?=  site_url('administrator/historis_jalan_nasional/add'); ?>"><i class="fa fa-plus-square-o" ></i> <?= cclang('add_new_button', ['Historis Jalan Nasional']); ?></a>
                        <?php }) ?>
                        <?php is_allowed('historis_jalan_nasional_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> Historis Jalan Nasional" href="<?= site_url('administrator/historis_jalan_nasional/export'); ?>"><i class="fa fa-file-excel-o" ></i> <?= cclang('export'); ?> XLS</a>
                        <?php }) ?>
                        <?php is_allowed('historis_jalan_nasional_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export'); ?> pdf Historis Jalan Nasional" href="<?= site_url('administrator/historis_jalan_nasional/export_pdf'); ?>"><i class="fa fa-file-pdf-o" ></i> <?= cclang('export'); ?> PDF</a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Historis Jalan Nasional</h3>
                     <h5 class="widget-user-desc"><?= cclang('list_all', ['Historis Jalan Nasional']); ?>  <i class="label bg-yellow"><?= $historis_jalan_nasional_counts; ?>  <?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_historis_jalan_nasional" id="form_historis_jalan_nasional" action="<?= base_url('administrator/historis_jalan_nasional/index'); ?>">
                  

                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>
                            <input type="checkbox" class="flat-red toltip" id="check_all" name="check_all" title="check all">
                           </th>
                           <th>Nama Jalan</th>
                           <th>Volume Efektif</th>
                           <th>Historis Tahun</th>
                           <th>Historis Penanganan</th>
                           <th>Sumber Dana</th>
                           <th>Historis Ket</th>
                           <th>Nama Kegiatan</th>
                           <th>Historis Sta</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_historis_jalan_nasional">
                     <?php foreach($historis_jalan_nasionals as $historis_jalan_nasional): ?>
                        <tr>
                           <td width="5">
                              <input type="checkbox" class="flat-red check" name="id[]" value="<?= $historis_jalan_nasional->kode_historis_jl; ?>">
                           </td>
                           
                           <td><?= _ent($historis_jalan_nasional->jalan_nama_ruas); ?></td>
                             
                           <td><?= _ent($historis_jalan_nasional->historis_vefektif); ?></td> 
                           <td><?= _ent($historis_jalan_nasional->historis_tahun); ?></td> 
                           <td><?= _ent($historis_jalan_nasional->historis_vpenanganan); ?></td> 
                           <td><?= _ent($historis_jalan_nasional->historis_sdana); ?></td> 
                           <td><?= _ent($historis_jalan_nasional->historis_ket); ?></td> 
                           <td><?= _ent($historis_jalan_nasional->historis_namakeg); ?></td> 
                           <td><?= _ent($historis_jalan_nasional->historis_sta); ?></td> 
                           <td width="200">
                              <?php is_allowed('historis_jalan_nasional_view', function() use ($historis_jalan_nasional){?>
                              <a href="<?= site_url('administrator/historis_jalan_nasional/view/' . $historis_jalan_nasional->kode_historis_jl); ?>" class="label-default"><i class="fa fa-newspaper-o"></i> <?= cclang('view_button'); ?>
                              <?php }) ?>
                              <?php is_allowed('historis_jalan_nasional_update', function() use ($historis_jalan_nasional){?>
                              <a href="<?= site_url('administrator/historis_jalan_nasional/edit/' . $historis_jalan_nasional->kode_historis_jl); ?>" class="label-default"><i class="fa fa-edit "></i> <?= cclang('update_button'); ?></a>
                              <?php }) ?>
                              <?php is_allowed('historis_jalan_nasional_delete', function() use ($historis_jalan_nasional){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/historis_jalan_nasional/delete/' . $historis_jalan_nasional->kode_historis_jl); ?>" class="label-default remove-data"><i class="fa fa-close"></i> <?= cclang('remove_button'); ?></a>
                               <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($historis_jalan_nasional_counts == 0) :?>
                         <tr>
                           <td colspan="100">
                           Historis Jalan Nasional data is not available
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
                            <option <?= $this->input->get('f') == 'jalan_id' ? 'selected' :''; ?> value="jalan_id">Jalan Id</option>
                           <option <?= $this->input->get('f') == 'historis_vefektif' ? 'selected' :''; ?> value="historis_vefektif">Historis Vefektif</option>
                           <option <?= $this->input->get('f') == 'historis_tahun' ? 'selected' :''; ?> value="historis_tahun">Historis Tahun</option>
                           <option <?= $this->input->get('f') == 'historis_vpenanganan' ? 'selected' :''; ?> value="historis_vpenanganan">Historis Vpenanganan</option>
                           <option <?= $this->input->get('f') == 'historis_sdana' ? 'selected' :''; ?> value="historis_sdana">Historis Sdana</option>
                           <option <?= $this->input->get('f') == 'historis_ket' ? 'selected' :''; ?> value="historis_ket">Historis Ket</option>
                           <option <?= $this->input->get('f') == 'historis_namakeg' ? 'selected' :''; ?> value="historis_namakeg">Historis Namakeg</option>
                           <option <?= $this->input->get('f') == 'historis_sta' ? 'selected' :''; ?> value="historis_sta">Historis Sta</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <a class="btn btn-default btn-flat" name="reset" id="reset" value="Apply" href="<?= base_url('administrator/historis_jalan_nasional');?>" title="<?= cclang('reset_filter'); ?>">
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
      var serialize_bulk = $('#form_historis_jalan_nasional').serialize();

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
               document.location.href = BASE_URL + '/administrator/historis_jalan_nasional/delete?' + serialize_bulk;      
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