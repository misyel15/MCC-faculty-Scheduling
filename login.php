<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mcc Faculty Scheduling</title>
    <link rel="icon" href="back.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <style>
    body {
        font-family: Arial, sans-serif;
        background-image: url('end.jpg'); /* Ensure the path is correct */
        background-size: 100% 100%; /* Stretch the image to cover the entire viewport */
        background-position: center center; /* Center the background image */
        background-repeat: no-repeat; /* Prevent repeating the image */
        background-attachment: fixed; /* Keep the background fixed during scroll */
    }

    .container {
        margin-top: 50px;
    }

    .form-container {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.8); /* Optional: Add a background color with transparency */
    }

    /* Fix position for navbar */
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1030; /* Ensure the navbar stays on top of other elements */
        margin-bottom: 20px;
    }

    .navbar-brand, .nav-link {
        color: white;
        font-size: 0.9rem;
        font-weight: bold;
        padding-left: 20px;
    }

    .dropdown-menu {
        left: auto;
        right: 0; /* Align dropdown to the right on mobile */
    }

    /* Ensure the dropdown menu is easily tappable */
    .dropdown-item {
        padding: 10px 20px;
        color: black;
        font-size: 0.9rem;
        font-weight: bold;
    }

    /* Improve layout for mobile devices */
    @media (max-width: 767px) {
        .navbar-brand {
            font-size: 1rem;
        }

        .nav-link {
            font-size: 0.9rem;
        }

        /* Adjust padding for smaller screens */
        .dropdown-item {
            padding: 8px 15px;
            font-size: 0.9rem;
        }
    }

    .navbar-brand img {
        width: 50px;
        height: 40px;
		margin-left:-10%;
    }

    /* Add margin to prevent content overlap with fixed navbar */
    body {
        padding-top: 56px; /* Adjust this value based on the height of the navbar */
    }
    </style>
</head>
<body><nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="mcclogo.jpg" alt="Logo"> MCC Faculty Scheduling 
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Admin Login
                </a>
                <div class="dropdown-menu" aria-labelledby="adminDropdown">
                    <a class="dropdown-item" href="Admin/login.php">BSIT</a>
                    <a class="dropdown-item" href="BSBA/login.php">BSBA</a>
                    <a class="dropdown-item" href="BSHM/login.php">BSHM</a>
                    <a class="dropdown-item" href="BSED/login.php">BSED</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="instructorDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Instructor Login
                </a>
                <div class="dropdown-menu" aria-labelledby="instructorDropdown">
                    <a class="dropdown-item" href="home.php">Instructor</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
