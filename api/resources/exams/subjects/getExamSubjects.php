<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/17/17
 * Time: 4:09 PM
 */

function getExamSubjects($examId){
    $sql = "SELECT distinct c.id, c.name FROM topic_exam_mappings as a inner join`topics` as b inner join subjects as c WHERE a.exam_id = :id and a.topic_id = b.id and b.subject_id = c.id";

    try {

        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $examId);
        $stmt->execute();

        $exams = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;

        echo '{"exams": ' . json_encode($exams) . '}';



    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}