
<?php 

class restaurantmodel extends DModel{

    public function __construct(){
        parent::__construct();
    }

    public function listRestaurant(){
        $sql = "SELECT * FROM restaurants ORDER BY id_restaurant DESC";
        return $this->db->pdo_query($sql);
    }

    public function restaurantByLink($link){
        $sql = "SELECT * FROM restaurants WHERE link =?";
        return $this->db->pdo_query_one($sql, $link);
    }
}

?>

