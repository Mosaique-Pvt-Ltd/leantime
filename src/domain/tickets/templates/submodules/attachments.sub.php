<?php
$ticket = $this->get('ticket');
?>
<div class="mediamgr_category">
    
    <form action='#files' method='POST' enctype="multipart/form-data" class="">
        <div class="par f-left" style="margin-right: 15px;">

         <div class='fileupload fileupload-new' data-provides='fileupload'>
                <input type="hidden" />
            <div class="input-append">
                <div class="uneditable-input span3">
                    <i class="iconfa-file fileupload-exists"></i><span class="fileupload-preview"></span>
                </div>
                <span class="btn btn-file">
                    <span class="fileupload-new"><?php echo $this->__("buttons.select_file"); ?></span>
                    <span class='fileupload-exists'><?php echo $this->__("buttons.change"); ?></span>
                    <input type='file' name='file' />
                </span>
                <a href='#' class='btn fileupload-exists' data-dismiss='fileupload'><?php echo $this->__("buttons.remove"); ?></a>
            </div>
          </div>
       </div>

       <input type="submit" name="upload" class="button" value="<?php echo $this->__('buttons.upload'); ?>" />

    </form>
    <div class="clear"></div>
</div>

<div class="mediamgr_content">

    <ul id='medialist' class='listfile'>
    <?php foreach($this->get('files') as $file): ?>
           <div class="row">
           <li class="span6" style="background:#f8f8f8; border:1px solid #e6e9f0;padding:20px; margin-left:15px">
                    <a class="pull-left " href="<?=BASE_URL ?>/download.php?module=<?php echo $file['module'] ?>&encName=<?php echo $file['encName'] ?>&ext=<?php echo $file['extension'] ?>&realName=<?php echo $file['realName'] ?>">
                                <?php if (in_array(strtolower($file['extension']), $this->get('imgExtensions'))) :  ?>
                            <?php endif; ?>
                        <span class="filename" style="color:#000;"><?php echo $file['realName'] ?></span>
                        <span class="pull-right">
                        <?php  if ($login::userIsAtLeast("developer")) { ?>
                        <a href="<?=BASE_URL ?>/tickets/showTicket/<?php echo $ticket->id ?>?delFile=<?php echo $file['id'] ?>" class="delete pull-right"><i class="fa fa-trash"></i> <?php echo $this->__("links.delete"); ?></a>
                    <?php  } ?>
                        </span>
                    </a>
           </li>
           </div>
           <br>
    <?php endforeach; ?>
    </ul>

</div><!--mediamgr_content-->

<div style='clear:both'>&nbsp;</div>
