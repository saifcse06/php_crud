<?php

class BuyerOrderController
{
    protected $model = '';
    protected $baseUrl = '';

    public function __construct($model,$baseUrl)
    {
        $this->model = $model;
        $this->baseUrl = 'http://localhost/php_crud/index.php/';
    }

    public function index()
    {
        if(!empty($_POST["search"]["entry_at"])) {
            $entry_at = $_POST["search"]["entry_at"];
            list($fid,$fim,$fiy) = explode("-",$entry_at);

            $entry_at_todate = date('Y-m-d');
            if(!empty($_POST["search"]["entry_at_to_date"])) {
                $entry_at_to_date = $_POST["search"]["entry_at_to_date"];
                list($tid,$tim,$tiy) = explode("-",$_POST["search"]["entry_at_to_date"]);
                $post_at_todate = "$tiy-$tim-$tid";
            }

            $queryCondition .= "WHERE entry_at BETWEEN '$fiy-$fim-$fid' AND '" . $post_at_todate . "'";

            $orders = $this->model->getAllOrder($queryCondition);

        }else{
            $orders = $this->model->getAllOrder();

        }
        require 'view/buyer_order/list.php';
    }
    public function create()
    {
        $date = new DateTime();
        $date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
        $date = $date->format('Y-m-d');
        $errorMSG = null;
        $phone_number = filter_var($_POST["phone"], FILTER_SANITIZE_NUMBER_INT);
        $entryBy = filter_var($_POST["entry_by"], FILTER_SANITIZE_NUMBER_INT);
        $amount = filter_var($_POST["amount"], FILTER_SANITIZE_NUMBER_INT);

        if ($_POST) {
            /* NAME */
            if (empty($_POST["name"])) {
                $errorMSG .= "Name is required.";
            } elseif (strlen($_POST["name"]) >= 20) {
                $errorMSG .= "Maximum Character Length 20.";
            } else {
                $data['name'] = $_POST["name"];
            }

            /* EMAIL */
            if (empty($_POST["email"])) {
                $errorMSG .= "Email is required.";
            } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $errorMSG .= "Invalid email format.";
            } else {
                $data['email'] = $_POST["email"];
            }

            /* Phone */
            if (empty($_POST["phone"])) {
                $errorMSG .= "Phone is required.";
            } else if (!filter_var($phone_number, FILTER_SANITIZE_NUMBER_FLOAT)) { //check for valid numbers in phone number field
                $errorMSG .= "Enter only digits in mobile number.";
            } else {
                $data['phone'] = $_POST["phone"];
            }

            /* City*/
            if (empty($_POST["city"])) {
                $errorMSG .= "City is required.";
            } else if (ctype_alpha(str_replace(' ', '', $_POST["city"])) === false) {
                $errorMSG .= 'City must contain letters and spaces only.';
            } else {
                $data['city'] = $_POST["city"];
            }

            /* Receipt Id */
            if (empty($_POST["receipt_id"])) {
                $errorMSG .= "Phone is required.";
            } else if (ctype_alpha(str_replace(' ', '', $_POST["receipt_id"])) === false) {
                $errorMSG .= 'Receipt id must contain letters and spaces only.';
            } else {
                $data['receiptId'] = $_POST["receipt_id"];
            }

            /* Items */
            if (empty($_POST["items"])) {
                $errorMSG .= "Items is required.";
            } else if (ctype_alpha(str_replace(' ', '', $_POST["items"])) === false) {
                $errorMSG .= "Enter only digits in mobile number.";
            } else {
                $data['items'] = $_POST["items"];
            }

            /* Amount */
            if (empty($_POST["amount"])) {
                $errorMSG .= "City is required.";
            } else if (!filter_var($amount, FILTER_SANITIZE_NUMBER_FLOAT)) { //check for valid numbers in phone number field
                $errorMSG .= "Enter only digits in amount.";

            } else {
                $data['amount'] = $_POST["amount"];
            }

            /* Note */
            if (empty($_POST["note"])) {
                $errorMSG .= "Name is required.";
            } elseif (strlen($_POST["note"]) >= 30) {
                $errorMSG .= "Maximum Character Length 20.";
            } else {
                $data['note'] = $_POST["note"];
            }

            /* Entry By ID */
            if (empty($_POST["entry_by"])) {
                $errorMSG .= "Entry By ID is required.";
            } else if (!filter_var($entryBy, FILTER_SANITIZE_NUMBER_FLOAT)) { //check for valid numbers in phone number field
                $errorMSG .= 'Entry By ID only digits in mobile number.';
            } else {
                $data['entryBy'] = $_POST["entry_by"];
            }

            $data['buyer_ip'] = $_POST["buyer_id"];
            $data['hash_key'] = openssl_digest($data['receiptId'], 'sha512') ;
            $data['entry_at'] = $date;

            if ($errorMSG == null) {

                setcookie($data['name'], $data['email'], time() + (86400 * 30), "/");
                if(!isset($_COOKIE[$data['name']])) {
                    $this->model->insert($data);
                }else{
                    echo json_encode(['code' => 404, 'msg' => "Already Added, Try Again"]);
                }
                echo json_encode(['code' => 200, 'msg' => "Successfully Data Save"]);
            } else {
                echo json_encode(['code' => 404, 'msg' => $errorMSG]);
            }
        } else {
            require "view/buyer_order/form.php";
        }

    }


}