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

} 
?>
