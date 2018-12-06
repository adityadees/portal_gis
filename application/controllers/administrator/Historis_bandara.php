<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Bandara Controller
*| --------------------------------------------------------------------------
*| Historis Bandara site
*|
*/
class Historis_bandara extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_bandara');
	}

	/**
	* show all Historis Bandaras
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_bandara_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_bandaras'] = $this->model_historis_bandara->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_bandara_counts'] = $this->model_historis_bandara->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_bandara/index/',
			'total_rows'   => $this->model_historis_bandara->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Bandara List');
		$this->render('backend/standart/administrator/historis_bandara/historis_bandara_list', $this->data);
	}
	
	/**
	* Add new historis_bandaras
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_bandara_add');

		$this->template->title('Historis Bandara New');
		$this->render('backend/standart/administrator/historis_bandara/historis_bandara_add', $this->data);
	}

	/**
	* Add New Historis Bandaras
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_bandara_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('bandara_id', 'Bandara Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Historis Vefektif', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required');
		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Historis Vpenanganan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_sdana', 'Historis Sdana', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'bandara_id' => $this->input->post('bandara_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
			];

			
			$save_historis_bandara = $this->model_historis_bandara->store($save_data);

			if ($save_historis_bandara) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_bandara;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_bandara/edit/' . $save_historis_bandara, 'Edit Historis Bandara'),
						anchor('administrator/historis_bandara', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_bandara/edit/' . $save_historis_bandara, 'Edit Historis Bandara')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_bandara');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_bandara');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Bandaras
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_bandara_update');

		$this->data['historis_bandara'] = $this->model_historis_bandara->find($id);

		$this->template->title('Historis Bandara Update');
		$this->render('backend/standart/administrator/historis_bandara/historis_bandara_update', $this->data);
	}

	/**
	* Update Historis Bandaras
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_bandara_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('bandara_id', 'Bandara Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Historis Vefektif', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required');
		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Historis Vpenanganan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_sdana', 'Historis Sdana', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'bandara_id' => $this->input->post('bandara_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
			];

			
			$save_historis_bandara = $this->model_historis_bandara->change($id, $save_data);

			if ($save_historis_bandara) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_bandara', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_bandara');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_bandara');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Bandaras
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_bandara_delete');

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
            set_message(cclang('has_been_deleted', 'historis_bandara'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_bandara'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Bandaras
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_bandara_view');

		$this->data['historis_bandara'] = $this->model_historis_bandara->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Bandara Detail');
		$this->render('backend/standart/administrator/historis_bandara/historis_bandara_view', $this->data);
	}
	
	/**
	* delete Historis Bandaras
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_bandara = $this->model_historis_bandara->find($id);

		
		
		return $this->model_historis_bandara->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_bandara_export');

		$this->model_historis_bandara->export('historis_bandara', 'historis_bandara');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_bandara_export');

		$this->model_historis_bandara->pdf('historis_bandara', 'historis_bandara');
	}
}


/* End of file historis_bandara.php */
/* Location: ./application/controllers/administrator/Historis Bandara.php */