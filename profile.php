<?php
header("X-XSS-Protection: 1; mode=block");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="static/profie.css">
    <style>
        a {
            color: #ffa4b6;
            text-decoration: none;
        }
    </style>
    <script>
        function fetchUserProfile() {
            const data = {
                type: 'general',
                username: '<?php echo htmlspecialchars(trim($_GET['username']), ENT_QUOTES, 'UTF-8'); ?>'
            };
            const urlEncodedData = new URLSearchParams(data).toString();

            fetch('/api/info.php', {
                method: 'POST', 
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded' 
                },
                body: urlEncodedData
            })
                .then(response => response.json())
                .then(data => {
                    tmp = data.time ?? 'none';
                    if (tmp !== 'none') {
                        const user = data;
                        document.getElementById('username').innerText = '<?php echo htmlspecialchars(trim($_GET['username']), ENT_QUOTES, 'UTF-8'); ?>';
                        document.getElementById('studyTime').innerText = parseFloat(user.time).toFixed(2) ?? 'none';
                        document.getElementById('cardsReviewed').innerText = user.reviews ?? 'none';
                        document.getElementById('currentStreak').innerText = user.streak_current ?? 'none';
                        document.getElementById('highestStreak').innerText = user.streak_highest ?? 'none';
                        document.getElementById('challengeHighest').innerText = user.challengexp ?? 'none';
                        
                        const fbLinkElement = document.getElementById('fbLink');
                        fbLinkElement.href = user.fb_link || '#';
                        fbLinkElement.innerText = user.fb_link ? 'Visit Facebook Profile' : 'none';
                    } else {
                        alert(data.message || 'Failed to fetch user profile.');
                    }
                })
                .catch(error => console.error('Error fetching user profile:', error));
        }

        window.onload = function() {
            fetchUserProfile();
        };
    </script>
</head>
<body>
    <header>
        <h1 id="profile-heading"><?php echo htmlspecialchars(trim($_GET['username']), ENT_QUOTES, 'UTF-8'); ?> 's profile</h1>
    </header>
    <section class="profile-info">
        <p><strong>Username:</strong> <span id="username"><?php echo htmlspecialchars(trim($_GET['username']), ENT_QUOTES, 'UTF-8'); ?></span></p>
        <p><strong>Study Time:</strong> <span id="studyTime"></span> Mins</p>
        <p><strong>Reviewed:</strong> <span id="cardsReviewed"></span></p>
        <p><strong>Current Streak:</strong> <span id="currentStreak"></span></p>
        <p><strong>Highest Streak:</strong> <span id="highestStreak"></span></p>
        <p><strong>ChallengeXP:</strong> <span id="challengeHighest"></span></p>
        <p><strong>Facebook Link:</strong> <a id="fbLink" target="_blank"></a></p>
    </section>
    <section class="actions">
        <button onclick="window.location.href='index.html'">Back to Leaderboard</button>
    </section>
</body>
</html>
