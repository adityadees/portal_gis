<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Terminal Controller
*| --------------------------------------------------------------------------
*| Historis Terminal site
*|
*/
class Historis_terminal extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_terminal');
	}

	/**
	* show all Historis Terminals
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_terminal_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_terminals'] = $this->model_historis_terminal->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_terminal_counts'] = $this->model_historis_terminal->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_terminal/index/',
			'total_rows'   => $this->model_historis_terminal->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Terminal List');
		$this->render('backend/standart/administrator/historis_terminal/historis_terminal_list', $this->data);
	}
	
	/**
	* Add new historis_terminals
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_terminal_add');

		$this->template->title('Historis Terminal New');
		$this->render('backend/standart/administrator/historis_terminal/historis_terminal_add', $this->data);
	}

	/**
	* Add New Historis Terminals
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_terminal_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('terminal_id', 'Terminal Id', 'trim|required');
		$this->form_validation->set_rules('historis_vefektif', 'Historis Vefektif', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required');
		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Historis Vpenanganan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_sdana', 'Historis Sdana', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'terminal_id' => $this->input->post('terminal_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
			];

			
			$save_historis_terminal = $this->model_historis_terminal->store($save_data);

			if ($save_historis_terminal) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_terminal;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_terminal/edit/' . $save_historis_terminal, 'Edit Historis Terminal'),
						anchor('administrator/historis_terminal', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_terminal/edit/' . $save_historis_terminal, 'Edit Historis Terminal')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_terminal');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_terminal');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Terminals
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_terminal_update');

		$this->data['historis_terminal'] = $this->model_historis_terminal->find($id);

		$this->template->title('Historis Terminal Update');
		$this->render('backend/standart/administrator/historis_terminal/historis_terminal_update', $this->data);
	}

	/**
	* Update Historis Terminals
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_terminal_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('terminal_id', 'Terminal Id', 'trim|required');
		$this->form_validation->set_rules('historis_vefektif', 'Historis Vefektif', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required');
		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Historis Vpenanganan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_sdana', 'Historis Sdana', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'terminal_id' => $this->input->post('terminal_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
			];

			
			$save_historis_terminal = $this->model_historis_terminal->change($id, $save_data);

			if ($save_historis_terminal) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_terminal', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_terminal');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_terminal');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Terminals
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_terminal_delete');

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
            set_message(cclang('has_been_deleted', 'historis_terminal'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_terminal'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Terminals
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_terminal_view');

		$this->data['historis_terminal'] = $this->model_historis_terminal->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Terminal Detail');
		$this->render('backend/standart/administrator/historis_terminal/historis_terminal_view', $this->data);
	}
	
	/**
	* delete Historis Terminals
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_terminal = $this->model_historis_terminal->find($id);

		
		
		return $this->model_historis_terminal->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_terminal_export');

		$this->model_historis_terminal->export('historis_terminal', 'historis_terminal');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_terminal_export');

		$this->model_historis_terminal->pdf('historis_terminal', 'historis_terminal');
	}
}


/* End of file historis_terminal.php */
/* Location: ./application/controllers/administrator/Historis Terminal.php */