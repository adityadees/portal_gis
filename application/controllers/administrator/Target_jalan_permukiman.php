<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Target Jalan Permukiman Controller
*| --------------------------------------------------------------------------
*| Target Jalan Permukiman site
*|
*/
class Target_jalan_permukiman extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_target_jalan_permukiman');
	}

	/**
	* show all Target Jalan Permukimans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('target_jalan_permukiman_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['target_jalan_permukimans'] = $this->model_target_jalan_permukiman->get($filter, $field, $this->limit_page, $offset);
		$this->data['target_jalan_permukiman_counts'] = $this->model_target_jalan_permukiman->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/target_jalan_permukiman/index/',
			'total_rows'   => $this->model_target_jalan_permukiman->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Target Jalan Permukiman List');
		$this->render('backend/standart/administrator/target_jalan_permukiman/target_jalan_permukiman_list', $this->data);
	}
	
	/**
	* Add new target_jalan_permukimans
	*
	*/
	public function add()
	{
		$this->is_allowed('target_jalan_permukiman_add');

		$this->template->title('Target Jalan Permukiman New');
		$this->render('backend/standart/administrator/target_jalan_permukiman/target_jalan_permukiman_add', $this->data);
	}

	/**
	* Add New Target Jalan Permukimans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('target_jalan_permukiman_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('target_data_id', 'Nama Daerah', 'trim|required|max_length[11]');
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

			
			$save_target_jalan_permukiman = $this->model_target_jalan_permukiman->store($save_data);

			if ($save_target_jalan_permukiman) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_target_jalan_permukiman;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/target_jalan_permukiman/edit/' . $save_target_jalan_permukiman, 'Edit Target Jalan Permukiman'),
						anchor('administrator/target_jalan_permukiman', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/target_jalan_permukiman/edit/' . $save_target_jalan_permukiman, 'Edit Target Jalan Permukiman')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_jalan_permukiman');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_jalan_permukiman');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Target Jalan Permukimans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('target_jalan_permukiman_update');

		$this->data['target_jalan_permukiman'] = $this->model_target_jalan_permukiman->find($id);

		$this->template->title('Target Jalan Permukiman Update');
		$this->render('backend/standart/administrator/target_jalan_permukiman/target_jalan_permukiman_update', $this->data);
	}

	/**
	* Update Target Jalan Permukimans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('target_jalan_permukiman_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('target_data_id', 'Nama Daerah', 'trim|required|max_length[11]');
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

			
			$save_target_jalan_permukiman = $this->model_target_jalan_permukiman->change($id, $save_data);

			if ($save_target_jalan_permukiman) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/target_jalan_permukiman', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_jalan_permukiman');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_jalan_permukiman');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Target Jalan Permukimans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('target_jalan_permukiman_delete');

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
            set_message(cclang('has_been_deleted', 'target_jalan_permukiman'), 'success');
        } else {
            set_message(cclang('error_delete', 'target_jalan_permukiman'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Target Jalan Permukimans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('target_jalan_permukiman_view');

		$this->data['target_jalan_permukiman'] = $this->model_target_jalan_permukiman->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Target Jalan Permukiman Detail');
		$this->render('backend/standart/administrator/target_jalan_permukiman/target_jalan_permukiman_view', $this->data);
	}
	
	/**
	* delete Target Jalan Permukimans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$target_jalan_permukiman = $this->model_target_jalan_permukiman->find($id);

		
		
		return $this->model_target_jalan_permukiman->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('target_jalan_permukiman_export');

		$this->model_target_jalan_permukiman->export('target_jalan_permukiman', 'target_jalan_permukiman');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('target_jalan_permukiman_export');

		$this->model_target_jalan_permukiman->pdf('target_jalan_permukiman', 'target_jalan_permukiman');
	}
}


/* End of file target_jalan_permukiman.php */
/* Location: ./application/controllers/administrator/Target Jalan Permukiman.php */