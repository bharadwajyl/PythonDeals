<?php
switch($_POST["FormType"]){
    case "Add_Product":
        //Remove all quotes from product name
        $pname = trim($pname,'\'"');
        

        //Upload images
        $file_url = "assets/images/cards/default.png";
        if (isset($_FILES["image"]["name"])){
            $file = "../assets/images/cards/" . basename($_FILES["image"]["name"]);
           if ($_FILES["image"]["size"] > 500000){
                print("*File size should be below 500kb");
                return 1;
            } else{
                $temp_id_file = explode(".", $_FILES["image"]["name"]);
                $new_file = round(microtime(true)) . '.' . end($temp_id_file);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/images/cards/" . $new_file)){
                    $file_url = "assets/images/cards/$new_file";
                }
            }
        }

        //Insert into Inventory
        $sql = "INSERT INTO Inventory (pname, price, unit, image) VALUES ('$pname', '$price', '$unit', '$file_url')";
        $conn->query($sql) === TRUE ? print('success: Product added') : print('failure: Try again');
        break;
    default:
        die("Not Allowed");
        break;
}  
?>
