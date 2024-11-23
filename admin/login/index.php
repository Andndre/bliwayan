<!DOCTYPE html>
<html lang="en">

<?php include '../layout/head.php'; ?>
<body class="bg-gradient-info">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9" style="max-width: 500px;">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    <!-- Tampilkan Pesan Error -->
                                    <?php
                                    session_start();
                                    if (isset($_SESSION['error'])) {
                                        echo '<div class="alert alert-danger" role="alert">'
                                            . $_SESSION['error'] .
                                            '</div>';
                                        unset($_SESSION['error']); // Hapus error setelah ditampilkan
                                    }
                                    ?>

                                    <form class="user" action="/admin/service/loginProses.php" method="POST" id="loginForm">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control form-control-user"
                                                placeholder="Masukan Email">
                                            <small class="text-danger d-none" id="emailError">Email wajib diisi</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control form-control-user"
                                                placeholder="Masukan Password">
                                            <small class="text-danger d-none" id="passwordError">Password wajib diisi</small>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php include '../layout/scripts-module.php'; ?>

    <script>
        // Validasi Client-Side untuk input kosong
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            let valid = true;

            // Validasi email
            if (email.value.trim() === '') {
                email.classList.add('is-invalid');
                document.getElementById('emailError').classList.remove('d-none');
                valid = false;
            } else {
                email.classList.remove('is-invalid');
                document.getElementById('emailError').classList.add('d-none');
            }

            // Validasi password
            if (password.value.trim() === '') {
                password.classList.add('is-invalid');
                document.getElementById('passwordError').classList.remove('d-none');
                valid = false;
            } else {
                password.classList.remove('is-invalid');
                document.getElementById('passwordError').classList.add('d-none');
            }

            // Hentikan submit jika tidak valid
            if (!valid) {
                e.preventDefault();
            }
        });
    </script>

</body>
</html>
