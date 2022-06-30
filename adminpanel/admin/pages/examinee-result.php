<link rel="stylesheet" type="text/css" href="css/mycss.css">
<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>STUDENT RESULT</div>
                    </div>
                </div>
            </div>        
            
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Student Result
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                            <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Matric Number</th>
                                <th>Exam Name</th>
                                <th>Scores</th>
                                <th>Ratings</th>
                                <th>Action</th>
                                <!-- <th width="10%"></th> -->
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selExmne = $conn->query("SELECT * FROM examinee_tbl et INNER JOIN exam_attempt ea ON et.exmne_id = ea.exmne_id ORDER BY ea.examat_id DESC ");
                                if($selExmne->rowCount() > 0)
                                {
                                    while ($selExmneRow = $selExmne->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                           <td><?php echo $selExmneRow['exmne_fullname']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_birthdate']; ?></td>
                                           <td>
                                             <?php 
                                                $eid = $selExmneRow['exmne_id'];
                                                $selExName = $conn->query("SELECT * FROM exam_tbl et INNER JOIN exam_attempt ea ON et.ex_id=ea.exam_id WHERE  ea.exmne_id='$eid' ")->fetch(PDO::FETCH_ASSOC);
                                                $exam_id = $selExName['ex_id'];
                                                 $exmne_id = $selExmneRow['exmne_id'];
                                                echo $selExName['ex_title'];
                                              ?>
                                           </td>
                                           <td>
                                                <?php
                                                    $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE ea.axmne_id='$eid' AND ea.exam_id='$exam_id' AND ea.exans_status='new' AND ea.exans_grade='correct' ");
                                                ?>
                                                <span>
                                                    <?php echo $selScore->rowCount(); ?>
                                                    <?php 
                                                        $over  = $selExName['ex_questlimit_display'];
                                                     ?>
                                                </span> / <?php echo $over; ?>
                                           </td>
                                           <td>
                                              <?php 
                                                    $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE ea.axmne_id='$eid' AND ea.exam_id='$exam_id' AND ea.exans_status='new' AND ea.exans_grade='correct' ");
                                                ?>
                                                <span>
                                                    <?php 
                                                        $score = $selScore->rowCount();
                                                        $ans = $score / $over * 100;
                                                        echo number_format($ans,2);
                                                        // echo "$ans";
                                                        echo "%";
                                                        
                                                     ?>
                                                </span> 
                                           </td>
                                            <td>
                                               <a rel="facebox" href="facebox_modal/gradeStudent.php?eid=<?php echo $exam_id; ?>&exid=<?php echo $selExmneRow['exmne_id']; ?>" class="btn btn-sm btn-primary">
                                                   <?php
                                                    $graded = true;
                                                    $selQuest = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE eqt.exam_id='$exam_id' AND ea.axmne_id='$exmne_id' AND ea.exans_status='new' ");
                                                    while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC))
                                                        if ($selQuestRow['exans_grade'] == 'pending')
                                                           $graded = false;
                                                    if ($graded) echo 'Regrade';
                                                    else echo 'Grade';
                                                   ?>
                                               </a>
                                           </td>
                                        </tr>
                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="2">
                                        <h3 class="p-3">No Course Found</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
      
        
</div>
         
