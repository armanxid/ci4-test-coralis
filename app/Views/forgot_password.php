<!-- app/Views/forgot_password.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
</head>

<body>
    <h1>Forgot Password</h1>

    <?php if (session()->getFlashdata('success')) : ?>
        <div><?= session()->getFlashdata('success') ?></div>
    <?php endif ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div><?= session()->getFlashdata('error') ?></div>
    <?php endif ?>

    <form method="POST" action="/forgot-password">
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= old('email') ?>"><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>