<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="conta.js"></script>
    <script>
        // Function to check if a token is valid
        // Function to check if a token is valid
        function isTokenValid(token) {
            if (!token) {
                return false;  // Token doesn't exist or is empty
            }

            // Split the token into header, payload, and signature
            const [header, payload, signature] = token.split('.');

            try {
                // Decode the payload
                const decodedPayload = JSON.parse(atob(payload));

                // Check the expiration time (in seconds since epoch)
                const currentTimeInSeconds = Math.floor(Date.now() / 1000);
                const expirationTime = decodedPayload.exp * 1;  // Convert to number
                const thirtyDaysInSeconds = 30 * 24 * 60 * 60;  // 30 days in seconds

                // Check if the token is not expired and within the 30-day period
                if (expirationTime >= currentTimeInSeconds && expirationTime <= currentTimeInSeconds + thirtyDaysInSeconds) {
                    return true;  // Token is valid
                }

                return false;  // Token is either expired or outside the 30-day period
            } catch (error) {
                return false;  // Invalid token structure or payload
            }
        }

        // Function to get the value of a cookie by its name
        function getCookie(name) {
            const cookieName = name + '=';
            const cookies = document.cookie.split(';');
            for (let i = 0; i < cookies.length; i++) {
                let cookie = cookies[i];
                while (cookie.charAt(0) === ' ') {
                    cookie = cookie.substring(1);
                }
                if (cookie.indexOf(cookieName) === 0) {
                    return cookie.substring(cookieName.length, cookie.length);
                }
            }
            return '';
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const loggedInUserCookie = getCookie('loggedin_user');
            if (loggedInUserCookie) {
                const [email, userId, token] = loggedInUserCookie.split(':');
                const isValidToken = isTokenValid(token);

                if (isValidToken) {
                    // Redirect to index.html if the token is valid
                    window.location.href = 'index.html';
                }
            }
        });
    </script>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bem-vindx de volta!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="emailLogin" aria-describedby="emailHelp" placeholder="Email" value="<?php echo isset($_COOKIE['remembered_email']) ? $_COOKIE['remembered_email'] : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="passwordLogin0" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" <?php echo isset($_COOKIE['remembered_email']) ? 'checked' : ''; ?>>
                                                <label class="custom-control-label" for="customCheck">Não te esqueças de mim!</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" onclick="login(event)">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Esqueci-me da password :(</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Criar uma conta</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

   

