<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Universal_model extends CI_Model
{
    public function getOne($where, $tabel)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }

        $data = $this->db->get($tabel)->row();
        return (count((array)$data) > 0) ? $data : false;
    }
    public function getOneSelect($select, $where, $table)
    {
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $data = $this->db->get($table)->row();
        // echo $this->db->last_query(); die; // Alat debug query
        return $data;
    }
    public function getMulti($where, $tabel)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $data = $this->db->get($tabel)->result();
        return (count((array)$data) > 0) ? $data : false;
    }
    public function getMultiSelect($select, $where, $tabel)
    {
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }

        $data = $this->db->get($tabel)->result();
        return (count((array)$data) > 0) ? $data : false;
    }

    public function update($data, $where, $tabel)
    {
        $this->db->where($where);
        $update = $this->db->update($tabel, $data);
        return ($update) ? true : false;
    }

    public function insert($data, $tabel)
    {
        return ($this->db->insert($tabel, $data)) ? true : false;
    }

    public function delete($where, $tabel)
    {
        return ($this->db->where($where)->delete($tabel)) ? true : false;
    }

    public function delete_multiple($key, $where, $tabel)
    {
        return ($this->db->where_in($where, $key)->delete($tabel)) ? true : false;
    }

    public function getCustomBy($select, $where, $tabel, $order, $urutan, $limit, $group)
    {
        if (!empty($select)) {
            $this->db->select($select);
        }
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($urutan)) {
            $this->db->order_by($order, $urutan);
        } else {
            $this->db->order_by($order);
        }
        if (!empty($limit)) {
            $this->db->limit($limit);
        }
        if (!empty($group)) {
            $this->db->group_by($group);
        }

        $data = $this->db->get($tabel)->result();
        return $data;
    }
    public function insert_batch($data, $tabel)
    {
        $this->db->trans_start();
        $this->db->insert_batch($tabel, $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
}
