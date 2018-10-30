<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Air Bersih Controller
*| --------------------------------------------------------------------------
*| Historis Air Bersih site
*|
*/
class Historis_air_bersih extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_air_bersih');
	}

	/**
	* show all Historis Air Bersihs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_air_bersih_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_air_bersihs'] = $this->model_historis_air_bersih->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_air_bersih_counts'] = $this->model_historis_air_bersih->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_air_bersih/index/',
			'total_rows'   => $this->model_historis_air_bersih->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Air Bersih List');
		$this->render('backend/standart/administrator/historis_air_bersih/historis_air_bersih_list', $this->data);
	}
	
	/**
	* Add new historis_air_bersihs
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_air_bersih_add');

		$this->template->title('Historis Air Bersih New');
		$this->render('backend/standart/administrator/historis_air_bersih/historis_air_bersih_add', $this->data);
	}

	/**
	* Add New Historis Air Bersihs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_air_bersih_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('air_bersih_id', 'Air Bersih Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Historis Vefektif', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Historis Volume Penanganan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_sdana', 'Historis Sumber Dana', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'air_bersih_id' => $this->input->post('air_bersih_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
			];

			
			$save_historis_air_bersih = $this->model_historis_air_bersih->store($save_data);

			if ($save_historis_air_bersih) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_air_bersih;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_air_bersih/edit/' . $save_historis_air_bersih, 'Edit Historis Air Bersih'),
						anchor('administrator/historis_air_bersih', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_air_bersih/edit/' . $save_historis_air_bersih, 'Edit Historis Air Bersih')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_air_bersih');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_air_bersih');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Air Bersihs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_air_bersih_update');

		$this->data['historis_air_bersih'] = $this->model_historis_air_bersih->find($id);

		$this->template->title('Historis Air Bersih Update');
		$this->render('backend/standart/administrator/historis_air_bersih/historis_air_bersih_update', $this->data);
	}

	/**
	* Update Historis Air Bersihs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_air_bersih_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('air_bersih_id', 'Air Bersih Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Historis Vefektif', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Historis Volume Penanganan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_sdana', 'Historis Sumber Dana', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'air_bersih_id' => $this->input->post('air_bersih_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
			];

			
			$save_historis_air_bersih = $this->model_historis_air_bersih->change($id, $save_data);

			if ($save_historis_air_bersih) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_air_bersih', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_air_bersih');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_air_bersih');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Air Bersihs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_air_bersih_delete');

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
            set_message(cclang('has_been_deleted', 'historis_air_bersih'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_air_bersih'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Air Bersihs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_air_bersih_view');

		$this->data['historis_air_bersih'] = $this->model_historis_air_bersih->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Air Bersih Detail');
		$this->render('backend/standart/administrator/historis_air_bersih/historis_air_bersih_view', $this->data);
	}
	
	/**
	* delete Historis Air Bersihs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_air_bersih = $this->model_historis_air_bersih->find($id);

		
		
		return $this->model_historis_air_bersih->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_air_bersih_export');

		$this->model_historis_air_bersih->export('historis_air_bersih', 'historis_air_bersih');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_air_bersih_export');

		$this->model_historis_air_bersih->pdf('historis_air_bersih', 'historis_air_bersih');
	}
}


/* End of file historis_air_bersih.php */
/* Location: ./application/controllers/administrator/Historis Air Bersih.php */