let listCart = [];


function checkCart() {
    var cookieValue = document.cookie
        .split('; ')
        .find(row => row.startsWith('listCart='));
    if (cookieValue) {
        try {
            listCart = JSON.parse(cookieValue.split('=')[1]);
        } catch (e) {
            console.error("Invalid JSON in listCart cookie:", e);
            listCart = []; 
        }
    }
}


function addCartToHTML() {
    let listCartHTML = document.querySelector('.returnCart .list');
    listCartHTML.innerHTML = ''; 

    let totalQuantityHTML = document.querySelector('.totalQuantity');
    let totalPriceHTML = document.querySelector('.totalPrice');

    let totalQuantityInput = document.getElementById('totalQuantityInput');
    let totalPriceInput = document.getElementById('totalPriceInput');
    let cartDataInput = document.getElementById('cartDataInput'); 

    let totalQuantity = 0;
    let totalPrice = 0;

  
    if (listCart && listCart.length > 0) {
        listCart.forEach(product => {
            if (product && product.name && product.price && product.quantity && product.image) {
                let newCart = document.createElement('div');
                newCart.classList.add('item');
                newCart.innerHTML = 
                    `<img src="${product.image}" alt="${product.name}">
                    <div class="info">
                        <div class="name">${product.name}</div>
                        <div class="price">₱${product.price}/1 product</div>
                    </div>
                    <div class="quantity">${product.quantity}</div>
                    <div class="returnPrice">₱${product.price * product.quantity}</div>`;
                listCartHTML.appendChild(newCart);

                totalQuantity += product.quantity;
                totalPrice += product.price * product.quantity;
            } else {
                console.warn("Incomplete product data:", product);
            }
        });
    }


    totalQuantityHTML.innerText = totalQuantity;
    totalPriceHTML.innerText = '₱' + totalPrice;

   
    totalQuantityInput.value = totalQuantity;
    totalPriceInput.value = totalPrice;
    cartDataInput.value = JSON.stringify(listCart); 
}


function updateHiddenInputs() {
    const totalQuantityInput = document.getElementById("totalQuantityInput");
    const totalPriceInput = document.getElementById("totalPriceInput");
    const totalQuantity = document.querySelector(".totalQuantity").innerText;
    const totalPrice = document.querySelector(".totalPrice").innerText.replace('', ''); 
    const cartDataInput = document.getElementById("cartDataInput");

   
    totalQuantityInput.value = totalQuantity;
    totalPriceInput.value = totalPrice;
    cartDataInput.value = JSON.stringify(listCart); 
    console.log("Form Data Prepared:", {
        totalQuantity,
        totalPrice,
        listCart
    }); 
}


const form = document.querySelector("form");
form.addEventListener("submit", (e) => {
    updateHiddenInputs(); 
    console.log("Submitting form with data:");
    console.log("Total Quantity:", document.getElementById("totalQuantityInput").value);
    console.log("Total Price:", document.getElementById("totalPriceInput").value);
    console.log("Cart Data:", document.getElementById("cartDataInput").value);
});


checkCart();
addCartToHTML();
