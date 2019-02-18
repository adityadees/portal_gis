<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Bandara Controller
*| --------------------------------------------------------------------------
*| Bandara site
*|
*/
class Bandara extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_bandara');
	}

	/**
	* show all Bandaras
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('bandara_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['bandaras'] = $this->model_bandara->get($filter, $field, $this->limit_page, $offset);
		$this->data['bandara_counts'] = $this->model_bandara->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/bandara/index/',
			'total_rows'   => $this->model_bandara->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Bandara List');
		$this->render('backend/standart/administrator/bandara/bandara_list', $this->data);
	}
	
	/**
	* Add new bandaras
	*
	*/
	public function add()
	{
		$this->is_allowed('bandara_add');

		$this->template->title('Bandara New');
		$this->render('backend/standart/administrator/bandara/bandara_add', $this->data);
	}

	/**
	* Add New Bandaras
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('bandara_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('bandara_id', 'Bandara Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_termi', 'Nama Termi', 'trim|required');
		$this->form_validation->set_rules('klasifikasi', 'Klasifikasi', 'trim|required');
		$this->form_validation->set_rules('bandara_dtampung', 'Bandara Dtampung', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'bandara_id' => $this->input->post('bandara_id'),
				'nama_termi' => $this->input->post('nama_termi'),
				'klasifikasi' => $this->input->post('klasifikasi'),
				'bandara_dtampung' => $this->input->post('bandara_dtampung'),
				'status' => $this->input->post('status'),
				'runway' => $this->input->post('runway'),
			];

			
			$save_bandara = $this->model_bandara->store($save_data);

			if ($save_bandara) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_bandara;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/bandara/edit/' . $save_bandara, 'Edit Bandara'),
						anchor('administrator/bandara', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/bandara/edit/' . $save_bandara, 'Edit Bandara')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/bandara');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/bandara');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Bandaras
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('bandara_update');

		$this->data['bandara'] = $this->model_bandara->find($id);

		$this->template->title('Bandara Update');
		$this->render('backend/standart/administrator/bandara/bandara_update', $this->data);
	}

	/**
	* Update Bandaras
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('bandara_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('bandara_id', 'Bandara Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_termi', 'Nama Termi', 'trim|required');
		$this->form_validation->set_rules('klasifikasi', 'Klasifikasi', 'trim|required');
		$this->form_validation->set_rules('bandara_dtampung', 'Bandara Dtampung', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'bandara_id' => $this->input->post('bandara_id'),
				'nama_termi' => $this->input->post('nama_termi'),
				'klasifikasi' => $this->input->post('klasifikasi'),
				'bandara_dtampung' => $this->input->post('bandara_dtampung'),
				'status' => $this->input->post('status'),
				'runway' => $this->input->post('runway'),
			];

			
			$save_bandara = $this->model_bandara->change($id, $save_data);

			if ($save_bandara) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/bandara', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/bandara');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/bandara');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Bandaras
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('bandara_delete');

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
            set_message(cclang('has_been_deleted', 'bandara'), 'success');
        } else {
            set_message(cclang('error_delete', 'bandara'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Bandaras
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('bandara_view');

		$this->data['bandara'] = $this->model_bandara->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Bandara Detail');
		$this->render('backend/standart/administrator/bandara/bandara_view', $this->data);
	}
	
	/**
	* delete Bandaras
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$bandara = $this->model_bandara->find($id);

		
		
		return $this->model_bandara->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('bandara_export');

		$this->model_bandara->export('bandara', 'bandara');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('bandara_export');

		$this->model_bandara->pdf('bandara', 'bandara');
	}
}


/* End of file bandara.php */
/* Location: ./application/controllers/administrator/Bandara.php */