
<?php 
  include("../../../conn.php");
  $eid = $_GET['eid'];
  $exid = $_GET['exid'];
 ?>

<fieldset style="width:543px;" >
	<legend><i class="facebox-header"><i class="edit large icon"></i>&nbsp;Grade Student</i></legend>
  
  <div class="col-md-12 mt-4">
    <form method="post" id="gradeStudentFrm">
        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
            <?php
            $selQuest = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE eqt.exam_id='$eid' AND ea.axmne_id='$exid' AND ea.exans_status='new' ");
            $i = 1;
            while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td>
                        <b><p><?php echo $i++; ?>.) <?php echo $selQuestRow['exam_question']; ?></p></b>
                        <label class="pl-4">
                            Answer: <span><?php echo $selQuestRow['exans_answer']; ?></span>
                        </label>
                    </td>
                    <td>
                        <label class="text-success" for="correct-<?php echo $selQuestRow['exans_id']; ?>">Correct</label>
                        <input type="radio" name="grade[<?php echo $selQuestRow['exans_id']; ?>]" id="correct-<?php echo $selQuestRow['exans_id']; ?>" value="correct" <?php if ($selQuestRow['exans_grade'] == 'correct') echo 'checked'; ?>>
                    </td>
                    <td>
                        <label class="text-danger" for="wrong-<?php echo $selQuestRow['exans_id']; ?>">Wrong</label>
                        <input type="radio" name="grade[<?php echo $selQuestRow['exans_id']; ?>]" id="wrong-<?php echo $selQuestRow['exans_id']; ?>" value="wrong" <?php if ($selQuestRow['exans_grade'] == 'wrong') echo 'checked'; ?>>
                    </td>
                </tr>
            <?php }
            ?>
        </table>

      <div class="form-group" align="right">
        <button type="submit" class="btn btn-sm btn-primary">Grade</button>
      </div>
    </form>
  </div>
</fieldset>







