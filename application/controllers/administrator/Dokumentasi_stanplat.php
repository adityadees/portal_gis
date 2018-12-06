<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Stanplat Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Stanplat site
*|
*/
class Dokumentasi_stanplat extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_stanplat');
	}

	/**
	* show all Dokumentasi Stanplats
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_stanplat_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_stanplats'] = $this->model_dokumentasi_stanplat->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_stanplat_counts'] = $this->model_dokumentasi_stanplat->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_stanplat/index/',
			'total_rows'   => $this->model_dokumentasi_stanplat->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Stanplat List');
		$this->render('backend/standart/administrator/dokumentasi_stanplat/dokumentasi_stanplat_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_stanplats
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_stanplat_add');

		$this->template->title('Dokumentasi Stanplat New');
		$this->render('backend/standart/administrator/dokumentasi_stanplat/dokumentasi_stanplat_add', $this->data);
	}

	/**
	* Add New Dokumentasi Stanplats
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_stanplat_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_stanplat_file_uuid = $this->input->post('dokumentasi_stanplat_file_uuid');
			$dokumentasi_stanplat_file_name = $this->input->post('dokumentasi_stanplat_file_name');
		
			$save_data = [
				'dokumentasi_stanplat_id' => $this->input->post('dokumentasi_stanplat_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_stanplat/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_stanplat/');
			}

			if (!empty($dokumentasi_stanplat_file_name)) {
				$dokumentasi_stanplat_file_name_copy = date('YmdHis') . '-' . $dokumentasi_stanplat_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_stanplat_file_uuid . '/' . $dokumentasi_stanplat_file_name, 
						FCPATH . 'uploads/dokumentasi_stanplat/' . $dokumentasi_stanplat_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_stanplat/' . $dokumentasi_stanplat_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_stanplat_file_name_copy;
			}
		
			
			$save_dokumentasi_stanplat = $this->model_dokumentasi_stanplat->store($save_data);

			if ($save_dokumentasi_stanplat) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_stanplat;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_stanplat/edit/' . $save_dokumentasi_stanplat, 'Edit Dokumentasi Stanplat'),
						anchor('administrator/dokumentasi_stanplat', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_stanplat/edit/' . $save_dokumentasi_stanplat, 'Edit Dokumentasi Stanplat')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_stanplat');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_stanplat');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Stanplats
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_stanplat_update');

		$this->data['dokumentasi_stanplat'] = $this->model_dokumentasi_stanplat->find($id);

		$this->template->title('Dokumentasi Stanplat Update');
		$this->render('backend/standart/administrator/dokumentasi_stanplat/dokumentasi_stanplat_update', $this->data);
	}

	/**
	* Update Dokumentasi Stanplats
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_stanplat_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_stanplat_file_uuid = $this->input->post('dokumentasi_stanplat_file_uuid');
			$dokumentasi_stanplat_file_name = $this->input->post('dokumentasi_stanplat_file_name');
		
			$save_data = [
				'dokumentasi_stanplat_id' => $this->input->post('dokumentasi_stanplat_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_stanplat/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_stanplat/');
			}

			if (!empty($dokumentasi_stanplat_file_uuid)) {
				$dokumentasi_stanplat_file_name_copy = date('YmdHis') . '-' . $dokumentasi_stanplat_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_stanplat_file_uuid . '/' . $dokumentasi_stanplat_file_name, 
						FCPATH . 'uploads/dokumentasi_stanplat/' . $dokumentasi_stanplat_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_stanplat/' . $dokumentasi_stanplat_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_stanplat_file_name_copy;
			}
		
			
			$save_dokumentasi_stanplat = $this->model_dokumentasi_stanplat->change($id, $save_data);

			if ($save_dokumentasi_stanplat) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_stanplat', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_stanplat');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_stanplat');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Stanplats
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_stanplat_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_stanplat'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_stanplat'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Stanplats
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_stanplat_view');

		$this->data['dokumentasi_stanplat'] = $this->model_dokumentasi_stanplat->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Stanplat Detail');
		$this->render('backend/standart/administrator/dokumentasi_stanplat/dokumentasi_stanplat_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Stanplats
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_stanplat = $this->model_dokumentasi_stanplat->find($id);

		if (!empty($dokumentasi_stanplat->file)) {
			$path = FCPATH . '/uploads/dokumentasi_stanplat/' . $dokumentasi_stanplat->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_stanplat->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Stanplat	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_stanplat_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_stanplat',
		]);
	}

	/**
	* Delete Image Dokumentasi Stanplat	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_stanplat_delete', false)) {
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
            'table_name'        => 'dokumentasi_stanplat',
            'primary_key'       => 'kode_ds',
            'upload_path'       => 'uploads/dokumentasi_stanplat/'
        ]);
	}

	/**
	* Get Image Dokumentasi Stanplat	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_stanplat_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_stanplat = $this->model_dokumentasi_stanplat->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_stanplat',
            'primary_key'       => 'kode_ds',
            'upload_path'       => 'uploads/dokumentasi_stanplat/',
            'delete_endpoint'   => 'administrator/dokumentasi_stanplat/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_stanplat_export');

		$this->model_dokumentasi_stanplat->export('dokumentasi_stanplat', 'dokumentasi_stanplat');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_stanplat_export');

		$this->model_dokumentasi_stanplat->pdf('dokumentasi_stanplat', 'dokumentasi_stanplat');
	}
}


/* End of file dokumentasi_stanplat.php */
/* Location: ./application/controllers/administrator/Dokumentasi Stanplat.php */