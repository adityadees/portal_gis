<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Stanplat Controller
*| --------------------------------------------------------------------------
*| Stanplat site
*|
*/
class Stanplat extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_stanplat');
	}

	/**
	* show all Stanplats
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('stanplat_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['stanplats'] = $this->model_stanplat->get($filter, $field, $this->limit_page, $offset);
		$this->data['stanplat_counts'] = $this->model_stanplat->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/stanplat/index/',
			'total_rows'   => $this->model_stanplat->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Stanplat List');
		$this->render('backend/standart/administrator/stanplat/stanplat_list', $this->data);
	}
	
	/**
	* Add new stanplats
	*
	*/
	public function add()
	{
		$this->is_allowed('stanplat_add');

		$this->template->title('Stanplat New');
		$this->render('backend/standart/administrator/stanplat/stanplat_add', $this->data);
	}

	/**
	* Add New Stanplats
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('stanplat_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('stanplat_id', 'Stanplat Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_termi', 'Nama Termi', 'trim|required');
		$this->form_validation->set_rules('klasifikasi', 'Klasifikasi', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'stanplat_id' => $this->input->post('stanplat_id'),
				'nama_termi' => $this->input->post('nama_termi'),
				'klasifikasi' => $this->input->post('klasifikasi'),
			];

			
			$save_stanplat = $this->model_stanplat->store($save_data);

			if ($save_stanplat) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_stanplat;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/stanplat/edit/' . $save_stanplat, 'Edit Stanplat'),
						anchor('administrator/stanplat', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/stanplat/edit/' . $save_stanplat, 'Edit Stanplat')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/stanplat');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/stanplat');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Stanplats
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('stanplat_update');

		$this->data['stanplat'] = $this->model_stanplat->find($id);

		$this->template->title('Stanplat Update');
		$this->render('backend/standart/administrator/stanplat/stanplat_update', $this->data);
	}

	/**
	* Update Stanplats
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('stanplat_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('stanplat_id', 'Stanplat Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_termi', 'Nama Termi', 'trim|required');
		$this->form_validation->set_rules('klasifikasi', 'Klasifikasi', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'stanplat_id' => $this->input->post('stanplat_id'),
				'nama_termi' => $this->input->post('nama_termi'),
				'klasifikasi' => $this->input->post('klasifikasi'),
			];

			
			$save_stanplat = $this->model_stanplat->change($id, $save_data);

			if ($save_stanplat) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/stanplat', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/stanplat');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/stanplat');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Stanplats
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('stanplat_delete');

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
            set_message(cclang('has_been_deleted', 'stanplat'), 'success');
        } else {
            set_message(cclang('error_delete', 'stanplat'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Stanplats
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('stanplat_view');

		$this->data['stanplat'] = $this->model_stanplat->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Stanplat Detail');
		$this->render('backend/standart/administrator/stanplat/stanplat_view', $this->data);
	}
	
	/**
	* delete Stanplats
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$stanplat = $this->model_stanplat->find($id);

		
		
		return $this->model_stanplat->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('stanplat_export');

		$this->model_stanplat->export('stanplat', 'stanplat');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('stanplat_export');

		$this->model_stanplat->pdf('stanplat', 'stanplat');
	}
}


/* End of file stanplat.php */
/* Location: ./application/controllers/administrator/Stanplat.php */