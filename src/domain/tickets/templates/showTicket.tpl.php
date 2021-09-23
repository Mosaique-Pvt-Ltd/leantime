<?php

    defined('RESTRICTED') or die('Restricted access');
	$ticket = $this->get('ticket');
	$projectData = $this->get('projectData');

?>

<div class="pageheader">

    

    <div class="pagetitle">
        <h5><?php $this->e($_SESSION['currentProjectClient']." // ". $_SESSION['currentProjectName']); ?></h5>
        <div class="row">
            <div class="col-12">
                <div class="back-btn">
                    <a href="<?php echo $_SESSION['lastPage'] ?>" class="backBtn btn"><i class="fas fa-chevron-left"></i> <?=$this->__("links.go_back") ?></a>
                </div>
            </div>
        </div>
        <h1><?=$this->__("headlines.edit_todo") ?></h1>
    </div>

</div><!--pageheader-->

<div class="maincontent">
    <div class="maincontentinner">

        <?php echo $this->displayNotification(); ?>

        <div class="tabbedwidget tab-primary ticketTabs" style="visibility:hidden;">

            <ul>
                <li><a href="#ticketdetails"><i class="far fa-list-alt"></i> <?php echo $this->__("tabs.ticketDetails") ?></a></li>
                <li><a href="#subtasks"><i class="far fa-check-square"></i> <?php echo $this->__('tabs.subtasks') ?> (<?php echo $this->get('numSubTasks'); ?>)</a></li>
                <li><a href="#files"><i class="far fa-file"></i> <?php echo $this->__("tabs.files") ?> (<?php echo $this->get('numFiles'); ?>)</a></li>
                <li><a href="#comments"><i class="far fa-comments"></i> <?php echo $this->__("tabs.discussion") ?> (<?php echo $this->get('numComments'); ?>)</a></li>
                <?php if ($_SESSION["userdata"]["role"] != "client") { ?>
                    <li><a href="#timesheet"><i class="far fa-clock"></i> <?php echo $this->__("tabs.time_tracking") ?></a></li>
                <?php }; ?>
            </ul>

            <div id="ticketdetails">
                <form class="ticketModal" action="<?=BASE_URL ?>/tickets/showTicket/<?php echo $ticket->id ?>" method="post">
                    <?php $this->displaySubmodule('tickets-ticketDetails') ?>
                </form>
            </div>

            <div id="subtasks">
                <form method="post" action="#subtasks" class="ticketModal">
                    <?php $this->displaySubmodule('tickets-subTasks') ?>
                </form>
            </div>

            <div id="files">
                <form action='#files' method='POST' enctype="multipart/form-data" class="ticketModal">
                    <?php $this->displaySubmodule('tickets-attachments') ?>
                </form>
            </div>

            <div id="comments">
                <form method="post" action="<?=BASE_URL ?>/tickets/showTicket/<?php echo $ticket->id; ?>#comments" class="ticketModal">
                    <input type="hidden" name="comment" value="1" />
                    <?php
                    $this->assign('formUrl', "/tickets/showTicket/".$ticket->id."");

                    $this->displaySubmodule('comments-generalComment') ;
                    ?>
                </form>
            </div>

            <?php if ($_SESSION["userdata"]["role"] != "client") { ?>
                <div id="timesheet">
                    <?php $this->displaySubmodule('tickets-timesheet') ?>
                </div>
            <?php } ?>
        </div>

    </div>
</div>

<script type="text/javascript">

    leantime.ticketsController.initTicketTabs();
    leantime.ticketsController.initTicketEditor();
    leantime.ticketsController.initTagsInput();

    jQuery(window).load(function () {
        jQuery(window).resize();
    });

</script>
