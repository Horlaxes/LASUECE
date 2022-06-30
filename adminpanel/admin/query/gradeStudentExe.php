<?php
 include("../../../conn.php");
 extract($_POST);

foreach ($_REQUEST['grade'] as $key => $value) {
    $grade = $conn->query("UPDATE exam_answers SET exans_grade='$value' WHERE exans_id='$key'");
}
if ($grade) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}

echo json_encode($res);
?>