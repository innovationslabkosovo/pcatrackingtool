<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

//	public $dateTimeNow =  // parent date time variable - accessible in every controller


    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    // update/add Target Progress Model; $model-> model to be updated/added, $totalTarget->array of target progress data, $status-> 1=create 0=update.

    public function updateTargetProgress($model, $totalTarget, $new_indicator)
    {
        $updateTarget = $model::model();
        //$newTarget = new $model;
        $return = 1;
        $targetProgressModel = array();

        foreach ($totalTarget as $key => $value) {


            if ($totalTarget[$key]['total'] == NULL)
                continue;

            $target_progress_id = $totalTarget[$key]['target_progress_id'];
            $received_date = $totalTarget[$key]['received_date'];
            $start_date = $totalTarget[$key]['start_date'];
            $pca_total = $totalTarget[$key]['total'];

            // set total to difference between new and existing target
            if (!empty($totalTarget[$key]['dif_total']))
            {
                if ($totalTarget[$key]['dif_total'] != 0)
                    $pca_total = $totalTarget[$key]['dif_total'];

            }

            // get existing Target Progress
            $existingTargetProgress = $updateTarget->findByPk($target_progress_id); // find existing target progress

            $existingTargetProgress->current = $existingTargetProgress->current + $pca_total;
            $existingTargetProgress->shortfall = $existingTargetProgress->shortfall - $pca_total;

            // save updated model
            if (!$existingTargetProgress->save())
                $return = 0;



            //  echo "target-received-date".$target_received_date ;
            //    echo "<br/>";

            //$date = date("Y-m-d H:i:s");

            //check if pca is being updated
//            if (!$new_indicator && $totalTarget[$key]['is_new'] == 0) {
//                $current = $existingTargetProgress[0]['current'] + $totalTarget[$key]['dif_total'];
//                $shortfall = $total - $current;
//                $updateFields = array('active' => 1, 'current' => $current, 'shortfall' => $shortfall, 'received_date' => $received_date);
//            } else $updateFields = array('active' => 0, 'received_date' => $received_date);

            // update exisitng target; if new pca is added, set exisitng target to inactive; if pca is updated, modify exisitng target
//            $update_fields = array('target_id' => $target_id, 'unit_id' => $unit_id, 'current' => $existingTargetProgress[0]['current'], 'active' => 1, 'received_date' => $target_received_date), $updateFields);
//            if ($updateTarget->updateByPk())
//            {
//
//            }

            // create new Target Progress
//            if (!$new_indicator && $totalTarget[$key]['is_new'] == 0) continue;
//            $targetProgressModel[$key] = new $model; //create new active target.
//            $targetProgressModel[$key]->attributes = array('target_id' => $target_id, 'unit_id' => $unit_id ['unit_id'], 'total' => $total, 'current' => $current, 'shortfall' => $shortfall, 'received_date' => $value['received_date'], 'active' => 1);
//
//            // save new Target Progress.
//            if (!$targetProgressModel[$key]->save())
//                $return = 0;

        }

        return $return;
    }

    public function updatePcaTargetProgress($model, $totalTarget)
    {
        $updateTarget = $model::model();
        $newTarget = new $model;
        $return = 1;
        $targetProgressModel = array();


        foreach ($totalTarget as $key => $value) {

            if ($totalTarget[$key]['total'] == NULL)
                continue;
            $pca_target_progress_id = $totalTarget[$key]['pca_target_progress_id'];
            $pca_report_total = $totalTarget[$key]['total'];
            // get existing Target Progress
            $existingTargetProgress = $updateTarget->findByPk($pca_target_progress_id); // find existing target



            $existingTargetProgress->current = $existingTargetProgress->current + $pca_report_total;
            $existingTargetProgress->shortfall = $existingTargetProgress->shortfall - $pca_report_total;

            // save updated model
            if (!$existingTargetProgress->save())
                $return = 0;



//            $total = $existingTargetProgress[0]['total'];
//            $date = date("Y-m-d H:i:s");
//            $current = $existingTargetProgress[0]['current'] + $totalTarget[$key]['total'];
//            $shortfall = $total - $current;
//
//
//            $updateFields = array('active' => 0);
//
//            $updateTarget->updateByPk(array('target_id' => $target_id, 'unit_id' => $unit_id, 'pca_id' => $pca_id, 'current' => $existingTargetProgress[0]['current'], 'received_date' => $existingTargetProgress[0]['received_date']), $updateFields); // set existing target to inactive
//
//            // create new Target Progress
//
//            $targetProgressModel[$key] = new $model; //create new active target.
//            $targetProgressModel[$key]->attributes = array('target_id' => $totalTarget[$key]['target_id'], 'unit_id' => $totalTarget[$key]['unit_id'], 'pca_id' => $pca_id, 'total' => $total, 'current' => $current, 'shortfall' => $shortfall, 'received_date' => $date, 'active' => 1);
//
//            // save new Target Progress.
//            if (!$targetProgressModel[$key]->save())
//                $return = 0;

        }
        //$this->updateTargetProgress(TargetProgress, $totalTarget, 1);
        return $return;
    }

    public function manageRelations($postProgress, $status, $start_date)
    {

        if ($postProgress['total'] != NULL) {
            $this->transpose($postProgress, $out);

            $i = 0; // blank target fields
            $j = 0; // total target fields

            foreach ($out as $key => $value) {

                // set shortfall
                if (!isset($out[$key]['current'])) $out[$key]['current'] = 0;
                $out[$key]['shortfall'] = $out[$key]['total'] - $out[$key]['current'];

                // set start date
                if (isset($start_date))
                    $out[$key]['start_date'] = $start_date;

                // check for existing total
                if(empty($out[$key]['existing_total']))
                    $out[$key]['existing_total'] = 0;

                // set difference between existing and updated target beneficiaries
                if (isset($out[$key]['is_new']) && $out[$key]['total'] != $out[$key]['existing_total']) {
                    if ($out[$key]['is_new'] == 0) {
                        $out[$key]['dif_total'] = $out[$key]['total'] - $out[$key]['existing_total'];
                    }
                }
                // check for blank fields, if true remove target from array
                // if ($out[$key]['total'] == 0){
                if (isset($out[$key]['total']) && $out[$key]['total'] == 0) {
                    unset($out[$key]);

                    $i++;
                }
                $j++;
            }

            // if each total field is blank do not return anything; otherwise return formatted target beneficiary array
            if ($j != $i) {
                return $out;
            }
        }

    }

    public function getRelatedModels($modelRelation, $fields)
    {

        for ($i = 0; $i < sizeof($modelRelation); $i++) {
            foreach ($fields as $key => $value) {
                $result[$i][$value] = $modelRelation[$i][$value];
            }
        }
        return $result;
    }

    // get permissions for model actions
    public function getAccessLevels($action)
    {
        $users = array('');
        $current_user = Yii::app()->user;
        //print_r($current_user->getId());
        if ($current_user->getId()) {
            if (YumUser::model()->find('id =' . $current_user->id)->can($action)) {
//                print_r($action);
//                exit;
                $users[] = $current_user->username;
            }


        }
        # code...

        return $users;
    }

    // get superusers
    public function getSuperUsers()
    {
        $users = array();
        $superusers = YumUser::model()->findAll('superuser = 1');
        foreach ((array)$superusers as $key => $value) {
            array_push($users, $value['username']);
        }
        return $users;

    }


    public function transpose($array, &$out, $indices = array())
    {

        if (is_array($array)) {
            foreach ($array as $key => $val) { //push onto the stack of indices
                $temp = $indices;
                $temp[] = $key;
                $this->transpose($val, $out, $temp);
            }
        } else { //go through the stack in reverse - make the new array
            $ref = & $out;
            foreach (array_reverse($indices) as $idx)
                $ref =& $ref[$idx];
            $ref = $array;
        }
    }


    /*
    This function is used to return an array of arrays for a model whose attributes and relations should be exported to Excel
    It receives a parameter with the model to export, the attributes of the model that must not be exported,
    the relations that must not be exported and the attributes of the (rest of) relations that must be exported
    Returns an array columns_to_display which is than passed to the function for exporting model to excel
    */
    public function getColumnstoDisplay($model, $relation_attributes_to_include = null, $attributes_to_remove = null, $relations_to_remove = null)
    {


        //This is to loop through each row of the model
        foreach ($model as $key => $value) {

            $current_model = $value;

            //Get model relations
            $current_relations = $current_model->relations();

            //and unset the ones that should be removed
            foreach ((array)$relations_to_remove as $to_remove_key => $to_remove_value) {
                unset($current_relations[$to_remove_value]);

            }

            //we need this counter for the array that will be returned with list of columns and values to be exported
            $i = 0;

            //if we have set a few model attributes to remove
            //find which ones
            if ($attributes_to_remove != null) {
                $columns_to_display = array();
                foreach ($current_model->attributes as $key => $value) {
                    //and don't include them
                    if (in_array($key, $attributes_to_remove)) continue;
                    //otherwise include them in the array of columns to display and advance the counter
                    $columns_to_display[$i] = $key;
                    $i++;
                }
            } elseif ($attributes_to_remove == null) {
                $columns_to_display = array();
                //if no attributes should be removed
                //get them all and put them in array
                foreach ($current_model->attributes as $key => $value) {
                    $columns_to_display[$i] = $key;
                    $i++;
                }
            }


            //get all model relations
            foreach ($current_relations as $key => $relation) {

                //we need some extra steps for getting values of Has Many Relations
                //due to cgridview limitations
                //multiple values need to be part of one field/cell
                if ($relation[0] == "CHasManyRelation") {
                    //get the current relation attributes that need to be included
                    $this_has_many = $relation_attributes_to_include[$key];

                    //and for each of them
                    foreach ($this_has_many[0] as $key_1 => $value_1) {

                        //if the attribute is empty set the value to empty
                        if ($this_has_many[1][$key_1] == null)
                            $links_column = "";
                        //otherwise get its value
                        else $links_column = ', ' . $this_has_many[1][$key_1];

                        //now start to enter them in the columns_to_display variable
                        //header should be a conncatenation of the relation and current attribute
                        $columns_to_display[$i] = array(
                            'header' => ucfirst($relation[1] . ' ' . $value_1),
                            'name' => $key,
                            'value' => '$data->getRelatedActivities($data->' . $key . ',"' . $this_has_many[0][$key_1] . ';"' . $links_column . ')',);
                        //value should be retrieved with the getrelatedactivities function for the current model with it's relation and the attributes
                        $i++;
                    }
                    continue;

                } //for many many relations we use getrelatedactivities with data and model and we get the "name" attribute by default
                else if ($relation[0] == "CManyManyRelation") {
                    $columns_to_display[$i] = array(
                        'name' => $key,
                        'value' => '$data->getRelatedActivities($data->' . $key . ', "name;")',
                    );

                } //for belongs to relations we use data and model and we get the "name" attribute by default
                else if ($relation[0] == "CBelongsToRelation") {
                    $columns_to_display[$i] = array(
                        'name' => $key,
                        'value' => '$data->' . $key . '->name',
                    );

                }
                $i++;
            }


        }
        //print_r($columns_to_display);
        return $columns_to_display;
    }

//    public function updateTargetProgress ($model, $totalTarget, $new_indicator)
//    {
//        $updateTarget = $model::model();
//        //$newTarget = new $model;
//        $return = 1;
//        $targetProgressModel = array();
//
//        foreach ($totalTarget as $key => $value) {
//
//
//            if ($totalTarget[$key]['total'] == NULL)
//                continue;
//            $target_id = $totalTarget[$key]['target_id'];
//            $unit_id = $totalTarget[$key]['unit_id'];
//            $received_date = $totalTarget[$key]['received_date'];
//            //echo "received-date".$received_date ;
//            //  echo "<br/>";
//            // get existing Target Progress
//            $existingTargetProgress = $updateTarget->findAll( "target_id = $target_id  AND unit_id = $unit_id  AND active = 1");// find existing target
//
//
//            $total = $existingTargetProgress[0]['total'];
//            $current = $existingTargetProgress[0]['current'] + $totalTarget[$key]['total'];
//            $shortfall = $existingTargetProgress[0]['shortfall'] - $totalTarget[$key]['total'];
//            $target_received_date = $existingTargetProgress[0]['received_date'];
//            //  echo "target-received-date".$target_received_date ;
//            //    echo "<br/>";
//
//            //$date = date("Y-m-d H:i:s");
//
//            //check if pca is being updated
//            if (!$new_indicator && $totalTarget[$key]['is_new'] == 0)
//            {
//                $current = $existingTargetProgress[0]['current'] + $totalTarget[$key]['dif_total'];
//                $shortfall = $total - $current;
//                $updateFields = array('active' => 1,'current'=>$current,'shortfall'=>$shortfall,'received_date'=>$received_date);
//            }
//            else $updateFields = array('active' => 0, 'received_date'=>$received_date);
//
//            // update exisitng target; if new pca is added, set exisitng target to inactive; if pca is updated, modify exisitng target
//            $updateTarget->updateByPk(array('target_id'=>$target_id, 'unit_id'=>$unit_id, 'current'=>$existingTargetProgress[0]['current'], 'active'=>1, 'received_date'=>$target_received_date),$updateFields); // set existing target to inactive
//
//            // create new Target Progress
//            if (!$new_indicator && $totalTarget[$key]['is_new'] == 0) continue;
//            $targetProgressModel[$key] = new $model; //create new active target.
//            $targetProgressModel[$key]->attributes = array('target_id' =>$target_id,'unit_id' => $unit_id ['unit_id'],'total' => $total,'current' => $current,'shortfall' => $shortfall,'received_date'=>  $value['received_date'],'active'=>1);
//
//            // save new Target Progress.
//            if (!$targetProgressModel[$key]->save())
//                $return = 0;
//
//        }
//
//        return $return;
//    }

}