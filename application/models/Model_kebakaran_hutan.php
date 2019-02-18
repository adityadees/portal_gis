<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kebakaran_hutan extends MY_Model {

	private $primary_key 	= 'kebakaran_id';
	private $table_name 	= 'kebakaran_hutan';
	private $field_search 	= ['kebakaran_kode', 'kecamatan_rawan', 'kecamatan_sangat_rawan', 'desa_rawan', 'desa_sangat_rawan', 'tahun'];

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
	                $where .= "kebakaran_hutan.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "kebakaran_hutan.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "kebakaran_hutan.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "kebakaran_hutan.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "kebakaran_hutan.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "kebakaran_hutan.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('kebakaran_hutan.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('air_bersih', 'air_bersih.air_bersih_id = kebakaran_hutan.kebakaran_kode', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_kebakaran_hutan.php */
/* Location: ./application/models/Model_kebakaran_hutan.php */