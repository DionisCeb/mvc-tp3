document.querySelector('#reserver-sec-btn').addEventListener('click', function(event) {
    event.preventDefault();
    const targetSection = document.getElementById('reserve-sec');
    targetSection.scrollIntoView({ behavior: 'smooth' });
});
