/*!
* Start Bootstrap - Shop Homepage v5.0.6 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project


        // Script JavaScript
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        const cartCount = document.querySelector('.cart-count');

        let cart = [];

        addToCartButtons.forEach(button => {
            button.addEventListener('click', () => {
                const name = button.dataset.name;
                const price = parseFloat(button.dataset.price);

                addToCart(name, price);
                updateCartCount();
            });
        });

        function addToCart(name, price) {
            const item = {
                name: name,
                price: price
            };
            cart.push(item);
        }

        function updateCartCount() {
            cartCount.textContent = cart.length;
        }
        $(function () {
        $('[data-toggle="popover"]').popover()
        }   )
 