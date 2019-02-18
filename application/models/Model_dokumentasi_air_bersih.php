<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dokumentasi_air_bersih extends MY_Model {

	private $primary_key 	= 'kode_dabs';
	private $table_name 	= 'dokumentasi_air_bersih';
	private $field_search 	= ['air_bersih_sumsel_id', 'file', 'dokumen_tanggal', 'dokumentasi_nama'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "dokumentasi_air_bersih.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "dokumentasi_air_bersih.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "dokumentasi_air_bersih.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "dokumentasi_air_bersih.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "dokumentasi_air_bersih.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "dokumentasi_air_bersih.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('dokumentasi_air_bersih.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('air_bersih', 'air_bersih.air_bersih_id = dokumentasi_air_bersih.air_bersih_sumsel_id', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_dokumentasi_air_bersih.php */
/* Location: ./application/models/Model_dokumentasi_air_bersih.php */