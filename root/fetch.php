<?php
switch($_POST["FormType"]){
    case "search":
        $search = strtolower($search);
        //Fetch cards
        $result = $conn->query("SELECT * FROM Inventory WHERE pname LIKE '%$search%' OR price = '$search' OR unit = '$search' ORDER BY id DESC");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $output .= '
                    <!--card begining-->
                    <section class="card flex_content padding_1px">
                        <figure>
                            <img src="'.$row["image"].'" alt="" loading="lazy" />
                        </figure>
                        <article class="padding_1x">
                            <a href="#" class="small">'.$row["pname"].'</a>
                            <span class="price"><i class="fa fa-rupee"></i> '.$row["price"].'/'.$row["unit"].'</span>
                        </article>
                    </section>
                    <!--card ends-->
                ';
            }
        } else {
            $output = 'failure: No result found';
        }
        print($output);
        $conn->close();
        break;
    default:
        die("Not Allowed");
        break;
}
?>
