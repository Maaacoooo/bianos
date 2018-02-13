<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

Class Sales_Model extends CI_Model {

// CREATE DATA ////////////////////////////////////////////////////////////////////

   /**
     * Generates ItemID
     * @return String the Distinct Item ID
     */
    function generate_ItemID() {
        $total_rows = $this->db->count_all('items');
        return 'ITEM'.prettyID(($total_rows + 1));  
    }

    function create() {

            $data = array(              
                'title'          => $this->input->post('title'),  
                'price'          => $this->input->post('price'),  
                'description'    => $this->input->post('description')
             );
       
          return $this->db->insert('sales', $data);    

    }


    function create_menu() {

            $data = array(              
                'title'          => $this->input->post('title')
             );
       
          return $this->db->insert('menu_category', $data);    

    }

    function update($id) { 

            $filename = $this->input->post('img'); //img filename empty if not present

            //Process Image Upload
              if($_FILES['img']['name'] != NULL)  {        

                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png'; 
                $config['encrypt_name'] = TRUE;                        

                $this->load->library('upload', $config);
                $this->upload->initialize($config);         
                
                $field_name = "img";
                $this->upload->do_upload($field_name);
                $data2 = array('upload_data' => $this->upload->data());
                foreach ($data2 as $key => $value) {     
                  $filename = $value['file_name'];
                }
                
            }

            $data = array(              
                'title'          => $this->input->post('title'),  
                'price'          => $this->input->post('price'),  
                'description'    => $this->input->post('description'),
                'category'       => $this->input->post('category'),
                'img'            => $filename
             );
       
            
            $this->db->where('id', $id);
            return $this->db->update('menu', $data);          
        
    }


    function update_menu($id) { 

            $data = array(              
                'title'          => $this->input->post('title'),  
             );
            
            $this->db->where('title', $id);
            return $this->db->update('menu_category', $data);          
        
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
            return $this->db->update('menu', $data);          

    }

    function delete_menu($id) {

 
           $data = array(           
                'is_deleted'      => 1
             );
            
            $this->db->where('title', $id);
            return $this->db->update('menu_category', $data);          

    }

    /**
     * Returns the paginated array of rows 
     * @param  int      $limit      The limit of the results; defined at the controller
     * @param  int      $id         the Page ID of the request. 
     * @return Array        The array of returned rows 
     */
    function fetch_items($limit, $id) {

            $this->db->select('
            menu.id,
            menu.title,
            menu.price,
            menu.category,
            menu.description,
            menu.img
            ');
            $this->db->where('menu.is_deleted', 0);
            $this->db->limit($limit, (($id-1)*$limit));

            $query = $this->db->get("menu");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    /**
     * Returns the total number of rows of users
     * @return int       the total rows
     */
    function count_items() {

        $this->db->where('is_deleted', 0);
        return $this->db->count_all_results("menu");
    }





    /**
     * Returns the paginated array of rows 
     * @param  int      $limit      The limit of the results; defined at the controller
     * @param  int      $id         the Page ID of the request. 
     * @return Array        The array of returned rows 
     */
    function fetch_categories($limit, $id) {

            $this->db->select('
              menu_category.title
            ');
            $this->db->where('menu_category.is_deleted', 0);
            $this->db->limit($limit, (($id-1)*$limit));

            $query = $this->db->get("menu_category");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    /**
     * Returns the total number of rows of users
     * @return int       the total rows
     */
    function count_categories() {

        $this->db->where('is_deleted', 0);
        return $this->db->count_all_results("menu_category");
    }






    function view($id) {

             $this->db->select('*');        
             $this->db->where('id', $id);               
             $this->db->limit(1);

             $query = $this->db->get('menu');

             return $query->row_array();
    }

    function check_serial($id, $serial) {

             $this->db->select('*');        
             $this->db->where('id !=', $id);          
             $this->db->where('serial', $serial);          
             $this->db->limit(1);

             $query = $this->db->get('items');

             return $query->row_array();
    }


    /**
     * Fetches the quantity of the item in each location
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function fetch_item_inventory($id) {

            $this->db->join('item_inventory', 'item_inventory.location = item_location.title', 'left');
            $this->db->join('items', 'items.id = item_inventory.item_id', 'left');
            $this->db->group_by('item_location.id');
            $this->db->select('
                item_location.title,
                SUM(item_inventory.qty) as qty
            ');            

            $this->db->where('items.id', $id);

            $query = $this->db->get("item_location");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }


    function total_inventory() {

            $this->db->join('item_inventory', 'item_inventory.item_id = items.id', 'left');
            $this->db->group_by('items.id');
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
            

            $this->db->where('items.is_deleted', 0);
            $query = $this->db->get("items");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }


    //////////////
    // HELPERS

    function fetch_brand() {

            $this->db->select('*');
            $this->db->where('is_deleted', 0);
            $query = $this->db->get('item_brand');

            return $query->result_array();

    }


    function fetch_category() {

            $this->db->select('*');
            $this->db->where('is_deleted', 0);
            $query = $this->db->get('menu_category');

            return $query->result_array();

    }


    function fetch_unit() {

            $this->db->select('*');
            $this->db->where('is_deleted', 0);
            $query = $this->db->get('item_unit');

            return $query->result_array();

    }


    function search($q, $brand){
            
            if($brand) {
              $this->db->having('brand', $brand);
            }
            $this->db->like('name', $q);
            $this->db->or_like('description', $q);
            $this->db->or_like('serial', $q);
            $this->db->or_like('id', $q);

            $this->db->limit(15);
            $query = $this->db->get('items');
            
            return $query->result_array();
  }


    function search_menu($term) {
        $this->db->like('title', $term);
        $this->db->or_like('price', $term);

        $query = $this->db->get("menu");

        log_message('error', $this->db->last_query());
        return $query->result_array();



    }

}