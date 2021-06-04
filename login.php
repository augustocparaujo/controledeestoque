<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ECOINFO</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="css//fonts.css" rel="stylesheet" type="text/css">
    <link href="css/fonts-material-icons.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="login-page body-fundo">
    <div class="login-box" style="padding:5px">
        <div class="card">
            <div class="body">
                <form id="sign_in2" method="POST">
                    <div class="msg">Controle de estoque de TI</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="number" class="form-control" name="matricula" placeholder="Login" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="senha" placeholder="Senha" minlength="6" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit"><i class="material-icons">input</i> ENTRAR</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="#">Esquecei a senha?</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                        <p>
                            Field: <b style="color:red">Augusto Araújo - Ecopaquer</b></br>
                            Field: <b style="color:red">Ghilerme - Uberlândia</b>
                        </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="retorno"></div>
    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Bootstrap Notify Plugin Js -->
    <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>
    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>
    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
    <script src="js/pages/ui/notifications.js"></script>
    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    <!--outros-->
    <script src="js/jquery.mask.js"></script>
    <script src="js/jquery.maskMoney.js"></script>
    <script src="js/script.js"></script>
    <script>
        $('#sign_in2').submit(function() {
            $.ajax({
                type: 'POST',
                url: 'valida.php',
                data: $('#sign_in2').serialize(),
                success: function(data) {
                    $('#retorno').show().fadeOut(3000).html(data);
                }
            });
            return false;
        });
    </script>
</body>

</html>