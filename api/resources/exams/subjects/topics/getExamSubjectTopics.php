<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/17/17
 * Time: 4:16 PM
 */

function getExamSubjectTopics($examId, $subjectId){
    $sql = "SELECT distinct b.id, b.name
              FROM topic_exam_mappings as a
              inner join`topics` as b
              WHERE a.exam_id = :id and a.topic_id = b.id and b.subject_id = :subject_id";

    $sqlNotIn = "select id,name from topics where id not in (SELECT distinct b.id
              FROM topic_exam_mappings as a
              inner join`topics` as b
              WHERE
              a.exam_id = :exam_id and
              a.topic_id = b.id and
              b.subject_id = :subject_id) and
              subject_id = :subject_id1";

    try {
        $return = array();
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $examId);
        $stmt->bindParam("subject_id", $subjectId);
        $stmt->execute();

        $return['topics_in_exams'] = $stmt->fetchAll(PDO::FETCH_OBJ);
        var_dump($return);die();
        $stmt = $db->prepare($sqlNotIn);
        $stmt->bindParam("id", $examId);
        $stmt->bindParam("subject_id", $subjectId);
        $stmt->bindParam("subject_id1", $subjectId);
        $stmt->execute();

        $return['topics_not_in_exams'] = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;

        echo '{"topics": ' . json_encode($return) . '}';



    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}