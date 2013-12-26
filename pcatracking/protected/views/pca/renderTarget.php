
	<?php
	
	//print_r($data);
			foreach ($totals as $key => $value) {
				echo '<div id="target_progress_'.$target_progress_ids[$key].'">';
				// $target_shortfallInput = $data['target_shortfall'][$key] + $value;
				echo CHtml::tag('input',
			                   array('type'=>'number', 'id'=> 'total_unit_input' ,  'class'=>'total_unit_input', 'min'=>0 , 'value'=>$value,'name'=>'Pca[PcaTargetProgressRel][total][]'),'<span>'.$unit_types[$key].'<span class="hint"> ------  Indicator Shorfall: '.$target_shortfall[$key] .'* </span></span></br>');
//				echo CHtml::tag('input',
//			                   array('type'=>'hidden', 'id'=> 'hidden_unit_id' , 'value'=>$unit_ids[$key],'name'=>'Pca[PcaTargetProgressRel][unit_id][]'));
                echo CHtml::tag('input',
                               array('type'=>'hidden', 'id'=> 'hidden_target_progress_id' , 'value'=>$target_progress_ids[$key],'name'=>'Pca[PcaTargetProgressRel][target_progress_id][]'));
//				echo CHtml::tag('input',
//			                   array('type'=>'hidden', 'id'=> 'hidden_target_id' , 'value'=>$target_ids,'name'=>'Pca[PcaTargetProgressRel][target_id][]'));
				echo CHtml::tag('input',
			                   array('type'=>'hidden', 'id'=> 'hidden_target_shortfall' , 'value'=>$target_shortfall[$key],'name'=>'Pca[PcaTargetProgressRel][target_shortfall][]'));
//				echo CHtml::tag('input',
//			                   array('type'=>'hidden', 'id'=> 'hidden_active' , 'value'=>1,'name'=>'Pca[PcaTargetProgressRel][active][]'));
				echo CHtml::tag('input',
			                   array('type'=>'hidden', 'id'=> 'hidden_current' , 'value'=>$pca_current[$key],'name'=>'Pca[PcaTargetProgressRel][current][]'));
				echo CHtml::tag('input',
			                   array('type'=>'hidden', 'id'=> 'hidden_existing_total' , 'value'=>$value,'name'=>'Pca[PcaTargetProgressRel][existing_total][]'));
                echo CHtml::tag('input',
                    array('type'=>'hidden','value'=> date("Y-m-d H:i:s"),'name'=>'Pca[PcaTargetProgressRel][received_date][]'));
                echo CHtml::tag('input',
                    array('type'=>'hidden','id'=> 'hidden_is_new', 'value'=>0,'name'=>'Pca[PcaTargetProgressRel][is_new][]'));
				echo '</div>';
			}
			
		

