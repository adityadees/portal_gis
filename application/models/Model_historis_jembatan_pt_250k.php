<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_historis_jembatan_pt_250k extends MY_Model {

	private $primary_key 	= 'kode_historis_jembatan_pt_250k';
	private $table_name 	= 'historis_jembatan_pt_250k';
	private $field_search 	= ['kode_historis_jembatan_pt_250k', 'jembatan_pt_250k_id', 'historis_vefektif', 'historis_tahun', 'historis_vpenanganan', 'historis_sdana', 'historis_ket', 'historis_namakeg'];

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
	                $where .= "historis_jembatan_pt_250k.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "historis_jembatan_pt_250k.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "historis_jembatan_pt_250k.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "historis_jembatan_pt_250k.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "historis_jembatan_pt_250k.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "historis_jembatan_pt_250k.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('historis_jembatan_pt_250k.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('jembatan_pt_250k', 'jembatan_pt_250k.jembatan_id = historis_jembatan_pt_250k.jembatan_pt_250k_id', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_historis_jembatan_pt_250k.php */
/* Location: ./application/models/Model_historis_jembatan_pt_250k.php */