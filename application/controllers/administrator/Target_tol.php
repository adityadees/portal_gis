<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Target Tol Controller
*| --------------------------------------------------------------------------
*| Target Tol site
*|
*/
class Target_tol extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_target_tol');
	}

	/**
	* show all Target Tols
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('target_tol_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['target_tols'] = $this->model_target_tol->get($filter, $field, $this->limit_page, $offset);
		$this->data['target_tol_counts'] = $this->model_target_tol->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/target_tol/index/',
			'total_rows'   => $this->model_target_tol->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Target Tol List');
		$this->render('backend/standart/administrator/target_tol/target_tol_list', $this->data);
	}
	
	/**
	* Add new target_tols
	*
	*/
	public function add()
	{
		$this->is_allowed('target_tol_add');

		$this->template->title('Target Tol New');
		$this->render('backend/standart/administrator/target_tol/target_tol_add', $this->data);
	}

	/**
	* Add New Target Tols
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('target_tol_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('target_data_id', 'Nama Tol', 'trim|required|max_length[11]');
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

			
			$save_target_tol = $this->model_target_tol->store($save_data);

			if ($save_target_tol) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_target_tol;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/target_tol/edit/' . $save_target_tol, 'Edit Target Tol'),
						anchor('administrator/target_tol', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/target_tol/edit/' . $save_target_tol, 'Edit Target Tol')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_tol');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_tol');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Target Tols
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('target_tol_update');

		$this->data['target_tol'] = $this->model_target_tol->find($id);

		$this->template->title('Target Tol Update');
		$this->render('backend/standart/administrator/target_tol/target_tol_update', $this->data);
	}

	/**
	* Update Target Tols
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('target_tol_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('target_data_id', 'Nama Tol', 'trim|required|max_length[11]');
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

			
			$save_target_tol = $this->model_target_tol->change($id, $save_data);

			if ($save_target_tol) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/target_tol', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_tol');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_tol');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Target Tols
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('target_tol_delete');

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
            set_message(cclang('has_been_deleted', 'target_tol'), 'success');
        } else {
            set_message(cclang('error_delete', 'target_tol'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Target Tols
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('target_tol_view');

		$this->data['target_tol'] = $this->model_target_tol->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Target Tol Detail');
		$this->render('backend/standart/administrator/target_tol/target_tol_view', $this->data);
	}
	
	/**
	* delete Target Tols
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$target_tol = $this->model_target_tol->find($id);

		
		
		return $this->model_target_tol->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('target_tol_export');

		$this->model_target_tol->export('target_tol', 'target_tol');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('target_tol_export');

		$this->model_target_tol->pdf('target_tol', 'target_tol');
	}
}


/* End of file target_tol.php */
/* Location: ./application/controllers/administrator/Target Tol.php */