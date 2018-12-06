<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*| --------------------------------------------------------------------------
*| Web Controller
*| --------------------------------------------------------------------------
*| For default controller
*|
*/
class Web extends Front
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (installation_complete()) {
			$this->home();
		} else {
			redirect('wizzard/language','refresh');
		}
	}

	public function switch_lang($lang = 'english')
	{
        $this->load->helper(['cookie']);

        set_cookie('language', $lang, (60 * 60 * 24) * 365 );
        $this->lang->load('web', $lang);
        redirect_back();
    }

    public function home() 
    {
        if (defined('IS_DEMO')) {
          $this->template->build('home-demo');
      } else {
        $this->template->build('home');
    }
}

public function set_full_group_sql()
{
    $this->db->query(" 
        set global sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
        "); 

    $this->db->query(" 
        set session sql_mode=’STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION’;
        ");

}

public function migrate($version = null)
{
    $this->load->library('migration');

    if ($version) {
        if ($this->migration->version($version) === FALSE) {
           show_error($this->migration->error_string());
       }   
   } 
   else {
    if ($this->migration->latest() === FALSE) {
       show_error($this->migration->error_string());
   }   
}

}



public function peta(){

    		if (!$this->aauth->is_loggedin()) {
			redirect('administrator/login','refresh');
		}

    $this->load->model('modelgeojson');

    $x['jalan_nasional']=$this->modelgeojson->get_data('jalan_nasional');
    $x['jalan_provinsi']=$this->modelgeojson->get_data('jalan_provinsi');
    $x['air_bersih']=$this->modelgeojson->get_data('air_bersih');
    $x['jembatan']=$this->modelgeojson->get_data('jembatan_pt_250k');
    $x['bendung']=$this->modelgeojson->get_data('bendungans');
    $x['pelabuhan']=$this->modelgeojson->get_data('pelabuhan');
    $x['terminal']=$this->modelgeojson->get_data('terminal');
    $x['stasiun']=$this->modelgeojson->get_data('stasiun');
    $x['sanitasi']=$this->modelgeojson->get_data('sanitasi_sumsels');
    $x['bandara']=$this->modelgeojson->get_data('bandara');
    $x['sungai']=$this->modelgeojson->get_data('sungais');
    $x['sungaipol']=$this->modelgeojson->get_data('sungai_polys');
    $x['tol']=$this->modelgeojson->get_data('tol_ln_2017_sumatera_selatan_pubtr_geo');
    $x['map_link']=$this->modelgeojson->get_data('map_link');
    $this->load->view('frontend/map/map',$x);

}


}



/* End of file Web.php */
/* Location: ./application/controllers/Web.php */