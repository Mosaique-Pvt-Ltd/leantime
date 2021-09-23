<?php
$comments = new leantime\domain\repositories\comments();
$formUrl = CURRENT_URL;

//Controller may not redirect. Make sure delComment is only added once
if (strpos($formUrl, '?delComment=') !== false) {
	$urlParts = explode('?delComment=', $formUrl);
	$deleteUrlBase = $urlParts[0] . "?delComment=";
} else {
	$deleteUrlBase = $formUrl . "?delComment=";
}
?>



<form method="post" accept-charset="utf-8" action="<?php echo $formUrl ?>"
	  id="commentForm">
	<a href="javascript:void(0);" onclick="toggleCommentBoxes(0)"
	   style="display:none;" id="mainToggler"><span
				class="fa fa-plus-square"></span> <?php echo $this->__('links.add_new_comment') ?>
	</a>
	<div class="row">
		<div class="col-md-6">
		<strong>
	<h4 class="widgettitle title-light"><?php echo $this->__('subtitles.discussion'); ?>
		</h4>
		</strong>
		<div id="comment0" class="commentBox">
		<!--<img src="<?= BASE_URL ?>/api/users?profileImage=currentUser" style="float:left; width:50px; margin-right:10px; padding:2px;"/>-->
		<textarea rows="5" cols="50" class="tinymceSimple" placeholder="Write something here..."
				  name="text"></textarea><br/>
		<input type="submit" style="background: #1374e9;" class="btn-info pull-right" style="margin-right:20px;" value="<?php echo $this->__('buttons.save') ?>"
			   name="comment" class="btn btn-default btn-success"
			   style="margin-left: 0px;"/>
		<input type="hidden" name="comment" value="1"/>
		<input type="hidden" name="father" id="father" value="0"/>
		<br/>
	</div>
		</div>
		<div class="col-md-6">
		<div id="comments">
		<div>
		<strong>
			<h4 class="widgettitle title-light"><?php echo $this->__('subtitles.comments'); ?>
			</h4>
		</strong>
			<?php foreach ($this->get('comments') as $row): ?>
				<div style="display:block; padding:10px; margin-top:10px; border-bottom:1px solid #f0f0f0;">
					<img src="<?= BASE_URL ?>/api/users?profileImage=<?= $row['profileId'] ?>"
						 style="float:left; width:50px; margin-right:10px; padding:2px;"/>
					<div class="right" style="color: #b6b6b6;"><?php printf( $this->__('text.written_on'), $this->getFormattedDateString($row['date']),
							$this->getFormattedTimeString($row['date']) ); ?></div>
					<h4 style="margin-top: 15px;color: #b6b6b6;">
					<?php printf( $this->__('text.full_name'), $this->escape($row['firstname']), $this->escape($row['lastname'])); ?>
					</h4><br/>
					<div style="margin-left:60px;"><?php echo nl2br($row['text']); ?></div>
					<div class="clear"></div>
					<br>
					<div style="padding-left:60px">
						<a href="javascript:void(0);" style="color: #b6b6b6"
						   onclick="toggleCommentBoxes(<?php echo $row['id']; ?>)">
							<?php echo $this->__('links.reply') ?>
						</a>
						
						<?php if ($row['userId'] == $_SESSION['userdata']['id']) { ?>
							<span style="color: #b6b6b6;">|</span>
							<a href="<?php echo $deleteUrlBase . $row['id'] ?>"
							   class="deleteComment" style="color: #b6b6b6">
								<?php echo $this->__('links.delete') ?>
							</a>
						<?php } ?>
						<div style="display:none;"
							 id="comment<?php echo $row['id']; ?>"
							 class="commentBox">
							<br/><input type="submit"
										value="<?php echo $this->__('links.reply') ?>"
										name="comment" class="btn btn-default"/>
						</div>
					</div>
					<div class="clear"></div>
				</div>

				<?php if ($comments->getReplies($row['id'])) : ?>
					<?php foreach ($comments->getReplies($row['id']) as $comment): ?>
						<div style="display:block; padding:10px; padding-left: 60px; border-bottom:1px solid #f0f0f0;">
							<img src="<?= BASE_URL ?>/api/users?profileImage=<?= $comment['profileId'] ?>"
								 style="float:left; width:50px; margin-right:10px; padding:2px;"/>
							<div>
								<div class="right" style="color: #b6b6b6;">
									<?php printf( $this->__('text.written_on'), $this->getFormattedDateString($row['date']),
										$this->getFormattedTimeString($row['date']) ); ?></div>
								<h4 style="margin-top: 15px;color: #b6b6b6;">
								<?php printf( $this->__('text.full_name'), $this->escape($row['firstname']), $this->escape($row['lastname'])); ?>
								</h4><br/>
								<p style="margin-left:60px;"><?php echo nl2br($comment['text']); ?></p>
								<div class="clear"></div>
								<br>
								<div style="padding-left:0px">
									<?php if ($comment['userId'] == $_SESSION['userdata']['id']) { ?>
										<a href="<?php echo $deleteUrlBase . $comment['id'] ?>"
										   class="deleteComment" style="color: #b6b6b6;">
											<span class="fa fa-trash"></span> <?php echo $this->__('links.delete') ?>
										</a>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
		</div>
	</div>

	
</form>

<script type='text/javascript'>
    function toggleCommentBoxes(id) {
        if (id == 0) {
            jQuery('#mainToggler').hide();
        } else {
            jQuery('#mainToggler').show();
        }
        jQuery('.commentBox').hide('fast', function () {
            jQuery('.commentBox textarea').remove();
            jQuery('#comment' + id + '').prepend('<textarea rows="5" cols="75" name="text" class="tinymceSimple"></textarea>');
            leantime.generalController.initSimpleEditor();
        });

        jQuery('#comment' + id + '').show('fast');
        jQuery('#father').val(id);
    }
</script>
