<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Stasiun Controller
*| --------------------------------------------------------------------------
*| Historis Stasiun site
*|
*/
class Historis_stasiun extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_stasiun');
	}

	/**
	* show all Historis Stasiuns
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_stasiun_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_stasiuns'] = $this->model_historis_stasiun->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_stasiun_counts'] = $this->model_historis_stasiun->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_stasiun/index/',
			'total_rows'   => $this->model_historis_stasiun->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Stasiun List');
		$this->render('backend/standart/administrator/historis_stasiun/historis_stasiun_list', $this->data);
	}
	
	/**
	* Add new historis_stasiuns
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_stasiun_add');

		$this->template->title('Historis Stasiun New');
		$this->render('backend/standart/administrator/historis_stasiun/historis_stasiun_add', $this->data);
	}

	/**
	* Add New Historis Stasiuns
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_stasiun_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('stasiun_id', 'Nama Stasiun', 'trim|required');
		$this->form_validation->set_rules('historis_vefektif', 'Volume Efektif', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required');
		$this->form_validation->set_rules('historis_namakeg', 'Nama Kegiatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Volume Penanganan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_sdana', 'Sumber Dana', 'trim|required');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'stasiun_id' => $this->input->post('stasiun_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
			];

			
			$save_historis_stasiun = $this->model_historis_stasiun->store($save_data);

			if ($save_historis_stasiun) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_stasiun;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_stasiun/edit/' . $save_historis_stasiun, 'Edit Historis Stasiun'),
						anchor('administrator/historis_stasiun', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_stasiun/edit/' . $save_historis_stasiun, 'Edit Historis Stasiun')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_stasiun');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_stasiun');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Stasiuns
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_stasiun_update');

		$this->data['historis_stasiun'] = $this->model_historis_stasiun->find($id);

		$this->template->title('Historis Stasiun Update');
		$this->render('backend/standart/administrator/historis_stasiun/historis_stasiun_update', $this->data);
	}

	/**
	* Update Historis Stasiuns
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_stasiun_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('stasiun_id', 'Nama Stasiun', 'trim|required');
		$this->form_validation->set_rules('historis_vefektif', 'Volume Efektif', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required');
		$this->form_validation->set_rules('historis_namakeg', 'Nama Kegiatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Volume Penanganan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_sdana', 'Sumber Dana', 'trim|required');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'stasiun_id' => $this->input->post('stasiun_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
			];

			
			$save_historis_stasiun = $this->model_historis_stasiun->change($id, $save_data);

			if ($save_historis_stasiun) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_stasiun', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_stasiun');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_stasiun');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Stasiuns
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_stasiun_delete');

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
            set_message(cclang('has_been_deleted', 'historis_stasiun'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_stasiun'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Stasiuns
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_stasiun_view');

		$this->data['historis_stasiun'] = $this->model_historis_stasiun->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Stasiun Detail');
		$this->render('backend/standart/administrator/historis_stasiun/historis_stasiun_view', $this->data);
	}
	
	/**
	* delete Historis Stasiuns
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_stasiun = $this->model_historis_stasiun->find($id);

		
		
		return $this->model_historis_stasiun->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_stasiun_export');

		$this->model_historis_stasiun->export('historis_stasiun', 'historis_stasiun');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_stasiun_export');

		$this->model_historis_stasiun->pdf('historis_stasiun', 'historis_stasiun');
	}
}


/* End of file historis_stasiun.php */
/* Location: ./application/controllers/administrator/Historis Stasiun.php */