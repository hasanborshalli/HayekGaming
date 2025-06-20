let index = 0;

const images = document.querySelectorAll(".image-container");
const dots = document.querySelectorAll(".dot");
const prevBanner = document.getElementById("prevBanner");
const nextBanner = document.getElementById("nextBanner");
const bannerImages = Array.from(images).map((container) => {
    const img = container.querySelector("img");
    return img ? img.src : null;
});

const totalImages = images.length;

function slide() {
    const currentIndex = index % totalImages;
    const prevIndex = (currentIndex - 1 + totalImages) % totalImages;
    const nextIndex = (currentIndex + 1) % totalImages;

    // Move main images
    images.forEach((img) => {
        img.style.transform = `translateX(-${currentIndex * 100}%)`;
    });

    // Update dots
    dots.forEach((dot) => dot.classList.remove("active"));
    dots[currentIndex].classList.add("active");

    // Update left and right banners
    prevBanner.src = bannerImages[prevIndex];
    nextBanner.src = bannerImages[nextIndex];

    index++;
}

setInterval(slide, 3000); // Change the slider every 3 seconds
dots.forEach((dot, dotIndex) => {
    dot.addEventListener("click", () => {
        index = dotIndex;
        slide();
    });
});
