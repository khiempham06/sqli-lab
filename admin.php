<?php
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function is_ip_allowed($ip) {
    $file_path = __DIR__ . '/ip_allow.txt';
    $allowed_ips = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return in_array($ip, $allowed_ips);
}

$ip = get_client_ip();
if (!is_ip_allowed($ip)) {
    http_response_code(403);
    echo "You are not an admin!";
    die();
}

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'activated';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            display: flex;
            justify-content: center;
            background-color: #333;
            padding: 10px;
        }
        .navbar button {
            background-color: #555;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin: 0 5px;
        }
        .navbar button.active {
            background-color: #000;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        button {
            padding: 5px 10px;
            color: white;
            border: none;
            cursor: pointer;
        }
        .activate-button {
            background-color: green;
        }
        .deactivate-button {
            background-color: orange;
        }
        .delete-button {
            background-color: red;
        }
        .verify-button {
            background-color: blue;
        }
        .button-disabled {
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body>

<div class="navbar">
    <button id="activatedTab" class="<?= $tab === 'activated' ? 'active' : '' ?>" onclick="showTab('activated')">Activated</button>
    <button id="unactivatedTab" class="<?= $tab === 'unactivated' ? 'active' : '' ?>" onclick="showTab('unactivated')">Unactivated</button>
</div>

<div id="activatedContent" class="tab-content <?= $tab === 'activated' ? 'active' : '' ?>">
    <h2 style="text-align:center;">Activated Users</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Facebook</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="activatedTable">
           
        </tbody>
    </table>
</div>

<div id="unactivatedContent" class="tab-content <?= $tab === 'unactivated' ? 'active' : '' ?>">
    <h2 style="text-align:center;">Unactivated Users</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Facebook</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="unactivatedTable">
           
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentTab = "<?= $tab ?>";
        fetchUsers(currentTab);

        document.getElementById('activatedTab').addEventListener('click', function() {
            showTab('activated');
        });
        document.getElementById('unactivatedTab').addEventListener('click', function() {
            showTab('unactivated');
        });
    });

    function fetchUsers(type) {
        fetch(`/api/admin.php?type=${type === 'activated' ? 1 : 0}`)
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById(`${type}Table`);
                tableBody.innerHTML = '';

                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(user => {
                        const row = document.createElement('tr');

                       
                        function extract(fbLink) {
                            const pattern =  /(?:https?:\/\/)?(?:www\.)?(?:facebook\.com|fb\.com)\/(?:profile\.php\?id=|)([^/?#&]+).*/;
                            const match = fbLink.match(pattern);
                            return match ? match[1] : null;
                        }

                        const username = extract(user.fb_link);
                        row.innerHTML = `
                            <td>${user.id}</td>
                            <td>${user.username}</td>
                            <td><a href="${user.fb_link}">${username}</a></td>
                            <td>
                                ${type === 'unactivated' ? 
                                    `<button class="activate-button" onclick="activateUser(${user.id}, this)">Activate</button>` : 
                                    `<button class="deactivate-button" onclick="deactivateUser(${user.id}, this)">Deactivate</button>`
                                }
                                <button class="delete-button" onclick="deleteUser(${user.id}, this)">Delete</button>
                                ${user.verify === 0 ? 
                                    `<button class="verify-button" onclick="verifyUser(${user.id}, this)">Verify</button>` : 
                                    `<button class="button-disabled" disabled>Verified</button>`
                                }
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = '<td colspan="4">No users found.</td>';
                    tableBody.appendChild(row);
                }
            })
            .catch(error => {
                console.error('Error fetching users:', error);
            });
    }

    function showTab(tab) {
        
        window.location.href = `?tab=${tab}`;
    }

    function activateUser(id, button) {
        fetch('/api/admin.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'activate',
                id: id
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                button.parentElement.parentElement.remove();
            } else {
                alert('Failed to activate user.');
            }
        });
    }

    function deactivateUser(id, button) {
        fetch('/api/admin.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'deactivate',
                id: id
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                button.parentElement.parentElement.remove();
            } else {
                alert('Failed to deactivate user.');
            }
        });
    }

    function deleteUser(id, button) {
        const confirmation = confirm('Are you sure you want to delete this user?');
        if (confirmation) {
            fetch('/api/admin.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'delete',
                    id: id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    button.parentElement.parentElement.remove();
                } else {
                    alert('Failed to delete user.');
                }
            });
        }
    }

    function verifyUser(id, button) {
        fetch('/api/admin.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'verify',
                id: id
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                button.textContent = 'Verified';
                button.disabled = true;
                button.className = 'button-disabled';
            } else {
                alert('Failed to verify user.');
            }
        });
    }
</script>

</body>
</html>
