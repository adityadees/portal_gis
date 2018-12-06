<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Bandara Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Bandara site
*|
*/
class Dokumentasi_bandara extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_bandara');
	}

	/**
	* show all Dokumentasi Bandaras
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_bandara_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_bandaras'] = $this->model_dokumentasi_bandara->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_bandara_counts'] = $this->model_dokumentasi_bandara->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_bandara/index/',
			'total_rows'   => $this->model_dokumentasi_bandara->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Bandara List');
		$this->render('backend/standart/administrator/dokumentasi_bandara/dokumentasi_bandara_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_bandaras
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_bandara_add');

		$this->template->title('Dokumentasi Bandara New');
		$this->render('backend/standart/administrator/dokumentasi_bandara/dokumentasi_bandara_add', $this->data);
	}

	/**
	* Add New Dokumentasi Bandaras
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_bandara_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('bandara_id', 'Bandara Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_bandara_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_bandara_file_uuid = $this->input->post('dokumentasi_bandara_file_uuid');
			$dokumentasi_bandara_file_name = $this->input->post('dokumentasi_bandara_file_name');
		
			$save_data = [
				'bandara_id' => $this->input->post('bandara_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_bandara/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_bandara/');
			}

			if (!empty($dokumentasi_bandara_file_name)) {
				$dokumentasi_bandara_file_name_copy = date('YmdHis') . '-' . $dokumentasi_bandara_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_bandara_file_uuid . '/' . $dokumentasi_bandara_file_name, 
						FCPATH . 'uploads/dokumentasi_bandara/' . $dokumentasi_bandara_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_bandara/' . $dokumentasi_bandara_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_bandara_file_name_copy;
			}
		
			
			$save_dokumentasi_bandara = $this->model_dokumentasi_bandara->store($save_data);

			if ($save_dokumentasi_bandara) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_bandara;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_bandara/edit/' . $save_dokumentasi_bandara, 'Edit Dokumentasi Bandara'),
						anchor('administrator/dokumentasi_bandara', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_bandara/edit/' . $save_dokumentasi_bandara, 'Edit Dokumentasi Bandara')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_bandara');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_bandara');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Bandaras
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_bandara_update');

		$this->data['dokumentasi_bandara'] = $this->model_dokumentasi_bandara->find($id);

		$this->template->title('Dokumentasi Bandara Update');
		$this->render('backend/standart/administrator/dokumentasi_bandara/dokumentasi_bandara_update', $this->data);
	}

	/**
	* Update Dokumentasi Bandaras
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_bandara_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('bandara_id', 'Bandara Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_bandara_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_bandara_file_uuid = $this->input->post('dokumentasi_bandara_file_uuid');
			$dokumentasi_bandara_file_name = $this->input->post('dokumentasi_bandara_file_name');
		
			$save_data = [
				'bandara_id' => $this->input->post('bandara_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_bandara/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_bandara/');
			}

			if (!empty($dokumentasi_bandara_file_uuid)) {
				$dokumentasi_bandara_file_name_copy = date('YmdHis') . '-' . $dokumentasi_bandara_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_bandara_file_uuid . '/' . $dokumentasi_bandara_file_name, 
						FCPATH . 'uploads/dokumentasi_bandara/' . $dokumentasi_bandara_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_bandara/' . $dokumentasi_bandara_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_bandara_file_name_copy;
			}
		
			
			$save_dokumentasi_bandara = $this->model_dokumentasi_bandara->change($id, $save_data);

			if ($save_dokumentasi_bandara) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_bandara', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_bandara');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_bandara');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Bandaras
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_bandara_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_bandara'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_bandara'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Bandaras
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_bandara_view');

		$this->data['dokumentasi_bandara'] = $this->model_dokumentasi_bandara->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Bandara Detail');
		$this->render('backend/standart/administrator/dokumentasi_bandara/dokumentasi_bandara_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Bandaras
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_bandara = $this->model_dokumentasi_bandara->find($id);

		if (!empty($dokumentasi_bandara->file)) {
			$path = FCPATH . '/uploads/dokumentasi_bandara/' . $dokumentasi_bandara->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_bandara->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Bandara	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_bandara_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_bandara',
		]);
	}

	/**
	* Delete Image Dokumentasi Bandara	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_bandara_delete', false)) {
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
            'table_name'        => 'dokumentasi_bandara',
            'primary_key'       => 'dokumentasi_bandara_id',
            'upload_path'       => 'uploads/dokumentasi_bandara/'
        ]);
	}

	/**
	* Get Image Dokumentasi Bandara	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_bandara_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_bandara = $this->model_dokumentasi_bandara->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_bandara',
            'primary_key'       => 'dokumentasi_bandara_id',
            'upload_path'       => 'uploads/dokumentasi_bandara/',
            'delete_endpoint'   => 'administrator/dokumentasi_bandara/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_bandara_export');

		$this->model_dokumentasi_bandara->export('dokumentasi_bandara', 'dokumentasi_bandara');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_bandara_export');

		$this->model_dokumentasi_bandara->pdf('dokumentasi_bandara', 'dokumentasi_bandara');
	}
}


/* End of file dokumentasi_bandara.php */
/* Location: ./application/controllers/administrator/Dokumentasi Bandara.php */