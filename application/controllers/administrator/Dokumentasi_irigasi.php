<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Irigasi Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Irigasi site
*|
*/
class Dokumentasi_irigasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_irigasi');
	}

	/**
	* show all Dokumentasi Irigasis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_irigasi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_irigasis'] = $this->model_dokumentasi_irigasi->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_irigasi_counts'] = $this->model_dokumentasi_irigasi->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_irigasi/index/',
			'total_rows'   => $this->model_dokumentasi_irigasi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Irigasi List');
		$this->render('backend/standart/administrator/dokumentasi_irigasi/dokumentasi_irigasi_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_irigasis
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_irigasi_add');

		$this->template->title('Dokumentasi Irigasi New');
		$this->render('backend/standart/administrator/dokumentasi_irigasi/dokumentasi_irigasi_add', $this->data);
	}

	/**
	* Add New Dokumentasi Irigasis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_irigasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('irigasi_id', 'Nama Irigasi', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_nama', 'Keterangan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('dokumentasi_irigasi_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal Dokumentasi', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_irigasi_file_uuid = $this->input->post('dokumentasi_irigasi_file_uuid');
			$dokumentasi_irigasi_file_name = $this->input->post('dokumentasi_irigasi_file_name');
		
			$save_data = [
				'irigasi_id' => $this->input->post('irigasi_id'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_irigasi/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_irigasi/');
			}

			if (!empty($dokumentasi_irigasi_file_name)) {
				$dokumentasi_irigasi_file_name_copy = date('YmdHis') . '-' . $dokumentasi_irigasi_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_irigasi_file_uuid . '/' . $dokumentasi_irigasi_file_name, 
						FCPATH . 'uploads/dokumentasi_irigasi/' . $dokumentasi_irigasi_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_irigasi/' . $dokumentasi_irigasi_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_irigasi_file_name_copy;
			}
		
			
			$save_dokumentasi_irigasi = $this->model_dokumentasi_irigasi->store($save_data);

			if ($save_dokumentasi_irigasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_irigasi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_irigasi/edit/' . $save_dokumentasi_irigasi, 'Edit Dokumentasi Irigasi'),
						anchor('administrator/dokumentasi_irigasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_irigasi/edit/' . $save_dokumentasi_irigasi, 'Edit Dokumentasi Irigasi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_irigasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_irigasi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Irigasis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_irigasi_update');

		$this->data['dokumentasi_irigasi'] = $this->model_dokumentasi_irigasi->find($id);

		$this->template->title('Dokumentasi Irigasi Update');
		$this->render('backend/standart/administrator/dokumentasi_irigasi/dokumentasi_irigasi_update', $this->data);
	}

	/**
	* Update Dokumentasi Irigasis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_irigasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('irigasi_id', 'Nama Irigasi', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_nama', 'Keterangan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('dokumentasi_irigasi_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal Dokumentasi', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_irigasi_file_uuid = $this->input->post('dokumentasi_irigasi_file_uuid');
			$dokumentasi_irigasi_file_name = $this->input->post('dokumentasi_irigasi_file_name');
		
			$save_data = [
				'irigasi_id' => $this->input->post('irigasi_id'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_irigasi/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_irigasi/');
			}

			if (!empty($dokumentasi_irigasi_file_uuid)) {
				$dokumentasi_irigasi_file_name_copy = date('YmdHis') . '-' . $dokumentasi_irigasi_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_irigasi_file_uuid . '/' . $dokumentasi_irigasi_file_name, 
						FCPATH . 'uploads/dokumentasi_irigasi/' . $dokumentasi_irigasi_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_irigasi/' . $dokumentasi_irigasi_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_irigasi_file_name_copy;
			}
		
			
			$save_dokumentasi_irigasi = $this->model_dokumentasi_irigasi->change($id, $save_data);

			if ($save_dokumentasi_irigasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_irigasi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_irigasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_irigasi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Irigasis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_irigasi_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_irigasi'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_irigasi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Irigasis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_irigasi_view');

		$this->data['dokumentasi_irigasi'] = $this->model_dokumentasi_irigasi->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Irigasi Detail');
		$this->render('backend/standart/administrator/dokumentasi_irigasi/dokumentasi_irigasi_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Irigasis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_irigasi = $this->model_dokumentasi_irigasi->find($id);

		if (!empty($dokumentasi_irigasi->file)) {
			$path = FCPATH . '/uploads/dokumentasi_irigasi/' . $dokumentasi_irigasi->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_irigasi->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Irigasi	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_irigasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_irigasi',
		]);
	}

	/**
	* Delete Image Dokumentasi Irigasi	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_irigasi_delete', false)) {
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
            'table_name'        => 'dokumentasi_irigasi',
            'primary_key'       => 'kode_dirigasi',
            'upload_path'       => 'uploads/dokumentasi_irigasi/'
        ]);
	}

	/**
	* Get Image Dokumentasi Irigasi	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_irigasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_irigasi = $this->model_dokumentasi_irigasi->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_irigasi',
            'primary_key'       => 'kode_dirigasi',
            'upload_path'       => 'uploads/dokumentasi_irigasi/',
            'delete_endpoint'   => 'administrator/dokumentasi_irigasi/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_irigasi_export');

		$this->model_dokumentasi_irigasi->export('dokumentasi_irigasi', 'dokumentasi_irigasi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_irigasi_export');

		$this->model_dokumentasi_irigasi->pdf('dokumentasi_irigasi', 'dokumentasi_irigasi');
	}
}


/* End of file dokumentasi_irigasi.php */
/* Location: ./application/controllers/administrator/Dokumentasi Irigasi.php */