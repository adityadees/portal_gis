<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Banjir Controller
*| --------------------------------------------------------------------------
*| Banjir site
*|
*/
class Banjir extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_banjir');
	}

	/**
	* show all Banjirs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('banjir_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['banjirs'] = $this->model_banjir->get($filter, $field, $this->limit_page, $offset);
		$this->data['banjir_counts'] = $this->model_banjir->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/banjir/index/',
			'total_rows'   => $this->model_banjir->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Banjir List');
		$this->render('backend/standart/administrator/banjir/banjir_list', $this->data);
	}
	
	/**
	* Add new banjirs
	*
	*/
	public function add()
	{
		$this->is_allowed('banjir_add');

		$this->template->title('Banjir New');
		$this->render('backend/standart/administrator/banjir/banjir_add', $this->data);
	}

	/**
	* Add New Banjirs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('banjir_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('banjir_kode', 'Nama Daerah', 'trim|max_length[11]');
		$this->form_validation->set_rules('desa', 'Desa', 'trim|max_length[250]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'banjir_kode' => $this->input->post('banjir_kode'),
				'banjir_kecamatan' => $this->input->post('banjir_kecamatan'),
				'desa' => $this->input->post('desa'),
				'tahun' => $this->input->post('tahun'),
			];

			
			$save_banjir = $this->model_banjir->store($save_data);

			if ($save_banjir) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_banjir;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/banjir/edit/' . $save_banjir, 'Edit Banjir'),
						anchor('administrator/banjir', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/banjir/edit/' . $save_banjir, 'Edit Banjir')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/banjir');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/banjir');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Banjirs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('banjir_update');

		$this->data['banjir'] = $this->model_banjir->find($id);

		$this->template->title('Banjir Update');
		$this->render('backend/standart/administrator/banjir/banjir_update', $this->data);
	}

	/**
	* Update Banjirs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('banjir_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('banjir_kode', 'Nama Daerah', 'trim|max_length[11]');
		$this->form_validation->set_rules('desa', 'Desa', 'trim|max_length[250]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'banjir_kode' => $this->input->post('banjir_kode'),
				'banjir_kecamatan' => $this->input->post('banjir_kecamatan'),
				'desa' => $this->input->post('desa'),
				'tahun' => $this->input->post('tahun'),
			];

			
			$save_banjir = $this->model_banjir->change($id, $save_data);

			if ($save_banjir) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/banjir', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/banjir');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/banjir');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Banjirs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('banjir_delete');

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
            set_message(cclang('has_been_deleted', 'banjir'), 'success');
        } else {
            set_message(cclang('error_delete', 'banjir'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Banjirs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('banjir_view');

		$this->data['banjir'] = $this->model_banjir->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Banjir Detail');
		$this->render('backend/standart/administrator/banjir/banjir_view', $this->data);
	}
	
	/**
	* delete Banjirs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$banjir = $this->model_banjir->find($id);

		
		
		return $this->model_banjir->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('banjir_export');

		$this->model_banjir->export('banjir', 'banjir');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('banjir_export');

		$this->model_banjir->pdf('banjir', 'banjir');
	}
}


/* End of file banjir.php */
/* Location: ./application/controllers/administrator/Banjir.php */