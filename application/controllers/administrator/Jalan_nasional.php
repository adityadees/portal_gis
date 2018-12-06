<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jalan Nasional Controller
*| --------------------------------------------------------------------------
*| Jalan Nasional site
*|
*/
class Jalan_nasional extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jalan_nasional');
	}

	/**
	* show all Jalan Nasionals
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jalan_nasional_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jalan_nasionals'] = $this->model_jalan_nasional->get($filter, $field, $this->limit_page, $offset);
		$this->data['jalan_nasional_counts'] = $this->model_jalan_nasional->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/jalan_nasional/index/',
			'total_rows'   => $this->model_jalan_nasional->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jalan Nasional List');
		$this->render('backend/standart/administrator/jalan_nasional/jalan_nasional_list', $this->data);
	}
	
	/**
	* Add new jalan_nasionals
	*
	*/
	public function add()
	{
		$this->is_allowed('jalan_nasional_add');

		$this->template->title('Jalan Nasional New');
		$this->render('backend/standart/administrator/jalan_nasional/jalan_nasional_add', $this->data);
	}

	/**
	* Add New Jalan Nasionals
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jalan_nasional_add', false)) {
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
		$this->form_validation->set_rules('jalan_panjang', 'Jalan Panjang', 'trim|required|max_length[11]');
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
				'jalan_kegiatan' => $this->input->post('jalan_kegiatan'),
			];

			
			$save_jalan_nasional = $this->model_jalan_nasional->store($save_data);

			if ($save_jalan_nasional) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jalan_nasional;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/jalan_nasional/edit/' . $save_jalan_nasional, 'Edit Jalan Nasional'),
						anchor('administrator/jalan_nasional', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/jalan_nasional/edit/' . $save_jalan_nasional, 'Edit Jalan Nasional')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jalan_nasional');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jalan_nasional');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jalan Nasionals
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jalan_nasional_update');

		$this->data['jalan_nasional'] = $this->model_jalan_nasional->find($id);

		$this->template->title('Jalan Nasional Update');
		$this->render('backend/standart/administrator/jalan_nasional/jalan_nasional_update', $this->data);
	}

	/**
	* Update Jalan Nasionals
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jalan_nasional_update', false)) {
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
		$this->form_validation->set_rules('jalan_panjang', 'Jalan Panjang', 'trim|required|max_length[11]');
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
				'jalan_kegiatan' => $this->input->post('jalan_kegiatan'),
			];

			
			$save_jalan_nasional = $this->model_jalan_nasional->change($id, $save_data);

			if ($save_jalan_nasional) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/jalan_nasional', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jalan_nasional');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jalan_nasional');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jalan Nasionals
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('jalan_nasional_delete');

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
            set_message(cclang('has_been_deleted', 'jalan_nasional'), 'success');
        } else {
            set_message(cclang('error_delete', 'jalan_nasional'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Jalan Nasionals
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jalan_nasional_view');

		$this->data['jalan_nasional'] = $this->model_jalan_nasional->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Jalan Nasional Detail');
		$this->render('backend/standart/administrator/jalan_nasional/jalan_nasional_view', $this->data);
	}
	
	/**
	* delete Jalan Nasionals
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jalan_nasional = $this->model_jalan_nasional->find($id);

		
		
		return $this->model_jalan_nasional->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jalan_nasional_export');

		$this->model_jalan_nasional->export('jalan_nasional', 'jalan_nasional');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jalan_nasional_export');

		$this->model_jalan_nasional->pdf('jalan_nasional', 'jalan_nasional');
	}
}


/* End of file jalan_nasional.php */
/* Location: ./application/controllers/administrator/Jalan Nasional.php */