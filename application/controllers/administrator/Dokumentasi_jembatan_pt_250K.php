<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Jembatan Pt 250K Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Jembatan Pt 250K site
*|
*/
class Dokumentasi_jembatan_pt_250K extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_jembatan_pt_250K');
	}

	/**
	* show all Dokumentasi Jembatan Pt 250Ks
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_jembatan_pt_250K_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_jembatan_pt_250Ks'] = $this->model_dokumentasi_jembatan_pt_250K->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_jembatan_pt_250K_counts'] = $this->model_dokumentasi_jembatan_pt_250K->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_jembatan_pt_250K/index/',
			'total_rows'   => $this->model_dokumentasi_jembatan_pt_250K->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Jembatan Pt 250K List');
		$this->render('backend/standart/administrator/dokumentasi_jembatan_pt_250K/dokumentasi_jembatan_pt_250K_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_jembatan_pt_250Ks
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_jembatan_pt_250K_add');

		$this->template->title('Dokumentasi Jembatan Pt 250K New');
		$this->render('backend/standart/administrator/dokumentasi_jembatan_pt_250K/dokumentasi_jembatan_pt_250K_add', $this->data);
	}

	/**
	* Add New Dokumentasi Jembatan Pt 250Ks
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_jembatan_pt_250K_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('embatan_pt_250K_id', 'Embatan Pt 250K Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_jembatan_pt_250K_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_jembatan_pt_250K_file_uuid = $this->input->post('dokumentasi_jembatan_pt_250K_file_uuid');
			$dokumentasi_jembatan_pt_250K_file_name = $this->input->post('dokumentasi_jembatan_pt_250K_file_name');
		
			$save_data = [
				'embatan_pt_250K_id' => $this->input->post('embatan_pt_250K_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_jembatan_pt_250K/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_jembatan_pt_250K/');
			}

			if (!empty($dokumentasi_jembatan_pt_250K_file_name)) {
				$dokumentasi_jembatan_pt_250K_file_name_copy = date('YmdHis') . '-' . $dokumentasi_jembatan_pt_250K_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_jembatan_pt_250K_file_uuid . '/' . $dokumentasi_jembatan_pt_250K_file_name, 
						FCPATH . 'uploads/dokumentasi_jembatan_pt_250K/' . $dokumentasi_jembatan_pt_250K_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_jembatan_pt_250K/' . $dokumentasi_jembatan_pt_250K_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_jembatan_pt_250K_file_name_copy;
			}
		
			
			$save_dokumentasi_jembatan_pt_250K = $this->model_dokumentasi_jembatan_pt_250K->store($save_data);

			if ($save_dokumentasi_jembatan_pt_250K) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_jembatan_pt_250K;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_jembatan_pt_250K/edit/' . $save_dokumentasi_jembatan_pt_250K, 'Edit Dokumentasi Jembatan Pt 250K'),
						anchor('administrator/dokumentasi_jembatan_pt_250K', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_jembatan_pt_250K/edit/' . $save_dokumentasi_jembatan_pt_250K, 'Edit Dokumentasi Jembatan Pt 250K')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_jembatan_pt_250K');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_jembatan_pt_250K');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Jembatan Pt 250Ks
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_jembatan_pt_250K_update');

		$this->data['dokumentasi_jembatan_pt_250K'] = $this->model_dokumentasi_jembatan_pt_250K->find($id);

		$this->template->title('Dokumentasi Jembatan Pt 250K Update');
		$this->render('backend/standart/administrator/dokumentasi_jembatan_pt_250K/dokumentasi_jembatan_pt_250K_update', $this->data);
	}

	/**
	* Update Dokumentasi Jembatan Pt 250Ks
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_jembatan_pt_250K_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('embatan_pt_250K_id', 'Embatan Pt 250K Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_jembatan_pt_250K_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_jembatan_pt_250K_file_uuid = $this->input->post('dokumentasi_jembatan_pt_250K_file_uuid');
			$dokumentasi_jembatan_pt_250K_file_name = $this->input->post('dokumentasi_jembatan_pt_250K_file_name');
		
			$save_data = [
				'embatan_pt_250K_id' => $this->input->post('embatan_pt_250K_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_jembatan_pt_250K/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_jembatan_pt_250K/');
			}

			if (!empty($dokumentasi_jembatan_pt_250K_file_uuid)) {
				$dokumentasi_jembatan_pt_250K_file_name_copy = date('YmdHis') . '-' . $dokumentasi_jembatan_pt_250K_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_jembatan_pt_250K_file_uuid . '/' . $dokumentasi_jembatan_pt_250K_file_name, 
						FCPATH . 'uploads/dokumentasi_jembatan_pt_250K/' . $dokumentasi_jembatan_pt_250K_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_jembatan_pt_250K/' . $dokumentasi_jembatan_pt_250K_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_jembatan_pt_250K_file_name_copy;
			}
		
			
			$save_dokumentasi_jembatan_pt_250K = $this->model_dokumentasi_jembatan_pt_250K->change($id, $save_data);

			if ($save_dokumentasi_jembatan_pt_250K) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_jembatan_pt_250K', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_jembatan_pt_250K');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_jembatan_pt_250K');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Jembatan Pt 250Ks
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_jembatan_pt_250K_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_jembatan_pt_250K'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_jembatan_pt_250K'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Jembatan Pt 250Ks
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_jembatan_pt_250K_view');

		$this->data['dokumentasi_jembatan_pt_250K'] = $this->model_dokumentasi_jembatan_pt_250K->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Jembatan Pt 250K Detail');
		$this->render('backend/standart/administrator/dokumentasi_jembatan_pt_250K/dokumentasi_jembatan_pt_250K_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Jembatan Pt 250Ks
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_jembatan_pt_250K = $this->model_dokumentasi_jembatan_pt_250K->find($id);

		if (!empty($dokumentasi_jembatan_pt_250K->file)) {
			$path = FCPATH . '/uploads/dokumentasi_jembatan_pt_250K/' . $dokumentasi_jembatan_pt_250K->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_jembatan_pt_250K->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Jembatan Pt 250K	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_jembatan_pt_250K_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_jembatan_pt_250K',
			'allowed_types' => 'jpg|png',
		]);
	}

	/**
	* Delete Image Dokumentasi Jembatan Pt 250K	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_jembatan_pt_250K_delete', false)) {
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
            'table_name'        => 'dokumentasi_jembatan_pt_250K',
            'primary_key'       => 'kode_djpt',
            'upload_path'       => 'uploads/dokumentasi_jembatan_pt_250K/'
        ]);
	}

	/**
	* Get Image Dokumentasi Jembatan Pt 250K	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_jembatan_pt_250K_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_jembatan_pt_250K = $this->model_dokumentasi_jembatan_pt_250K->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_jembatan_pt_250K',
            'primary_key'       => 'kode_djpt',
            'upload_path'       => 'uploads/dokumentasi_jembatan_pt_250K/',
            'delete_endpoint'   => 'administrator/dokumentasi_jembatan_pt_250K/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_jembatan_pt_250K_export');

		$this->model_dokumentasi_jembatan_pt_250K->export('dokumentasi_jembatan_pt_250K', 'dokumentasi_jembatan_pt_250K');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_jembatan_pt_250K_export');

		$this->model_dokumentasi_jembatan_pt_250K->pdf('dokumentasi_jembatan_pt_250K', 'dokumentasi_jembatan_pt_250K');
	}
}


/* End of file dokumentasi_jembatan_pt_250K.php */
/* Location: ./application/controllers/administrator/Dokumentasi Jembatan Pt 250K.php */