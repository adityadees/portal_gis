<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Gallery Assets Controller
*| --------------------------------------------------------------------------
*| Gallery Assets site
*|
*/
class Gallery_assets extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_gallery_assets');
	}

	/**
	* show all Gallery Assetss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('gallery_assets_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['gallery_assetss'] = $this->model_gallery_assets->get($filter, $field, $this->limit_page, $offset);
		$this->data['gallery_assets_counts'] = $this->model_gallery_assets->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/gallery_assets/index/',
			'total_rows'   => $this->model_gallery_assets->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Gallery Assets List');
		$this->render('backend/standart/administrator/gallery_assets/gallery_assets_list', $this->data);
	}
	
	/**
	* Add new gallery_assetss
	*
	*/
	public function add()
	{
		$this->is_allowed('gallery_assets_add');

		$this->template->title('Gallery Assets New');
		$this->render('backend/standart/administrator/gallery_assets/gallery_assets_add', $this->data);
	}

	/**
	* Add New Gallery Assetss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('gallery_assets_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('TIPE', 'TIPE', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('NAMA_FILE', 'NAMA FILE', 'trim|required');
		$this->form_validation->set_rules('DATE_UPLOAD', 'DATE UPLOAD', 'trim|required');
		$this->form_validation->set_rules('ASSET', 'ASSET', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'TIPE' => $this->input->post('TIPE'),
				'NAMA_FILE' => $this->input->post('NAMA_FILE'),
				'DATE_UPLOAD' => $this->input->post('DATE_UPLOAD'),
				'ASSET' => $this->input->post('ASSET'),
			];

			
			$save_gallery_assets = $this->model_gallery_assets->store($save_data);

			if ($save_gallery_assets) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_gallery_assets;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/gallery_assets/edit/' . $save_gallery_assets, 'Edit Gallery Assets'),
						anchor('administrator/gallery_assets', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/gallery_assets/edit/' . $save_gallery_assets, 'Edit Gallery Assets')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/gallery_assets');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/gallery_assets');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Gallery Assetss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('gallery_assets_update');

		$this->data['gallery_assets'] = $this->model_gallery_assets->find($id);

		$this->template->title('Gallery Assets Update');
		$this->render('backend/standart/administrator/gallery_assets/gallery_assets_update', $this->data);
	}

	/**
	* Update Gallery Assetss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('gallery_assets_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('TIPE', 'TIPE', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('NAMA_FILE', 'NAMA FILE', 'trim|required');
		$this->form_validation->set_rules('DATE_UPLOAD', 'DATE UPLOAD', 'trim|required');
		$this->form_validation->set_rules('ASSET', 'ASSET', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'TIPE' => $this->input->post('TIPE'),
				'NAMA_FILE' => $this->input->post('NAMA_FILE'),
				'DATE_UPLOAD' => $this->input->post('DATE_UPLOAD'),
				'ASSET' => $this->input->post('ASSET'),
			];

			
			$save_gallery_assets = $this->model_gallery_assets->change($id, $save_data);

			if ($save_gallery_assets) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/gallery_assets', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/gallery_assets');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/gallery_assets');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Gallery Assetss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('gallery_assets_delete');

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
            set_message(cclang('has_been_deleted', 'gallery_assets'), 'success');
        } else {
            set_message(cclang('error_delete', 'gallery_assets'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Gallery Assetss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('gallery_assets_view');

		$this->data['gallery_assets'] = $this->model_gallery_assets->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Gallery Assets Detail');
		$this->render('backend/standart/administrator/gallery_assets/gallery_assets_view', $this->data);
	}
	
	/**
	* delete Gallery Assetss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$gallery_assets = $this->model_gallery_assets->find($id);

		
		
		return $this->model_gallery_assets->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('gallery_assets_export');

		$this->model_gallery_assets->export('gallery_assets', 'gallery_assets');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('gallery_assets_export');

		$this->model_gallery_assets->pdf('gallery_assets', 'gallery_assets');
	}
}


/* End of file gallery_assets.php */
/* Location: ./application/controllers/administrator/Gallery Assets.php */