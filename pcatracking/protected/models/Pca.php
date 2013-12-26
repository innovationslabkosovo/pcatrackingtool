<?php

/**
 * This is the model class for table "tbl_pca".
 *
 * The followings are the available columns in table 'tbl_pca':
 * @property integer $pca_id
 * @property string $number
 * @property integer $partner_id
 * @property string $start_date
 * @property string $end_date
 * @property string $pba
 *
 * The followings are the available model relations:
 * @property Donor[] $PcaDonor
 * @property Unit[] $tblUnits
 * @property PartnerOrganization $partner
 * @property Activity[] $PcaActivity
 * @property Goal[] $PcaGoal
 * @property Location[] $PcaLocation
 * @property PcaTargetProgress[] $PcaTargetProgress
 */
class Pca extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pca the static model class
	 */
	public $assignedActivities;
	public $assignedGoals;
	public $assignedNonHacs;
	public $assignedTargets;
	public $assignedUnits;
	public $assignedProgress;
	public $PcaTargetProgress;
	public $assignedLocations;
	public $assignedRegions;
	public $assignedLocalities;
	public $assignedGovs;
	public $assignedDonors;
	public $assignedGrants;
	public $assignedFunds;
	public $assignedSectors;
	public $assignedRRPs;
	public $assignedCCCs;
	public $assignedIndicators;
	public $assignedTotals;
	public $assignedCurrents;
	public $assignedShortfalls;
	public $assignedWbs;
	public $assignedIRs;
	public $countModel;
    public $targets_to_delete;
    public $target_progress_to_update ;
    public $pca_target_progress;
	public $pca_cannot_delete_dep = array('tbl_pca_target_progress'=>'PCA Indicator Beneficiaries', 'tbl_pca_report' => 'PCA Report');
	public $pca_file_categories = array( 'proposal'=> 'Proposal' , 'budget' =>'Budget' , 'logframe'=> 'Logframe' , 'pca_addendum' => 'PCA addendum' , 'pca_cover_note' => 'PCA cover note', 'pca_signed' => 'PCA signed','tpm_report'=> 'TPM Report', 'other'=> 'Other' );

	//this variable has the array with PCA relations that need to be exported to Excel
	public $pca_excel_has_many_realations = array(	"PcaTargetProgressRel"=>array(
																		0=>array('total','current','shortfall','name', 'name', 'type'),
																		1=>array(null,null,null,'array("tpTarget","tpTarget","goal")', 'array("tpTarget","tpTarget")','array("tpTarget","tpUnit")')
																		),
													'GwPcaLocRel' => array(0=>array('name'), 1=>array('array("Location")')),
													'PcaGrantRel' => array(0=>array('name','name', 'funds'), 1=>array('array("grant","donor")', 'array("grant")', null)),
																		  );
	public $pca_status = array('in_process'=>'In Process','active'=>'Active','implemented'=>'Implemented','canceled'=>'Canceled');
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function defaultScope()
	{	
		$condition = $this->returnSectorScopes("pca.pca_id IN ( SELECT ps.pca_id from tbl_pca_sector as ps where sector_id IN");
		return array(
			'alias' => 'pca',
            'condition' => $condition,
        );  

	}

	public function behaviors(){
          return array(
            'ESaveRelatedBehavior'=>array(
          		'class'=>'application.extensions.ESaveRelatedBehavior',),
            'dateRangeSearch'=>array(
          		'class'=>'application.components.behaviors.EDateRangeSearchBehavior',)
        
          );
    }
 
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_pca';
	}

	public function primaryKey()
	{
		return 'pca_id';
		# code...
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pca_id' => 'PCA',
			'number' => 'PCA Number',
			'title' => 'PCA Title',
			'partner' => 'Partner Organization',
			'start_date' => 'PCA Start Date',
			'end_date' => 'PCA End Date',
			'pba' => 'PBA',	
			'status' => 'PCA Status',
			'initiation_date' => 'PCA Initiation Date',				

			'unicef_mng_first_name' => 'UNICEF PCA Manager First Name',
			'unicef_mng_last_name' => 'UNICEF PCA Manager Last Name',
			'unicef_mng_email' => 'UNICEF PCA Manager E-mail',
			'partner_mng_first_name' => 'Partner Contact First Name',
			'partner_mng_last_name' => 'Partner Contact Last Name',
			'partner_mng_email' => 'Partner Contact E-mail',

			'unicef_cash_budget' => 'UNICEF Cash Budget',
			'partner_contribution_budget' => 'Partner Contribution Budget',
			'total_cash' => 'Total PCA Budget',

			'assignedSectors'=> 'Sectors',
			'assignedCCCs' => 'CCC',
			'assignedActivities' => 'Activities',
			'assignedRRPs' => 'RRP Outputs',
			'assignedGateways' => 'Gateways',
			'assignedLocations'=> 'Village(s)',
			'assignedRegions'=> 'Kadaa',
			'assignedGovs'=> 'Governorate',
			'assignedLocalities' => 'Locality',
	
			'assignedDonors' =>'Donor',
			'assignedGrants' =>'Grant',
			'assignedFunds' =>'Donor Funds',

 			'assignedIndicators'=> 'Indicator',
			'assignedUnits'=> 'Beneficiary',
			'assignedTotals'=> 'Total Beneficiaries',
			'assignedCurrents'=> 'Served Beneficiaries',
			'assignedShortfalls'=> 'Shortfall of Beneficiaries',

			'assignedWbs' => 'WBS Activities',
			'assignedIRs' => 'Intermediate Result',
			'PcaUFile' =>'Upload Files',
			'PcaSector' => 'Sector',
			'PcaWbs' => 'PCA WBS',
			'PcaGrantRel' => 'PCA Grant',

		);
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	 	 	 	 	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, partner_id, PcaSector, status, initiation_date', 'required'),
			array('partner_id, unicef_cash_budget, partner_contribution_budget, in_kind_amount_budget, cash_for_supply_budget', 'numerical', 'integerOnly'=>true,'min'=>0),
			array('number,title', 'unique'),
			array('number,
				 received_date,
				 is_approved,  
				 start_date, end_date, 
				 signed_by_unicef_date, 
				 signed_by_partner_date, unicef_cash_budget, 
				 partner_contribution_budget, 
				 unicef_mng_first_name,	
				 unicef_mng_last_name,		
				 partner_mng_first_name, 	 	 	 	 	 	
				 partner_mng_last_name, 
				 total_cash, 
				 PcaWbs, GwPcaLocRel, PcaGrantRel,PcaRrp5Output, PcaUFile, PcaTargetProgressRel, PcaActivity' ,'safe'),
			array('partner_mng_email, unicef_mng_email ', 'email' ),
			array('PcaSector','checkPcaSector'),
			//array('PcaTargetProgress','checkPcaTP'),
			array('status','checkImplementedPca'),
            array('targets_to_delete','targetsToDelete'),
            array('unicef_cash_budget','checkUnicefBudget'),
			//array('uploadedFile', 'file', 'types'=>'jpg, gif, png, doc, pdf, odt'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pca_id,
					 number,
					 title,
					 partner, 
					 start_date, 
					 end_date, 
					 status, 
					 initiation_date, 
					 partner_contribution_budget, 
					 unicef_cash_budget, 
					 total_cash, 
					 assignedSectors, 
					 assignedRRPs, 
					 assignedCCCs, 
					 assignedIndicators, 
					 assignedTotals,
					 assignedCurrents,
					 assignedShortfalls,
					 assignedActivities,
					 assignedWbs,
					 assignedIRs,
					 assignedFunds,
					 assignedDonors,
					 assignedGrants,
					 assignedGovs,
					 assignedLocalities,
					 assignedRegions, 
					 assignedLocations, 
					 assignedUnits', 'safe', 'on'=>'search'),
		);
	}	

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'PcaDonor' => array(self::MANY_MANY, 'Donor', 'tbl_donor_pca(pca_id, donor_id)'),
			//'nonHacProgessesRel' => array(self::HAS_MANY, 'NonHacTarget', 'pca_id'),
			'PcaSector' => array(self::MANY_MANY, 'Sector', 'tbl_pca_sector(pca_id, sector_id)'),
			'PcaTargetProgressRel' => array(self::HAS_MANY, 'PcaTargetProgress', 'pca_id'),
			'partner' => array(self::BELONGS_TO, 'PartnerOrganization', 'partner_id'),
			'PcaActivity' => array(self::MANY_MANY, 'Activity', 'tbl_pca_activity(pca_id, activity_id)'),
			'PcaRrp5Output' => array(self::MANY_MANY, 'Rrp5Output', 'tbl_pca_rrp5output(pca_id, rrp5_output_id)'),
			'PcaWbs' => array(self::MANY_MANY, 'Wbs', 'tbl_pca_wbs(pca_id, wbs_id)'),
			'PcaGrantRel' => array(self::HAS_MANY, 'PcaGrant', 'pca_id'),
			'GwPcaLocRel' => array(self::HAS_MANY, 'GwPcaLoc', 'pca_id'),
			//'PcaUFile' => array(self::MANY_MANY, 'UploadedFile', 'tbl_pca_ufile(pca_id, file_id)'),
            'PcaFile' => array(self::HAS_MANY, 'PcaFile', 'pca_id'),
            'PcaUserActionRel' => array(self::HAS_MANY, 'PcaUserAction', 'pca_id'),
			//'PcaGoal' => array(self::MANY_MANY, 'Goal', 'tbl_pca_goal(pca_id, goal_id)'),
			//'PcaLocation' => array(self::MANY_MANY, 'Location', 'tbl_pca_location(pca_id, location_id)'),
			
						
		);
	}

	public function checkPcaSector($attribute,$params)
	{
		if ($this->PcaSector[0] == NULL)
		{
			$this->addError($attribute,'Sector cannot be blank');	
		}
	}

	public function checkImplementedPca($attribute,$params)
	{
        $error = 0;
		if($this->status == "implemented")
			{
				//$this->transpose($model->PcaTargetProgressRel, $tp);
				//print_r($tp);
				$targets = "";
				foreach ($this->PcaTargetProgressRel as $key => $value) {
					//echo 1;
					$this->transpose($this->PcaTargetProgressRel[$key],$out);	
					
					if ($out['shortfall'] >0)
					{
                        $error = 1;
						$existing_target = Target::model()->findByPK($out->tpTarget['target_id']);
						$existing_unit = Unit::model()->findByPK($out->tpTarget['unit_id']);
						$targets .=  "<br/>- ".$existing_target->name." - shortfall of ".$out['shortfall']." ".$existing_unit->type;
						
					}
				}
                if($error == 1)
				$this->addError($attribute, "PCA status cannot be set to implemented. The following indicators do not have targets completed".$targets);

			}
	}

//	public function checkPcaTP($attribute,$params)
//	{
//			$out = array();
//			foreach ((array)$this->PcaTargetProgressRel as $key => $value) {
//				$this->transpose($this->PcaTargetProgressRel[$key],$out);
//				$targetNo = $key+1;
//				//print_r($out);
//				$target_id = $out['target_id'];
//				$unit_id = $out['unit_id'];
//				$total = $out['total'];
//				$existingTargetProgress = TargetProgress::model()->findAll( "target_id = $target_id  AND unit_id = $unit_id  AND current = 1");// find existing target
//				if ($total > $existingTargetProgress[0]['shortfall']){
//					$this->addError($attribute,'Pca Target '.$targetNo.' cannot be larger than overall Target Progress');
//				}
//			}			# code...
//
//	}

	public function checkUnicefBudget($attribute,$params)
	{
		if (($this->in_kind_amount_budget + $this->cash_for_supply_budget) > $this->unicef_cash_budget) 
			$this->addError($attribute,'UNICEF Cash must be equal to or higher than  In Kind Amount + Cash for Supply ');	
		
	}

    public function targetsToDelete($attribute,$params)
    {
        if ($this->targets_to_delete != NULL)
        {
            //echo 2;
           // $target_progress_to_update = $this->PcaTargetProgressRel;
            $targets_array = explode(",", $this->targets_to_delete);
            foreach ($targets_array as $current_target)
            {
                $target_progress_model = TargetProgress::model()->findAll("target_id IN ($current_target)");
                foreach ($target_progress_model as $tp_key=>$tp_value)
                {
                    if ($pca_target_model = PcaTargetProgress::model()->find("target_progress_id=".$tp_value['target_progress_id']." AND pca_id = $this->pca_id"))
                    {
                            if ($pca_target_model->current > 0)
                            {
                                $this->addError($attribute,'Indicator "'.$pca_target_model->tpTarget->tpTarget['name'].'" cannot be deleted due to its current indicator beneficiaries');
                            }
                            else
                            {
                                $this->target_progress_to_update[$tp_key] = array('target_progress_id'=>$pca_target_model->target_progress_id,'total'=>$pca_target_model->total,'dif_total'=> -$pca_target_model->total, 'start_date'=> $pca_target_model->start_date);
                            }

                    }

                }

            }


        }


    }

	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

  		//$this->unsetAttributes();
		$criteria=new CDbCriteria;

		$criteria->compare('pca.pca_id',$this->pca_id);
		$criteria->compare('pca.number',$this->number,true);
		$criteria->compare('partner.name',$this->partner,true);
		//$criteria->compare('start_date',$this->start_date,true);
		//$criteria->addBetweenCondition('start_date', $this->start_date[0], $this->start_date[1], 'AND');
		//$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('title',$this->title,true);
		//$criteria->compare('initiation_date',$this->initiation_date,true);
		$criteria->compare('partner_contribution_budget',$this->partner_contribution_budget);
		$criteria->compare('unicef_cash_budget',$this->unicef_cash_budget);
		$criteria->compare('status',$this->status);

		//$criteria->compare('pba',$this->pba,true);
		//$units = Unit::model()->find("type LIKE '%$this->assignedUnits%'");
		//echo $this->assignedUnits;
		$criteria->compare('PcaActivity.name',$this->assignedActivities,true);

		$criteria->compare('tbl_pca_target_progress.total',$this->assignedTotals);
		$criteria->compare('tbl_pca_target_progress.current',$this->assignedCurrents);
		$criteria->compare('tbl_pca_target_progress.shortfall',$this->assignedShortfalls);
		//$criteria->compare('PcaRrp5Output.name',$this->assignedLocations,true);

		$criteria->compare('sector.name',$this->assignedSectors,true);
		$criteria->compare('PcaRrp5Output.name',$this->assignedRRPs,true);
		$criteria->compare('goal.name',$this->assignedCCCs,true);
		$criteria->compare('target.name',$this->assignedIndicators,true);

		$criteria->compare('tbl_wbs.name',$this->assignedWbs,true);
		$criteria->compare('IntermediateResult.name',$this->assignedIRs,true);


		$criteria->compare('Location.name',$this->assignedLocations,true);
		$criteria->compare('locality.name',$this->assignedLocalities,true);
		$criteria->compare('region.name',$this->assignedRegions,true);
		$criteria->compare('governorate.name',$this->assignedGovs,true);


		$criteria->compare('PcaGrantRel.funds',$this->assignedFunds);
		$criteria->compare('grant.name',$this->assignedGrants,true);
		$criteria->compare('donor.name',$this->assignedDonors,true);
		//$criteria->compare('unit.type',$this->assignedUnits,true);


		$criteria->mergeWith($this->dateRangeSearchCriteria('start_date', $this->start_date));
		$criteria->mergeWith($this->dateRangeSearchCriteria('end_date', $this->end_date));
		$criteria->mergeWith($this->dateRangeSearchCriteria('initiation_date', $this->initiation_date));
		//$criteria->mergeWith($this->dateRangeSearchCriteria('start_date', $this->start_date), $this->dateRangeSearchCriteria('end_date', $this->end_date), $this->dateRangeSearchCriteria('initiation_date', $this->initiation_date));
		//$criteria->compare('PcaGoal.name',$this->assignedGoals,true);
		$criteria->with = array('PcaActivity', 'partner', 'PcaTargetProgressRel.tpTarget.tpTarget.goal', 'PcaRrp5Output', 'PcaSector', 'PcaWbs.IntermediateResult', 'GwPcaLocRel.Location.locality.region.governorate', 'PcaGrantRel.grant.donor' );

  		$criteria->group = 'pca.pca_id';
	    $criteria->together = true;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,

		));
	}

	protected function beforeSave()
	{

		$this->start_date=date('Y-m-d', strtotime($this->start_date));
		$this->end_date=date('Y-m-d', strtotime($this->end_date));
		$this->initiation_date=date('Y-m-d', strtotime($this->initiation_date));
		$this->signed_by_unicef_date=date('Y-m-d', strtotime($this->signed_by_unicef_date));
		$this->signed_by_partner_date=date('Y-m-d', strtotime($this->signed_by_partner_date));



		return parent::beforeSave();
	}

	protected function afterFind()
	{
		if (!empty($this->start_date)) $this->start_date=date('d-m-Y', strtotime($this->start_date));
		if (!empty($this->end_date)) $this->end_date=date('d-m-Y', strtotime($this->end_date));
		if (!empty($this->initiation_date)) $this->initiation_date=date('d-m-Y', strtotime($this->initiation_date));
		if (!empty($this->signed_by_unicef_date)) $this->signed_by_unicef_date=date('d-m-Y', strtotime($this->signed_by_unicef_date));
		if (!empty($this->signed_by_partner_date)) $this->signed_by_partner_date=date('d-m-Y', strtotime($this->signed_by_partner_date));

		return TRUE;
	}
}