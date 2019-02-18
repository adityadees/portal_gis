<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Kebakaran Hutan Controller
*| --------------------------------------------------------------------------
*| Kebakaran Hutan site
*|
*/
class Kebakaran_hutan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_kebakaran_hutan');
	}

	/**
	* show all Kebakaran Hutans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('kebakaran_hutan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['kebakaran_hutans'] = $this->model_kebakaran_hutan->get($filter, $field, $this->limit_page, $offset);
		$this->data['kebakaran_hutan_counts'] = $this->model_kebakaran_hutan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/kebakaran_hutan/index/',
			'total_rows'   => $this->model_kebakaran_hutan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Kebakaran Hutan List');
		$this->render('backend/standart/administrator/kebakaran_hutan/kebakaran_hutan_list', $this->data);
	}
	
	/**
	* Add new kebakaran_hutans
	*
	*/
	public function add()
	{
		$this->is_allowed('kebakaran_hutan_add');

		$this->template->title('Kebakaran Hutan New');
		$this->render('backend/standart/administrator/kebakaran_hutan/kebakaran_hutan_add', $this->data);
	}

	/**
	* Add New Kebakaran Hutans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('kebakaran_hutan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kebakaran_kode', 'Nama Wilayah', 'trim|max_length[11]');
		$this->form_validation->set_rules('kecamatan_rawan', 'Kecamatan Rawan', 'trim|max_length[11]');
		$this->form_validation->set_rules('kecamatan_sangat_rawan', 'Kecamatan Sangat Rawan', 'trim|max_length[11]');
		$this->form_validation->set_rules('desa_rawan', 'Desa Rawan', 'trim|max_length[11]');
		$this->form_validation->set_rules('desa_sangat_rawan', 'Desa Sangat Rawan', 'trim|max_length[11]');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|max_length[4]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kebakaran_kode' => $this->input->post('kebakaran_kode'),
				'kecamatan_rawan' => $this->input->post('kecamatan_rawan'),
				'kecamatan_sangat_rawan' => $this->input->post('kecamatan_sangat_rawan'),
				'desa_rawan' => $this->input->post('desa_rawan'),
				'desa_sangat_rawan' => $this->input->post('desa_sangat_rawan'),
				'tahun' => $this->input->post('tahun'),
			];

			
			$save_kebakaran_hutan = $this->model_kebakaran_hutan->store($save_data);

			if ($save_kebakaran_hutan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_kebakaran_hutan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/kebakaran_hutan/edit/' . $save_kebakaran_hutan, 'Edit Kebakaran Hutan'),
						anchor('administrator/kebakaran_hutan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/kebakaran_hutan/edit/' . $save_kebakaran_hutan, 'Edit Kebakaran Hutan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kebakaran_hutan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kebakaran_hutan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Kebakaran Hutans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('kebakaran_hutan_update');

		$this->data['kebakaran_hutan'] = $this->model_kebakaran_hutan->find($id);

		$this->template->title('Kebakaran Hutan Update');
		$this->render('backend/standart/administrator/kebakaran_hutan/kebakaran_hutan_update', $this->data);
	}

	/**
	* Update Kebakaran Hutans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('kebakaran_hutan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kebakaran_kode', 'Nama Wilayah', 'trim|max_length[11]');
		$this->form_validation->set_rules('kecamatan_rawan', 'Kecamatan Rawan', 'trim|max_length[11]');
		$this->form_validation->set_rules('kecamatan_sangat_rawan', 'Kecamatan Sangat Rawan', 'trim|max_length[11]');
		$this->form_validation->set_rules('desa_rawan', 'Desa Rawan', 'trim|max_length[11]');
		$this->form_validation->set_rules('desa_sangat_rawan', 'Desa Sangat Rawan', 'trim|max_length[11]');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|max_length[4]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kebakaran_kode' => $this->input->post('kebakaran_kode'),
				'kecamatan_rawan' => $this->input->post('kecamatan_rawan'),
				'kecamatan_sangat_rawan' => $this->input->post('kecamatan_sangat_rawan'),
				'desa_rawan' => $this->input->post('desa_rawan'),
				'desa_sangat_rawan' => $this->input->post('desa_sangat_rawan'),
				'tahun' => $this->input->post('tahun'),
			];

			
			$save_kebakaran_hutan = $this->model_kebakaran_hutan->change($id, $save_data);

			if ($save_kebakaran_hutan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/kebakaran_hutan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kebakaran_hutan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kebakaran_hutan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Kebakaran Hutans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('kebakaran_hutan_delete');

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
            set_message(cclang('has_been_deleted', 'kebakaran_hutan'), 'success');
        } else {
            set_message(cclang('error_delete', 'kebakaran_hutan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Kebakaran Hutans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('kebakaran_hutan_view');

		$this->data['kebakaran_hutan'] = $this->model_kebakaran_hutan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Kebakaran Hutan Detail');
		$this->render('backend/standart/administrator/kebakaran_hutan/kebakaran_hutan_view', $this->data);
	}
	
	/**
	* delete Kebakaran Hutans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$kebakaran_hutan = $this->model_kebakaran_hutan->find($id);

		
		
		return $this->model_kebakaran_hutan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('kebakaran_hutan_export');

		$this->model_kebakaran_hutan->export('kebakaran_hutan', 'kebakaran_hutan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('kebakaran_hutan_export');

		$this->model_kebakaran_hutan->pdf('kebakaran_hutan', 'kebakaran_hutan');
	}
}


/* End of file kebakaran_hutan.php */
/* Location: ./application/controllers/administrator/Kebakaran Hutan.php */