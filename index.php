<?php
session_start();
$title = "Login | Laundry";
require_once __DIR__ . '/header.php';
?>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center vh-100 d-flex align-items-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Laundeni | Laundery Deni</h1>
                                </div>
                                <?php if (isset($_SESSION['pesan'])) {
                                ?>
                                    <div class="alert alert-danger">Error: <?= $_SESSION['pesan'] ?></div>
                                <?php
                                    unset($_SESSION['pesan']);
                                }
                                ?>
                                <form class="user" method="POST" action="handleLogin.php">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="enter username" placeholder="Enter Username...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" placeholder="Enter Password" name="password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
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
<?php require_once __DIR__ . '/footer.php' ?>