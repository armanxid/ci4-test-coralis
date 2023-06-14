<!-- app/Views/forgot_password.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #6a11cb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Create New Account</title>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-4 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Forgot Password</h2>
                                <p class="text-white-50 mb-5">Please enter an email that you've created!</p>
                                <?php if (session()->getFlashdata('success')) : ?>
                                    <div><?= session()->getFlashdata('success') ?></div>
                                <?php endif ?>

                                <?php if (session()->getFlashdata('error')) : ?>
                                    <div><?= session()->getFlashdata('error') ?></div>
                                <?php endif ?>
                                <form action="/forgot-password" method="post">

                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="email" name="email" value="<?= old('email') ?>" class="form-control form-control-lg" placeholder="Email" />
                                        <label class="form-label" for="email"></label>
                                    </div>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit" value="Submit">Submit</button>
                                </form>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>