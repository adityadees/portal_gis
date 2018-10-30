<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Tambah Dokumentasi Controller
*| --------------------------------------------------------------------------
*| Form Tambah Dokumentasi site
*|
*/
class Form_tambah_dokumentasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_tambah_dokumentasi');
	}

	/**
	* show all Form Tambah Dokumentasis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('form_tambah_dokumentasi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['form_tambah_dokumentasis'] = $this->model_form_tambah_dokumentasi->get($filter, $field, $this->limit_page, $offset);
		$this->data['form_tambah_dokumentasi_counts'] = $this->model_form_tambah_dokumentasi->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/form_tambah_dokumentasi/index/',
			'total_rows'   => $this->model_form_tambah_dokumentasi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tambah Dokumentasi List');
		$this->render('backend/standart/administrator/form_builder/form_tambah_dokumentasi/form_tambah_dokumentasi_list', $this->data);
	}

	/**
	* Update view Form Tambah Dokumentasis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('form_tambah_dokumentasi_update');

		$this->data['form_tambah_dokumentasi'] = $this->model_form_tambah_dokumentasi->find($id);

		$this->template->title('Tambah Dokumentasi Update');
		$this->render('backend/standart/administrator/form_builder/form_tambah_dokumentasi/form_tambah_dokumentasi_update', $this->data);
	}

	/**
	* Update Form Tambah Dokumentasis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('form_tambah_dokumentasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('form_tambah_dokumentasi_file_name', 'File', 'trim|required');
		
		if ($this->form_validation->run()) {
			$form_tambah_dokumentasi_file_uuid = $this->input->post('form_tambah_dokumentasi_file_uuid');
			$form_tambah_dokumentasi_file_name = $this->input->post('form_tambah_dokumentasi_file_name');
		
			$save_data = [
			];

			if (!is_dir(FCPATH . '/uploads/form_tambah_dokumentasi/')) {
				mkdir(FCPATH . '/uploads/form_tambah_dokumentasi/');
			}

			if (!empty($form_tambah_dokumentasi_file_uuid)) {
				$form_tambah_dokumentasi_file_name_copy = date('YmdHis') . '-' . $form_tambah_dokumentasi_file_name;

				rename(FCPATH . 'uploads/tmp/' . $form_tambah_dokumentasi_file_uuid . '/' . $form_tambah_dokumentasi_file_name, 
						FCPATH . 'uploads/form_tambah_dokumentasi/' . $form_tambah_dokumentasi_file_name_copy);

				if (!is_file(FCPATH . '/uploads/form_tambah_dokumentasi/' . $form_tambah_dokumentasi_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $form_tambah_dokumentasi_file_name_copy;
			}
		
			
			$save_form_tambah_dokumentasi = $this->model_form_tambah_dokumentasi->change($id, $save_data);

			if ($save_form_tambah_dokumentasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/form_tambah_dokumentasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/form_tambah_dokumentasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/form_tambah_dokumentasi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete Form Tambah Dokumentasis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('form_tambah_dokumentasi_delete');

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
            set_message(cclang('has_been_deleted', 'Form Tambah Dokumentasi'), 'success');
        } else {
            set_message(cclang('error_delete', 'Form Tambah Dokumentasi'), 'error');
        }

		redirect_back();
	}

	/**
	* View view Form Tambah Dokumentasis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('form_tambah_dokumentasi_view');

		$this->data['form_tambah_dokumentasi'] = $this->model_form_tambah_dokumentasi->find($id);

		$this->template->title('Tambah Dokumentasi Detail');
		$this->render('backend/standart/administrator/form_builder/form_tambah_dokumentasi/form_tambah_dokumentasi_view', $this->data);
	}

	/**
	* delete Form Tambah Dokumentasis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$form_tambah_dokumentasi = $this->model_form_tambah_dokumentasi->find($id);

		if (!empty($form_tambah_dokumentasi->file)) {
			$path = FCPATH . '/uploads/form_tambah_dokumentasi/' . $form_tambah_dokumentasi->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}

		
		return $this->model_form_tambah_dokumentasi->remove($id);
	}
	
	/**
	* Upload Image Form Tambah Dokumentasi	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('form_tambah_dokumentasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'form_tambah_dokumentasi',
		]);
	}

	/**
	* Delete Image Form Tambah Dokumentasi	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('form_tambah_dokumentasi_delete', false)) {
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
            'table_name'        => 'form_tambah_dokumentasi',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/form_tambah_dokumentasi/'
        ]);
	}

	/**
	* Get Image Form Tambah Dokumentasi	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('form_tambah_dokumentasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$form_tambah_dokumentasi = $this->model_form_tambah_dokumentasi->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'form_tambah_dokumentasi',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/form_tambah_dokumentasi/',
            'delete_endpoint'   => 'administrator/form_tambah_dokumentasi/delete_file_file'
        ]);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('form_tambah_dokumentasi_export');

		$this->model_form_tambah_dokumentasi->export('form_tambah_dokumentasi', 'form_tambah_dokumentasi');
	}
}


/* End of file form_tambah_dokumentasi.php */
/* Location: ./application/controllers/administrator/Form Tambah Dokumentasi.php */