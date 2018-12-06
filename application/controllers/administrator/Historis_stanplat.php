<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Stanplat Controller
*| --------------------------------------------------------------------------
*| Historis Stanplat site
*|
*/
class Historis_stanplat extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_stanplat');
	}

	/**
	* show all Historis Stanplats
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_stanplat_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_stanplats'] = $this->model_historis_stanplat->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_stanplat_counts'] = $this->model_historis_stanplat->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_stanplat/index/',
			'total_rows'   => $this->model_historis_stanplat->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Stanplat List');
		$this->render('backend/standart/administrator/historis_stanplat/historis_stanplat_list', $this->data);
	}
	
	/**
	* Add new historis_stanplats
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_stanplat_add');

		$this->template->title('Historis Stanplat New');
		$this->render('backend/standart/administrator/historis_stanplat/historis_stanplat_add', $this->data);
	}

	/**
	* Add New Historis Stanplats
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_stanplat_add', false)) {
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

			
			$save_historis_stanplat = $this->model_historis_stanplat->store($save_data);

			if ($save_historis_stanplat) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_stanplat;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_stanplat/edit/' . $save_historis_stanplat, 'Edit Historis Stanplat'),
						anchor('administrator/historis_stanplat', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_stanplat/edit/' . $save_historis_stanplat, 'Edit Historis Stanplat')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_stanplat');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_stanplat');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Stanplats
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_stanplat_update');

		$this->data['historis_stanplat'] = $this->model_historis_stanplat->find($id);

		$this->template->title('Historis Stanplat Update');
		$this->render('backend/standart/administrator/historis_stanplat/historis_stanplat_update', $this->data);
	}

	/**
	* Update Historis Stanplats
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_stanplat_update', false)) {
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

			
			$save_historis_stanplat = $this->model_historis_stanplat->change($id, $save_data);

			if ($save_historis_stanplat) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_stanplat', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_stanplat');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_stanplat');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Stanplats
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_stanplat_delete');

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
            set_message(cclang('has_been_deleted', 'historis_stanplat'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_stanplat'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Stanplats
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_stanplat_view');

		$this->data['historis_stanplat'] = $this->model_historis_stanplat->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Stanplat Detail');
		$this->render('backend/standart/administrator/historis_stanplat/historis_stanplat_view', $this->data);
	}
	
	/**
	* delete Historis Stanplats
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_stanplat = $this->model_historis_stanplat->find($id);

		
		
		return $this->model_historis_stanplat->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_stanplat_export');

		$this->model_historis_stanplat->export('historis_stanplat', 'historis_stanplat');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_stanplat_export');

		$this->model_historis_stanplat->pdf('historis_stanplat', 'historis_stanplat');
	}
}


/* End of file historis_stanplat.php */
/* Location: ./application/controllers/administrator/Historis Stanplat.php */