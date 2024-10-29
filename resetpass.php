<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="static/style_reg.css">
</head>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("resetForm");
            form.addEventListener("submit", function (event) {
                event.preventDefault();
                var token = document.getElementById('token').value;
                var password = document.getElementById('password').value;
                var pass_confirm = document.getElementById('password_confirm').value;

                if(password !== pass_confirm) {
                    alert('Passwords do not match');
                } else {
                    const formData = new FormData(form);
                    formData.append('token', token);
                    formData.append('password', password);
                    formData.append('password_confirm', pass_confirm);

                    fetch("api/changepass.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            alert("Reset password successful!");
                            redirectToPage("login.html");
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        alert("Error: " + error);
                    });
                }
            });
        });

        function redirectToPage(url) {
            window.location.href = url;
        }
</script>
    
<body>
    <header>
        <h1>Leaderboard</h1>
    </header>
    <section class="under_head">
        <ul>
            <li class="log"><strong>Reset Your Password<</strong></li>
            <li class="board"><button class="but_board" onclick="redirectToPage('index.html')">Leaderboard</button></li>
        </ul>
    </section>
    <section class="user_login">
        <form id="resetForm">
            <p>Remember your password? <a href="register.html">Login here!</a></p>
            <input type="hidden" name="token" id="token" value="<?php echo htmlspecialchars($_GET['token']); ?>" />
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Input your Password" minlength="8" maxlength="50">
            
            <label for="password_confirm">Again</label>
            <input type="password" id="password_confirm" name="password_confirm" required placeholder="Input your Password again" minlength="8" maxlength="50">

            <button class="logbut" type="submit">Reset Password</button>
        </form>
    </section>
</body>
</html>
