<?php
    defined('RESTRICTED') or die('Restricted access');
    $project = $this->get('project');
    $bookedHours = $this->get('bookedHours');
    $helper = $this->get('helper');
    $state = $this->get('state');
?>

<div class="pageheader">
       
    <div class="pagetitle">
        <h5><?php echo $this->__('label.administration') ?></h5>
        <h1><?php echo sprintf($this->__('headline.project'),$this->escape($project['name'])); ?>
        </h1>
    </div>
</div><!--pageheader-->
        
        <div class="maincontent">
            <div class="maincontentinner">

                <?php echo $this->displayNotification() ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <a href="<?=BASE_URL?>/projects/duplicateProject/<?=$project['id']?>" class="duplicateProjectModal btn btn-default"><?=$this->__("links.duplicate_project_title") ?></a>

                        </div>
                    </div>
                </div>

                <div class="tabbedwidget tab-primary projectTabs">

                <ul>
                    <li><a href="#projectdetails"><i class="far fa-list-alt"></i> <?php echo $this->__('tabs.projectdetails'); ?></a></li>
                    <li><a href="#integrations"><i class="fas fa-cog"></i> <?php echo $this->__('tabs.Integrations'); ?></a></li>
                    <li><a href="#files"><i class="far fa-file"></i> <?php echo sprintf($this->__('tabs.files_with_count'), $this->get('numFiles')); ?></a></li>
                    <li><a href="#comment"><i class="far fa-comments"></i> <?php echo sprintf($this->__('tabs.discussion_with_count'), $this->get('numComments')); ?></a></li>
                </ul>

                <div id="projectdetails">
                    <?php echo $this->displaySubmodule('projects-projectDetails'); ?>
                </div>

                <div id="files">
                
                    <div class="mediamgr_category">
                                <form action='#files' method='POST' enctype="multipart/form-data" id="fileForm">

                                <div class="par f-left" style="margin-right: 15px;">

                                     <div class='fileupload fileupload-new' data-provides='fileupload'>
                                            <input type="hidden" />
                                        <div class="input-append">
                                            <div class="uneditable-input span3">
                                                <i class="iconfa-file fileupload-exists"></i><span class="fileupload-preview"></span>
                                            </div>
                                            <span class="btn btn-file">
                                                <span class="fileupload-new"><?=$this->__('label.select_file'); ?></span>
                                                <span class='fileupload-exists'><?=$this->__('label.change'); ?></span>
                                                <input type='file' name='file'/>
                                            </span>
                                            <a href='#' class='btn fileupload-exists' data-dismiss='fileupload'><?=$this->__('buttons.remove'); ?></a>
                                        </div>
                                      </div>
                                   </div>

                                   <input type="submit" style="background: #1374e9;" name="upload" class="button" value="<?=$this->__('buttons.upload'); ?>" />

                                </form>
                    </div>


                    <div class="mediamgr_content">
                        <h6>Uploaded files</h6>
                        <ul id='medialist' class='listfile'>
                            <?php foreach($this->get('files') as $file): ?>
                            <div class="row">
                                <li class="span6" style="background:#f8f8f8; border:1px solid #e6e9f0;padding:20px; margin-left:15px">
                                    <a href="<?=BASE_URL ?>/download.php?module=<?php echo $file['module'] ?>&encName=<?php echo $file['encName'] ?>&ext=<?php echo $file['extension'] ?>&realName=<?php echo $file['realName'] ?>" class="pull-left">
                                    <?php if (in_array(strtolower($file['extension']), $this->get('imgExtensions'))) :  ?>
                                    <?php endif; ?>
                                        <span class="filename" style="color:#000;"><?php echo $file['realName'] ?></span>
                                        <span class="pull-right">
                                        <?php  if ($login::userIsAtLeast("developer")) { ?>
                                        <a href="<?=BASE_URL ?>/projects/showProject/<?php echo $project['id']; ?>?delFile=<?php echo $file['id'] ?>" class="delete pull-right"><i class="fa fa-trash"></i> <?php echo $this->__("links.delete"); ?></a>
                                    <?php  } ?>
                                    </span>

                                    </a>
                                </li>
                            </div>
                            <br>
                                <?php endforeach; ?>
                        </ul>

                    </div><!--mediamgr_content-->
                    <div style='clear:both'>&nbsp;</div>
                    
                </div><!-- end files -->
                
                <div id="comment">

                    <form method="post" action="<?=BASE_URL ?>/projects/showProject/<?php echo $project['id']; ?>#comment" class="ticketModal">
                        <input type="hidden" name="comment" value="1" />
                        <?php
                        $this->assign('formUrl', BASE_URL."/projects/showProject/".$project['id']."");
                        $this->displaySubmodule('comments-generalComment') ;
                        ?>
                    </form>

                </div>

                    <div id="integrations">

                        
                        <div class="row">
                            <div class="col-md-7">
                                <img src="<?=BASE_URL ?>/images/mattermost-logoHorizontal.png" width="200" />
                                <div class="">
                                    <?=$this->__('text.mattermost_instructions'); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-5">
                                <strong><?=$this->__('label.webhook_url'); ?></strong><br />
                                    <form action="<?=BASE_URL ?>/projects/showProject/<?php echo $project['id']; ?>#integrations" method="post">
                                    <div class="row">
                                    <div class="col-12" id="integration-web-hook-url-container">
                                        <input type="text" name="mattermostWebhookURL" id="mattermostWebhookURL" value="<?php echo $this->get("mattermostWebhookURL"); ?>"/>
                                        <br />
                                        <input type="submit" style="background:#1374e9;" value="<?=$this->__('buttons.save'); ?>" name="mattermostSave" />
                                    </div>
                                </div>
                                    
                                </form>
                            </div>
                        </div>
                        <br />
                        
                        <div class="row">
                            <div class="col-md-7">
                                <img src="https://cdn.brandfolder.io/5H442O3W/as/pl546j-7le8zk-5guop3/Slack_RGB.png " width="200"/>
                                <div class="">
                                     <?=$this->__('text.slack_instructions'); ?>
                                </div>

                            </div>

                            
                            <div class="col-md-5">
                                <strong><?=$this->__('label.webhook_url'); ?></strong><br />
                                <form action="<?=BASE_URL ?>/projects/showProject/<?php echo $project['id']; ?>#integrations" method="post">
                                <div class="row">
                                    <div class="col-12" id="integration-web-hook-url-container">
                                        <input type="text" name="slackWebhookURL" id="slackWebhookURL" value="<?php echo $this->get("slackWebhookURL"); ?>"/>
                                        <br />
                                        <input type="submit" style="background: #1374e9;" value="<?=$this->__('buttons.save'); ?>" name="slackSave" />
                                    </div>
                                </div>
                                    
                                </form>
                            </div>
                        </div>
                        <br>
                        
                        <div class="row">
                            <div class="col-md-7">
                                <img src="<?=BASE_URL ?>/images/zulip-org-logo.png" width="200"/>
                                <div class="">
                                    <?=$this->__('text.zulip_instructions'); ?>
                                </div>
                            </div>

                            
                            <div class="col-md-5">

                                <form action="<?=BASE_URL ?>/projects/showProject/<?php echo $project['id']; ?>#integrations" method="post">
                                    <strong><?=$this->__('label.base_url'); ?></strong><br />
                                    <input type="text" name="zulipURL" id="zulipURL" placeholder="<?=$this->__('input.placeholders.zulip_url'); ?>" value="<?php echo $this->get("zulipHook")['zulipURL']; ?>"/>
                                    <br />
                                    <strong><?=$this->__('label.bot_email'); ?></strong><br />
                                    <input type="text" name="zulipEmail" id="zulipEmail" placeholder="" value="<?php echo $this->get("zulipHook")['zulipEmail']; ?>"/>
                                    <br />
                                    <strong><?=$this->__('label.botkey'); ?></strong><br />
                                    <input type="text" name="zulipBotKey" id="zulipBotKey" placeholder="" value="<?php echo $this->get("zulipHook")['zulipBotKey']; ?>"/>
                                    <br />
                                    <strong><?=$this->__('label.stream'); ?></strong><br />
                                    <input type="text" name="zulipStream" id="zulipStream" placeholder="" value="<?php echo $this->get("zulipHook")['zulipStream']; ?>"/>
                                    <br />
                                    <strong><?=$this->__('label.topic'); ?></strong><br />
                                    <input type="text" name="zulipTopic" id="zulipTopic" placeholder="" value="<?php echo $this->get("zulipHook")['zulipTopic']; ?>"/>
                                    <br />
                                    <input type="submit" style="background: #1374e9;" value="<?=$this->__('buttons.save'); ?>" name="zulipSave" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script type='text/javascript'>

    jQuery(document).ready(function() {
        <?php if(isset($_GET['integrationSuccess'])) {?>
            window.history.pushState({},document.title, '<?=BASE_URL ?>/projects/showProject/<?php echo (int)$project['id']; ?>');
        <?php } ?>

        leantime.projectsController.initProjectTabs();
        leantime.projectsController.initProjectsEditor();
        leantime.projectsController.initDuplicateProjectModal();

        <?php
        if(isset($_SESSION['tourActive']) === true && $_SESSION['tourActive'] == 1) {
        ?>
            leantime.helperController.showHelperModal("projectSuccess");

        <?php
            $_SESSION['tourActive'] = false;
        }
        ?>
    });

</script>