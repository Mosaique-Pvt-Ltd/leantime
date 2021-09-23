<!DOCTYPE html>
<html dir="<?php echo $language->__("language.direction"); ?>" lang="<?php echo $language->__("language.code"); ?>">
<head>
    <title><?php echo $_SESSION["companysettings.sitename"]; ?></title>

    <?php echo $frontController->includeAction('general.header'); ?>

    <link rel="stylesheet" href="<?=BASE_URL?>/css/main.css?v=<?php echo $settings->appVersion; ?>"/>
    <link rel="stylesheet" href="<?=BASE_URL?>/css/style.default.css?v=<?php echo $settings->appVersion; ?>" type="text/css" />
    <link rel="stylesheet" href="<?=BASE_URL?>/css/style.custom.php?color=<?php echo htmlentities($_SESSION["companysettings.mainColor"]); ?>&v=<?php echo $settings->appVersion; ?>" type="text/css" />

    <script src="<?=BASE_URL?>/js/compiled-base-libs.min.js?v=<?php echo $settings->appVersion; ?>"></script>

</head>

<script type="text/javascript">
    jQuery(document).ready(function(){
        
        if(jQuery('.login-alert .alert-error').text() != ''){
            jQuery('.login-error').fadeIn();
        }
        
        if(jQuery('.login-alert .alert-success').text() != ''){
            jQuery('.login-success').fadeIn();
        }

    });
</script>
</head>

<body class="loginpage" style="height:100%;">

<div class="header hidden-gt-sm">

    <div class="logo" style="margin-left:0px;">
        <a href="<?=BASE_URL ?>" style="background-image:url(<?php echo htmlentities($_SESSION["companysettings.logoPath"]);?>)">&nbsp;</a>
    </div>

</div>

<div class="row " style="height:100%; margin-right: 0px;margin-left: 0px;">
    <div class="col-md-12 col-sm-12 regRight"  style="padding-top:8%;text-align: -webkit-center;text-align: -moz-center;
">

        <div class="regpanel" style="width:290px; background:white;border-radius:10px">
            <div class="regpanelinner">
                <div class="pageheader" style="padding-bottom: 0px;">
                    <!-- <div class="pageicon"><span class="iconfa-signin"></span></div>
                    <div class="pagetitle row">
                        <h3 style="padding-left: 10px; padding-top: 5px;"><?php echo htmlentities($_SESSION["companysettings.sitename"]); ?></h3>
                        
                    </div> -->
                    <!-- <img src="<?=BASE_URL ?>/images/logo.png" alt="CHD Group Logo" style="height: 60px;"> -->
                    <div class="logo" style="display: grid; padding-bottom:10px">
                        <a href="<?=BASE_URL ?>" style="background-size: 260px auto;min-height: 60px; background-repeat: no-repeat; background-image:url('<?php echo htmlentities($_SESSION["companysettings.logoPath"]); ?>')">&nbsp;</a>
                        </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <a href="<?=BASE_URL ?>/" style="float:left; margin-top:10px; color:gray; padding-left:20px;" class="text-left"><i class="fas fa-angle-left"></i> <?php echo $language->__("links.back_to_login"); ?></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <h4 class="text-left" style="padding-left: 20px; padding-bottom:20px;"><strong><?php echo $language->__("headlines.reset_password"); ?></strong></h4>
                    </div>
                </div>
                <div class="regcontent">
        
                    <form id="resetPassword" action="" method="post">
            
                        <div class="inputwrapper login-alert login-error">
                            <div class="alert alert-error"><?php echo $login->error;?></div>
                        </div>
                        <div class="inputwrapper login-alert login-success">
                            <div class="alert alert-success"><?php echo $login->success;?></div>
                        </div>

                        <?php
                        if((isset($_GET["hash"]) === true && $login->validateResetLink()) || $login->resetInProgress === true) { ?>

                            <p><?php echo $language->__("text.enter_new_password"); ?><br /><br /></p>
                            <div class="">
                                <input type="password" name="password" id="password" placeholder="<?php echo $language->__("input.placeholders.enter_new_password"); ?>" />
                            </div>
                            <div class=" ">
                                <input type="password" name="password2" id="password2" placeholder="<?php echo $language->__("input.placeholders.confirm_password"); ?>" />
                            </div>
                            <div class="">
                                <a href="<?=BASE_URL ?>/" style="float:right; margin-top:10px;"><?php echo $language->__("links.back_to_login"); ?></a>
                                <input type="submit" name="resetPassword" value="<?php echo $language->__("buttons.reset_password"); ?>" />
                            </div>

                        <?php }else{ ?>
                            <p class="text-left"><?php echo $language->__("text.enter_email_address_to_reset"); ?><br /><br /></p>
                            <div class="" >
                                <input style="width:100%;" type="text" name="username" id="username" placeholder="<?php echo $language->__("input.placeholders.enter_email"); ?>" />
                            </div>

                            <div class="" >
                                
                                <input type="submit" class="col-12 btn btn-block" style="margin-top:10px;background:#1374e9!important" name="resetPassword" value="<?php echo $language->__("buttons.reset_password"); ?>" />
                            </div>
                        <?php } ?>

                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
