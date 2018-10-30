
<script src="<?= BASE_ASSET; ?>js/custom.js"></script>


<?= form_open('', [
    'name'    => 'form_form_tambah_historis_penanganan', 
    'class'   => 'form-horizontal form_form_tambah_historis_penanganan', 
    'id'      => 'form_form_tambah_historis_penanganan',
    'enctype' => 'multipart/form-data', 
    'method'  => 'POST'
]); ?>
 
<div class="form-group ">
    <label for="tahun" class="col-sm-2 control-label">Tahun 
    <i class="required">*</i>
    </label>
    <div class="col-sm-2">
        <select  class="form-control chosen chosen-select-deselect" name="tahun" id="tahun" data-placeholder="Select Tahun" >
            <option value=""></option>
            <?php for ($i = 1970; $i < date('Y')+100; $i++){ ?>
            <option value="<?= $i; ?>"><?= $i; ?></option>
            <?php }; ?> 
        </select>
        <small class="info help-block">
        </small>
    </div>
</div>
 
<div class="form-group ">
    <label for="volume_efektif" class="col-sm-2 control-label">Volume Efektif 
    <i class="required">*</i>
    </label>
    <div class="col-sm-8">
        <input type="number" class="form-control" name="volume_efektif" id="volume_efektif" placeholder=""  >
        <small class="info help-block">
        </small>
    </div>
</div>
 
<div class="form-group ">
    <label for="volume_penanganan" class="col-sm-2 control-label">Volume Penanganan 
    <i class="required">*</i>
    </label>
    <div class="col-sm-8">
        <input type="number" class="form-control" name="volume_penanganan" id="volume_penanganan" placeholder=""  >
        <small class="info help-block">
        </small>
    </div>
</div>
 
<div class="form-group ">
    <label for="sumber_dana" class="col-sm-2 control-label">Sumber Dana 
    <i class="required">*</i>
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="sumber_dana" id="sumber_dana" placeholder=""  >
        <small class="info help-block">
        </small>
    </div>
</div>
 
<div class="form-group ">
    <label for="keterangan" class="col-sm-2 control-label">Keterangan 
    <i class="required">*</i>
    </label>
    <div class="col-sm-8">
        <textarea id="keterangan" name="keterangan" rows="5" class="textarea" ></textarea>
        <small class="info help-block">
        </small>
    </div>
</div>


<div class="row col-sm-12 message">
</div>
<div class="col-sm-2">
</div>
<div class="col-sm-8 padding-left-0">
    <button class="btn btn-flat btn-primary btn_save" id="btn_save" data-stype='stay'>
    Submit
    </button>
    <span class="loading loading-hide">
    <img src="http://localhost:80/portal_gis/asset//img/loading-spin-primary.svg"> 
    <i>Loading, Submitting data</i>
    </span>
</div>
</form></div>


<!-- Page script -->
<script>
    $(document).ready(function(){
          $('.form-preview').submit(function(){
        return false;
     });

     $('input[type="checkbox"].flat-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
     });


    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_form_tambah_historis_penanganan = $('#form_form_tambah_historis_penanganan');
        var data_post = form_form_tambah_historis_penanganan.serializeArray();
        var save_type = $(this).attr('data-stype');
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + 'form/form_tambah_historis_penanganan/submit',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
                
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 1000);
        });
    
        return false;
      }); /*end btn save*/


      
             
           
    }); /*end doc ready*/
</script>