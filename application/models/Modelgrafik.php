<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Modelgrafik extends CI_Model{





	function get_data_grafik($historis,$target_link){
		$hasil=$this->db->query("select year, 
			coalesce(s.cost,0) as historis_vpenanganan, 
			coalesce(h.cost,0) as target_volume
			from (select historis_tahun as year from $historis union select target_tahun from $target_link) years
			inner join (
			select historis_tahun, sum(historis_vpenanganan) cost
			from $historis
			group by historis_tahun) s on years.year = s.historis_tahun
			left join (
			select target_tahun, sum(target_volume) cost
			from $target_link
			group by target_tahun) h on years.year = h.target_tahun");
		return $hasil;
	}
	


	function get_data_historis_jalan_nasional($kode){
		$hasil=$this->db->query("SELECT * FROM historis_jalan_nasional where jalan_id='$kode'");
		return $hasil;
	}
	
	function get_data_historis_air_bersih($kode){
		$hasil=$this->db->query("SELECT * FROM historis_air_bersih where air_bersih_id='$kode'");
		return $hasil;
	}
	function get_data_historis_irigasi($kode){
		$hasil=$this->db->query("SELECT * FROM historis_irigasi where irigasi_id='$kode'");
		return $hasil;
	}
	function get_data_historis_jembatan($kode){
		$hasil=$this->db->query("SELECT * FROM historis_jembatan where jembatan_pt_250k_id='$kode'");
		return $hasil;
	}
	function get_data_historis_sanitasi($kode){
		$hasil=$this->db->query("SELECT * FROM historis_sanitasi where sanitasi_sumsel_id='$kode'");
		return $hasil;
	}
	function get_data_historis_sungai($kode){
		$hasil=$this->db->query("SELECT * FROM historis_sungai where sungais_id='$kode'");
		return $hasil;
	}
	function get_data_historis_sungaipol($kode){
		$hasil=$this->db->query("SELECT * FROM historis_sungai_polys where sungai_polys_id='$kode'");
		return $hasil;
	}
	function get_data_historis_tol($kode){
		$hasil=$this->db->query("SELECT * FROM historis_tol where tol_ln_2017_sumatera_selatan_pubtr_geos_id='$kode'");
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

	function get_data_historis_kawasan_kumuh($kode){
		$hasil=$this->db->query("SELECT * FROM historis_kawasan_kumuh where kawasan_kumuh_id='$kode'");
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
	function get_dokumen_jalan_permukiman($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_jalan_permukiman where dokumentasi_jalan_id='$kode'");
		return $hasil;
	}
	function  get_dokumen_air_bersih($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_air_bersih where air_bersih_sumsel_id='$kode'");
		return $hasil;
	}
	function  get_dokumen_irigasi($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_irigasi where irigasi_id='$kode'");
		return $hasil;
	}
	function  get_dokumen_jembatan($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_jembatan where embatan_pt_250K_id='$kode'");
		return $hasil;
	}
	function  get_dokumen_sanitasi($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_sanitasi where dokumentasi_sanitasi_sumsel_id='$kode'");
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
		$hasil=$this->db->query("SELECT * FROM dokumentasi_tol where 	tol_ln_2017_sumatera_selatan_pubtr_geoid='$kode'");
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
	function  get_dokumen_kawasan_kumuh($kode){
		$hasil=$this->db->query("SELECT * FROM dokumentasi_kawasan_kumuh where dokumentasi_kawasan_kumuh_id='$kode'");
		return $hasil;
	}
	
	
/* ---------------------------------------------- */
	
	function get_jalan_provinsi_table(){
		$hasil = $this->db->query("SELECT * from jalan_provinsi left join target_jalan_provinsi on jalan_provinsi.jalan_id=target_jalan_provinsi.target_data_id left join historis_jalan_provinsi on jalan_provinsi.jalan_id=historis_jalan_provinsi.jalan_id");
		return $hasil;
	}
	function get_jalan_permukiman_table(){
		$hasil = $this->db->query("SELECT * from jalan_permukiman left join target_jalan_permukiman on jalan_permukiman.jalan_id=target_jalan_permukiman.target_data_id left join historis_jalan_permukiman on jalan_permukiman.jalan_id=historis_jalan_permukiman.jalan_id");
		return $hasil;
	}
	
	function get_jalan_nasional_table(){
		$hasil = $this->db->query("SELECT * from jalan_nasional left join target_jalan_nasional on jalan_nasional.jalan_id=target_jalan_nasional.target_data_id left join historis_jalan_nasional on jalan_nasional.jalan_id=historis_jalan_nasional.jalan_id");
		return $hasil;
	}
	
	
	function get_air_bersih_table(){
		$hasil = $this->db->query("SELECT * from air_bersih left join target_air_bersih on air_bersih.air_bersih_id=target_air_bersih.target_data_id left join historis_air_bersih on air_bersih.air_bersih_id=historis_air_bersih.air_bersih_id");
		return $hasil;
	}
	

	function get_jembatan_table(){
		$hasil = $this->db->query("SELECT * from jembatan left join target_jembatan on jembatan.jembatan_id=target_jembatan.target_data_id left join historis_jembatan on jembatan.jembatan_id=historis_jembatan.jembatan_pt_250k_id");
		return $hasil;
	}
	
	function get_irigasi_table(){
		$hasil = $this->db->query("SELECT * from irigasi left join target_irigasi on irigasi.irigasi_id=target_irigasi.target_data_id left join historis_irigasi on irigasi.irigasi_id=historis_irigasi.irigasi_id");
		return $hasil;
	}
	

	
	
	function get_pelabuhan_table(){
		$hasil = $this->db->query("SELECT * from pelabuhan left join target_pelabuhan on pelabuhan.pelabuhan_id=target_pelabuhan.target_data_id left join historis_pelabuhan on pelabuhan.pelabuhan_id=historis_pelabuhan.pelabuhan_id");
		return $hasil;
	}


	function get_terminal_table(){
		$hasil = $this->db->query("SELECT * from terminal left join target_terminal on terminal.terminal_id=target_terminal.target_data_id left join historis_terminal on terminal.terminal_id=historis_terminal.terminal_id");
		return $hasil;
	}


	
	function get_stasiun_table(){
		$hasil = $this->db->query("SELECT * from stasiun left join target_stasiun on stasiun.stasiun_id=target_stasiun.target_data_id left join historis_stasiun on stasiun.stasiun_id=historis_stasiun.stasiun_id");
		return $hasil;
	}
	
	
	
	function get_sanitasi_table(){
		$hasil = $this->db->query("SELECT * from sanitasi left join target_sanitasi on sanitasi.air_bersih_id=target_sanitasi.target_data_id left join historis_sanitasi on sanitasi.air_bersih_id=historis_sanitasi.sanitasi_sumsel_id");
		return $hasil;
	}


	function get_bandara_table(){
		$hasil = $this->db->query("SELECT * from bandara left join target_bandara on bandara.bandara_id=target_bandara.target_data_id left join historis_bandara on bandara.bandara_id=historis_bandara.bandara_id");
		return $hasil;
	}


	
	function get_sungai_table(){
		$hasil = $this->db->query("SELECT * from sungai left join target_sungai on sungai.sungai_id=target_sungai.target_data_id left join historis_sungai on sungai.sungai_id=historis_sungai.sungais_id");
		return $hasil;
	}


	function get_tol_table(){
		$hasil = $this->db->query("SELECT * from tol left join target_tol on tol.tol_ln_2017_sumatera_selatan_pubtr_geo_id=target_tol.target_data_id left join historis_tol on tol.tol_ln_2017_sumatera_selatan_pubtr_geo_id=historis_tol.tol_ln_2017_sumatera_selatan_pubtr_geos_id");
		return $hasil;
	}


	function get_sungaipol_table(){
		$hasil = $this->db->query("SELECT * from sungai_polys left join target_sungaipol on sungai_polys.sungai_poly_id=target_sungaipol.target_data_id left join historis_sungai_polys on sungai_polys.sungai_poly_id=historis_sungai_polys.sungai_polys_id");
		return $hasil;
	}

	
	function get_kawasan_kumuh_table(){
		$hasil = $this->db->query("SELECT * from kawasan_kumuh left join target_kawasan_kumuh on kawasan_kumuh.kawasan_kumuh_id=target_kawasan_kumuh.target_data_id left join historis_kawasan_kumuh on kawasan_kumuh.kawasan_kumuh_id=historis_kawasan_kumuh.kawasan_kumuh_id");
		return $hasil;
	}
	
} 
?>


