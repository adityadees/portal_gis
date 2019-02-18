<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Target Irigasi Controller
*| --------------------------------------------------------------------------
*| Target Irigasi site
*|
*/
class Target_irigasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_target_irigasi');
	}

	/**
	* show all Target Irigasis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('target_irigasi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['target_irigasis'] = $this->model_target_irigasi->get($filter, $field, $this->limit_page, $offset);
		$this->data['target_irigasi_counts'] = $this->model_target_irigasi->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/target_irigasi/index/',
			'total_rows'   => $this->model_target_irigasi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Target Irigasi List');
		$this->render('backend/standart/administrator/target_irigasi/target_irigasi_list', $this->data);
	}
	
	/**
	* Add new target_irigasis
	*
	*/
	public function add()
	{
		$this->is_allowed('target_irigasi_add');

		$this->template->title('Target Irigasi New');
		$this->render('backend/standart/administrator/target_irigasi/target_irigasi_add', $this->data);
	}

	/**
	* Add New Target Irigasis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('target_irigasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('target_data_id', 'Bendungan Nama', 'trim|required|max_length[11]');
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

			
			$save_target_irigasi = $this->model_target_irigasi->store($save_data);

			if ($save_target_irigasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_target_irigasi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/target_irigasi/edit/' . $save_target_irigasi, 'Edit Target Irigasi'),
						anchor('administrator/target_irigasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/target_irigasi/edit/' . $save_target_irigasi, 'Edit Target Irigasi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_irigasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_irigasi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Target Irigasis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('target_irigasi_update');

		$this->data['target_irigasi'] = $this->model_target_irigasi->find($id);

		$this->template->title('Target Irigasi Update');
		$this->render('backend/standart/administrator/target_irigasi/target_irigasi_update', $this->data);
	}

	/**
	* Update Target Irigasis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('target_irigasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('target_data_id', 'Bendungan Nama', 'trim|required|max_length[11]');
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

			
			$save_target_irigasi = $this->model_target_irigasi->change($id, $save_data);

			if ($save_target_irigasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/target_irigasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/target_irigasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/target_irigasi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Target Irigasis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('target_irigasi_delete');

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
            set_message(cclang('has_been_deleted', 'target_irigasi'), 'success');
        } else {
            set_message(cclang('error_delete', 'target_irigasi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Target Irigasis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('target_irigasi_view');

		$this->data['target_irigasi'] = $this->model_target_irigasi->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Target Irigasi Detail');
		$this->render('backend/standart/administrator/target_irigasi/target_irigasi_view', $this->data);
	}
	
	/**
	* delete Target Irigasis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$target_irigasi = $this->model_target_irigasi->find($id);

		
		
		return $this->model_target_irigasi->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('target_irigasi_export');

		$this->model_target_irigasi->export('target_irigasi', 'target_irigasi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('target_irigasi_export');

		$this->model_target_irigasi->pdf('target_irigasi', 'target_irigasi');
	}
}


/* End of file target_irigasi.php */
/* Location: ./application/controllers/administrator/Target Irigasi.php */