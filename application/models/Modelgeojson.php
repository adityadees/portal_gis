<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Modelgeojson extends CI_Model{



	function get_data($table){
		$hasil=$this->db->get($table);
		return $hasil;
	}

	function get_data_historis_jalan_nasional($kode){
		$hasil=$this->db->query("SELECT * FROM historis_jalan_nasional where jalan_id='$kode'");
		return $hasil;
	}
	function get_data_historis_jalan_provinsi($kode){
		$hasil=$this->db->query("SELECT * FROM historis_jalan_provinsi where jalan_id='$kode'");
		return $hasil;
	}
	function get_data_historis_air_bersih($kode){
		$hasil=$this->db->query("SELECT * FROM historis_air_bersih where air_bersih_id='$kode'");
		return $hasil;
	}
	function get_data_historis_bendung($kode){
		$hasil=$this->db->query("SELECT * FROM historis_bendungans where bendungan_id='$kode'");
		return $hasil;
	}
	function get_data_historis_jembatan($kode){
		$hasil=$this->db->query("SELECT * FROM historis_jembatan_pt_250k where jembatan_pt_250k_id='$kode'");
		return $hasil;
	}
	function get_data_historis_sanitasi($kode){
		$hasil=$this->db->query("SELECT * FROM historis_sanitasi_sumsel where sanitasi_sumsel_id='$kode'");
		return $hasil;
	}
	function get_data_historis_sungai($kode){
		$hasil=$this->db->query("SELECT * FROM historis_sungais where sungais_id='$kode'");
		return $hasil;
	}
	function get_data_historis_sungaipol($kode){
		$hasil=$this->db->query("SELECT * FROM historis_sungai_polys where sungai_polys_id='$kode'");
		return $hasil;
	}
	function get_data_historis_tol($kode){
		$hasil=$this->db->query("SELECT * FROM historis_tol_ln_2017_sumatera_selatan_pubtr_geo where tol_ln_2017_sumatera_selatan_pubtr_geos_id='$kode'");
		return $hasil;
	}

	function get_data_historis_bandara($kode){
		$hasil=$this->db->query("SELECT * FROM historis_bandara where bandara_id='$kode'");
		return $hasil;
	}

	function get_data_historis_stasiun($kode){
		$hasil=$this->db->query("SELECT * FROM historis_stasiun where stasiun_id='$kode'");
		return $hasil;
	}


	function get_data_historis_terminal($kode){
		$hasil=$this->db->query("SELECT * FROM historis_terminal where terminal_id='$kode'");
		return $hasil;
	}

	function get_data_historis_pelabuhan($kode){
		$hasil=$this->db->query("SELECT * FROM historis_pelabuhan where pelabuhan_id='$kode'");
		return $hasil;
	}

	function get_target($kode,$maplink){
		$hasil=$this->db->query("SELECT * FROM target where target_data_id='$kode' AND maplink_id='$maplink'");
		return $hasil;
	}
	function get_dokumen_jalan_nasional($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_jalan_nasional where dokumentasi_jalan_id='$kode'");
		return $hasil;
	}
	function get_dokumen_jalan_provinsi($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_jalan_provinsi where dokumentasi_jalan_id='$kode'");
		return $hasil;
	}
	function  get_dokumen_air_bersih($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_air_bersih_sumsel where air_bersih_sumsel_id='$kode'");
		return $hasil;
	}
	function  get_dokumen_bendung($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_bendung_disumsel where bendung_disumsel_id='$kode'");
		return $hasil;
	}
	function  get_dokumen_jembatan($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_jembatan_pt_250K where embatan_pt_250K_id='$kode'");
		return $hasil;
	}
	function  get_dokumen_sanitasi($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_sanitasi_sumsel where dokumentasi_sanitasi_sumsel_id='$kode'");
		return $hasil;
	}
	function  get_dokumen_sungai($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_sungai where dokumentasi_sungai_id='$kode'");
		return $hasil;
	}
	function  get_dokumen_sungaipol($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_sungai_poly  where 	sungai_poly_id='$kode'");
		return $hasil;
	}
	function  get_dokumen_tol($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_tol_ln_2017_sumatera_selatan_pubtr_geo where 	tol_ln_2017_sumatera_selatan_pubtr_geoid='$kode'");
		return $hasil;
	}
	
	function  get_dokumen_pelabuhan($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_pelabuhan where dokumentasi_pelabuhan_id='$kode'");
		return $hasil;
	}
	
	function  get_dokumen_terminal($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_terminal where dokumentasi_terminal_id='$kode'");
		return $hasil;
	}

	function  get_dokumen_stasiun($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_stasiun where dokumentasi_stasiun_id='$kode'");
		return $hasil;
	}
	
	function  get_dokumen_bandara($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_bandara where dokumentasi_bandara_id='$kode'");
		return $hasil;
	}
} 
?>
