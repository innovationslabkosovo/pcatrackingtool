<?

Yii::import('application.modules.user.controllers.YumController');
Yii::import('application.modules.user.models.*');
Yii::import('application.modules.role.models.*');

class YumPermissionController extends YumController
{
	public $defaultAction = 'admin';
	public $onloadFunction="$('#YumPermission_type_0').trigger('click');";
	public function accessRules()
	{
		return array(
				array('allow',
					'actions'=>array('admin', 'create', 'index', 'delete','disableAssigendActions'),
					'expression' => 'Yii::app()->user->isAdmin()',
					),
				array('deny',  // deny all other users
					'users'=>array('*'),
					),
				);
	}

	public function actionIndex() {
		$this->render('view', array(
					'actions' => YumAction::model()->findAll()));
	}

	public function actionDelete() {
		$permission = YumPermission::model()->findByPk($_GET['id']);
		if($permission->delete())
			Yum::setFlash(Yum::t('The permission has been removed'));
		else
			Yum::setFlash(Yum::t('Error while removing the permission'));
	
		$this->redirect(array('//role/permission/admin')); 
	}

	public function actionAdmin()
	{
		$this->layout = Yum::module('role')->layout;
		$model=new YumPermission('search');
		$model->unsetAttributes();  

		if(isset($_GET['YumPermission']))
			$model->attributes=$_GET['YumPermission'];

		$this->render('admin',array(
					'model'=>$model,
					));
	}

	public function actionCreate() {
		$this->layout = Yum::module()->adminLayout;
		$model = new YumPermission;
		$flag = 1;
		$this->performAjaxValidation($model, 'permission-create-form');
		
		if(isset($_POST['YumPermission'] )) {
			$model->attributes=$_POST['YumPermission'];
			if ($model->validate())	
			{
				// save permissions for each acntion
				foreach ($_POST['YumPermission']['action'] as $key => $value ) {
					$newmodel[$key] = new YumPermission;
					$newmodel[$key]->attributes=$_POST['YumPermission'];	
				
							

						$newmodel[$key]->action = $value;
						
						if($_POST['YumPermission']['type'] == 'user')  {
						$newmodel[$key]->subordinate = $_POST['YumPermission']['subordinate_id'];
						$newmodel[$key]->principal = $_POST['YumPermission']['principal_id'];

						} else if($_POST['YumPermission']['type'] == 'role')  {
							$newmodel[$key]->subordinate_role = $_POST['YumPermission']['subordinate_id'];
							$newmodel[$key]->principal_role = $_POST['YumPermission']['principal_id'];
						}
						
						//print_r($newmodel[$key]->attributes);
						if ($newmodel[$key]->save()) continue;					
					
					
				}
			}else $flag = 0;
			if ($flag)
					$this->redirect(array('admin'));
				//return;
		}
		$model->type = 'user'; // preselect 'user'
		$this->render('create',array('model'=>$model));

	}

	public function actionDisableAssigendActions ()
	{
		$user_type = $_POST['user_type'];
		$principal_id = $_POST['principal_id'];
		// switch ($user_type) {
		// 	case 'user': $allActions = CHtml::listData(YumUser::model()->findAll(), 'id', 'username');
		// 	case 'role': $allActions =  YumRole::model()->findAll();			
		// 	default:
		// 		# code...
		// 		break;
		// }
		$allActions = CHtml::listData(YumAction::model()->findAll(), 'id', 'title');
	
		$assignedActions = YumPermission::model()->findAll("principal_id = $principal_id AND type = '$user_type'");
		foreach ($assignedActions as $key => $value) {
			unset($allActions[$value->Action->id]);			
		}
		foreach($allActions as $value=>$name)
		    {
		        echo CHtml::tag('option',
		                   array('value'=>$value),CHtml::encode($name),true);
		    }
		

	}

}
