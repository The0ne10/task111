coordsBtn = document.getElementById('coords-btn');
addressBtn = document.getElementById('address-btn');

coordsForm = document.getElementById('coords-form');
addressForm = document.getElementById('address-form');

coordsBtn.addEventListener('click', function() {
    coordsBtn.classList.toggle('menu__button--active');
    addressBtn.classList.toggle('menu__button--active');
    coordsForm.style.display = 'block';
    addressForm.style.display = 'none';
});

addressBtn.addEventListener('click', function() {
    coordsBtn.classList.toggle('menu__button--active');
    addressBtn.classList.toggle('menu__button--active');
    coordsForm.style.display = 'none';
    addressForm.style.display = 'block';
});