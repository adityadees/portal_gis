<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tol Ln 2017 Sumatera Selatan Pubtr Geo Controller
*| --------------------------------------------------------------------------
*| Tol Ln 2017 Sumatera Selatan Pubtr Geo site
*|
*/
class Tol_ln_2017_sumatera_selatan_pubtr_geo extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tol_ln_2017_sumatera_selatan_pubtr_geo');
	}

	/**
	* show all Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tol_ln_2017_sumatera_selatan_pubtr_geo_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tol_ln_2017_sumatera_selatan_pubtr_geos'] = $this->model_tol_ln_2017_sumatera_selatan_pubtr_geo->get($filter, $field, $this->limit_page, $offset);
		$this->data['tol_ln_2017_sumatera_selatan_pubtr_geo_counts'] = $this->model_tol_ln_2017_sumatera_selatan_pubtr_geo->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/tol_ln_2017_sumatera_selatan_pubtr_geo/index/',
			'total_rows'   => $this->model_tol_ln_2017_sumatera_selatan_pubtr_geo->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tol List');
		$this->render('backend/standart/administrator/tol_ln_2017_sumatera_selatan_pubtr_geo/tol_ln_2017_sumatera_selatan_pubtr_geo_list', $this->data);
	}
	
	/**
	* Add new tol_ln_2017_sumatera_selatan_pubtr_geos
	*
	*/
	public function add()
	{
		$this->is_allowed('tol_ln_2017_sumatera_selatan_pubtr_geo_add');

		$this->template->title('Tol New');
		$this->render('backend/standart/administrator/tol_ln_2017_sumatera_selatan_pubtr_geo/tol_ln_2017_sumatera_selatan_pubtr_geo_add', $this->data);
	}

	/**
	* Add New Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tol_ln_2017_sumatera_selatan_pubtr_geo_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('tol_ln_2017_sumatera_selatan_pubtr_geo_id', 'Nama Tol', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('jalanrencana', 'Jalanrencana', 'trim|required');
		$this->form_validation->set_rules('ruas', 'Ruas', 'trim|required');
		$this->form_validation->set_rules('status_tol', 'Status Tol', 'trim|required');
		$this->form_validation->set_rules('pemilik', 'Pemilik', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'tol_ln_2017_sumatera_selatan_pubtr_geo_id' => $this->input->post('tol_ln_2017_sumatera_selatan_pubtr_geo_id'),
				'jalanrencana' => $this->input->post('jalanrencana'),
				'ruas' => $this->input->post('ruas'),
				'status_tol' => $this->input->post('status_tol'),
				'pemilik' => $this->input->post('pemilik'),
			];

			
			$save_tol_ln_2017_sumatera_selatan_pubtr_geo = $this->model_tol_ln_2017_sumatera_selatan_pubtr_geo->store($save_data);

			if ($save_tol_ln_2017_sumatera_selatan_pubtr_geo) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tol_ln_2017_sumatera_selatan_pubtr_geo;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/tol_ln_2017_sumatera_selatan_pubtr_geo/edit/' . $save_tol_ln_2017_sumatera_selatan_pubtr_geo, 'Edit Tol Ln 2017 Sumatera Selatan Pubtr Geo'),
						anchor('administrator/tol_ln_2017_sumatera_selatan_pubtr_geo', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/tol_ln_2017_sumatera_selatan_pubtr_geo/edit/' . $save_tol_ln_2017_sumatera_selatan_pubtr_geo, 'Edit Tol Ln 2017 Sumatera Selatan Pubtr Geo')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tol_ln_2017_sumatera_selatan_pubtr_geo');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tol_ln_2017_sumatera_selatan_pubtr_geo');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tol_ln_2017_sumatera_selatan_pubtr_geo_update');

		$this->data['tol_ln_2017_sumatera_selatan_pubtr_geo'] = $this->model_tol_ln_2017_sumatera_selatan_pubtr_geo->find($id);

		$this->template->title('Tol Update');
		$this->render('backend/standart/administrator/tol_ln_2017_sumatera_selatan_pubtr_geo/tol_ln_2017_sumatera_selatan_pubtr_geo_update', $this->data);
	}

	/**
	* Update Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tol_ln_2017_sumatera_selatan_pubtr_geo_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('tol_ln_2017_sumatera_selatan_pubtr_geo_id', 'Nama Tol', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('jalanrencana', 'Jalanrencana', 'trim|required');
		$this->form_validation->set_rules('ruas', 'Ruas', 'trim|required');
		$this->form_validation->set_rules('status_tol', 'Status Tol', 'trim|required');
		$this->form_validation->set_rules('pemilik', 'Pemilik', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'tol_ln_2017_sumatera_selatan_pubtr_geo_id' => $this->input->post('tol_ln_2017_sumatera_selatan_pubtr_geo_id'),
				'jalanrencana' => $this->input->post('jalanrencana'),
				'ruas' => $this->input->post('ruas'),
				'status_tol' => $this->input->post('status_tol'),
				'pemilik' => $this->input->post('pemilik'),
			];

			
			$save_tol_ln_2017_sumatera_selatan_pubtr_geo = $this->model_tol_ln_2017_sumatera_selatan_pubtr_geo->change($id, $save_data);

			if ($save_tol_ln_2017_sumatera_selatan_pubtr_geo) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/tol_ln_2017_sumatera_selatan_pubtr_geo', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tol_ln_2017_sumatera_selatan_pubtr_geo');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tol_ln_2017_sumatera_selatan_pubtr_geo');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tol_ln_2017_sumatera_selatan_pubtr_geo_delete');

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
            set_message(cclang('has_been_deleted', 'tol_ln_2017_sumatera_selatan_pubtr_geo'), 'success');
        } else {
            set_message(cclang('error_delete', 'tol_ln_2017_sumatera_selatan_pubtr_geo'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tol_ln_2017_sumatera_selatan_pubtr_geo_view');

		$this->data['tol_ln_2017_sumatera_selatan_pubtr_geo'] = $this->model_tol_ln_2017_sumatera_selatan_pubtr_geo->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Tol Detail');
		$this->render('backend/standart/administrator/tol_ln_2017_sumatera_selatan_pubtr_geo/tol_ln_2017_sumatera_selatan_pubtr_geo_view', $this->data);
	}
	
	/**
	* delete Tol Ln 2017 Sumatera Selatan Pubtr Geos
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tol_ln_2017_sumatera_selatan_pubtr_geo = $this->model_tol_ln_2017_sumatera_selatan_pubtr_geo->find($id);

		
		
		return $this->model_tol_ln_2017_sumatera_selatan_pubtr_geo->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tol_ln_2017_sumatera_selatan_pubtr_geo_export');

		$this->model_tol_ln_2017_sumatera_selatan_pubtr_geo->export('tol_ln_2017_sumatera_selatan_pubtr_geo', 'tol_ln_2017_sumatera_selatan_pubtr_geo');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tol_ln_2017_sumatera_selatan_pubtr_geo_export');

		$this->model_tol_ln_2017_sumatera_selatan_pubtr_geo->pdf('tol_ln_2017_sumatera_selatan_pubtr_geo', 'tol_ln_2017_sumatera_selatan_pubtr_geo');
	}
}


/* End of file tol_ln_2017_sumatera_selatan_pubtr_geo.php */
/* Location: ./application/controllers/administrator/Tol Ln 2017 Sumatera Selatan Pubtr Geo.php */