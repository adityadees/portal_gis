<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_historis_kawasan_kumuh extends MY_Model {

	private $primary_key 	= 'kode_historis_kk';
	private $table_name 	= 'historis_kawasan_kumuh';
	private $field_search 	= ['kawasan_kumuh_id', 'historis_vefektif', 'historis_tahun', 'historis_namakeg', 'historis_vpenanganan', 'historis_sdana', 'historis_ket', 'maplinks_id'];

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
	                $where .= "historis_kawasan_kumuh.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "historis_kawasan_kumuh.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "historis_kawasan_kumuh.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "historis_kawasan_kumuh.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "historis_kawasan_kumuh.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "historis_kawasan_kumuh.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('historis_kawasan_kumuh.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('kawasan_kumuh', 'kawasan_kumuh.kawasan_kumuh_id = historis_kawasan_kumuh.kawasan_kumuh_id', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_historis_kawasan_kumuh.php */
/* Location: ./application/models/Model_historis_kawasan_kumuh.php */