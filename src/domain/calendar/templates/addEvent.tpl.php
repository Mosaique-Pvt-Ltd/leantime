<?php
defined('RESTRICTED') or die('Restricted access');
$values = $this->get('values');
$helper = $this->get('helper');
?>

<div class="pageheader">
            
    <div class="pageicon"><span class="<?php echo $this->getModulePicture() ?>"></span></div>
    <div class="pagetitle">
        <h5><?php echo $this->__('headline.calendar'); ?></h5>
        <h1><?php echo $this->__('headline.new_event'); ?></h1>
    </div>
</div><!--pageheader-->
        
        
<div class="maincontent">
    <div class="maincontentinner">

    <?php echo $this->displayNotification() ?>
     <div class="widget">
        <h4 class="widgettitle"><?php echo $this->__('subtitles.event'); ?></h4>
        <div class="widgetcontent">

            <form action="" method="post" class='stdform'>

                <label for="description"><?php echo $this->__('label.title') ?></label>
                <input type="text" id="description" name="description" value="<?php echo $values['description']; ?>" /><br />

                <div class="par">
                    <label for="dateFrom"><?php echo $this->__('label.start_date') ?></label>
                    <input type="text" id="event_date_from" name="dateFrom" value="" /><br/>
                </div>
                <div class="par">
                    <label for=""><?php echo $this->__('label.start_time') ?></label>
                    <div class="input-append bootstrap-timepicker">
                            <input type="text" id="event_time_from" name="timeFrom" value="" />
                       </div>
                </div>
                <div class="par">
                    <label for="dateTo"><?php echo $this->__('label.end_date') ?></label>
                    <input type="text" id="event_date_to" name="dateTo" value="" /><br/>
                </div>
                <div class="par">
                    <label for=""><?php echo $this->__('label.end_time') ?> </label>
                    <div class="input-append bootstrap-timepicker">
                            <input type="text" id="event_time_to" name="timeTo" value="" />
                       </div>
                </div>

                <div class="par">
                    <label for="emailNote"><?php echo $this->__('label.email_note') ?></label>
                    <textarea id="emailNote" name="emailNote" rows="4" cols="50"></textarea>
                </div>

                <!--Email Notification-->
                <label for="emailNotification"><?php echo $this->__('label.email_notification') ?></label>
                <input type="checkbox" id="emailNotification" name="emailNotification" 
                <?php if($values['emailNotification'] === 'true') {
                    echo 'checked="checked" ';
                }?>/><br /><br /><br />

                <label for="allDay"><?php echo $this->__('label.all_day') ?></label>
                <input type="checkbox" id="allDay" name="allDay"
                <?php if($values['allDay'] === 'true') {
                    echo 'checked="checked" ';
                }?>
                /> <br />

                <p class="stdformbutton">
                    <input type="submit" name="save" id="save" value="<?php echo $this->__('buttons.save') ?>" class="button" />
                    <input type="submit" name="preview" id="preview" value="<?php echo $this->__('buttons.preview') ?>" class="button" />
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

<style>
h4, .close{
    background:#eeeeee; 
    padding:15px; 
}
</style>


<!-- The Modal -->
<div id="myModal" class="w3-modal">
  <!-- Modal content -->
  <div class="w3-modal-content">
    <div class="w3-container">
        <span class="close">&times;</span>
        <h4 class="preview-header">Email Preview</h4>

        <h5>Hi,</h5>
        <h5>The following are the details regarding the new event you have created.</h5><br>
        <h5 id="preview-description">Title</h5>
        <h5 id="preview-note">Note</h5>
        <h5 id="preview-startdate">Start date</h5>
        <h5 id="preview-starttime">Start time</h5>
        <h5 id="preview-enddate">End date</h5>
        <h5 id="preview-endtime">End time</h5>
    </div>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("preview");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function(event) {
  modal.style.display = "block";
  event.preventDefault();

  var previewDescription = document.getElementById('description').value;
  document.getElementById('preview-description').innerHTML= 'Title: ' +previewDescription;

  var previewStartdate = document.getElementById('event_date_from').value;
  document.getElementById('preview-startdate').innerHTML= 'Start date: ' +previewStartdate;

  var previewStarttime = document.getElementById('event_time_from').value;
  document.getElementById('preview-starttime').innerHTML= 'Start time: ' +previewStarttime;

  var previewEnddate = document.getElementById('event_date_to').value;
  document.getElementById('preview-enddate').innerHTML= 'End date: ' +previewEnddate;

  var previewEndtime = document.getElementById('event_time_to').value;
  document.getElementById('preview-endtime').innerHTML= 'End time: ' +previewEndtime;

  var previewNote = document.getElementById('emailNote').value;
  document.getElementById('preview-note').innerHTML= 'Note: ' +previewNote;

  
}

// When the user clicks on <span> (x), close the modal
span.onclick = function()
 {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

