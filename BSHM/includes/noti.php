<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Bell</title>
    <!-- FontAwesome for the bell icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Basic Styling for Notification Bell */
        .notification-container {
            position: relative;
            display: inline-block;
        }

        .notification-bell {
            font-size: 24px;
            cursor: pointer;
        }

        .notification-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: red;
            color: white;
            padding: 3px 7px;
            border-radius: 50%;
            font-size: 12px;
            display: none; /* Hide initially if no notifications */
        }

        .notifications-list {
            display: none;
            position: absolute;
            top: 30px;
            right: 0;
            background-color: white;
            border: 1px solid #ccc;
            width: 200px;
            z-index: 1;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .notifications-list ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .notifications-list li {
            padding: 10px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

        .notifications-list li:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="notification-container">
        <!-- Notification bell icon -->
        <i class="fas fa-bell notification-bell" id="notificationBell"></i>
        <!-- Notification badge to show count -->
        <span class="notification-count" id="notificationCount">0</span>
        <!-- Notification list that will be shown when bell is clicked -->
        <div class="notifications-list" id="notificationsList">
            <ul id="notifications"></ul>
        </div>
    </div>

    <!-- jQuery for handling interactions -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initial notifications (simulated data)
            let notifications = [
                "New message from John",
                "Server scheduled maintenance",
                "New course added"
            ];

            // Function to update the notification count badge
            function updateNotificationCount() {
                const count = notifications.length;
                $("#notificationCount").text(count);
                if (count > 0) {
                    $("#notificationCount").show();
                } else {
                    $("#notificationCount").hide();
                }
            }

            // Function to display the list of notifications
            function displayNotifications() {
                let notificationList = $("#notifications");
                notificationList.empty();
                notifications.forEach(notification => {
                    notificationList.append(`<li>${notification}</li>`);
                });
            }

            // Toggle visibility of notifications when bell is clicked
            $("#notificationBell").on("click", function() {
                $("#notificationsList").toggle();
            });

            // Initial setup: Update the count and display the notifications
            updateNotificationCount();
            displayNotifications();

            // Simulate new notifications after 5 seconds
            setTimeout(function() {
                notifications.push("Update your profile details", "Exam schedule released");
                updateNotificationCount();
                displayNotifications();
            }, 5000);
        });
    </script>

</body>
</html>
