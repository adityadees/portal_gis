<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Jalan Nasional Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Jalan Nasional site
*|
*/
class Dokumentasi_jalan_nasional extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_jalan_nasional');
	}

	/**
	* show all Dokumentasi Jalan Nasionals
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_jalan_nasional_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_jalan_nasionals'] = $this->model_dokumentasi_jalan_nasional->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_jalan_nasional_counts'] = $this->model_dokumentasi_jalan_nasional->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_jalan_nasional/index/',
			'total_rows'   => $this->model_dokumentasi_jalan_nasional->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Jalan Nasional List');
		$this->render('backend/standart/administrator/dokumentasi_jalan_nasional/dokumentasi_jalan_nasional_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_jalan_nasionals
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_jalan_nasional_add');

		$this->template->title('Dokumentasi Jalan Nasional New');
		$this->render('backend/standart/administrator/dokumentasi_jalan_nasional/dokumentasi_jalan_nasional_add', $this->data);
	}

	/**
	* Add New Dokumentasi Jalan Nasionals
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_jalan_nasional_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('dokumentasi_jalan_id', 'Dokumentasi Jalan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_jalan_nasional_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_jalan_nasional_file_uuid = $this->input->post('dokumentasi_jalan_nasional_file_uuid');
			$dokumentasi_jalan_nasional_file_name = $this->input->post('dokumentasi_jalan_nasional_file_name');
		
			$save_data = [
				'dokumentasi_jalan_id' => $this->input->post('dokumentasi_jalan_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_jalan_nasional/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_jalan_nasional/');
			}

			if (!empty($dokumentasi_jalan_nasional_file_name)) {
				$dokumentasi_jalan_nasional_file_name_copy = date('YmdHis') . '-' . $dokumentasi_jalan_nasional_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_jalan_nasional_file_uuid . '/' . $dokumentasi_jalan_nasional_file_name, 
						FCPATH . 'uploads/dokumentasi_jalan_nasional/' . $dokumentasi_jalan_nasional_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_jalan_nasional/' . $dokumentasi_jalan_nasional_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_jalan_nasional_file_name_copy;
			}
		
			
			$save_dokumentasi_jalan_nasional = $this->model_dokumentasi_jalan_nasional->store($save_data);

			if ($save_dokumentasi_jalan_nasional) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_jalan_nasional;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_jalan_nasional/edit/' . $save_dokumentasi_jalan_nasional, 'Edit Dokumentasi Jalan Nasional'),
						anchor('administrator/dokumentasi_jalan_nasional', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_jalan_nasional/edit/' . $save_dokumentasi_jalan_nasional, 'Edit Dokumentasi Jalan Nasional')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_jalan_nasional');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_jalan_nasional');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Jalan Nasionals
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_jalan_nasional_update');

		$this->data['dokumentasi_jalan_nasional'] = $this->model_dokumentasi_jalan_nasional->find($id);

		$this->template->title('Dokumentasi Jalan Nasional Update');
		$this->render('backend/standart/administrator/dokumentasi_jalan_nasional/dokumentasi_jalan_nasional_update', $this->data);
	}

	/**
	* Update Dokumentasi Jalan Nasionals
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_jalan_nasional_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('dokumentasi_jalan_id', 'Dokumentasi Jalan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_jalan_nasional_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_jalan_nasional_file_uuid = $this->input->post('dokumentasi_jalan_nasional_file_uuid');
			$dokumentasi_jalan_nasional_file_name = $this->input->post('dokumentasi_jalan_nasional_file_name');
		
			$save_data = [
				'dokumentasi_jalan_id' => $this->input->post('dokumentasi_jalan_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_jalan_nasional/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_jalan_nasional/');
			}

			if (!empty($dokumentasi_jalan_nasional_file_uuid)) {
				$dokumentasi_jalan_nasional_file_name_copy = date('YmdHis') . '-' . $dokumentasi_jalan_nasional_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_jalan_nasional_file_uuid . '/' . $dokumentasi_jalan_nasional_file_name, 
						FCPATH . 'uploads/dokumentasi_jalan_nasional/' . $dokumentasi_jalan_nasional_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_jalan_nasional/' . $dokumentasi_jalan_nasional_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_jalan_nasional_file_name_copy;
			}
		
			
			$save_dokumentasi_jalan_nasional = $this->model_dokumentasi_jalan_nasional->change($id, $save_data);

			if ($save_dokumentasi_jalan_nasional) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_jalan_nasional', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_jalan_nasional');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_jalan_nasional');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Jalan Nasionals
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_jalan_nasional_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_jalan_nasional'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_jalan_nasional'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Jalan Nasionals
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_jalan_nasional_view');

		$this->data['dokumentasi_jalan_nasional'] = $this->model_dokumentasi_jalan_nasional->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Jalan Nasional Detail');
		$this->render('backend/standart/administrator/dokumentasi_jalan_nasional/dokumentasi_jalan_nasional_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Jalan Nasionals
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_jalan_nasional = $this->model_dokumentasi_jalan_nasional->find($id);

		if (!empty($dokumentasi_jalan_nasional->file)) {
			$path = FCPATH . '/uploads/dokumentasi_jalan_nasional/' . $dokumentasi_jalan_nasional->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_jalan_nasional->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Jalan Nasional	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_jalan_nasional_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_jalan_nasional',
			'allowed_types' => 'jpg|png',
		]);
	}

	/**
	* Delete Image Dokumentasi Jalan Nasional	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_jalan_nasional_delete', false)) {
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
            'table_name'        => 'dokumentasi_jalan_nasional',
            'primary_key'       => 'kode_dj',
            'upload_path'       => 'uploads/dokumentasi_jalan_nasional/'
        ]);
	}

	/**
	* Get Image Dokumentasi Jalan Nasional	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_jalan_nasional_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_jalan_nasional = $this->model_dokumentasi_jalan_nasional->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_jalan_nasional',
            'primary_key'       => 'kode_dj',
            'upload_path'       => 'uploads/dokumentasi_jalan_nasional/',
            'delete_endpoint'   => 'administrator/dokumentasi_jalan_nasional/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_jalan_nasional_export');

		$this->model_dokumentasi_jalan_nasional->export('dokumentasi_jalan_nasional', 'dokumentasi_jalan_nasional');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_jalan_nasional_export');

		$this->model_dokumentasi_jalan_nasional->pdf('dokumentasi_jalan_nasional', 'dokumentasi_jalan_nasional');
	}
}


/* End of file dokumentasi_jalan_nasional.php */
/* Location: ./application/controllers/administrator/Dokumentasi Jalan Nasional.php */