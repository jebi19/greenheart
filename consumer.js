let slideIndex = 1; // Start from the first slide
        showSlides(slideIndex);
    
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }
    
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }
    
        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("slides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1} // Loop back to the first slide
            if (n < 1) {slideIndex = slides.length} // Loop to the last slide
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
        }
    
        // Optional: Automatically change slides every 3 seconds
        setInterval(() => plusSlides(1), 3000);


        document.addEventListener('DOMContentLoaded', function() {
            const cartButton = document.getElementById('cartButton');
            const cartItemsDiv = document.getElementById('cartItems');
        
            cartButton.addEventListener('click', function() {
                cartItemsDiv.style.display = (cartItemsDiv.style.display === 'none') ? 'block' : 'none';
                if (cartItemsDiv.style.display === 'block') {
                    fetchCartItems();
                }
            });
        
            function fetchCartItems() {
                fetch('/get-cart-items') // Endpoint to get cart items
                    .then(response => response.json())
                    .then(data => {
                        cartItemsDiv.innerHTML = ''; // Clear previous items
                        if (data.length === 0) {
                            cartItemsDiv.innerHTML = '<p>No items in cart</p>';
                        } else {
                            data.forEach(item => {
                                const itemDiv = document.createElement('div');
                                itemDiv.textContent = `Product: ${item.product_name}, Quantity: ${item.quantity}`;
                                cartItemsDiv.appendChild(itemDiv);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching cart items:', error));
            }
        });
        