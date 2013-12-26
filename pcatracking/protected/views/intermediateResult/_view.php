<?php
/* @var $this IntermediateResultController */
/* @var $data IntermediateResult */
?>

<div class="view">
<div class="table table-condensed table-striped table-bordered table-hover">
   <table>
        <tbody>
            <tr>
                <th>
					<b><?//php echo CHtml::encode($data->getAttributeLabel('ir_id')); ?></b>
				</th>
                <td>
					<?//php echo CHtml::link(CHtml::encode($data->ir_id), array('view', 'id'=>$data->ir_id)); ?>
					<br />
				</td>
			</tr>
			 <tr>
                <th>

					<b><?php echo CHtml::encode($data->getAttributeLabel('sector_id')); ?>:</b>
					</th>
                <td>
					<?php echo CHtml::encode($data->sector->name); ?>
					<br />
				</td>
			</tr>
			 <tr>
                <th>

					<b><?php echo CHtml::encode($data->getAttributeLabel('ir_wbs_reference')); ?>:</b>
				</th>
                <td>
					<?php echo CHtml::encode($data->ir_wbs_reference); ?>
					<br />
				</td>
			</tr>
			 <tr>
                <th>
					<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
				</th>
                <td>
					<?php echo CHtml::encode($data->name); ?>
					<br />
				</td>
			</tr>
		</tbody>
	</table>


</div>


</div>