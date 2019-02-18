<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Kawasan Kumuh Controller
*| --------------------------------------------------------------------------
*| Kawasan Kumuh site
*|
*/
class Kawasan_kumuh extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_kawasan_kumuh');
	}

	/**
	* show all Kawasan Kumuhs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('kawasan_kumuh_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['kawasan_kumuhs'] = $this->model_kawasan_kumuh->get($filter, $field, $this->limit_page, $offset);
		$this->data['kawasan_kumuh_counts'] = $this->model_kawasan_kumuh->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/kawasan_kumuh/index/',
			'total_rows'   => $this->model_kawasan_kumuh->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Kawasan Kumuh List');
		$this->render('backend/standart/administrator/kawasan_kumuh/kawasan_kumuh_list', $this->data);
	}
	
	/**
	* Add new kawasan_kumuhs
	*
	*/
	public function add()
	{
		$this->is_allowed('kawasan_kumuh_add');

		$this->template->title('Kawasan Kumuh New');
		$this->render('backend/standart/administrator/kawasan_kumuh/kawasan_kumuh_add', $this->data);
	}

	/**
	* Add New Kawasan Kumuhs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('kawasan_kumuh_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kawasan_kumuh_id', 'Kawasan Kumuh Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('tipology', 'Tipology', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('luas', 'Luas', 'trim|required');
		$this->form_validation->set_rules('no_kawasan', 'No Kawasan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_kawas', 'Nama Kawas', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('kelurahan', 'Kelurahan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tambahan', 'Tambahan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('kawasan_st', 'Kawasan St', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('peruntukan', 'Peruntukan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('wilayah_da', 'Wilayah Da', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('prioritas', 'Prioritas', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('tingkat_ke', 'Tingkat Ke', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('dampingan', 'Dampingan', 'trim|required|max_length[25]');
		$this->form_validation->set_rules('kab_kota', 'Kab Kota', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('objectid', 'Objectid', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_kaw', 'Nama Kaw', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('luas_kaw', 'Luas Kaw', 'trim|required');
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('shape_leng', 'Shape Leng', 'trim|required');
		$this->form_validation->set_rules('shape_area', 'Shape Area', 'trim|required');
		$this->form_validation->set_rules('luas_ha', 'Luas Ha', 'trim|required');
		$this->form_validation->set_rules('kawasan_ku', 'Kawasan Ku', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kawasan_kumuh_id' => $this->input->post('kawasan_kumuh_id'),
				'tipology' => $this->input->post('tipology'),
				'luas' => $this->input->post('luas'),
				'no_kawasan' => $this->input->post('no_kawasan'),
				'nama_kawas' => $this->input->post('nama_kawas'),
				'kelurahan' => $this->input->post('kelurahan'),
				'tambahan' => $this->input->post('tambahan'),
				'kawasan_st' => $this->input->post('kawasan_st'),
				'peruntukan' => $this->input->post('peruntukan'),
				'wilayah_da' => $this->input->post('wilayah_da'),
				'prioritas' => $this->input->post('prioritas'),
				'tingkat_ke' => $this->input->post('tingkat_ke'),
				'dampingan' => $this->input->post('dampingan'),
				'kab_kota' => $this->input->post('kab_kota'),
				'objectid' => $this->input->post('objectid'),
				'nama_kaw' => $this->input->post('nama_kaw'),
				'luas_kaw' => $this->input->post('luas_kaw'),
				'kecamatan' => $this->input->post('kecamatan'),
				'shape_leng' => $this->input->post('shape_leng'),
				'shape_area' => $this->input->post('shape_area'),
				'luas_ha' => $this->input->post('luas_ha'),
				'kawasan_ku' => $this->input->post('kawasan_ku'),
			];

			
			$save_kawasan_kumuh = $this->model_kawasan_kumuh->store($save_data);

			if ($save_kawasan_kumuh) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_kawasan_kumuh;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/kawasan_kumuh/edit/' . $save_kawasan_kumuh, 'Edit Kawasan Kumuh'),
						anchor('administrator/kawasan_kumuh', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/kawasan_kumuh/edit/' . $save_kawasan_kumuh, 'Edit Kawasan Kumuh')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kawasan_kumuh');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kawasan_kumuh');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('kawasan_kumuh_update');

		$this->data['kawasan_kumuh'] = $this->model_kawasan_kumuh->find($id);

		$this->template->title('Kawasan Kumuh Update');
		$this->render('backend/standart/administrator/kawasan_kumuh/kawasan_kumuh_update', $this->data);
	}

	/**
	* Update Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('kawasan_kumuh_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kawasan_kumuh_id', 'Kawasan Kumuh Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('tipology', 'Tipology', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('luas', 'Luas', 'trim|required');
		$this->form_validation->set_rules('no_kawasan', 'No Kawasan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_kawas', 'Nama Kawas', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('kelurahan', 'Kelurahan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tambahan', 'Tambahan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('kawasan_st', 'Kawasan St', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('peruntukan', 'Peruntukan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('wilayah_da', 'Wilayah Da', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('prioritas', 'Prioritas', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('tingkat_ke', 'Tingkat Ke', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('dampingan', 'Dampingan', 'trim|required|max_length[25]');
		$this->form_validation->set_rules('kab_kota', 'Kab Kota', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('objectid', 'Objectid', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('nama_kaw', 'Nama Kaw', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('luas_kaw', 'Luas Kaw', 'trim|required');
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('shape_leng', 'Shape Leng', 'trim|required');
		$this->form_validation->set_rules('shape_area', 'Shape Area', 'trim|required');
		$this->form_validation->set_rules('luas_ha', 'Luas Ha', 'trim|required');
		$this->form_validation->set_rules('kawasan_ku', 'Kawasan Ku', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kawasan_kumuh_id' => $this->input->post('kawasan_kumuh_id'),
				'tipology' => $this->input->post('tipology'),
				'luas' => $this->input->post('luas'),
				'no_kawasan' => $this->input->post('no_kawasan'),
				'nama_kawas' => $this->input->post('nama_kawas'),
				'kelurahan' => $this->input->post('kelurahan'),
				'tambahan' => $this->input->post('tambahan'),
				'kawasan_st' => $this->input->post('kawasan_st'),
				'peruntukan' => $this->input->post('peruntukan'),
				'wilayah_da' => $this->input->post('wilayah_da'),
				'prioritas' => $this->input->post('prioritas'),
				'tingkat_ke' => $this->input->post('tingkat_ke'),
				'dampingan' => $this->input->post('dampingan'),
				'kab_kota' => $this->input->post('kab_kota'),
				'objectid' => $this->input->post('objectid'),
				'nama_kaw' => $this->input->post('nama_kaw'),
				'luas_kaw' => $this->input->post('luas_kaw'),
				'kecamatan' => $this->input->post('kecamatan'),
				'shape_leng' => $this->input->post('shape_leng'),
				'shape_area' => $this->input->post('shape_area'),
				'luas_ha' => $this->input->post('luas_ha'),
				'kawasan_ku' => $this->input->post('kawasan_ku'),
			];

			
			$save_kawasan_kumuh = $this->model_kawasan_kumuh->change($id, $save_data);

			if ($save_kawasan_kumuh) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/kawasan_kumuh', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kawasan_kumuh');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kawasan_kumuh');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('kawasan_kumuh_delete');

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
            set_message(cclang('has_been_deleted', 'kawasan_kumuh'), 'success');
        } else {
            set_message(cclang('error_delete', 'kawasan_kumuh'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('kawasan_kumuh_view');

		$this->data['kawasan_kumuh'] = $this->model_kawasan_kumuh->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Kawasan Kumuh Detail');
		$this->render('backend/standart/administrator/kawasan_kumuh/kawasan_kumuh_view', $this->data);
	}
	
	/**
	* delete Kawasan Kumuhs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$kawasan_kumuh = $this->model_kawasan_kumuh->find($id);

		
		
		return $this->model_kawasan_kumuh->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('kawasan_kumuh_export');

		$this->model_kawasan_kumuh->export('kawasan_kumuh', 'kawasan_kumuh');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('kawasan_kumuh_export');

		$this->model_kawasan_kumuh->pdf('kawasan_kumuh', 'kawasan_kumuh');
	}
}


/* End of file kawasan_kumuh.php */
/* Location: ./application/controllers/administrator/Kawasan Kumuh.php */