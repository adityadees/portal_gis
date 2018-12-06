<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Sungai Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Sungai site
*|
*/
class Dokumentasi_sungai extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_sungai');
	}

	/**
	* show all Dokumentasi Sungais
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_sungai_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_sungais'] = $this->model_dokumentasi_sungai->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_sungai_counts'] = $this->model_dokumentasi_sungai->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_sungai/index/',
			'total_rows'   => $this->model_dokumentasi_sungai->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Sungai List');
		$this->render('backend/standart/administrator/dokumentasi_sungai/dokumentasi_sungai_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_sungais
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_sungai_add');

		$this->template->title('Dokumentasi Sungai New');
		$this->render('backend/standart/administrator/dokumentasi_sungai/dokumentasi_sungai_add', $this->data);
	}

	/**
	* Add New Dokumentasi Sungais
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_sungai_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_sungai_file_uuid = $this->input->post('dokumentasi_sungai_file_uuid');
			$dokumentasi_sungai_file_name = $this->input->post('dokumentasi_sungai_file_name');
		
			$save_data = [
				'kode_ds' => $this->input->post('kode_ds'),
				'dokumentasi_sungai_id' => $this->input->post('dokumentasi_sungai_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_sungai/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_sungai/');
			}

			if (!empty($dokumentasi_sungai_file_name)) {
				$dokumentasi_sungai_file_name_copy = date('YmdHis') . '-' . $dokumentasi_sungai_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_sungai_file_uuid . '/' . $dokumentasi_sungai_file_name, 
						FCPATH . 'uploads/dokumentasi_sungai/' . $dokumentasi_sungai_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_sungai/' . $dokumentasi_sungai_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_sungai_file_name_copy;
			}
		
			
			$save_dokumentasi_sungai = $this->model_dokumentasi_sungai->store($save_data);

			if ($save_dokumentasi_sungai) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_sungai;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_sungai/edit/' . $save_dokumentasi_sungai, 'Edit Dokumentasi Sungai'),
						anchor('administrator/dokumentasi_sungai', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_sungai/edit/' . $save_dokumentasi_sungai, 'Edit Dokumentasi Sungai')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_sungai');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_sungai');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Sungais
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_sungai_update');

		$this->data['dokumentasi_sungai'] = $this->model_dokumentasi_sungai->find($id);

		$this->template->title('Dokumentasi Sungai Update');
		$this->render('backend/standart/administrator/dokumentasi_sungai/dokumentasi_sungai_update', $this->data);
	}

	/**
	* Update Dokumentasi Sungais
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_sungai_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_sungai_file_uuid = $this->input->post('dokumentasi_sungai_file_uuid');
			$dokumentasi_sungai_file_name = $this->input->post('dokumentasi_sungai_file_name');
		
			$save_data = [
				'kode_ds' => $this->input->post('kode_ds'),
				'dokumentasi_sungai_id' => $this->input->post('dokumentasi_sungai_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_sungai/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_sungai/');
			}

			if (!empty($dokumentasi_sungai_file_uuid)) {
				$dokumentasi_sungai_file_name_copy = date('YmdHis') . '-' . $dokumentasi_sungai_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_sungai_file_uuid . '/' . $dokumentasi_sungai_file_name, 
						FCPATH . 'uploads/dokumentasi_sungai/' . $dokumentasi_sungai_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_sungai/' . $dokumentasi_sungai_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_sungai_file_name_copy;
			}
		
			
			$save_dokumentasi_sungai = $this->model_dokumentasi_sungai->change($id, $save_data);

			if ($save_dokumentasi_sungai) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_sungai', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_sungai');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_sungai');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Sungais
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_sungai_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_sungai'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_sungai'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Sungais
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_sungai_view');

		$this->data['dokumentasi_sungai'] = $this->model_dokumentasi_sungai->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Sungai Detail');
		$this->render('backend/standart/administrator/dokumentasi_sungai/dokumentasi_sungai_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Sungais
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_sungai = $this->model_dokumentasi_sungai->find($id);

		if (!empty($dokumentasi_sungai->file)) {
			$path = FCPATH . '/uploads/dokumentasi_sungai/' . $dokumentasi_sungai->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_sungai->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Sungai	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_sungai_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_sungai',
		]);
	}

	/**
	* Delete Image Dokumentasi Sungai	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_sungai_delete', false)) {
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
            'table_name'        => 'dokumentasi_sungai',
            'primary_key'       => 'kode_ds',
            'upload_path'       => 'uploads/dokumentasi_sungai/'
        ]);
	}

	/**
	* Get Image Dokumentasi Sungai	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_sungai_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_sungai = $this->model_dokumentasi_sungai->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_sungai',
            'primary_key'       => 'kode_ds',
            'upload_path'       => 'uploads/dokumentasi_sungai/',
            'delete_endpoint'   => 'administrator/dokumentasi_sungai/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_sungai_export');

		$this->model_dokumentasi_sungai->export('dokumentasi_sungai', 'dokumentasi_sungai');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_sungai_export');

		$this->model_dokumentasi_sungai->pdf('dokumentasi_sungai', 'dokumentasi_sungai');
	}
}


/* End of file dokumentasi_sungai.php */
/* Location: ./application/controllers/administrator/Dokumentasi Sungai.php */