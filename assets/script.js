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


let currentSlide = 0;
const slides = document.querySelectorAll(".slide");
let slideTimer; // Automatic timer variable

function showSlide(index) {
    if (slides.length === 0) return;
    slides.forEach(slide => slide.classList.remove("active"));
    
    currentSlide = index;
    if (currentSlide >= slides.length) currentSlide = 0;
    if (currentSlide < 0) currentSlide = slides.length - 1;
    
    slides[currentSlide].classList.add("active");
}

function nextSlide() {
    showSlide(currentSlide + 1);
    resetSliderTimer(); 
}

function prevSlide() {
    showSlide(currentSlide - 1);
    resetSliderTimer(); 
}


function startSliderTimer() {
    slideTimer = setInterval(() => {
        showSlide(currentSlide + 1);
    }, 3000); 
}


function resetSliderTimer() {
    clearInterval(slideTimer);
    startSliderTimer();
}

showSlide(currentSlide);
startSliderTimer();

function addCart(id){
    fetch("cartaction.php?action=add", {
        method:"POST",
        body:new URLSearchParams({ id:id })
    })
    .then(res=>res.json())
    .then(data=>{
        updateCart(data);
        showMessage("Added to cart");
    })
    .catch(err => console.error("Error adding to cart:", err));
}

function changeQty(id, qty){
    qty = Number(qty);
    if(qty <= 0){
        removeItem(id);
        return;
    }

    fetch("cartaction.php?action=update", {
        method:"POST",
        body:new URLSearchParams({ id:id, qty:qty })
    })
    .then(r=>r.json())
    .then(data=>{
        updateCart(data);
    });
}

function removeItem(id){
    fetch("cartaction.php?action=remove", {
        method:"POST",
        body:new URLSearchParams({ id:id })
    })
    .then(r=>r.json())
    .then(data=>{
        updateCart(data);
        showMessage("Item removed");
    });
}

function loadCart(){
    fetch("cartaction.php?action=get")
    .then(r=>r.json())
    .then(data=>{
        updateCart(data);
    })
    .catch(err => console.log("Cart empty or setup pending"));
}

loadCart();


function updateCart(data) {
    if(!data || !data.items) return;

    document.getElementById("badge").innerHTML = data.count || 0;
    document.getElementById("cartCount").innerHTML = (data.count || 0) + " Items";

    let html = "";
    data.items.forEach(item=>{
        let qty = Number(item.qty);
        html += `
        <div class="cart-item">
            <img src="${item.image}">
            <div>
                <h4>${item.name}</h4>
                <p>Rs ${Number(item.price).toLocaleString()}</p>
                <div style="display: flex; align-items: center;">
                    <button onclick="changeQty(${item.id}, ${qty-1})">-</button>
                    <span>${qty}</span>
                    <button onclick="changeQty(${item.id}, ${qty+1})">+</button>
                    <button onclick="removeItem(${item.id})" style="margin-left:auto; background:#fee2e2; color:#dc2626;">Remove</button>
                </div>
            </div>
        </div>`;
    });

    document.getElementById("cartItems").innerHTML = html ? html : `<p style="text-align:center; color:#64748b; margin-top:20px;">Your cart is empty</p>`;
    document.getElementById("total").innerHTML = "Rs " + (data.total ? Number(data.total).toLocaleString() : 0);
}


function showMessage(text) {
    let msg = document.getElementById("msg");
    msg.innerHTML = text;
    msg.classList.add("show");

    setTimeout(()=>{
        msg.classList.remove("show");
    }, 1500);
}