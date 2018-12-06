<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Bendungans Controller
*| --------------------------------------------------------------------------
*| Bendungans site
*|
*/
class Bendungans extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_bendungans');
	}

	/**
	* show all Bendunganss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('bendungans_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['bendunganss'] = $this->model_bendungans->get($filter, $field, $this->limit_page, $offset);
		$this->data['bendungans_counts'] = $this->model_bendungans->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/bendungans/index/',
			'total_rows'   => $this->model_bendungans->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Bendungans List');
		$this->render('backend/standart/administrator/bendungans/bendungans_list', $this->data);
	}
	
	/**
	* Add new bendunganss
	*
	*/
	public function add()
	{
		$this->is_allowed('bendungans_add');

		$this->template->title('Bendungans New');
		$this->render('backend/standart/administrator/bendungans/bendungans_add', $this->data);
	}

	/**
	* Add New Bendunganss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('bendungans_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('bendungan_id', 'Bendungan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'bendungan_id' => $this->input->post('bendungan_id'),
				'nama' => $this->input->post('nama'),
			];

			
			$save_bendungans = $this->model_bendungans->store($save_data);

			if ($save_bendungans) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_bendungans;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/bendungans/edit/' . $save_bendungans, 'Edit Bendungans'),
						anchor('administrator/bendungans', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/bendungans/edit/' . $save_bendungans, 'Edit Bendungans')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/bendungans');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/bendungans');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Bendunganss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('bendungans_update');

		$this->data['bendungans'] = $this->model_bendungans->find($id);

		$this->template->title('Bendungans Update');
		$this->render('backend/standart/administrator/bendungans/bendungans_update', $this->data);
	}

	/**
	* Update Bendunganss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('bendungans_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('bendungan_id', 'Bendungan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'bendungan_id' => $this->input->post('bendungan_id'),
				'nama' => $this->input->post('nama'),
			];

			
			$save_bendungans = $this->model_bendungans->change($id, $save_data);

			if ($save_bendungans) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/bendungans', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/bendungans');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/bendungans');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Bendunganss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('bendungans_delete');

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
            set_message(cclang('has_been_deleted', 'bendungans'), 'success');
        } else {
            set_message(cclang('error_delete', 'bendungans'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Bendunganss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('bendungans_view');

		$this->data['bendungans'] = $this->model_bendungans->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Bendungans Detail');
		$this->render('backend/standart/administrator/bendungans/bendungans_view', $this->data);
	}
	
	/**
	* delete Bendunganss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$bendungans = $this->model_bendungans->find($id);

		
		
		return $this->model_bendungans->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('bendungans_export');

		$this->model_bendungans->export('bendungans', 'bendungans');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('bendungans_export');

		$this->model_bendungans->pdf('bendungans', 'bendungans');
	}
}


/* End of file bendungans.php */
/* Location: ./application/controllers/administrator/Bendungans.php */