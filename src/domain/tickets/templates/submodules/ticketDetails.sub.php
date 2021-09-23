<?php

    $ticket = $this->get('ticket');
    $remainingHours = $this->get('remainingHours');
    $statusLabels  = $this->get('statusLabels');
    $ticketTypes = $this->get('ticketTypes');

?>

<div class="row-fluid">
    <div class="span6">
        <div class="row-fluid">
            <div class="span12">
                <strong><h4 class="widgettitle title-light"><?php echo $this->__('subtitle.general'); ?></h4></strong>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="span12 control-label"><?php echo $this->__('label.ticket_title'); ?>*</label>
                            <input type="text" class="span12" value="<?php $this->e($ticket->headline); ?>" name="headline" autocomplete="off"  style="width:99%;"/>
                        </div>
                        <div class="col-md-6">
                        <label class="span12 control-label"><?php echo $this->__('label.sprint'); ?></label>
                        <select id="sprint-select" class="col-12 to-do-create-select-field" name="sprint"
                                data-placeholder="<?php echo $ticket->sprint ?>">
                            <option value=""><?php echo $this->__('label.not_assigned_to_sprint'); ?></option>
                            <?php
                            if($this->get('sprints')){
                                foreach ($this->get('sprints') as $sprintRow) { ?>
                                <option value="<?php echo $sprintRow->id; ?>"
                                    <?php if ($ticket->sprint == $sprintRow->id) {
                                        echo "selected='selected'";
                                    } ?>
                                ><?php $this->e($sprintRow->name); ?></option>
                            <?php }
                            } ?>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="height: 75px;">
                    <div class="row">
                        <div class="col-md-6">
                        <label class="span12 control-label"><?php echo $this->__('label.milestone'); ?></label>
                        <select  name="dependingTicketId"  class="col-12 to-do-create-select-field" >
                                <option value=""><?php echo $this->__('label.not_assigned_to_milestone'); ?></option>
                                <?php foreach($this->get('milestones') as $milestoneRow){     ?>

                                    <?php echo"<option value='".$milestoneRow->id."'";

                                    if(($ticket->dependingTicketId == $milestoneRow->id)) { echo" selected='selected' ";
                                    }

                                    echo">".$this->escape($milestoneRow->headline)."</option>"; ?>

                                <?php }     ?>
                        </select>

                        </div>
                        <div class="col-md-6">
                        <label class="span12 control-label"><?php echo $this->__('label.effort'); ?></label>
                        <select id='storypoints' name='storypoints' class="col-12 to-do-create-select-field">
                            <option value=""><?php echo $this->__('label.effort_not_defined'); ?></option>
                            <?php foreach ($this->get('efforts') as $effortKey=>$effortValue) {
                                echo "<option value='" . $effortKey . "' ";
                                if ($effortKey == $ticket->storypoints) {
                                    echo "selected='selected'";
                                }
                                echo ">" . $effortValue . "</option>";
                            } ?>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="height: 150px;">
                    <div class="row">
                        <div class="col-md-6">

                        <label class="span12 control-label"><?php echo $this->__('label.todo_type'); ?></label>
                            <select id='type' name='type' class="col-12 to-do-create-select-field">
                                <?php foreach ($ticketTypes as $types) {

                                    echo "<option value='" . strtolower($types) . "' ";
                                    if(strtolower($types) == strtolower($ticket->type)) echo "selected='selected'";

                                    echo ">" . $this->__("label.".strtolower($types)) . "</option>";

                                } ?>
                            </select>

                        <label class="span12 control-label"><?php echo $this->__('label.todo_status'); ?></label>
                        <select id="status-select" class="col-12 to-do-create-select-field" name="status"
                                data-placeholder="<?php echo $statusLabels[$ticket->status]["name"]; ?>">

                            <?php  foreach($statusLabels as $key=>$label){?>
                                <option value="<?php echo $key; ?>"
                                    <?php if ($ticket->status == $key) {
                                        echo "selected='selected'";
                                    } ?>
                                ><?php echo $this->escape($label["name"]); ?></option>
                            <?php } ?>
                        </select>
                        
                        </div>
                        <div class="col-md-6">
                        <label class="span12 control-label"><?php echo $this->__('label.tags'); ?></label>
                        <input type="text" value="<?php $this->e($ticket->tags); ?>" name="tags" id="tags"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row-fluid to-do-date-container">
            <hr>
            <div class="span12">
                <strong><h4 class="widgettitle title-light"><?php echo $this->__('subtitles.dates'); ?></h4></strong>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                        <label class="span12 control-label"><?php echo $this->__('label.ticket_date'); ?></label>
                        <input type="text" class="dates span12" id="submittedDate" disabled="disabled"
                               value="<?php echo $ticket->date; ?>" name="date"/>
                        </div>
                        <div class="col-md-6">
                        <label class="span12 control-label"><?php echo $this->__('label.due_date'); ?></label>
                        <input type="text" class="dates span12" id="deadline"
                               value="<?php echo $ticket->dateToFinish; ?>"
                               name="dateToFinish"/>
                        </div>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label class="span12 control-label"><?php echo $this->__('label.working_date_from_to'); ?></label>
                    <div class="span12">
                        <input type="text" class="dates span6" style=" float:left;" name="editFrom"
                               value="<?php echo $ticket->editFrom; ?>"/> -
                        <input type="text" class="dates span6" name="editTo"
                               value="<?php echo $ticket->editTo; ?>"/>
                    </div>
                </div> -->
                <div class="form-group">
                    <div class="row">
                        <label class="span12 col-md-12 control-label"><?php echo $this->__('label.working_date_from_to'); ?></label>
                        <div class="col-6">
                        <input type="text" class="dates span12" style=" float:left;" name="editFrom"
                               value="<?php echo $ticket->editFrom; ?>"/>
                        </div>
                        <span id="separator-sapn-id"></span>
                        <div class="col-6">
                        <input type="text" class="dates span12" name="editTo"
                               value="<?php echo $ticket->editTo; ?>"/>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="span6">
        <div class="row-fluid">
            <div class="span12">
                <strong><h4 class="widgettitle title-light"><?php echo $this->__('subtitle.people'); ?></h4></strong>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                        <label class="span4 control-label"><?php echo $this->__('label.author'); ?></label>
                        <input type="text" class="span12" disabled="disabled"
                               value="<?php $this->e($ticket->userFirstname); ?> <?php $this->e($ticket->userLastname); ?>"/>
                        </div>
                        <div class="col-md-6">
                        <label class="span12 control-label"><?php echo $this->__('label.editor'); ?></label>
                        <select class="col-12 to-do-create-select-field" data-placeholder="<?php echo $this->__('label.filter_by_user'); ?>"
                                name="editorId" class="user-select span11">
                            <option value=""><?php echo $this->__('label.not_assigned_to_user'); ?></option>
                            <?php foreach ($this->get('users') as $userRow) { ?>

                                <?php echo "<option value='" . $userRow["id"] . "'";

                                if ($ticket->editorId == $userRow["id"]) { echo " selected='selected' ";}

                                echo ">" . $this->escape($userRow["firstname"] . " " . $userRow["lastname"]) . "</option>"; ?>

                            <?php } ?>
                        </select>
                        </div>
                    </div>
                    
                </div>


            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <strong><h4 class="widgettitle title-light"><?php echo $this->__('subtitle.time_tracking'); ?></h4></strong>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                        <label class="span12 control-label"><?php echo $this->__('label.planned_hours'); ?></label>
                        <input type="text" class="span12" value="<?php $this->e($ticket->planHours); ?>" name="planHours"/>
                        </div>
                        <div class="col-md-6">
                        <label class="span12 control-label"><?php echo $this->__('label.estimated_hours_remaining'); ?></label>

                        <input type="text" class="span12" value="<?php $this->e($ticket->hourRemaining); ?>" name="hourRemaining"/>
                        <a href="javascript:void(0)" class="infoToolTip" style="position: absolute;" data-placement="left" data-toggle="tooltip" data-original-title="<?php echo $this->__('tooltip.how_many_hours_remaining'); ?>">
                            &nbsp;<i class="fa fa-question-circle" style="position: absolute; padding-top:10px; color: gray;"></i>&nbsp;</a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                        <label class="span12 control-label"><?php echo $this->__('label.booked_hours'); ?></label>
                        <input type="text" class="span12" disabled="disabled"
                               value="<?php echo $this->get('timesheetsAllHours'); ?>"/>
                        </div>
                        <div class="col-md-6">
                        <label class="span12 control-label"><?php echo $this->__('label.actual_hours_remaining'); ?></label>
                        <input type="text" class="span12" disabled="disabled" value="<?php echo $remainingHours; ?>"/>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- <div class="form-group">
                    <div class="span6">
                        
                    </div>
                </div> -->



            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <strong><h4 class="widgettitle title-light"><?php echo $this->__('label.description'); ?>
                </h4></strong>

                <textarea name="description" rows="10" cols="80" id="ticketDescription"
                          class="tinymce"><?php echo $ticket->description ?></textarea><br/>
                <input type="hidden" name="acceptanceCriteria" value=""/>

            </div>
        </div>

    </div>

</div>
<div class="row-fluid">
    <?php if (isset($ticket->id) && $ticket->id != '') : ?>
        <div class="pull-left padding-top">
            <?php echo $this->displayLink('tickets.delTicket', '<i class="fa fa-trash"></i> '.$this->__('links.delete_todo'), array('id' => $ticket->id), array('class' => 'delete')) ?>
        </div>
    <?php endif; ?>

    <input type="submit" class="pull-right" style="margin-left: 5px;" name="saveTicket" value="<?php echo $this->__('buttons.save'); ?>"/>
    <input type="submit" class="pull-right" id="savenclose" name="saveAndCloseTicket" value="<?php echo $this->__('buttons.save_and_close'); ?>"/>

</div>

