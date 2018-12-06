<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Kategori Objek Pengamatans Controller
*| --------------------------------------------------------------------------
*| Kategori Objek Pengamatans site
*|
*/
class Kategori_objek_pengamatans extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_kategori_objek_pengamatans');
	}

	/**
	* show all Kategori Objek Pengamatanss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('kategori_objek_pengamatans_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['kategori_objek_pengamatanss'] = $this->model_kategori_objek_pengamatans->get($filter, $field, $this->limit_page, $offset);
		$this->data['kategori_objek_pengamatans_counts'] = $this->model_kategori_objek_pengamatans->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/kategori_objek_pengamatans/index/',
			'total_rows'   => $this->model_kategori_objek_pengamatans->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Kategori Objek Pengamatans List');
		$this->render('backend/standart/administrator/kategori_objek_pengamatans/kategori_objek_pengamatans_list', $this->data);
	}
	
	/**
	* Add new kategori_objek_pengamatanss
	*
	*/
	public function add()
	{
		$this->is_allowed('kategori_objek_pengamatans_add');

		$this->template->title('Kategori Objek Pengamatans New');
		$this->render('backend/standart/administrator/kategori_objek_pengamatans/kategori_objek_pengamatans_add', $this->data);
	}

	/**
	* Add New Kategori Objek Pengamatanss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('kategori_objek_pengamatans_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'KODE_KOP' => $this->input->post('KODE_KOP'),
				'NAMA_KOP' => $this->input->post('NAMA_KOP'),
				'NAMA_ICON_FILE' => $this->input->post('NAMA_ICON_FILE'),
			];

			
			$save_kategori_objek_pengamatans = $this->model_kategori_objek_pengamatans->store($save_data);

			if ($save_kategori_objek_pengamatans) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_kategori_objek_pengamatans;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/kategori_objek_pengamatans/edit/' . $save_kategori_objek_pengamatans, 'Edit Kategori Objek Pengamatans'),
						anchor('administrator/kategori_objek_pengamatans', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/kategori_objek_pengamatans/edit/' . $save_kategori_objek_pengamatans, 'Edit Kategori Objek Pengamatans')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kategori_objek_pengamatans');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kategori_objek_pengamatans');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Kategori Objek Pengamatanss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('kategori_objek_pengamatans_update');

		$this->data['kategori_objek_pengamatans'] = $this->model_kategori_objek_pengamatans->find($id);

		$this->template->title('Kategori Objek Pengamatans Update');
		$this->render('backend/standart/administrator/kategori_objek_pengamatans/kategori_objek_pengamatans_update', $this->data);
	}

	/**
	* Update Kategori Objek Pengamatanss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('kategori_objek_pengamatans_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'KODE_KOP' => $this->input->post('KODE_KOP'),
				'NAMA_KOP' => $this->input->post('NAMA_KOP'),
				'NAMA_ICON_FILE' => $this->input->post('NAMA_ICON_FILE'),
			];

			
			$save_kategori_objek_pengamatans = $this->model_kategori_objek_pengamatans->change($id, $save_data);

			if ($save_kategori_objek_pengamatans) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/kategori_objek_pengamatans', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kategori_objek_pengamatans');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kategori_objek_pengamatans');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Kategori Objek Pengamatanss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('kategori_objek_pengamatans_delete');

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
            set_message(cclang('has_been_deleted', 'kategori_objek_pengamatans'), 'success');
        } else {
            set_message(cclang('error_delete', 'kategori_objek_pengamatans'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Kategori Objek Pengamatanss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('kategori_objek_pengamatans_view');

		$this->data['kategori_objek_pengamatans'] = $this->model_kategori_objek_pengamatans->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Kategori Objek Pengamatans Detail');
		$this->render('backend/standart/administrator/kategori_objek_pengamatans/kategori_objek_pengamatans_view', $this->data);
	}
	
	/**
	* delete Kategori Objek Pengamatanss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$kategori_objek_pengamatans = $this->model_kategori_objek_pengamatans->find($id);

		
		
		return $this->model_kategori_objek_pengamatans->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('kategori_objek_pengamatans_export');

		$this->model_kategori_objek_pengamatans->export('kategori_objek_pengamatans', 'kategori_objek_pengamatans');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('kategori_objek_pengamatans_export');

		$this->model_kategori_objek_pengamatans->pdf('kategori_objek_pengamatans', 'kategori_objek_pengamatans');
	}
}


/* End of file kategori_objek_pengamatans.php */
/* Location: ./application/controllers/administrator/Kategori Objek Pengamatans.php */