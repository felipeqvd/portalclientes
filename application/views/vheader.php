<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Portal clientes - Crowe</title>

    <link href="<?=dirname(base_url())?>/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?=dirname(base_url())?>/css/dashboard.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?=dirname(base_url())?>/js/jquery-easy-ui/themes/bootstrap/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?=dirname(base_url())?>/js/jquery-easy-ui/themes/bootstrap/tabs.css">
    <link rel="stylesheet" type="text/css" href="<?=dirname(base_url())?>/js/jquery-easy-ui/themes/bootstrap/datagrid.css">
    <link rel="stylesheet" type="text/css" href="<?=dirname(base_url())?>/js/jquery-easy-ui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">  
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?=dirname(base_url())?>/js/jquery-easy-ui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?=dirname(base_url())?>/js/jquery-easy-ui/locale/easyui-lang-es.js"></script>

    <style type="text/css">
        body {
            font-family: helvetica,arial,sans-serif;
            font-size: 12px;
            margin: 0;
        }
        .datagrid-row-selected .textbox {
        color: #333;
        }
        .datagrid-cell{
            font-size:11px;
        }
        .textbox .textbox-text{
            font-size:11px;
        }
        .combobox-item, .combobox-group{
            font-size:11px !important;
        }
        .titulo_formulario{
            font-size: 1.5em;
            background-color: #FDB913;
            font-weight: bold;
            width: 100%;
            padding-left: 20px;
            padding-top: 5px;
            padding-bottom: 5px;
            color: #002D62;
            text-transform: uppercase;
        }
    </style>

  </head>

  <body>

    <nav class="navbar navbar-fixed-top" style="background-color: #fff !important; border-bottom: 1px solid #eee !important;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="padding:7px !important;"><img style="height: 36px; width: auto; float:left;" src="<?=dirname(base_url())?>/img/logo.png"></a>
        </div>  
        <div id="navbar" class="navbar-collapse collapse">
        </div>
      </div>
    </nav>