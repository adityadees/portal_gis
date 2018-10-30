<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Tambah Data Umum Controller
*| --------------------------------------------------------------------------
*| Form Tambah Data Umum site
*|
*/
class Form_tambah_data_umum extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_tambah_data_umum');
	}

	/**
	* show all Form Tambah Data Umums
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('form_tambah_data_umum_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['form_tambah_data_umums'] = $this->model_form_tambah_data_umum->get($filter, $field, $this->limit_page, $offset);
		$this->data['form_tambah_data_umum_counts'] = $this->model_form_tambah_data_umum->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/form_tambah_data_umum/index/',
			'total_rows'   => $this->model_form_tambah_data_umum->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tambah Data Umum List');
		$this->render('backend/standart/administrator/form_builder/form_tambah_data_umum/form_tambah_data_umum_list', $this->data);
	}

	/**
	* Update view Form Tambah Data Umums
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('form_tambah_data_umum_update');

		$this->data['form_tambah_data_umum'] = $this->model_form_tambah_data_umum->find($id);

		$this->template->title('Tambah Data Umum Update');
		$this->render('backend/standart/administrator/form_builder/form_tambah_data_umum/form_tambah_data_umum_update', $this->data);
	}

	/**
	* Update Form Tambah Data Umums
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('form_tambah_data_umum_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('form_tambah_data_umum_file_name', 'File', 'trim|required');
		
		if ($this->form_validation->run()) {
			$form_tambah_data_umum_file_uuid = $this->input->post('form_tambah_data_umum_file_uuid');
			$form_tambah_data_umum_file_name = $this->input->post('form_tambah_data_umum_file_name');
		
			$save_data = [
			];

			if (!is_dir(FCPATH . '/uploads/form_tambah_data_umum/')) {
				mkdir(FCPATH . '/uploads/form_tambah_data_umum/');
			}

			if (!empty($form_tambah_data_umum_file_uuid)) {
				$form_tambah_data_umum_file_name_copy = date('YmdHis') . '-' . $form_tambah_data_umum_file_name;

				rename(FCPATH . 'uploads/tmp/' . $form_tambah_data_umum_file_uuid . '/' . $form_tambah_data_umum_file_name, 
						FCPATH . 'uploads/form_tambah_data_umum/' . $form_tambah_data_umum_file_name_copy);

				if (!is_file(FCPATH . '/uploads/form_tambah_data_umum/' . $form_tambah_data_umum_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $form_tambah_data_umum_file_name_copy;
			}
		
			
			$save_form_tambah_data_umum = $this->model_form_tambah_data_umum->change($id, $save_data);

			if ($save_form_tambah_data_umum) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/form_tambah_data_umum', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/form_tambah_data_umum');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/form_tambah_data_umum');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete Form Tambah Data Umums
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('form_tambah_data_umum_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'Form Tambah Data Umum'), 'success');
        } else {
            set_message(cclang('error_delete', 'Form Tambah Data Umum'), 'error');
        }

		redirect_back();
	}

	/**
	* View view Form Tambah Data Umums
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('form_tambah_data_umum_view');

		$this->data['form_tambah_data_umum'] = $this->model_form_tambah_data_umum->find($id);

		$this->template->title('Tambah Data Umum Detail');
		$this->render('backend/standart/administrator/form_builder/form_tambah_data_umum/form_tambah_data_umum_view', $this->data);
	}

	/**
	* delete Form Tambah Data Umums
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$form_tambah_data_umum = $this->model_form_tambah_data_umum->find($id);

		if (!empty($form_tambah_data_umum->file)) {
			$path = FCPATH . '/uploads/form_tambah_data_umum/' . $form_tambah_data_umum->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}

		
		return $this->model_form_tambah_data_umum->remove($id);
	}
	
	/**
	* Upload Image Form Tambah Data Umum	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('form_tambah_data_umum_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'form_tambah_data_umum',
		]);
	}

	/**
	* Delete Image Form Tambah Data Umum	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('form_tambah_data_umum_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'file', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'form_tambah_data_umum',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/form_tambah_data_umum/'
        ]);
	}

	/**
	* Get Image Form Tambah Data Umum	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('form_tambah_data_umum_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$form_tambah_data_umum = $this->model_form_tambah_data_umum->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'form_tambah_data_umum',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/form_tambah_data_umum/',
            'delete_endpoint'   => 'administrator/form_tambah_data_umum/delete_file_file'
        ]);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('form_tambah_data_umum_export');

		$this->model_form_tambah_data_umum->export('form_tambah_data_umum', 'form_tambah_data_umum');
	}
}


/* End of file form_tambah_data_umum.php */
/* Location: ./application/controllers/administrator/Form Tambah Data Umum.php */