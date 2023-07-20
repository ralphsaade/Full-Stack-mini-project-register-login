document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let email = document.getElementById('email').value;
    let password = document.getElementById('pwd').value;

    fetch('login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({email: email, password: password}),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirect to dashboard page
            window.location.href = "dashboard.html";
        } else {
            // Display error message in a dedicated HTML element
            let errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                errorMessage.innerText = data.message;
            }
        }
    });
});

window.onload = function() {
    fetch('getUserName.php')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Display welcome message
            document.getElementById('welcomeMessage').innerText = 'Welcome, ' + data.name;
        } else {
            // Redirect to login page
            window.location.href = "login.html";
        }
    });
}
