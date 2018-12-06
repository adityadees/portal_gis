<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Jalan Provinsi Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Jalan Provinsi site
*|
*/
class Dokumentasi_jalan_provinsi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_jalan_provinsi');
	}

	/**
	* show all Dokumentasi Jalan Provinsis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_jalan_provinsi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_jalan_provinsis'] = $this->model_dokumentasi_jalan_provinsi->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_jalan_provinsi_counts'] = $this->model_dokumentasi_jalan_provinsi->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_jalan_provinsi/index/',
			'total_rows'   => $this->model_dokumentasi_jalan_provinsi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Jalan Provinsi List');
		$this->render('backend/standart/administrator/dokumentasi_jalan_provinsi/dokumentasi_jalan_provinsi_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_jalan_provinsis
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_jalan_provinsi_add');

		$this->template->title('Dokumentasi Jalan Provinsi New');
		$this->render('backend/standart/administrator/dokumentasi_jalan_provinsi/dokumentasi_jalan_provinsi_add', $this->data);
	}

	/**
	* Add New Dokumentasi Jalan Provinsis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_jalan_provinsi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('dokumentasi_jalan_id', 'Dokumentasi Jalan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_jalan_provinsi_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_jalan_provinsi_file_uuid = $this->input->post('dokumentasi_jalan_provinsi_file_uuid');
			$dokumentasi_jalan_provinsi_file_name = $this->input->post('dokumentasi_jalan_provinsi_file_name');
		
			$save_data = [
				'dokumentasi_jalan_id' => $this->input->post('dokumentasi_jalan_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_jalan_provinsi/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_jalan_provinsi/');
			}

			if (!empty($dokumentasi_jalan_provinsi_file_name)) {
				$dokumentasi_jalan_provinsi_file_name_copy = date('YmdHis') . '-' . $dokumentasi_jalan_provinsi_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_jalan_provinsi_file_uuid . '/' . $dokumentasi_jalan_provinsi_file_name, 
						FCPATH . 'uploads/dokumentasi_jalan_provinsi/' . $dokumentasi_jalan_provinsi_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_jalan_provinsi/' . $dokumentasi_jalan_provinsi_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_jalan_provinsi_file_name_copy;
			}
		
			
			$save_dokumentasi_jalan_provinsi = $this->model_dokumentasi_jalan_provinsi->store($save_data);

			if ($save_dokumentasi_jalan_provinsi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_jalan_provinsi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_jalan_provinsi/edit/' . $save_dokumentasi_jalan_provinsi, 'Edit Dokumentasi Jalan Provinsi'),
						anchor('administrator/dokumentasi_jalan_provinsi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_jalan_provinsi/edit/' . $save_dokumentasi_jalan_provinsi, 'Edit Dokumentasi Jalan Provinsi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_jalan_provinsi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_jalan_provinsi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Jalan Provinsis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_jalan_provinsi_update');

		$this->data['dokumentasi_jalan_provinsi'] = $this->model_dokumentasi_jalan_provinsi->find($id);

		$this->template->title('Dokumentasi Jalan Provinsi Update');
		$this->render('backend/standart/administrator/dokumentasi_jalan_provinsi/dokumentasi_jalan_provinsi_update', $this->data);
	}

	/**
	* Update Dokumentasi Jalan Provinsis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_jalan_provinsi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('dokumentasi_jalan_id', 'Dokumentasi Jalan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_jalan_provinsi_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_jalan_provinsi_file_uuid = $this->input->post('dokumentasi_jalan_provinsi_file_uuid');
			$dokumentasi_jalan_provinsi_file_name = $this->input->post('dokumentasi_jalan_provinsi_file_name');
		
			$save_data = [
				'dokumentasi_jalan_id' => $this->input->post('dokumentasi_jalan_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_jalan_provinsi/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_jalan_provinsi/');
			}

			if (!empty($dokumentasi_jalan_provinsi_file_uuid)) {
				$dokumentasi_jalan_provinsi_file_name_copy = date('YmdHis') . '-' . $dokumentasi_jalan_provinsi_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_jalan_provinsi_file_uuid . '/' . $dokumentasi_jalan_provinsi_file_name, 
						FCPATH . 'uploads/dokumentasi_jalan_provinsi/' . $dokumentasi_jalan_provinsi_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_jalan_provinsi/' . $dokumentasi_jalan_provinsi_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_jalan_provinsi_file_name_copy;
			}
		
			
			$save_dokumentasi_jalan_provinsi = $this->model_dokumentasi_jalan_provinsi->change($id, $save_data);

			if ($save_dokumentasi_jalan_provinsi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_jalan_provinsi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_jalan_provinsi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_jalan_provinsi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Jalan Provinsis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_jalan_provinsi_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_jalan_provinsi'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_jalan_provinsi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Jalan Provinsis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_jalan_provinsi_view');

		$this->data['dokumentasi_jalan_provinsi'] = $this->model_dokumentasi_jalan_provinsi->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Jalan Provinsi Detail');
		$this->render('backend/standart/administrator/dokumentasi_jalan_provinsi/dokumentasi_jalan_provinsi_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Jalan Provinsis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_jalan_provinsi = $this->model_dokumentasi_jalan_provinsi->find($id);

		if (!empty($dokumentasi_jalan_provinsi->file)) {
			$path = FCPATH . '/uploads/dokumentasi_jalan_provinsi/' . $dokumentasi_jalan_provinsi->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_jalan_provinsi->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Jalan Provinsi	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_jalan_provinsi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_jalan_provinsi',
			'allowed_types' => 'jpg|png',
		]);
	}

	/**
	* Delete Image Dokumentasi Jalan Provinsi	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_jalan_provinsi_delete', false)) {
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
            'table_name'        => 'dokumentasi_jalan_provinsi',
            'primary_key'       => 'kode_dj',
            'upload_path'       => 'uploads/dokumentasi_jalan_provinsi/'
        ]);
	}

	/**
	* Get Image Dokumentasi Jalan Provinsi	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_jalan_provinsi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_jalan_provinsi = $this->model_dokumentasi_jalan_provinsi->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_jalan_provinsi',
            'primary_key'       => 'kode_dj',
            'upload_path'       => 'uploads/dokumentasi_jalan_provinsi/',
            'delete_endpoint'   => 'administrator/dokumentasi_jalan_provinsi/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_jalan_provinsi_export');

		$this->model_dokumentasi_jalan_provinsi->export('dokumentasi_jalan_provinsi', 'dokumentasi_jalan_provinsi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_jalan_provinsi_export');

		$this->model_dokumentasi_jalan_provinsi->pdf('dokumentasi_jalan_provinsi', 'dokumentasi_jalan_provinsi');
	}
}


/* End of file dokumentasi_jalan_provinsi.php */
/* Location: ./application/controllers/administrator/Dokumentasi Jalan Provinsi.php */