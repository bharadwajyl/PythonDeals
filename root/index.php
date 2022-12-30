<?php
//Check the type of the form posted
switch ($_POST["FormType"]) {
    case "Add_Product":
        Product::Add(''.$_POST['pname'].'', ''.$_POST['price'].'', ''.$_POST['unit'].'');
        break;
    case "search":
        Product::Fetch(''.$_POST["search_value"].'');
        break;
    default:
        die("Not Allowed");
        break;
}

class Product{
    public function Add($pname, $price, $unit){
        try {
            require("db.php");
            include("insert.php");
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }
    public function Fetch($search){
        try {
            require("db.php");
            include("fetch.php");
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }
}
?>
