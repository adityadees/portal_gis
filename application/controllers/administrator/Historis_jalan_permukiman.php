<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Jalan Permukiman Controller
*| --------------------------------------------------------------------------
*| Historis Jalan Permukiman site
*|
*/
class Historis_jalan_permukiman extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_jalan_permukiman');
	}

	/**
	* show all Historis Jalan Permukimans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_jalan_permukiman_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_jalan_permukimans'] = $this->model_historis_jalan_permukiman->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_jalan_permukiman_counts'] = $this->model_historis_jalan_permukiman->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_jalan_permukiman/index/',
			'total_rows'   => $this->model_historis_jalan_permukiman->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Jalan Permukiman List');
		$this->render('backend/standart/administrator/historis_jalan_permukiman/historis_jalan_permukiman_list', $this->data);
	}
	
	/**
	* Add new historis_jalan_permukimans
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_jalan_permukiman_add');

		$this->template->title('Historis Jalan Permukiman New');
		$this->render('backend/standart/administrator/historis_jalan_permukiman/historis_jalan_permukiman_add', $this->data);
	}

	/**
	* Add New Historis Jalan Permukimans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_jalan_permukiman_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('jalan_id', 'Nama Daerah', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Volume Efektif', 'trim|required');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required|max_length[4]');
		$this->form_validation->set_rules('historis_namakeg', 'Nama Kegiatan', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('historis_sta', 'Historis Sta', 'trim|max_length[50]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Historis Penanganan', 'trim|required');
		$this->form_validation->set_rules('historis_sdana', 'Sumber Dana', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jalan_id' => $this->input->post('jalan_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_sta' => $this->input->post('historis_sta'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
			];

			
			$save_historis_jalan_permukiman = $this->model_historis_jalan_permukiman->store($save_data);

			if ($save_historis_jalan_permukiman) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_jalan_permukiman;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_jalan_permukiman/edit/' . $save_historis_jalan_permukiman, 'Edit Historis Jalan Permukiman'),
						anchor('administrator/historis_jalan_permukiman', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_jalan_permukiman/edit/' . $save_historis_jalan_permukiman, 'Edit Historis Jalan Permukiman')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_jalan_permukiman');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_jalan_permukiman');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Jalan Permukimans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_jalan_permukiman_update');

		$this->data['historis_jalan_permukiman'] = $this->model_historis_jalan_permukiman->find($id);

		$this->template->title('Historis Jalan Permukiman Update');
		$this->render('backend/standart/administrator/historis_jalan_permukiman/historis_jalan_permukiman_update', $this->data);
	}

	/**
	* Update Historis Jalan Permukimans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_jalan_permukiman_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jalan_id', 'Nama Daerah', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Volume Efektif', 'trim|required');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required|max_length[4]');
		$this->form_validation->set_rules('historis_namakeg', 'Nama Kegiatan', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('historis_sta', 'Historis Sta', 'trim|max_length[50]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Historis Penanganan', 'trim|required');
		$this->form_validation->set_rules('historis_sdana', 'Sumber Dana', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jalan_id' => $this->input->post('jalan_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_sta' => $this->input->post('historis_sta'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
			];

			
			$save_historis_jalan_permukiman = $this->model_historis_jalan_permukiman->change($id, $save_data);

			if ($save_historis_jalan_permukiman) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_jalan_permukiman', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_jalan_permukiman');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_jalan_permukiman');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Jalan Permukimans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_jalan_permukiman_delete');

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
            set_message(cclang('has_been_deleted', 'historis_jalan_permukiman'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_jalan_permukiman'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Jalan Permukimans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_jalan_permukiman_view');

		$this->data['historis_jalan_permukiman'] = $this->model_historis_jalan_permukiman->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Jalan Permukiman Detail');
		$this->render('backend/standart/administrator/historis_jalan_permukiman/historis_jalan_permukiman_view', $this->data);
	}
	
	/**
	* delete Historis Jalan Permukimans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_jalan_permukiman = $this->model_historis_jalan_permukiman->find($id);

		
		
		return $this->model_historis_jalan_permukiman->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_jalan_permukiman_export');

		$this->model_historis_jalan_permukiman->export('historis_jalan_permukiman', 'historis_jalan_permukiman');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_jalan_permukiman_export');

		$this->model_historis_jalan_permukiman->pdf('historis_jalan_permukiman', 'historis_jalan_permukiman');
	}
}


/* End of file historis_jalan_permukiman.php */
/* Location: ./application/controllers/administrator/Historis Jalan Permukiman.php */