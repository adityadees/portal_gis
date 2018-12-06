<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Sanitasi Sumsels Controller
*| --------------------------------------------------------------------------
*| Sanitasi Sumsels site
*|
*/
class Sanitasi_sumsels extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_sanitasi_sumsels');
	}

	/**
	* show all Sanitasi Sumselss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('sanitasi_sumsels_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['sanitasi_sumselss'] = $this->model_sanitasi_sumsels->get($filter, $field, $this->limit_page, $offset);
		$this->data['sanitasi_sumsels_counts'] = $this->model_sanitasi_sumsels->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/sanitasi_sumsels/index/',
			'total_rows'   => $this->model_sanitasi_sumsels->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Sanitasi Sumsels List');
		$this->render('backend/standart/administrator/sanitasi_sumsels/sanitasi_sumsels_list', $this->data);
	}
	
	/**
	* Add new sanitasi_sumselss
	*
	*/
	public function add()
	{
		$this->is_allowed('sanitasi_sumsels_add');

		$this->template->title('Sanitasi Sumsels New');
		$this->render('backend/standart/administrator/sanitasi_sumsels/sanitasi_sumsels_add', $this->data);
	}

	/**
	* Add New Sanitasi Sumselss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('sanitasi_sumsels_add', false)) {
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
		$this->form_validation->set_rules('sanitasi', 'Sanitasi', 'trim|required');
		$this->form_validation->set_rules('air_bersih', 'Air Bersih', 'trim|required');
		$this->form_validation->set_rules('kk_mbr', 'Kk Mbr', 'trim|required');
		$this->form_validation->set_rules('kk_nonmbr', 'Kk Nonmbr', 'trim|required');
		$this->form_validation->set_rules('perkebunan', 'Perkebunan', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'air_bersih_id' => $this->input->post('air_bersih_id'),
				'kabupaten_kota' => $this->input->post('kabupaten_kota'),
				'kecamatan' => $this->input->post('kecamatan'),
				'kode_wilayah' => $this->input->post('kode_wilayah'),
				'kode_kecamatan' => $this->input->post('kode_kecamatan'),
				'text_kecamatan' => $this->input->post('text_kecamatan'),
				'luas' => $this->input->post('luas'),
				'sanitasi' => $this->input->post('sanitasi'),
				'air_bersih' => $this->input->post('air_bersih'),
				'kk_mbr' => $this->input->post('kk_mbr'),
				'kk_nonmbr' => $this->input->post('kk_nonmbr'),
				'perkebunan' => $this->input->post('perkebunan'),
			];

			
			$save_sanitasi_sumsels = $this->model_sanitasi_sumsels->store($save_data);

			if ($save_sanitasi_sumsels) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_sanitasi_sumsels;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/sanitasi_sumsels/edit/' . $save_sanitasi_sumsels, 'Edit Sanitasi Sumsels'),
						anchor('administrator/sanitasi_sumsels', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/sanitasi_sumsels/edit/' . $save_sanitasi_sumsels, 'Edit Sanitasi Sumsels')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/sanitasi_sumsels');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/sanitasi_sumsels');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Sanitasi Sumselss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('sanitasi_sumsels_update');

		$this->data['sanitasi_sumsels'] = $this->model_sanitasi_sumsels->find($id);

		$this->template->title('Sanitasi Sumsels Update');
		$this->render('backend/standart/administrator/sanitasi_sumsels/sanitasi_sumsels_update', $this->data);
	}

	/**
	* Update Sanitasi Sumselss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('sanitasi_sumsels_update', false)) {
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
		$this->form_validation->set_rules('sanitasi', 'Sanitasi', 'trim|required');
		$this->form_validation->set_rules('air_bersih', 'Air Bersih', 'trim|required');
		$this->form_validation->set_rules('kk_mbr', 'Kk Mbr', 'trim|required');
		$this->form_validation->set_rules('kk_nonmbr', 'Kk Nonmbr', 'trim|required');
		$this->form_validation->set_rules('perkebunan', 'Perkebunan', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'air_bersih_id' => $this->input->post('air_bersih_id'),
				'kabupaten_kota' => $this->input->post('kabupaten_kota'),
				'kecamatan' => $this->input->post('kecamatan'),
				'kode_wilayah' => $this->input->post('kode_wilayah'),
				'kode_kecamatan' => $this->input->post('kode_kecamatan'),
				'text_kecamatan' => $this->input->post('text_kecamatan'),
				'luas' => $this->input->post('luas'),
				'sanitasi' => $this->input->post('sanitasi'),
				'air_bersih' => $this->input->post('air_bersih'),
				'kk_mbr' => $this->input->post('kk_mbr'),
				'kk_nonmbr' => $this->input->post('kk_nonmbr'),
				'perkebunan' => $this->input->post('perkebunan'),
			];

			
			$save_sanitasi_sumsels = $this->model_sanitasi_sumsels->change($id, $save_data);

			if ($save_sanitasi_sumsels) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/sanitasi_sumsels', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/sanitasi_sumsels');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/sanitasi_sumsels');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Sanitasi Sumselss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('sanitasi_sumsels_delete');

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
            set_message(cclang('has_been_deleted', 'sanitasi_sumsels'), 'success');
        } else {
            set_message(cclang('error_delete', 'sanitasi_sumsels'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Sanitasi Sumselss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('sanitasi_sumsels_view');

		$this->data['sanitasi_sumsels'] = $this->model_sanitasi_sumsels->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Sanitasi Sumsels Detail');
		$this->render('backend/standart/administrator/sanitasi_sumsels/sanitasi_sumsels_view', $this->data);
	}
	
	/**
	* delete Sanitasi Sumselss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$sanitasi_sumsels = $this->model_sanitasi_sumsels->find($id);

		
		
		return $this->model_sanitasi_sumsels->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('sanitasi_sumsels_export');

		$this->model_sanitasi_sumsels->export('sanitasi_sumsels', 'sanitasi_sumsels');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('sanitasi_sumsels_export');

		$this->model_sanitasi_sumsels->pdf('sanitasi_sumsels', 'sanitasi_sumsels');
	}
}


/* End of file sanitasi_sumsels.php */
/* Location: ./application/controllers/administrator/Sanitasi Sumsels.php */