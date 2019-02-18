<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Kawasan Kumuh Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Kawasan Kumuh site
*|
*/
class Dokumentasi_kawasan_kumuh extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_kawasan_kumuh');
	}

	/**
	* show all Dokumentasi Kawasan Kumuhs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_kawasan_kumuh_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_kawasan_kumuhs'] = $this->model_dokumentasi_kawasan_kumuh->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_kawasan_kumuh_counts'] = $this->model_dokumentasi_kawasan_kumuh->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_kawasan_kumuh/index/',
			'total_rows'   => $this->model_dokumentasi_kawasan_kumuh->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Kawasan Kumuh List');
		$this->render('backend/standart/administrator/dokumentasi_kawasan_kumuh/dokumentasi_kawasan_kumuh_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_kawasan_kumuhs
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_kawasan_kumuh_add');

		$this->template->title('Dokumentasi Kawasan Kumuh New');
		$this->render('backend/standart/administrator/dokumentasi_kawasan_kumuh/dokumentasi_kawasan_kumuh_add', $this->data);
	}

	/**
	* Add New Dokumentasi Kawasan Kumuhs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_kawasan_kumuh_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kawasan_kumuh_id', 'Nama Kawasan Kumuh', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_nama', 'Keterangan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('dokumentasi_kawasan_kumuh_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal Dokumentasi', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_kawasan_kumuh_file_uuid = $this->input->post('dokumentasi_kawasan_kumuh_file_uuid');
			$dokumentasi_kawasan_kumuh_file_name = $this->input->post('dokumentasi_kawasan_kumuh_file_name');
		
			$save_data = [
				'kawasan_kumuh_id' => $this->input->post('kawasan_kumuh_id'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_kawasan_kumuh/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_kawasan_kumuh/');
			}

			if (!empty($dokumentasi_kawasan_kumuh_file_name)) {
				$dokumentasi_kawasan_kumuh_file_name_copy = date('YmdHis') . '-' . $dokumentasi_kawasan_kumuh_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_kawasan_kumuh_file_uuid . '/' . $dokumentasi_kawasan_kumuh_file_name, 
						FCPATH . 'uploads/dokumentasi_kawasan_kumuh/' . $dokumentasi_kawasan_kumuh_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_kawasan_kumuh/' . $dokumentasi_kawasan_kumuh_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_kawasan_kumuh_file_name_copy;
			}
		
			
			$save_dokumentasi_kawasan_kumuh = $this->model_dokumentasi_kawasan_kumuh->store($save_data);

			if ($save_dokumentasi_kawasan_kumuh) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_kawasan_kumuh;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_kawasan_kumuh/edit/' . $save_dokumentasi_kawasan_kumuh, 'Edit Dokumentasi Kawasan Kumuh'),
						anchor('administrator/dokumentasi_kawasan_kumuh', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_kawasan_kumuh/edit/' . $save_dokumentasi_kawasan_kumuh, 'Edit Dokumentasi Kawasan Kumuh')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_kawasan_kumuh');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_kawasan_kumuh');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_kawasan_kumuh_update');

		$this->data['dokumentasi_kawasan_kumuh'] = $this->model_dokumentasi_kawasan_kumuh->find($id);

		$this->template->title('Dokumentasi Kawasan Kumuh Update');
		$this->render('backend/standart/administrator/dokumentasi_kawasan_kumuh/dokumentasi_kawasan_kumuh_update', $this->data);
	}

	/**
	* Update Dokumentasi Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_kawasan_kumuh_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kawasan_kumuh_id', 'Nama Kawasan Kumuh', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_nama', 'Keterangan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('dokumentasi_kawasan_kumuh_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal Dokumentasi', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_kawasan_kumuh_file_uuid = $this->input->post('dokumentasi_kawasan_kumuh_file_uuid');
			$dokumentasi_kawasan_kumuh_file_name = $this->input->post('dokumentasi_kawasan_kumuh_file_name');
		
			$save_data = [
				'kawasan_kumuh_id' => $this->input->post('kawasan_kumuh_id'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_kawasan_kumuh/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_kawasan_kumuh/');
			}

			if (!empty($dokumentasi_kawasan_kumuh_file_uuid)) {
				$dokumentasi_kawasan_kumuh_file_name_copy = date('YmdHis') . '-' . $dokumentasi_kawasan_kumuh_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_kawasan_kumuh_file_uuid . '/' . $dokumentasi_kawasan_kumuh_file_name, 
						FCPATH . 'uploads/dokumentasi_kawasan_kumuh/' . $dokumentasi_kawasan_kumuh_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_kawasan_kumuh/' . $dokumentasi_kawasan_kumuh_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_kawasan_kumuh_file_name_copy;
			}
		
			
			$save_dokumentasi_kawasan_kumuh = $this->model_dokumentasi_kawasan_kumuh->change($id, $save_data);

			if ($save_dokumentasi_kawasan_kumuh) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_kawasan_kumuh', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_kawasan_kumuh');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_kawasan_kumuh');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_kawasan_kumuh_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_kawasan_kumuh'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_kawasan_kumuh'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_kawasan_kumuh_view');

		$this->data['dokumentasi_kawasan_kumuh'] = $this->model_dokumentasi_kawasan_kumuh->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Kawasan Kumuh Detail');
		$this->render('backend/standart/administrator/dokumentasi_kawasan_kumuh/dokumentasi_kawasan_kumuh_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Kawasan Kumuhs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_kawasan_kumuh = $this->model_dokumentasi_kawasan_kumuh->find($id);

		if (!empty($dokumentasi_kawasan_kumuh->file)) {
			$path = FCPATH . '/uploads/dokumentasi_kawasan_kumuh/' . $dokumentasi_kawasan_kumuh->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_kawasan_kumuh->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Kawasan Kumuh	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_kawasan_kumuh_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_kawasan_kumuh',
		]);
	}

	/**
	* Delete Image Dokumentasi Kawasan Kumuh	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_kawasan_kumuh_delete', false)) {
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
            'table_name'        => 'dokumentasi_kawasan_kumuh',
            'primary_key'       => 'kode_dkk',
            'upload_path'       => 'uploads/dokumentasi_kawasan_kumuh/'
        ]);
	}

	/**
	* Get Image Dokumentasi Kawasan Kumuh	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_kawasan_kumuh_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_kawasan_kumuh = $this->model_dokumentasi_kawasan_kumuh->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_kawasan_kumuh',
            'primary_key'       => 'kode_dkk',
            'upload_path'       => 'uploads/dokumentasi_kawasan_kumuh/',
            'delete_endpoint'   => 'administrator/dokumentasi_kawasan_kumuh/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_kawasan_kumuh_export');

		$this->model_dokumentasi_kawasan_kumuh->export('dokumentasi_kawasan_kumuh', 'dokumentasi_kawasan_kumuh');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_kawasan_kumuh_export');

		$this->model_dokumentasi_kawasan_kumuh->pdf('dokumentasi_kawasan_kumuh', 'dokumentasi_kawasan_kumuh');
	}
}


/* End of file dokumentasi_kawasan_kumuh.php */
/* Location: ./application/controllers/administrator/Dokumentasi Kawasan Kumuh.php */