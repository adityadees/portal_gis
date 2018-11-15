<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Modelgeojson extends CI_Model{



	function get_data($table){
		$hasil=$this->db->get($table);
		return $hasil;
	}

	function get_data_historis($kode){
		$hasil=$this->db->query("SELECT * FROM historis_jalan where jalan_id='$kode'");
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
	function get_data_historis_stanplat($kode){
		$hasil=$this->db->query("SELECT * FROM historis_stanplat where sanitasi_sumsel_id='$kode'");
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

} 
?>
