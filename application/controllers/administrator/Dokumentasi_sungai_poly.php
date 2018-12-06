<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Sungai Poly Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Sungai Poly site
*|
*/
class Dokumentasi_sungai_poly extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_sungai_poly');
	}

	/**
	* show all Dokumentasi Sungai Polys
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_sungai_poly_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_sungai_polys'] = $this->model_dokumentasi_sungai_poly->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_sungai_poly_counts'] = $this->model_dokumentasi_sungai_poly->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_sungai_poly/index/',
			'total_rows'   => $this->model_dokumentasi_sungai_poly->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Sungai Poly List');
		$this->render('backend/standart/administrator/dokumentasi_sungai_poly/dokumentasi_sungai_poly_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_sungai_polys
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_sungai_poly_add');

		$this->template->title('Dokumentasi Sungai Poly New');
		$this->render('backend/standart/administrator/dokumentasi_sungai_poly/dokumentasi_sungai_poly_add', $this->data);
	}

	/**
	* Add New Dokumentasi Sungai Polys
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_sungai_poly_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('sungai_poly_id', 'Sungai Poly Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_sungai_poly_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_sungai_poly_file_uuid = $this->input->post('dokumentasi_sungai_poly_file_uuid');
			$dokumentasi_sungai_poly_file_name = $this->input->post('dokumentasi_sungai_poly_file_name');
		
			$save_data = [
				'sungai_poly_id' => $this->input->post('sungai_poly_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_sungai_poly/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_sungai_poly/');
			}

			if (!empty($dokumentasi_sungai_poly_file_name)) {
				$dokumentasi_sungai_poly_file_name_copy = date('YmdHis') . '-' . $dokumentasi_sungai_poly_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_sungai_poly_file_uuid . '/' . $dokumentasi_sungai_poly_file_name, 
						FCPATH . 'uploads/dokumentasi_sungai_poly/' . $dokumentasi_sungai_poly_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_sungai_poly/' . $dokumentasi_sungai_poly_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_sungai_poly_file_name_copy;
			}
		
			
			$save_dokumentasi_sungai_poly = $this->model_dokumentasi_sungai_poly->store($save_data);

			if ($save_dokumentasi_sungai_poly) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_sungai_poly;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_sungai_poly/edit/' . $save_dokumentasi_sungai_poly, 'Edit Dokumentasi Sungai Poly'),
						anchor('administrator/dokumentasi_sungai_poly', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_sungai_poly/edit/' . $save_dokumentasi_sungai_poly, 'Edit Dokumentasi Sungai Poly')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_sungai_poly');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_sungai_poly');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Sungai Polys
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_sungai_poly_update');

		$this->data['dokumentasi_sungai_poly'] = $this->model_dokumentasi_sungai_poly->find($id);

		$this->template->title('Dokumentasi Sungai Poly Update');
		$this->render('backend/standart/administrator/dokumentasi_sungai_poly/dokumentasi_sungai_poly_update', $this->data);
	}

	/**
	* Update Dokumentasi Sungai Polys
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_sungai_poly_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('sungai_poly_id', 'Sungai Poly Id', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('dokumentasi_sungai_poly_file_name', 'File', 'trim|required');
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_sungai_poly_file_uuid = $this->input->post('dokumentasi_sungai_poly_file_uuid');
			$dokumentasi_sungai_poly_file_name = $this->input->post('dokumentasi_sungai_poly_file_name');
		
			$save_data = [
				'sungai_poly_id' => $this->input->post('sungai_poly_id'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_sungai_poly/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_sungai_poly/');
			}

			if (!empty($dokumentasi_sungai_poly_file_uuid)) {
				$dokumentasi_sungai_poly_file_name_copy = date('YmdHis') . '-' . $dokumentasi_sungai_poly_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_sungai_poly_file_uuid . '/' . $dokumentasi_sungai_poly_file_name, 
						FCPATH . 'uploads/dokumentasi_sungai_poly/' . $dokumentasi_sungai_poly_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_sungai_poly/' . $dokumentasi_sungai_poly_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_sungai_poly_file_name_copy;
			}
		
			
			$save_dokumentasi_sungai_poly = $this->model_dokumentasi_sungai_poly->change($id, $save_data);

			if ($save_dokumentasi_sungai_poly) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_sungai_poly', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_sungai_poly');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_sungai_poly');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Sungai Polys
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_sungai_poly_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_sungai_poly'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_sungai_poly'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Sungai Polys
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_sungai_poly_view');

		$this->data['dokumentasi_sungai_poly'] = $this->model_dokumentasi_sungai_poly->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Sungai Poly Detail');
		$this->render('backend/standart/administrator/dokumentasi_sungai_poly/dokumentasi_sungai_poly_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Sungai Polys
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_sungai_poly = $this->model_dokumentasi_sungai_poly->find($id);

		if (!empty($dokumentasi_sungai_poly->file)) {
			$path = FCPATH . '/uploads/dokumentasi_sungai_poly/' . $dokumentasi_sungai_poly->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_sungai_poly->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Sungai Poly	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_sungai_poly_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_sungai_poly',
			'allowed_types' => 'jpg|png',
		]);
	}

	/**
	* Delete Image Dokumentasi Sungai Poly	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_sungai_poly_delete', false)) {
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
            'table_name'        => 'dokumentasi_sungai_poly',
            'primary_key'       => 'kode_dsp',
            'upload_path'       => 'uploads/dokumentasi_sungai_poly/'
        ]);
	}

	/**
	* Get Image Dokumentasi Sungai Poly	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_sungai_poly_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_sungai_poly = $this->model_dokumentasi_sungai_poly->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_sungai_poly',
            'primary_key'       => 'kode_dsp',
            'upload_path'       => 'uploads/dokumentasi_sungai_poly/',
            'delete_endpoint'   => 'administrator/dokumentasi_sungai_poly/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_sungai_poly_export');

		$this->model_dokumentasi_sungai_poly->export('dokumentasi_sungai_poly', 'dokumentasi_sungai_poly');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_sungai_poly_export');

		$this->model_dokumentasi_sungai_poly->pdf('dokumentasi_sungai_poly', 'dokumentasi_sungai_poly');
	}
}


/* End of file dokumentasi_sungai_poly.php */
/* Location: ./application/controllers/administrator/Dokumentasi Sungai Poly.php */