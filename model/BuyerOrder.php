<?php
class BuyerOrder {
    protected $db;

    public function __construct($database)
    {
        $this->db = $database;
    }
    public function getAllOrder($filter = null)
    {
        $link = $this->db->openDbConnection();
        if ($filter){
            $result =$link->query("SELECT * from orders " . $filter . " ORDER BY entry_at desc");
        }else {
            $result = $link->query('SELECT * FROM orders ORDER BY id');
        }

        $order = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $order[] = $row;
        }
        $this->db->closeDbConnection($link);
        return $order;
    }

    public function insert($data = null)
    {
        $link = $this->db->openDbConnection();

        $query = 'INSERT INTO orders (buyer,buyer_ip,buyer_email,phone,receipt_id,city,items,amount,note,hash_key,entry_at,entry_by) 
        VALUES (:buyer,:buyer_ip,:buyer_email,:phone,:receipt_id,:city,:items,:amount,:note,:hash_key,:entry_at,:entry_by)';
        $statement = $link->prepare($query);
        $statement->bindValue(':buyer', $data['name'], PDO::PARAM_STR);
        $statement->bindValue(':buyer_ip', $data['buyer_ip'], PDO::PARAM_STR);
        $statement->bindValue(':buyer_email', $data['email'], PDO::PARAM_STR);
        $statement->bindValue(':phone', $data['phone'], PDO::PARAM_STR);
        $statement->bindValue(':receipt_id', $data['receiptId'], PDO::PARAM_STR);
        $statement->bindValue(':city', $data['city'], PDO::PARAM_STR);
        $statement->bindValue(':items', $data['items'], PDO::PARAM_STR);
        $statement->bindValue(':amount', $data['amount'], PDO::PARAM_STR);
        $statement->bindValue(':note', $data['note'], PDO::PARAM_STR);
        $statement->bindValue(':hash_key', $data['hash_key'], PDO::PARAM_STR);
        $statement->bindValue(':entry_at', $data['entry_at'], PDO::PARAM_STR);
        $statement->bindValue(':entry_by', $data['entryBy'], PDO::PARAM_STR);
        $statement->execute();

        $this->db->closeDbConnection($link);
    }
}