<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Target Kawasan Kumuh Controller
*| --------------------------------------------------------------------------
*| Target Kawasan Kumuh site
*|
*/
class Target_kawasan_kumuh extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_target_kawasan_kumuh');
	}

	/**
	* show all Target Kawasan Kumuhs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('target_kawasan_kumuh_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['target_kawasan_kumuhs'] = $this->model_target_kawasan_kumuh->get($filter, $field, $this->limit_page, $offset);
		$this->data['target_kawasan_kumuh_counts'] = $this->model_target_kawasan_kumuh->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/target_kawasan_kumuh/index/',
			'total_rows'   => $this->model_target_kawasan_kumuh->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Target Kawasan Kumuh List');
		$this->render('backend/standart/administrator/target_kawasan_kumuh/target_kawasan_kumuh_list', $this->data);
	}
	
	/**
	* Add new target_kawasan_kumuhs
	*
	*/
	public function add()
	{
		$this->is_allowed('target_kawasan_kumuh_add');

		$this->template->title('Target Kawasan Kumuh New');
		$this->render('backend/standart/administrator/target_kawasan_kumuh/target_kawasan_kumuh_add', $this->data);
	}

	/**
	* Add New Target Kawasan Kumuhs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('target_kawasan_kumuh_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('target_data_id', 'Nama Kawasan Kumuh', 'trim|required|max_length[11]');
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

			
			$save_target_kawasan_kumuh = $this->model_target_kawasan_kumuh->store($save_data);

			if ($save_target_kawasan_kumuh) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_target_kawasan_kumuh;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/target_kawasan_kumuh/edit/' . $save_target_kawasan_kumuh, 'Edit Target Kawasan Kumuh'),
						anchor('administrator/target_kawasan_kumuh', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/target_kawasan_kumuh/edit/' . $save_target_kawasan_kumuh, 'Edit Target Kawasan Kumuh')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_kawasan_kumuh');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_kawasan_kumuh');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Target Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('target_kawasan_kumuh_update');

		$this->data['target_kawasan_kumuh'] = $this->model_target_kawasan_kumuh->find($id);

		$this->template->title('Target Kawasan Kumuh Update');
		$this->render('backend/standart/administrator/target_kawasan_kumuh/target_kawasan_kumuh_update', $this->data);
	}

	/**
	* Update Target Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('target_kawasan_kumuh_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('target_data_id', 'Nama Kawasan Kumuh', 'trim|required|max_length[11]');
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

			
			$save_target_kawasan_kumuh = $this->model_target_kawasan_kumuh->change($id, $save_data);

			if ($save_target_kawasan_kumuh) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/target_kawasan_kumuh', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_kawasan_kumuh');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_kawasan_kumuh');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Target Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('target_kawasan_kumuh_delete');

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
            set_message(cclang('has_been_deleted', 'target_kawasan_kumuh'), 'success');
        } else {
            set_message(cclang('error_delete', 'target_kawasan_kumuh'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Target Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('target_kawasan_kumuh_view');

		$this->data['target_kawasan_kumuh'] = $this->model_target_kawasan_kumuh->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Target Kawasan Kumuh Detail');
		$this->render('backend/standart/administrator/target_kawasan_kumuh/target_kawasan_kumuh_view', $this->data);
	}
	
	/**
	* delete Target Kawasan Kumuhs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$target_kawasan_kumuh = $this->model_target_kawasan_kumuh->find($id);

		
		
		return $this->model_target_kawasan_kumuh->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('target_kawasan_kumuh_export');

		$this->model_target_kawasan_kumuh->export('target_kawasan_kumuh', 'target_kawasan_kumuh');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('target_kawasan_kumuh_export');

		$this->model_target_kawasan_kumuh->pdf('target_kawasan_kumuh', 'target_kawasan_kumuh');
	}
}


/* End of file target_kawasan_kumuh.php */
/* Location: ./application/controllers/administrator/Target Kawasan Kumuh.php */