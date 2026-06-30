<?php

session_start();

header('Content-Type: application/json');


include "products.php";


if(!isset($_SESSION['cart']))
{
    $_SESSION['cart']=[];
}



function sendResponse()
{

global $products;


$items=[];
$count=0;
$total=0;



foreach($_SESSION['cart'] as $id=>$qty)
{


if(is_array($qty))
{
    $qty = $qty['qty'];
}


foreach($products as $product)
{


if($product['id'] == $id)
{


$subtotal = $product['price'] * $qty;


$items[]=[

"id"=>$id,
"name"=>$product['name'],
"image"=>$product['image'],
"price"=>$product['price'],
"qty"=>$qty,
"subtotal"=>$subtotal

];


$count += $qty;
$total += $subtotal;


}


}


}



echo json_encode([

"items"=>$items,
"count"=>$count,
"total"=>$total

]);


exit;

}





$action = $_GET['action'] ?? '';




if($action=="add")
{


$id = $_POST['id'] ?? null;


if(!$id)
{
echo json_encode(["error"=>"Product id missing"]);
exit;
}



$id = (int)$id;


if(isset($_SESSION['cart'][$id]))
{

    if(is_array($_SESSION['cart'][$id]))
    {
        $_SESSION['cart'][$id]['qty']++;
    }
    else
    {
        $_SESSION['cart'][$id]++;
    }

}
else
{

    $_SESSION['cart'][$id] = 1;

}



sendResponse();

}




if($action=="update")
{


$id=$_POST['id'] ?? null;
$qty=$_POST['qty'] ?? 0;



if($qty <=0)
{

unset($_SESSION['cart'][$id]);

}
else
{

$_SESSION['cart'][$id]=$qty;

}


sendResponse();


}




if($action=="remove")
{


$id=$_POST['id'] ?? null;


unset($_SESSION['cart'][$id]);


sendResponse();


}





if($action=="get")
{

sendResponse();

}





echo json_encode([
"error"=>"Invalid action"
]);


?>