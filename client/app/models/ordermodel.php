
<?php 

class ordermodel extends DModel{

    public function __construct(){
        parent::__construct();
    }

    public function addOrders($amount, $sale, $price, $total, $id_product, $id_restaurant, $id_user, $create_at, $time)
    { 
        $sql = "INSERT INTO orders SET amount=?,sale=?,price=?,total=?,id_product=?,id_restaurant=?,id_user=?,create_at=?,time=?";
        return $this->db->pdo_execute($sql, $amount, $sale, $price, $total, $id_product, $id_restaurant, $id_user, $create_at, $time);
    }

    public function listOrders($status, $id_user){
        if ($status == 4) {
            // $sql = "SELECT * FROM orders WHERE id_user=? ORDER BY id_order DESC";
            $sql = "SELECT orders.*, product.name_product, product.image FROM orders LEFT JOIN product
            ON orders.id_product = product.id_product WHERE id_user=? ORDER BY orders.id_order DESC";
            return $this->db->pdo_query($sql, $id_user);
        } else {
            $sql = "SELECT orders.*, product.name_product, product.image FROM orders LEFT JOIN product
            ON orders.id_product = product.id_product WHERE status_order=? AND id_user=? ORDER BY orders.id_order DESC";
            return $this->db->pdo_query($sql, $status, $id_user);
        }
    }

}

?>

