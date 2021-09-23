
<?php
 defined('RESTRICTED') or die('Restricted access');
$project = $this->get('values');

?>

<div class="pageheader">
    <div class="row">
        <div class="col-12">
            <h5><?php echo $this->__('label.administration') ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="back-btn">
            <a href="<?=BASE_URL ?>/projects/showAll" class="backBtn btn"><i class="fas fa-chevron-left"></i> <?php echo $this->__('links.go_back') ?></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="pagetitle">
            
                <h1><?php echo $this->__('headline.new_project') ?></h1>
                <hr>
            </div>
        </div>
    </div>

    

    

</div><!--pageheader-->
        
<div class="maincontent">
    <div class="maincontentinner">

        <?php echo $this->displayNotification(); ?>

        <div class="tabbedwidget tab-primary projectTabs"  style="border:0px;">

            <div id="projectdetails">

                <?php echo $this->displaySubmodule('projects-projectDetails'); ?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
            leantime.projectsController.initProjectTabs();
            leantime.projectsController.initProjectsEditor();

            <?php if((isset($_SESSION['userdata']['settings']["modals"]["newProject"]) === false || $_SESSION['userdata']['settings']["modals"]["newProject"] == 0) && $_SESSION['currentProject'] != '') {     ?>

            leantime.helperController.showHelperModal("newProject");
            <?php
            //Only show once per session
            $_SESSION['userdata']['settings']["modals"]["newProject"] = 1;
            } ?>

        }
    );

</script>