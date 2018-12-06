<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tipe Gallerys Controller
*| --------------------------------------------------------------------------
*| Tipe Gallerys site
*|
*/
class Tipe_gallerys extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tipe_gallerys');
	}

	/**
	* show all Tipe Galleryss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tipe_gallerys_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tipe_galleryss'] = $this->model_tipe_gallerys->get($filter, $field, $this->limit_page, $offset);
		$this->data['tipe_gallerys_counts'] = $this->model_tipe_gallerys->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/tipe_gallerys/index/',
			'total_rows'   => $this->model_tipe_gallerys->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tipe Gallerys List');
		$this->render('backend/standart/administrator/tipe_gallerys/tipe_gallerys_list', $this->data);
	}
	
	/**
	* Add new tipe_galleryss
	*
	*/
	public function add()
	{
		$this->is_allowed('tipe_gallerys_add');

		$this->template->title('Tipe Gallerys New');
		$this->render('backend/standart/administrator/tipe_gallerys/tipe_gallerys_add', $this->data);
	}

	/**
	* Add New Tipe Galleryss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tipe_gallerys_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'KODE_TG' => $this->input->post('KODE_TG'),
				'NAMA_TG' => $this->input->post('NAMA_TG'),
			];

			
			$save_tipe_gallerys = $this->model_tipe_gallerys->store($save_data);

			if ($save_tipe_gallerys) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tipe_gallerys;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/tipe_gallerys/edit/' . $save_tipe_gallerys, 'Edit Tipe Gallerys'),
						anchor('administrator/tipe_gallerys', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/tipe_gallerys/edit/' . $save_tipe_gallerys, 'Edit Tipe Gallerys')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tipe_gallerys');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tipe_gallerys');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tipe Galleryss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tipe_gallerys_update');

		$this->data['tipe_gallerys'] = $this->model_tipe_gallerys->find($id);

		$this->template->title('Tipe Gallerys Update');
		$this->render('backend/standart/administrator/tipe_gallerys/tipe_gallerys_update', $this->data);
	}

	/**
	* Update Tipe Galleryss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tipe_gallerys_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'KODE_TG' => $this->input->post('KODE_TG'),
				'NAMA_TG' => $this->input->post('NAMA_TG'),
			];

			
			$save_tipe_gallerys = $this->model_tipe_gallerys->change($id, $save_data);

			if ($save_tipe_gallerys) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/tipe_gallerys', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tipe_gallerys');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tipe_gallerys');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tipe Galleryss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tipe_gallerys_delete');

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
            set_message(cclang('has_been_deleted', 'tipe_gallerys'), 'success');
        } else {
            set_message(cclang('error_delete', 'tipe_gallerys'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tipe Galleryss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tipe_gallerys_view');

		$this->data['tipe_gallerys'] = $this->model_tipe_gallerys->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Tipe Gallerys Detail');
		$this->render('backend/standart/administrator/tipe_gallerys/tipe_gallerys_view', $this->data);
	}
	
	/**
	* delete Tipe Galleryss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tipe_gallerys = $this->model_tipe_gallerys->find($id);

		
		
		return $this->model_tipe_gallerys->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tipe_gallerys_export');

		$this->model_tipe_gallerys->export('tipe_gallerys', 'tipe_gallerys');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tipe_gallerys_export');

		$this->model_tipe_gallerys->pdf('tipe_gallerys', 'tipe_gallerys');
	}
}


/* End of file tipe_gallerys.php */
/* Location: ./application/controllers/administrator/Tipe Gallerys.php */