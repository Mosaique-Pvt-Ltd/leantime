<!DOCTYPE html>
<html dir="<?php echo $language->__("language.direction"); ?>" lang="<?php echo $language->__("language.code"); ?>">

<head>
	<?php echo $frontController->includeAction('general.header'); ?>

	<link rel="stylesheet" href="<?=BASE_URL ?>/css/main.css?v=<?php echo $settings->appVersion; ?>" />
	<link rel="stylesheet" href="<?=BASE_URL ?>/css/style.default.css?v=<?php echo $settings->appVersion; ?>"
		type="text/css" />
	<link rel="stylesheet"
		href="<?=BASE_URL ?>/css/style.custom.php?color=<?php echo htmlentities($_SESSION["companysettings.mainColor"]); ?>&v=<?php echo $settings->appVersion; ?>"
		type="text/css" />
	<link rel="stylesheet" href="<?=BASE_URL ?>/css/custom.css?v=<?php echo $settings->appVersion; ?>"
		type="text/css" />

	<script src="<?=BASE_URL?>/js/compiled-base-libs.min.js?v=<?php echo $settings->appVersion; ?>"></script>

</head>

<script type="text/javascript">
	jQuery(document).ready(function () {

		if (jQuery('.login-alert .alert').text() != '') {
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

<body class="loginpage custom-loginpage">
	<div class="container">
		<div class="row">
				<div class="col-sm-12 col-md-6 regLeft" style="background:#<?php echo $_SESSION["companysettings.mainColor"]; ?>" >
						<div class="row">
								<div class="col-md-12">
										<a href="<?=BASE_URL ?>" target="_blank"><img src="<?php echo htmlentities($_SESSION["companysettings.logoPath"]); ?>" /></a>
								</div>
						</div>
				</div>
				<div class="col-sm-12 col-md-6 regRight">
						<div class="regpanel">
								<div class="regpanelinner">
								<h1><?php echo $language->__("headlines.login"); ?></h1>
										<div class="regcontent">
												<form id="login" action="<?php echo $redirectUrl?>" method="post">
														<input type="hidden" name="redirectUrl" value="<?php echo $redirectUrl; ?>" />
														<div class="inputwrapper login-alert">
																<div class="alert alert-error"><?php echo $login->error;?></div>
														</div>
														<div class="form-group">
														<label for="username"><?php echo $language->__("input.placeholders.enter_email"); ?></label>
																<input type="text" name="username" id="username" class="form-control" placeholder="<?php echo $language->__("input.placeholders.enter_email"); ?>" value=""/>
														</div>
														<div class="form-group">
																<label for="password"><?php echo $language->__("input.placeholders.enter_password"); ?></label>
																<input type="password" name="password" id="password" class="form-control" placeholder="<?php echo $language->__("input.placeholders.enter_password"); ?>" value=""/>
														</div>
																<input type="submit" name="login" value="<?php echo $language->__("buttons.login"); ?>" class="btn btn-primary"/>
																<div class="custom-forgot-password text-center">
																	<a href="<?=BASE_URL ?>/resetPassword"><?php echo $language->__("links.forgot_password"); ?></a>
																</div>
												</form>
										</div>
								</div>
						</div>
				</div>
		</div>
	</div>
</body>
</html>