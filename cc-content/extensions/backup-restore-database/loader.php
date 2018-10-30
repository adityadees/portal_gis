<?php 
namespace DisableBuilder;

app()->load->library('cc_html');


app()->cc_html->registerHtmlFileBottom('

        <div class="modal fade" id="modal-restore">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Restore</h4>
                    </div>
                    <div class="modal-body">
                    '.form_open('utils/act/restore', [
                    'name'    => 'form_user', 
                    'class'   => 'form-restore', 
                    'id'      => 'form-restore', 
                    'enctype' => 'multipart/form-data', 
                    'method'  => 'POST'
                  ]).'
                        <input type="file" name="database_file">
                        <hr>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" title="">Restore database</button>
                    </div>
                        </form>

                </div>
            </div>
        </div>

');

cicool()->addTabSetting([
    'id' => 'backup_restore_db',
    'label' => 'Backup Restore DB',
    'icon' => 'fa fa-database',
])->addTabContent([
    'content' => ' 
    <div class="col-md-6">
        <div class="col-sm-12">
            <label>Backup Database</label><br>
            <a href="'.base_url('utils/act/backup').'" class="btn btn-default" title="">Backup database</a>
            <small class="info help-block">Backup database as zip.</small>
        </div>

        <div class="col-sm-12">
            <label>Disable API Builder </label><br>
            <button type="submit" class="btn btn-default btn-restore" title="">Restore database</button>
            <small class="info help-block">Restore database by uploading sql files.</small>
        </div>

    </div>

    <script>
    $(function(){
        $(".btn-restore").click(function(e){
            e.preventDefault();
            $("#modal-restore").modal("show");
        })
    })
    </script>
    '
])
->settingBeforeSave(function($form){
})
->settingOnSave(function($ci){
   
});

app()->load->library('aauth');
cicool()->onRoute('utils/act/backup', 'get', function(){
    if (!app()->aauth->is_allowed('db_backup') ) {
        redirect_back();
    }
    app()->load->dbutil();

    $backup = app()->dbutil->backup();

    app()->load->helper('download');
    force_download('mybackup.zip', $backup);
});

cicool()->onRoute('utils/act/restore', 'post', function(){
    if (!app()->aauth->is_allowed('db_restore') ) {
        redirect_back();
    }

    $config['upload_path'] = './uploads/tmp/';
    $config['allowed_types'] = '*';
    $config['max_size']  = '10000';
    
    app()->load->helpers('file');
    app()->load->library('upload', $config);

    if ( ! app()->upload->do_upload('database_file')){
        $error = array('error' => app()->upload->display_errors());
        set_message(app()->upload->display_errors(), 'error');
        redirect_back();
    }
    else{
        $data = app()->upload->data();
        $path = './uploads/tmp/'.$data['file_name'];
        if ($data['file_ext'] != '.sql') {
          set_message('file must sql files', 'error');
          delete_files($path);
          redirect_back();
        }
        $contains = file_get_contents($path);
          $string_query = rtrim( $contains, "\n;" );
          $array_query = explode(";", $string_query);
          foreach($array_query as $query) {
            app()->db->query($query);
          }
          delete_files($path);
          set_message('database restored');
          redirect_back();
    }
   
});



if(!defined('EXNAMEBRD')) define('EXNAMEBRD', basename(__DIR__));
if ($ccExtension->actived()) {
   app()->cc_app->onEvent('extension_info_'.EXNAMEBRD, function(){
    echo '<div class="callout callout-warning-cc ">go to page '.anchor('administrator/setting/?tab=tab_backup_restore_db', 'setting', ['class' => 'btn btn-xs btn-info btn-flat']).' for configuration</div>';
    });
}
