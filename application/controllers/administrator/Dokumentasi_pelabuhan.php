<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Pelabuhan Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Pelabuhan site
*|
*/
class Dokumentasi_pelabuhan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_pelabuhan');
	}

	/**
	* show all Dokumentasi Pelabuhans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_pelabuhan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_pelabuhans'] = $this->model_dokumentasi_pelabuhan->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_pelabuhan_counts'] = $this->model_dokumentasi_pelabuhan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_pelabuhan/index/',
			'total_rows'   => $this->model_dokumentasi_pelabuhan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Pelabuhan List');
		$this->render('backend/standart/administrator/dokumentasi_pelabuhan/dokumentasi_pelabuhan_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_pelabuhans
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_pelabuhan_add');

		$this->template->title('Dokumentasi Pelabuhan New');
		$this->render('backend/standart/administrator/dokumentasi_pelabuhan/dokumentasi_pelabuhan_add', $this->data);
	}

	/**
	* Add New Dokumentasi Pelabuhans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_pelabuhan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('pelabuhan_id', 'Nama Pelabuhan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_pelabuhan_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal Dokumentasi', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_pelabuhan_file_uuid = $this->input->post('dokumentasi_pelabuhan_file_uuid');
			$dokumentasi_pelabuhan_file_name = $this->input->post('dokumentasi_pelabuhan_file_name');
		
			$save_data = [
				'pelabuhan_id' => $this->input->post('pelabuhan_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_pelabuhan/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_pelabuhan/');
			}

			if (!empty($dokumentasi_pelabuhan_file_name)) {
				$dokumentasi_pelabuhan_file_name_copy = date('YmdHis') . '-' . $dokumentasi_pelabuhan_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_pelabuhan_file_uuid . '/' . $dokumentasi_pelabuhan_file_name, 
						FCPATH . 'uploads/dokumentasi_pelabuhan/' . $dokumentasi_pelabuhan_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_pelabuhan/' . $dokumentasi_pelabuhan_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_pelabuhan_file_name_copy;
			}
		
			
			$save_dokumentasi_pelabuhan = $this->model_dokumentasi_pelabuhan->store($save_data);

			if ($save_dokumentasi_pelabuhan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_pelabuhan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_pelabuhan/edit/' . $save_dokumentasi_pelabuhan, 'Edit Dokumentasi Pelabuhan'),
						anchor('administrator/dokumentasi_pelabuhan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_pelabuhan/edit/' . $save_dokumentasi_pelabuhan, 'Edit Dokumentasi Pelabuhan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_pelabuhan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_pelabuhan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Pelabuhans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_pelabuhan_update');

		$this->data['dokumentasi_pelabuhan'] = $this->model_dokumentasi_pelabuhan->find($id);

		$this->template->title('Dokumentasi Pelabuhan Update');
		$this->render('backend/standart/administrator/dokumentasi_pelabuhan/dokumentasi_pelabuhan_update', $this->data);
	}

	/**
	* Update Dokumentasi Pelabuhans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_pelabuhan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('pelabuhan_id', 'Nama Pelabuhan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_pelabuhan_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal Dokumentasi', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_pelabuhan_file_uuid = $this->input->post('dokumentasi_pelabuhan_file_uuid');
			$dokumentasi_pelabuhan_file_name = $this->input->post('dokumentasi_pelabuhan_file_name');
		
			$save_data = [
				'pelabuhan_id' => $this->input->post('pelabuhan_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_pelabuhan/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_pelabuhan/');
			}

			if (!empty($dokumentasi_pelabuhan_file_uuid)) {
				$dokumentasi_pelabuhan_file_name_copy = date('YmdHis') . '-' . $dokumentasi_pelabuhan_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_pelabuhan_file_uuid . '/' . $dokumentasi_pelabuhan_file_name, 
						FCPATH . 'uploads/dokumentasi_pelabuhan/' . $dokumentasi_pelabuhan_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_pelabuhan/' . $dokumentasi_pelabuhan_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_pelabuhan_file_name_copy;
			}
		
			
			$save_dokumentasi_pelabuhan = $this->model_dokumentasi_pelabuhan->change($id, $save_data);

			if ($save_dokumentasi_pelabuhan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_pelabuhan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_pelabuhan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_pelabuhan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Pelabuhans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_pelabuhan_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_pelabuhan'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_pelabuhan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Pelabuhans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_pelabuhan_view');

		$this->data['dokumentasi_pelabuhan'] = $this->model_dokumentasi_pelabuhan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Pelabuhan Detail');
		$this->render('backend/standart/administrator/dokumentasi_pelabuhan/dokumentasi_pelabuhan_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Pelabuhans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_pelabuhan = $this->model_dokumentasi_pelabuhan->find($id);

		if (!empty($dokumentasi_pelabuhan->file)) {
			$path = FCPATH . '/uploads/dokumentasi_pelabuhan/' . $dokumentasi_pelabuhan->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_pelabuhan->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Pelabuhan	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_pelabuhan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_pelabuhan',
		]);
	}

	/**
	* Delete Image Dokumentasi Pelabuhan	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_pelabuhan_delete', false)) {
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
            'table_name'        => 'dokumentasi_pelabuhan',
            'primary_key'       => 'dokumentasi_pelabuhan_id',
            'upload_path'       => 'uploads/dokumentasi_pelabuhan/'
        ]);
	}

	/**
	* Get Image Dokumentasi Pelabuhan	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_pelabuhan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_pelabuhan = $this->model_dokumentasi_pelabuhan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_pelabuhan',
            'primary_key'       => 'dokumentasi_pelabuhan_id',
            'upload_path'       => 'uploads/dokumentasi_pelabuhan/',
            'delete_endpoint'   => 'administrator/dokumentasi_pelabuhan/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_pelabuhan_export');

		$this->model_dokumentasi_pelabuhan->export('dokumentasi_pelabuhan', 'dokumentasi_pelabuhan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_pelabuhan_export');

		$this->model_dokumentasi_pelabuhan->pdf('dokumentasi_pelabuhan', 'dokumentasi_pelabuhan');
	}
}


/* End of file dokumentasi_pelabuhan.php */
/* Location: ./application/controllers/administrator/Dokumentasi Pelabuhan.php */