<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jalan Permukiman Controller
*| --------------------------------------------------------------------------
*| Jalan Permukiman site
*|
*/
class Jalan_permukiman extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jalan_permukiman');
	}

	/**
	* show all Jalan Permukimans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jalan_permukiman_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jalan_permukimans'] = $this->model_jalan_permukiman->get($filter, $field, $this->limit_page, $offset);
		$this->data['jalan_permukiman_counts'] = $this->model_jalan_permukiman->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/jalan_permukiman/index/',
			'total_rows'   => $this->model_jalan_permukiman->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jalan Permukiman List');
		$this->render('backend/standart/administrator/jalan_permukiman/jalan_permukiman_list', $this->data);
	}
	
	/**
	* Add new jalan_permukimans
	*
	*/
	public function add()
	{
		$this->is_allowed('jalan_permukiman_add');

		$this->template->title('Jalan Permukiman New');
		$this->render('backend/standart/administrator/jalan_permukiman/jalan_permukiman_add', $this->data);
	}

	/**
	* Add New Jalan Permukimans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jalan_permukiman_add', false)) {
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
		$this->form_validation->set_rules('jalan_panjang', 'Jalan Panjang (KM)', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('jalan_layer', 'Jalan Layer', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('jalan_kegiatan', 'Jalan Kegiatan', 'trim|required|max_length[100]');
		

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

			
			$save_jalan_permukiman = $this->model_jalan_permukiman->store($save_data);

			if ($save_jalan_permukiman) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jalan_permukiman;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/jalan_permukiman/edit/' . $save_jalan_permukiman, 'Edit Jalan Permukiman'),
						anchor('administrator/jalan_permukiman', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/jalan_permukiman/edit/' . $save_jalan_permukiman, 'Edit Jalan Permukiman')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jalan_permukiman');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jalan_permukiman');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jalan Permukimans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jalan_permukiman_update');

		$this->data['jalan_permukiman'] = $this->model_jalan_permukiman->find($id);

		$this->template->title('Jalan Permukiman Update');
		$this->render('backend/standart/administrator/jalan_permukiman/jalan_permukiman_update', $this->data);
	}

	/**
	* Update Jalan Permukimans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jalan_permukiman_update', false)) {
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
		$this->form_validation->set_rules('jalan_panjang', 'Jalan Panjang (KM)', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('jalan_layer', 'Jalan Layer', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('jalan_kegiatan', 'Jalan Kegiatan', 'trim|required|max_length[100]');
		
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

			
			$save_jalan_permukiman = $this->model_jalan_permukiman->change($id, $save_data);

			if ($save_jalan_permukiman) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/jalan_permukiman', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jalan_permukiman');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jalan_permukiman');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jalan Permukimans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('jalan_permukiman_delete');

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
            set_message(cclang('has_been_deleted', 'jalan_permukiman'), 'success');
        } else {
            set_message(cclang('error_delete', 'jalan_permukiman'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Jalan Permukimans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jalan_permukiman_view');

		$this->data['jalan_permukiman'] = $this->model_jalan_permukiman->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Jalan Permukiman Detail');
		$this->render('backend/standart/administrator/jalan_permukiman/jalan_permukiman_view', $this->data);
	}
	
	/**
	* delete Jalan Permukimans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jalan_permukiman = $this->model_jalan_permukiman->find($id);

		
		
		return $this->model_jalan_permukiman->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jalan_permukiman_export');

		$this->model_jalan_permukiman->export('jalan_permukiman', 'jalan_permukiman');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jalan_permukiman_export');

		$this->model_jalan_permukiman->pdf('jalan_permukiman', 'jalan_permukiman');
	}
}


/* End of file jalan_permukiman.php */
/* Location: ./application/controllers/administrator/Jalan Permukiman.php */