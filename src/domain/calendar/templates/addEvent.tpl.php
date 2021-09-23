<?php

defined('RESTRICTED') or die('Restricted access');
$values = $this->get('values');
$helper = $this->get('helper');
?>

<div class="pageheader">
            
    <div class="pagetitle">
        <h5><?php echo $this->__('headline.calendar'); ?></h5>
        <h1><?php echo $this->__('headline.new_event'); ?></h1>
    </div>
</div><!--pageheader-->
        
        
<div class="maincontent">
    <div class="maincontentinner">

    <?php echo $this->displayNotification() ?>
     <div class="widget">
        <!-- <h4 class="widgettitle"><?php echo $this->__('subtitles.event'); ?></h4> -->
        <div class="widgetcontent">

            <form action="" method="post" class='stdform'>
                <div class="row">
                    <div class="col-12">
                        <label for="description" class="col-12"><?php echo $this->__('label.title') ?></label>
                        <input type="text" class="col-12" id="description" name="description" value="<?php echo $values['description']; ?>" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="dateFrom" class="col-12"><?php echo $this->__('label.start_date') ?></label>
                        <input type="text" class="col-12" id="event_date_from" name="dateFrom" value="" />
                    </div>
                    <div class="col-md-3">
                        <label for="" class="col-12 col-sm-12"><?php echo $this->__('label.start_time') ?></label>
                            <div class="input-append bootstrap-timepicker">
                                <input type="text" class="event-time-input" id="event_time_from" name="timeFrom" value="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dateTo" class="col-12 col-sm-12"><?php echo $this->__('label.end_date') ?></label>
                        <input type="text" class="col-12 col-sm-12" id="event_date_to" name="dateTo" value="" /><br/>
                    </div>
                    <div class="col-md-3">
                        <label for=""><?php echo $this->__('label.end_time') ?> </label>
                        <div class="input-append bootstrap-timepicker">
                                <input type="text" class="event-time-input" id="event_time_to" name="timeTo" value="" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="round" style="margin-left: 15px;">
                        <input type="checkbox" id="allDay" name="allDay"
                        <?php if($values['allDay'] === 'true') {
                            echo 'checked="checked" ';
                        }?>
                        />
                        <label for="allDay"></label><span style="padding-left: 10px;"><?php echo $this->__('label.all_day') ?></span>
                    </div>
                </div>
                
                <br />

                <p class="stdformbutton pull-right">
                    <input type="submit" name="save" id="save" value="<?php echo $this->__('buttons.save') ?>" class="button" />
                </p>
            </form>

        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        leantime.calendarController.initEventDatepickers();
    });
</script>