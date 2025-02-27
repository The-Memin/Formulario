<?php
$admin_questions = get_field('form_admin_questions', 'option');

$questions = [];

foreach ($admin_questions as $index => $question){
    $questions[$index] = array(
        'area'=>'administración',
        'question'=>$question['question'],
        'answers'=>$question['answers']
    );
}
?>