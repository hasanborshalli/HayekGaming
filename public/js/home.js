let index = 0;

const images = document.querySelectorAll(".image-container");
const dots = document.querySelectorAll(".dot");
const totalImages = images.length;

function slide() {
    const currentIndex = index % totalImages;

    // Move images
    images.forEach((img) => {
        img.style.transform = `translateX(-${currentIndex * 100}%)`;
    });

    // Update dots
    dots.forEach((dot) => dot.classList.remove("active"));
    dots[currentIndex].classList.add("active");

    index++;
}

setInterval(slide, 3000); // Change the slider every 3 seconds
dots.forEach((dot, dotIndex) => {
    dot.addEventListener("click", () => {
        index = dotIndex;
        slide();
    });
});
