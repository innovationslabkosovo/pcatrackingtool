<?php
/* @var $this PcaController */
/* @var $data Pca */
?>

<div class="view">
<div class="table table-condensed table-striped table-bordered table-hover">
   <table>
        <tbody>
            <tr>
                <th>
					<b><?php echo CHtml::encode($data->getAttributeLabel('pca_id')); ?>:</b>
				</th>
                <td>
					<?php echo CHtml::link(CHtml::encode($data->pca_id), array('view', 'id'=>$data->pca_id)); ?>
					<br />
				</td>
			</tr>
			 <tr>
                <th>
					<b><?php echo CHtml::encode($data->getAttributeLabel('number')); ?>:</b>
				</th>
                <td>
					<?php echo CHtml::encode($data->number); ?>
					<br />
			</td>
			</tr>
			 <tr>
                <th>

					<b><?php echo CHtml::encode($data->getAttributeLabel('partner')); ?>:</b>
				</th>
                <td>
					<?php echo CHtml::encode($data->partner->name); ?>
					<br />
				</td>
			</tr>
			 <tr>
                <th>
					<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
				</th>
                <td>
					<?php echo CHtml::encode($data->start_date); ?>
					<br />
				</td>
			</tr>
			<tr>
                <th>
					<b><?php echo CHtml::encode($data->getAttributeLabel('end_date')); ?>:</b>
				</th>
                <td>

					<?php echo CHtml::encode($data->end_date); ?>
					<br />
				</td>
			</tr>
			 <tr>
                <th>
					

					<b><?php echo CHtml::encode($data->getAttributeLabel('assignedActivities')); ?>:</b>
				</th>
                <td>
					<?php echo $data->getRelatedActivities($data->PcaActivity,'name'); ?>
					<br />
				</td>
			</tr>
			 <tr>
                <th>
					<b><?php echo CHtml::encode($data->getAttributeLabel('assignedTargets')); ?>:</b>
				</th>
                <td>
					<?php echo $data->getRelatedActivities($data->PcaTargetProgressRel,'name', array('tpTarget', 'tpTarget')); ?>
					<br />
				</td>
			</tr>
			 <tr>
                <th>
					<b><?php echo CHtml::encode($data->getAttributeLabel('assignedUnits')); ?>:</b>
				</th>
                <td>
					<?php echo $data->getRelatedActivities($data->PcaTargetProgressRel,'type', array('tpUnit', 'tpUnit')); ?>
					<br />
				</td>
			</tr>
			 <tr>
                <th>
					<b><?php echo CHtml::encode($data->getAttributeLabel('assignedProgress')); ?>:</b>
				</th>
                <td>
					<?php echo $data->getRelatedActivities($data->PcaTargetProgressRel,'total'); ?>
					<br />
				</td>
			</tr>
			 <tr>
                <th>
					<b><?php echo CHtml::encode($data->getAttributeLabel('assignedLocations')); ?>:</b>
				</th>
                <td>
					<?php //echo $data->getRelatedActivities($data->PcaLocation, "name"); ?>
					<br />
				</td>
			</tr>
		</tbody>
	</table>


</div>

</div>