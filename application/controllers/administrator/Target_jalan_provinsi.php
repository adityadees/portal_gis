<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Target Jalan Provinsi Controller
*| --------------------------------------------------------------------------
*| Target Jalan Provinsi site
*|
*/
class Target_jalan_provinsi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_target_jalan_provinsi');
	}

	/**
	* show all Target Jalan Provinsis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('target_jalan_provinsi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['target_jalan_provinsis'] = $this->model_target_jalan_provinsi->get($filter, $field, $this->limit_page, $offset);
		$this->data['target_jalan_provinsi_counts'] = $this->model_target_jalan_provinsi->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/target_jalan_provinsi/index/',
			'total_rows'   => $this->model_target_jalan_provinsi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Target Jalan Provinsi List');
		$this->render('backend/standart/administrator/target_jalan_provinsi/target_jalan_provinsi_list', $this->data);
	}
	
	/**
	* Add new target_jalan_provinsis
	*
	*/
	public function add()
	{
		$this->is_allowed('target_jalan_provinsi_add');

		$this->template->title('Target Jalan Provinsi New');
		$this->render('backend/standart/administrator/target_jalan_provinsi/target_jalan_provinsi_add', $this->data);
	}

	/**
	* Add New Target Jalan Provinsis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('target_jalan_provinsi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('target_data_id', 'Nama Jalan', 'trim|required|max_length[11]');
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

			
			$save_target_jalan_provinsi = $this->model_target_jalan_provinsi->store($save_data);

			if ($save_target_jalan_provinsi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_target_jalan_provinsi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/target_jalan_provinsi/edit/' . $save_target_jalan_provinsi, 'Edit Target Jalan Provinsi'),
						anchor('administrator/target_jalan_provinsi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/target_jalan_provinsi/edit/' . $save_target_jalan_provinsi, 'Edit Target Jalan Provinsi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_jalan_provinsi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_jalan_provinsi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Target Jalan Provinsis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('target_jalan_provinsi_update');

		$this->data['target_jalan_provinsi'] = $this->model_target_jalan_provinsi->find($id);

		$this->template->title('Target Jalan Provinsi Update');
		$this->render('backend/standart/administrator/target_jalan_provinsi/target_jalan_provinsi_update', $this->data);
	}

	/**
	* Update Target Jalan Provinsis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('target_jalan_provinsi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('target_data_id', 'Nama Jalan', 'trim|required|max_length[11]');
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

			
			$save_target_jalan_provinsi = $this->model_target_jalan_provinsi->change($id, $save_data);

			if ($save_target_jalan_provinsi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/target_jalan_provinsi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_jalan_provinsi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_jalan_provinsi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Target Jalan Provinsis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('target_jalan_provinsi_delete');

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
            set_message(cclang('has_been_deleted', 'target_jalan_provinsi'), 'success');
        } else {
            set_message(cclang('error_delete', 'target_jalan_provinsi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Target Jalan Provinsis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('target_jalan_provinsi_view');

		$this->data['target_jalan_provinsi'] = $this->model_target_jalan_provinsi->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Target Jalan Provinsi Detail');
		$this->render('backend/standart/administrator/target_jalan_provinsi/target_jalan_provinsi_view', $this->data);
	}
	
	/**
	* delete Target Jalan Provinsis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$target_jalan_provinsi = $this->model_target_jalan_provinsi->find($id);

		
		
		return $this->model_target_jalan_provinsi->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('target_jalan_provinsi_export');

		$this->model_target_jalan_provinsi->export('target_jalan_provinsi', 'target_jalan_provinsi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('target_jalan_provinsi_export');

		$this->model_target_jalan_provinsi->pdf('target_jalan_provinsi', 'target_jalan_provinsi');
	}
}


/* End of file target_jalan_provinsi.php */
/* Location: ./application/controllers/administrator/Target Jalan Provinsi.php */