<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Districts Controller
*| --------------------------------------------------------------------------
*| Districts site
*|
*/
class Districts extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_districts');
	}

	/**
	* show all Districtss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('districts_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['districtss'] = $this->model_districts->get($filter, $field, $this->limit_page, $offset);
		$this->data['districts_counts'] = $this->model_districts->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/districts/index/',
			'total_rows'   => $this->model_districts->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Districts List');
		$this->render('backend/standart/administrator/districts/districts_list', $this->data);
	}
	
	/**
	* Add new districtss
	*
	*/
	public function add()
	{
		$this->is_allowed('districts_add');

		$this->template->title('Districts New');
		$this->render('backend/standart/administrator/districts/districts_add', $this->data);
	}

	/**
	* Add New Districtss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('districts_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'id' => $this->input->post('id'),
				'regency_id' => $this->input->post('regency_id'),
				'name' => $this->input->post('name'),
			];

			
			$save_districts = $this->model_districts->store($save_data);

			if ($save_districts) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_districts;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/districts/edit/' . $save_districts, 'Edit Districts'),
						anchor('administrator/districts', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/districts/edit/' . $save_districts, 'Edit Districts')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/districts');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/districts');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Districtss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('districts_update');

		$this->data['districts'] = $this->model_districts->find($id);

		$this->template->title('Districts Update');
		$this->render('backend/standart/administrator/districts/districts_update', $this->data);
	}

	/**
	* Update Districtss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('districts_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'id' => $this->input->post('id'),
				'regency_id' => $this->input->post('regency_id'),
				'name' => $this->input->post('name'),
			];

			
			$save_districts = $this->model_districts->change($id, $save_data);

			if ($save_districts) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/districts', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/districts');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/districts');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Districtss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('districts_delete');

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
            set_message(cclang('has_been_deleted', 'districts'), 'success');
        } else {
            set_message(cclang('error_delete', 'districts'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Districtss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('districts_view');

		$this->data['districts'] = $this->model_districts->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Districts Detail');
		$this->render('backend/standart/administrator/districts/districts_view', $this->data);
	}
	
	/**
	* delete Districtss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$districts = $this->model_districts->find($id);

		
		
		return $this->model_districts->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('districts_export');

		$this->model_districts->export('districts', 'districts');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('districts_export');

		$this->model_districts->pdf('districts', 'districts');
	}
}


/* End of file districts.php */
/* Location: ./application/controllers/administrator/Districts.php */