<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Tambah Historis Penanganan Controller
*| --------------------------------------------------------------------------
*| Form Tambah Historis Penanganan site
*|
*/
class Form_tambah_historis_penanganan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_tambah_historis_penanganan');
	}

	/**
	* show all Form Tambah Historis Penanganans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('form_tambah_historis_penanganan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['form_tambah_historis_penanganans'] = $this->model_form_tambah_historis_penanganan->get($filter, $field, $this->limit_page, $offset);
		$this->data['form_tambah_historis_penanganan_counts'] = $this->model_form_tambah_historis_penanganan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/form_tambah_historis_penanganan/index/',
			'total_rows'   => $this->model_form_tambah_historis_penanganan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Tambah Historis Penanganan List');
		$this->render('backend/standart/administrator/form_builder/form_tambah_historis_penanganan/form_tambah_historis_penanganan_list', $this->data);
	}

	/**
	* Update view Form Tambah Historis Penanganans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('form_tambah_historis_penanganan_update');

		$this->data['form_tambah_historis_penanganan'] = $this->model_form_tambah_historis_penanganan->find($id);

		$this->template->title('Tambah Historis Penanganan Update');
		$this->render('backend/standart/administrator/form_builder/form_tambah_historis_penanganan/form_tambah_historis_penanganan_update', $this->data);
	}

	/**
	* Update Form Tambah Historis Penanganans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('form_tambah_historis_penanganan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');
		$this->form_validation->set_rules('volume_efektif', 'Volume Efektif', 'trim|required');
		$this->form_validation->set_rules('volume_penanganan', 'Volume Penanganan', 'trim|required');
		$this->form_validation->set_rules('sumber_dana', 'Sumber Dana', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'tahun' => $this->input->post('tahun'),
				'volume_efektif' => $this->input->post('volume_efektif'),
				'volume_penanganan' => $this->input->post('volume_penanganan'),
				'sumber_dana' => $this->input->post('sumber_dana'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_form_tambah_historis_penanganan = $this->model_form_tambah_historis_penanganan->change($id, $save_data);

			if ($save_form_tambah_historis_penanganan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/form_tambah_historis_penanganan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/form_tambah_historis_penanganan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/form_tambah_historis_penanganan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete Form Tambah Historis Penanganans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('form_tambah_historis_penanganan_delete');

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
            set_message(cclang('has_been_deleted', 'Form Tambah Historis Penanganan'), 'success');
        } else {
            set_message(cclang('error_delete', 'Form Tambah Historis Penanganan'), 'error');
        }

		redirect_back();
	}

	/**
	* View view Form Tambah Historis Penanganans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('form_tambah_historis_penanganan_view');

		$this->data['form_tambah_historis_penanganan'] = $this->model_form_tambah_historis_penanganan->find($id);

		$this->template->title('Tambah Historis Penanganan Detail');
		$this->render('backend/standart/administrator/form_builder/form_tambah_historis_penanganan/form_tambah_historis_penanganan_view', $this->data);
	}

	/**
	* delete Form Tambah Historis Penanganans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$form_tambah_historis_penanganan = $this->model_form_tambah_historis_penanganan->find($id);

		
		return $this->model_form_tambah_historis_penanganan->remove($id);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('form_tambah_historis_penanganan_export');

		$this->model_form_tambah_historis_penanganan->export('form_tambah_historis_penanganan', 'form_tambah_historis_penanganan');
	}
}


/* End of file form_tambah_historis_penanganan.php */
/* Location: ./application/controllers/administrator/Form Tambah Historis Penanganan.php */