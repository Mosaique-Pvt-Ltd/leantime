<?php
$currentMilestone = $this->get('milestone');
$milestones = $this->get('milestones');
$statusLabels = $this->get('statusLabels');


?>

<script type="text/javascript">
    window.onload = function() {
        if (!window.jQuery) {
            //It's not a modal
            location.href="<?=BASE_URL ?>/tickets/roadmap&showMilestoneModal=<?php echo $currentMilestone->id; ?>";

        }
    }
</script>

<div class="showDialogOnLoad" style="display:none;">


    <h4 class="widgettitle title-light"><?=$this->__("headline.milestone"); ?> </h4>

    <?php echo $this->displayNotification(); ?>

    <form class="formModal" method="post" action="<?=BASE_URL ?>/tickets/editMilestone/<?php echo $currentMilestone->id ?>" style="min-width: 250px;">
    <div class="row">
        <div class="col-md-6">
        <label><?=$this->__("label.milestone_title"); ?></label>
        <input type="text" name="headline" value="<?php echo $currentMilestone->headline?>" placeholder="<?=$this->__("label.milestone_title"); ?>"/>
        </div>
        <div class="col-md-6">
        <label><?=$this->__("label.owner"); ?></label>
        <select data-placeholder="<?php echo $this->__('input.placeholders.filter_by_user'); ?>"
                name="editorId" class="user-select col-12">
            <option value=""><?=$this->__("dropdown.not_assigned"); ?></option>
            <?php foreach ($this->get('users') as $userRow) { ?>

                <?php echo "<option value='" . $userRow["id"] . "'";

                if ($currentMilestone->editorId == $userRow["id"]) { echo " selected='selected' ";
                }

                echo ">" . $this->escape($userRow["firstname"]) . " " . $this->escape($userRow["lastname"]) . "</option>"; ?>

            <?php } ?>
        </select>
        </div>
    </div>
        <div class="row">
            <div class="col-md-6">
            <label><?php echo $this->__('label.todo_status'); ?></label>
            <select id="status-select" name="status" class="col-12"
                    data-placeholder="<?php echo $statusLabels[$currentMilestone->status]["name"]; ?>">

                <?php  foreach($statusLabels as $key=>$label){?>
                    <option value="<?php echo $key; ?>"
                        <?php if ($currentMilestone->status == $key) {
                            echo "selected='selected'";
                        } ?>
                    ><?php echo $this->escape($label["name"]); ?></option>
                <?php } ?>
            </select>
            </div>
            <div class="col-md-6">
                <label><?=$this->__("label.color"); ?></label>

                <input type="radio"  class="color-input" name="tags" id="blue" value="#0159c7" <?php echo ($currentMilestone->tags== '#0159c7') ?  "checked" : "" ;  ?> />
                <label id="color-label" for="blue"><span class="blue"></span></label>

                <input type="radio"  class="color-input" name="tags" id="light-blue" value="#1374e9" <?php echo ($currentMilestone->tags== '#1374e9') ?  "checked" : "" ;  ?> />
                <label id="color-label" for="light-blue"><span class="light-blue"></span></label>

                <input type="radio"  class="color-input" name="tags" id="green" value="#19c861" <?php echo ($currentMilestone->tags== '#19c861') ?  "checked" : "" ;  ?> />
                <label id="color-label" for="green"><span class="green"></span></label>

                <input type="radio"  class="color-input" name="tags" id="light-green" value="#36cb8b" <?php echo ($currentMilestone->tags== '#36cb8b') ?  "checked" : "" ;  ?> />
                <label id="color-label" for="light-green"><span class="light-green"></span></label>
                
                <input type="radio"  class="color-input" name="tags" id="orange" value="#fe7620" <?php echo ($currentMilestone->tags== '#fe7620') ?  "checked" : "" ;  ?> />
                <label id="color-label" for="orange"><span class="orange"></span></label>

                <input type="radio"  class="color-input" name="tags" id="yellow" value="#fdab3f" <?php echo ($currentMilestone->tags== '#fdab3f') ?  "checked" : "" ;  ?> />
                <label id="color-label" for="yellow"><span class="yellow"></span></label>

                <input type="radio"  class="color-input" name="tags" id="dark-red" value="#b90125" <?php echo ($currentMilestone->tags== '#b90125') ?  "checked" : "" ;  ?> />
                <label id="color-label" for="dark-red"><span class="dark-red"></span></label> 
                
                <input type="radio"  class="color-input" name="tags" id="red" value="#ee2750" <?php echo ($currentMilestone->tags== '#ee2750') ?  "checked" : "" ;  ?> />
                <label id="color-label" for="red"><span class="red"></span></label>         

                <!-- <input type="radio"  class="color-input" name="tags" id="olive" value="#B5CC18" <?php echo ($currentMilestone->tags== '#B5CC18') ?  "checked" : "" ;  ?> />
                <label id="color-label" for="olive"><span class="olive"></span></label> -->

                <!-- <input type="radio"  class="color-input" name="tags" id="teal" value="#00B5AD" <?php echo ($currentMilestone->tags== '#00B5AD') ?  "checked" : "" ;  ?> />
                <label id="color-label" for="teal"><span class="teal"></span></label> -->

                <!-- <input type="radio"  class="color-input" name="tags" id="purple" value="#A333C8" <?php echo ($currentMilestone->tags== '#A333C8') ?  "checked" : "" ;  ?> />
                <label id="color-label" for="purple"><span class="purple"></span></label>

                <input type="radio"  class="color-input" name="tags" id="pink" value="#E03997" <?php echo ($currentMilestone->tags== '#E03997') ?  "checked" : "" ;  ?> />
                <label id="color-label" for="pink"><span class="pink"></span></label> -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            <label><?=$this->__("label.dependent_on"); ?></label>
            <select name="dependentMilestone"  class="col-12">
                <option value=""><?=$this->__("label.no_dependency"); ?></option>
                <?php foreach ($this->get('milestones') as $milestoneRow) {
                    if($milestoneRow->id !== $currentMilestone->id) {
                        echo "<option value='" . $milestoneRow->id . "'";

                        if ($currentMilestone->dependingTicketId == $milestoneRow->id) { echo " selected='selected' ";
                        }

                        echo ">" . $milestoneRow->headline . " </option>";

                    }
                }
                ?>

            </select>
            </div>
            <div class="col-md-3">
                <label><?=$this->__("label.planned_start_date"); ?></label>
                <input type="text" name="editFrom" value="<?php echo $this->getFormattedDateString($currentMilestone->editFrom) ?>" placeholder="<?=$this->__("language.dateformat"); ?>" id="milestoneEditFrom" />
            </div>
            <div class="col-md-3">
                <label><?=$this->__("label.planned_end_date"); ?></label>
                <input type="text" name="editTo" value="<?php echo $this->getFormattedDateString($currentMilestone->editTo) ?>"  placeholder="<?=$this->__("language.dateformat"); ?>" id="milestoneEditTo" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <input type="submit" class="pull-right" value="<?=$this->__("buttons.save"); ?>" class="btn btn-primary"/>
            </div>
            <div class="col-md-6 align-left padding-top-sm">
                <?php if (isset($currentMilestone->id) && $currentMilestone->id != ''


                ) { ?>
                    <a href="<?=BASE_URL ?>/tickets/delMilestone/<?php echo $currentMilestone->id; ?>" class="delete formModal milestoneModal"><i class="fa fa-trash"></i> <?=$this->__("buttons.delete"); ?></a>
                <?php } ?>
            </div>
        </div>

    </form>

        <?php
            if(isset($currentMilestone->id) && $currentMilestone->id !== '') {
        ?>
        <br />
        <input type="hidden" name="comment" value="1" />

        <?php
        $this->assign("formUrl", "/tickets/editMilestone/".$currentMilestone->id."");
        $this->displaySubmodule('comments-generalComment');?>
    <?php } ?>

    <script type="text/javascript">
        jQuery(document).ready(function(){
            leantime.ticketsController.initModals();
        })
    </script>

</div>