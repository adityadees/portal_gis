<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Bendungan Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Bendungan site
*|
*/
class Dokumentasi_bendungan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_bendungan');
	}

	/**
	* show all Dokumentasi Bendungans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_bendungan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_bendungans'] = $this->model_dokumentasi_bendungan->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_bendungan_counts'] = $this->model_dokumentasi_bendungan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_bendungan/index/',
			'total_rows'   => $this->model_dokumentasi_bendungan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Bendungan List');
		$this->render('backend/standart/administrator/dokumentasi_bendungan/dokumentasi_bendungan_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_bendungans
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_bendungan_add');

		$this->template->title('Dokumentasi Bendungan New');
		$this->render('backend/standart/administrator/dokumentasi_bendungan/dokumentasi_bendungan_add', $this->data);
	}

	/**
	* Add New Dokumentasi Bendungans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_bendungan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('bendung_disumsel_id', 'Nama Bendungan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_bendungan_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal Dokumentasi', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_bendungan_file_uuid = $this->input->post('dokumentasi_bendungan_file_uuid');
			$dokumentasi_bendungan_file_name = $this->input->post('dokumentasi_bendungan_file_name');
		
			$save_data = [
				'bendung_disumsel_id' => $this->input->post('bendung_disumsel_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_bendungan/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_bendungan/');
			}

			if (!empty($dokumentasi_bendungan_file_name)) {
				$dokumentasi_bendungan_file_name_copy = date('YmdHis') . '-' . $dokumentasi_bendungan_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_bendungan_file_uuid . '/' . $dokumentasi_bendungan_file_name, 
						FCPATH . 'uploads/dokumentasi_bendungan/' . $dokumentasi_bendungan_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_bendungan/' . $dokumentasi_bendungan_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_bendungan_file_name_copy;
			}
		
			
			$save_dokumentasi_bendungan = $this->model_dokumentasi_bendungan->store($save_data);

			if ($save_dokumentasi_bendungan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_bendungan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_bendungan/edit/' . $save_dokumentasi_bendungan, 'Edit Dokumentasi Bendungan'),
						anchor('administrator/dokumentasi_bendungan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_bendungan/edit/' . $save_dokumentasi_bendungan, 'Edit Dokumentasi Bendungan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_bendungan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_bendungan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Bendungans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_bendungan_update');

		$this->data['dokumentasi_bendungan'] = $this->model_dokumentasi_bendungan->find($id);

		$this->template->title('Dokumentasi Bendungan Update');
		$this->render('backend/standart/administrator/dokumentasi_bendungan/dokumentasi_bendungan_update', $this->data);
	}

	/**
	* Update Dokumentasi Bendungans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_bendungan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('bendung_disumsel_id', 'Nama Bendungan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_bendungan_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal Dokumentasi', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_bendungan_file_uuid = $this->input->post('dokumentasi_bendungan_file_uuid');
			$dokumentasi_bendungan_file_name = $this->input->post('dokumentasi_bendungan_file_name');
		
			$save_data = [
				'bendung_disumsel_id' => $this->input->post('bendung_disumsel_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_bendungan/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_bendungan/');
			}

			if (!empty($dokumentasi_bendungan_file_uuid)) {
				$dokumentasi_bendungan_file_name_copy = date('YmdHis') . '-' . $dokumentasi_bendungan_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_bendungan_file_uuid . '/' . $dokumentasi_bendungan_file_name, 
						FCPATH . 'uploads/dokumentasi_bendungan/' . $dokumentasi_bendungan_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_bendungan/' . $dokumentasi_bendungan_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_bendungan_file_name_copy;
			}
		
			
			$save_dokumentasi_bendungan = $this->model_dokumentasi_bendungan->change($id, $save_data);

			if ($save_dokumentasi_bendungan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_bendungan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_bendungan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_bendungan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Bendungans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_bendungan_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_bendungan'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_bendungan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Bendungans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_bendungan_view');

		$this->data['dokumentasi_bendungan'] = $this->model_dokumentasi_bendungan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Bendungan Detail');
		$this->render('backend/standart/administrator/dokumentasi_bendungan/dokumentasi_bendungan_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Bendungans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_bendungan = $this->model_dokumentasi_bendungan->find($id);

		if (!empty($dokumentasi_bendungan->file)) {
			$path = FCPATH . '/uploads/dokumentasi_bendungan/' . $dokumentasi_bendungan->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_bendungan->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Bendungan	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_bendungan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_bendungan',
		]);
	}

	/**
	* Delete Image Dokumentasi Bendungan	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_bendungan_delete', false)) {
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
            'table_name'        => 'dokumentasi_bendungan',
            'primary_key'       => 'kode_dbd',
            'upload_path'       => 'uploads/dokumentasi_bendungan/'
        ]);
	}

	/**
	* Get Image Dokumentasi Bendungan	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_bendungan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_bendungan = $this->model_dokumentasi_bendungan->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_bendungan',
            'primary_key'       => 'kode_dbd',
            'upload_path'       => 'uploads/dokumentasi_bendungan/',
            'delete_endpoint'   => 'administrator/dokumentasi_bendungan/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_bendungan_export');

		$this->model_dokumentasi_bendungan->export('dokumentasi_bendungan', 'dokumentasi_bendungan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_bendungan_export');

		$this->model_dokumentasi_bendungan->pdf('dokumentasi_bendungan', 'dokumentasi_bendungan');
	}
}


/* End of file dokumentasi_bendungan.php */
/* Location: ./application/controllers/administrator/Dokumentasi Bendungan.php */