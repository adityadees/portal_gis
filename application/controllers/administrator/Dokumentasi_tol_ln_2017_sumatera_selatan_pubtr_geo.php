<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geo Controller
*| --------------------------------------------------------------------------
*| Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geo site
*|
*/
class Dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo');
	}

	/**
	* show all Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geos'] = $this->model_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->get($filter, $field, $this->limit_page, $offset);
		$this->data['dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_counts'] = $this->model_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/index/',
			'total_rows'   => $this->model_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geo List');
		$this->render('backend/standart/administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_list', $this->data);
	}
	
	/**
	* Add new dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geos
	*
	*/
	public function add()
	{
		$this->is_allowed('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_add');

		$this->template->title('Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geo New');
		$this->render('backend/standart/administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_add', $this->data);
	}

	/**
	* Add New Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		

		if ($this->form_validation->run()) {
			$dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_uuid = $this->input->post('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_uuid');
			$dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name = $this->input->post('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name');
		
			$save_data = [
				'kode_dtl' => $this->input->post('kode_dtl'),
				'tol_ln_2017_sumatera_selatan_pubtr_geoid' => $this->input->post('tol_ln_2017_sumatera_selatan_pubtr_geoid'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/');
			}

			if (!empty($dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name)) {
				$dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name_copy = date('YmdHis') . '-' . $dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_uuid . '/' . $dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name, 
						FCPATH . 'uploads/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/' . $dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/' . $dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name_copy;
			}
		
			
			$save_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo = $this->model_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->store($save_data);

			if ($save_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/edit/' . $save_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo, 'Edit Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geo'),
						anchor('administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/edit/' . $save_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo, 'Edit Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geo')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_update');

		$this->data['dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo'] = $this->model_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->find($id);

		$this->template->title('Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geo Update');
		$this->render('backend/standart/administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_update', $this->data);
	}

	/**
	* Update Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('dokumen_tanggal', 'Dokumen Tanggal', 'trim|required');
		
		if ($this->form_validation->run()) {
			$dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_uuid = $this->input->post('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_uuid');
			$dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name = $this->input->post('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name');
		
			$save_data = [
				'kode_dtl' => $this->input->post('kode_dtl'),
				'tol_ln_2017_sumatera_selatan_pubtr_geoid' => $this->input->post('tol_ln_2017_sumatera_selatan_pubtr_geoid'),
				'dokumen_tanggal' => $this->input->post('dokumen_tanggal'),
			];

			if (!is_dir(FCPATH . '/uploads/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/')) {
				mkdir(FCPATH . '/uploads/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/');
			}

			if (!empty($dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_uuid)) {
				$dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name_copy = date('YmdHis') . '-' . $dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name;

				rename(FCPATH . 'uploads/tmp/' . $dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_uuid . '/' . $dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name, 
						FCPATH . 'uploads/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/' . $dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name_copy);

				if (!is_file(FCPATH . '/uploads/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/' . $dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['file'] = $dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_file_name_copy;
			}
		
			
			$save_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo = $this->model_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->change($id, $save_data);

			if ($save_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_delete');

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
            set_message(cclang('has_been_deleted', 'dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo'), 'success');
        } else {
            set_message(cclang('error_delete', 'dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_view');

		$this->data['dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo'] = $this->model_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geo Detail');
		$this->render('backend/standart/administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_view', $this->data);
	}
	
	/**
	* delete Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo = $this->model_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->find($id);

		if (!empty($dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->file)) {
			$path = FCPATH . '/uploads/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/' . $dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->file;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->remove($id);
	}
	
	/**
	* Upload Image Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geo	* 
	* @return JSON
	*/
	public function upload_file_file()
	{
		if (!$this->is_allowed('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo',
		]);
	}

	/**
	* Delete Image Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geo	* 
	* @return JSON
	*/
	public function delete_file_file($uuid)
	{
		if (!$this->is_allowed('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_delete', false)) {
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
            'table_name'        => 'dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo',
            'primary_key'       => 'kode_dtl',
            'upload_path'       => 'uploads/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/'
        ]);
	}

	/**
	* Get Image Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geo	* 
	* @return JSON
	*/
	public function get_file_file($id)
	{
		if (!$this->is_allowed('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo = $this->model_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'file', 
            'table_name'        => 'dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo',
            'primary_key'       => 'kode_dtl',
            'upload_path'       => 'uploads/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/',
            'delete_endpoint'   => 'administrator/dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo/delete_file_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_export');

		$this->model_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->export('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo', 'dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo_export');

		$this->model_dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo->pdf('dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo', 'dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo');
	}
}


/* End of file dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo.php */
/* Location: ./application/controllers/administrator/Dokumentasi Tol Ln 2017 Sumatera Selatan Pubtr Geo.php */