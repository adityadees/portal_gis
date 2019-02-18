<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tol Controller
*| --------------------------------------------------------------------------
*| Tol site
*|
*/
class Tol extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tol');
	}

	/**
	* show all Tols
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tol_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tols'] = $this->model_tol->get($filter, $field, $this->limit_page, $offset);
		$this->data['tol_counts'] = $this->model_tol->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/tol/index/',
			'total_rows'   => $this->model_tol->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tol List');
		$this->render('backend/standart/administrator/tol/tol_list', $this->data);
	}
	
	/**
	* Add new tols
	*
	*/
	public function add()
	{
		$this->is_allowed('tol_add');

		$this->template->title('Tol New');
		$this->render('backend/standart/administrator/tol/tol_add', $this->data);
	}

	/**
	* Add New Tols
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tol_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('tol_ln_2017_sumatera_selatan_pubtr_geo_id', 'Nama Tol', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('jalanrencana', 'Jalanrencana', 'trim|required');
		$this->form_validation->set_rules('ruas', 'Ruas', 'trim|required');
		$this->form_validation->set_rules('status_tol', 'Status Tol', 'trim|required');
		$this->form_validation->set_rules('pemilik', 'Pemilik', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'tol_ln_2017_sumatera_selatan_pubtr_geo_id' => $this->input->post('tol_ln_2017_sumatera_selatan_pubtr_geo_id'),
				'jalanrencana' => $this->input->post('jalanrencana'),
				'ruas' => $this->input->post('ruas'),
				'status_tol' => $this->input->post('status_tol'),
				'pemilik' => $this->input->post('pemilik'),
			];

			
			$save_tol = $this->model_tol->store($save_data);

			if ($save_tol) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tol;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/tol/edit/' . $save_tol, 'Edit Tol'),
						anchor('administrator/tol', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/tol/edit/' . $save_tol, 'Edit Tol')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tol');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tol');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tols
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tol_update');

		$this->data['tol'] = $this->model_tol->find($id);

		$this->template->title('Tol Update');
		$this->render('backend/standart/administrator/tol/tol_update', $this->data);
	}

	/**
	* Update Tols
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tol_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('tol_ln_2017_sumatera_selatan_pubtr_geo_id', 'Nama Tol', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('jalanrencana', 'Jalanrencana', 'trim|required');
		$this->form_validation->set_rules('ruas', 'Ruas', 'trim|required');
		$this->form_validation->set_rules('status_tol', 'Status Tol', 'trim|required');
		$this->form_validation->set_rules('pemilik', 'Pemilik', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'tol_ln_2017_sumatera_selatan_pubtr_geo_id' => $this->input->post('tol_ln_2017_sumatera_selatan_pubtr_geo_id'),
				'jalanrencana' => $this->input->post('jalanrencana'),
				'ruas' => $this->input->post('ruas'),
				'status_tol' => $this->input->post('status_tol'),
				'pemilik' => $this->input->post('pemilik'),
			];

			
			$save_tol = $this->model_tol->change($id, $save_data);

			if ($save_tol) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/tol', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tol');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tol');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tols
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tol_delete');

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
            set_message(cclang('has_been_deleted', 'tol'), 'success');
        } else {
            set_message(cclang('error_delete', 'tol'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tols
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tol_view');

		$this->data['tol'] = $this->model_tol->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Tol Detail');
		$this->render('backend/standart/administrator/tol/tol_view', $this->data);
	}
	
	/**
	* delete Tols
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tol = $this->model_tol->find($id);

		
		
		return $this->model_tol->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tol_export');

		$this->model_tol->export('tol', 'tol');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tol_export');

		$this->model_tol->pdf('tol', 'tol');
	}
}


/* End of file tol.php */
/* Location: ./application/controllers/administrator/Tol.php */