<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Tol Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Tol site
*|
*/
class Dokumentasi_tol extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_tol');
	}

	/**
	* show all Dokumentasi Tols
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_tol_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_tols'] = $this->model_dokumentasi_tol->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_tol_counts'] = $this->model_dokumentasi_tol->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_tol/index/',
			'total_rows'   => $this->model_dokumentasi_tol->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Tol List');
		$this->render('backend/standart/administrator/dokumentasi_tol/dokumentasi_tol_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_tols
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_tol_add');

		$this->template->title('Dokumentasi Tol New');
		$this->render('backend/standart/administrator/dokumentasi_tol/dokumentasi_tol_add', $this->data);
	}

	/**
	* Add New Dokumentasi Tols
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_tol_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('tol_ln_2017_sumatera_selatan_pubtr_geoid', 'Nama Tol', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_tol_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal Dokumentasi', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_tol_file_uuid = $this->input->post('dokumentasi_tol_file_uuid');
			$dokumentasi_tol_file_name = $this->input->post('dokumentasi_tol_file_name');
		
			$save_data = [
				'tol_ln_2017_sumatera_selatan_pubtr_geoid' => $this->input->post('tol_ln_2017_sumatera_selatan_pubtr_geoid'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_tol/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_tol/');
			}

			if (!empty($dokumentasi_tol_file_name)) {
				$dokumentasi_tol_file_name_copy = date('YmdHis') . '-' . $dokumentasi_tol_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_tol_file_uuid . '/' . $dokumentasi_tol_file_name, 
						FCPATH . 'uploads/dokumentasi_tol/' . $dokumentasi_tol_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_tol/' . $dokumentasi_tol_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_tol_file_name_copy;
			}
		
			
			$save_dokumentasi_tol = $this->model_dokumentasi_tol->store($save_data);

			if ($save_dokumentasi_tol) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_tol;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_tol/edit/' . $save_dokumentasi_tol, 'Edit Dokumentasi Tol'),
						anchor('administrator/dokumentasi_tol', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_tol/edit/' . $save_dokumentasi_tol, 'Edit Dokumentasi Tol')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_tol');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_tol');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Tols
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_tol_update');

		$this->data['dokumentasi_tol'] = $this->model_dokumentasi_tol->find($id);

		$this->template->title('Dokumentasi Tol Update');
		$this->render('backend/standart/administrator/dokumentasi_tol/dokumentasi_tol_update', $this->data);
	}

	/**
	* Update Dokumentasi Tols
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_tol_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('tol_ln_2017_sumatera_selatan_pubtr_geoid', 'Nama Tol', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_tol_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Tanggal Dokumentasi', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_tol_file_uuid = $this->input->post('dokumentasi_tol_file_uuid');
			$dokumentasi_tol_file_name = $this->input->post('dokumentasi_tol_file_name');
		
			$save_data = [
				'tol_ln_2017_sumatera_selatan_pubtr_geoid' => $this->input->post('tol_ln_2017_sumatera_selatan_pubtr_geoid'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
				'dokumentasi_nama' => $this->input->post('dokumentasi_nama'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_tol/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_tol/');
			}

			if (!empty($dokumentasi_tol_file_uuid)) {
				$dokumentasi_tol_file_name_copy = date('YmdHis') . '-' . $dokumentasi_tol_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_tol_file_uuid . '/' . $dokumentasi_tol_file_name, 
						FCPATH . 'uploads/dokumentasi_tol/' . $dokumentasi_tol_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_tol/' . $dokumentasi_tol_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_tol_file_name_copy;
			}
		
			
			$save_dokumentasi_tol = $this->model_dokumentasi_tol->change($id, $save_data);

			if ($save_dokumentasi_tol) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_tol', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_tol');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_tol');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Tols
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_tol_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_tol'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_tol'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Tols
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_tol_view');

		$this->data['dokumentasi_tol'] = $this->model_dokumentasi_tol->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Tol Detail');
		$this->render('backend/standart/administrator/dokumentasi_tol/dokumentasi_tol_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Tols
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_tol = $this->model_dokumentasi_tol->find($id);

		if (!empty($dokumentasi_tol->file)) {
			$path = FCPATH . '/uploads/dokumentasi_tol/' . $dokumentasi_tol->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_tol->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Tol	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_tol_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_tol',
		]);
	}

	/**
	* Delete Image Dokumentasi Tol	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_tol_delete', false)) {
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
            'table_name'        => 'dokumentasi_tol',
            'primary_key'       => 'kode_dtl',
            'upload_path'       => 'uploads/dokumentasi_tol/'
        ]);
	}

	/**
	* Get Image Dokumentasi Tol	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_tol_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_tol = $this->model_dokumentasi_tol->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_tol',
            'primary_key'       => 'kode_dtl',
            'upload_path'       => 'uploads/dokumentasi_tol/',
            'delete_endpoint'   => 'administrator/dokumentasi_tol/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_tol_export');

		$this->model_dokumentasi_tol->export('dokumentasi_tol', 'dokumentasi_tol');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_tol_export');

		$this->model_dokumentasi_tol->pdf('dokumentasi_tol', 'dokumentasi_tol');
	}
}


/* End of file dokumentasi_tol.php */
/* Location: ./application/controllers/administrator/Dokumentasi Tol.php */