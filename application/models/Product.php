<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Product extends CI_Model
{

    public function __construct()
    {
        $this->tableTable = 'tb_table';
        $this->tableProduct = 'products';
        $this->ordTable = 'orders';
        $this->ordItemsTable = 'orders_items';
        $this->userTable = 'users';
    }

    /*
     * Fetch products data from the database
     * @param id returns a single record if specified, otherwise all records
     */
    public function getRows($id = '')
    {
        /* $branchCode = $this->session->userdata('branch');

        if ($branchCode == 'GH-101') {
        $this->db->select('*');
        $this->db->from($this->proTableRE);
        } else {} */
        $this->db->select('*');
        $this->db->from($this->proTable);
        $this->db->where('pro_status', '1');
        if ($id) {
            $this->db->where('id', $id);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            $this->db->order_by('product_name', 'asc');
            $query = $this->db->get();
            $result = $query->result_array();
        }

        // Return fetched data
        return !empty($result) ? $result : false;
    }

    /*
     * Fetch order data from the database
     * @param id returns a single record of the specified ID
     */
    public function getOrder($id)
    {
        $this->db->select('o.*');
        $this->db->from($this->ordTable . ' as o');
        // $this->db->join($this->tableTable . ' as t', 't.ta_id = o.order_book_id', 'left');
        $this->db->join($this->userTable . ' as u', 'u.us_id = o.user_id', 'left');
        $this->db->where('o.order_id', $id);
        $query = $this->db->get();
        $result = $query->row_array();

        // Get order items
        $this->db->select('i.quantity,i.sub_total,f.product_name,f.product_price,f.product_img');
        $this->db->from($this->ordItemsTable . ' as i');
        $this->db->join($this->tableProduct . ' as f', 'f.product_id = i.product_id', 'left');
        $this->db->where('i.order_id', $id);
        $query2 = $this->db->get();
        $result['items'] = ($query2->num_rows() > 0) ? $query2->result_array() : array();

        // Return fetched data
        return !empty($result) ? $result : false;
    }

    /*
     * Insert order data in the database
     * @param data array
     */
    public function updateUser($data)
    {
        // Add created and modified date if not included
        /* if (!array_key_exists("created", $data)) {
            $data['order_create'] = date("Y-m-d H:i:s");
        } */
        $this->db->where('us_id', (int)$this->session->userdata('user_id'));
        return $update = $this->db->update($this->userTable, $data);

    }


    /*
     * Insert order data in the database
     * @param data array
     */
    public function insertOrder($data)
    {
        // Add created and modified date if not included
        if (!array_key_exists("created", $data)) {
            $data['order_create'] = date("Y-m-d H:i:s");
        }
        // Insert order data
        $insert = $this->db->insert($this->ordTable, $data);
        // Return the status
        return $insert ? $this->db->insert_id() : false;
    }

    /*
     * Insert order items data in the database
     * @param data array
     */
    public function insertOrderItems($data = array())
    {
        // Insert order items
        $insert = $this->db->insert_batch($this->ordItemsTable, $data);
        // Return the status
        return $insert ? true : false;
    }
}
