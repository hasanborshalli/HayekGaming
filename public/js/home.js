let index = 0;

const images = document.querySelectorAll(".image-container");
const dots = document.querySelectorAll(".dot");
const totalImages = images.length;

const burger = document.querySelector(".burger");
const sidebar = document.getElementById("sidebar");
const sidebarOverlay = document.getElementById("sidebarOverlay");
const sidebarClose = document.getElementById("sidebarClose");
const dropdowns = document.querySelectorAll(".sidebar-dropdown");

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

burger.addEventListener("click", () => {
    sidebar.classList.add("show");
    sidebarOverlay.classList.add("show");
});

sidebarClose.addEventListener("click", () => {
    sidebar.classList.remove("show");
    sidebarOverlay.classList.remove("show");
});

sidebarOverlay.addEventListener("click", () => {
    sidebar.classList.remove("show");
    sidebarOverlay.classList.remove("show");
});

dropdowns.forEach((drop) => {
    const toggle = drop.querySelector(".sidebar-toggle");
    const submenu = drop.querySelector(".sidebar-submenu");
    toggle.addEventListener("click", () => {
        const isOpen = drop.classList.contains("active");
        dropdowns.forEach((otherDrop) => {
            const otherSubmenu = otherDrop.querySelector(".sidebar-submenu");
            if (otherDrop !== drop) {
                otherDrop.classList.remove("active");
                otherSubmenu.style.maxHeight = null;
            }
        });
        if (isOpen) {
            drop.classList.remove("active");
            submenu.style.maxHeight = null;
        } else {
            drop.classList.add("active");
            submenu.style.maxHeight = submenu.scrollHeight + "px";
        }
    });
});
