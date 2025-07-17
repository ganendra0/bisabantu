// public/js/script.js

// Scroll effect for header
window.addEventListener('scroll', function() {
    const header = document.getElementById('header');
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Mobile menu toggle
const mobileMenuToggle = document.getElementById('mobileMenuToggle');
const mobileNav = document.getElementById('mobileNav');

if (mobileMenuToggle) {
    mobileMenuToggle.addEventListener('click', function() {
        mobileMenuToggle.classList.toggle('active');
        mobileNav.classList.toggle('active');
    });
}


// Close mobile menu when clicking on a link
const mobileNavLinks = mobileNav.querySelectorAll('.nav-link');
mobileNavLinks.forEach(link => {
    link.addEventListener('click', function() {
        mobileMenuToggle.classList.remove('active');
        mobileNav.classList.remove('active');
    });
});

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    if (mobileNav && mobileMenuToggle && !mobileMenuToggle.contains(event.target) && !mobileNav.contains(event.target)) {
        mobileMenuToggle.classList.remove('active');
        mobileNav.classList.remove('active');
    }
});

// ===== SCRIPT UNTUK DROPDOWN PENGGUNA DI DESKTOP =====

document.addEventListener('DOMContentLoaded', function() {
    const userDropdown = document.querySelector('.nav-dropdown');

    if (userDropdown) {
        const trigger = userDropdown.querySelector('.user-menu-trigger');

        trigger.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah link pindah halaman
            userDropdown.classList.toggle('show');
        });

        // Menutup dropdown jika mengklik di luar area dropdown
        window.addEventListener('click', function(event) {
            if (!userDropdown.contains(event.target)) {
                userDropdown.classList.remove('show');
            }
        });
    }
});