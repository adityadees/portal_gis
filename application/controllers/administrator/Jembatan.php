<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jembatan Controller
*| --------------------------------------------------------------------------
*| Jembatan site
*|
*/
class Jembatan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jembatan');
	}

	/**
	* show all Jembatans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jembatan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jembatans'] = $this->model_jembatan->get($filter, $field, $this->limit_page, $offset);
		$this->data['jembatan_counts'] = $this->model_jembatan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/jembatan/index/',
			'total_rows'   => $this->model_jembatan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jembatan List');
		$this->render('backend/standart/administrator/jembatan/jembatan_list', $this->data);
	}
	
	/**
	* Add new jembatans
	*
	*/
	public function add()
	{
		$this->is_allowed('jembatan_add');

		$this->template->title('Jembatan New');
		$this->render('backend/standart/administrator/jembatan/jembatan_add', $this->data);
	}

	/**
	* Add New Jembatans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jembatan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('jembatan_id', 'Jembatan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('field1', 'Field1', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field2', 'Field2', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field3', 'Field3', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field4', 'Field4', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field5', 'Nama Jembatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field6', 'Field6', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field7', 'Field7', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field8', 'Field8', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field9', 'Field9', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field10', 'Field10', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field11', 'Field11', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field12', 'Field12', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field13', 'Field13', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field14', 'Field14', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field15', 'Field15', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field16', 'Field16', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field17', 'Field17', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field18', 'Field18', 'trim|required|max_length[100]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jembatan_id' => $this->input->post('jembatan_id'),
				'field1' => $this->input->post('field1'),
				'field2' => $this->input->post('field2'),
				'field3' => $this->input->post('field3'),
				'field4' => $this->input->post('field4'),
				'field5' => $this->input->post('field5'),
				'field6' => $this->input->post('field6'),
				'field7' => $this->input->post('field7'),
				'field8' => $this->input->post('field8'),
				'field9' => $this->input->post('field9'),
				'field10' => $this->input->post('field10'),
				'field11' => $this->input->post('field11'),
				'field12' => $this->input->post('field12'),
				'field13' => $this->input->post('field13'),
				'field14' => $this->input->post('field14'),
				'field15' => $this->input->post('field15'),
				'field16' => $this->input->post('field16'),
				'field17' => $this->input->post('field17'),
				'field18' => $this->input->post('field18'),
			];

			
			$save_jembatan = $this->model_jembatan->store($save_data);

			if ($save_jembatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jembatan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/jembatan/edit/' . $save_jembatan, 'Edit Jembatan'),
						anchor('administrator/jembatan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/jembatan/edit/' . $save_jembatan, 'Edit Jembatan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jembatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jembatan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jembatans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jembatan_update');

		$this->data['jembatan'] = $this->model_jembatan->find($id);

		$this->template->title('Jembatan Update');
		$this->render('backend/standart/administrator/jembatan/jembatan_update', $this->data);
	}

	/**
	* Update Jembatans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jembatan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jembatan_id', 'Jembatan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('field1', 'Field1', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field2', 'Field2', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field3', 'Field3', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field4', 'Field4', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field5', 'Nama Jembatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field6', 'Field6', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field7', 'Field7', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field8', 'Field8', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field9', 'Field9', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field10', 'Field10', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field11', 'Field11', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field12', 'Field12', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field13', 'Field13', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field14', 'Field14', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field15', 'Field15', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field16', 'Field16', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field17', 'Field17', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('field18', 'Field18', 'trim|required|max_length[100]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jembatan_id' => $this->input->post('jembatan_id'),
				'field1' => $this->input->post('field1'),
				'field2' => $this->input->post('field2'),
				'field3' => $this->input->post('field3'),
				'field4' => $this->input->post('field4'),
				'field5' => $this->input->post('field5'),
				'field6' => $this->input->post('field6'),
				'field7' => $this->input->post('field7'),
				'field8' => $this->input->post('field8'),
				'field9' => $this->input->post('field9'),
				'field10' => $this->input->post('field10'),
				'field11' => $this->input->post('field11'),
				'field12' => $this->input->post('field12'),
				'field13' => $this->input->post('field13'),
				'field14' => $this->input->post('field14'),
				'field15' => $this->input->post('field15'),
				'field16' => $this->input->post('field16'),
				'field17' => $this->input->post('field17'),
				'field18' => $this->input->post('field18'),
			];

			
			$save_jembatan = $this->model_jembatan->change($id, $save_data);

			if ($save_jembatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/jembatan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jembatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jembatan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jembatans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('jembatan_delete');

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
            set_message(cclang('has_been_deleted', 'jembatan'), 'success');
        } else {
            set_message(cclang('error_delete', 'jembatan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Jembatans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jembatan_view');

		$this->data['jembatan'] = $this->model_jembatan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Jembatan Detail');
		$this->render('backend/standart/administrator/jembatan/jembatan_view', $this->data);
	}
	
	/**
	* delete Jembatans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jembatan = $this->model_jembatan->find($id);

		
		
		return $this->model_jembatan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jembatan_export');

		$this->model_jembatan->export('jembatan', 'jembatan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jembatan_export');

		$this->model_jembatan->pdf('jembatan', 'jembatan');
	}
}


/* End of file jembatan.php */
/* Location: ./application/controllers/administrator/Jembatan.php */