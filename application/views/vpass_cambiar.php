<!DOCTYPE html>
<html>
    <head>
        <title>Portal Clientes - Crowe</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="Demo project">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script id="js_ajax_functions" type="text/javascript" parametro_base_url="<?=base_url()?>" src="<?=dirname(base_url())?>/js/ajax_functions.js"></script>
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
            width: 600px;
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
            <div id="logo_admin" style="background:url(<?=base_url()?>img/logo.png) no-repeat center; background-size:100%; width: 300px; height: 120px; "></div>
        <div class="login-screen">
            <div id="pass_cambiar">
            <div class="app-title">
                <h1 style="font-size:18px !important; font-weight:normal !important;">Retaurar/Cambiar contraseña</h1>
                <p>Usuario: <?=$inf_datusr['nom_client']?><input name="cod_camclv" type="hidden" id="cod_camclv" value="<?=$cod_camclv?>" class="pass_cambiar" /></p>
                <div id="message"></div>
            </div>

            <div class="login-form">
                <div class="control-group">
                <input type="password" class="login-field pass_cambiar" value="" placeholder="Su nueva contraseña" id="clv_usuari" name="clv_usuari">
                <label class="login-field-icon fui-user" for="login-name"></label>
                </div>

                <div class="control-group">
                <input type="password" class="login-field pass_cambiar" value="" placeholder="Repita su nueva contraseña" id="clv_usuari_confirm" name="clv_usuari_confirm">
                <label class="login-field-icon fui-lock" for="login-pass"></label>
                </div>

                <a class="btn btn-primary btn-large btn-block" id="login" onclick="pass_cambiar(); return false;">Continuar</a>
            </div>
            </div>
        </div>
    </div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>