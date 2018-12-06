<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Sanitasi Sumsel Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Sanitasi Sumsel site
*|
*/
class Dokumentasi_sanitasi_sumsel extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_sanitasi_sumsel');
	}

	/**
	* show all Dokumentasi Sanitasi Sumsels
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_sanitasi_sumsel_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_sanitasi_sumsels'] = $this->model_dokumentasi_sanitasi_sumsel->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_sanitasi_sumsel_counts'] = $this->model_dokumentasi_sanitasi_sumsel->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_sanitasi_sumsel/index/',
			'total_rows'   => $this->model_dokumentasi_sanitasi_sumsel->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Sanitasi Sumsel List');
		$this->render('backend/standart/administrator/dokumentasi_sanitasi_sumsel/dokumentasi_sanitasi_sumsel_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_sanitasi_sumsels
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_sanitasi_sumsel_add');

		$this->template->title('Dokumentasi Sanitasi Sumsel New');
		$this->render('backend/standart/administrator/dokumentasi_sanitasi_sumsel/dokumentasi_sanitasi_sumsel_add', $this->data);
	}

	/**
	* Add New Dokumentasi Sanitasi Sumsels
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_sanitasi_sumsel_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_sanitasi_sumsel_file_uuid = $this->input->post('dokumentasi_sanitasi_sumsel_file_uuid');
			$dokumentasi_sanitasi_sumsel_file_name = $this->input->post('dokumentasi_sanitasi_sumsel_file_name');
		
			$save_data = [
				'dokumentasi_sanitasi_sumsel_id' => $this->input->post('dokumentasi_sanitasi_sumsel_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_sanitasi_sumsel/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_sanitasi_sumsel/');
			}

			if (!empty($dokumentasi_sanitasi_sumsel_file_name)) {
				$dokumentasi_sanitasi_sumsel_file_name_copy = date('YmdHis') . '-' . $dokumentasi_sanitasi_sumsel_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_sanitasi_sumsel_file_uuid . '/' . $dokumentasi_sanitasi_sumsel_file_name, 
						FCPATH . 'uploads/dokumentasi_sanitasi_sumsel/' . $dokumentasi_sanitasi_sumsel_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_sanitasi_sumsel/' . $dokumentasi_sanitasi_sumsel_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_sanitasi_sumsel_file_name_copy;
			}
		
			
			$save_dokumentasi_sanitasi_sumsel = $this->model_dokumentasi_sanitasi_sumsel->store($save_data);

			if ($save_dokumentasi_sanitasi_sumsel) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_sanitasi_sumsel;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_sanitasi_sumsel/edit/' . $save_dokumentasi_sanitasi_sumsel, 'Edit Dokumentasi Sanitasi Sumsel'),
						anchor('administrator/dokumentasi_sanitasi_sumsel', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_sanitasi_sumsel/edit/' . $save_dokumentasi_sanitasi_sumsel, 'Edit Dokumentasi Sanitasi Sumsel')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_sanitasi_sumsel');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_sanitasi_sumsel');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Sanitasi Sumsels
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_sanitasi_sumsel_update');

		$this->data['dokumentasi_sanitasi_sumsel'] = $this->model_dokumentasi_sanitasi_sumsel->find($id);

		$this->template->title('Dokumentasi Sanitasi Sumsel Update');
		$this->render('backend/standart/administrator/dokumentasi_sanitasi_sumsel/dokumentasi_sanitasi_sumsel_update', $this->data);
	}

	/**
	* Update Dokumentasi Sanitasi Sumsels
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_sanitasi_sumsel_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_sanitasi_sumsel_file_uuid = $this->input->post('dokumentasi_sanitasi_sumsel_file_uuid');
			$dokumentasi_sanitasi_sumsel_file_name = $this->input->post('dokumentasi_sanitasi_sumsel_file_name');
		
			$save_data = [
				'dokumentasi_sanitasi_sumsel_id' => $this->input->post('dokumentasi_sanitasi_sumsel_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_sanitasi_sumsel/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_sanitasi_sumsel/');
			}

			if (!empty($dokumentasi_sanitasi_sumsel_file_uuid)) {
				$dokumentasi_sanitasi_sumsel_file_name_copy = date('YmdHis') . '-' . $dokumentasi_sanitasi_sumsel_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_sanitasi_sumsel_file_uuid . '/' . $dokumentasi_sanitasi_sumsel_file_name, 
						FCPATH . 'uploads/dokumentasi_sanitasi_sumsel/' . $dokumentasi_sanitasi_sumsel_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_sanitasi_sumsel/' . $dokumentasi_sanitasi_sumsel_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_sanitasi_sumsel_file_name_copy;
			}
		
			
			$save_dokumentasi_sanitasi_sumsel = $this->model_dokumentasi_sanitasi_sumsel->change($id, $save_data);

			if ($save_dokumentasi_sanitasi_sumsel) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_sanitasi_sumsel', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_sanitasi_sumsel');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_sanitasi_sumsel');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Sanitasi Sumsels
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_sanitasi_sumsel_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_sanitasi_sumsel'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_sanitasi_sumsel'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Sanitasi Sumsels
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_sanitasi_sumsel_view');

		$this->data['dokumentasi_sanitasi_sumsel'] = $this->model_dokumentasi_sanitasi_sumsel->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Sanitasi Sumsel Detail');
		$this->render('backend/standart/administrator/dokumentasi_sanitasi_sumsel/dokumentasi_sanitasi_sumsel_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Sanitasi Sumsels
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_sanitasi_sumsel = $this->model_dokumentasi_sanitasi_sumsel->find($id);

		if (!empty($dokumentasi_sanitasi_sumsel->file)) {
			$path = FCPATH . '/uploads/dokumentasi_sanitasi_sumsel/' . $dokumentasi_sanitasi_sumsel->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_sanitasi_sumsel->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Sanitasi Sumsel	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_sanitasi_sumsel_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_sanitasi_sumsel',
		]);
	}

	/**
	* Delete Image Dokumentasi Sanitasi Sumsel	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_sanitasi_sumsel_delete', false)) {
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
            'table_name'        => 'dokumentasi_sanitasi_sumsel',
            'primary_key'       => 'kode_dss',
            'upload_path'       => 'uploads/dokumentasi_sanitasi_sumsel/'
        ]);
	}

	/**
	* Get Image Dokumentasi Sanitasi Sumsel	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_sanitasi_sumsel_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_sanitasi_sumsel = $this->model_dokumentasi_sanitasi_sumsel->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_sanitasi_sumsel',
            'primary_key'       => 'kode_dss',
            'upload_path'       => 'uploads/dokumentasi_sanitasi_sumsel/',
            'delete_endpoint'   => 'administrator/dokumentasi_sanitasi_sumsel/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_sanitasi_sumsel_export');

		$this->model_dokumentasi_sanitasi_sumsel->export('dokumentasi_sanitasi_sumsel', 'dokumentasi_sanitasi_sumsel');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_sanitasi_sumsel_export');

		$this->model_dokumentasi_sanitasi_sumsel->pdf('dokumentasi_sanitasi_sumsel', 'dokumentasi_sanitasi_sumsel');
	}
}


/* End of file dokumentasi_sanitasi_sumsel.php */
/* Location: ./application/controllers/administrator/Dokumentasi Sanitasi Sumsel.php */