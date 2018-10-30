<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_fitur_kategori_objek_pengamatans extends MY_Model {

	private $primary_key 	= 'KODE_FKOP';
	private $table_name 	= 'fitur_kategori_objek_pengamatans';
	private $field_search 	= ['KATEGORI_OBJEK_PENGAMATAN', 'JENIS_PLOT'];

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
	                $where .= "fitur_kategori_objek_pengamatans.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "fitur_kategori_objek_pengamatans.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "fitur_kategori_objek_pengamatans.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "fitur_kategori_objek_pengamatans.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "fitur_kategori_objek_pengamatans.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "fitur_kategori_objek_pengamatans.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('fitur_kategori_objek_pengamatans.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('kategori_objek_pengamatans', 'kategori_objek_pengamatans.KODE_KOP = fitur_kategori_objek_pengamatans.KATEGORI_OBJEK_PENGAMATAN', 'LEFT');
        $this->db->join('jenis_plots', 'jenis_plots.KODE_JP = fitur_kategori_objek_pengamatans.JENIS_PLOT', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_fitur_kategori_objek_pengamatans.php */
/* Location: ./application/models/Model_fitur_kategori_objek_pengamatans.php */