<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Bendungan Controller
*| --------------------------------------------------------------------------
*| Historis Bendungan site
*|
*/
class Historis_bendungan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_bendungan');
	}

	/**
	* show all Historis Bendungans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_bendungan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_bendungans'] = $this->model_historis_bendungan->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_bendungan_counts'] = $this->model_historis_bendungan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_bendungan/index/',
			'total_rows'   => $this->model_historis_bendungan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Bendungan List');
		$this->render('backend/standart/administrator/historis_bendungan/historis_bendungan_list', $this->data);
	}
	
	/**
	* Add new historis_bendungans
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_bendungan_add');

		$this->template->title('Historis Bendungan New');
		$this->render('backend/standart/administrator/historis_bendungan/historis_bendungan_add', $this->data);
	}

	/**
	* Add New Historis Bendungans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_bendungan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('bendungan_id', 'Nama Bendungan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Volume Efektif', 'trim|required');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required|max_length[4]');
		$this->form_validation->set_rules('historis_namakeg', 'Nama Kegiatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Volume Penanganan', 'trim|required');
		$this->form_validation->set_rules('historis_sdana', 'Sumber Dana', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		$this->form_validation->set_rules('maplinks_id', 'Maplinks Id', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'bendungan_id' => $this->input->post('bendungan_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'maplinks_id' => $this->input->post('maplinks_id'),
			];

			
			$save_historis_bendungan = $this->model_historis_bendungan->store($save_data);

			if ($save_historis_bendungan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_bendungan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_bendungan/edit/' . $save_historis_bendungan, 'Edit Historis Bendungan'),
						anchor('administrator/historis_bendungan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_bendungan/edit/' . $save_historis_bendungan, 'Edit Historis Bendungan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_bendungan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_bendungan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Bendungans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_bendungan_update');

		$this->data['historis_bendungan'] = $this->model_historis_bendungan->find($id);

		$this->template->title('Historis Bendungan Update');
		$this->render('backend/standart/administrator/historis_bendungan/historis_bendungan_update', $this->data);
	}

	/**
	* Update Historis Bendungans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_bendungan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('bendungan_id', 'Nama Bendungan', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Volume Efektif', 'trim|required');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required|max_length[4]');
		$this->form_validation->set_rules('historis_namakeg', 'Nama Kegiatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Volume Penanganan', 'trim|required');
		$this->form_validation->set_rules('historis_sdana', 'Sumber Dana', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		$this->form_validation->set_rules('maplinks_id', 'Maplinks Id', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'bendungan_id' => $this->input->post('bendungan_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'maplinks_id' => $this->input->post('maplinks_id'),
			];

			
			$save_historis_bendungan = $this->model_historis_bendungan->change($id, $save_data);

			if ($save_historis_bendungan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_bendungan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_bendungan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_bendungan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Bendungans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_bendungan_delete');

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
            set_message(cclang('has_been_deleted', 'historis_bendungan'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_bendungan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Bendungans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_bendungan_view');

		$this->data['historis_bendungan'] = $this->model_historis_bendungan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Bendungan Detail');
		$this->render('backend/standart/administrator/historis_bendungan/historis_bendungan_view', $this->data);
	}
	
	/**
	* delete Historis Bendungans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_bendungan = $this->model_historis_bendungan->find($id);

		
		
		return $this->model_historis_bendungan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_bendungan_export');

		$this->model_historis_bendungan->export('historis_bendungan', 'historis_bendungan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_bendungan_export');

		$this->model_historis_bendungan->pdf('historis_bendungan', 'historis_bendungan');
	}
}


/* End of file historis_bendungan.php */
/* Location: ./application/controllers/administrator/Historis Bendungan.php */