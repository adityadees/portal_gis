<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Stasiun Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Stasiun site
*|
*/
class Dokumentasi_stasiun extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_stasiun');
	}

	/**
	* show all Dokumentasi Stasiuns
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_stasiun_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_stasiuns'] = $this->model_dokumentasi_stasiun->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_stasiun_counts'] = $this->model_dokumentasi_stasiun->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_stasiun/index/',
			'total_rows'   => $this->model_dokumentasi_stasiun->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Stasiun List');
		$this->render('backend/standart/administrator/dokumentasi_stasiun/dokumentasi_stasiun_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_stasiuns
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_stasiun_add');

		$this->template->title('Dokumentasi Stasiun New');
		$this->render('backend/standart/administrator/dokumentasi_stasiun/dokumentasi_stasiun_add', $this->data);
	}

	/**
	* Add New Dokumentasi Stasiuns
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_stasiun_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('stasiun_id', 'Stasiun Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_stasiun_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_stasiun_file_uuid = $this->input->post('dokumentasi_stasiun_file_uuid');
			$dokumentasi_stasiun_file_name = $this->input->post('dokumentasi_stasiun_file_name');
		
			$save_data = [
				'stasiun_id' => $this->input->post('stasiun_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_stasiun/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_stasiun/');
			}

			if (!empty($dokumentasi_stasiun_file_name)) {
				$dokumentasi_stasiun_file_name_copy = date('YmdHis') . '-' . $dokumentasi_stasiun_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_stasiun_file_uuid . '/' . $dokumentasi_stasiun_file_name, 
						FCPATH . 'uploads/dokumentasi_stasiun/' . $dokumentasi_stasiun_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_stasiun/' . $dokumentasi_stasiun_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_stasiun_file_name_copy;
			}
		
			
			$save_dokumentasi_stasiun = $this->model_dokumentasi_stasiun->store($save_data);

			if ($save_dokumentasi_stasiun) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_stasiun;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_stasiun/edit/' . $save_dokumentasi_stasiun, 'Edit Dokumentasi Stasiun'),
						anchor('administrator/dokumentasi_stasiun', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_stasiun/edit/' . $save_dokumentasi_stasiun, 'Edit Dokumentasi Stasiun')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_stasiun');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_stasiun');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Stasiuns
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_stasiun_update');

		$this->data['dokumentasi_stasiun'] = $this->model_dokumentasi_stasiun->find($id);

		$this->template->title('Dokumentasi Stasiun Update');
		$this->render('backend/standart/administrator/dokumentasi_stasiun/dokumentasi_stasiun_update', $this->data);
	}

	/**
	* Update Dokumentasi Stasiuns
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_stasiun_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('stasiun_id', 'Stasiun Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_stasiun_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_stasiun_file_uuid = $this->input->post('dokumentasi_stasiun_file_uuid');
			$dokumentasi_stasiun_file_name = $this->input->post('dokumentasi_stasiun_file_name');
		
			$save_data = [
				'stasiun_id' => $this->input->post('stasiun_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_stasiun/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_stasiun/');
			}

			if (!empty($dokumentasi_stasiun_file_uuid)) {
				$dokumentasi_stasiun_file_name_copy = date('YmdHis') . '-' . $dokumentasi_stasiun_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_stasiun_file_uuid . '/' . $dokumentasi_stasiun_file_name, 
						FCPATH . 'uploads/dokumentasi_stasiun/' . $dokumentasi_stasiun_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_stasiun/' . $dokumentasi_stasiun_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_stasiun_file_name_copy;
			}
		
			
			$save_dokumentasi_stasiun = $this->model_dokumentasi_stasiun->change($id, $save_data);

			if ($save_dokumentasi_stasiun) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_stasiun', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_stasiun');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_stasiun');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Stasiuns
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_stasiun_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_stasiun'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_stasiun'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Stasiuns
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_stasiun_view');

		$this->data['dokumentasi_stasiun'] = $this->model_dokumentasi_stasiun->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Stasiun Detail');
		$this->render('backend/standart/administrator/dokumentasi_stasiun/dokumentasi_stasiun_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Stasiuns
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_stasiun = $this->model_dokumentasi_stasiun->find($id);

		if (!empty($dokumentasi_stasiun->file)) {
			$path = FCPATH . '/uploads/dokumentasi_stasiun/' . $dokumentasi_stasiun->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_stasiun->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Stasiun	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_stasiun_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_stasiun',
		]);
	}

	/**
	* Delete Image Dokumentasi Stasiun	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_stasiun_delete', false)) {
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
            'table_name'        => 'dokumentasi_stasiun',
            'primary_key'       => 'dokumentasi_stasiun_id',
            'upload_path'       => 'uploads/dokumentasi_stasiun/'
        ]);
	}

	/**
	* Get Image Dokumentasi Stasiun	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_stasiun_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_stasiun = $this->model_dokumentasi_stasiun->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_stasiun',
            'primary_key'       => 'dokumentasi_stasiun_id',
            'upload_path'       => 'uploads/dokumentasi_stasiun/',
            'delete_endpoint'   => 'administrator/dokumentasi_stasiun/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_stasiun_export');

		$this->model_dokumentasi_stasiun->export('dokumentasi_stasiun', 'dokumentasi_stasiun');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_stasiun_export');

		$this->model_dokumentasi_stasiun->pdf('dokumentasi_stasiun', 'dokumentasi_stasiun');
	}
}


/* End of file dokumentasi_stasiun.php */
/* Location: ./application/controllers/administrator/Dokumentasi Stasiun.php */