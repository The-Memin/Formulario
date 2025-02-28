<?php
$form_admin_questions = get_field('form_admin_questions', 'option');
$admin_questions = [];
$form_ventas_questions = get_field('form_ventas_questions', 'option');
$ventas_questions = [];

foreach ($form_admin_questions as $index => $question){
    $admin_questions[$index] = array(
        'area'=>'administración',
        'question'=>$question['question'],
        'answers'=>$question['answers']
    );
}
if ($form_ventas_questions != null) {
    foreach ($form_ventas_questions as $index => $question){
        $ventas_questions[$index] = array(
            'area'=>'administración',
            'question'=>$question['question'],
            'answers'=>$question['answers']
        );
    }
}
?>