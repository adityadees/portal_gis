<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tanah Longsor Controller
*| --------------------------------------------------------------------------
*| Tanah Longsor site
*|
*/
class Tanah_longsor extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tanah_longsor');
	}

	/**
	* show all Tanah Longsors
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tanah_longsor_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tanah_longsors'] = $this->model_tanah_longsor->get($filter, $field, $this->limit_page, $offset);
		$this->data['tanah_longsor_counts'] = $this->model_tanah_longsor->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/tanah_longsor/index/',
			'total_rows'   => $this->model_tanah_longsor->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tanah Longsor List');
		$this->render('backend/standart/administrator/tanah_longsor/tanah_longsor_list', $this->data);
	}
	
	/**
	* Add new tanah_longsors
	*
	*/
	public function add()
	{
		$this->is_allowed('tanah_longsor_add');

		$this->template->title('Tanah Longsor New');
		$this->render('backend/standart/administrator/tanah_longsor/tanah_longsor_add', $this->data);
	}

	/**
	* Add New Tanah Longsors
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tanah_longsor_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kelurahan', 'Kelurahan', 'trim|max_length[200]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode' => $this->input->post('kode'),
				'longsor_kecamatan' => $this->input->post('longsor_kecamatan'),
				'kelurahan' => $this->input->post('kelurahan'),
				'tahun' => $this->input->post('tahun'),
			];

			
			$save_tanah_longsor = $this->model_tanah_longsor->store($save_data);

			if ($save_tanah_longsor) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tanah_longsor;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/tanah_longsor/edit/' . $save_tanah_longsor, 'Edit Tanah Longsor'),
						anchor('administrator/tanah_longsor', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/tanah_longsor/edit/' . $save_tanah_longsor, 'Edit Tanah Longsor')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tanah_longsor');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tanah_longsor');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tanah Longsors
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tanah_longsor_update');

		$this->data['tanah_longsor'] = $this->model_tanah_longsor->find($id);

		$this->template->title('Tanah Longsor Update');
		$this->render('backend/standart/administrator/tanah_longsor/tanah_longsor_update', $this->data);
	}

	/**
	* Update Tanah Longsors
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tanah_longsor_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kelurahan', 'Kelurahan', 'trim|max_length[200]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kode' => $this->input->post('kode'),
				'longsor_kecamatan' => $this->input->post('longsor_kecamatan'),
				'kelurahan' => $this->input->post('kelurahan'),
				'tahun' => $this->input->post('tahun'),
			];

			
			$save_tanah_longsor = $this->model_tanah_longsor->change($id, $save_data);

			if ($save_tanah_longsor) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/tanah_longsor', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tanah_longsor');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tanah_longsor');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tanah Longsors
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tanah_longsor_delete');

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
            set_message(cclang('has_been_deleted', 'tanah_longsor'), 'success');
        } else {
            set_message(cclang('error_delete', 'tanah_longsor'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tanah Longsors
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tanah_longsor_view');

		$this->data['tanah_longsor'] = $this->model_tanah_longsor->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Tanah Longsor Detail');
		$this->render('backend/standart/administrator/tanah_longsor/tanah_longsor_view', $this->data);
	}
	
	/**
	* delete Tanah Longsors
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tanah_longsor = $this->model_tanah_longsor->find($id);

		
		
		return $this->model_tanah_longsor->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tanah_longsor_export');

		$this->model_tanah_longsor->export('tanah_longsor', 'tanah_longsor');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tanah_longsor_export');

		$this->model_tanah_longsor->pdf('tanah_longsor', 'tanah_longsor');
	}
}


/* End of file tanah_longsor.php */
/* Location: ./application/controllers/administrator/Tanah Longsor.php */