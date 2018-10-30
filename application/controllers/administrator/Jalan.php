<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jalan Controller
*| --------------------------------------------------------------------------
*| Jalan site
*|
*/
class Jalan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jalan');
	}

	/**
	* show all Jalans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jalan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jalans'] = $this->model_jalan->get($filter, $field, $this->limit_page, $offset);
		$this->data['jalan_counts'] = $this->model_jalan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/jalan/index/',
			'total_rows'   => $this->model_jalan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jalan List');
		$this->render('backend/standart/administrator/jalan/jalan_list', $this->data);
	}
	
	/**
	* Add new jalans
	*
	*/
	public function add()
	{
		$this->is_allowed('jalan_add');

		$this->template->title('Jalan New');
		$this->render('backend/standart/administrator/jalan/jalan_add', $this->data);
	}

	/**
	* Add New Jalans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jalan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('jalan_id', 'Jalan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('jalan_status', 'Jalan Status', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('jalan_fungsi', 'Jalan Fungsi', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('jalan_sumber', 'Jalan Sumber', 'trim|required');
		$this->form_validation->set_rules('jalan_no_ruas', 'Jalan No Ruas', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('jalan_nama_ruas', 'Jalan Nama Ruas', 'trim|required');
		$this->form_validation->set_rules('jalan_panjang', 'Jalan Panjang (M)', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('jalan_layer', 'Jalan Layer', 'trim|required|max_length[20]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jalan_id' => $this->input->post('jalan_id'),
				'jalan_status' => $this->input->post('jalan_status'),
				'jalan_fungsi' => $this->input->post('jalan_fungsi'),
				'jalan_sumber' => $this->input->post('jalan_sumber'),
				'jalan_no_ruas' => $this->input->post('jalan_no_ruas'),
				'jalan_nama_ruas' => $this->input->post('jalan_nama_ruas'),
				'jalan_panjang' => $this->input->post('jalan_panjang'),
				'jalan_layer' => $this->input->post('jalan_layer'),
			];

			
			$save_jalan = $this->model_jalan->store($save_data);

			if ($save_jalan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jalan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/jalan/edit/' . $save_jalan, 'Edit Jalan'),
						anchor('administrator/jalan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/jalan/edit/' . $save_jalan, 'Edit Jalan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jalan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jalan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jalans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jalan_update');

		$this->data['jalan'] = $this->model_jalan->find($id);

		$this->template->title('Jalan Update');
		$this->render('backend/standart/administrator/jalan/jalan_update', $this->data);
	}

	/**
	* Update Jalans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jalan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jalan_id', 'Jalan Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('jalan_status', 'Jalan Status', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('jalan_fungsi', 'Jalan Fungsi', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('jalan_sumber', 'Jalan Sumber', 'trim|required');
		$this->form_validation->set_rules('jalan_no_ruas', 'Jalan No Ruas', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('jalan_nama_ruas', 'Jalan Nama Ruas', 'trim|required');
		$this->form_validation->set_rules('jalan_panjang', 'Jalan Panjang (M)', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('jalan_layer', 'Jalan Layer', 'trim|required|max_length[20]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jalan_id' => $this->input->post('jalan_id'),
				'jalan_status' => $this->input->post('jalan_status'),
				'jalan_fungsi' => $this->input->post('jalan_fungsi'),
				'jalan_sumber' => $this->input->post('jalan_sumber'),
				'jalan_no_ruas' => $this->input->post('jalan_no_ruas'),
				'jalan_nama_ruas' => $this->input->post('jalan_nama_ruas'),
				'jalan_panjang' => $this->input->post('jalan_panjang'),
				'jalan_layer' => $this->input->post('jalan_layer'),
			];

			
			$save_jalan = $this->model_jalan->change($id, $save_data);

			if ($save_jalan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/jalan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jalan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jalan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jalans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('jalan_delete');

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
            set_message(cclang('has_been_deleted', 'jalan'), 'success');
        } else {
            set_message(cclang('error_delete', 'jalan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Jalans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jalan_view');

		$this->data['jalan'] = $this->model_jalan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Jalan Detail');
		$this->render('backend/standart/administrator/jalan/jalan_view', $this->data);
	}
	
	/**
	* delete Jalans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jalan = $this->model_jalan->find($id);

		
		
		return $this->model_jalan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jalan_export');

		$this->model_jalan->export('jalan', 'jalan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jalan_export');

		$this->model_jalan->pdf('jalan', 'jalan');
	}
}


/* End of file jalan.php */
/* Location: ./application/controllers/administrator/Jalan.php */