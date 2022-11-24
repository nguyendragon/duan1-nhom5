
<?php 

class categorymodel extends DModel{

    public function __construct(){
        parent::__construct();
    }
    //category product
    public function listCategory(){
        $sql = "SELECT * FROM category ORDER BY id_cate ASC";
        return $this->db->pdo_query($sql);
    }
    
    public function categoryById($id_cate){
        $sql = "SELECT * FROM category WHERE id_cate =? ";
        return $this->db->pdo_query_one($sql, $id_cate);
    }
}

?>

