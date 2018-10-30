<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Tambah Dokumentasi Controller
*| --------------------------------------------------------------------------
*| Form Tambah Dokumentasi site
*|
*/
class Form_tambah_dokumentasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_tambah_dokumentasi');
	}

	/**
	* Submit Form Tambah Dokumentasis
	*
	*/
	public function submit()
	{
		$this->form_validation->set_rules('form_tambah_dokumentasi_file_name', 'File', 'trim|required');
		
		if ($this->form_validation->run()) {
			$form_tambah_dokumentasi_file_uuid = $this->input->post('form_tambah_dokumentasi_file_uuid');
			$form_tambah_dokumentasi_file_name = $this->input->post('form_tambah_dokumentasi_file_name');
		
			$save_data = [
				'file' => $this->input->post('file'),
			];

			if (!is_dir(FCPATH . '/uploads/form_tambah_dokumentasi/')) {
				mkdir(FCPATH . '/uploads/form_tambah_dokumentasi/');
			}

			if (!empty($form_tambah_dokumentasi_file_uuid)) {
				$form_tambah_dokumentasi_file_name_copy = date('YmdHis') . '-' . $form_tambah_dokumentasi_file_name;

				rename(FCPATH . 'uploads/tmp/' . $form_tambah_dokumentasi_file_uuid . '/' . $form_tambah_dokumentasi_file_name, 
						FCPATH . 'uploads/form_tambah_dokumentasi/' . $form_tambah_dokumentasi_file_name_copy);

				if (!is_file(FCPATH . '/uploads/form_tambah_dokumentasi/' . $form_tambah_dokumentasi_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $form_tambah_dokumentasi_file_name_copy;
			}
		
			
			$save_form_tambah_dokumentasi = $this->model_form_tambah_dokumentasi->store($save_data);

			$this->data['success'] = true;
			$this->data['id'] 	   = $save_form_tambah_dokumentasi;
			$this->data['message'] = cclang('your_data_has_been_successfully_submitted');
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	
	/**
	* Upload Image Form Tambah Dokumentasi	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'form_tambah_dokumentasi',
		]);
	}

	/**
	* Delete Image Form Tambah Dokumentasi	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'file', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'form_tambah_dokumentasi',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/form_tambah_dokumentasi/'
        ]);
	}

	/**
	* Get Image Form Tambah Dokumentasi	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		$form_tambah_dokumentasi = $this->model_form_tambah_dokumentasi->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'form_tambah_dokumentasi',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/form_tambah_dokumentasi/',
            'delete_endpoint'   => 'administrator/form_tambah_dokumentasi/delete_file_file'
        ]);
	}
	
}


/* End of file form_tambah_dokumentasi.php */
/* Location: ./application/controllers/administrator/Form Tambah Dokumentasi.php */