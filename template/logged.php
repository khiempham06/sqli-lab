<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('/login');
    exit();
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
            fetch('/api/today_leaderboard.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('.board tbody');
                    tableBody.innerHTML = '';
        
                    if (Array.isArray(data) && data.length > 0) {
                        data.forEach((row, index) => {
                            const minute = parseFloat(row.minute);
                            const formattedMinute = !isNaN(minute) ? minute.toFixed(2) : 'N/A';
                            const retention = parseFloat(row.retention);
                            const formattedRetention = !isNaN(retention) ? retention.toFixed(2) + '%' : 'N/A';
        
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td>${row.position || index + 1}</td> 
                                <td>${row.name || 'N/A'}</td>
                                <td>${row.xp || 'N/A'}</td>
                                <td>${row.cards || 'N/A'}</td>
                                <td>${formattedMinute}</td> 
                                <td>${formattedRetention}</td>
                            `;
                            tableBody.appendChild(tr);
                        });
                    } else {
                        const tr = document.createElement('tr');
                        tr.innerHTML = '<td colspan="6">No data found</td>';
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
                      window.location.href = '/home/today';
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
        <p>Let's fight to become the winner</p>
        <h2 style="color: #f9d1d1; margin-bottom: 1%;">Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    </header>
    <section class="user_use">
        <ul>
            <li class="ldb">Leaderboard</li>
            <li class="time">
                <select id="pages" name="pages" onchange="handleSelectChange(event)">
                    <option value="#" selected disabled>Today</option>
                    <option value="/home/user/week">Week</option>
                    <option value="/home/user/challenge">Challenge</option>
                </select>
            </li>
            <li class="log">
                <button type="button" class="logbut" onclick="logoutUser()">Logout</button>
            </li>
            <li class="reg">
                <button type="button" class="regbut" onclick="redirectToPage('/user/profile')">Profile</button>
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
                <th class="xp">XP</th>
                <th class="rev">Review</th>
                <th class="min">Minute</th>
                <th class="ret">Retention</th> 
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </section>
</body>
</html>
