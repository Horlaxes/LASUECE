<?php
 session_start(); 
 include("../conn.php");
 extract($_POST);

 $exmne_id = $_SESSION['examineeSession']['exmne_id'];



$selExAttempt = $conn->query("SELECT * FROM exam_attempt WHERE exmne_id='$exmne_id' AND exam_id='$exam_id'  ");

$selAns = $conn->query("SELECT * FROM exam_answers WHERE axmne_id='$exmne_id' AND exam_id='$exam_id' ");


/**
 * @param PDO $conn
 * @param $exmne_id
 * @param $exam_id
 * @return string[]
 */
function getRes(PDO $conn, $exmne_id, $exam_id): array
{
	$insAns = null;
	foreach ($_REQUEST['answer'] as $key => $value) {
//			 $value = $value['correct'];
		$insAns = $conn->query("INSERT INTO exam_answers(axmne_id,exam_id,quest_id,exans_answer) VALUES('$exmne_id','$exam_id','$key','$value')");
	}
	if ($insAns) {
		$insAttempt = $conn->query("INSERT INTO exam_attempt(exmne_id,exam_id)  VALUES('$exmne_id','$exam_id') ");
		if ($insAttempt) {
			$res = array("res" => "success");
		} else {
			$res = array("res" => "failed");
		}
	} else {
		$res = array("res" => "failed");
	}
	return $res;
}

if($selExAttempt->rowCount() > 0)
{
	$res = array("res" => "alreadyTaken");
}
else if($selAns->rowCount() > 0)
{
	$updLastAns = $conn->query("UPDATE exam_answers SET exans_status='old' WHERE axmne_id='$exmne_id' AND exam_id='$exam_id'  ");
	if($updLastAns)
	{
		$res = getRes($conn, $exmne_id, $exam_id);
	}
}
else
{
	$res = getRes($conn, $exmne_id, $exam_id);
}

 echo json_encode($res);
 ?>


 