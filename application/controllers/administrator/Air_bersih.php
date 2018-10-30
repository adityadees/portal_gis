<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Air Bersih Controller
*| --------------------------------------------------------------------------
*| Air Bersih site
*|
*/
class Air_bersih extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_air_bersih');
	}

	/**
	* show all Air Bersihs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('air_bersih_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['air_bersihs'] = $this->model_air_bersih->get($filter, $field, $this->limit_page, $offset);
		$this->data['air_bersih_counts'] = $this->model_air_bersih->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/air_bersih/index/',
			'total_rows'   => $this->model_air_bersih->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Air Bersih List');
		$this->render('backend/standart/administrator/air_bersih/air_bersih_list', $this->data);
	}
	
	/**
	* Add new air_bersihs
	*
	*/
	public function add()
	{
		$this->is_allowed('air_bersih_add');

		$this->template->title('Air Bersih New');
		$this->render('backend/standart/administrator/air_bersih/air_bersih_add', $this->data);
	}

	/**
	* Add New Air Bersihs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('air_bersih_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('air_bersih_id', 'Air Bersih Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('kabupaten_kota', 'Kabupaten Kota', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('kode_wilayah', 'Kode Wilayah', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('kode_kecamatan', 'Kode Kecamatan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('text_kecamatan', 'Text Kecamatan', 'trim|required');
		$this->form_validation->set_rules('luas', 'Luas', 'trim|required');
		$this->form_validation->set_rules('air_bers_1', 'Air Bers 1', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'air_bersih_id' => $this->input->post('air_bersih_id'),
				'kabupaten_kota' => $this->input->post('kabupaten_kota'),
				'kecamatan' => $this->input->post('kecamatan'),
				'kode_wilayah' => $this->input->post('kode_wilayah'),
				'kode_kecamatan' => $this->input->post('kode_kecamatan'),
				'text_kecamatan' => $this->input->post('text_kecamatan'),
				'luas' => $this->input->post('luas'),
				'air_bers_1' => $this->input->post('air_bers_1'),
			];

			
			$save_air_bersih = $this->model_air_bersih->store($save_data);

			if ($save_air_bersih) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_air_bersih;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/air_bersih/edit/' . $save_air_bersih, 'Edit Air Bersih'),
						anchor('administrator/air_bersih', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/air_bersih/edit/' . $save_air_bersih, 'Edit Air Bersih')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/air_bersih');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/air_bersih');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Air Bersihs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('air_bersih_update');

		$this->data['air_bersih'] = $this->model_air_bersih->find($id);

		$this->template->title('Air Bersih Update');
		$this->render('backend/standart/administrator/air_bersih/air_bersih_update', $this->data);
	}

	/**
	* Update Air Bersihs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('air_bersih_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('air_bersih_id', 'Air Bersih Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('kabupaten_kota', 'Kabupaten Kota', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('kode_wilayah', 'Kode Wilayah', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('kode_kecamatan', 'Kode Kecamatan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('text_kecamatan', 'Text Kecamatan', 'trim|required');
		$this->form_validation->set_rules('luas', 'Luas', 'trim|required');
		$this->form_validation->set_rules('air_bers_1', 'Air Bers 1', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'air_bersih_id' => $this->input->post('air_bersih_id'),
				'kabupaten_kota' => $this->input->post('kabupaten_kota'),
				'kecamatan' => $this->input->post('kecamatan'),
				'kode_wilayah' => $this->input->post('kode_wilayah'),
				'kode_kecamatan' => $this->input->post('kode_kecamatan'),
				'text_kecamatan' => $this->input->post('text_kecamatan'),
				'luas' => $this->input->post('luas'),
				'air_bers_1' => $this->input->post('air_bers_1'),
			];

			
			$save_air_bersih = $this->model_air_bersih->change($id, $save_data);

			if ($save_air_bersih) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/air_bersih', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/air_bersih');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/air_bersih');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Air Bersihs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('air_bersih_delete');

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
            set_message(cclang('has_been_deleted', 'air_bersih'), 'success');
        } else {
            set_message(cclang('error_delete', 'air_bersih'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Air Bersihs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('air_bersih_view');

		$this->data['air_bersih'] = $this->model_air_bersih->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Air Bersih Detail');
		$this->render('backend/standart/administrator/air_bersih/air_bersih_view', $this->data);
	}
	
	/**
	* delete Air Bersihs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$air_bersih = $this->model_air_bersih->find($id);

		
		
		return $this->model_air_bersih->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('air_bersih_export');

		$this->model_air_bersih->export('air_bersih', 'air_bersih');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('air_bersih_export');

		$this->model_air_bersih->pdf('air_bersih', 'air_bersih');
	}
}


/* End of file air_bersih.php */
/* Location: ./application/controllers/administrator/Air Bersih.php */