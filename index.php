<?php


require "lib/db.php";


$db = new db();
$student = $db->select("student","*")->GetAll();


$certificate_content =  file_get_contents("test.html");


foreach($student as $st){
    $certificate_name = $st['name'].".html";
    $newfile =  fopen("certificate/".$certificate_name,"w");
    $newcontent = str_replace(['name','course','date'],[$st['name'],$st['course_name'],$st['course_end']],$certificate_content);
    fwrite($newfile,$newcontent);
}
