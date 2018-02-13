<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

Class Category_Model extends CI_Model {

// CREATE DATA ////////////////////////////////////////////////////////////////////


    function create() {
        
            $data = array(              
                'title'  => $this->input->post('title')
             );
       
            return $this->db->insert('item_category', $data);    
    }


    function update($id) { 

            $data = array(                
                'title'           => $this->input->post('title')
             );
       
            
            $this->db->where('id', $id);
            return $this->db->update('item_category', $data);          
        
    }


        /**
     * Deletes a user record
     * @param  int    $id    the DECODED id of the item.   
     * @return boolean    returns TRUE if success
     */
    function delete($id) {

 
           $data = array(           
                'is_deleted'      => 1
             );
            
            $this->db->where('id', $id);
            return $this->db->update('item_category', $data);          

    }


    /**
     * Returns the paginated array of rows 
     * @param  int      $limit      The limit of the results; defined at the controller
     * @param  int      $id         the Page ID of the request. 
     * @return Array        The array of returned rows 
     */
    function fetch_categories($limit, $id, $search) {

            if($search) {
              $this->db->like('item_category.title', $search);
            }

            $this->db->select('
                item_category.id,
                item_category.title
            ');
            

            $this->db->where('item_category.is_deleted', 0);
            $this->db->limit($limit, (($id-1)*$limit));

            $query = $this->db->get("item_category");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    /**
     * Returns the total number of rows of users
     * @return int       the total rows
     */
    function count_categories($search) {
        if($search) {
          $this->db->like('title', $search);
        }
        $this->db->where('is_deleted', 0);
        return $this->db->count_all_results("item_category");
    }


    function view($id) {

             $this->db->select('*');        
             $this->db->where('id', $id);          
             $this->db->limit(1);

             $query = $this->db->get('item_category');

             return $query->row_array();
    }


    /**
     * Fetches the quantity of the item in each category
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function fetch_inventory($limit, $id, $category) {

            $this->db->join('items', 'items.id = item_inventory.item_id', 'left');
            $this->db->group_by('item_inventory.item_id');
            $this->db->select('
                items.id,
                items.name,
                items.brand,
                items.category,
                items.SRP,
                items.DP,
                items.serial,
                items.unit,
                SUM(item_inventory.qty) as qty
            ');            
            $this->db->limit($limit, (($id-1)*$limit));            
            $this->db->where('items.category', $category);

            $query = $this->db->get("item_inventory");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    function count_inventory($category) {
        $this->db->join('items', 'items.id = item_inventory.item_id', 'left');
        $this->db->group_by('item_inventory.item_id');
        $this->db->where('items.is_deleted', 0);
        $this->db->where('items.category', $category);
        $this->db->select('items.id'); 
        return $this->db->count_all_results("item_inventory");
    }


}