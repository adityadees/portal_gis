<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Jembatan Pt 250k Controller
*| --------------------------------------------------------------------------
*| Historis Jembatan Pt 250k site
*|
*/
class Historis_jembatan_pt_250k extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_jembatan_pt_250k');
	}

	/**
	* show all Historis Jembatan Pt 250ks
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_jembatan_pt_250k_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_jembatan_pt_250ks'] = $this->model_historis_jembatan_pt_250k->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_jembatan_pt_250k_counts'] = $this->model_historis_jembatan_pt_250k->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_jembatan_pt_250k/index/',
			'total_rows'   => $this->model_historis_jembatan_pt_250k->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Jembatan Pt 250k List');
		$this->render('backend/standart/administrator/historis_jembatan_pt_250k/historis_jembatan_pt_250k_list', $this->data);
	}
	
	/**
	* Add new historis_jembatan_pt_250ks
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_jembatan_pt_250k_add');

		$this->template->title('Historis Jembatan Pt 250k New');
		$this->render('backend/standart/administrator/historis_jembatan_pt_250k/historis_jembatan_pt_250k_add', $this->data);
	}

	/**
	* Add New Historis Jembatan Pt 250ks
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_jembatan_pt_250k_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_historis_jembatan_pt_250k' => $this->input->post('kode_historis_jembatan_pt_250k'),
				'jembatan_pt_250k_id' => $this->input->post('jembatan_pt_250k_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
			];

			
			$save_historis_jembatan_pt_250k = $this->model_historis_jembatan_pt_250k->store($save_data);

			if ($save_historis_jembatan_pt_250k) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_jembatan_pt_250k;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_jembatan_pt_250k/edit/' . $save_historis_jembatan_pt_250k, 'Edit Historis Jembatan Pt 250k'),
						anchor('administrator/historis_jembatan_pt_250k', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_jembatan_pt_250k/edit/' . $save_historis_jembatan_pt_250k, 'Edit Historis Jembatan Pt 250k')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_jembatan_pt_250k');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_jembatan_pt_250k');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Jembatan Pt 250ks
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_jembatan_pt_250k_update');

		$this->data['historis_jembatan_pt_250k'] = $this->model_historis_jembatan_pt_250k->find($id);

		$this->template->title('Historis Jembatan Pt 250k Update');
		$this->render('backend/standart/administrator/historis_jembatan_pt_250k/historis_jembatan_pt_250k_update', $this->data);
	}

	/**
	* Update Historis Jembatan Pt 250ks
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_jembatan_pt_250k_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_historis_jembatan_pt_250k' => $this->input->post('kode_historis_jembatan_pt_250k'),
				'jembatan_pt_250k_id' => $this->input->post('jembatan_pt_250k_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
			];

			
			$save_historis_jembatan_pt_250k = $this->model_historis_jembatan_pt_250k->change($id, $save_data);

			if ($save_historis_jembatan_pt_250k) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_jembatan_pt_250k', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_jembatan_pt_250k');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_jembatan_pt_250k');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Jembatan Pt 250ks
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_jembatan_pt_250k_delete');

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
            set_message(cclang('has_been_deleted', 'historis_jembatan_pt_250k'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_jembatan_pt_250k'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Jembatan Pt 250ks
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_jembatan_pt_250k_view');

		$this->data['historis_jembatan_pt_250k'] = $this->model_historis_jembatan_pt_250k->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Jembatan Pt 250k Detail');
		$this->render('backend/standart/administrator/historis_jembatan_pt_250k/historis_jembatan_pt_250k_view', $this->data);
	}
	
	/**
	* delete Historis Jembatan Pt 250ks
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_jembatan_pt_250k = $this->model_historis_jembatan_pt_250k->find($id);

		
		
		return $this->model_historis_jembatan_pt_250k->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_jembatan_pt_250k_export');

		$this->model_historis_jembatan_pt_250k->export('historis_jembatan_pt_250k', 'historis_jembatan_pt_250k');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_jembatan_pt_250k_export');

		$this->model_historis_jembatan_pt_250k->pdf('historis_jembatan_pt_250k', 'historis_jembatan_pt_250k');
	}
}


/* End of file historis_jembatan_pt_250k.php */
/* Location: ./application/controllers/administrator/Historis Jembatan Pt 250k.php */