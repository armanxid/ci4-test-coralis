<!-- app/Views/dashboard.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h1>Welcome to the Dashboard, <?= session('user_name') ?></h1>

    <!-- Dashboard content goes here -->

    <?php if (session('user_profile_picture')) : ?>
        <img src="/uploads/<?= session('user_profile_picture') ?>" alt="Profile Picture">
    <?php endif ?>
    <br>
    <a href="/logout">Logout</a>
</body>

</html>