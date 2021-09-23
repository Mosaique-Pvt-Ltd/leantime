<?php

defined('RESTRICTED') or die('Restricted access');
$allCanvas = $this->get("allCanvas");
$canvasLabels = $this->get("canvasLabels");
$canvasTitle = "";
$statusLabels = $this->get("statusLabels");

?>

<script type="text/javascript">

    jQuery(document).ready(function () {

        leantime.leanCanvasController.setSimpleCanvasHeights();
        leantime.leanCanvasController.initCanvasLinks();
        leantime.leanCanvasController.initFilterBar();
        leantime.leanCanvasController.initUserDropdown();
        leantime.leanCanvasController.initStatusDropdown();

        <?php if(isset($_SESSION['userdata']['settings']["modals"]["simpleLeanCanvas"]) === false || $_SESSION['userdata']['settings']["modals"]["simpleLeanCanvas"] == 0) {     ?>
        leantime.helperController.showHelperModal("simpleLeanCanvas");
        <?php
        //Only show once per session
        $_SESSION['userdata']['settings']["modals"]["simpleLeanCanvas"] = 1;
        } ?>


        <?php if(isset($_GET['showModal'])) {

        if ($_GET['showModal'] == "") {
            $modalUrl = "&type=solution";
        } else {
            $modalUrl = "/" . (int)$_GET['showModal'];
        }
        ?>

        leantime.leanCanvasController.openModalManually("<?=BASE_URL?>/leancanvas/editCanvasItem<?php echo $modalUrl; ?>");
        window.history.pushState({}, document.title, '<?=BASE_URL?>/leancanvas/simpleCanvas/');

        <?php } ?>


    });

</script>

<div class="pageheader">
    <div class="pagetitle">
        <h5><?php $this->e($_SESSION['currentProjectClient'] . " // " . $_SESSION['currentProjectName']); ?></h5>
        <h1><?= $this->__("headline.research_board") ?></h1>
    </div>
</div><!--pageheader-->

<div class="maincontent">
    <div class="maincontentinner">

        <?php echo $this->displayNotification(); ?>

        <div class="row">
            <div class="col-md-4">
            <span class="currentSprint text-left">
                    <form action="" method="post">


                        <?php if (count($this->get('allCanvas')) > 0) { ?>


                            <div class="btn-group ">

                            <ul class="dropdown-menu select-board-dropdown-menu" style="border-radius: 5px; width: 200px;">
                                 <input type="hidden" name="searchCanvas"
                                        class="searchCanvas">
                                        <h5 style="padding-left: 15px;font-weight:bold;">Boards</h5>
                                <?php
                                foreach ($this->get('allCanvas') as $canvasRow) { ?>

                                    <li>

                                        <a data-id="<?= $canvasRow["id"] ?>" href="#"
                                           class="drop-down-menu-li canvasLink 
                                         <?php
                                           if ($this->get('currentCanvas') == $canvasRow["id"]) {
                                               echo 'active';
                                           } ?>
                                           " style="padding-top: 10px; padding-bottom: 10px;"> <?php echo $canvasRow["title"]; ?></a></li>
                                    <?php
                                }
                                ?>
                                <hr>
                                <div class="row">
                                    <div class="col-12 center">
                                    <small><a href="javascript:void(0)" class="addCanvasLink btn btn-primary" style="width: 90%;padding-top: 10px;padding-bottom: 10px;"><?= $this->__("links.create_plan") ?></a></small>
                                    </div>
                                </div> 

                            </ul>
                                 <button class="btn btn-board-select dropdown-toggle board-select-dropdown" style="padding-left:5px; font-family: 'RobotoRegular';"
                                         data-toggle="dropdown">
                                            <?php
                                            $title = '';

                                            foreach ($this->get('allCanvas') as $canvasRow) {
                                                if ($this->get('currentCanvas') == $canvasRow["id"]) {
                                                    $title = $canvasRow["title"];
                                                }
                                            }
                                            if (empty($title)) {
                                                $title = $this->__("input.placeholders.filter_by_board");

                                            }
                                            echo $title;
                                            ?>
                                            <i class="fas fa-chevron-down"></i>
                                      </button>
                        </div>


                            <br/>
                            <div class="canvas-action-container">
                                <small><a href="javascript:void(0)"
                                          class="editCanvasLink "><?= $this->__("links.edit_board") ?></small> |
                                <?php if ($login::userIsAtLeast("clientManager")) { ?>
                                    <small><a href="<?= BASE_URL ?>/leancanvas/delCanvas/<?php echo $this->get('currentCanvas') ?>"
                                              class="delete"><?php echo $this->__("links.delete_board") ?></a></small>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </form>


<script>


      jQuery(".canvasLink").click(function (e) {
          e.preventDefault();
          var id = jQuery(this).data('id');
          console.log(id)
          jQuery(".searchCanvas").val(id);
          jQuery(this).closest('form').submit();
      });


</script>


                </span>
            </div>

            <div class="col-md-4 center">

            </div>
            <div class="col-md-4">
                <div class="pull-right">
                    <?php if (count($this->get('allCanvas')) > 0) { ?>

                        <div class="btn-group viewDropDown">
                            <button class="btn dropdown-toggle"
                                    data-toggle="dropdown"><?= $this->__("links.simple_canvas_title") ?> <?= $this->__("links.view") ?></button>
                            <ul class="dropdown-menu">
                                <li><a href="<?= BASE_URL ?>/leancanvas/simpleCanvas"
                                       class="active"><?= $this->__("links.simple_canvas") ?></a></li>
                                <li>
                                    <a href="<?= BASE_URL ?>/leancanvas/showCanvas"><?= $this->__("links.full_canvas") ?></a>
                                </li>
                            </ul>
                        </div>

                    <?php } ?>
                </div>
            </div>

        </div>

        <div class="clearfix"></div>
        <?php if (count($this->get('allCanvas')) > 0) { ?>

            <div id="sortableCanvasKanban" class="sortableTicketList disabled">

                <div class="row-fluid" id="firstRow">

                    <div class="column" style="width:33.33%">
                        <h5 class="widgettitle widget-title-simple-canvas canvas-widget-title title-primary"
                            style="background: #2670c9;">
                            <?php if ($login::userIsAtLeast("clientManager")) { ?>
                                <!-- <a href="<?= BASE_URL ?>/setting/editBoxLabel?module=researchlabels&label=customersegment" class="editLabelModal editHeadline"><i class="fas fa-edit"></i></a> -->
                            <?php } ?>
                            <?php echo $canvasLabels["customersegment"]; ?>
                        </h5>
                        <div class="contentInner even status_uniquevalue simple-canvas-grid">
                            <?php foreach ($this->get('canvasItems') as $row) { ?>
                                <?php if ($row["box"] == "customersegment") { ?>
                                    <div class="ticketBox research-board-ticketbox" id="item_<?php echo $row["id"]; ?>">

                                        <div class="row">
                                            <div class="col-md-12">

                                                <?php if ($login::userIsAtLeast("developer")) { ?>
                                                    <div class="inlineDropDownContainer" style="float:right;">

                                                        <a href="javascript:void(0)"
                                                           class="dropdown-toggle ticketDropDown"
                                                           data-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-v"
                                                               style="transform: rotate(90deg);" aria-hidden="true"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li class="nav-header"><?php echo $this->__("subtitles.edit"); ?></li>
                                                            <li>
                                                                <a href="<?= BASE_URL ?>/leancanvas/editCanvasItem/<?php echo $row["id"]; ?>"
                                                                   class="canvasModal"
                                                                   data="item_<?php echo $row["id"]; ?>"> <?php echo $this->__("links.edit_canvas_item"); ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= BASE_URL ?>/leancanvas/delCanvasItem/<?php echo $row["id"]; ?>"
                                                                   class="delete canvasModal"
                                                                   data="item_<?php echo $row["id"]; ?>"> <?php echo $this->__("links.delete_canvas_item"); ?></a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                <?php } ?>

                                                <h6>
                                                    <a href="<?= BASE_URL ?>/leancanvas/editCanvasItem/<?php echo $row["id"]; ?>"
                                                       class="canvasModal" style="color: #000; font-weight:bold;"
                                                       data="item_<?php echo $row["id"]; ?>"><?php $this->e($row["description"]); ?></a>
                                                </h6>

                                                <?php
                                                if ($row["conclusion"] != "") {
                                                    echo($row["conclusion"]);
                                                } else {
                                                    echo $this->__("text.no_conclusion_yet");
                                                }
                                                ?>
                                                <div class="clearfix" style="padding-bottom: 8px;"></div>

                                                <div class="dropdown ticketDropdown statusDropdown colorized show firstDropdown">
                                                    <a class="dropdown-toggle f-left status label-<?= $row["status"]; ?>"
                                                       href="javascript:void(0);" role="button"
                                                       id="statusDropdownMenuLink<?= $row['id'] ?>"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                                    <span class="text"><?php
                                                                        echo $statusLabels[$row['status']];
                                                                        ?>
                                                                    </span>
                                                        &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </a>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="statusDropdownMenuLink<?= $row['id'] ?>">
                                                        <li class="nav-header border"><?= $this->__("dropdown.choose_status") ?></li>

                                                        <?php foreach ($statusLabels as $key => $label) {
                                                            echo "<li class='dropdown-item'>
                                                                        <a href='javascript:void(0);' class='label-" . $key . "' data-label='" . $this->escape($label) . "' data-value='" . $row['id'] . "_" . $key . "' id='ticketStatusChange" . $row['id'] . $key . "' >" . $this->escape($label) . "</a>";
                                                            echo "</li>";
                                                        } ?>
                                                    </ul>
                                                </div>

                                                <div class="dropdown ticketDropdown userDropdown noBg show right lastDropdown dropRight">
                                                    <a class="dropdown-toggle f-left" href="javascript:void(0);"
                                                       role="button" id="userDropdownMenuLink<?= $row['id'] ?>"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                                    <span class="text">
                                                                        <?php if ($row["authorFirstname"] != "") {
                                                                            echo "<span id='userImage" . $row['id'] . "'><img src='" . BASE_URL . "/api/users?profileImage=" . $row['authorProfileId'] . "' width='25' style='vertical-align: middle;'/></span><span id='user" . $row['id'] . "'></span>";
                                                                        } else {
                                                                            echo "<span id='userImage" . $row['id'] . "'><img src='" . BASE_URL . "/api/users?profileImage=false' width='25' style='vertical-align: middle;'/></span><span id='user" . $row['id'] . "'></span>";
                                                                        } ?>
                                                                    </span>

                                                    </a>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="userDropdownMenuLink<?= $row['id'] ?>">
                                                        <li class="nav-header border"><?= $this->__("dropdown.choose_user") ?></li>

                                                        <?php foreach ($this->get('users') as $user) {
                                                            echo "<li class='dropdown-item'>
                                                                    <a href='javascript:void(0);' data-label='" . sprintf($this->__("text.full_name"), $this->escape($user["firstname"]), $this->escape($user['lastname'])) . "' data-value='" . $row['id'] . "_" . $user['id'] . "_" . $user['profileId'] . "' id='userStatusChange" . $row['id'] . $user['id'] . "' ><img src='" . BASE_URL . "/api/users?profileImage=" . $user['profileId'] . "' width='25' style='vertical-align: middle; margin-right:5px;'/>" . sprintf($this->__("text.full_name"), $this->escape($user["firstname"]), $this->escape($user['lastname'])) . "</a>";
                                                            echo "</li>";
                                                        } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>


                                        <?php if ($row['milestoneHeadline'] != '') { ?>
                                            <hr/>
                                            <div class="row">

                                                <div class="col-md-5">
                                                    <?php strlen($row['milestoneHeadline']) > 20 ? $this->e(substr(($row['milestoneHeadline']), 0, 20) . " [..]") : $this->e($row['milestoneHeadline']); ?>
                                                </div>
                                                <div class="col-md-7" style="text-align:right">

                                                    <?= sprintf($this->__("text.percent_complete"), $row['percentDone']) ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success"
                                                             role="progressbar"
                                                             aria-valuenow="<?php echo $row['percentDone']; ?>"
                                                             aria-valuemin="0" aria-valuemax="100"
                                                             style="width: <?php echo $row['percentDone']; ?>%">
                                                            <span class="sr-only"><?= sprintf($this->__("text.percent_complete"), $row['percentDone']) ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <br/>
                            <a href="<?= BASE_URL ?>/leancanvas/editCanvasItem?type=customersegment"
                               class="canvasModal btn canvas-add-new-btn"
                               id="customersegment"><?= $this->__('links.add_new_canvas_item') ?></a>
                        </div>
                    </div>

                    <div class="column" style="width:33.33%">
                        <h5 class="widgettitle  widget-title-simple-canvas canvas-widget-title title-primary"
                            style="background: #2670c9;">
                            <?php if ($login::userIsAtLeast("clientManager")) { ?>
                                <!-- <a href="<?= BASE_URL ?>/setting/editBoxLabel?module=researchlabels&label=problem" class="editLabelModal editHeadline"><i class="fas fa-edit"></i></a> -->
                            <?php } ?>

                            <?php echo $canvasLabels["problem"]; ?>
                        </h5>
                        <div class="contentInner even status_problem simple-canvas-grid">
                            <?php foreach ($this->get('canvasItems') as $row) { ?>
                                <?php if ($row["box"] == "problem") { ?>
                                    <div class="ticketBox research-board-ticketbox" id="item_<?php echo $row["id"]; ?>">

                                        <div class="row">
                                            <div class="col-md-12">

                                                <?php if ($login::userIsAtLeast("developer")) { ?>
                                                    <div class="inlineDropDownContainer" style="float:right;">

                                                        <a href="javascript:void(0)"
                                                           class="dropdown-toggle ticketDropDown"
                                                           data-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-v"
                                                               style="transform: rotate(90deg);" aria-hidden="true"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li class="nav-header"><?php echo $this->__("subtitles.edit"); ?></li>
                                                            <li>
                                                                <a href="<?= BASE_URL ?>/leancanvas/editCanvasItem/<?php echo $row["id"]; ?>"
                                                                   class="canvasModal"
                                                                   data="item_<?php echo $row["id"]; ?>"> <?php echo $this->__("links.edit_canvas_item"); ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= BASE_URL ?>/leancanvas/delCanvasItem/<?php echo $row["id"]; ?>"
                                                                   class="delete canvasModal"
                                                                   data="item_<?php echo $row["id"]; ?>"> <?php echo $this->__("links.delete_canvas_item"); ?></a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                <?php } ?>

                                                <h6>
                                                    <a href="<?= BASE_URL ?>/leancanvas/editCanvasItem/<?php echo $row["id"]; ?>"
                                                       class="canvasModal" style="color: #000; font-weight:bold;"
                                                       data="item_<?php echo $row["id"]; ?>"><?php $this->e($row["description"]); ?></a>
                                                </h6>

                                                <?php
                                                if ($row["conclusion"] != "") {
                                                    echo($row["conclusion"]);
                                                } else {
                                                    echo $this->__("text.no_conclusion_yet");
                                                }
                                                ?>
                                                <div class="clearfix" style="padding-bottom: 8px;"></div>

                                                <div class="dropdown ticketDropdown statusDropdown colorized show firstDropdown">
                                                    <a class="dropdown-toggle f-left status label-<?= $row["status"]; ?>"
                                                       href="javascript:void(0);" role="button"
                                                       id="statusDropdownMenuLink<?= $row['id'] ?>"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                                    <span class="text"><?php
                                                                        echo $statusLabels[$row['status']];
                                                                        ?>
                                                                    </span>
                                                        &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </a>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="statusDropdownMenuLink<?= $row['id'] ?>">
                                                        <li class="nav-header border"><?= $this->__("dropdown.choose_status") ?></li>

                                                        <?php foreach ($statusLabels as $key => $label) {
                                                            echo "<li class='dropdown-item'>
                                                                        <a href='javascript:void(0);' class='label-" . $key . "' data-label='" . $this->escape($label) . "' data-value='" . $row['id'] . "_" . $key . "' id='ticketStatusChange" . $row['id'] . $key . "' >" . $this->escape($label) . "</a>";
                                                            echo "</li>";
                                                        } ?>
                                                    </ul>
                                                </div>

                                                <div class="dropdown ticketDropdown userDropdown noBg show right lastDropdown dropRight">
                                                    <a class="dropdown-toggle f-left" href="javascript:void(0);"
                                                       role="button" id="userDropdownMenuLink<?= $row['id'] ?>"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                                    <span class="text">
                                                                        <?php if ($row["authorFirstname"] != "") {
                                                                            echo "<span id='userImage" . $row['id'] . "'><img src='" . BASE_URL . "/api/users?profileImage=" . $row['authorProfileId'] . "' width='25' style='vertical-align: middle;'/></span><span id='user" . $row['id'] . "'></span>";
                                                                        } else {
                                                                            echo "<span id='userImage" . $row['id'] . "'><img src='" . BASE_URL . "/api/users?profileImage=false' width='25' style='vertical-align: middle;'/></span><span id='user" . $row['id'] . "'></span>";
                                                                        } ?>
                                                                    </span>

                                                    </a>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="userDropdownMenuLink<?= $row['id'] ?>">
                                                        <li class="nav-header border"><?= $this->__("dropdown.choose_user") ?></li>

                                                        <?php foreach ($this->get('users') as $user) {
                                                            echo "<li class='dropdown-item'>
                                                                    <a href='javascript:void(0);' data-label='" . sprintf($this->__("text.full_name"), $this->escape($user["firstname"]), $this->escape($user['lastname'])) . "' data-value='" . $row['id'] . "_" . $user['id'] . "_" . $user['profileId'] . "' id='userStatusChange" . $row['id'] . $user['id'] . "' ><img src='" . BASE_URL . "/api/users?profileImage=" . $user['profileId'] . "' width='25' style='vertical-align: middle; margin-right:5px;'/>" . sprintf($this->__("text.full_name"), $this->escape($user["firstname"]), $this->escape($user['lastname'])) . "</a>";
                                                            echo "</li>";
                                                        } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>


                                        <?php if ($row['milestoneHeadline'] != '') { ?>
                                            <hr/>
                                            <div class="row">

                                                <div class="col-md-5">
                                                    <?php strlen($row['milestoneHeadline']) > 20 ? $this->e(substr(($row['milestoneHeadline']), 0, 20) . " [..]") : $this->e($row['milestoneHeadline']); ?>
                                                </div>
                                                <div class="col-md-7" style="text-align:right">

                                                    <?= sprintf($this->__("text.percent_complete"), $row['percentDone']) ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success"
                                                             role="progressbar"
                                                             aria-valuenow="<?php echo $row['percentDone']; ?>"
                                                             aria-valuemin="0" aria-valuemax="100"
                                                             style="width: <?php echo $row['percentDone']; ?>%">
                                                            <span class="sr-only"><?= sprintf($this->__("text.percent_complete"), $row['percentDone']) ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <br/>
                            <a href="<?= BASE_URL ?>/leancanvas/editCanvasItem?type=problem"
                               class="canvasModal btn canvas-add-new-btn"
                               id="problem"><?= $this->__('links.add_new_canvas_item') ?></a>
                        </div>
                    </div>

                    <div class="column" style="width:33.33%">
                        <h5 class="widgettitle  widget-title-simple-canvas canvas-widget-title title-primary"
                            style="background: #2670c9;">
                            <?php if ($login::userIsAtLeast("clientManager")) { ?>
                                <!-- <a href="<?= BASE_URL ?>/setting/editBoxLabel?module=researchlabels&label=solution" class="editLabelModal editHeadline"><i class="fas fa-edit"></i></a> -->
                            <?php } ?>
                            <?php echo $canvasLabels["solution"]; ?>
                        </h5>
                        <div class="contentInner even status_problem simple-canvas-grid">
                            <?php foreach ($this->get('canvasItems') as $row) { ?>
                                <?php if ($row["box"] == "solution") { ?>
                                    <div class="ticketBox research-board-ticketbox" id="item_<?php echo $row["id"]; ?>">

                                        <div class="row">
                                            <div class="col-md-12">

                                                <?php if ($login::userIsAtLeast("developer")) { ?>
                                                    <div class="inlineDropDownContainer" style="float:right;">

                                                        <a href="javascript:void(0)"
                                                           class="dropdown-toggle ticketDropDown"
                                                           data-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-v"
                                                               style="transform: rotate(90deg);" aria-hidden="true"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li class="nav-header"><?php echo $this->__("subtitles.edit"); ?></li>
                                                            <li>
                                                                <a href="<?= BASE_URL ?>/leancanvas/editCanvasItem/<?php echo $row["id"]; ?>"
                                                                   class="canvasModal"
                                                                   data="item_<?php echo $row["id"]; ?>"> <?php echo $this->__("links.edit_canvas_item"); ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= BASE_URL ?>/leancanvas/delCanvasItem/<?php echo $row["id"]; ?>"
                                                                   class="delete canvasModal"
                                                                   data="item_<?php echo $row["id"]; ?>"> <?php echo $this->__("links.delete_canvas_item"); ?></a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                <?php } ?>

                                                <h6>
                                                    <a href="<?= BASE_URL ?>/leancanvas/editCanvasItem/<?php echo $row["id"]; ?>"
                                                       class="canvasModal" style="color: #000; font-weight:bold;"
                                                       data="item_<?php echo $row["id"]; ?>"><?php $this->e($row["description"]); ?></a>
                                                </h6>

                                                <?php
                                                if ($row["conclusion"] != "") {
                                                    echo($row["conclusion"]);
                                                } else {
                                                    echo $this->__("text.no_conclusion_yet");
                                                }
                                                ?>
                                                <div class="clearfix" style="padding-bottom: 8px;"></div>

                                                <div class="dropdown ticketDropdown statusDropdown colorized show firstDropdown">
                                                    <a class="dropdown-toggle f-left status label-<?= $row["status"]; ?>"
                                                       href="javascript:void(0);" role="button"
                                                       id="statusDropdownMenuLink<?= $row['id'] ?>"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                                    <span class="text"><?php
                                                                        echo $statusLabels[$row['status']];
                                                                        ?>
                                                                    </span>
                                                        &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </a>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="statusDropdownMenuLink<?= $row['id'] ?>">
                                                        <li class="nav-header border"><?= $this->__("dropdown.choose_status") ?></li>

                                                        <?php foreach ($statusLabels as $key => $label) {
                                                            echo "<li class='dropdown-item'>
                                                                        <a href='javascript:void(0);' class='label-" . $key . "' data-label='" . $this->escape($label) . "' data-value='" . $row['id'] . "_" . $key . "' id='ticketStatusChange" . $row['id'] . $key . "' >" . $this->escape($label) . "</a>";
                                                            echo "</li>";
                                                        } ?>
                                                    </ul>
                                                </div>

                                                <div class="dropdown ticketDropdown userDropdown noBg show right lastDropdown dropRight">
                                                    <a class="dropdown-toggle f-left" href="javascript:void(0);"
                                                       role="button" id="userDropdownMenuLink<?= $row['id'] ?>"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                                    <span class="text">
                                                                        <?php if ($row["authorFirstname"] != "") {
                                                                            echo "<span id='userImage" . $row['id'] . "'><img src='" . BASE_URL . "/api/users?profileImage=" . $row['authorProfileId'] . "' width='25' style='vertical-align: middle;'/></span><span id='user" . $row['id'] . "'></span>";
                                                                        } else {
                                                                            echo "<span id='userImage" . $row['id'] . "'><img src='" . BASE_URL . "/api/users?profileImage=false' width='25' style='vertical-align: middle;'/></span><span id='user" . $row['id'] . "'></span>";
                                                                        } ?>
                                                                    </span>

                                                    </a>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="userDropdownMenuLink<?= $row['id'] ?>">
                                                        <li class="nav-header border"><?= $this->__("dropdown.choose_user") ?></li>

                                                        <?php foreach ($this->get('users') as $user) {
                                                            echo "<li class='dropdown-item'>
                                                                    <a href='javascript:void(0);' data-label='" . sprintf($this->__("text.full_name"), $this->escape($user["firstname"]), $this->escape($user['lastname'])) . "' data-value='" . $row['id'] . "_" . $user['id'] . "_" . $user['profileId'] . "' id='userStatusChange" . $row['id'] . $user['id'] . "' ><img src='" . BASE_URL . "/api/users?profileImage=" . $user['profileId'] . "' width='25' style='vertical-align: middle; margin-right:5px;'/>" . sprintf($this->__("text.full_name"), $this->escape($user["firstname"]), $this->escape($user['lastname'])) . "</a>";
                                                            echo "</li>";
                                                        } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>


                                        <?php if ($row['milestoneHeadline'] != '') { ?>
                                            <hr/>
                                            <div class="row">

                                                <div class="col-md-5">
                                                    <?php strlen($row['milestoneHeadline']) > 20 ? $this->e(substr(($row['milestoneHeadline']), 0, 20) . " [..]") : $this->e($row['milestoneHeadline']); ?>
                                                </div>
                                                <div class="col-md-7" style="text-align:right">

                                                    <?= sprintf($this->__("text.percent_complete"), $row['percentDone']) ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success"
                                                             role="progressbar"
                                                             aria-valuenow="<?php echo $row['percentDone']; ?>"
                                                             aria-valuemin="0" aria-valuemax="100"
                                                             style="width: <?php echo $row['percentDone']; ?>%">
                                                            <span class="sr-only"><?= sprintf($this->__("text.percent_complete"), $row['percentDone']) ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <br/>
                            <a href="<?= BASE_URL ?>/leancanvas/editCanvasItem?type=solution"
                               class="canvasModal btn canvas-add-new-btn"
                               id="solution"><?= $this->__('links.add_new_canvas_item') ?></a>
                        </div>
                    </div>


                </div>


            </div>
            <div class="clearfix"></div>

            <?php
            if (isset($_SESSION['tourActive']) === true && $_SESSION['tourActive'] == 1) { ?>
                <p class="align-center"><br/>
                    <?= $this->__('tour.once_your_done_research'); ?>
                </p>
            <?php } ?>

        <?php } else {

            echo "<br /><br /><div class='center'>";

            echo "<div style='width:30%' class='svgContainer'>";
            echo file_get_contents(ROOT . "/images/svg/undraw_design_data_khdb.svg");
            echo "</div>";

            echo "<h4>" . $this->__('headlines.research_next_big_product') . "</h4><br />" . $this->__('text.no_lean_canvas_content') . "
            </div>";

        }
        ?>

        <!-- Modals -->
        <div class="modal fade bs-example-modal-lg" id="addCanvas">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><?= $this->__('subtitles.create_new_board') ?></h4>
                        </div>
                        <div class="modal-body" style="margin-left: 0px; overflow-y: clip;">
                            <label><?= $this->__('label.name_of_product') ?></label>
                            <input type="text" class="col-12" name="canvastitle"
                                   placeholder="<?= $this->__('input.placeholders.enter_title_for_board') ?>"/>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal"><?= $this->__('buttons.close') ?></button>
                            <input type="submit" class="btn" style="background: #1374e9;"
                                   value="<?= $this->__('buttons.create_board') ?>" name="newCanvas"/>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade bs-example-modal-lg" id="editCanvas">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><?= $this->__('subtitle.edit_board') ?></h4>
                        </div>
                        <div class="modal-body">
                            <label><?= $this->__('label.name_of_product') ?></label>
                            <input type="text" name="canvastitle" value="<?php $this->e($canvasTitle); ?>"
                                   style="width:90%"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal"><?= $this->__('buttons.close') ?></button>
                            <input type="submit" class="btn btn-default" value="<?= $this->__('buttons.save') ?>"
                                   name="editCanvas"/>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
</div>
