const panel = document.getElementById("cartPanel");

const overlay = document.getElementById("overlay");


document.getElementById("cartBtn").onclick = () => {

    panel.classList.add("active");
    overlay.classList.add("show");

}


document.getElementById("close").onclick = closeCart;

overlay.onclick = closeCart;



function closeCart(){

    panel.classList.remove("active");
    overlay.classList.remove("show");

}



function addCart(id){

fetch("cartaction.php?action=add",
{
method:"POST",
body:new URLSearchParams({
id:id
})
})

.then(res=>res.json())

.then(data=>{

updateCart(data);

showMessage("Added to cart");

});

}




function changeQty(id,qty){

qty = Number(qty);


if(qty < 0){
    qty = 0;
}


fetch("cartaction.php?action=update",
{

method:"POST",

body:new URLSearchParams({

id:id,
qty:qty

})

})

.then(r=>r.json())

.then(data=>{

updateCart(data);

});


}




function removeItem(id){


fetch("cartaction.php?action=remove",
{

method:"POST",

body:new URLSearchParams({

id:id

})

})

.then(r=>r.json())

.then(data=>{

updateCart(data);

});


}





function loadCart(){


fetch("cartaction.php?action=get")

.then(r=>r.json())

.then(data=>{

updateCart(data);

})


}


loadCart();





function updateCart(data)
{

if(!data)
return;



document.getElementById("badge").innerHTML = data.count || 0;



let html="";



data.items.forEach(item=>{


let qty = Number(item.qty);



html+=`

<div class="cart-item">


<img src="${item.image}">


<div>


<h4>${item.name}</h4>


<p>
Rs ${item.price}
</p>



<button onclick="changeQty(${item.id},${qty-1})">
-
</button>



<span>${qty}</span>



<button onclick="changeQty(${item.id},${qty+1})">
+
</button>



<button onclick="removeItem(${item.id})">
Remove
</button>


</div>


</div>

`;



});



document.getElementById("cartItems").innerHTML = html;



document.getElementById("total").innerHTML =
"Total: Rs " + (data.total || 0);



}




function showMessage(text)
{

let msg=document.getElementById("msg");


msg.innerHTML=text;


msg.classList.add("show");



setTimeout(()=>{

msg.classList.remove("show")

},1500);


}