<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Stasiun Controller
*| --------------------------------------------------------------------------
*| Stasiun site
*|
*/
class Stasiun extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_stasiun');
	}

	/**
	* show all Stasiuns
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('stasiun_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['stasiuns'] = $this->model_stasiun->get($filter, $field, $this->limit_page, $offset);
		$this->data['stasiun_counts'] = $this->model_stasiun->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/stasiun/index/',
			'total_rows'   => $this->model_stasiun->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Stasiun List');
		$this->render('backend/standart/administrator/stasiun/stasiun_list', $this->data);
	}
	
	/**
	* Add new stasiuns
	*
	*/
	public function add()
	{
		$this->is_allowed('stasiun_add');

		$this->template->title('Stasiun New');
		$this->render('backend/standart/administrator/stasiun/stasiun_add', $this->data);
	}

	/**
	* Add New Stasiuns
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('stasiun_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('stasiun_id', 'Stasiun Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_termi', 'Nama Termi', 'trim|required');
		$this->form_validation->set_rules('klasifikasi', 'Klasifikasi', 'trim|required');
		$this->form_validation->set_rules('stasiun_dtampung', 'Stasiun Dtampung', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'stasiun_id' => $this->input->post('stasiun_id'),
				'nama_termi' => $this->input->post('nama_termi'),
				'klasifikasi' => $this->input->post('klasifikasi'),
				'stasiun_dtampung' => $this->input->post('stasiun_dtampung'),
			];

			
			$save_stasiun = $this->model_stasiun->store($save_data);

			if ($save_stasiun) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_stasiun;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/stasiun/edit/' . $save_stasiun, 'Edit Stasiun'),
						anchor('administrator/stasiun', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/stasiun/edit/' . $save_stasiun, 'Edit Stasiun')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/stasiun');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/stasiun');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Stasiuns
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('stasiun_update');

		$this->data['stasiun'] = $this->model_stasiun->find($id);

		$this->template->title('Stasiun Update');
		$this->render('backend/standart/administrator/stasiun/stasiun_update', $this->data);
	}

	/**
	* Update Stasiuns
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('stasiun_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('stasiun_id', 'Stasiun Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_termi', 'Nama Termi', 'trim|required');
		$this->form_validation->set_rules('klasifikasi', 'Klasifikasi', 'trim|required');
		$this->form_validation->set_rules('stasiun_dtampung', 'Stasiun Dtampung', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'stasiun_id' => $this->input->post('stasiun_id'),
				'nama_termi' => $this->input->post('nama_termi'),
				'klasifikasi' => $this->input->post('klasifikasi'),
				'stasiun_dtampung' => $this->input->post('stasiun_dtampung'),
			];

			
			$save_stasiun = $this->model_stasiun->change($id, $save_data);

			if ($save_stasiun) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/stasiun', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/stasiun');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/stasiun');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Stasiuns
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('stasiun_delete');

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
            set_message(cclang('has_been_deleted', 'stasiun'), 'success');
        } else {
            set_message(cclang('error_delete', 'stasiun'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Stasiuns
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('stasiun_view');

		$this->data['stasiun'] = $this->model_stasiun->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Stasiun Detail');
		$this->render('backend/standart/administrator/stasiun/stasiun_view', $this->data);
	}
	
	/**
	* delete Stasiuns
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$stasiun = $this->model_stasiun->find($id);

		
		
		return $this->model_stasiun->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('stasiun_export');

		$this->model_stasiun->export('stasiun', 'stasiun');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('stasiun_export');

		$this->model_stasiun->pdf('stasiun', 'stasiun');
	}
}


/* End of file stasiun.php */
/* Location: ./application/controllers/administrator/Stasiun.php */