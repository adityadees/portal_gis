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
    $x['jalan_permukiman']=$this->modelgeojson->get_data('jalan_permukiman');
    $x['air_bersih']=$this->modelgeojson->get_data('air_bersih');
    $x['jembatan']=$this->modelgeojson->get_data('jembatan');
    $x['irigasi']=$this->modelgeojson->get_data('irigasi');
    $x['pelabuhan']=$this->modelgeojson->get_data('pelabuhan');
    $x['terminal']=$this->modelgeojson->get_data('terminal');
    $x['stasiun']=$this->modelgeojson->get_data('stasiun');
    $x['sanitasi']=$this->modelgeojson->get_data('sanitasi');
    $x['bandara']=$this->modelgeojson->get_data('bandara');
    $x['sungai']=$this->modelgeojson->get_data('sungai');
    $x['sungaipol']=$this->modelgeojson->get_data('sungai_polys');
    $x['tol']=$this->modelgeojson->get_data('tol');
    $x['kawasan_kumuh']=$this->modelgeojson->get_data('kawasan_kumuh');
    $x['map_link']=$this->modelgeojson->get_data('map_link');
    $this->load->view('frontend/map/map',$x);

}


public function grafik(){

    		if (!$this->aauth->is_loggedin()) {
			redirect('administrator/login','refresh');
		}

    $this->load->model('modelgeojson');
    $this->load->model('modelgrafik');

    $x['map_link']=$this->modelgeojson->get_data('map_link');
    $x['jalan_provinsi']=$this->modelgrafik->get_data_grafik('historis_jalan_provinsi','target_jalan_provinsi');
    $x['jalan_permukiman']=$this->modelgrafik->get_data_grafik('historis_jalan_permukiman','target_jalan_permukiman');
    $x['jalan_nasional']=$this->modelgrafik->get_data_grafik('historis_jalan_nasional','target_jalan_nasional');
    $x['air_bersih']=$this->modelgrafik->get_data_grafik('historis_air_bersih','target_air_bersih');
    $x['jembatan']=$this->modelgrafik->get_data_grafik('historis_jembatan','target_jembatan');
    $x['irigasi']=$this->modelgrafik->get_data_grafik('historis_irigasi','target_irigasi');
    $x['pelabuhan']=$this->modelgrafik->get_data_grafik('historis_pelabuhan','target_pelabuhan');
    $x['terminal']=$this->modelgrafik->get_data_grafik('historis_terminal','target_terminal');
    $x['stasiun']=$this->modelgrafik->get_data_grafik('historis_stasiun','target_stasiun');
    $x['sanitasi']=$this->modelgrafik->get_data_grafik('historis_sanitasi','target_sanitasi');
    $x['bandara']=$this->modelgrafik->get_data_grafik('historis_bandara','target_bandara');
    $x['sungai']=$this->modelgrafik->get_data_grafik('historis_sungai','target_sungai');
    $x['sungai_pol']=$this->modelgrafik->get_data_grafik('historis_sungai_polys','target_sungaipol');
    $x['tol']=$this->modelgrafik->get_data_grafik('historis_tol','target_tol');
    $x['kawasan_kumuh']=$this->modelgrafik->get_data_grafik('historis_kawasan_kumuh','target_kawasan_kumuh');
    
    $x['jalan_provinsi_table']=$this->modelgrafik->get_jalan_provinsi_table();
    $x['jalan_permukiman_table']=$this->modelgrafik->get_jalan_permukiman_table();
    $x['jalan_nasional_table']=$this->modelgrafik->get_jalan_nasional_table();
    
    $x['air_bersih_table']=$this->modelgrafik->get_air_bersih_table();
    $x['jembatan_table']=$this->modelgrafik->get_jembatan_table();
    $x['irigasi_table']=$this->modelgrafik->get_irigasi_table();
    $x['sanitasi_table']=$this->modelgrafik->get_sanitasi_table();
    
    
    $x['pelabuhan_table']=$this->modelgrafik->get_pelabuhan_table();
    $x['terminal_table']=$this->modelgrafik->get_terminal_table();
    
    $x['stasiun_table']=$this->modelgrafik->get_stasiun_table();
    
    $x['sanitasi_table']=$this->modelgrafik->get_sanitasi_table();
    $x['bandara_table']=$this->modelgrafik->get_bandara_table();
    $x['sungai_table']=$this->modelgrafik->get_sungai_table();
    $x['sungaipol_table']=$this->modelgrafik->get_sungaipol_table();
    $x['tol_table']=$this->modelgrafik->get_tol_table();
    $x['kawasan_kumuh_table']=$this->modelgrafik->get_kawasan_kumuh_table();
    
    $this->load->view('frontend/grafik/grafik',$x);

}


public function visimisi(){   
        $this->load->view('frontend/visimisi/visimisi');
}

}



/* End of file Web.php */
/* Location: ./application/controllers/Web.php */