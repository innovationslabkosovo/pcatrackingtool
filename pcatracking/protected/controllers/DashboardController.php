<?php

class DashboardController extends Controller
{

	/**
	 * This is the default 'index' action that displays
	 * the Dashboard view
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
    $this->layout = 'dashboard';
		$this->render('index');
	}

}