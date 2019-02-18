<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Air Bersih Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Air Bersih site
*|
*/
class Dokumentasi_air_bersih extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_air_bersih');
	}

	/**
	* show all Dokumentasi Air Bersihs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_air_bersih_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_air_bersihs'] = $this->model_dokumentasi_air_bersih->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_air_bersih_counts'] = $this->model_dokumentasi_air_bersih->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_air_bersih/index/',
			'total_rows'   => $this->model_dokumentasi_air_bersih->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Air Bersih List');
		$this->render('backend/standart/administrator/dokumentasi_air_bersih/dokumentasi_air_bersih_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_air_bersihs
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_air_bersih_add');

		$this->template->title('Dokumentasi Air Bersih New');
		$this->render('backend/standart/administrator/dokumentasi_air_bersih/dokumentasi_air_bersih_add', $this->data);
	}

	/**
	* Add New Dokumentasi Air Bersihs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_air_bersih_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('air_bersih_sumsel_id', 'Nama Air Bersih', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_air_bersih_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_air_bersih_file_uuid = $this->input->post('dokumentasi_air_bersih_file_uuid');
			$dokumentasi_air_bersih_file_name = $this->input->post('dokumentasi_air_bersih_file_name');
		
			$save_data = [
				'air_bersih_sumsel_id' => $this->input->post('air_bersih_sumsel_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_air_bersih/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_air_bersih/');
			}

			if (!empty($dokumentasi_air_bersih_file_name)) {
				$dokumentasi_air_bersih_file_name_copy = date('YmdHis') . '-' . $dokumentasi_air_bersih_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_air_bersih_file_uuid . '/' . $dokumentasi_air_bersih_file_name, 
						FCPATH . 'uploads/dokumentasi_air_bersih/' . $dokumentasi_air_bersih_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_air_bersih/' . $dokumentasi_air_bersih_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_air_bersih_file_name_copy;
			}
		
			
			$save_dokumentasi_air_bersih = $this->model_dokumentasi_air_bersih->store($save_data);

			if ($save_dokumentasi_air_bersih) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_air_bersih;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_air_bersih/edit/' . $save_dokumentasi_air_bersih, 'Edit Dokumentasi Air Bersih'),
						anchor('administrator/dokumentasi_air_bersih', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_air_bersih/edit/' . $save_dokumentasi_air_bersih, 'Edit Dokumentasi Air Bersih')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_air_bersih');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_air_bersih');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Air Bersihs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_air_bersih_update');

		$this->data['dokumentasi_air_bersih'] = $this->model_dokumentasi_air_bersih->find($id);

		$this->template->title('Dokumentasi Air Bersih Update');
		$this->render('backend/standart/administrator/dokumentasi_air_bersih/dokumentasi_air_bersih_update', $this->data);
	}

	/**
	* Update Dokumentasi Air Bersihs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_air_bersih_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('air_bersih_sumsel_id', 'Nama Air Bersih', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_air_bersih_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_air_bersih_file_uuid = $this->input->post('dokumentasi_air_bersih_file_uuid');
			$dokumentasi_air_bersih_file_name = $this->input->post('dokumentasi_air_bersih_file_name');
		
			$save_data = [
				'air_bersih_sumsel_id' => $this->input->post('air_bersih_sumsel_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_air_bersih/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_air_bersih/');
			}

			if (!empty($dokumentasi_air_bersih_file_uuid)) {
				$dokumentasi_air_bersih_file_name_copy = date('YmdHis') . '-' . $dokumentasi_air_bersih_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_air_bersih_file_uuid . '/' . $dokumentasi_air_bersih_file_name, 
						FCPATH . 'uploads/dokumentasi_air_bersih/' . $dokumentasi_air_bersih_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_air_bersih/' . $dokumentasi_air_bersih_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_air_bersih_file_name_copy;
			}
		
			
			$save_dokumentasi_air_bersih = $this->model_dokumentasi_air_bersih->change($id, $save_data);

			if ($save_dokumentasi_air_bersih) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_air_bersih', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_air_bersih');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_air_bersih');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Air Bersihs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_air_bersih_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_air_bersih'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_air_bersih'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Air Bersihs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_air_bersih_view');

		$this->data['dokumentasi_air_bersih'] = $this->model_dokumentasi_air_bersih->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Air Bersih Detail');
		$this->render('backend/standart/administrator/dokumentasi_air_bersih/dokumentasi_air_bersih_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Air Bersihs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_air_bersih = $this->model_dokumentasi_air_bersih->find($id);

		if (!empty($dokumentasi_air_bersih->file)) {
			$path = FCPATH . '/uploads/dokumentasi_air_bersih/' . $dokumentasi_air_bersih->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_air_bersih->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Air Bersih	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_air_bersih_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_air_bersih',
		]);
	}

	/**
	* Delete Image Dokumentasi Air Bersih	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_air_bersih_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'file', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'dokumentasi_air_bersih',
            'primary_key'       => 'kode_dabs',
            'upload_path'       => 'uploads/dokumentasi_air_bersih/'
        ]);
	}

	/**
	* Get Image Dokumentasi Air Bersih	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_air_bersih_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_air_bersih = $this->model_dokumentasi_air_bersih->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_air_bersih',
            'primary_key'       => 'kode_dabs',
            'upload_path'       => 'uploads/dokumentasi_air_bersih/',
            'delete_endpoint'   => 'administrator/dokumentasi_air_bersih/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_air_bersih_export');

		$this->model_dokumentasi_air_bersih->export('dokumentasi_air_bersih', 'dokumentasi_air_bersih');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_air_bersih_export');

		$this->model_dokumentasi_air_bersih->pdf('dokumentasi_air_bersih', 'dokumentasi_air_bersih');
	}
}


/* End of file dokumentasi_air_bersih.php */
/* Location: ./application/controllers/administrator/Dokumentasi Air Bersih.php */