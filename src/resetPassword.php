<!DOCTYPE html>
<html dir="<?php echo $language->__("language.direction"); ?>" lang="<?php echo $language->__("language.code"); ?>">
<head>
    <title><?php echo $_SESSION["companysettings.sitename"]; ?></title>

    <?php echo $frontController->includeAction('general.header'); ?>

    <link rel="stylesheet" href="<?=BASE_URL?>/css/main.css?v=<?php echo $settings->appVersion; ?>"/>
    <link rel="stylesheet" href="<?=BASE_URL?>/css/style.default.css?v=<?php echo $settings->appVersion; ?>" type="text/css" />
    <link rel="stylesheet" href="<?=BASE_URL?>/css/style.custom.php?color=<?php echo htmlentities($_SESSION["companysettings.mainColor"]); ?>&v=<?php echo $settings->appVersion; ?>" type="text/css" />
		<link rel="stylesheet" href="<?=BASE_URL ?>/css/custom.css?v=<?php echo $settings->appVersion; ?>"
		type="text/css" />
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

<body class="loginpage custom-loginpage">

<div class="container">
<div class="header hidden-gt-sm">
    <div class="logo">
        <a href="<?=BASE_URL ?>" style="background-image:url(<?php echo htmlentities($_SESSION["companysettings.logoPath"]);?>)">&nbsp;</a>
    </div>
</div>


<div class="row">
    <div class="col-sm-12 col-md-6 regLeft" style="background:#<?php echo $_SESSION["companysettings.mainColor"]; ?>" >
        <div class="row">
            <div class="col-md-12">
                <a href="<?=BASE_URL ?>/" target="_blank">
									<img src="<?php echo htmlentities($_SESSION["companysettings.logoPath"]); ?>" />
								</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 regRight">
        <div class="regpanel">
            <div class="regpanelinner">
						<h1><?php echo $language->__("headlines.reset_password"); ?></h1>
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
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo $language->__("input.placeholders.enter_new_password"); ?>" />
                            </div>
                            <div class=" ">
                                <input type="password" name="password2" id="password2" placeholder="<?php echo $language->__("input.placeholders.confirm_password"); ?>" />
                            </div>

														<input type="submit" class="btn btn-primary" name="resetPassword" value="<?php echo $language->__("buttons.reset_password"); ?>" />
														<div class="custom-back-to-login text-center">
															<a  href="<?=BASE_URL ?>/"><?php echo $language->__("links.back_to_login"); ?></a>
														</div>

                        <?php }else{ ?>
                            <p><?php echo $language->__("text.enter_email_address_to_reset"); ?><br /><br /></p>
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" id="username" placeholder="<?php echo $language->__("input.placeholders.enter_email"); ?>" />
                            </div>
                                <input type="submit" class="btn btn-primary" name="resetPassword" value="<?php echo $language->__("buttons.reset_password"); ?>" />
																<div class="custom-back-to-login text-center">
																	<a  href="<?=BASE_URL ?>/"><?php echo $language->__("links.back_to_login"); ?></a>
																</div>
                        <?php } ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>
