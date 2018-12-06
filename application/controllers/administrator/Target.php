<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Target Controller
*| --------------------------------------------------------------------------
*| Target site
*|
*/
class Target extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_target');
	}

	/**
	* show all Targets
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('target_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['targets'] = $this->model_target->get($filter, $field, $this->limit_page, $offset);
		$this->data['target_counts'] = $this->model_target->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/target/index/',
			'total_rows'   => $this->model_target->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Target List');
		$this->render('backend/standart/administrator/target/target_list', $this->data);
	}
	
	/**
	* Add new targets
	*
	*/
	public function add()
	{
		$this->is_allowed('target_add');

		$this->template->title('Target New');
		$this->render('backend/standart/administrator/target/target_add', $this->data);
	}

	/**
	* Add New Targets
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('target_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('maplink_id', 'Maplink Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('target_data_id', 'Target Data Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('target_tahun', 'Target Tahun', 'trim|required|max_length[4]');
		$this->form_validation->set_rules('target_volume', 'Target Volume', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'maplink_id' => $this->input->post('maplink_id'),
				'target_data_id' => $this->input->post('target_data_id'),
				'target_tahun' => $this->input->post('target_tahun'),
				'target_volume' => $this->input->post('target_volume'),
			];

			
			$save_target = $this->model_target->store($save_data);

			if ($save_target) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_target;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/target/edit/' . $save_target, 'Edit Target'),
						anchor('administrator/target', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/target/edit/' . $save_target, 'Edit Target')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Targets
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('target_update');

		$this->data['target'] = $this->model_target->find($id);

		$this->template->title('Target Update');
		$this->render('backend/standart/administrator/target/target_update', $this->data);
	}

	/**
	* Update Targets
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('target_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('maplink_id', 'Maplink Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('target_data_id', 'Target Data Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('target_tahun', 'Target Tahun', 'trim|required|max_length[4]');
		$this->form_validation->set_rules('target_volume', 'Target Volume', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'maplink_id' => $this->input->post('maplink_id'),
				'target_data_id' => $this->input->post('target_data_id'),
				'target_tahun' => $this->input->post('target_tahun'),
				'target_volume' => $this->input->post('target_volume'),
			];

			
			$save_target = $this->model_target->change($id, $save_data);

			if ($save_target) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/target', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Targets
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('target_delete');

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
            set_message(cclang('has_been_deleted', 'target'), 'success');
        } else {
            set_message(cclang('error_delete', 'target'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Targets
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('target_view');

		$this->data['target'] = $this->model_target->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Target Detail');
		$this->render('backend/standart/administrator/target/target_view', $this->data);
	}
	
	/**
	* delete Targets
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$target = $this->model_target->find($id);

		
		
		return $this->model_target->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('target_export');

		$this->model_target->export('target', 'target');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('target_export');

		$this->model_target->pdf('target', 'target');
	}
}


/* End of file target.php */
/* Location: ./application/controllers/administrator/Target.php */