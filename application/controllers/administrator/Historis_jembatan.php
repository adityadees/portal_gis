<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Jembatan Controller
*| --------------------------------------------------------------------------
*| Historis Jembatan site
*|
*/
class Historis_jembatan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_jembatan');
	}

	/**
	* show all Historis Jembatans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_jembatan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_jembatans'] = $this->model_historis_jembatan->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_jembatan_counts'] = $this->model_historis_jembatan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_jembatan/index/',
			'total_rows'   => $this->model_historis_jembatan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Jembatan List');
		$this->render('backend/standart/administrator/historis_jembatan/historis_jembatan_list', $this->data);
	}
	
	/**
	* Add new historis_jembatans
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_jembatan_add');

		$this->template->title('Historis Jembatan New');
		$this->render('backend/standart/administrator/historis_jembatan/historis_jembatan_add', $this->data);
	}

	/**
	* Add New Historis Jembatans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_jembatan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('jembatan_pt_250k_id', 'Nama Jembatan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Volume Efektif', 'trim|required');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required|max_length[4]');
		$this->form_validation->set_rules('historis_namakeg', 'Nama Kegiatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Volume Penanganan', 'trim|required');
		$this->form_validation->set_rules('historis_sdana', 'Sumber Dana', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		$this->form_validation->set_rules('maplinks_id', 'Maplinks Id', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jembatan_pt_250k_id' => $this->input->post('jembatan_pt_250k_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'maplinks_id' => $this->input->post('maplinks_id'),
			];

			
			$save_historis_jembatan = $this->model_historis_jembatan->store($save_data);

			if ($save_historis_jembatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_jembatan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_jembatan/edit/' . $save_historis_jembatan, 'Edit Historis Jembatan'),
						anchor('administrator/historis_jembatan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_jembatan/edit/' . $save_historis_jembatan, 'Edit Historis Jembatan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_jembatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_jembatan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Jembatans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_jembatan_update');

		$this->data['historis_jembatan'] = $this->model_historis_jembatan->find($id);

		$this->template->title('Historis Jembatan Update');
		$this->render('backend/standart/administrator/historis_jembatan/historis_jembatan_update', $this->data);
	}

	/**
	* Update Historis Jembatans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_jembatan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jembatan_pt_250k_id', 'Nama Jembatan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Volume Efektif', 'trim|required');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required|max_length[4]');
		$this->form_validation->set_rules('historis_namakeg', 'Nama Kegiatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Volume Penanganan', 'trim|required');
		$this->form_validation->set_rules('historis_sdana', 'Sumber Dana', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		$this->form_validation->set_rules('maplinks_id', 'Maplinks Id', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jembatan_pt_250k_id' => $this->input->post('jembatan_pt_250k_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'maplinks_id' => $this->input->post('maplinks_id'),
			];

			
			$save_historis_jembatan = $this->model_historis_jembatan->change($id, $save_data);

			if ($save_historis_jembatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_jembatan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_jembatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_jembatan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Jembatans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_jembatan_delete');

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
            set_message(cclang('has_been_deleted', 'historis_jembatan'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_jembatan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Jembatans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_jembatan_view');

		$this->data['historis_jembatan'] = $this->model_historis_jembatan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Jembatan Detail');
		$this->render('backend/standart/administrator/historis_jembatan/historis_jembatan_view', $this->data);
	}
	
	/**
	* delete Historis Jembatans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_jembatan = $this->model_historis_jembatan->find($id);

		
		
		return $this->model_historis_jembatan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_jembatan_export');

		$this->model_historis_jembatan->export('historis_jembatan', 'historis_jembatan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_jembatan_export');

		$this->model_historis_jembatan->pdf('historis_jembatan', 'historis_jembatan');
	}
}


/* End of file historis_jembatan.php */
/* Location: ./application/controllers/administrator/Historis Jembatan.php */