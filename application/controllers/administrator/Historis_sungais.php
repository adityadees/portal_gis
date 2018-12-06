<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Sungais Controller
*| --------------------------------------------------------------------------
*| Historis Sungais site
*|
*/
class Historis_sungais extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_sungais');
	}

	/**
	* show all Historis Sungaiss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_sungais_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_sungaiss'] = $this->model_historis_sungais->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_sungais_counts'] = $this->model_historis_sungais->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_sungais/index/',
			'total_rows'   => $this->model_historis_sungais->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Sungais List');
		$this->render('backend/standart/administrator/historis_sungais/historis_sungais_list', $this->data);
	}
	
	/**
	* Add new historis_sungaiss
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_sungais_add');

		$this->template->title('Historis Sungais New');
		$this->render('backend/standart/administrator/historis_sungais/historis_sungais_add', $this->data);
	}

	/**
	* Add New Historis Sungaiss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_sungais_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_historis_sungai' => $this->input->post('kode_historis_sungai'),
				'sungais_id' => $this->input->post('sungais_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
			];

			
			$save_historis_sungais = $this->model_historis_sungais->store($save_data);

			if ($save_historis_sungais) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_sungais;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_sungais/edit/' . $save_historis_sungais, 'Edit Historis Sungais'),
						anchor('administrator/historis_sungais', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_sungais/edit/' . $save_historis_sungais, 'Edit Historis Sungais')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_sungais');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_sungais');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Sungaiss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_sungais_update');

		$this->data['historis_sungais'] = $this->model_historis_sungais->find($id);

		$this->template->title('Historis Sungais Update');
		$this->render('backend/standart/administrator/historis_sungais/historis_sungais_update', $this->data);
	}

	/**
	* Update Historis Sungaiss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_sungais_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_historis_sungai' => $this->input->post('kode_historis_sungai'),
				'sungais_id' => $this->input->post('sungais_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
			];

			
			$save_historis_sungais = $this->model_historis_sungais->change($id, $save_data);

			if ($save_historis_sungais) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_sungais', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_sungais');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_sungais');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Sungaiss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_sungais_delete');

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
            set_message(cclang('has_been_deleted', 'historis_sungais'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_sungais'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Sungaiss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_sungais_view');

		$this->data['historis_sungais'] = $this->model_historis_sungais->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Sungais Detail');
		$this->render('backend/standart/administrator/historis_sungais/historis_sungais_view', $this->data);
	}
	
	/**
	* delete Historis Sungaiss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_sungais = $this->model_historis_sungais->find($id);

		
		
		return $this->model_historis_sungais->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_sungais_export');

		$this->model_historis_sungais->export('historis_sungais', 'historis_sungais');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_sungais_export');

		$this->model_historis_sungais->pdf('historis_sungais', 'historis_sungais');
	}
}


/* End of file historis_sungais.php */
/* Location: ./application/controllers/administrator/Historis Sungais.php */