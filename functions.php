<?php

$upload_directory = "uploads";

// helper functons

function last_id()
{
    global $connection;

    return mysqli_insert_id($connection);
}



function set_message($msg)
{
    if (!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {

        $msg = "";
    }
}



function display_message()
{
    if (isset($_SESSION['message'])) {

        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}



function redirect($location)
{
    header("Location: $location ");
}




function query($sql)
{
    global $connection;
    return mysqli_query($connection, $sql);
}




function confirm($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED " . mysqli_error($connection));
    }
}




function escape_string($string)
{
    global $connection;

    return mysqli_real_escape_string($connection, $string);
}




function fetch_array($result) {
    return mysqli_fetch_array($result);
}




//*********************************** FRONT END FUNCTION ********************************* *//



// get Products

// function get_products()
// {
//  
//     $query = query(" SELECT * FROM products   ");
//     confirm($query);
//
//  
//     while ($row = fetch_array($query)) {
//
//        $product_image = display_image($row['product_image']);
//  
//         $product = <<<DELIMETER
//         <div class="col-sm-4 col-lg-4 col-md-4">
//                     <div class="thumbnail">
//                         <a href="item.php?id={$row['product_id']}">
//                         <img style="height:150px;" src="../resources/{$product_image}" alt="">
//                         </a>
//                         <div class="caption">
//                             <h4 class="pull-right">&#36; {$row['product_price']}</h4>
//                             <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
//                             </h4>
//                             <p> {$row['short_desc']} </p>
//                             <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
//                         </div>
//                     </div>
//                 </div>
// DELIMETER;
//  
//         echo $product;
//     }
// }



// تسجيل اي عدد من المنتجات داخل الداشبورد
function count_all_records($table) {
    return mysqli_num_rows(query('SELECT * FROM ' . $table));
}


// تسجيل المنتجات من الصفحات
function count_all_products_in_stock(){

    return mysqli_num_rows(query('SELECT * FROM products WHERE product_quantity >= 1'));
}

// تسجيل الطلبات تبع المنتجات المشتراه
function count_all_orders_in_stock()
{

    return mysqli_num_rows(query('SELECT * FROM orders WHERE order_id >= 1'));
}

// تسجيل الكاتالوج تبعها منتجات مخصصه 
function count_all_categories_in_stock()
{

    return mysqli_num_rows(query('SELECT * FROM categories WHERE cat_id >= 1'));
}

// عدد البيانات المسجله
function count_all_reports_in_stock()
{

    return mysqli_num_rows(query('SELECT * FROM reports WHERE reports_id >= 1'));
}

function count_all_payers_in_stock()
{

    return mysqli_num_rows(query('SELECT * FROM payers WHERE payers_id >= 1'));
}






function get_products_with_pagination($perPage = "6")
{
    $rows = count_all_products_in_stock();

    if (isset($_GET['page'])) {

        //get page from URL if its there.
        $page = preg_replace('#[^0-9]#', '', $_GET['page']); //filter everything but numbers



    } else {
        $page = 1;
    }
    $lastPage = ceil($rows / $perPage);

    if ($page < 1) {
        $page = 1;
    } elseif ($page > $lastPage) {
        $page = $lastPage;
    }

    $middleNumbers = '';

    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;

    if ($page == 1) {
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
    } elseif ($page == $lastPage) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
    } elseif ($page > 2 && $page < ($lastPage - 1)) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub2 . '">' . $sub2 . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add2 . '">' . $add2 . '</a></li>';
    } elseif ($page > 1 && $page < $lastPage) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page= ' . $sub1 . '">' . $sub1 . '</a></li>';

        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' .  $add1 . '</a></li>';
    }

    $limit = 'LIMIT ' . ($page - 1) * $perPage . ',' . $perPage;

    $query2 = query("SELECT * FROM products WHERE product_quantity >= 1 " . $limit); // اظهار المنتج ع شكل واحد ليس متكرر

    confirm($query2);
    $outputPagination = ""; // Initialize the pagination output variable

    if ($page != 1) {
        $prev  = $page - 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $prev . '">Back</a></li>';
    }

    $outputPagination .= $middleNumbers;

    if ($page != $lastPage) {

        $next = $page + 1;

        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $next . '">Next</a></li>';
    }

    while ($row = fetch_array($query2)) {
        $product_image = display_image($row['product_image']);

        $product = <<<DELIMETER

        <div class="col-sm-3 col-lg-3 col-md-3">
            <div class="thumbnail" id="thumbnailmob">
            <div class="container2">
                <a href="item.php?id={$row['product_id']}">
            <img id="img-sequare" style="height:90px;" src="../resources/{$product_image}" alt="">
            </a>
             <button class="btn_above" target="_blank" onclick="location.href='../resources/cart.php?add={$row['product_id']}';" >
             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
             <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
             <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
             </button>
           </a>
           </div>
            </a>
             <div class="caption">
                 <h4 class="pull-right" id="pull_mob_margin">SR {$row['product_price']}</h4> <!-- For mobile -->
                 <h4>
                    <a style="float: right" href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                </h4>
                <br>
                 <p style="float: right; margin-right: 10px"> {$row['short_desc']} </p>
                 <h4 class="pull-left"> {$row['product_price']} SR</h4> <!--For larg sevices-->   
             </div>
         </div>
       </div>
DELIMETER;
        echo $product;
    }

    echo "<div class='text-center' style='clear: both;'>
    <ul class='pagination' >{$outputPagination}</ul></div>";
}





function get_products_with_pagination_cat($perPage = "6")
{
    $rows = count_all_products_in_stock();

    if (isset($_GET['page'])) {
        //get page from URL if its there.
        $page = preg_replace('#[^0-9]#', '', $_GET['page']); //filter everything but numbers



    } else {
        $page = 1;
    }
    $lastPage = ceil($rows / $perPage);

    if ($page < 1) {
        $page = 1;
    } elseif ($page > $lastPage) {
        $page = $lastPage;
    }

    $middleNumbers = '';
    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;

    if ($page == 1) {
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
    } elseif ($page == $lastPage) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
    } elseif ($page > 2 && $page < ($lastPage - 1)) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub2 . '">' . $sub2 . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';

        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add2 . '">' . $add2 . '</a></li>';
    } elseif ($page > 1 && $page < $lastPage) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';

        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
    }

    $limit = 'LIMIT ' . ($page - 1) * $perPage . ',' . $perPage;
    $query2 = query("SELECT * FROM products WHERE product_category_id = " . escape_string($_GET['id']) . " AND product_quantity >= 1 " . $limit);

    confirm($query2);
    $outputPagination = ""; // Initialize the pagination output variable

    if ($page != 1) {
        $prev  = $page - 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $prev . '">Back</a></li>';
    }

    $outputPagination .= $middleNumbers;

    if ($page != $lastPage) {
        $next = $page + 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $next . '">Next</a></li>';
    }

    while ($row = fetch_array($query2)) {
        $product_image = display_image($row['product_image']);

        $product = <<<DELIMETER
      
      
          <div class="col-md-3 col-sm-6 hero-feature">
          <div class="thumbnail">
          <a href="item.php?id={$row['product_id']}">
          <img style="height:150px;" src="../resources/{$product_image}" alt="">
          </a>

              <div class="caption">
                  <h3>{$row['product_title']}</h3>
                  <p>{$row['short_desc']}</p>
   
                  <p>
                      <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                  </p>
              </div>
          </div>
      </div>
DELIMETER;

        echo $product;
    }
    echo "<div class='text-center' style='clear: both;'><ul class='pagination' >{$outputPagination}</ul></div>";
}




// CATE SLIDE 

function get_products_cat_slide($perPage = "6")
{
    $rows = count_all_products_in_stock();

    if (isset($_GET['page'])) {
        //get page from URL if its there.
        $page = preg_replace('#[^0-9]#', '', $_GET['page']); //filter everything but numbers



    } else {
        $page = 1;
    }
    $lastPage = ceil($rows / $perPage);

    if ($page < 1) {
        $page = 1;
    } elseif ($page > $lastPage) {
        $page = $lastPage;
    }

    $middleNumbers = '';



    $query2 = query(" SELECT * FROM slidepro WHERE product_category_id = " . escape_string($_GET['id']) . " AND product_quantity >= 1");
    confirm($query2);
    $outputPagination = ""; // Initialize the pagination output variable

    if ($page != 1) {
        $prev  = $page - 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $prev . '">Back</a></li>';
    }

    $outputPagination .= $middleNumbers;

    if ($page != $lastPage) {
        $next = $page + 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $next . '">Next</a></li>';
    }

    while ($row = fetch_array($query2)) {
        $image_slide = display_image($row['image_slide']);

        $product = <<<DELIMETER
      
      
          <div class="col-md-3 col-sm-6 hero-feature">
          <div class="thumbnail">
          <a href="item.php?id={$row['slidepro_id']}">
          <img style="height:150px;" src="../resources/{$image_slide}" alt="">
          </a>

              <div class="caption">
                  <h3>{$row['product_title']}</h3>
                  <p>{$row['short_desc']}</p>
   
                  <p>
                      <a href="../resources/cart.php?add={$row['slidepro_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['slidepro_id']}" class="btn btn-default">More Info</a>
                  </p>
              </div>
          </div>
      </div>
DELIMETER;

        echo $product;
    }
}




// Categories THENG

function get_categories()
{
    $rows = count_all_categories_in_stock();

    global $connection;

    $query = "SELECT * FROM `categories`";
    $result = mysqli_query($connection, $query);
    confirm($result);
    while ($row = fetch_array($result)) { //call of fetch_array($result)

        $categories_links = <<<LIMIT
     <a href='category.php?id={$row['cat_id']}' class='list-group-item'>
     {$row['cat_title']}     
     
     </a>

     
LIMIT;

        echo $categories_links;
    }
}






//     // get Products
//      
//     function get_products_in_cat_page()
//     {
//      
//        $query = query(" SELECT * FROM products WHERE product_category_id = " . escape_string($_GET['id']) . " AND product_quantity >= 1 ");
//        confirm($query);
//              
//         while ($row = fetch_array($query)) {
//      
//            $product_image = display_image($row['product_image']);
//
//             $product = <<<DELIMETER
//      
//      
//             <div class="col-md-3 col-sm-6 hero-feature">
//             <div class="thumbnail">
//             <a href="item.php?id={$row['product_id']}">
//             <img style="height:150px;" src="../resources/{$product_image}" alt="">
//             </a>
//
//                 <div class="caption">
//                     <h3>{$row['product_title']}</h3>
//                     <p>{$row['short_desc']}</p>
//      
//                     <p>
//                         <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
//                     </p>
//                 </div>
//             </div>
//         </div>
//DELIMETER;
//      
//             echo $product;
//         }
//     }
//      





function get_products_in_shop_page()
{

    $query = query(" SELECT * FROM products WHERE product_quantity >= 1");
    confirm($query);

    while ($row = fetch_array($query)) {

        $product_image = display_image($row['product_image']);

        $product = <<<DELIMETER
      
      
             <div class="col-md-4 col-sm-4 hero-feature">
             <div class="thumbnail">
             <img style="height:150px;" src="../resources/{$product_image}" alt="">
             <div class="caption">
                     <h3>{$row['product_title']}</h3>
                     <p>{$row['short_desc']}</p>
      
                     <p>
                     <p><a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add</a>
                     <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a></p>
                         </p>
                 </div>
             </div>
         </div>
      
DELIMETER;

        echo $product;
    }
}




function get_products_in_slidepro()
{

    $query = query(" SELECT * FROM products");
    confirm($query);

    while ($row = fetch_array($query)) {

        $product_image = display_image($row['product_image']);

        $product = <<<DELIMETER

                 <div class="swiper-slide">
                 <a href="item.php?id={$row['product_id']}">
                 <img class="img_radus" src="../resources/{$product_image}" alt="">
                 </a>
                 </div>
DELIMETER;

        echo $product;
    }
}



function login_user()
{
    if (isset($_POST['submit'])) {

        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' ");
        confirm($query);

        if (mysqli_num_rows($query) == 0) {

            set_message("Your Password or Username are wrong");
            redirect("login.php");
        } else {

            $_SESSION['username'] = $username;
            redirect("admin");
        }
    }
}







function send_message()
{

    if (isset($_POST['submit'])) {

        $to = "saoodezx99@gmail.com";
        $from_name = $_POST['name'];
        $subject = $_POST['subject'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $headers = "From: {$from_name} {$email}";

        $result = mail($to, $subject, $message, $headers);

        if (!$result) {

            set_message("Sorry we could not send your message");
            redirect("contact.php");
        } else {

            set_message("Your Message has been sent");
        }
    }
}

//*********************************** BACK END FUNCTION ********************************* *//






function display_orders()
{

    $rows = count_all_orders_in_stock();


    $query = query("SELECT * FROM orders");
    confirm($query);

    while ($row = fetch_array($query)) {

        $orders = <<<DELIMETER
         <tr>
             <td>{$row['order_id']}</td>
             <td>{$row['order_amount']}</td>
             <td>{$row['order_transaction']}</td>
             <td>{$row['order_currency']}</td>
             <td>{$row['order_status']}</td>
             <td><a class="btn btn-danger" href="index.php?delete_orders_id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
  
             </tr>
DELIMETER;

        echo $orders;
    }
}



//***********************************  END Of Order ********************************* *//






//********************************  Admin products page ***************************** *//



function display_image($picture)
{
    global $upload_directory;

    return $upload_directory . DS . $picture;
}


//****  get products or products slide in admin **** *//


function get_products_in_admin()
{

    $query = query("SELECT * FROM products");
    confirm($query);
    while ($row = fetch_array($query)) {
        $category = show_product_category_title($row['product_category_id']);

        $product_image = display_image($row['product_image']);

        $product = <<<DELIMETER
         <tr>
             <td>{$row['product_id']}</td>
             <td>
                 <a>
                     <img style="width: 80px;" src="../../resources/{$product_image}" alt="">
                 </a>
             </td>
             <td>{$row['product_title']}</td>
             <td>{$category}</td>
             <td>{$row['product_price']}</td>
             <td>{$row['product_quantity']}</td>
             <td><a class="btn btn-default btn-number" href="index.php?edit_product&id={$row['product_id']}"><span class="glyphicon glyphicon-edit"></span></a></td>
             <td><a class="btn btn-default btn-number" href="index.php?delete_product_id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
  
  
         </tr>
  
 DELIMETER;
        echo $product;
    }
}


function get_products_slide_in_admin()
{

    $query = query("SELECT * FROM slidepro");
    confirm($query);
    while ($row = fetch_array($query)) {
        $category = show_product_category_title($row['product_category_id']);

        $image_slide = display_image($row['image_slide']);

        $product = <<<DELIMETER
         <tr>
             <td>{$row['slidepro_id']}</td>
             <td>
                 
                 <a href="index.php?edit_proslide&id={$row['slidepro_id']}">
                     <img style="width: 80px;" src="../../resources/{$image_slide}" alt="">
                 </a>
             </td>

             <td>{$category}</td>
             <td>{$row['product_price']}</td>
             <td>{$row['product_quantity']}</td>

             <td><a class="btn btn-danger" href="index.php?delete_slidepro_id={$row['slidepro_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
  
  
         </tr>
  
DELIMETER;
        echo $product;
    }
}



//****  END OF get products or products slide in admin **** *//



function get_reports()
{

    $query = query("SELECT * FROM reports");
    confirm($query);
    while ($row = fetch_array($query)) {

        $report = <<<DELIMETER
        <tr>
            <td>{$row['report_id']}</td>
            <td>{$row['product_id']}</td>
            <td>{$row['order_id']}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_title']}</td>
            <td>{$row['product_quantity']}</td>
            <td><a class="btn btn-danger" href="index.php?delete_report_id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
 
 
        </tr>
 
DELIMETER;
        echo $report;
    }
}





function show_product_category_title($product_category_id)
{

    $category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
    confirm($category_query);
    while ($category_row = fetch_array($category_query)) {
        return $category_row['cat_title'];
    }
}



//****************************  End Of Admin products  *********************** *//




//****************************  Add Products in admin  *********************** *//



function add_product()
{
    if (isset($_POST['publish'])) {

        $product_title           =     escape_string($_POST['product_title']);
        $product_category_id     =     escape_string($_POST['product_category_id']);
        $product_price           =     escape_string($_POST['product_price']);
        $product_quantity        =     escape_string($_POST['product_quantity']);

        $product_description     =     escape_string($_POST['product_description']);
        $short_desc              =     escape_string($_POST['short_desc']);



        $name_comment        =     escape_string($_POST['name_comment']);
        $text_comment        =     escape_string($_POST['text_comment']);


        $product_image           =     $_FILES['file']['name'];
        $product_image_top           =     $_FILES['filen']['name'];

        $image_temp_location     =     $_FILES['file']['tmp_name']; // it's tmp_name not temp_name
        $image_temp_location2     =     $_FILES['filen']['tmp_name']; // it's tmp_name not temp_name


        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);
        move_uploaded_file($image_temp_location2, UPLOAD_DIRECTORY . DS . $product_image_top);


        $query = query("INSERT INTO products(product_title, product_category_id, product_price, product_quantity, product_description, short_desc, product_image,product_image_top, name_comment, text_comment) VALUES('{$product_title}', '{$product_category_id}', '{$product_price}','{$product_quantity}', '{$product_description}', '{$short_desc}', '{$product_image}', '{$name_comment}', '{$text_comment}')");
        $last_id = last_id();
        confirm($query);

        set_message("New product with id {$last_id} was Added");
        redirect("index.php?products");
    }
}


function add_slidepro()
{

    if (isset($_POST['publish'])) {

        $product_title           =     escape_string($_POST['product_title']);
        $product_category_id     =     escape_string($_POST['product_category_id']);
        $product_price           =     escape_string($_POST['product_price']);

        $product_description     =     escape_string($_POST['product_description']);
        $short_desc              =     escape_string($_POST['short_desc']);

        $product_quantity        =     escape_string($_POST['product_quantity']);

        $image_slide        = $_FILES['file']['name'];
        $image_slide_location    = $_FILES['file']['tmp_name'];


        if (empty($image_slide)) {

            echo "<p class='bg-danger'>This field cannot be empty</p>";
        } else {

            move_uploaded_file($image_slide_location, UPLOAD_DIRECTORY . DS . $image_slide);

            $query = query("INSERT INTO slidepro(product_title, product_category_id, product_price, product_description, short_desc, product_quantity, image_slide) VALUES('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_description}', '{$short_desc}', '{$product_quantity}', '{$image_slide}')");



            confirm($query);
            set_message("image slide is Added");
            redirect("index.php?products_slide");
        }
    }
}






/************************************** UPDATING PRODUCS ************************************/

function update_product()
{
    if (isset($_POST['update'])) {

        $product_title          = escape_string($_POST['product_title']);
        $product_category_id    = escape_string($_POST['product_category_id']);
        $product_price          = escape_string($_POST['product_price']);
        $product_description    = escape_string($_POST['product_description']);
        $short_desc             = escape_string($_POST['short_desc']);
        $product_quantity       = escape_string($_POST['product_quantity']);
        $product_image          = escape_string($_FILES['file']['name']);
        $product_image_top          = escape_string($_FILES['filen']['name']);


        $image_temp_location    = escape_string($_FILES['file']['tmp_name']);
        $image_temp_location2    = escape_string($_FILES['filen']['tmp_name']);




        if (empty($product_image)) {

            $get_pic = query("SELECT product_image FROM products WHERE product_id =" . escape_string($_GET['id']) . " ");
            confirm($get_pic);

            while ($pic = fetch_array($get_pic)) {
                $product_image = $pic['product_image'];
            }
        }


        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);
        move_uploaded_file($image_temp_location2, UPLOAD_DIRECTORY . DS . $product_image_top);




        $query = "UPDATE products SET ";
        $query .= "product_title            = '{$product_title}'        , ";
        $query .= "product_category_id      = '{$product_category_id}'  , ";
        $query .= "product_price            = '{$product_price}'        , ";
        $query .= "product_description      = '{$product_description}'  , ";
        $query .= "short_desc               = '{$short_desc}'           , ";
        $query .= "product_quantity         = '{$product_quantity}'     , ";
        $query .= "product_image            = '{$product_image}'         , ";
        $query .= "product_image_top            = '{$product_image_top}'          ";




        $query .= "WHERE product_id=" . escape_string($_GET['id']);

        $send_update_query = query($query);

        $last_id = last_id();

        confirm($send_update_query);

        set_message("Product has been updated");

        redirect("index.php?products");
    }
}





function update_proslide()
{
    if (isset($_POST['update'])) {

        $product_title          = escape_string($_POST['product_title']);
        $product_category_id    = escape_string($_POST['product_category_id']);
        $product_price          = escape_string($_POST['product_price']);
        $product_description    = escape_string($_POST['product_description']);
        $short_desc             = escape_string($_POST['short_desc']);
        $product_quantity       = escape_string($_POST['product_quantity']);
        $image_slide          = escape_string($_FILES['file']['name']);
        $image_temp_location    = escape_string($_FILES['file']['tmp_name']);


        if (empty($image_slide)) {

            $get_pic = query("SELECT image_slide FROM slidepro WHERE slidepro_id =" . escape_string($_GET['id']) . " ");
            confirm($get_pic);

            while ($pic = fetch_array($get_pic)) {
                $image_slide = $pic['image_slide'];
            }
        }


        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $image_slide);


        $query = "UPDATE slidepro SET ";
        $query .= "product_title            = '{$product_title}'        , ";
        $query .= "product_category_id      = '{$product_category_id}'  , ";
        $query .= "product_price            = '{$product_price}'        , ";
        $query .= "product_description      = '{$product_description}'  , ";
        $query .= "short_desc               = '{$short_desc}'           , ";
        $query .= "product_quantity         = '{$product_quantity}'     , ";
        $query .= "image_slide            = '{$image_slide}'          "; // DON'T FORGOT THE , HAS TO DELETED


        $query .= "WHERE slidepro_id=" . escape_string($_GET['id']);

        $send_update_query = query($query);

        $last_id = last_id();

        confirm($send_update_query);

        set_message("Product with $last_id has been updated");

        redirect("index.php?products_slide");
    }
}


/************************************* END OF UPDATING ************************************** */




/************************************* categories in admin ************************************** */



// categories_option
function show_categories_add_product_page()
{
    $query = query("SELECT * FROM categories");
    confirm($query);

    while ($row = fetch_array($query)) {
        $categories_option = <<<DELIMITER
            <option value="{$row['cat_id']}">{$row['cat_title']}</option>
    DELIMITER;

        echo $categories_option;
    }
}





function show_categories_in_admin()
{
    $category_query = query("SELECT * FROM categories");
    confirm($category_query);
    while ($row = fetch_array($category_query)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        $category = <<<DELIMETER
        <tr>
            <td>{$cat_id}</td>
            <td>{$cat_title}</td>
            <td><a class="btn btn-default btn-number" href="index.php?edit_cate&id={$row['cat_id']}"><span class="glyphicon glyphicon-edit"></span></a></td>
            <td><a class="btn btn-default btn-number" href="index.php?delete_category_id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMETER;
        echo $category;
    }
}



function add_category()
{
    if (isset($_POST['add_category'])) {
        $cat_title = escape_string($_POST['cat_title']);
        if (empty($cat_title) || $cat_title == " ") {
            echo "<p class='bg-danger'>THIS CANNOT BE EMPTY</p>";
        } else {
            $insert_cat = query("INSERT INTO categories(cat_title) VALUES('{$cat_title}') ");
            confirm($insert_cat);
            set_message("Category Created");
        }
    }
}





/************************comments***********************/


/************************admin users***********************/


function display_total_invoice()
{
    $total = 0;
    $query_1 = query("SELECT * FROM payers WHERE payers_id =" . escape_string($_GET['id']) . " ");
    confirm($query_1);
    while ($row = fetch_array($query_1)) {
        $sub = $row['price'] + $row['prices'];
        $payer = <<<DELIMETER
    <tr class="item">
    <td>{$row['name']}<br>{$row['name2']}<br>{$row['name3']}</td>
    <td></td>
    <td></td>
    <td style="text-align:right">{$row['price']}<br>{$row['prices']}</td>
    </tr>
    DELIMETER;
        $_SESSION['item_tota'] = $total += $sub;
        echo $payer;
    }
}


function display_total_invoice2()
{
    $total = 0;
    $query_1 = query("SELECT * FROM payers WHERE payers_id =" . escape_string($_GET['id']) . " ");
    confirm($query_1);
    while ($row = fetch_array($query_1)) {
        $sub = $row['price_sec'];
        $payer = <<<DELIMETER
        <tr class="item">
        <td>{$row['name_v']}<br>{$row['name_v2']}<br>{$row['name_v3']}</td>
        <td></td>
        <td></td>
        <td style="text-align:right">{$row['price_sec']}<br></td>
        </tr>
        DELIMETER;

        $_SESSION['item_tota2'] = $total += $sub;
        echo $payer;
    }
}










function display_mobile_invoice()
{

    $query_1 = query("SELECT * FROM payers WHERE payers_id =" . escape_string($_GET['id']) . " ");
    confirm($query_1);
    while ($row = fetch_array($query_1)) {
        $payer = <<<DELIMETER
    <tr class="details">
    <td>
        {$row['first_mobile']}
    </td>
    <td></td>
    <td></td>
    <td style="text-align:right">
        {$row['serial_number']}
    </td>
    DELIMETER;
        echo $payer;
    }
}



function display_mobile_invoice2()
{
    $query_1 = query("SELECT * FROM payers WHERE payers_id =" . escape_string($_GET['id']) . " ");
    confirm($query_1);
    while ($row = fetch_array($query_1)) {
        $payer = <<<DELIMETER
        <tr class="details">
        <td>
            {$row['secound_mobile']}
        </td>
        <td></td>
        <td></td>
        <td style="text-align:right">
            {$row['serial_number2']}
        </td>
        DELIMETER;
        echo $payer;
    }
}


function display_meddle_invoice()
{
    $query_1 = query("SELECT * FROM payers WHERE payers_id =" . escape_string($_GET['id']) . " ");
    confirm($query_1);
    while ($row = fetch_array($query_1)) {
        $payer = <<<DELIMETER
    <tr class="details">
    <td>
        {$row['payment_method']}
    </td>
    <td></td>
    <td></td>
    <td style="text-align:right">
        {$row['price']}
    </td>
    </tr>
    DELIMETER;
        echo $payer;
    }
}

function display_meddle_invoice2()
{
    $query_1 = query("SELECT * FROM payers WHERE payers_id =" . escape_string($_GET['id']) . " ");
    confirm($query_1);
    while ($row = fetch_array($query_1)) {
        $payer = <<<DELIMETER
    <tr class="details">
    <td>
        {$row['payment_method2']}
    </td>
    <td></td>
    <td></td>
    <td style="text-align:right">
        {$row['price_sec']}
    </td>
    </tr>
    DELIMETER;
        echo $payer;
    }
}


function display_heading_invoice()
{
    $query_1 = query("SELECT * FROM payers WHERE payers_id =" . escape_string($_GET['id']) . " ");
    confirm($query_1);
    while ($row = fetch_array($query_1)) {
        $payers_id = $row['payers_id'];
        $date = $row['date'];
        $time = $row['time'];
        $payer = <<<DELIMETER
    <td>
    &Mopf;&Topf;&Gopf; &block; &Sopf;&topf;&oopf;&ropf;&zopf;
    <br>
    <br>

    Invoice #: {$payers_id}<br>
    Created: {$date}<br>
    Time: {$time}
    </td>
    </tr>
    DELIMETER;
        echo $payer;
    }
}


function display_heading_invoice2()
{
    $query_1 = query("SELECT * FROM payers WHERE payers_id =" . escape_string($_GET['id']) . "
");
    confirm($query_1);
    while ($row = fetch_array($query_1)) {
        $payers_id = $row['payers_id'];
        $created_at_2 = $row['created_at_2'];
        $payer = <<<DELIMETER
    <td>
    Invoice #: {$payers_id}<br>
    Created: {$created_at_2}<br>
    </td>
    DELIMETER;
        echo $payer;
    }
}





function display_transaction_dashbord() {
    $totalminus = 0;
    $query_1 = query("SELECT * FROM payers WHERE payers_id " . " ");
    confirm($query_1);
    
    while ($row = fetch_array($query_1)) {
        $subminus = $row['price'] + $row['price_sec'] - $row['price_minus'];
        $payers_id = $row['payers_id'];
        $name_account = $row['name_account'];
        $name = $row['name'];
        $price_minus = $row['price_minus'];
        $us_store = $row['us_store'];
        $created_at = $row['created_at'];
        $payer = <<<DELIMETER
        <tr>
            <td>{$payers_id}</td>
            <td>{$name_account}</td>
            <td>{$name}</td>
            <td>{$created_at}</td>
            <td>{$us_store} Dollar<br></td>
            <td>{$price_minus}SR<br></td>
            <td>{$subminus}SR<br></td>
        <td>
            <a class="btn btn-default btn-number"
                href="index.php?invoice&id={$row['payers_id']}"><span
                    class="glyphicon glyphicon-file"></span></a>
        </td>
        <td>
            <a class="btn btn-default btn-number"
                href="index.php?invoice2&id={$row['payers_id']}"><span
                    class="glyphicon glyphicon-file"></span></a>
        </td>
        </tr>
        DELIMETER;
            echo $payer;
            $_SESSION['item_totals_minus'] = $totalminus += $subminus;
        }
    }




function users_panel() {
    $query_1 = query("SELECT  * FROM `payers`, `log_users` WHERE payers_id = id ");
    confirm($query_1);

    while ($row = fetch_array($query_1)) {
        $id =             $row['id'] ;
        $usernameg =      $row['usernameg'];
        $created_at =     $row['created_at'];
        $payers_id = $row['payers_id'];
        $name           = $row['name'];
        $name_account   = $row['name_account'];
        $serial_number  = $row['serial_number'];
        $serial_number2 = $row['serial_number2'];
        $first_mobile   = $row['first_mobile'];
        $secound_mobile = $row['secound_mobile'];
        $email          = $row['email'];
        $pass           = $row['pass'];
        $price          = $row['price'];
        $price_sec      = $row['price_sec'];
        $price_minus    = $row['price_minus'];
        $money           = $row['money'];
        $code_note        = $row['code_note'];

        
        $payer = <<<DELIMETER
    <tr>
    
        <td>{$id}{$payers_id}</td>
        <td>{$usernameg}</td>
        <td>{$created_at}</td>
        
    </tr>
    
    DELIMETER;
        echo $payer;
    
    }
}











function display_imag_invoice()
{
    $category_query = query("SELECT payer_photo FROM payers WHERE payers_id =" .
        escape_string($_GET['id']) . " ");
    confirm($category_query);
    while ($row = fetch_array($category_query)) {
        $payer_photo = $row['payer_photo']; //**** */
        $payer = <<<DELIMETER
    <td>
    <a>
        <img style="width: 145px; height=" 80px"
            src="../../resources/uploads/$payer_photo" alt="">
    </a>
    </td>
    DELIMETER;
        echo $payer;
    }
}


function display_payers() {
    
    $total = 0;
    $totalmin = 0;
    $totalminus = 0;
    $totalmon = 0;
    $totalmonout = 0;
    $category_query = query("SELECT * FROM payers WHERE payers_id " . " ");
    confirm($category_query);
    
    while ($row = fetch_array($category_query)) {
        $sub = $row['price'] + $row['price_sec'];
        $submin = $row['price'] - $row['price_sec'];
        $subminus = $row['price'] + $row['price_sec'] - $row['price_minus'];
        $submonout = $row['price_minus'] - $row['price'] - $row['price_sec'];


        
        $payers_id = $row['payers_id'];
        $name = $row['name'];
        $name_account = $row['name_account'];
        $serial_number = $row['serial_number'];
        $serial_number2 = $row['serial_number2'];
        $first_mobile = $row['first_mobile'];
        $secound_mobile = $row['secound_mobile'];
        $email = $row['email'];
        $pass = $row['pass'];
        $price = $row['price'];
        $price_sec = $row['price_sec'];
        $price_minus = $row['price_minus'];
        $money = $row['money'];
        $code_note = $row['code_note'];
        $payer_photo = $row['payer_photo']; //**** */
        $user_show = $row['user_show']; //**** */
        $payer = <<<DELIMETER
    <tr>
    <td>{$payers_id}</td>
    <th>{$name_account}</th>
    <td>{$name}</td>
    <td>{$serial_number}<br>
        {$serial_number2}
    </td>
    <td>{$first_mobile},
        <br>{$secound_mobile},
        <br>{$email},
        <br>{$pass}
    </td>
    <td>{$user_show}<br>
        <a>
            <img style="width: 80px; height=" 80px"
                src="../../resources/uploads/$payer_photo" alt="">
        </a>
    </td>
    <td>
        <b>{$price}SR</b>
        <br>
        <b>{$price_sec}SR</b>
        <br>
        <b>{$price_minus}SR</b>
        
    </td>
    
    <td>
    <br>
        <b>{$subminus}SR</b> 
    </td>

    <td>
    <div class="dropdown dropleft float-right">
    <button type="button" data-toggle="dropdown" class="btn btn-default btn-number">
    <b class="caret"></b>
    </button>      
    
    <div class="dropdown-menu">
        <p style="padding: 10px" class="dropdown-item" href="#">
            {$code_note}
        </p>
    </div>
    </div>
    </div>
        
    </td>


    
    <td><a class="btn btn-default btn-number"
            href="index.php?edit_payer&id={$row['payers_id']}"><span
                class="glyphicon glyphicon-edit"></span></a></td>
    <td><a class="btn btn-default"
            href="index.php?delete_payers_id={$row['payers_id']}"><span
                class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
    DELIMETER;
        $_SESSION['item_totals_min']        = $totalmin += $submin;
        echo $payer;
        $_SESSION['item_totals']            = $total += $sub;
        $_SESSION['item_totals_minus']      = $totalminus += $subminus;
        $_SESSION['item_totals_mon']        = $totalmon += $money += $subminus;
        $_SESSION['item_totals_monout']     = $totalmonout += $submonout;
    }
}

function add_payer() {
    if (isset($_POST['add_payer'])) {
        $name_account      = escape_string($_POST['name_account']);
        $name              = escape_string($_POST['name']);
        $name2             = escape_string($_POST['name2']);
        $name3             = escape_string($_POST['name3']);
        $name_v            = escape_string($_POST['name_v']);
        $name_v2           = escape_string($_POST['name_v2']);
        $name_v3           = escape_string($_POST['name_v3']);
        $serial_number     = escape_string($_POST['serial_number']);
        $serial_number2     = escape_string($_POST['serial_number2']);
        $first_mobile       = escape_string($_POST['first_mobile']);
        $secound_mobile     = escape_string($_POST['secound_mobile']);
        $email             = escape_string($_POST['email']);
        $email2            = escape_string($_POST['email2']);
        $pass              = escape_string($_POST['pass']);
        $price             = escape_string($_POST['price']);
        $price_sec         = escape_string($_POST['price_sec']);
        $prices            = escape_string($_POST['prices']);
        $price_minus       = escape_string($_POST['price_minus']);
        $code_note          = escape_string($_POST['code_note']);
        $date               = escape_string($_POST['date']);
        $date2              = escape_string($_POST['date2']);
        $time                = escape_string($_POST['time']);
        $time2               = escape_string($_POST['time2']);
        $us_store            = escape_string($_POST['us_store']);
        $payment_method       = escape_string($_POST['payment_method']);
        $payment_method2      = escape_string($_POST['payment_method2']);
        $payer_photo          = $_FILES['file']['name'];
        $photo_temp_location  = $_FILES['file']['tmp_name'];
        
        move_uploaded_file($photo_temp_location, UPLOAD_DIRECTORY . DS . $payer_photo);
        $query = query("INSERT INTO payers(name_account,name,name2,name3,name_v, name_v2 ,name_v3 ,serial_number,serial_number2, first_mobile, secound_mobile, email,email2 , pass, price, prices, price_sec,price_minus,code_note, date,date2,time,time2, us_store, payment_method,payment_method2, payer_photo)
                    VALUES('{$name_account}','{$name}','{$name2}','{$name3}','{$name_v}','{$name_v2}','{$name_v3}' ,'{$serial_number}','{$serial_number2}','{$first_mobile}','{$secound_mobile}','{$email}','{$email2}','{$pass}', '{$price}', '{$price_sec}', '{$prices}','{$price_minus}','{$code_note}', '{$date}','{$date2}', '{$time}', '{$time2}','{$us_store}', '{$payment_method}','{$payment_method2}','{$payer_photo}')");
        confirm($query);

        
        set_message("Payer CREATED");
        redirect("/public/checkout.php");
    }
}

function update_payer() {
    if (isset($_POST['update'])) {
        $name = escape_string($_POST['name']);
        $name2 = escape_string($_POST['name2']);
        $name3 = escape_string($_POST['name3']);
        $name_v = escape_string($_POST['name_v']);
        $name_v2 = escape_string($_POST['name_v2']);
        $name_v3 = escape_string($_POST['name_v3']);
        $serial_number = escape_string($_POST['serial_number']);
        $serial_number2 = escape_string($_POST['serial_number2']);
        $first_mobile = escape_string($_POST['first_mobile']);
        $secound_mobile = escape_string($_POST['secound_mobile']);
        $email = escape_string($_POST['email']);
        $email2 = escape_string($_POST['email2']);
        $pass = escape_string($_POST['pass']);
        $price = escape_string($_POST['price']);
        $price_sec = escape_string($_POST['price_sec']);
        $prices = escape_string($_POST['prices']);
        $price_minus = escape_string($_POST['price_minus']);
        $money = escape_string($_POST['money']);
        $code_note = escape_string($_POST['code_note']);
        $date = escape_string($_POST['date']);
        $date2 = escape_string($_POST['date2']);
        $time = escape_string($_POST['time']);
        $time2 = escape_string($_POST['time2']);
        $us_store = escape_string($_POST['us_store']);
        $payment_method = escape_string($_POST['payment_method']);
        $payment_method2 = escape_string($_POST['payment_method2']);
        $payer_photo = $_FILES['file']['name'];
        $photo_temp_location = $_FILES['file']['tmp_name'];
        if (empty($payer_photo)) {
            $get_pic = query("SELECT payer_photo FROM payers WHERE payers_id =" .
                escape_string($_GET['id']) . " ");
            confirm($get_pic);
            while ($pic = fetch_array($get_pic)) {
                $payer_photo = $pic['payer_photo'];
            }
        }
        move_uploaded_file($photo_temp_location, UPLOAD_DIRECTORY . DS .
            $payer_photo);
        $query = "UPDATE payers SET ";
        $query .= "name = '{$name}' , ";
        $query .= "name2 = '{$name2}' , ";
        $query .= "name3 = '{$name3}' , ";
        $query .= "name_v = '{$name_v}' , ";
        $query .= "name_v2 = '{$name_v2}' , ";
        $query .= "name_v3 = '{$name_v3}' , ";
        $query .= "serial_number = '{$serial_number}' , ";
        $query .= "serial_number2 = '{$serial_number2}' , ";
        $query .= "first_mobile = '{$first_mobile}' , ";
        $query .= "secound_mobile = '{$secound_mobile}' , ";
        $query .= "email            = '{$email}' , ";
        $query .= "email2           = '{$email2}' , ";
        $query .= "pass             = '{$pass}' , ";
        $query .= "price            = '{$price}' , ";
        $query .= "price_sec        = '{$price_sec}' , ";
        $query .= "prices           = '{$prices}' , ";
        $query .= "price_minus     = '{$price_minus}' , ";
        $query .= "money           = '{$money}' , ";
        $query .= "code_note       = '{$code_note}' , ";
        $query .= "date             = '{$date}' , ";
        $query .= "date2            = '{$date2}' , ";
        $query .= "time             = '{$time}' , ";
        $query .= "time2            = '{$time2}' , ";
        $query .= "us_store         = '{$us_store}' , ";
        $query .= "payment_method   = '{$payment_method}' , ";
        $query .= "payment_method2  = '{$payment_method2}' , ";
        $query .= "payer_photo      = '{$payer_photo}' ";
        $query .= "WHERE payers_id  =" . escape_string($_GET['id']);

        $send_update_query          = query($query);

        $last_id                    = last_id();
        confirm($send_update_query);
        set_message("Product with $last_id has been updated");
        redirect("index.php?payers");
    }
}





function display_log_usres() {
    
    $category_query = query("SELECT * FROM log_users");
    confirm($category_query);
    
    while ($row = fetch_array($category_query)) {
        $id          = $row['id'];
        $usernameg   = $row['usernameg'];
        $passwordg   = $row['passwordg'];
        $created_at  = $row['created_at'];
        $user = <<<DELIMETER
        <tr>
            <td>{$id}</td>
            <td>{$usernameg}</td>
            <td>{$passwordg}</td>
            </td>
    <td>
        <a class="btn btn-default btn-number"
            href="index.php?edit_users_log&id={$row['id']}"><span
                class="glyphicon glyphicon-edit"></span></a>
    </td>
    <td><a class="btn btn-default btn-number"
            href="index.php?delete_user_log_id={$row['id']}"><span
                class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
    DELIMETER;
        echo $user;
    }
}


function update_user_log() {
    if (isset($_POST['update'])) {
        $usernameg = escape_string($_POST['usernameg']);
        $passwordg = escape_string($_POST['passwordg']);

        $query = "UPDATE log_users SET ";
        $query .= "usernameg = '{$usernameg}' , ";
        $query .= "passwordg = '{$passwordg}'  ";
        
        $query .= "WHERE id =" . escape_string($_GET['id']);
        $send_updates_query = query($query);
        $last_id = last_id();
        confirm($send_updates_query);
        set_message("Product has been updated");
        redirect("index.php?log_users");
    }
}



















function display_users() {
    
    $category_query = query("SELECT * FROM users");
    confirm($category_query);
    
    while ($row = fetch_array($category_query)) {
        $users_id = $row['users_id'];
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['password'];
        $user_photo = $row['user_photo']; //**** */
        $user_show = $row['user_show']; //**** */
        $user = <<<DELIMETER
        <tr>
            <td>{$users_id}</td>
            <td>{$username}</td>
            <td>{$email}</td>
            <td>{$password}</td>
            <td>{$user_show}<br>
                <a href="index.php?edit_user&id={$row['users_id']}">
                    <img style="width: 80px; height=" 80px"
                        src="../../resources/uploads/$user_photo" alt="">
                </a>
            </td>
    <td>
        <a class="btn btn-default btn-number"
            href="index.php?edit_user&id={$row['users_id']}"><span
                class="glyphicon glyphicon-edit"></span></a>
    </td>
    <td><a class="btn btn-default btn-number"
            href="index.php?delete_user_id={$row['users_id']}"><span
                class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
    DELIMETER;
        echo $user;
    }
}



function add_user() {
    if (isset($_POST['add_user'])) {
        $username = escape_string($_POST['username']);
        $email = escape_string($_POST['email']);
        $password = escape_string($_POST['password']);
        $user_photo = $_FILES['file']['name'];
        $photo_temp_location = $_FILES['file']['tmp_name'];
        move_uploaded_file($photo_temp_location, UPLOAD_DIRECTORY . DS .
            $user_photo);
        $query = query("INSERT INTO users(username,email,password,user_photo)
            VALUES('{$username}','{$email}','{$password}','{$user_photo}')");
        confirm($query);
        set_message("USER CREATED");
        redirect("index.php?users");
    }
}



function update_user() {
    if (isset($_POST['update'])) {
        $username = escape_string($_POST['username']);
        $email = escape_string($_POST['email']);
        $password = escape_string($_POST['password']);
        $user_photo = escape_string($_FILES['file']['name']);
        $photo_temp_location = escape_string($_FILES['file']['tmp_name']);
        if (empty($user_photo)) {
            $get_pics = query("SELECT user_photo FROM users WHERE users_id =" .
                escape_string($_GET['id']) . " ");
            confirm($get_pics);
            while ($pics = fetch_array($get_pics)) {
                $user_photo = $pics['user_photo'];
            }
        }


        move_uploaded_file($photo_temp_location, UPLOAD_DIRECTORY . DS .
            $user_photo);
        $query = "UPDATE users SET ";
        $query .= "username = '{$username}' , ";
        $query .= "email = '{$email}' , ";
        $query .= "password = '{$password}' , ";
        $query .= "user_photo = '{$user_photo}' ";
        $query .= "WHERE users_id=" . escape_string($_GET['id']);
        $send_updates_query = query($query);
        $last_id = last_id();
        confirm($send_updates_query);
        set_message("Product has been updated");
        redirect("index.php?users");
    }
}











function update_cate() {
    if (isset($_POST['update'])) {
        $cat_title = escape_string($_POST['cat_title']);
        $query = "UPDATE categories SET ";
        $query .= "cat_title = '{$cat_title}' ";
        $query .= "WHERE cat_id=" . escape_string($_GET['id']);
        $send_updates_query = query($query);
        $last_id = last_id();
        confirm($send_updates_query);
        set_message("Category has been updated");
        redirect("index.php?categories");
    }
}
//************************************************ SLIDES FUNCTIONS**********************************************//


function add_slides() {

    if (isset($_POST['add_slide'])) {
        $slide_title = escape_string($_POST['slide_title']);
        $slide_image = $_FILES['file']['name'];
        $slide_image_loc = $_FILES['file']['tmp_name'];
        if (empty($slide_title) || empty($slide_image)) {
            echo "<p class='bg-danger'>This field cannot be empty</p>";
        } else {
            move_uploaded_file($slide_image_loc, UPLOAD_DIRECTORY . DS .
                $slide_image);
            $query = query("INSERT INTO slides(slide_title, slide_image)
            VALUES('{$slide_title}', '{$slide_image}')");
            confirm($query);
            set_message("Slide Added");
            redirect("index.php?slides");
        }
    }
}



function get_current_slide_in_admin() {
    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);
    while ($row = fetch_array($query)) {
        $slide_image = display_image($row['slide_image']);
        $slide_active_admin = <<<DELIMETER
        <img style="height:250px" class="img-responsive curentimg" src="../../resources/{$slide_image}" alt="">
        DELIMETER;
        echo $slide_active_admin;
    }
}


function get_active_slide() {
    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);
    while ($row = fetch_array($query)) {
        $slide_image = display_image($row['slide_image']);
        $slide_active = <<<DELIMETER
        <div class="item active">
            <img class="slide-image" src="../resources/{$slide_image}" alt="">
        </div>
        DELIMETER;
        echo $slide_active;
    }
}


function get_slides() {
    $query = query("SELECT * FROM slides");
    confirm($query);
    while ($row = fetch_array($query)) {
        $slide_image = display_image($row['slide_image']);
        $slides = <<<DELIMETER
        <div class="item">
            <img class="slide-image" src="../resources/{$slide_image}" alt="">
        </div>
    DELIMETER;
        echo $slides;
    }
}


function get_slide_thumbnails() {
    $query = query("SELECT * FROM slides ORDER BY slide_id ASC ");
    confirm($query);
    while ($row = fetch_array($query)) {
        $slide_image = display_image($row['slide_image']);
        $slide_thumb_admin = <<<DELIMETER
    <div class="col-xs-6 col-md-3 image_container">
    <a href="index.php?delete_slide_id={$row['slide_id']}">
        <img class="img-responsive slide_image"
            src="../../resources/{$slide_image}" alt="">
    </a>
    <div class="caption">
        <p>{$row['slide_title']}</p>
        <td><a class="btn btn-danger"
                href="index.php?delete_slide_id={$row['slide_id']}"><span
                    class="glyphicon glyphicon-remove"></span></a>
        </td>
    </div>
    </div>
    DELIMETER;
        echo $slide_thumb_admin;
    }
}
//**********************************************************************************************//
//**********************************************************************************************//