<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Assets Controller
*| --------------------------------------------------------------------------
*| Assets site
*|
*/
class Assets extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_assets');
	}

	/**
	* show all Assetss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('assets_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['assetss'] = $this->model_assets->get($filter, $field, $this->limit_page, $offset);
		$this->data['assets_counts'] = $this->model_assets->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/assets/index/',
			'total_rows'   => $this->model_assets->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Assets List');
		$this->render('backend/standart/administrator/assets/assets_list', $this->data);
	}
	
	/**
	* Add new assetss
	*
	*/
	public function add()
	{
		$this->is_allowed('assets_add');

		$this->template->title('Assets New');
		$this->render('backend/standart/administrator/assets/assets_add', $this->data);
	}

	/**
	* Add New Assetss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('assets_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('NAMA_ASSET', 'NAMA ASSET', 'trim|required');
		$this->form_validation->set_rules('assets_PHOTO_ASSET_name', 'PHOTO ASSET', 'trim|required');
		$this->form_validation->set_rules('KATEGORI', 'KATEGORI', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('KETERANGAN', 'KETERANGAN', 'trim|required');
		$this->form_validation->set_rules('DATE_CREATED', 'DATE CREATED', 'trim|required');
		$this->form_validation->set_rules('DATE_UPDATED', 'DATE UPDATED', 'trim|required');
		

		if ($this->form_validation->run()) {
			$assets_PHOTO_ASSET_uuid = $this->input->post('assets_PHOTO_ASSET_uuid');
			$assets_PHOTO_ASSET_name = $this->input->post('assets_PHOTO_ASSET_name');
		
			$save_data = [
				'NAMA_ASSET' => $this->input->post('NAMA_ASSET'),
				'KATEGORI' => $this->input->post('KATEGORI'),
				'KETERANGAN' => $this->input->post('KETERANGAN'),
				'DATE_CREATED' => $this->input->post('DATE_CREATED'),
				'DATE_UPDATED' => $this->input->post('DATE_UPDATED'),
			];

			if (!is_dir(FCPATH . '/uploads/assets/')) {
				mkdir(FCPATH . '/uploads/assets/');
			}

			if (!empty($assets_PHOTO_ASSET_name)) {
				$assets_PHOTO_ASSET_name_copy = date('YmdHis') . '-' . $assets_PHOTO_ASSET_name;

				rename(FCPATH . 'uploads/tmp/' . $assets_PHOTO_ASSET_uuid . '/' . $assets_PHOTO_ASSET_name, 
						FCPATH . 'uploads/assets/' . $assets_PHOTO_ASSET_name_copy);

				if (!is_file(FCPATH . '/uploads/assets/' . $assets_PHOTO_ASSET_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['PHOTO_ASSET'] = $assets_PHOTO_ASSET_name_copy;
			}
		
			
			$save_assets = $this->model_assets->store($save_data);

			if ($save_assets) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_assets;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/assets/edit/' . $save_assets, 'Edit Assets'),
						anchor('administrator/assets', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/assets/edit/' . $save_assets, 'Edit Assets')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/assets');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/assets');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Assetss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('assets_update');

		$this->data['assets'] = $this->model_assets->find($id);

		$this->template->title('Assets Update');
		$this->render('backend/standart/administrator/assets/assets_update', $this->data);
	}

	/**
	* Update Assetss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('assets_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NAMA_ASSET', 'NAMA ASSET', 'trim|required');
		$this->form_validation->set_rules('assets_PHOTO_ASSET_name', 'PHOTO ASSET', 'trim|required');
		$this->form_validation->set_rules('KATEGORI', 'KATEGORI', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('KETERANGAN', 'KETERANGAN', 'trim|required');
		$this->form_validation->set_rules('DATE_CREATED', 'DATE CREATED', 'trim|required');
		$this->form_validation->set_rules('DATE_UPDATED', 'DATE UPDATED', 'trim|required');
		
		if ($this->form_validation->run()) {
			$assets_PHOTO_ASSET_uuid = $this->input->post('assets_PHOTO_ASSET_uuid');
			$assets_PHOTO_ASSET_name = $this->input->post('assets_PHOTO_ASSET_name');
		
			$save_data = [
				'NAMA_ASSET' => $this->input->post('NAMA_ASSET'),
				'KATEGORI' => $this->input->post('KATEGORI'),
				'KETERANGAN' => $this->input->post('KETERANGAN'),
				'DATE_CREATED' => $this->input->post('DATE_CREATED'),
				'DATE_UPDATED' => $this->input->post('DATE_UPDATED'),
			];

			if (!is_dir(FCPATH . '/uploads/assets/')) {
				mkdir(FCPATH . '/uploads/assets/');
			}

			if (!empty($assets_PHOTO_ASSET_uuid)) {
				$assets_PHOTO_ASSET_name_copy = date('YmdHis') . '-' . $assets_PHOTO_ASSET_name;

				rename(FCPATH . 'uploads/tmp/' . $assets_PHOTO_ASSET_uuid . '/' . $assets_PHOTO_ASSET_name, 
						FCPATH . 'uploads/assets/' . $assets_PHOTO_ASSET_name_copy);

				if (!is_file(FCPATH . '/uploads/assets/' . $assets_PHOTO_ASSET_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['PHOTO_ASSET'] = $assets_PHOTO_ASSET_name_copy;
			}
		
			
			$save_assets = $this->model_assets->change($id, $save_data);

			if ($save_assets) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/assets', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/assets');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/assets');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Assetss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('assets_delete');

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
            set_message(cclang('has_been_deleted', 'assets'), 'success');
        } else {
            set_message(cclang('error_delete', 'assets'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Assetss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('assets_view');

		$this->data['assets'] = $this->model_assets->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Assets Detail');
		$this->render('backend/standart/administrator/assets/assets_view', $this->data);
	}
	
	/**
	* delete Assetss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$assets = $this->model_assets->find($id);

		if (!empty($assets->PHOTO_ASSET)) {
			$path = FCPATH . '/uploads/assets/' . $assets->PHOTO_ASSET;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_assets->remove($id);
	}
	
	/**
	* Upload Image Assets	* 
	* @return JSON
	*/
	public function upload_PHOTO_ASSET_file()
	{
		if (!$this->is_allowed('assets_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'assets',
		]);
	}

	/**
	* Delete Image Assets	* 
	* @return JSON
	*/
	public function delete_PHOTO_ASSET_file($uuid)
	{
		if (!$this->is_allowed('assets_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'PHOTO_ASSET', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'assets',
            'primary_key'       => 'KODE_LA',
            'upload_path'       => 'uploads/assets/'
        ]);
	}

	/**
	* Get Image Assets	* 
	* @return JSON
	*/
	public function get_PHOTO_ASSET_file($id)
	{
		if (!$this->is_allowed('assets_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$assets = $this->model_assets->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'PHOTO_ASSET', 
            'table_name'        => 'assets',
            'primary_key'       => 'KODE_LA',
            'upload_path'       => 'uploads/assets/',
            'delete_endpoint'   => 'administrator/assets/delete_PHOTO_ASSET_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('assets_export');

		$this->model_assets->export('assets', 'assets');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('assets_export');

		$this->model_assets->pdf('assets', 'assets');
	}
}


/* End of file assets.php */
/* Location: ./application/controllers/administrator/Assets.php */