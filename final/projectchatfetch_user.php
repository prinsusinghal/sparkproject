<?php

//fetch_user.php

include('database_connection.php');

session_start();
//$projectid = $_GET['projectid'];
$projectid = $_GET['projectid'];
echo $projectid;
$query = "
SELECT * FROM assign 
WHERE projectid = 19
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-bordered table-striped">
	<tr>
		<th width="34%">Username</td>
		<th width="33%">Status</td>
		<th width="33%">Action</td>
	</tr>
';

foreach($result as $row)
{
	$status = '';
	$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
	$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
	$user_last_activity = fetch_user_last_activity($row['id'], $connect);
	if($user_last_activity > $current_timestamp)
	{
		$status = '<span class="label label-success">Online</span>';
	}
	else
	{
		$status = '<span class="label label-danger">Offline</span>';
	}
	$output .= '
	<tr>
		<td>'.$row['username'].' '.count_unseen_message($row['id'], $_SESSION['id'], $connect).' '.fetch_is_type_status($row['id'], $connect).'</td>
		<td>'.$status.'</td>
		<td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['id'].'" data-tousername="'.$row['username'].'">Start Chat</button></td>
	</tr>
	';
}

$output .= '</table>';

echo $output;

?>