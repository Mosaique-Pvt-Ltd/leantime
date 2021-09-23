<!DOCTYPE html>
<html dir="<?php echo $language->__("language.direction"); ?>" lang="<?php echo $language->__("language.code"); ?>">
<head>
    <?php echo $frontController->includeAction('general.header'); ?>

    <link rel="stylesheet" href="<?=BASE_URL ?>/css/main.css?v=<?php echo $settings->appVersion; ?>"/>
    <link rel="stylesheet" href="<?=BASE_URL ?>/css/style.default.css?v=<?php echo $settings->appVersion; ?>" type="text/css" />
    <link rel="stylesheet" href="<?=BASE_URL ?>/css/style.custom.php?color=<?php echo htmlentities($_SESSION["companysettings.mainColor"]); ?>&v=<?php echo $settings->appVersion; ?>" type="text/css" />

    <script src="<?=BASE_URL?>/js/compiled-base-libs.min.js?v=<?php echo $settings->appVersion; ?>"></script>

</head>

<script type="text/javascript">
    jQuery(document).ready(function(){
        
        if(jQuery('.login-alert .alert').text() != ''){
            jQuery('.login-alert').fadeIn();
        }

    });
</script>
</head>

<?php

    $redirectUrl = BASE_URL."/dashboard/show";

    if($_SERVER['REQUEST_URI'] != '' && isset($_GET['logout']) === false) {
        $redirectUrl = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
    }

?>

<body class="loginpage" style="height:100%;">

<div class="header hidden-gt-sm">

    <div class="logo" style="margin-left:0px;">
        <a href="<?=BASE_URL ?>/" style="background-image:url(<?php echo htmlentities($_SESSION["companysettings.logoPath"]);?>)">&nbsp;</a>
    </div>

</div>


<div class="row " style="height:100%;margin-left: 0px;margin-right: 0px;">
    <div class="col-md-12 col-sm-12 regRight"  style="padding-top:8%;text-align: -webkit-center;text-align: -moz-center;
">

        <div class="regpanel" style="width:290px;background:white; border-radius:10px">
            <div class="regpanelinner">
                <div class="pageheader" style="padding-bottom: 0px;">
                    <!-- <div class="pageicon"><span class="iconfa-signin"></span></div>
                    <div class="pagetitle row">
                        <h3 class="text-left" style="padding-top: 5px; padding-left: 10px;
"><?php echo htmlentities($_SESSION["companysettings.sitename"]); ?></h3>
                    </div> -->
                    <!-- <img src="<?=BASE_URL ?>/images/logo.png" alt="CHD Group Logo" style="height: 60px;"> -->
                        <div class="logo" style="display: grid; padding-bottom:10px">
                        <a href="<?=BASE_URL ?>" style="background-size: 260px auto;min-height: 60px; background-repeat: no-repeat; background-image:url('<?php echo htmlentities($_SESSION["companysettings.logoPath"]); ?>')">&nbsp;</a>
                        </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <h4 class="text-left" style="padding-left: 25px; padding-bottom:20px;"><strong><?php echo $language->__("headlines.login"); ?></strong></h4>
                    </div>
                </div>
                <div class="regcontent">
                    <form id="login" action="<?php echo $redirectUrl?>" method="post">
                        <input type="hidden" style="" name="redirectUrl" value="<?php echo $redirectUrl; ?>" />
                        <div class="">
                            <label class="text-left" for="username">Email Address</label>
                            <input type="text" style="width:100%;margin-bottom:0px;" name="username" id="username" class="form-control" placeholder="<?php echo $language->__("input.placeholders.enter_email"); ?>" value=""/>
                        </div>
                        <div class="inputwrapper login-alert">
                            <div class="alert alert-error" style="text-align: left;margin-bottom:0px;"><?php echo $login->error;?></div>
                        </div>
                        <br>
                        <div class="">
                            <label class="text-left" for="password">Password</label>
                            <input type="password" style="width:100%;margin-bottom:0px;" name="password" id="password" class="form-control" placeholder="<?php echo $language->__("input.placeholders.enter_password"); ?>" value=""/>
                        </div>
                        <br>
                        <div class="row" style="padding-left:15px; padding-right:15px;">
                            <input type="submit" name="login" class="col-12 btn btn-block" style="margin-top:10px;background:#1374e9;" value="<?php echo $language->__("buttons.login"); ?>" class="btn btn-primary"/>
                            <a href="<?=BASE_URL ?>/resetPassword" style="margin-top:10px;color:gray;" class="col-12"><?php echo $language->__("links.forgot_password"); ?></a>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>



    </div>
</div>

</body>
</html>
