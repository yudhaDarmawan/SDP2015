<html>
<!--JUDUL DAN ICON UNTUK WEB STTS-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet">
    <!-- JavaScripts -->
    <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>

    <title> Login | Sistem Informasi STTS</title>
    <link rel="icon" href="<?php echo base_url("assets/images/icon.ico");?>">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<section id="hero" class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div id="login">
                    <div class="page-header text-center">
                        <img src="<?php echo base_url('assets/images/stts.png');?>" width="150">
                        <h3>Sistem Informasi STTS</h3></div>
                    <?php
                    echo form_open();
                    echo $divUsername;
                    //echo form_label($errorUser);
                    echo form_error('username');
                    echo "<div class='input-group'>";
                    echo "<span class=' glyphicon glyphicon-user input-group-addon'></span>";
                    echo form_input($userConfig);
                    echo "</div>";
                    echo "</div>";
                    echo $divPass;
                    //echo form_label($errorPass);
                    echo form_error('pass');
                    echo "<div class='input-group'>";
                    echo "<span class=' glyphicon glyphicon-briefcase input-group-addon'></span>";
                    echo form_input($passConfig);
                    echo "</div>";
                    echo "</div>";
                    ?>

                    <div class="checkbox col-md-offset-7">
                        <label>
                        <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>

                    <?php
                        echo form_submit($btnLogin);
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>