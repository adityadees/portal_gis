<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Sungai Polys Controller
*| --------------------------------------------------------------------------
*| Historis Sungai Polys site
*|
*/
class Historis_sungai_polys extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_sungai_polys');
	}

	/**
	* show all Historis Sungai Polyss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_sungai_polys_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_sungai_polyss'] = $this->model_historis_sungai_polys->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_sungai_polys_counts'] = $this->model_historis_sungai_polys->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_sungai_polys/index/',
			'total_rows'   => $this->model_historis_sungai_polys->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Sungai Polys List');
		$this->render('backend/standart/administrator/historis_sungai_polys/historis_sungai_polys_list', $this->data);
	}
	
	/**
	* Add new historis_sungai_polyss
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_sungai_polys_add');

		$this->template->title('Historis Sungai Polys New');
		$this->render('backend/standart/administrator/historis_sungai_polys/historis_sungai_polys_add', $this->data);
	}

	/**
	* Add New Historis Sungai Polyss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_sungai_polys_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('historis_namakeg', 'Nama Kegiatan', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'sungai_polys_id' => $this->input->post('sungai_polys_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
			];

			
			$save_historis_sungai_polys = $this->model_historis_sungai_polys->store($save_data);

			if ($save_historis_sungai_polys) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_sungai_polys;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_sungai_polys/edit/' . $save_historis_sungai_polys, 'Edit Historis Sungai Polys'),
						anchor('administrator/historis_sungai_polys', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_sungai_polys/edit/' . $save_historis_sungai_polys, 'Edit Historis Sungai Polys')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_sungai_polys');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_sungai_polys');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Sungai Polyss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_sungai_polys_update');

		$this->data['historis_sungai_polys'] = $this->model_historis_sungai_polys->find($id);

		$this->template->title('Historis Sungai Polys Update');
		$this->render('backend/standart/administrator/historis_sungai_polys/historis_sungai_polys_update', $this->data);
	}

	/**
	* Update Historis Sungai Polyss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_sungai_polys_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('historis_namakeg', 'Nama Kegiatan', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'sungai_polys_id' => $this->input->post('sungai_polys_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
			];

			
			$save_historis_sungai_polys = $this->model_historis_sungai_polys->change($id, $save_data);

			if ($save_historis_sungai_polys) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_sungai_polys', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_sungai_polys');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_sungai_polys');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Sungai Polyss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_sungai_polys_delete');

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
            set_message(cclang('has_been_deleted', 'historis_sungai_polys'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_sungai_polys'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Sungai Polyss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_sungai_polys_view');

		$this->data['historis_sungai_polys'] = $this->model_historis_sungai_polys->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Sungai Polys Detail');
		$this->render('backend/standart/administrator/historis_sungai_polys/historis_sungai_polys_view', $this->data);
	}
	
	/**
	* delete Historis Sungai Polyss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_sungai_polys = $this->model_historis_sungai_polys->find($id);

		
		
		return $this->model_historis_sungai_polys->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_sungai_polys_export');

		$this->model_historis_sungai_polys->export('historis_sungai_polys', 'historis_sungai_polys');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_sungai_polys_export');

		$this->model_historis_sungai_polys->pdf('historis_sungai_polys', 'historis_sungai_polys');
	}
}


/* End of file historis_sungai_polys.php */
/* Location: ./application/controllers/administrator/Historis Sungai Polys.php */