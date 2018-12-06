<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Bendung Disumsel Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Bendung Disumsel site
*|
*/
class Dokumentasi_bendung_disumsel extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_bendung_disumsel');
	}

	/**
	* show all Dokumentasi Bendung Disumsels
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_bendung_disumsel_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_bendung_disumsels'] = $this->model_dokumentasi_bendung_disumsel->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_bendung_disumsel_counts'] = $this->model_dokumentasi_bendung_disumsel->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_bendung_disumsel/index/',
			'total_rows'   => $this->model_dokumentasi_bendung_disumsel->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Bendung Disumsel List');
		$this->render('backend/standart/administrator/dokumentasi_bendung_disumsel/dokumentasi_bendung_disumsel_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_bendung_disumsels
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_bendung_disumsel_add');

		$this->template->title('Dokumentasi Bendung Disumsel New');
		$this->render('backend/standart/administrator/dokumentasi_bendung_disumsel/dokumentasi_bendung_disumsel_add', $this->data);
	}

	/**
	* Add New Dokumentasi Bendung Disumsels
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_bendung_disumsel_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('bendung_disumsel_id', 'Bendung Disumsel Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_bendung_disumsel_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_bendung_disumsel_file_uuid = $this->input->post('dokumentasi_bendung_disumsel_file_uuid');
			$dokumentasi_bendung_disumsel_file_name = $this->input->post('dokumentasi_bendung_disumsel_file_name');
		
			$save_data = [
				'bendung_disumsel_id' => $this->input->post('bendung_disumsel_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_bendung_disumsel/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_bendung_disumsel/');
			}

			if (!empty($dokumentasi_bendung_disumsel_file_name)) {
				$dokumentasi_bendung_disumsel_file_name_copy = date('YmdHis') . '-' . $dokumentasi_bendung_disumsel_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_bendung_disumsel_file_uuid . '/' . $dokumentasi_bendung_disumsel_file_name, 
						FCPATH . 'uploads/dokumentasi_bendung_disumsel/' . $dokumentasi_bendung_disumsel_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_bendung_disumsel/' . $dokumentasi_bendung_disumsel_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_bendung_disumsel_file_name_copy;
			}
		
			
			$save_dokumentasi_bendung_disumsel = $this->model_dokumentasi_bendung_disumsel->store($save_data);

			if ($save_dokumentasi_bendung_disumsel) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_bendung_disumsel;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_bendung_disumsel/edit/' . $save_dokumentasi_bendung_disumsel, 'Edit Dokumentasi Bendung Disumsel'),
						anchor('administrator/dokumentasi_bendung_disumsel', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_bendung_disumsel/edit/' . $save_dokumentasi_bendung_disumsel, 'Edit Dokumentasi Bendung Disumsel')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_bendung_disumsel');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_bendung_disumsel');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Bendung Disumsels
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_bendung_disumsel_update');

		$this->data['dokumentasi_bendung_disumsel'] = $this->model_dokumentasi_bendung_disumsel->find($id);

		$this->template->title('Dokumentasi Bendung Disumsel Update');
		$this->render('backend/standart/administrator/dokumentasi_bendung_disumsel/dokumentasi_bendung_disumsel_update', $this->data);
	}

	/**
	* Update Dokumentasi Bendung Disumsels
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_bendung_disumsel_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('bendung_disumsel_id', 'Bendung Disumsel Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_bendung_disumsel_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_bendung_disumsel_file_uuid = $this->input->post('dokumentasi_bendung_disumsel_file_uuid');
			$dokumentasi_bendung_disumsel_file_name = $this->input->post('dokumentasi_bendung_disumsel_file_name');
		
			$save_data = [
				'bendung_disumsel_id' => $this->input->post('bendung_disumsel_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_bendung_disumsel/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_bendung_disumsel/');
			}

			if (!empty($dokumentasi_bendung_disumsel_file_uuid)) {
				$dokumentasi_bendung_disumsel_file_name_copy = date('YmdHis') . '-' . $dokumentasi_bendung_disumsel_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_bendung_disumsel_file_uuid . '/' . $dokumentasi_bendung_disumsel_file_name, 
						FCPATH . 'uploads/dokumentasi_bendung_disumsel/' . $dokumentasi_bendung_disumsel_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_bendung_disumsel/' . $dokumentasi_bendung_disumsel_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_bendung_disumsel_file_name_copy;
			}
		
			
			$save_dokumentasi_bendung_disumsel = $this->model_dokumentasi_bendung_disumsel->change($id, $save_data);

			if ($save_dokumentasi_bendung_disumsel) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_bendung_disumsel', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_bendung_disumsel');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_bendung_disumsel');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Bendung Disumsels
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_bendung_disumsel_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_bendung_disumsel'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_bendung_disumsel'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Bendung Disumsels
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_bendung_disumsel_view');

		$this->data['dokumentasi_bendung_disumsel'] = $this->model_dokumentasi_bendung_disumsel->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Bendung Disumsel Detail');
		$this->render('backend/standart/administrator/dokumentasi_bendung_disumsel/dokumentasi_bendung_disumsel_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Bendung Disumsels
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_bendung_disumsel = $this->model_dokumentasi_bendung_disumsel->find($id);

		if (!empty($dokumentasi_bendung_disumsel->file)) {
			$path = FCPATH . '/uploads/dokumentasi_bendung_disumsel/' . $dokumentasi_bendung_disumsel->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_bendung_disumsel->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Bendung Disumsel	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_bendung_disumsel_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_bendung_disumsel',
			'allowed_types' => 'jpg|png',
		]);
	}

	/**
	* Delete Image Dokumentasi Bendung Disumsel	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_bendung_disumsel_delete', false)) {
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
            'table_name'        => 'dokumentasi_bendung_disumsel',
            'primary_key'       => 'kode_dbd',
            'upload_path'       => 'uploads/dokumentasi_bendung_disumsel/'
        ]);
	}

	/**
	* Get Image Dokumentasi Bendung Disumsel	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_bendung_disumsel_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_bendung_disumsel = $this->model_dokumentasi_bendung_disumsel->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_bendung_disumsel',
            'primary_key'       => 'kode_dbd',
            'upload_path'       => 'uploads/dokumentasi_bendung_disumsel/',
            'delete_endpoint'   => 'administrator/dokumentasi_bendung_disumsel/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_bendung_disumsel_export');

		$this->model_dokumentasi_bendung_disumsel->export('dokumentasi_bendung_disumsel', 'dokumentasi_bendung_disumsel');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_bendung_disumsel_export');

		$this->model_dokumentasi_bendung_disumsel->pdf('dokumentasi_bendung_disumsel', 'dokumentasi_bendung_disumsel');
	}
}


/* End of file dokumentasi_bendung_disumsel.php */
/* Location: ./application/controllers/administrator/Dokumentasi Bendung Disumsel.php */