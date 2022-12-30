<?php
require("./root/db.php");

//Fetch cards
$result = $conn->query("SELECT * FROM Inventory ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>

<!--TITLE-->
<title>Product Card</title>

<!--SHORTCUT ICON-->
<link rel="shortcut icon" href="#" />

<!--META TAGS-->
<meta charset="UTF-8" />
<meta name="language" content="ES" />
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />

<!--FONT AWESOME-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

<!--GOOGLE FONTS-->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

<!--PLUGIN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!--STYLE SHEET-->
<link rel="stylesheet" href="assets/css/main.css" />

</head>
<body id="body">

<!--MAIN-->
<main class="padding_2x">
    <!--search bar-->
    <div class="search_bar">
        <input type="text" name="search" placeholder="Search..." maxlength="100">
        <button class="btn btn2 search">Search <i class="fa fa-search"></i></button>
    </div>
    <!--add product button-->
    <div class="title_header">
        <h1 class="flex_content big">Products</h1>
        <aside class="flex_content"><a href="#add_product" class="btn btn1"><i class="fa fa-plus"></i> Add product</a></aside>
    </div>
    <!--cards-->
    <div class="cards flex">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '
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
            echo '
                <!--card begining-->
                <section class="card flex_content padding_1px">
                    <figure>
                        <img src="assets/images/cards/default.png" alt="" loading="lazy" />
                    </figure>
                    <article class="padding_1x">
                        <a href="#" class="small">No Product Found</a>
                    </article>
                </section>
                <!--card ends-->
            ';
        }
        $conn->close();
        ?>
    </div>
    
    <!--modal-->
    <div class="modal" id="add_product">
        <form class="padding_2x">
            <a href="#" class="close"><i class="fa fa-times"></i></a>
            <fieldset>
                <label>Upload product image*
                    <input type="file" name="image" accept=".jpg,.JPG,.png,.PNG,.jpeg,.JPEG" />
                </label>
            </fieldset>
            <fieldset>
                <label>Product name*</label>
                <input type="text" name="pname" placeholder="eg: Farm Tomotoes" maxlength="50" />
            </fieldset>
            <fieldset>
                <label>Price in Rupee*</label>
                <input type="number" name="price" value="1" min="1" max="1000" />
            </fieldset>
            <fieldset>
                <label> Kg
                    <input type="radio" name="unit" value="kg" />
                </label>
                 <label> Mtr
                    <input type="radio" name="unit" value="mtr" />
                </label>
                 <label> Ltr
                    <input type="radio" name="unit" value="ltr" />
                </label>
            </fieldset>
            <fieldset>
                <button class="btn btn2 add"><i class="fa fa-plus"></i> Add product</button>
            </fieldset>
        </form>
    </div>
</main>

<!--JAVASCRIPT-->
<script type="text/javascript" src="assets/js/custom.js"></script>
</body>
</html>
