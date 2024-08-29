const baseURL = '{{ base }}';
document.addEventListener('DOMContentLoaded', function () {
    // Get the button and input elements
    const btn = document.getElementById('newsletter-btn');
    const emailInput = document.getElementById('newsletter-email');

            btn.addEventListener('click', function () {
                const email = emailInput.value.trim();

                // Validate email input
                if (email === '') {
                    alert('Please enter your email.');
                    return;
                }

                // Prepare data to send
                const data = new URLSearchParams();
                data.append('email', email);

                // Send data to server
                fetch(`${baseURL}newsletter/subscribe`, {
                    method: 'POST',
                    body: data,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                .then(response => response.text())
                .then(result => {
                    alert("Thank you for subscribing to the newsletter");
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while subscribing.');
                });
            });
        });

