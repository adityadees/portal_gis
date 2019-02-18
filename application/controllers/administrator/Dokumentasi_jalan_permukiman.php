<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Jalan Permukiman Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Jalan Permukiman site
*|
*/
class Dokumentasi_jalan_permukiman extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_jalan_permukiman');
	}

	/**
	* show all Dokumentasi Jalan Permukimans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_jalan_permukiman_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_jalan_permukimans'] = $this->model_dokumentasi_jalan_permukiman->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_jalan_permukiman_counts'] = $this->model_dokumentasi_jalan_permukiman->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_jalan_permukiman/index/',
			'total_rows'   => $this->model_dokumentasi_jalan_permukiman->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Jalan Permukiman List');
		$this->render('backend/standart/administrator/dokumentasi_jalan_permukiman/dokumentasi_jalan_permukiman_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_jalan_permukimans
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_jalan_permukiman_add');

		$this->template->title('Dokumentasi Jalan Permukiman New');
		$this->render('backend/standart/administrator/dokumentasi_jalan_permukiman/dokumentasi_jalan_permukiman_add', $this->data);
	}

	/**
	* Add New Dokumentasi Jalan Permukimans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_jalan_permukiman_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('dokumentasi_jalan_id', 'Nama Daerah', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_nama', 'Keterangan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('dokumentasi_jalan_permukiman_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal Dokumen', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_jalan_permukiman_file_uuid = $this->input->post('dokumentasi_jalan_permukiman_file_uuid');
			$dokumentasi_jalan_permukiman_file_name = $this->input->post('dokumentasi_jalan_permukiman_file_name');
		
			$save_data = [
				'dokumentasi_jalan_id' => $this->input->post('dokumentasi_jalan_id'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_jalan_permukiman/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_jalan_permukiman/');
			}

			if (!empty($dokumentasi_jalan_permukiman_file_name)) {
				$dokumentasi_jalan_permukiman_file_name_copy = date('YmdHis') . '-' . $dokumentasi_jalan_permukiman_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_jalan_permukiman_file_uuid . '/' . $dokumentasi_jalan_permukiman_file_name, 
						FCPATH . 'uploads/dokumentasi_jalan_permukiman/' . $dokumentasi_jalan_permukiman_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_jalan_permukiman/' . $dokumentasi_jalan_permukiman_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_jalan_permukiman_file_name_copy;
			}
		
			
			$save_dokumentasi_jalan_permukiman = $this->model_dokumentasi_jalan_permukiman->store($save_data);

			if ($save_dokumentasi_jalan_permukiman) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_jalan_permukiman;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_jalan_permukiman/edit/' . $save_dokumentasi_jalan_permukiman, 'Edit Dokumentasi Jalan Permukiman'),
						anchor('administrator/dokumentasi_jalan_permukiman', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_jalan_permukiman/edit/' . $save_dokumentasi_jalan_permukiman, 'Edit Dokumentasi Jalan Permukiman')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_jalan_permukiman');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_jalan_permukiman');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Jalan Permukimans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_jalan_permukiman_update');

		$this->data['dokumentasi_jalan_permukiman'] = $this->model_dokumentasi_jalan_permukiman->find($id);

		$this->template->title('Dokumentasi Jalan Permukiman Update');
		$this->render('backend/standart/administrator/dokumentasi_jalan_permukiman/dokumentasi_jalan_permukiman_update', $this->data);
	}

	/**
	* Update Dokumentasi Jalan Permukimans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_jalan_permukiman_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('dokumentasi_jalan_id', 'Nama Daerah', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_nama', 'Keterangan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('dokumentasi_jalan_permukiman_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal Dokumen', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_jalan_permukiman_file_uuid = $this->input->post('dokumentasi_jalan_permukiman_file_uuid');
			$dokumentasi_jalan_permukiman_file_name = $this->input->post('dokumentasi_jalan_permukiman_file_name');
		
			$save_data = [
				'dokumentasi_jalan_id' => $this->input->post('dokumentasi_jalan_id'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_jalan_permukiman/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_jalan_permukiman/');
			}

			if (!empty($dokumentasi_jalan_permukiman_file_uuid)) {
				$dokumentasi_jalan_permukiman_file_name_copy = date('YmdHis') . '-' . $dokumentasi_jalan_permukiman_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_jalan_permukiman_file_uuid . '/' . $dokumentasi_jalan_permukiman_file_name, 
						FCPATH . 'uploads/dokumentasi_jalan_permukiman/' . $dokumentasi_jalan_permukiman_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_jalan_permukiman/' . $dokumentasi_jalan_permukiman_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_jalan_permukiman_file_name_copy;
			}
		
			
			$save_dokumentasi_jalan_permukiman = $this->model_dokumentasi_jalan_permukiman->change($id, $save_data);

			if ($save_dokumentasi_jalan_permukiman) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_jalan_permukiman', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_jalan_permukiman');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_jalan_permukiman');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Jalan Permukimans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_jalan_permukiman_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_jalan_permukiman'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_jalan_permukiman'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Jalan Permukimans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_jalan_permukiman_view');

		$this->data['dokumentasi_jalan_permukiman'] = $this->model_dokumentasi_jalan_permukiman->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Jalan Permukiman Detail');
		$this->render('backend/standart/administrator/dokumentasi_jalan_permukiman/dokumentasi_jalan_permukiman_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Jalan Permukimans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_jalan_permukiman = $this->model_dokumentasi_jalan_permukiman->find($id);

		if (!empty($dokumentasi_jalan_permukiman->file)) {
			$path = FCPATH . '/uploads/dokumentasi_jalan_permukiman/' . $dokumentasi_jalan_permukiman->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_jalan_permukiman->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Jalan Permukiman	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_jalan_permukiman_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_jalan_permukiman',
		]);
	}

	/**
	* Delete Image Dokumentasi Jalan Permukiman	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_jalan_permukiman_delete', false)) {
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
            'table_name'        => 'dokumentasi_jalan_permukiman',
            'primary_key'       => 'kode_dj',
            'upload_path'       => 'uploads/dokumentasi_jalan_permukiman/'
        ]);
	}

	/**
	* Get Image Dokumentasi Jalan Permukiman	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_jalan_permukiman_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_jalan_permukiman = $this->model_dokumentasi_jalan_permukiman->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_jalan_permukiman',
            'primary_key'       => 'kode_dj',
            'upload_path'       => 'uploads/dokumentasi_jalan_permukiman/',
            'delete_endpoint'   => 'administrator/dokumentasi_jalan_permukiman/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_jalan_permukiman_export');

		$this->model_dokumentasi_jalan_permukiman->export('dokumentasi_jalan_permukiman', 'dokumentasi_jalan_permukiman');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_jalan_permukiman_export');

		$this->model_dokumentasi_jalan_permukiman->pdf('dokumentasi_jalan_permukiman', 'dokumentasi_jalan_permukiman');
	}
}


/* End of file dokumentasi_jalan_permukiman.php */
/* Location: ./application/controllers/administrator/Dokumentasi Jalan Permukiman.php */