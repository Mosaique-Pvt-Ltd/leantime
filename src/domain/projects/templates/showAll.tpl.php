<?php
	defined( 'RESTRICTED' ) or die( 'Restricted access' );
	$project = $this->get('project');
?>

<div class="pageheader">

    <div class="pagetitle">
        <h5><?php echo $this->__('label.administration');  $this->__("") ?></h5>
        <h1><?php echo $this->__('headline.all_projects') ?></h1>
    </div>

</div><!--pageheader-->

<div class="maincontent">
    <div class="maincontentinner">

        <?php echo $this->displayNotification(); ?>

		<?php echo $this->displayLink('projects.newProject',"<i class='iconfa-plus'></i> ".$this->__('link.new_project'), NULL, array('class' => 'btn btn-primary btn-rounded')) ?>

		<table class="table table-bordered" cellpadding="0" cellspacing="0" border="0" id="allProjectsTable">
			<colgroup>
		      	<col class="con1"/>
		        <col class="con0" />
		      	<col class="con1"/>
		        <col class="con0" />
		      	<col class="con1"/>
                <col class="con0"/>
		    </colgroup>
			<thead>
				<tr>
					<th class="head0"><?php echo $this->__('label.project_name'); ?></th>
					<th class="head1"><?php echo $this->__('label.client_product'); ?></th>
                    <th class="head0"><?php echo $this->__('label.client_product'); ?></th>
					<th class="head1"><?php echo $this->__('label.num_tickets'); ?></th>
					<th class="head0"><?php echo $this->__('label.hourly_budget'); ?></th>
					<th class="head1"><?php echo $this->__('label.budget_cost'); ?></th>
				</tr>
			</thead>
			<tbody>
		
			 <?php foreach($this->get('allProjects') as $row): ?>
				<?php
				$status = $row['state'];
				if($status==-1){
					$status ='Closed';
					$color='#c4c4c4';
				}else{
					$status ='Active';
					$color='#1fc875';
				}
				?>
				<tr class='gradeA'>
					
					<td class="project-name-td" style="padding:6px; border-left:3px solid <?php echo $color;?> !important">
						<?php echo $this->displayLink('projects.changeCurrentProject',$row['name'], array('id' => $row['id'])) ?>
					<td class="client-name-td">
						<?php echo $this->displayLink('clients.showClient',$row['clientName'], array('id' => $row['clientId']), NULL, true) ?>
					</td>
                    <td style="background: <?php echo $color; ?>!important; color: #fff;" class="center"><?php echo $status; ?></td>
					<td class="center number-of-ticket-td"><?php echo $row['numberOfTickets']; ?></td>
					<td class="center hour-budget-td"><?php $this->e($row['hourBudget']); ?></td>
					<td class="center dollar-budget-td"><?php $this->e($row['dollarBudget']); ?></td>
				</tr>
			 <?php endforeach; ?>
		
			</tbody>
		</table>

    </div>
</div>



<script type="text/javascript">
    jQuery(document).ready(function() {

            <?php if(isset($_SESSION['userdata']['settings']["modals"]["showProjects"]) === false || $_SESSION['userdata']['settings']["modals"]["showProjects"] == 0){     ?>
            leantime.helperController.showHelperModal("showProjects");
            <?php
            //Only show once per session
            $_SESSION['userdata']['settings']["modals"]["showProjects"] = 1;
            } ?>

            leantime.projectsController.initProjectTable();

        }
    );

</script>