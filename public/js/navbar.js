const burger = document.querySelector(".burger");
const sidebar = document.getElementById("sidebar");
const sidebarOverlay = document.getElementById("sidebarOverlay");
const sidebarClose = document.getElementById("sidebarClose");
const dropdowns = document.querySelectorAll(".sidebar-dropdown");

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
