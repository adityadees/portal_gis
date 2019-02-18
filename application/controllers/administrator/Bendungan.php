<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Bendungan Controller
*| --------------------------------------------------------------------------
*| Bendungan site
*|
*/
class Bendungan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_bendungan');
	}

	/**
	* show all Bendungans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('bendungan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['bendungans'] = $this->model_bendungan->get($filter, $field, $this->limit_page, $offset);
		$this->data['bendungan_counts'] = $this->model_bendungan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/bendungan/index/',
			'total_rows'   => $this->model_bendungan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Bendungan List');
		$this->render('backend/standart/administrator/bendungan/bendungan_list', $this->data);
	}
	
	/**
	* Add new bendungans
	*
	*/
	public function add()
	{
		$this->is_allowed('bendungan_add');

		$this->template->title('Bendungan New');
		$this->render('backend/standart/administrator/bendungan/bendungan_add', $this->data);
	}

	/**
	* Add New Bendungans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('bendungan_add', false)) {
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

			
			$save_bendungan = $this->model_bendungan->store($save_data);

			if ($save_bendungan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_bendungan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/bendungan/edit/' . $save_bendungan, 'Edit Bendungan'),
						anchor('administrator/bendungan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/bendungan/edit/' . $save_bendungan, 'Edit Bendungan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/bendungan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/bendungan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Bendungans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('bendungan_update');

		$this->data['bendungan'] = $this->model_bendungan->find($id);

		$this->template->title('Bendungan Update');
		$this->render('backend/standart/administrator/bendungan/bendungan_update', $this->data);
	}

	/**
	* Update Bendungans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('bendungan_update', false)) {
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

			
			$save_bendungan = $this->model_bendungan->change($id, $save_data);

			if ($save_bendungan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/bendungan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/bendungan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/bendungan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Bendungans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('bendungan_delete');

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
            set_message(cclang('has_been_deleted', 'bendungan'), 'success');
        } else {
            set_message(cclang('error_delete', 'bendungan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Bendungans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('bendungan_view');

		$this->data['bendungan'] = $this->model_bendungan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Bendungan Detail');
		$this->render('backend/standart/administrator/bendungan/bendungan_view', $this->data);
	}
	
	/**
	* delete Bendungans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$bendungan = $this->model_bendungan->find($id);

		
		
		return $this->model_bendungan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('bendungan_export');

		$this->model_bendungan->export('bendungan', 'bendungan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('bendungan_export');

		$this->model_bendungan->pdf('bendungan', 'bendungan');
	}
}


/* End of file bendungan.php */
/* Location: ./application/controllers/administrator/Bendungan.php */