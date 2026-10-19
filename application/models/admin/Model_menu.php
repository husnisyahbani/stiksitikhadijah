<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_menu extends CI_Model 
{
    function show_submenu() {
        $sql = "SELECT * FROM tbl_menu WHERE menu_link IS NOT NULL AND menu_status='Show' ORDER BY menu_id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function show() {
        $sql = "SELECT * FROM tbl_menu";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function show_home() {
        $sql = "SELECT * FROM tbl_menu WHERE menu_name='Home' AND menu_status='Show'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function show_other() {
        $sql = "SELECT * FROM tbl_menu WHERE menu_name !='Home' AND menu_status='Show' AND menu_link IS NULL ORDER BY menu_id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function update($menu_id,$data) {
        $this->db->where('menu_id',$menu_id);
        $this->db->update('tbl_menu',$data);
    }

    function add($data) {
        $this->db->insert('tbl_menu',$data);
        return $this->db->insert_id();
    }

    function delete($menu_id) {
        $this->db->where('menu_id',$menu_id);
        $this->db->delete('tbl_menu');
    }

    function get_menu_by_id($menu_id) {
        $this->db->where('menu_id',$menu_id);
        $query = $this->db->get('tbl_menu');
        return $query->row();
    }
    
}