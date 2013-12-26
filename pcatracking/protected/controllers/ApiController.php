<?php

class ApiController extends Controller {

  /**
   * @return array action filters
   */
  public function filters() {
    return array();
  }

  /**
   * API version 1
   *
   * Parses path and returns appropriate data as
   * a JSON object.
   *
   * [domain]/pcatracking/api/v1/sectors returns all Sector model instances
   * [domain]/pcatracking/api/v1/sector/id returns individual Sector instances, if found
   */
  public function actionv1() {

    // split path
    $path = explode('/',$_GET['path']);
    $http_status = 200;
    switch($path[0]) {

      /**
      * If first element is 'sectors', then return all sector model items.
      */
      case 'sectors':

        // get all sectors from db
        $sectors = Yii::app()->db->createCommand('select * from tbl_sector')->queryAll();

        // otherwise start composing return object
        $return_object;

        // connect and prepare statement
        $connection = Yii::app()->db;
        $sql = "select * from tbl_goal where sector_id=:sector_id;";
        $query = $connection->createCommand($sql);

        // loop through sectors and get associated goals
        foreach ($sectors as $sector) {

          // create temporary object for storing data
          $a = new stdClass();
          $a->sector_id = $sector['sector_id'];
          $a->name = $sector['name'];
          $a->description = $sector['description'];

          // get associated goals
          $query->bindParam(":sector_id", $sector['sector_id'], PDO::PARAM_STR);
          $goals = $query->queryAll();
          // add goals to returnable item
          $a->goals = $goals;

          // add newly created sector node to return_object
          $return_object[] = $a;
        }
        break;


      /**
      * If first element is 'gateways', then return all gateway model items.
      */
      case 'gateways':

        // get all sectors from db
        $return_object = Yii::app()->db->createCommand('select * from tbl_gateway')->queryAll();

        break;

      /**
      * If first element is 'rrp5_outputs', then return all rrp5_output model items.
      */
      case 'rrp5_outputs':

        // get all sectors from db
        $return_object = Yii::app()->db->createCommand('select * from tbl_rrp5_output')->queryAll();

        break;


      /**
      * If first element is 'units', then return all unit model items.
      */
      case 'units':

        // get all sectors from db
        $return_object = Yii::app()->db->createCommand('select * from tbl_unit')->queryAll();

        break;


      /**
      * If first element is 'targets', then return all target model items.
      */
      case 'targets':

        // get all sectors from db
        $sql = "
          select
            a.name,
            c.sector_id,
            b.goal_id,
            a.target_id
          from
            tbl_target a,
            tbl_goal b,
            tbl_sector c
          where
            a.goal_id=b.goal_id and
            b.sector_id=c.sector_id;
        ";
        $return_object = Yii::app()->db->createCommand($sql)->queryAll();

        break;


      /**
      * If first element is 'partner_organizations', then return all partner_organizations model items.
      */
      case 'partner_organizations':

        // get all sectors from db
        $return_object = Yii::app()->db->createCommand('select * from tbl_partner_organization')->queryAll();

        break;


      /**
      * If first element is 'sector', then we should look at the second item
      * as it should be sector id. If found, fetch all associated goals and return.
      */
      case 'sector':

        if (count($path) > 1) {
          $id = $path[1];
          $connection = Yii::app()->db;
          $sql = "select * from tbl_sector where sector_id=:sector_id;";
          $query = $connection->createCommand($sql);
          $query->bindParam(":sector_id",$id,PDO::PARAM_STR);
          $sector = $query->queryRow();

          // if sector could not be found with assigned id
          if ($sector == null) {
            $http_status = 404;
            $return_object = new stdClass();
            $return_object->error_msg = "could not find sector with assigned id!";
            break;
          }

          // otherwise start composing return object
          $return_object = new stdClass();
          $return_object->sector_id = $sector['sector_id'];
          $return_object->name = $sector['name'];
          $return_object->description = $sector['description'];

          // get associated goals
          $sql = "select * from tbl_goal where sector_id=:sector_id;";
          $query = $connection->createCommand($sql);
          $query->bindParam(":sector_id",$id,PDO::PARAM_STR);
          $goals = $query->queryAll();
          $return_object->goals = $goals;

        } else {

          // sector id was not specified in API call
          $http_status = 404;
          $return_object = new stdClass();
          $return_object->error_msg = "sector id missing!";
        }
        break;

      /**
      * If first element is 'goal', then find goal info on the basis of
      * the second element, which should be goal_id
      */
      case 'goal':

        if (count($path) > 1) {
          $id = $path[1];
          $connection = Yii::app()->db;
          $sql = "select * from tbl_goal where goal_id=:goal_id;";
          $query = $connection->createCommand($sql);
          $query->bindParam(":goal_id",$id,PDO::PARAM_STR);
          $goal = $query->queryRow();

          // if goal could not be found with assigned id
          if ($goal == null) {
            $http_status = 404;
            $return_object = new stdClass();
            $return_object->error_msg = "could not find goal with assigned id!";
            break;
          }

          // otherwise start composing return object
          $return_object = new stdClass();
          $return_object->goal_id = $goal['goal_id'];
          $return_object->sector_id = $goal['sector_id'];
          $return_object->name = $goal['name'];
          $return_object->description = $goal['description'];

          // get associated targets
          $sql = "
            select
              a.target_id as target_id,
              a.goal_id as goal_id,
              a.name as name,
              b.total as total,
              b.current as current,
              c.type as unit_type,
              c.unit_id as unit_id
            from
              tbl_target a,
              tbl_target_progress b,
              tbl_unit c
            where
              a.target_id=b.target_id and
              b.unit_id=c.unit_id and
              a.goal_id=:goal_id
            order by
              a.target_id;
          ";
          $query = $connection->createCommand($sql);
          $query->bindParam(":goal_id",$id,PDO::PARAM_STR);
          $targets = $query->queryAll();
          $return_object->targets = $targets;

        } else {

          // sector id was not specified in API call
          $http_status = 404;
          $return_object = new stdClass();
          $return_object->error_msg = "goal id missing!";
        }
        break;

      /**
      * If first element is 'target', then find target info on the basis of
      * the second element, which should be target_id. Please note, that the
      * backbone.js model on the client end will not reflect the target model
      * on the Yii application side (note the join in the query below). This
      * is done to make a further query to tbl_target_progress unnecessary.
      *
      */
      case 'target':

        if (count($path) > 1) {
          $id = $path[1];
          $connection = Yii::app()->db;
          $sql = "
            select *
            from
              tbl_target a,
              tbl_target_progress b,
              tbl_unit c
            where
              a.target_id=b.target_id and
              b.unit_id=c.unit_id and
              a.target_id=:target_id;
          ";
          $query = $connection->createCommand($sql);
          $query->bindParam(":target_id",$id,PDO::PARAM_STR);
          $target = $query->queryRow();

          // if target could not be found with assigned id
          if ($target == null) {
            $http_status = 404;
            $return_object = new stdClass();
            $return_object->error_msg = "could not find target with assigned id!";
            break;
          }

          // otherwise start composing return object
          $return_object = new stdClass();
          $return_object->target_id = $target['target_id'];
          $return_object->goal_id = $target['goal_id'];
          $return_object->name = $target['name'];
          $return_object->total = $target['total'];
          $return_object->current = $target['current'];
          $return_object->unit_type = $target['type'];
          $return_object->unit_id = $target['unit_id'];

        } else {

          // sector id was not specified in API call
          $http_status = 404;
          $return_object = new stdClass();
          $return_object->error_msg = "target id missing!";
        }
        break;

      /**
      * If first element is 'target_progress', then find target progress info
      * on the basis of a supplied target_id and unit_id. Return a collection of
      * data grouped by month for maximum 12 months in the past.
      */
      case 'target_progress':

        if (count($path) > 2) {
          $target_id = $path[1];
          $unit_id = $path[2];
          $connection = Yii::app()->db;
          $sql = "
            select
              tp.unit_id as unit_id,
              tu.type as unit_type,
              tp.target_id as target_id,
              (select total from tbl_target_change as tcc where tcc.target_progress_id = ptp.target_progress_id and ptp.start_date >= tcc.start_date order by tcc.start_date desc limit 1 ) as total,
              sum(ptp.current) as current,
              SUM(ptp.total) as programmed,
              month(ptp.start_date) as month,
              year(ptp.start_date) as year
            from
              tbl_target_progress as tp,
              tbl_pca_target_progress as ptp,
              tbl_unit as tu
            where
              tu.unit_id=tp.unit_id and
              tp.unit_id=:unit_id and
              tp.target_progress_id=ptp.target_progress_id and
              tp.target_id=:target_id
            group by tp.target_id, year, month
            order by year, month;
          ";
          $query = $connection->createCommand($sql);
          $query->bindParam(":target_id",$target_id,PDO::PARAM_STR);
          $query->bindParam(":unit_id",$unit_id,PDO::PARAM_STR);
          $target_progress = $query->queryAll();

          // if target could not be found with assigned id
          if ($target_progress == null) {
            $http_status = 404;
            $return_object = new stdClass();
            $return_object->error_msg = "could not get target progress with supplied target_id and unit_id!";
            break;
          }

          // otherwise start composing return object
          $return_object = $target_progress;

        } else {

          // target id was not specified in API call
          $http_status = 404;
          $return_object = new stdClass();
          $return_object->error_msg = "target id or unit_id missing!";
        }
        break;

      /**
      * If first element is 'pca_target_progress', then find pca target progress info
      * on the basis of a supplied target_id and date data. Return pca data as per the
      * supplied month.
      */
      case 'pca_target_progress':

        if (count($path) > 4) {
          $target_id = $path[1];
          $unit_id = $path[2];
          $year = $path[3];
          $month = $path[4];
          $connection = Yii::app()->db;
          $sql = "
            select
              b.number as number,
              b.title as title,
              a.pca_id as pca_id,
              d.target_id as target_id,
              a.total as total,
              c.name as partner_name,
              month(a.start_date) as month,
              year(a.start_date) as year
            from
              tbl_pca_target_progress a,
              tbl_pca b,
              tbl_partner_organization c,
              tbl_target_progress d
            where
              month(a.start_date)=:month and
              year(a.start_date)=:year and
              a.pca_id=b.pca_id and
              a.target_progress_id=d.target_progress_id and
              d.target_id=:target_id and
              b.partner_id=c.partner_id and
              d.unit_id=:unit_id
            order by year, month;
          ";
          $query = $connection->createCommand($sql);
          $query->bindParam(":target_id",$target_id,PDO::PARAM_STR);
          $query->bindParam(":year",$year,PDO::PARAM_STR);
          $query->bindParam(":month",$month,PDO::PARAM_STR);
          $query->bindParam(":unit_id",$unit_id,PDO::PARAM_STR);
          $pcas = $query->queryAll();

          // also get target data to glue together here
          $sql = "select * from tbl_target where target_id=:target_id;";
          $query = $connection->createCommand($sql);
          $query->bindParam(":target_id",$target_id,PDO::PARAM_STR);
          $target = $query->queryRow();

          $return_object = new stdClass();
          $return_object->target_id = $target_id;
          $return_object->unit_id = $unit_id;
          $return_object->year = $year;
          $return_object->month = $month;
          $return_object->target_name = $target['name'];
          $return_object->pcas = $pcas;

          // if target could not be found with assigned id
          if ($pcas == null || $target == null) {
            $http_status = 404;
            $return_object = new stdClass();
            $return_object->error_msg = "could not get pca target progress with supplied data!";
            break;
          }

        } else {

          // target id was not specified in API call
          $http_status = 404;
          $return_object = new stdClass();
          $return_object->error_msg = "target id missing!";
        }
        break;

      /**
      * If first element is 'locations', then return appropriate location info
      */
      case 'locations':

        if (count($path) == 1) {
          $connection = Yii::app()->db;
          $sql = "
            select distinct
              a.title as pca_title,
              a.number as pca_number,
              a.pca_id as pca_id,
              d.name as partner_name,
              d.partner_id as partner_id,
              f.name as sector_name,
              f.sector_id as sector_id,
              c.latitude as latitude,
              c.longitude as longitude,
              g.name as gateway_name,
              g.gateway_id as gateway_id,
              h.rrp5_output_id as rrp5_output_id,
              k.target_id as target_id
            from
              tbl_pca a,
              tbl_gw_pca_loc b,
              tbl_location c,
              tbl_partner_organization d,
              tbl_pca_sector e,
              tbl_sector f,
              tbl_gateway g,
              tbl_rrp5_output h,
              tbl_pca_rrp5output i,
              tbl_goal j,
              tbl_target k
            where
              a.pca_id=b.pca_id and
              a.partner_id=d.partner_id and
              a.pca_id=e.pca_id and
              e.sector_id=f.sector_id and
              g.gateway_id=b.gateway_id and
              b.location_id=c.location_id and
              h.rrp5_output_id=i.rrp5_output_id and
              i.pca_id=a.pca_id and
              k.goal_id=j.goal_id and
              j.sector_id=e.sector_id
            group by b.pca_id, b.location_id;
          ";
          $query = $connection->createCommand($sql);
          $locations = $query->queryAll();
          $return_object = $locations;

        } else {

          // target id was not specified in API call
          $http_status = 404;
          $return_object = new stdClass();
          $return_object->error_msg = "URL parameters given did not result in locations returned!";
        }
        break;

      /**
      * Return 404, there has been an error with request parameters
      */
      default:
        $http_status = 404;
        $return_object = new stdClass();
        $return_object->error_msg = "API error!";
    }


    $this->_sendResponse($http_status, CJSON::encode($return_object), "application/json");


/*    if(empty($return_object)) {
        // No
        $this->_sendResponse(200, CJSON::encode("{status:404}"));
    } else {


        // Prepare response
        $rows = array();
        foreach($models as $model)
            $rows[] = $model->attributes;
        // Send the response
        $this->_sendResponse(200, CJSON::encode($rows));
    }*/
  }

  private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
  {
    // set the status
    $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
    header($status_header);
    // and the content type
    header('Content-type: ' . $content_type);

    // pages with body are easy
    if($body != '')
    {
        // send the body
        echo $body;
    }
    // we need to create the body if none is passed
    else
    {
      // create some body messages
      $message = '';

      // this is purely optional, but makes the pages a little nicer to read
      // for your users.  Since you won't likely send a lot of different status codes,
      // this also shouldn't be too ponderous to maintain
      switch($status)
      {
          case 401:
              $message = 'You must be authorized to view this page.';
              break;
          case 404:
              $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
              break;
          case 500:
              $message = 'The server encountered an error processing your request.';
              break;
          case 501:
              $message = 'The requested method is not implemented.';
              break;
      }

      // servers don't always have a signature turned on
      // (this is an apache directive "ServerSignature On")
      $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

      // this should be templated in a real-world solution
      $body = '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
        <html>
        <head>
          <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
          <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
        </head>
        <body>
          <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
          <p>' . $message . '</p>
          <hr />
          <address>' . $signature . '</address>
        </body>
        </html>';

      echo $body;
    }
    Yii::app()->end();
  }

  private function _getStatusCodeMessage($status)
  {
    // these could be stored in a .ini file and loaded
    // via parse_ini_file()... however, this will suffice
    // for an example
    $codes = Array(
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
    );
    return (isset($codes[$status])) ? $codes[$status] : '';
  }

}