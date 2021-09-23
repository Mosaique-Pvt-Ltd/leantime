<?php
defined('RESTRICTED') or die('Restricted access');
$values = $this->get('values');
?>

<div class="pageheader">


    <div class="pagetitle">
        <h5><?php echo $this->__('label.administration') ?></h5>
        <h1><?php echo $this->__('headline.new_client'); ?></h1>
    </div>
</div><!--pageheader-->
        
<div class="maincontent">
    <div class="maincontentinner">

        <?php echo $this->displayNotification() ?>

        <div class="widget">
           <div class="widgetcontent">
                <form action="" method="post" class="stdform">

                    <div class="row row-fluid">
                        <div class="col-md-8   ">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                    <label class="span12 control-label"><?php echo $this->__('label.name') ?></label>
                                    <input type="text" name="name" id="name" class="span12" value="<?php $this->e($values['name']); ?>" />
                                    </div>
                                    <div class="col-md-6">
                                    <label class="span12 control-label"><?php echo $this->__('label.email') ?></label>
                                    <input type="text" name="email" class="span12" id="email" value="<?php $this->e($values['email']); ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                    <label class="span12 control-label"><?php echo $this->__('label.url') ?></label>
                                    <input
                                            type="text" class="span12" name="internet" id="internet"
                                            value="<?php $this->e($values['internet']); ?>" />
                                    </div>
                                    <div class="col-md-6">
                                    <label class="span12 control-label"><?php echo $this->__('label.phone') ?></label>
                                    <input
                                            type="text" class="span12" name="phone" id="phone"
                                            value="<?php $this->e($values['phone']); ?>" />
                                    </div>
                                </div>
                            </div>
                            <hr>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                    <label class="span12 control-label"><?php echo $this->__('label.street') ?></label>
                                    <input type="text" class="span12" name="street" id="street" value="<?php $this->e($values['street']); ?>" />
                                    </div>
                                    <div class="col-md-3">
                                    <label class="span12 control-label"><?php echo $this->__('label.zip') ?></label>
                                    <input type="text" class="span12" name="zip" id="zip" value="<?php $this->e($values['zip']); ?>" />
                                    </div>
                                    <div class="col-md-3">
                                    <label class="span12 control-label"><?php echo $this->__('label.city') ?></label>
                                    <input type="text" class="span12" name="city" id="city" value="<?php $this->e($values['city']); ?>" />
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                    <label class="span12 control-label"><?php echo $this->__('label.state') ?></label>
                                    <input type="text" class="span12" name="state" id="state" value="<?php $this->e($values['state']); ?>" />
                                    </div>
                                    <div class="col-md-6">
                                    <label class="span12 control-label"><?php echo $this->__('label.country') ?></label>
                                    <input type="text" class="span12" name="country" id="country" value="<?php $this->e($values['country']); ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <div class="span12 control-label">
                                    <input type="submit" name="save" id="save"
                                           value="<?php echo $this->__('buttons.save') ?>" class="btn btn-primary" />
                                </div>
                                <div class="span6">

                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
