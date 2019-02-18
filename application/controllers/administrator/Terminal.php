<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Terminal Controller
*| --------------------------------------------------------------------------
*| Terminal site
*|
*/
class Terminal extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_terminal');
	}

	/**
	* show all Terminals
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('terminal_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['terminals'] = $this->model_terminal->get($filter, $field, $this->limit_page, $offset);
		$this->data['terminal_counts'] = $this->model_terminal->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/terminal/index/',
			'total_rows'   => $this->model_terminal->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Terminal List');
		$this->render('backend/standart/administrator/terminal/terminal_list', $this->data);
	}
	
	/**
	* Add new terminals
	*
	*/
	public function add()
	{
		$this->is_allowed('terminal_add');

		$this->template->title('Terminal New');
		$this->render('backend/standart/administrator/terminal/terminal_add', $this->data);
	}

	/**
	* Add New Terminals
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('terminal_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('terminal_id', 'Terminal Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_termi', 'Nama Termi', 'trim|required');
		$this->form_validation->set_rules('klasifikasi', 'Klasifikasi', 'trim|required');
		$this->form_validation->set_rules('terminal_dtampung', 'Terminal Dtampung', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'terminal_id' => $this->input->post('terminal_id'),
				'nama_termi' => $this->input->post('nama_termi'),
				'klasifikasi' => $this->input->post('klasifikasi'),
				'terminal_dtampung' => $this->input->post('terminal_dtampung'),
				'tipe' => $this->input->post('tipe'),
			];

			
			$save_terminal = $this->model_terminal->store($save_data);

			if ($save_terminal) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_terminal;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/terminal/edit/' . $save_terminal, 'Edit Terminal'),
						anchor('administrator/terminal', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/terminal/edit/' . $save_terminal, 'Edit Terminal')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/terminal');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/terminal');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Terminals
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('terminal_update');

		$this->data['terminal'] = $this->model_terminal->find($id);

		$this->template->title('Terminal Update');
		$this->render('backend/standart/administrator/terminal/terminal_update', $this->data);
	}

	/**
	* Update Terminals
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('terminal_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('terminal_id', 'Terminal Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_termi', 'Nama Termi', 'trim|required');
		$this->form_validation->set_rules('klasifikasi', 'Klasifikasi', 'trim|required');
		$this->form_validation->set_rules('terminal_dtampung', 'Terminal Dtampung', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'terminal_id' => $this->input->post('terminal_id'),
				'nama_termi' => $this->input->post('nama_termi'),
				'klasifikasi' => $this->input->post('klasifikasi'),
				'terminal_dtampung' => $this->input->post('terminal_dtampung'),
				'tipe' => $this->input->post('tipe'),
			];

			
			$save_terminal = $this->model_terminal->change($id, $save_data);

			if ($save_terminal) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/terminal', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/terminal');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/terminal');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Terminals
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('terminal_delete');

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
            set_message(cclang('has_been_deleted', 'terminal'), 'success');
        } else {
            set_message(cclang('error_delete', 'terminal'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Terminals
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('terminal_view');

		$this->data['terminal'] = $this->model_terminal->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Terminal Detail');
		$this->render('backend/standart/administrator/terminal/terminal_view', $this->data);
	}
	
	/**
	* delete Terminals
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$terminal = $this->model_terminal->find($id);

		
		
		return $this->model_terminal->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('terminal_export');

		$this->model_terminal->export('terminal', 'terminal');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('terminal_export');

		$this->model_terminal->pdf('terminal', 'terminal');
	}
}


/* End of file terminal.php */
/* Location: ./application/controllers/administrator/Terminal.php */