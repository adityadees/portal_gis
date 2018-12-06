<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Sanitasi Sumsel Controller
*| --------------------------------------------------------------------------
*| Historis Sanitasi Sumsel site
*|
*/
class Historis_sanitasi_sumsel extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_sanitasi_sumsel');
	}

	/**
	* show all Historis Sanitasi Sumsels
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_sanitasi_sumsel_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_sanitasi_sumsels'] = $this->model_historis_sanitasi_sumsel->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_sanitasi_sumsel_counts'] = $this->model_historis_sanitasi_sumsel->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_sanitasi_sumsel/index/',
			'total_rows'   => $this->model_historis_sanitasi_sumsel->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Sanitasi Sumsel List');
		$this->render('backend/standart/administrator/historis_sanitasi_sumsel/historis_sanitasi_sumsel_list', $this->data);
	}
	
	/**
	* Add new historis_sanitasi_sumsels
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_sanitasi_sumsel_add');

		$this->template->title('Historis Sanitasi Sumsel New');
		$this->render('backend/standart/administrator/historis_sanitasi_sumsel/historis_sanitasi_sumsel_add', $this->data);
	}

	/**
	* Add New Historis Sanitasi Sumsels
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_sanitasi_sumsel_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_historis_sanitasi_sumsel' => $this->input->post('kode_historis_sanitasi_sumsel'),
				'sanitasi_sumsel_id' => $this->input->post('sanitasi_sumsel_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
			];

			
			$save_historis_sanitasi_sumsel = $this->model_historis_sanitasi_sumsel->store($save_data);

			if ($save_historis_sanitasi_sumsel) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_sanitasi_sumsel;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_sanitasi_sumsel/edit/' . $save_historis_sanitasi_sumsel, 'Edit Historis Sanitasi Sumsel'),
						anchor('administrator/historis_sanitasi_sumsel', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_sanitasi_sumsel/edit/' . $save_historis_sanitasi_sumsel, 'Edit Historis Sanitasi Sumsel')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_sanitasi_sumsel');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_sanitasi_sumsel');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Sanitasi Sumsels
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_sanitasi_sumsel_update');

		$this->data['historis_sanitasi_sumsel'] = $this->model_historis_sanitasi_sumsel->find($id);

		$this->template->title('Historis Sanitasi Sumsel Update');
		$this->render('backend/standart/administrator/historis_sanitasi_sumsel/historis_sanitasi_sumsel_update', $this->data);
	}

	/**
	* Update Historis Sanitasi Sumsels
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_sanitasi_sumsel_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_historis_sanitasi_sumsel' => $this->input->post('kode_historis_sanitasi_sumsel'),
				'sanitasi_sumsel_id' => $this->input->post('sanitasi_sumsel_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
			];

			
			$save_historis_sanitasi_sumsel = $this->model_historis_sanitasi_sumsel->change($id, $save_data);

			if ($save_historis_sanitasi_sumsel) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_sanitasi_sumsel', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_sanitasi_sumsel');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_sanitasi_sumsel');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Sanitasi Sumsels
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_sanitasi_sumsel_delete');

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
            set_message(cclang('has_been_deleted', 'historis_sanitasi_sumsel'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_sanitasi_sumsel'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Sanitasi Sumsels
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_sanitasi_sumsel_view');

		$this->data['historis_sanitasi_sumsel'] = $this->model_historis_sanitasi_sumsel->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Sanitasi Sumsel Detail');
		$this->render('backend/standart/administrator/historis_sanitasi_sumsel/historis_sanitasi_sumsel_view', $this->data);
	}
	
	/**
	* delete Historis Sanitasi Sumsels
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_sanitasi_sumsel = $this->model_historis_sanitasi_sumsel->find($id);

		
		
		return $this->model_historis_sanitasi_sumsel->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_sanitasi_sumsel_export');

		$this->model_historis_sanitasi_sumsel->export('historis_sanitasi_sumsel', 'historis_sanitasi_sumsel');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_sanitasi_sumsel_export');

		$this->model_historis_sanitasi_sumsel->pdf('historis_sanitasi_sumsel', 'historis_sanitasi_sumsel');
	}
}


/* End of file historis_sanitasi_sumsel.php */
/* Location: ./application/controllers/administrator/Historis Sanitasi Sumsel.php */