<!-- app/Views/dashboard.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <style>
        .card {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            max-width: 400px;
        }

        .profile {
            float: left;
            margin-right: 10px;
        }

        .profile img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        .details {
            overflow: hidden;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: 0;
        }

        .details .name {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .details .email {
            font-size: 14px;
            color: #888;
        }
    </style>
</head>

<body>
    <h1>Welcome to the Dashboard, <?= session('user_name') ?></h1>

    <!-- Dashboard content goes here -->
    <div class="card">
        <div class="profile">
            <img src="/uploads/<?= session('user_profile_picture') ?>" alt="Profile Picture">
        </div>
        <div class="details">
            <div class="name"><?php echo session()->get('user_name'); ?></div>
            <div class="email"><?php echo session()->get('user_email'); ?></div>
        </div>
    </div>

    <br>
    <a href="/logout">Logout</a>
</body>

</html>