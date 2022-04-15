<!DOCTYPE html>
<html>
    <head>
        <title>Portal de clientes - Crowe</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="Demo project">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">       
        <style type="text/css">
        * {
            box-sizing: border-box;
        }

        *:focus {
            outline: none;
        }

        body {
            font-family: Arial;
            background-color: #fff;
            padding: 50px;
        }

        .login {
            margin: 20px auto;
            width: 300px;
        }

        .login-screen {
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #d9d9d9;
        }

        .app-title {
            text-align: center;
            color: #777;
        }

        .login-form {
            text-align: center;
        }

        .control-group {
            margin-bottom: 10px;
        }

        input {
            text-align: center;
            background-color: #fff;
            border: 1px solid #d9d9d9;
            border-radius: 3px;
            font-size: 16px;
            font-weight: 200;
            padding: 10px 0;
            width: 100%;
            transition: border .5s;
        }

        input:focus {
            border: 1px solid #d9d9d9;
            box-shadow: none;
        }

        .danger {
            border: 2px solid #A94442;
            color: #A94442;
            box-shadow: none;
        }

        .normal {
           border: 2px solid transparent;
           box-shadow: none;
        }

        .btn {
            border: 0px solid transparent;
            background: #00327c;
            color: #fff;
            font-size: 16px;
            line-height: 25px;
            padding: 10px 0;
            text-decoration: none;
            text-shadow: none;
            border-radius: 3px;
            box-shadow: none;
            transition: 0.25s;
            display: block;
            width: 100%;
            margin: 0 auto;
        }

        .btn:hover {
        background-color: #00468C;
        color: #fff;
        }

        .login-link {
            font-size: 12px;
            color: #444;
            display: block;
            margin-top: 12px;
        }
        a:hover, a:focus, a:active {
            color: #00327c;
        }
        .btn-primary:hover {
            border: 0px solid transparent;
        }
        .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary {
            background-color: #00468C;
            color: #fff;
            border: 0px solid transparent;
        }
        </style>
    </head>
<body>
    <div class="login">
            <div id="logo_admin" style="background:url(<?=base_url()?>/img/<?=$logo?>) no-repeat center; background-size:100%; width: 300px; height: 120px; "></div>
        <div class="login-screen">
            <div class="app-title">
                <h1 style="font-size:18px !important; font-weight:normal !important;">PORTAL DE CLIENTES<br><br></h1>
                <div id="message"></div>
            </div>

            <div class="login-form">
                <div class="control-group">
                <input type="text" class="login-field" value="" placeholder="usuario" id="login-name" name="username">
                <label class="login-field-icon fui-user" for="login-name"></label>
                </div>

                <div class="control-group">
                <input type="password" class="login-field" value="" placeholder="contraseña" id="login-pass" name="password">
                <label class="login-field-icon fui-lock" for="login-pass"></label>
                </div>

                <a class="btn btn-primary btn-large btn-block" id="login">Iniciar sesión</a>
                <a class="login-link" href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#forgotPassword">¿Olvidó su contraseña?</a>
            </div>
        </div>
    </div>
    <div id="forgotPassword" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Restaurar contraseña</h4>
                </div>
                <div id="modal_pass_restore">
                    <div class="modal-body">
                        <p>Ingrese la dirección de correo electrónico con la que fue registrado en el sistema. Si la dirección es correcta le llegará un enlace a su cuenta para confirmar la solicitud de restauración de su contraseña.</p>
                        <input type="text" class="login-field pass-restore" value="" placeholder="e-mail" id="login-pass-restore" name="usr_emailx">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="restore_pass()">Continuar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script id="js_ajax_functions" type="text/javascript" parametro_base_url="<?=base_url()?>" src="<?=base_url()?>/js/ajax_functions.js?1"></script>    
    <script type="text/javascript">
    $(document).ready(function(){
        $('#login').on('click', function(event) {
            event.preventDefault();
            if ($("input[name='username']").val() !== "" && $("input[name='password']").val() !== "")
                login();
            else
                $('#message').html('<p id="alert" class="alert alert-warning">Por favor ingrese un nombre de usuario y una contrase&ntilde;a</p>');
        });
    });
        function login()
        {
            var data = $(".login-field").serializeArray();
            $.post(<?=json_encode(base_url())?>+"index.php/login/validate", data, function(response,status,xhr)
            {
                if (status == "error")
                {
                    $('#message').html('<p id="alert" class="alert alert-danger">Ha ocurrido un error al procesar la información. Por favor intente nuevamente</p>');
                }
                else if (response.type == 'danger')
                {
                    $('#message').html('<p id="alert" class="alert alert-danger">'+response.msg+'</p>');
                    $('input').addClass('danger');
                    $('input').focus(function() {
                        $(this).removeClass('danger');
                    });
                }
                else if (response.type == 'loggedin')
                {
                    $('#message').html('<p id="alert" class="alert alert-success">'+response.msg+'</p>');
                    location.reload();
                }
            }, 'json');
        }
    </script>
</body>

</html>