<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Target Pelabuhan Controller
*| --------------------------------------------------------------------------
*| Target Pelabuhan site
*|
*/
class Target_pelabuhan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_target_pelabuhan');
	}

	/**
	* show all Target Pelabuhans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('target_pelabuhan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['target_pelabuhans'] = $this->model_target_pelabuhan->get($filter, $field, $this->limit_page, $offset);
		$this->data['target_pelabuhan_counts'] = $this->model_target_pelabuhan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/target_pelabuhan/index/',
			'total_rows'   => $this->model_target_pelabuhan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Target Pelabuhan List');
		$this->render('backend/standart/administrator/target_pelabuhan/target_pelabuhan_list', $this->data);
	}
	
	/**
	* Add new target_pelabuhans
	*
	*/
	public function add()
	{
		$this->is_allowed('target_pelabuhan_add');

		$this->template->title('Target Pelabuhan New');
		$this->render('backend/standart/administrator/target_pelabuhan/target_pelabuhan_add', $this->data);
	}

	/**
	* Add New Target Pelabuhans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('target_pelabuhan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('target_data_id', 'Nama Pelabuhan', 'trim|required|max_length[11]');
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

			
			$save_target_pelabuhan = $this->model_target_pelabuhan->store($save_data);

			if ($save_target_pelabuhan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_target_pelabuhan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/target_pelabuhan/edit/' . $save_target_pelabuhan, 'Edit Target Pelabuhan'),
						anchor('administrator/target_pelabuhan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/target_pelabuhan/edit/' . $save_target_pelabuhan, 'Edit Target Pelabuhan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_pelabuhan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_pelabuhan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Target Pelabuhans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('target_pelabuhan_update');

		$this->data['target_pelabuhan'] = $this->model_target_pelabuhan->find($id);

		$this->template->title('Target Pelabuhan Update');
		$this->render('backend/standart/administrator/target_pelabuhan/target_pelabuhan_update', $this->data);
	}

	/**
	* Update Target Pelabuhans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('target_pelabuhan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('target_data_id', 'Nama Pelabuhan', 'trim|required|max_length[11]');
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

			
			$save_target_pelabuhan = $this->model_target_pelabuhan->change($id, $save_data);

			if ($save_target_pelabuhan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/target_pelabuhan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_pelabuhan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_pelabuhan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Target Pelabuhans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('target_pelabuhan_delete');

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
            set_message(cclang('has_been_deleted', 'target_pelabuhan'), 'success');
        } else {
            set_message(cclang('error_delete', 'target_pelabuhan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Target Pelabuhans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('target_pelabuhan_view');

		$this->data['target_pelabuhan'] = $this->model_target_pelabuhan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Target Pelabuhan Detail');
		$this->render('backend/standart/administrator/target_pelabuhan/target_pelabuhan_view', $this->data);
	}
	
	/**
	* delete Target Pelabuhans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$target_pelabuhan = $this->model_target_pelabuhan->find($id);

		
		
		return $this->model_target_pelabuhan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('target_pelabuhan_export');

		$this->model_target_pelabuhan->export('target_pelabuhan', 'target_pelabuhan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('target_pelabuhan_export');

		$this->model_target_pelabuhan->pdf('target_pelabuhan', 'target_pelabuhan');
	}
}


/* End of file target_pelabuhan.php */
/* Location: ./application/controllers/administrator/Target Pelabuhan.php */