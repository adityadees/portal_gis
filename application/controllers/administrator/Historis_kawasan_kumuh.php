<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Historis Kawasan Kumuh Controller
*| --------------------------------------------------------------------------
*| Historis Kawasan Kumuh site
*|
*/
class Historis_kawasan_kumuh extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_historis_kawasan_kumuh');
	}

	/**
	* show all Historis Kawasan Kumuhs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('historis_kawasan_kumuh_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['historis_kawasan_kumuhs'] = $this->model_historis_kawasan_kumuh->get($filter, $field, $this->limit_page, $offset);
		$this->data['historis_kawasan_kumuh_counts'] = $this->model_historis_kawasan_kumuh->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/historis_kawasan_kumuh/index/',
			'total_rows'   => $this->model_historis_kawasan_kumuh->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Historis Kawasan Kumuh List');
		$this->render('backend/standart/administrator/historis_kawasan_kumuh/historis_kawasan_kumuh_list', $this->data);
	}
	
	/**
	* Add new historis_kawasan_kumuhs
	*
	*/
	public function add()
	{
		$this->is_allowed('historis_kawasan_kumuh_add');

		$this->template->title('Historis Kawasan Kumuh New');
		$this->render('backend/standart/administrator/historis_kawasan_kumuh/historis_kawasan_kumuh_add', $this->data);
	}

	/**
	* Add New Historis Kawasan Kumuhs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('historis_kawasan_kumuh_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kawasan_kumuh_id', 'Nama Kawasan Kumuh', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Volume Efektif', 'trim|required');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required|max_length[4]');
		$this->form_validation->set_rules('historis_namakeg', 'Nama Kegiatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Volume Penanganan', 'trim|required');
		$this->form_validation->set_rules('historis_sdana', 'Sumber Dana', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		$this->form_validation->set_rules('maplinks_id', 'Maplinks Id', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kawasan_kumuh_id' => $this->input->post('kawasan_kumuh_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'maplinks_id' => $this->input->post('maplinks_id'),
			];

			
			$save_historis_kawasan_kumuh = $this->model_historis_kawasan_kumuh->store($save_data);

			if ($save_historis_kawasan_kumuh) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_historis_kawasan_kumuh;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/historis_kawasan_kumuh/edit/' . $save_historis_kawasan_kumuh, 'Edit Historis Kawasan Kumuh'),
						anchor('administrator/historis_kawasan_kumuh', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/historis_kawasan_kumuh/edit/' . $save_historis_kawasan_kumuh, 'Edit Historis Kawasan Kumuh')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_kawasan_kumuh');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_kawasan_kumuh');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Historis Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('historis_kawasan_kumuh_update');

		$this->data['historis_kawasan_kumuh'] = $this->model_historis_kawasan_kumuh->find($id);

		$this->template->title('Historis Kawasan Kumuh Update');
		$this->render('backend/standart/administrator/historis_kawasan_kumuh/historis_kawasan_kumuh_update', $this->data);
	}

	/**
	* Update Historis Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('historis_kawasan_kumuh_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kawasan_kumuh_id', 'Nama Kawasan Kumuh', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('historis_vefektif', 'Volume Efektif', 'trim|required');
		$this->form_validation->set_rules('historis_tahun', 'Historis Tahun', 'trim|required|max_length[4]');
		$this->form_validation->set_rules('historis_namakeg', 'Nama Kegiatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('historis_vpenanganan', 'Volume Penanganan', 'trim|required');
		$this->form_validation->set_rules('historis_sdana', 'Sumber Dana', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('historis_ket', 'Historis Ket', 'trim|required');
		$this->form_validation->set_rules('maplinks_id', 'Maplinks Id', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kawasan_kumuh_id' => $this->input->post('kawasan_kumuh_id'),
				'historis_vefektif' => $this->input->post('historis_vefektif'),
				'historis_tahun' => $this->input->post('historis_tahun'),
				'historis_namakeg' => $this->input->post('historis_namakeg'),
				'historis_vpenanganan' => $this->input->post('historis_vpenanganan'),
				'historis_sdana' => $this->input->post('historis_sdana'),
				'historis_ket' => $this->input->post('historis_ket'),
				'maplinks_id' => $this->input->post('maplinks_id'),
			];

			
			$save_historis_kawasan_kumuh = $this->model_historis_kawasan_kumuh->change($id, $save_data);

			if ($save_historis_kawasan_kumuh) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/historis_kawasan_kumuh', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/historis_kawasan_kumuh');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/historis_kawasan_kumuh');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Historis Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('historis_kawasan_kumuh_delete');

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
            set_message(cclang('has_been_deleted', 'historis_kawasan_kumuh'), 'success');
        } else {
            set_message(cclang('error_delete', 'historis_kawasan_kumuh'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Historis Kawasan Kumuhs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('historis_kawasan_kumuh_view');

		$this->data['historis_kawasan_kumuh'] = $this->model_historis_kawasan_kumuh->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Historis Kawasan Kumuh Detail');
		$this->render('backend/standart/administrator/historis_kawasan_kumuh/historis_kawasan_kumuh_view', $this->data);
	}
	
	/**
	* delete Historis Kawasan Kumuhs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$historis_kawasan_kumuh = $this->model_historis_kawasan_kumuh->find($id);

		
		
		return $this->model_historis_kawasan_kumuh->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('historis_kawasan_kumuh_export');

		$this->model_historis_kawasan_kumuh->export('historis_kawasan_kumuh', 'historis_kawasan_kumuh');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('historis_kawasan_kumuh_export');

		$this->model_historis_kawasan_kumuh->pdf('historis_kawasan_kumuh', 'historis_kawasan_kumuh');
	}
}


/* End of file historis_kawasan_kumuh.php */
/* Location: ./application/controllers/administrator/Historis Kawasan Kumuh.php */