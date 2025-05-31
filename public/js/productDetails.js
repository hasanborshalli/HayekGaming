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
