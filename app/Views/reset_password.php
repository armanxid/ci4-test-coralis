<!-- app/Views/reset_password.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
</head>

<body>
    <h1>Reset Password</h1>

    <?php if (session()->getFlashdata('success')) : ?>
        <div><?= session()->getFlashdata('success') ?></div>
    <?php endif ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div><?= session()->getFlashdata('error') ?></div>
    <?php endif ?>

    <form method="POST" action="/reset-password">
        <input type="hidden" name="token" value="<?= $token ?>">

        <label for="password">New Password:</label>
        <input type="password" name="password"><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password"><br>

        <input type="submit" value="Reset Password">
    </form>
</body>

</html>