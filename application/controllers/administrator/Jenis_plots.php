<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jenis Plots Controller
*| --------------------------------------------------------------------------
*| Jenis Plots site
*|
*/
class Jenis_plots extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jenis_plots');
	}

	/**
	* show all Jenis Plotss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jenis_plots_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jenis_plotss'] = $this->model_jenis_plots->get($filter, $field, $this->limit_page, $offset);
		$this->data['jenis_plots_counts'] = $this->model_jenis_plots->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/jenis_plots/index/',
			'total_rows'   => $this->model_jenis_plots->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jenis Plots List');
		$this->render('backend/standart/administrator/jenis_plots/jenis_plots_list', $this->data);
	}
	
	/**
	* Add new jenis_plotss
	*
	*/
	public function add()
	{
		$this->is_allowed('jenis_plots_add');

		$this->template->title('Jenis Plots New');
		$this->render('backend/standart/administrator/jenis_plots/jenis_plots_add', $this->data);
	}

	/**
	* Add New Jenis Plotss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jenis_plots_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('NAMA_JP', 'NAMA JP', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'NAMA_JP' => $this->input->post('NAMA_JP'),
			];

			
			$save_jenis_plots = $this->model_jenis_plots->store($save_data);

			if ($save_jenis_plots) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jenis_plots;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/jenis_plots/edit/' . $save_jenis_plots, 'Edit Jenis Plots'),
						anchor('administrator/jenis_plots', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/jenis_plots/edit/' . $save_jenis_plots, 'Edit Jenis Plots')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_plots');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_plots');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jenis Plotss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jenis_plots_update');

		$this->data['jenis_plots'] = $this->model_jenis_plots->find($id);

		$this->template->title('Jenis Plots Update');
		$this->render('backend/standart/administrator/jenis_plots/jenis_plots_update', $this->data);
	}

	/**
	* Update Jenis Plotss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jenis_plots_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NAMA_JP', 'NAMA JP', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'NAMA_JP' => $this->input->post('NAMA_JP'),
			];

			
			$save_jenis_plots = $this->model_jenis_plots->change($id, $save_data);

			if ($save_jenis_plots) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/jenis_plots', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/jenis_plots');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/jenis_plots');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jenis Plotss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('jenis_plots_delete');

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
            set_message(cclang('has_been_deleted', 'jenis_plots'), 'success');
        } else {
            set_message(cclang('error_delete', 'jenis_plots'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Jenis Plotss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jenis_plots_view');

		$this->data['jenis_plots'] = $this->model_jenis_plots->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Jenis Plots Detail');
		$this->render('backend/standart/administrator/jenis_plots/jenis_plots_view', $this->data);
	}
	
	/**
	* delete Jenis Plotss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jenis_plots = $this->model_jenis_plots->find($id);

		
		
		return $this->model_jenis_plots->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jenis_plots_export');

		$this->model_jenis_plots->export('jenis_plots', 'jenis_plots');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jenis_plots_export');

		$this->model_jenis_plots->pdf('jenis_plots', 'jenis_plots');
	}
}


/* End of file jenis_plots.php */
/* Location: ./application/controllers/administrator/Jenis Plots.php */