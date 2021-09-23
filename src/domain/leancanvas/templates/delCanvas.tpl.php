<?php
defined('RESTRICTED') or die('Restricted access');
?>

<div class="pageheader">
    <div class="pagetitle">
        <h5><?php echo $_SESSION['currentProjectClient']." // ". $_SESSION['currentProjectName']; ?></h5>
        <h1><?=$this->__("headline.delete_board") ?></h1>
    </div>
</div><!--pageheader-->

<div class="maincontent">
    <div class="maincontentinner">
        <h4 class="widget widgettitle" style="background:none; color:#000; padding-left:0px;"><?=$this->__("subtitles.delete") ?></h4>
        <div class="widgetcontent" style="padding: 0px;">
            <form method="post" action="<?=BASE_URL ?>/leancanvas/delCanvas/<?php echo $_GET['id']?>">
                <p style="margin: 0px;"><?php echo $this->__('text.confirm_research_board_deletion'); ?></p><br />
                <a class="btn btn-secondary" href="<?=BASE_URL ?>/leancanvas/simpleCanvas"><?php echo $this->__('buttons.back'); ?></a>
                <input type="submit" style="background: #1374e9;" value="<?php echo $this->__('buttons.yes_delete'); ?>" name="del" class="button" />
                
            </form>
        </div>

    </div>
</div>
