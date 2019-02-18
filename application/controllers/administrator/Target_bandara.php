<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Target Bandara Controller
*| --------------------------------------------------------------------------
*| Target Bandara site
*|
*/
class Target_bandara extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_target_bandara');
	}

	/**
	* show all Target Bandaras
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('target_bandara_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['target_bandaras'] = $this->model_target_bandara->get($filter, $field, $this->limit_page, $offset);
		$this->data['target_bandara_counts'] = $this->model_target_bandara->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/target_bandara/index/',
			'total_rows'   => $this->model_target_bandara->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Target Bandara List');
		$this->render('backend/standart/administrator/target_bandara/target_bandara_list', $this->data);
	}
	
	/**
	* Add new target_bandaras
	*
	*/
	public function add()
	{
		$this->is_allowed('target_bandara_add');

		$this->template->title('Target Bandara New');
		$this->render('backend/standart/administrator/target_bandara/target_bandara_add', $this->data);
	}

	/**
	* Add New Target Bandaras
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('target_bandara_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('target_data_id', 'Nama Bandara', 'trim|required|max_length[11]');
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

			
			$save_target_bandara = $this->model_target_bandara->store($save_data);

			if ($save_target_bandara) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_target_bandara;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/target_bandara/edit/' . $save_target_bandara, 'Edit Target Bandara'),
						anchor('administrator/target_bandara', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/target_bandara/edit/' . $save_target_bandara, 'Edit Target Bandara')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_bandara');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_bandara');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Target Bandaras
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('target_bandara_update');

		$this->data['target_bandara'] = $this->model_target_bandara->find($id);

		$this->template->title('Target Bandara Update');
		$this->render('backend/standart/administrator/target_bandara/target_bandara_update', $this->data);
	}

	/**
	* Update Target Bandaras
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('target_bandara_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('target_data_id', 'Nama Bandara', 'trim|required|max_length[11]');
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

			
			$save_target_bandara = $this->model_target_bandara->change($id, $save_data);

			if ($save_target_bandara) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/target_bandara', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_bandara');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_bandara');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Target Bandaras
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('target_bandara_delete');

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
            set_message(cclang('has_been_deleted', 'target_bandara'), 'success');
        } else {
            set_message(cclang('error_delete', 'target_bandara'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Target Bandaras
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('target_bandara_view');

		$this->data['target_bandara'] = $this->model_target_bandara->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Target Bandara Detail');
		$this->render('backend/standart/administrator/target_bandara/target_bandara_view', $this->data);
	}
	
	/**
	* delete Target Bandaras
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$target_bandara = $this->model_target_bandara->find($id);

		
		
		return $this->model_target_bandara->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('target_bandara_export');

		$this->model_target_bandara->export('target_bandara', 'target_bandara');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('target_bandara_export');

		$this->model_target_bandara->pdf('target_bandara', 'target_bandara');
	}
}


/* End of file target_bandara.php */
/* Location: ./application/controllers/administrator/Target Bandara.php */