<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Jalan Provinsi Controller
*| --------------------------------------------------------------------------
*| Historis Jalan Provinsi site
*|
*/
class Historis_jalan_provinsi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_jalan_provinsi');
	}

	/**
	* show all Historis Jalan Provinsis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_jalan_provinsi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_jalan_provinsis'] = $this->model_historis_jalan_provinsi->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_jalan_provinsi_counts'] = $this->model_historis_jalan_provinsi->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_jalan_provinsi/index/',
			'total_rows'   => $this->model_historis_jalan_provinsi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Jalan Provinsi List');
		$this->render('backend/standart/administrator/historis_jalan_provinsi/historis_jalan_provinsi_list', $this->data);
	}
	
	/**
	* Add new historis_jalan_provinsis
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_jalan_provinsi_add');

		$this->template->title('Historis Jalan Provinsi New');
		$this->render('backend/standart/administrator/historis_jalan_provinsi/historis_jalan_provinsi_add', $this->data);
	}

	/**
	* Add New Historis Jalan Provinsis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_jalan_provinsi_add', false)) {
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

			
			$save_historis_jalan_provinsi = $this->model_historis_jalan_provinsi->store($save_data);

			if ($save_historis_jalan_provinsi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_jalan_provinsi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_jalan_provinsi/edit/' . $save_historis_jalan_provinsi, 'Edit Historis Jalan Provinsi'),
						anchor('administrator/historis_jalan_provinsi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_jalan_provinsi/edit/' . $save_historis_jalan_provinsi, 'Edit Historis Jalan Provinsi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_jalan_provinsi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_jalan_provinsi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Jalan Provinsis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_jalan_provinsi_update');

		$this->data['historis_jalan_provinsi'] = $this->model_historis_jalan_provinsi->find($id);

		$this->template->title('Historis Jalan Provinsi Update');
		$this->render('backend/standart/administrator/historis_jalan_provinsi/historis_jalan_provinsi_update', $this->data);
	}

	/**
	* Update Historis Jalan Provinsis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_jalan_provinsi_update', false)) {
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

			
			$save_historis_jalan_provinsi = $this->model_historis_jalan_provinsi->change($id, $save_data);

			if ($save_historis_jalan_provinsi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_jalan_provinsi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_jalan_provinsi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_jalan_provinsi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Jalan Provinsis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_jalan_provinsi_delete');

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
            set_message(cclang('has_been_deleted', 'historis_jalan_provinsi'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_jalan_provinsi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Jalan Provinsis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_jalan_provinsi_view');

		$this->data['historis_jalan_provinsi'] = $this->model_historis_jalan_provinsi->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Jalan Provinsi Detail');
		$this->render('backend/standart/administrator/historis_jalan_provinsi/historis_jalan_provinsi_view', $this->data);
	}
	
	/**
	* delete Historis Jalan Provinsis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_jalan_provinsi = $this->model_historis_jalan_provinsi->find($id);

		
		
		return $this->model_historis_jalan_provinsi->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_jalan_provinsi_export');

		$this->model_historis_jalan_provinsi->export('historis_jalan_provinsi', 'historis_jalan_provinsi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_jalan_provinsi_export');

		$this->model_historis_jalan_provinsi->pdf('historis_jalan_provinsi', 'historis_jalan_provinsi');
	}
}


/* End of file historis_jalan_provinsi.php */
/* Location: ./application/controllers/administrator/Historis Jalan Provinsi.php */