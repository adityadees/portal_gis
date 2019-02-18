<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Sungai Controller
*| --------------------------------------------------------------------------
*| Sungai site
*|
*/
class Sungai extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_sungai');
	}

	/**
	* show all Sungais
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('sungai_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['sungais'] = $this->model_sungai->get($filter, $field, $this->limit_page, $offset);
		$this->data['sungai_counts'] = $this->model_sungai->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/sungai/index/',
			'total_rows'   => $this->model_sungai->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Sungai List');
		$this->render('backend/standart/administrator/sungai/sungai_list', $this->data);
	}
	
	/**
	* Add new sungais
	*
	*/
	public function add()
	{
		$this->is_allowed('sungai_add');

		$this->template->title('Sungai New');
		$this->render('backend/standart/administrator/sungai/sungai_add', $this->data);
	}

	/**
	* Add New Sungais
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('sungai_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('sungai_id', 'Sungai Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('fnode_', 'Fnode ', 'trim|required');
		$this->form_validation->set_rules('tnode', 'Tnode', 'trim|required');
		$this->form_validation->set_rules('lpoly_', 'Lpoly ', 'trim|required');
		$this->form_validation->set_rules('length', 'Length', 'trim|required');
		$this->form_validation->set_rules('sungai_', 'Sungai ', 'trim|required');
		$this->form_validation->set_rules('saluran', 'Saluran', 'trim|required');
		$this->form_validation->set_rules('text_sungai', 'Text Sungai', 'trim|required');
		$this->form_validation->set_rules('klasifikasi', 'Klasifikasi', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'sungai_id' => $this->input->post('sungai_id'),
				'fnode_' => $this->input->post('fnode_'),
				'tnode' => $this->input->post('tnode'),
				'lpoly_' => $this->input->post('lpoly_'),
				'length' => $this->input->post('length'),
				'sungai_' => $this->input->post('sungai_'),
				'saluran' => $this->input->post('saluran'),
				'text_sungai' => $this->input->post('text_sungai'),
				'klasifikasi' => $this->input->post('klasifikasi'),
			];

			
			$save_sungai = $this->model_sungai->store($save_data);

			if ($save_sungai) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_sungai;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/sungai/edit/' . $save_sungai, 'Edit Sungai'),
						anchor('administrator/sungai', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/sungai/edit/' . $save_sungai, 'Edit Sungai')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/sungai');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/sungai');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Sungais
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('sungai_update');

		$this->data['sungai'] = $this->model_sungai->find($id);

		$this->template->title('Sungai Update');
		$this->render('backend/standart/administrator/sungai/sungai_update', $this->data);
	}

	/**
	* Update Sungais
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('sungai_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('sungai_id', 'Sungai Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('fnode_', 'Fnode ', 'trim|required');
		$this->form_validation->set_rules('tnode', 'Tnode', 'trim|required');
		$this->form_validation->set_rules('lpoly_', 'Lpoly ', 'trim|required');
		$this->form_validation->set_rules('length', 'Length', 'trim|required');
		$this->form_validation->set_rules('sungai_', 'Sungai ', 'trim|required');
		$this->form_validation->set_rules('saluran', 'Saluran', 'trim|required');
		$this->form_validation->set_rules('text_sungai', 'Text Sungai', 'trim|required');
		$this->form_validation->set_rules('klasifikasi', 'Klasifikasi', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'sungai_id' => $this->input->post('sungai_id'),
				'fnode_' => $this->input->post('fnode_'),
				'tnode' => $this->input->post('tnode'),
				'lpoly_' => $this->input->post('lpoly_'),
				'length' => $this->input->post('length'),
				'sungai_' => $this->input->post('sungai_'),
				'saluran' => $this->input->post('saluran'),
				'text_sungai' => $this->input->post('text_sungai'),
				'klasifikasi' => $this->input->post('klasifikasi'),
			];

			
			$save_sungai = $this->model_sungai->change($id, $save_data);

			if ($save_sungai) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/sungai', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/sungai');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/sungai');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Sungais
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('sungai_delete');

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
            set_message(cclang('has_been_deleted', 'sungai'), 'success');
        } else {
            set_message(cclang('error_delete', 'sungai'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Sungais
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('sungai_view');

		$this->data['sungai'] = $this->model_sungai->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Sungai Detail');
		$this->render('backend/standart/administrator/sungai/sungai_view', $this->data);
	}
	
	/**
	* delete Sungais
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$sungai = $this->model_sungai->find($id);

		
		
		return $this->model_sungai->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('sungai_export');

		$this->model_sungai->export('sungai', 'sungai');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('sungai_export');

		$this->model_sungai->pdf('sungai', 'sungai');
	}
}


/* End of file sungai.php */
/* Location: ./application/controllers/administrator/Sungai.php */