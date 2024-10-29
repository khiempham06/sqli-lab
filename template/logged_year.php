<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('/login');
    exit();
}

if (isset($_SESSION['last']) && (time() - $_SESSION['last']) > $_SESSION['expire']) {
    session_unset();
    session_destroy();
    header('/login');
    exit();
} else {
    $_SESSION['last'] = time();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="/static/style.css">
    <script>
        function handleSelectChange(event) {
            var selectedValue = event.target.value;
            if (selectedValue) {
                window.location.href = selectedValue;
            }
        }

        function redirectToPage(url) {
            window.location.href = url;
        }

        function fetchData() {
            fetch('/api/challenge_leaderboard.php')
                .then(response => response.text()) 
                .then(data => {
                    console.log(data); 
                    const parsedData = JSON.parse(data);
    
                    const tableBody = document.querySelector('.board tbody');
                    tableBody.innerHTML = ''; 
    
                    if (Array.isArray(parsedData) && parsedData.length > 0) {
                        parsedData.forEach((row, index) => {
                            const hour = parseFloat(row.hour);
                            const formattedHour = !isNaN(hour) ? hour.toFixed(2) : 'N/A'; 
    
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td>${row.position || index + 1}</td>
                                <td>${row.name || 'N/A'}</td> 
                                <td>${row.xp || 'N/A'}</td>
                                <td>${row.reviews || 'N/A'}</td> 
                                <td>${formattedHour}</td> 
                                <td>${row.days || 'N/A'}</td> 
                            `;
                            tableBody.appendChild(tr);
                        });
                    } else {
                        const tr = document.createElement('tr');
                        tr.innerHTML = '<td colspan="5">No data found</td>';
                        tableBody.appendChild(tr);
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        window.onload = function() {
            fetchData();
        };
        function logoutUser() {
            fetch('/api/logout.php', {
                method: 'POST'
            }).then(response => response.json())
              .then(data => {
                  if (data.status === 'success') {
                      sessionStorage.removeItem('username');
                      window.location.href = '../index.html';
                  } else {
                      console.error('Error logging out:', data.message);
                  }
              }).catch(error => console.error('Error logging out:', error));
        }
    </script>
</head>
<body>
    <header>
        <h1>Leaderboard</h1>
        <h2 style="color: #f9d1d1; margin-bottom: 1%;">Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Let's fight to become the winner</p>
    </header>
    <section class="user_use">
        <ul>
            <li class="ldb">Leaderboard</li>
            <li class="time">
                <select id="pages" name="pages" onchange="handleSelectChange(event)">
                    <option value="logged.php">Today</option>
                    <option value="logged_month.php">Week</option>
                    <option value="#" selected disabled>Challenge</option>
                </select>
            </li>
            <li class="log">
                <button type="button" class="logbut" onclick="logoutUser()">Logout</button>
            </li>
            <li class="reg">
                <button type="button" class="regbut" onclick="redirectToPage('profile.php')">Profile</button>
            </li>
        </ul>
    </section>
    <section class="on_board">
        <button class="filbut">Filter</button>
        <button class="sbut">Share</button>
    </section>
    <section class="board">
        <table role="grid">
            <thead>
                <tr>
                    <th class="pos">Position</th>
                    <th class="name">Name</th>
                    <th class="rev">Review</th>
                    <th class="xp">XP</th>
                    <th class="min">Hour</th>
                    <th class="day">Days</th>
                </tr>
            </thead>
            <tbody>
              
            </tbody>
        </table>
    </section>
</body>
</html>
