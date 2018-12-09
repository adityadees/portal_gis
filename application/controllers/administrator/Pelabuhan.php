<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pelabuhan Controller
*| --------------------------------------------------------------------------
*| Pelabuhan site
*|
*/
class Pelabuhan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pelabuhan');
	}

	/**
	* show all Pelabuhans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pelabuhan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pelabuhans'] = $this->model_pelabuhan->get($filter, $field, $this->limit_page, $offset);
		$this->data['pelabuhan_counts'] = $this->model_pelabuhan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pelabuhan/index/',
			'total_rows'   => $this->model_pelabuhan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pelabuhan List');
		$this->render('backend/standart/administrator/pelabuhan/pelabuhan_list', $this->data);
	}
	
	/**
	* Add new pelabuhans
	*
	*/
	public function add()
	{
		$this->is_allowed('pelabuhan_add');

		$this->template->title('Pelabuhan New');
		$this->render('backend/standart/administrator/pelabuhan/pelabuhan_add', $this->data);
	}

	/**
	* Add New Pelabuhans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('pelabuhan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('pelabuhan_id', 'Pelabuhan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_termi', 'Nama Termi', 'trim|required');
		$this->form_validation->set_rules('klasifikasi', 'Klasifikasi', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'pelabuhan_id' => $this->input->post('pelabuhan_id'),
				'nama_termi' => $this->input->post('nama_termi'),
				'klasifikasi' => $this->input->post('klasifikasi'),
				'pelabuhan_dtampung' => $this->input->post('pelabuhan_dtampung'),
			];

			
			$save_pelabuhan = $this->model_pelabuhan->store($save_data);

			if ($save_pelabuhan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pelabuhan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pelabuhan/edit/' . $save_pelabuhan, 'Edit Pelabuhan'),
						anchor('administrator/pelabuhan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pelabuhan/edit/' . $save_pelabuhan, 'Edit Pelabuhan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pelabuhan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pelabuhan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pelabuhans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pelabuhan_update');

		$this->data['pelabuhan'] = $this->model_pelabuhan->find($id);

		$this->template->title('Pelabuhan Update');
		$this->render('backend/standart/administrator/pelabuhan/pelabuhan_update', $this->data);
	}

	/**
	* Update Pelabuhans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pelabuhan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('pelabuhan_id', 'Pelabuhan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_termi', 'Nama Termi', 'trim|required');
		$this->form_validation->set_rules('klasifikasi', 'Klasifikasi', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'pelabuhan_id' => $this->input->post('pelabuhan_id'),
				'nama_termi' => $this->input->post('nama_termi'),
				'klasifikasi' => $this->input->post('klasifikasi'),
				'pelabuhan_dtampung' => $this->input->post('pelabuhan_dtampung'),
			];

			
			$save_pelabuhan = $this->model_pelabuhan->change($id, $save_data);

			if ($save_pelabuhan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pelabuhan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pelabuhan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pelabuhan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pelabuhans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pelabuhan_delete');

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
            set_message(cclang('has_been_deleted', 'pelabuhan'), 'success');
        } else {
            set_message(cclang('error_delete', 'pelabuhan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pelabuhans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pelabuhan_view');

		$this->data['pelabuhan'] = $this->model_pelabuhan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Pelabuhan Detail');
		$this->render('backend/standart/administrator/pelabuhan/pelabuhan_view', $this->data);
	}
	
	/**
	* delete Pelabuhans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$pelabuhan = $this->model_pelabuhan->find($id);

		
		
		return $this->model_pelabuhan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pelabuhan_export');

		$this->model_pelabuhan->export('pelabuhan', 'pelabuhan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pelabuhan_export');

		$this->model_pelabuhan->pdf('pelabuhan', 'pelabuhan');
	}
}


/* End of file pelabuhan.php */
/* Location: ./application/controllers/administrator/Pelabuhan.php */