<?php
defined('RESTRICTED') or die('Restricted access');
$roles = $this->get('roles');
$values = $this->get('values');
$user = $this->get('user');
?>


<div class="pageheader">

    <div class="pagetitle">
        <h5><?php echo $this->__('label.overview') ?></h5>
        <h1><h1><?php echo $this->__('headlines.my_profile'); ?></h1></h1>
    </div>
</div><!--pageheader-->

<div class="maincontent">
    <div class="maincontentinner">

        <?php echo $this->displayNotification(); ?>

        <div class="row-fluid">
        <div class="span4">
                <div class='widgetbox'>
                    <!-- <h4 class='widgettitle'><?php echo $this->__('headlines.profile_picture'); ?></h4> -->

                    <div class='widgetcontent' style="text-align:center;">

                        <img src='<?php echo $this->get('profilePic') ?>'  class='profileImg' alt='Profile Picture' id="previousImage"/>
                        <div id="profileImg">
                        </div>

                        <div class="par">

                            <label><?php echo $this->__('label.upload') ?></label>

                            <div class='fileupload fileupload-new' data-provides='fileupload'>
                                <input type="hidden"/>
                                <div class="input-append">
                                    <div class="uneditable-input span2">
                                        <i class="iconfa-file fileupload-exists"></i>
                                        <span class="fileupload-preview"></span>
                                    </div>
                                    <span class="btn btn-file">
                                        <span class="fileupload-new"><?php echo $this->__('buttons.select_file') ?></span>
                                        <span class='fileupload-exists'><?php echo $this->__('buttons.change') ?></span>
                                        <input type='file' name='file' onchange="leantime.usersController.readURL(this)"/>
                                    </span>

                                    <a href='#' class='btn fileupload-exists' data-dismiss='fileupload' onclick="leantime.usersController.clearCroppie()"><?php echo $this->__('buttons.remove') ?></a>
                                </div>
                                <p class='stdformbutton'>
                                    <span id="save-picture" class="btn btn-primary fileupload-exists ld-ext-right">
                                        <span onclick="leantime.usersController.saveCroppie()"><?php echo $this->__('buttons.save') ?></span>
                                        <span class="ld ld-ring ld-spin"</span>
                                    </span>
                                    <input id="picSubmit" type="submit" name="savePic" class="hidden"
                                           value="<?php echo $this->__('buttons.upload'); ?>"/>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="span8">

                <div class="widget">
                    <!-- <h4 class="widgettitle"><?php echo $this->__('label.overview'); ?></h4> -->
                    <div class="widgetcontent">

                        <form action="" method="post" class='stdform'>
                            <input type="hidden" name="<?=$_SESSION['formTokenName']?>" value="<?=$_SESSION['formTokenValue']?>" />
                            <p class="no-margin">
                                <label for="firstname" class="span12"><?php echo $this->__('label.firstname'); ?></label>
                                <span class='field'>
                                    <input type="text" class="input span6" name="firstname" id="firstname"
                                           value="<?php $this->e($values['firstname']) ?>"/><br/>
                                </span>
                            </p>

                            <p class="no-margin">
                                <label for="lastname" class="input span12"><?php echo $this->__('label.lastname'); ?></label>
                                <span class='field'>
                                    <input type="text" name="lastname" class="input span6" id="lastname"
                                           value="<?php $this->e($values['lastname']) ?>"/><br/>
                                </span>
                            </p>

                            <p class="no-margin">
                                <label for="user" class="input span12"><?php echo $this->__('label.email'); ?></label>
                                <span class='field'>
                                    <input type="text" name="user" class="input span6" id="user"
                                           value="<?php $this->e($values['user']) ?>"/><br/>
                                </span>
                            </p>

                            <p class="no-margin">
                                <label for="phone" class="input span12"><?php echo $this->__('label.phone'); ?></label>
                                <span class='field'>
                                    <input type="text" name="phone" class="input span6" id="phone"
                                           value="<?php $this->e($values['phone']) ?>"/><br/>
                                </span>
                            </p>

                            <p class="no-margin">
                                <label for="currentPassword" class="input span12"><?php echo $this->__('label.old_password') ?></label>
                                <span class='field'>
                                    <input type='password' value="" name="currentPassword" class="input span6"
                                           id="currentPassword"/><br/>
                                </span>
                            </p>

                            <p class="no-margin">
                                <label for="oldPassword" class="input span12"><?php echo $this->__('label.new_password') ?></label>
                                <span class='field'>
                                    <input type='password' value="" name="newPassword" class="input span6"
                                           id="newPassword"/><br/>
                                </span>
                            </p>

                            <p class="no-margin">
                                <label for="newPassword" class="input span12"><?php echo $this->__('label.password_repeat') ?></label>
                                <span class='field'>
                                    <input type="password" value="" name="confirmPassword" class="input span6"
                                           id="confirmPassword"/><br/>
                                </span>
                            </p>

                            <p class="no-margin">
                                <div class="row">
                                    <div class="round" style="margin-left:15px;">
                                    <input type="checkbox" value="" name="notifications" class="input pull-left"
                                           id="notifications" <?php if ($values['notifications'] == "1") echo " checked='checked' "; ?>/>
                                           <label for="notifications" class="input"></label><span style="padding-left:10px;"><?php echo $this->__('label.receive_notifications') ?></span>
                                    </div>
                                </div>
                                
                                
                            </p>

                            <p class='stdformbutton'>
                                <input type="submit" name="save" id="save"
                                       value="<?php echo $this->__('buttons.save'); ?>" class="button"/>
                            </p>

                        </form>

                    </div>
                </div>
            </div>
            

            <!-- <div class="span5">
                <div class='widgetbox'>
                    <h4 class='widgettitle'><?php echo $this->__('headlines.twoFA'); ?></h4>
                    <div class='widgetcontent'>
                        <?php if ($values['twoFAEnabled']) { ?>
                            <p><?php echo $this->__('text.twoFA_enabled'); ?></p>
                        <?php } else { ?>
                            <p><?php echo $this->__('text.twoFA_disabled'); ?></p>
                        <?php } ?>
                        <p><a href="<?=BASE_URL ?>/twoFA/edit"><?php echo $this->__('text.twoFA_manage'); ?></a></p>
                    </div>
                </div>
            </div> -->
        </div>





