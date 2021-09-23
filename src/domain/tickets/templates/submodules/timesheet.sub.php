<?php 
    $values = $this->get('timesheetValues');
    $ticket = $this->get('ticket');
    $userInfo = $this->get('userInfo');
    $remainingHours = $this->get('remainingHours');
    if($remainingHours < 0) {$remainingHours = 0;}
    $currentPay = $this->get('userHours') * $userInfo['wage'];
?>

        <div class="row-fluid">
            <div class="span6">
                

                <h4 class="widgettitle title-light"><?php echo $this->__('headline.add_time_entry', false); ?></h4>
                <br />

                <form method="post" action="#timesheet" class="stdform">

                    <div class="span6">
                    <label for="kind" class="span12"><?php echo $this->__('label.timesheet_kind') ?></label>
                        <span class="field">
                        <select id="kind" name="kind" class="col-12">
                        <?php foreach ($this->get('kind') as $key => $row) {
                            echo'<option value="'.$key.'"';
                            if($row == $values['kind']) { echo ' selected="selected"';
                            }
                            echo'>'.$this->__(strtolower($row)).'</option>';

                        } ?>
                        </select>
                        </span>

                        <div class="row-fluid">
                            <div class="span6">
                                <label for="timesheetdate" class="span12"><?php echo $this->__('label.date') ?>:</label>
                                <input type="text" class="span12" id="timesheetdate" name="date" class="dates" value="<?php echo $values['date'] ?>" /><br/>
                            </div>


                            <div class="span6">
                                <label for="hours" class="span12"><?php echo $this->__('label.hours') ?></label>
                                <span class="field">
                                    <input type="text" id="hours" class="span12" name="hours" value="<?php echo $values['hours'] ?>" size="7" class="input-small" />
                                </span>
                            </div>
                        </div>

                    

                    </div>
                    <div class="span6">
                    <label for="description"><?php echo $this->__('label.description') ?></label>
                    <span class="field">
                        <textarea rows="5" style="margin-top: 5px;" cols="50" class="span12" id="description" name="description"><?php echo $values['description']; ?></textarea><br />
                    </span>
                    </div>

                    <input type="submit" value="<?php echo $this->__('buttons.save'); ?>" name="saveTimes" class="button pull-right" />

                </form>

            </div>
            <div class="span6">
            </div>
            <div class="span12">
                <h4 class="widgettitle title-light"><?php echo $this->__('subtitles.logged_hours_chart'); ?></h4>

                <br />
                <canvas id="canvas"></canvas>
                <p><br />
                    <div class="row">
                        <div class="col-12" style="    display: flex;justify-content: space-between;">
                        <span><?php echo $this->__('label.planned_hours'); ?>: <?php echo $ticket->planHours; ?></span>
                        <span><?php echo $this->__('label.booked_hours') ?>: <?php echo $this->get('timesheetsAllHours'); ?></span>
                        <span><?php echo $this->__('label.actual_hours_remaining') ?>: <?php echo $remainingHours; ?></span>
                        </div>
                    </div>
                </p>
            </div>
        </div>

<script type="text/javascript">

    jQuery(document).ready(function($) {

        var d2 = [];
        var d3 = [];
        var labels = [];
        <?php
        $sum = 0;
        foreach ($this->get('ticketHours') as $hours){
            $sum = $sum + $hours['summe'];

            echo"labels.push('".date($this->__("language.dateformat"),  strtotime($hours['utc']))."');
                    ";
            echo"d2.push(".$sum.");
                    ";
            echo "d3.push(".$ticket->planHours.");
                    ";

        } ?>

        leantime.ticketsController.initTimeSheetChart(labels, d2, d3, "canvas")

    });

</script>