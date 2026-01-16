import './bootstrap';

// Price Range Slider
document.addEventListener('DOMContentLoaded', function() {
    const rangeSlider = document.querySelector('input[type="range"]');
    
    if (rangeSlider) {
        const minValue = rangeSlider.parentElement.querySelector('.flex span:first-child');
        const maxValue = rangeSlider.parentElement.querySelector('.flex span:last-child');
        
        rangeSlider.addEventListener('input', function() {
            minValue.textContent = this.value;
        });
    }

    // Add to cart functionality
    const addButtons = document.querySelectorAll('.add-to-cart');
    addButtons.forEach(button => {
        button.addEventListener('click', function() {
            const cartBadge = document.querySelector('.cart-badge');
            let currentCount = parseInt(cartBadge.textContent);
            cartBadge.textContent = currentCount + 1;
            
            // Add animation
            cartBadge.classList.add('scale-125');
            setTimeout(() => {
                cartBadge.classList.remove('scale-125');
            }, 300);
        });
    });

    // Wishlist functionality
    const wishlistButtons = document.querySelectorAll('.wishlist-btn');
    wishlistButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('text-red-500');
        });
    });

    // Search functionality
    const searchForm = document.querySelector('.search-form');
    const searchInput = document.querySelector('.search-input');
    
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const searchTerm = searchInput.value.trim();
            
            if (searchTerm) {
                // Implement search logic here
                console.log('Searching for:', searchTerm);
            }
        });
    }
});