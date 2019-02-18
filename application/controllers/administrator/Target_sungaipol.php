<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Target Sungaipol Controller
*| --------------------------------------------------------------------------
*| Target Sungaipol site
*|
*/
class Target_sungaipol extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_target_sungaipol');
	}

	/**
	* show all Target Sungaipols
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('target_sungaipol_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['target_sungaipols'] = $this->model_target_sungaipol->get($filter, $field, $this->limit_page, $offset);
		$this->data['target_sungaipol_counts'] = $this->model_target_sungaipol->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/target_sungaipol/index/',
			'total_rows'   => $this->model_target_sungaipol->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Target Sungaipol List');
		$this->render('backend/standart/administrator/target_sungaipol/target_sungaipol_list', $this->data);
	}
	
	/**
	* Add new target_sungaipols
	*
	*/
	public function add()
	{
		$this->is_allowed('target_sungaipol_add');

		$this->template->title('Target Sungaipol New');
		$this->render('backend/standart/administrator/target_sungaipol/target_sungaipol_add', $this->data);
	}

	/**
	* Add New Target Sungaipols
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('target_sungaipol_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('target_data_id', 'Nama Sungai Pol', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('target_tahun', 'Target Tahun', 'trim|required|max_length[4]');
		$this->form_validation->set_rules('target_volume', 'Target Volume', 'trim|required');
		$this->form_validation->set_rules('target_satuan', 'Satuan', 'trim|required|max_length[25]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'target_data_id' => $this->input->post('target_data_id'),
				'target_tahun' => $this->input->post('target_tahun'),
				'target_volume' => $this->input->post('target_volume'),
				'target_satuan' => $this->input->post('target_satuan'),
			];

			
			$save_target_sungaipol = $this->model_target_sungaipol->store($save_data);

			if ($save_target_sungaipol) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_target_sungaipol;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/target_sungaipol/edit/' . $save_target_sungaipol, 'Edit Target Sungaipol'),
						anchor('administrator/target_sungaipol', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/target_sungaipol/edit/' . $save_target_sungaipol, 'Edit Target Sungaipol')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_sungaipol');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_sungaipol');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Target Sungaipols
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('target_sungaipol_update');

		$this->data['target_sungaipol'] = $this->model_target_sungaipol->find($id);

		$this->template->title('Target Sungaipol Update');
		$this->render('backend/standart/administrator/target_sungaipol/target_sungaipol_update', $this->data);
	}

	/**
	* Update Target Sungaipols
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('target_sungaipol_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('target_data_id', 'Nama Sungai Pol', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('target_tahun', 'Target Tahun', 'trim|required|max_length[4]');
		$this->form_validation->set_rules('target_volume', 'Target Volume', 'trim|required');
		$this->form_validation->set_rules('target_satuan', 'Satuan', 'trim|required|max_length[25]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'target_data_id' => $this->input->post('target_data_id'),
				'target_tahun' => $this->input->post('target_tahun'),
				'target_volume' => $this->input->post('target_volume'),
				'target_satuan' => $this->input->post('target_satuan'),
			];

			
			$save_target_sungaipol = $this->model_target_sungaipol->change($id, $save_data);

			if ($save_target_sungaipol) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/target_sungaipol', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_sungaipol');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_sungaipol');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Target Sungaipols
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('target_sungaipol_delete');

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
            set_message(cclang('has_been_deleted', 'target_sungaipol'), 'success');
        } else {
            set_message(cclang('error_delete', 'target_sungaipol'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Target Sungaipols
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('target_sungaipol_view');

		$this->data['target_sungaipol'] = $this->model_target_sungaipol->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Target Sungaipol Detail');
		$this->render('backend/standart/administrator/target_sungaipol/target_sungaipol_view', $this->data);
	}
	
	/**
	* delete Target Sungaipols
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$target_sungaipol = $this->model_target_sungaipol->find($id);

		
		
		return $this->model_target_sungaipol->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('target_sungaipol_export');

		$this->model_target_sungaipol->export('target_sungaipol', 'target_sungaipol');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('target_sungaipol_export');

		$this->model_target_sungaipol->pdf('target_sungaipol', 'target_sungaipol');
	}
}


/* End of file target_sungaipol.php */
/* Location: ./application/controllers/administrator/Target Sungaipol.php */