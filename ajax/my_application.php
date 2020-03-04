<?php
require_once("../support/config.php");



$primaryKey = 'id';
$index=-1;

$columns = array(
    array( 'db' => 'id','dt' => ++$index ,'formatter'=>function($d,$row){
        return htmlspecialchars($d);
    }),
    array( 'db' => 'name','dt' => ++$index ,'formatter'=>function($d,$row){
        return htmlspecialchars($d);
    }),
    array( 'db' => 'job_title','dt' => ++$index ,'formatter'=>function($d,$row){
        return htmlspecialchars(date_format(date_create($d),DATE_FORMAT_PHP));
    }),
    array( 'db' => 'date_filed','dt' => ++$index ,'formatter'=>function ($d, $row) {
        return htmlspecialchars($d);
    }),
    array( 'db' => 'is_process','dt' => ++$index ,'formatter'=>function($d,$row){
        return htmlspecialchars(date_format(date_create($d),DATE_FORMAT_PHP));

    }),

     array(
        'db'        => 'id',
        'dt'        => ++$index,
        'formatter' => function( $d, $row ) {
            $action_buttons="";
            if($row['is_process']=="3"):
                $action_buttons.="<button class='btn btn-sm btn-info' style='background-color: #f0ad4e; border-color:#eea236;' title='Query Request' onclick='query(\"{$row['id']}\")'><span  class='fa fa-comment'></span></button>";
            else :
                $action_buttons.="<button class='btn btn-sm btn-info' style='background-color: #007bff; border-color:#007bff;' title='View Comments' onclick='query_logs(\"{$row['id']}\")'><span  class='fa fa-envelope-o'></span></button>";


            endif;
            if($row['is_process']<>"2" && $row['is_process']<>"5" && $row['is_process']<>"4"):
                $action_buttons.="<form method='post' action='cancel.php?id={$row['id']}' onsubmit='return confirm(\"Cancel This Request?\")' style='display:inline'>";

                $action_buttons.="<input type='hidden' name='type' value='swap'>";
                $action_buttons.=" <button class='btn btn-sm btn-danger' value='swap' title='Cancel Request'><span class='fa fa-times'></span></button></form>";
            endif;


            return $action_buttons;
        }
    ),
    array( 'db' => 'is_process','dt' => ++$index ,'formatter'=>function($d,$row){
    }),
);

require( '../support/ssp.class.php' );


$limit = SSP::limit( $_GET, $columns );
$order = SSP::order( $_GET, $columns );

$where = SSP::filter( $_GET, $columns, $bindings );
$whereAll="";
$whereResult="";



  $data=$con->myQuery("SELECT
    sr.id as id,
    sr.employee_id as emp_id,
    sr.name as name,
    sr.job_title as job_title,
    sr.date_filed as date_filed,
    sr.is_process as is_process
    FROM my_application sr
    ",array("employee_id"=>$_SESSION[WEBAPP]['user']['employee_id']));

    $whereAll=" (employee_id=:employee_id ) ";
    $filter_sql="";
    $filter_sql.=" ";
    $bindings[]=array('key'=>'employee_id','val'=>$_SESSION[WEBAPP]['user']['employee_id'],'type'=>0);


function jp_bind($bindings)
{
    $return_array=array();
    if ( is_array( $bindings ) ) {
            for ( $i=0, $ien=count($bindings) ; $i<$ien ; $i++ ) {
                //$binding = $bindings[$i];
                // $stmt->bindValue( $binding['key'], $binding['val'], $binding['type'] );
                $return_array[$bindings[$i]['key']]=$bindings[$i]['val'];
            }
        }

        return $return_array;
}
$whereAll.=$filter_sql;
$where.= !empty($where) ? " AND ".$whereAll:"WHERE ".$whereAll;



$bindings=jp_bind($bindings);
$complete_query="SELECT SQL_CALC_FOUND_ROWS `".implode("`, `", SSP::pluck($columns, 'db'))."`
             FROM `my_application`{$where} {$order} {$limit}";
            // echo $complete_query;
             //var_dump($bindings);

$data=$con->myQuery($complete_query,$bindings)->fetchAll();
$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();

$recordsTotal=$con->myQuery("SELECT COUNT(id) FROM `my_application` {$where};",$bindings)->fetchColumn();


$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsTotal;
$json['recordsFiltered']=$recordsTotal;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
die;
