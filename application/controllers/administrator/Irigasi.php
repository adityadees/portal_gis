<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Irigasi Controller
*| --------------------------------------------------------------------------
*| Irigasi site
*|
*/
class Irigasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_irigasi');
	}

	/**
	* show all Irigasis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('irigasi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['irigasis'] = $this->model_irigasi->get($filter, $field, $this->limit_page, $offset);
		$this->data['irigasi_counts'] = $this->model_irigasi->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/irigasi/index/',
			'total_rows'   => $this->model_irigasi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Irigasi List');
		$this->render('backend/standart/administrator/irigasi/irigasi_list', $this->data);
	}
	
	/**
	* Add new irigasis
	*
	*/
	public function add()
	{
		$this->is_allowed('irigasi_add');

		$this->template->title('Irigasi New');
		$this->render('backend/standart/administrator/irigasi/irigasi_add', $this->data);
	}

	/**
	* Add New Irigasis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('irigasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('irigasi_id', 'Irigasi Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'irigasi_id' => $this->input->post('irigasi_id'),
				'nama' => $this->input->post('nama'),
			];

			
			$save_irigasi = $this->model_irigasi->store($save_data);

			if ($save_irigasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_irigasi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/irigasi/edit/' . $save_irigasi, 'Edit Irigasi'),
						anchor('administrator/irigasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/irigasi/edit/' . $save_irigasi, 'Edit Irigasi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/irigasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/irigasi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Irigasis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('irigasi_update');

		$this->data['irigasi'] = $this->model_irigasi->find($id);

		$this->template->title('Irigasi Update');
		$this->render('backend/standart/administrator/irigasi/irigasi_update', $this->data);
	}

	/**
	* Update Irigasis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('irigasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('irigasi_id', 'Irigasi Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'irigasi_id' => $this->input->post('irigasi_id'),
				'nama' => $this->input->post('nama'),
			];

			
			$save_irigasi = $this->model_irigasi->change($id, $save_data);

			if ($save_irigasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/irigasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/irigasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/irigasi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Irigasis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('irigasi_delete');

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
            set_message(cclang('has_been_deleted', 'irigasi'), 'success');
        } else {
            set_message(cclang('error_delete', 'irigasi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Irigasis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('irigasi_view');

		$this->data['irigasi'] = $this->model_irigasi->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Irigasi Detail');
		$this->render('backend/standart/administrator/irigasi/irigasi_view', $this->data);
	}
	
	/**
	* delete Irigasis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$irigasi = $this->model_irigasi->find($id);

		
		
		return $this->model_irigasi->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('irigasi_export');

		$this->model_irigasi->export('irigasi', 'irigasi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('irigasi_export');

		$this->model_irigasi->pdf('irigasi', 'irigasi');
	}
}


/* End of file irigasi.php */
/* Location: ./application/controllers/administrator/Irigasi.php */