<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Jalan Nasional Controller
*| --------------------------------------------------------------------------
*| Historis Jalan Nasional site
*|
*/
class Historis_jalan_nasional extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_jalan_nasional');
	}

	/**
	* show all Historis Jalan Nasionals
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_jalan_nasional_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_jalan_nasionals'] = $this->model_historis_jalan_nasional->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_jalan_nasional_counts'] = $this->model_historis_jalan_nasional->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_jalan_nasional/index/',
			'total_rows'   => $this->model_historis_jalan_nasional->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Jalan Nasional List');
		$this->render('backend/standart/administrator/historis_jalan_nasional/historis_jalan_nasional_list', $this->data);
	}
	
	/**
	* Add new historis_jalan_nasionals
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_jalan_nasional_add');

		$this->template->title('Historis Jalan Nasional New');
		$this->render('backend/standart/administrator/historis_jalan_nasional/historis_jalan_nasional_add', $this->data);
	}

	/**
	* Add New Historis Jalan Nasionals
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_jalan_nasional_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('jalan_id', 'Jalan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Historis Vefektif', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Historis Vpenanganan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_sdana', 'Historis Sdana', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jalan_id' => $this->input->post('jalan_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
			];

			
			$save_historis_jalan_nasional = $this->model_historis_jalan_nasional->store($save_data);

			if ($save_historis_jalan_nasional) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_jalan_nasional;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_jalan_nasional/edit/' . $save_historis_jalan_nasional, 'Edit Historis Jalan Nasional'),
						anchor('administrator/historis_jalan_nasional', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_jalan_nasional/edit/' . $save_historis_jalan_nasional, 'Edit Historis Jalan Nasional')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_jalan_nasional');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_jalan_nasional');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Jalan Nasionals
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_jalan_nasional_update');

		$this->data['historis_jalan_nasional'] = $this->model_historis_jalan_nasional->find($id);

		$this->template->title('Historis Jalan Nasional Update');
		$this->render('backend/standart/administrator/historis_jalan_nasional/historis_jalan_nasional_update', $this->data);
	}

	/**
	* Update Historis Jalan Nasionals
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_jalan_nasional_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jalan_id', 'Jalan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Historis Vefektif', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Historis Vpenanganan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_sdana', 'Historis Sdana', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jalan_id' => $this->input->post('jalan_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
			];

			
			$save_historis_jalan_nasional = $this->model_historis_jalan_nasional->change($id, $save_data);

			if ($save_historis_jalan_nasional) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_jalan_nasional', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_jalan_nasional');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_jalan_nasional');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Jalan Nasionals
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_jalan_nasional_delete');

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
            set_message(cclang('has_been_deleted', 'historis_jalan_nasional'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_jalan_nasional'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Jalan Nasionals
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_jalan_nasional_view');

		$this->data['historis_jalan_nasional'] = $this->model_historis_jalan_nasional->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Jalan Nasional Detail');
		$this->render('backend/standart/administrator/historis_jalan_nasional/historis_jalan_nasional_view', $this->data);
	}
	
	/**
	* delete Historis Jalan Nasionals
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_jalan_nasional = $this->model_historis_jalan_nasional->find($id);

		
		
		return $this->model_historis_jalan_nasional->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_jalan_nasional_export');

		$this->model_historis_jalan_nasional->export('historis_jalan_nasional', 'historis_jalan_nasional');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_jalan_nasional_export');

		$this->model_historis_jalan_nasional->pdf('historis_jalan_nasional', 'historis_jalan_nasional');
	}
}


/* End of file historis_jalan_nasional.php */
/* Location: ./application/controllers/administrator/Historis Jalan Nasional.php */