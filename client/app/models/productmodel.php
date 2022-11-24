
<?php 

class productmodel extends DModel{

    public function __construct(){
        parent::__construct();
    }

    public function listProduct(){
        $sql = "SELECT * FROM product ORDER BY id_product DESC";
        return $this->db->pdo_query($sql);
    }

    public function productById($id_pro){
        $sql = "SELECT * FROM product WHERE id_product =? ";
        return $this->db->pdo_query_one($sql, $id_pro);
    }

    public function productByIdCate($id_cate){
        $sql = "SELECT * FROM product WHERE id_cate =? ";
        return $this->db->pdo_query($sql, $id_cate);
    }

    public function productByKeyWord($keyword){
        $sql = "SELECT * FROM product WHERE name_product LIKE ? ";
        return $this->db->pdo_query($sql, '%' . $keyword . '%');
    }

    public function productByIdRes($id_res){
        $sql = "SELECT * FROM product WHERE id_restaurant =? ";
        return $this->db->pdo_query($sql, $id_res);
    }
}

?>

