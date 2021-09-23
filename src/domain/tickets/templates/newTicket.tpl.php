<?php
defined('RESTRICTED') or die('Restricted access');

$ticket = $this->get('ticket');

?>

<div class="pageheader">
    <div class="pagetitle">
        <h5><?php $this->e($_SESSION['currentProjectClient']." // ". $_SESSION['currentProjectName']); ?></h5>
        <div class="row">
            <div class="col-12">
            <div class="back-btn" style="padding-left: 0px;">
                <a href="<?php echo $_SESSION['lastPage'] ?>" class="backBtn btn"><i class="fas fa-chevron-left"></i></i> <?=$this->__("links.go_back") ?></a>
            </div>
            </div>
        </div>
        <h1><?=$this->__("headlines.new_to_do") ?></h1>
    </div>
</div>
<!--pageheader-->
<div class="maincontent">
    <div class="maincontentinner">

        <?php
            echo $this->displayNotification();
        ?>

        <div class="tabbedwidget tab-primary ticketTabs">

            <ul>
                <li>
                    <a href="#ticketdetails"><?php echo $this->__("tabs.ticketDetails") ?></a>
                </li>
            </ul>
            <hr style="margin: 0px;">
            <div id="ticketdetails">
                <form class="ticketModal" action="/tickets/newTicket" method="post">
                    <?php $this->displaySubmodule('tickets-ticketDetails') ?>
                </form>
            </div>

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