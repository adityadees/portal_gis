<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Tol Ln 2017 Sumatera Selatan Pubtr Geo Controller
*| --------------------------------------------------------------------------
*| Historis Tol Ln 2017 Sumatera Selatan Pubtr Geo site
*|
*/
class Historis_tol_ln_2017_sumatera_selatan_pubtr_geo extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_tol_ln_2017_sumatera_selatan_pubtr_geo');
	}

	/**
	* show all Historis Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_tol_ln_2017_sumatera_selatan_pubtr_geo_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_tol_ln_2017_sumatera_selatan_pubtr_geos'] = $this->model_historis_tol_ln_2017_sumatera_selatan_pubtr_geo->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_tol_ln_2017_sumatera_selatan_pubtr_geo_counts'] = $this->model_historis_tol_ln_2017_sumatera_selatan_pubtr_geo->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_tol_ln_2017_sumatera_selatan_pubtr_geo/index/',
			'total_rows'   => $this->model_historis_tol_ln_2017_sumatera_selatan_pubtr_geo->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Tol Ln 2017 Sumatera Selatan Pubtr Geo List');
		$this->render('backend/standart/administrator/historis_tol_ln_2017_sumatera_selatan_pubtr_geo/historis_tol_ln_2017_sumatera_selatan_pubtr_geo_list', $this->data);
	}
	
	/**
	* Add new historis_tol_ln_2017_sumatera_selatan_pubtr_geos
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_tol_ln_2017_sumatera_selatan_pubtr_geo_add');

		$this->template->title('Historis Tol Ln 2017 Sumatera Selatan Pubtr Geo New');
		$this->render('backend/standart/administrator/historis_tol_ln_2017_sumatera_selatan_pubtr_geo/historis_tol_ln_2017_sumatera_selatan_pubtr_geo_add', $this->data);
	}

	/**
	* Add New Historis Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_tol_ln_2017_sumatera_selatan_pubtr_geo_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_historis_tol_ln_2017_sumatera_selatan_pubtr_geo' => $this->input->post('kode_historis_tol_ln_2017_sumatera_selatan_pubtr_geo'),
				'tol_ln_2017_sumatera_selatan_pubtr_geos_id' => $this->input->post('tol_ln_2017_sumatera_selatan_pubtr_geos_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
			];

			
			$save_historis_tol_ln_2017_sumatera_selatan_pubtr_geo = $this->model_historis_tol_ln_2017_sumatera_selatan_pubtr_geo->store($save_data);

			if ($save_historis_tol_ln_2017_sumatera_selatan_pubtr_geo) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_tol_ln_2017_sumatera_selatan_pubtr_geo;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_tol_ln_2017_sumatera_selatan_pubtr_geo/edit/' . $save_historis_tol_ln_2017_sumatera_selatan_pubtr_geo, 'Edit Historis Tol Ln 2017 Sumatera Selatan Pubtr Geo'),
						anchor('administrator/historis_tol_ln_2017_sumatera_selatan_pubtr_geo', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_tol_ln_2017_sumatera_selatan_pubtr_geo/edit/' . $save_historis_tol_ln_2017_sumatera_selatan_pubtr_geo, 'Edit Historis Tol Ln 2017 Sumatera Selatan Pubtr Geo')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_tol_ln_2017_sumatera_selatan_pubtr_geo');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_tol_ln_2017_sumatera_selatan_pubtr_geo');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_tol_ln_2017_sumatera_selatan_pubtr_geo_update');

		$this->data['historis_tol_ln_2017_sumatera_selatan_pubtr_geo'] = $this->model_historis_tol_ln_2017_sumatera_selatan_pubtr_geo->find($id);

		$this->template->title('Historis Tol Ln 2017 Sumatera Selatan Pubtr Geo Update');
		$this->render('backend/standart/administrator/historis_tol_ln_2017_sumatera_selatan_pubtr_geo/historis_tol_ln_2017_sumatera_selatan_pubtr_geo_update', $this->data);
	}

	/**
	* Update Historis Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_tol_ln_2017_sumatera_selatan_pubtr_geo_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('historis_namakeg', 'Historis Namakeg', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode_historis_tol_ln_2017_sumatera_selatan_pubtr_geo' => $this->input->post('kode_historis_tol_ln_2017_sumatera_selatan_pubtr_geo'),
				'tol_ln_2017_sumatera_selatan_pubtr_geos_id' => $this->input->post('tol_ln_2017_sumatera_selatan_pubtr_geos_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
			];

			
			$save_historis_tol_ln_2017_sumatera_selatan_pubtr_geo = $this->model_historis_tol_ln_2017_sumatera_selatan_pubtr_geo->change($id, $save_data);

			if ($save_historis_tol_ln_2017_sumatera_selatan_pubtr_geo) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_tol_ln_2017_sumatera_selatan_pubtr_geo', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_tol_ln_2017_sumatera_selatan_pubtr_geo');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_tol_ln_2017_sumatera_selatan_pubtr_geo');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_tol_ln_2017_sumatera_selatan_pubtr_geo_delete');

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
            set_message(cclang('has_been_deleted', 'historis_tol_ln_2017_sumatera_selatan_pubtr_geo'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_tol_ln_2017_sumatera_selatan_pubtr_geo'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_tol_ln_2017_sumatera_selatan_pubtr_geo_view');

		$this->data['historis_tol_ln_2017_sumatera_selatan_pubtr_geo'] = $this->model_historis_tol_ln_2017_sumatera_selatan_pubtr_geo->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Tol Ln 2017 Sumatera Selatan Pubtr Geo Detail');
		$this->render('backend/standart/administrator/historis_tol_ln_2017_sumatera_selatan_pubtr_geo/historis_tol_ln_2017_sumatera_selatan_pubtr_geo_view', $this->data);
	}
	
	/**
	* delete Historis Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_tol_ln_2017_sumatera_selatan_pubtr_geo = $this->model_historis_tol_ln_2017_sumatera_selatan_pubtr_geo->find($id);

		
		
		return $this->model_historis_tol_ln_2017_sumatera_selatan_pubtr_geo->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_tol_ln_2017_sumatera_selatan_pubtr_geo_export');

		$this->model_historis_tol_ln_2017_sumatera_selatan_pubtr_geo->export('historis_tol_ln_2017_sumatera_selatan_pubtr_geo', 'historis_tol_ln_2017_sumatera_selatan_pubtr_geo');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_tol_ln_2017_sumatera_selatan_pubtr_geo_export');

		$this->model_historis_tol_ln_2017_sumatera_selatan_pubtr_geo->pdf('historis_tol_ln_2017_sumatera_selatan_pubtr_geo', 'historis_tol_ln_2017_sumatera_selatan_pubtr_geo');
	}
}


/* End of file historis_tol_ln_2017_sumatera_selatan_pubtr_geo.php */
/* Location: ./application/controllers/administrator/Historis Tol Ln 2017 Sumatera Selatan Pubtr Geo.php */