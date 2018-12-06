<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Terminal Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Terminal site
*|
*/
class Dokumentasi_terminal extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_terminal');
	}

	/**
	* show all Dokumentasi Terminals
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_terminal_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_terminals'] = $this->model_dokumentasi_terminal->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_terminal_counts'] = $this->model_dokumentasi_terminal->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_terminal/index/',
			'total_rows'   => $this->model_dokumentasi_terminal->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Terminal List');
		$this->render('backend/standart/administrator/dokumentasi_terminal/dokumentasi_terminal_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_terminals
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_terminal_add');

		$this->template->title('Dokumentasi Terminal New');
		$this->render('backend/standart/administrator/dokumentasi_terminal/dokumentasi_terminal_add', $this->data);
	}

	/**
	* Add New Dokumentasi Terminals
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_terminal_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('terminal_id', 'Terminal Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_terminal_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_terminal_file_uuid = $this->input->post('dokumentasi_terminal_file_uuid');
			$dokumentasi_terminal_file_name = $this->input->post('dokumentasi_terminal_file_name');
		
			$save_data = [
				'terminal_id' => $this->input->post('terminal_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_terminal/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_terminal/');
			}

			if (!empty($dokumentasi_terminal_file_name)) {
				$dokumentasi_terminal_file_name_copy = date('YmdHis') . '-' . $dokumentasi_terminal_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_terminal_file_uuid . '/' . $dokumentasi_terminal_file_name, 
						FCPATH . 'uploads/dokumentasi_terminal/' . $dokumentasi_terminal_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_terminal/' . $dokumentasi_terminal_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_terminal_file_name_copy;
			}
		
			
			$save_dokumentasi_terminal = $this->model_dokumentasi_terminal->store($save_data);

			if ($save_dokumentasi_terminal) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_terminal;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_terminal/edit/' . $save_dokumentasi_terminal, 'Edit Dokumentasi Terminal'),
						anchor('administrator/dokumentasi_terminal', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_terminal/edit/' . $save_dokumentasi_terminal, 'Edit Dokumentasi Terminal')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_terminal');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_terminal');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Terminals
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_terminal_update');

		$this->data['dokumentasi_terminal'] = $this->model_dokumentasi_terminal->find($id);

		$this->template->title('Dokumentasi Terminal Update');
		$this->render('backend/standart/administrator/dokumentasi_terminal/dokumentasi_terminal_update', $this->data);
	}

	/**
	* Update Dokumentasi Terminals
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_terminal_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('terminal_id', 'Terminal Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_terminal_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_terminal_file_uuid = $this->input->post('dokumentasi_terminal_file_uuid');
			$dokumentasi_terminal_file_name = $this->input->post('dokumentasi_terminal_file_name');
		
			$save_data = [
				'terminal_id' => $this->input->post('terminal_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_terminal/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_terminal/');
			}

			if (!empty($dokumentasi_terminal_file_uuid)) {
				$dokumentasi_terminal_file_name_copy = date('YmdHis') . '-' . $dokumentasi_terminal_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_terminal_file_uuid . '/' . $dokumentasi_terminal_file_name, 
						FCPATH . 'uploads/dokumentasi_terminal/' . $dokumentasi_terminal_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_terminal/' . $dokumentasi_terminal_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_terminal_file_name_copy;
			}
		
			
			$save_dokumentasi_terminal = $this->model_dokumentasi_terminal->change($id, $save_data);

			if ($save_dokumentasi_terminal) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_terminal', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_terminal');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_terminal');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Terminals
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_terminal_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_terminal'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_terminal'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Terminals
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_terminal_view');

		$this->data['dokumentasi_terminal'] = $this->model_dokumentasi_terminal->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Terminal Detail');
		$this->render('backend/standart/administrator/dokumentasi_terminal/dokumentasi_terminal_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Terminals
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_terminal = $this->model_dokumentasi_terminal->find($id);

		if (!empty($dokumentasi_terminal->file)) {
			$path = FCPATH . '/uploads/dokumentasi_terminal/' . $dokumentasi_terminal->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_terminal->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Terminal	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_terminal_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_terminal',
		]);
	}

	/**
	* Delete Image Dokumentasi Terminal	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_terminal_delete', false)) {
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
            'table_name'        => 'dokumentasi_terminal',
            'primary_key'       => 'dokumentasi_terminal_id',
            'upload_path'       => 'uploads/dokumentasi_terminal/'
        ]);
	}

	/**
	* Get Image Dokumentasi Terminal	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_terminal_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_terminal = $this->model_dokumentasi_terminal->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_terminal',
            'primary_key'       => 'dokumentasi_terminal_id',
            'upload_path'       => 'uploads/dokumentasi_terminal/',
            'delete_endpoint'   => 'administrator/dokumentasi_terminal/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_terminal_export');

		$this->model_dokumentasi_terminal->export('dokumentasi_terminal', 'dokumentasi_terminal');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_terminal_export');

		$this->model_dokumentasi_terminal->pdf('dokumentasi_terminal', 'dokumentasi_terminal');
	}
}


/* End of file dokumentasi_terminal.php */
/* Location: ./application/controllers/administrator/Dokumentasi Terminal.php */