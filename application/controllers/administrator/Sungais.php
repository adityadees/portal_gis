<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Sungais Controller
*| --------------------------------------------------------------------------
*| Sungais site
*|
*/
class Sungais extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_sungais');
	}

	/**
	* show all Sungaiss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('sungais_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['sungaiss'] = $this->model_sungais->get($filter, $field, $this->limit_page, $offset);
		$this->data['sungais_counts'] = $this->model_sungais->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/sungais/index/',
			'total_rows'   => $this->model_sungais->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Sungais List');
		$this->render('backend/standart/administrator/sungais/sungais_list', $this->data);
	}
	
	/**
	* Add new sungaiss
	*
	*/
	public function add()
	{
		$this->is_allowed('sungais_add');

		$this->template->title('Sungais New');
		$this->render('backend/standart/administrator/sungais/sungais_add', $this->data);
	}

	/**
	* Add New Sungaiss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('sungais_add', false)) {
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

			
			$save_sungais = $this->model_sungais->store($save_data);

			if ($save_sungais) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_sungais;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/sungais/edit/' . $save_sungais, 'Edit Sungais'),
						anchor('administrator/sungais', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/sungais/edit/' . $save_sungais, 'Edit Sungais')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/sungais');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/sungais');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Sungaiss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('sungais_update');

		$this->data['sungais'] = $this->model_sungais->find($id);

		$this->template->title('Sungais Update');
		$this->render('backend/standart/administrator/sungais/sungais_update', $this->data);
	}

	/**
	* Update Sungaiss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('sungais_update', false)) {
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

			
			$save_sungais = $this->model_sungais->change($id, $save_data);

			if ($save_sungais) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/sungais', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/sungais');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/sungais');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Sungaiss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('sungais_delete');

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
            set_message(cclang('has_been_deleted', 'sungais'), 'success');
        } else {
            set_message(cclang('error_delete', 'sungais'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Sungaiss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('sungais_view');

		$this->data['sungais'] = $this->model_sungais->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Sungais Detail');
		$this->render('backend/standart/administrator/sungais/sungais_view', $this->data);
	}
	
	/**
	* delete Sungaiss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$sungais = $this->model_sungais->find($id);

		
		
		return $this->model_sungais->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('sungais_export');

		$this->model_sungais->export('sungais', 'sungais');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('sungais_export');

		$this->model_sungais->pdf('sungais', 'sungais');
	}
}


/* End of file sungais.php */
/* Location: ./application/controllers/administrator/Sungais.php */