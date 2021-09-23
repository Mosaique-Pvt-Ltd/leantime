<?php
  $currentSprint = $this->get('sprint');
?>

<strong><h4 class="widgettitle title-light"> <?=$this->__('label.sprint') ?> <?php echo $currentSprint->name?></h4></strong>

<?php echo $this->displayNotification();

$id = "";
if(isset($currentSprint->id)) {$id = $currentSprint->id;
}
?>

<form class="formModal" method="post" action="<?=BASE_URL ?>/sprints/editSprint/<?php echo $id;?>">
    <div class="row">
        <div class="col-md-6">
            <label><?=$this->__('label.sprint_name') ?></label>
            <input type="text" name="name" value="<?php echo $currentSprint->name?>" placeholder="<?=$this->__('input.placeholders.sprint_x') ?>"/>
        </div>
        <div class="col-md-3">
            <label><?=$this->__('label.first_day') ?></label>
            <input type="text" name="startDate" value="<?php echo $currentSprint->startDate?>" placeholder="<?=$this->__('language.jsdateformat') ?>" id="sprintStart" />
        </div>
        <div class="col-md-3">
            <label><?=$this->__('label.last_day') ?></label>
            <input type="text" name="endDate" value="<?php echo $currentSprint->endDate?>"  placeholder="<?=$this->__('language.jsdateformat') ?>" id="sprintEnd"  />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 align-left padding-top-sm">
            <?php if (isset($currentSprint->id) && $currentSprint->id != '' && $login::userIsAtLeast("clientManager")) { ?>
                <a href="<?=BASE_URL ?>/sprints/delSprint/<?php echo $currentSprint->id; ?>" class="delete formModal sprintModal"><i class="fa fa-trash"></i> <?=$this->__('links.delete_sprint') ?></a>
            <?php } ?>
        </div>
        <div class="col-md-6 text-right">
            <input type="submit" class="btn-primary" value="<?=$this->__('buttons.save') ?>"/>
        </div>
    </div>

</form>

