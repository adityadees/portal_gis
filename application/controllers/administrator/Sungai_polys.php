<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Sungai Polys Controller
*| --------------------------------------------------------------------------
*| Sungai Polys site
*|
*/
class Sungai_polys extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_sungai_polys');
	}

	/**
	* show all Sungai Polyss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('sungai_polys_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['sungai_polyss'] = $this->model_sungai_polys->get($filter, $field, $this->limit_page, $offset);
		$this->data['sungai_polys_counts'] = $this->model_sungai_polys->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/sungai_polys/index/',
			'total_rows'   => $this->model_sungai_polys->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Sungai Polys List');
		$this->render('backend/standart/administrator/sungai_polys/sungai_polys_list', $this->data);
	}
	
	/**
	* Add new sungai_polyss
	*
	*/
	public function add()
	{
		$this->is_allowed('sungai_polys_add');

		$this->template->title('Sungai Polys New');
		$this->render('backend/standart/administrator/sungai_polys/sungai_polys_add', $this->data);
	}

	/**
	* Add New Sungai Polyss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('sungai_polys_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('sungai_poly_id', 'Sungai Poly Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('cbase', 'Cbase', 'trim|required');
		$this->form_validation->set_rules('namasungai', 'Namasungai', 'trim|required');
		$this->form_validation->set_rules('sumber', 'Sumber', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'sungai_poly_id' => $this->input->post('sungai_poly_id'),
				'cbase' => $this->input->post('cbase'),
				'namasungai' => $this->input->post('namasungai'),
				'sumber' => $this->input->post('sumber'),
			];

			
			$save_sungai_polys = $this->model_sungai_polys->store($save_data);

			if ($save_sungai_polys) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_sungai_polys;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/sungai_polys/edit/' . $save_sungai_polys, 'Edit Sungai Polys'),
						anchor('administrator/sungai_polys', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/sungai_polys/edit/' . $save_sungai_polys, 'Edit Sungai Polys')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/sungai_polys');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/sungai_polys');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Sungai Polyss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('sungai_polys_update');

		$this->data['sungai_polys'] = $this->model_sungai_polys->find($id);

		$this->template->title('Sungai Polys Update');
		$this->render('backend/standart/administrator/sungai_polys/sungai_polys_update', $this->data);
	}

	/**
	* Update Sungai Polyss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('sungai_polys_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('sungai_poly_id', 'Sungai Poly Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('cbase', 'Cbase', 'trim|required');
		$this->form_validation->set_rules('namasungai', 'Namasungai', 'trim|required');
		$this->form_validation->set_rules('sumber', 'Sumber', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'sungai_poly_id' => $this->input->post('sungai_poly_id'),
				'cbase' => $this->input->post('cbase'),
				'namasungai' => $this->input->post('namasungai'),
				'sumber' => $this->input->post('sumber'),
			];

			
			$save_sungai_polys = $this->model_sungai_polys->change($id, $save_data);

			if ($save_sungai_polys) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/sungai_polys', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/sungai_polys');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/sungai_polys');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Sungai Polyss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('sungai_polys_delete');

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
            set_message(cclang('has_been_deleted', 'sungai_polys'), 'success');
        } else {
            set_message(cclang('error_delete', 'sungai_polys'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Sungai Polyss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('sungai_polys_view');

		$this->data['sungai_polys'] = $this->model_sungai_polys->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Sungai Polys Detail');
		$this->render('backend/standart/administrator/sungai_polys/sungai_polys_view', $this->data);
	}
	
	/**
	* delete Sungai Polyss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$sungai_polys = $this->model_sungai_polys->find($id);

		
		
		return $this->model_sungai_polys->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('sungai_polys_export');

		$this->model_sungai_polys->export('sungai_polys', 'sungai_polys');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('sungai_polys_export');

		$this->model_sungai_polys->pdf('sungai_polys', 'sungai_polys');
	}
}


/* End of file sungai_polys.php */
/* Location: ./application/controllers/administrator/Sungai Polys.php */