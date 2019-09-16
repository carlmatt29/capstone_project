<?php
	require_once("../support/config.php");

	$applicant_id = $_GET['id'];

	$test = $applicant['assessed_by_id'];
	$primaryKey = 'id';
	$index = -1;

	$columns = array(
		array( 'db' => 'id','dt' => ++$index ,'formatter'=>function ($d, $row) {
			return htmlspecialchars($d);
		}),
		array( 'db' => 'process_owner','dt' => ++$index ,'formatter'=>function ($d, $row) {
			return htmlspecialchars($d);
		}),
		array( 'db' => 'interview_date','dt' => ++$index ,'formatter'=>function ($d, $row) {
			return htmlspecialchars($d);
		}),
		array( 'db' => 'status','dt' => ++$index ,'formatter'=>function ($d, $row) {
			return htmlspecialchars($d);
		}),
		array( 'db' => 'remarks','dt' => ++$index ,'formatter'=>function ($d, $row) {
			return htmlspecialchars($d);
		}),
		array( 'db' => 'status_date_change','dt' => ++$index ,'formatter'=>function ($d, $row) {
			return htmlspecialchars($d);
		}),
		array(
			'db'		=> 'id',
			'dt'        => ++$index,
			'formatter' => function ($d, $row) {
				$action_buttons="";

				$action_buttons.=" <a href='edit_process_owner.php?id={$row['id']}' class='btn btn-success  btn-sm'><span class='fa fa-pencil'></span></a>";

				return $action_buttons;
			}
		)
	);
	 
	require('../support/ssp.class.php');


$limit = SSP::limit($_GET, $columns);
$order = SSP::order($_GET, $columns);

$where = SSP::filter($_GET, $columns, $bindings);
$whereAll="";
$whereResult="";

$whereAll.=" i.applicant_id = '".$applicant_id."' ";

// if (!empty($_GET['employee_id'])) {
// 	$whereAll.=" AND ";
// 	$whereAll.=" u.employee_id=:employee_id";
// 	$bindings[]=array('key'=>'employee_id','val'=>$_GET['employee_id'],'type'=>0);
// }

// if (!empty($_GET['user_type_id'])) {
// 	$whereAll.=" AND ";
// 	$whereAll.=" u.user_type_id=:user_type_id";
// 	$bindings[]=array('key'=>'user_type_id','val'=>$_GET['user_type_id'],'type'=>0);
// }

function jp_bind($bindings)
{
	$return_array=array();
	if (is_array($bindings)) {
		for ($i=0, $ien=count($bindings) ; $i<$ien ; $i++) {
			//$binding = $bindings[$i];
				// $stmt->bindValue( $binding['key'], $binding['val'], $binding['type'] );
				$return_array[$bindings[$i]['key']]=$bindings[$i]['val'];
		}
	}

	return $return_array;
}
$where.= !empty($where) ? " AND ".$whereAll:"WHERE ".$whereAll;



$bindings=jp_bind($bindings);
$complete_query="SELECT i.id AS id, i.applicant_id, i.process_owner_id, CONCAT(e.last_name, ', ',e.first_name) AS process_owner, DATE_FORMAT(i.interview_date, '%M %e, %Y %h:%i %p') AS interview_date, i.interview_status, stat.description AS status, i.remarks, i.status_date_change
FROM tbl_interview i
INNER JOIN tbl_applicant a ON i.applicant_id = a.id
INNER JOIN tbl_applicant_profile ap ON a.applicant_id = ap.id
INNER JOIN employees e ON i.process_owner_id = e.id
LEFT JOIN tbl_application_status stat ON i.interview_status = stat.id {$where} {$order} {$limit}";
			// echo $complete_query;
			 //var_dump($bindings);

$data=$con->myQuery($complete_query, $bindings)->fetchAll();


// $recordsTotal=$con->myQuery("SELECT COUNT(u.id) FROM users u INNER JOIN employees e ON e.id=u.employee_id {$where};", $bindings)->fetchColumn();


$json['draw']=isset($request['draw']) ?intval($request['draw']) :0;
$json['recordsTotal']=$recordsTotal;
$json['recordsFiltered']=$recordsTotal;
$json['data']=SSP::data_output($columns, $data);

echo json_encode($json);
die;
