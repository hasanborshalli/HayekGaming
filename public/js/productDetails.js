const productImage = document.querySelector(".product-img img");
const otherImages = document.querySelectorAll(".other-images img");
function changeImage(id, src) {
    const selectedImage = document.getElementById(id);
    otherImages.forEach((image) => {
        image.classList.remove("selected-image");
    });
    selectedImage.classList.add("selected-image");
    productImage.setAttribute("src", src);
}
const quantity = document.getElementById("quantity");
function updateQuantity(sign) {
    if (sign === "+") {
        quantity.value = parseInt(quantity.value) + 1;
    } else if (sign === "-") {
        if (quantity.value > 1) {
            quantity.value = parseInt(quantity.value) - 1;
        }
    }
}
function addToCart(id) {
    let currentQuantity = parseInt(quantity.value);
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    if (currentQuantity >= 1) {
        let options = {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": token,
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ id: id, quantity: currentQuantity }),
        };

        fetch("/addCart", options)
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "addedNew") {
                    updateCartQuantity();
                    showToast("Added to cart");
                } else if (data.status === "addedOld") {
                    showToast("Added to cart");
                } else {
                    showToast("Error adding to cart");
                }
            });
    }
}
// Toast function
function showToast(message) {
    const toast = document.getElementById("toast");
    toast.textContent = message;
    toast.classList.add("show");
    setTimeout(() => {
        toast.classList.remove("show");
    }, 3000);
}
let cartQuantityInput = document.getElementsByClassName("cart-quantity")[0];
let cartQuantity = cartQuantityInput.textContent;
function updateCartQuantity() {
    cartQuantity++;
    cartQuantityInput.textContent = cartQuantity;
}
