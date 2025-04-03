<?php
$form_admin_questions = get_field('form_admin_questions', 'option');
$admin_questions = [];
$form_ventas_questions = get_field('form_ventas_questions', 'option');
$ventas_questions = [];
$form_rh_questions = get_field('form_rh_questions', 'option');
$rh_questions = [];
$form_finanzas_questions = get_field('form_finanzas_questions', 'option');
$finanzas_questions = [];
$form_familiar_questions = get_field('form_familiar_questions', 'option');
$familiar_questions = [];
$all_questions = [];
$total_length = 0;

foreach ($form_admin_questions as $index => $question){
    $admin_questions[$index] = array(
        'area'=> 'administración',
        'question'=>$question['question'],
        'answers'=>$question['answers']
    );
}
$all_questions['administracion'] = $admin_questions;
$total_length += count($admin_questions);

if ($form_ventas_questions != null) {
    foreach ($form_ventas_questions as $index => $question){
        $ventas_questions[$index] = array(
            'area'=>'ventas',
            'question'=>$question['question'],
            'answers'=>$question['answers']
        );
    }
}
$total_length += count($ventas_questions);
$all_questions['ventas'] = $ventas_questions;

if ($form_rh_questions != null) {
    foreach ($form_rh_questions as $index => $question){
        $rh_questions[$index] = array(
            'area'=>'recursos humanos',
            'question'=>$question['question'],
            'answers'=>$question['answers']
        );
    }
}
$total_length += count($rh_questions);
$all_questions['recursos_humanos'] = $rh_questions;

if ($form_finanzas_questions != null) {
    foreach ($form_finanzas_questions as $index => $question){
        $finanzas_questions[$index] = array(
            'area'=>'finanzas',
            'question'=>$question['question'],
            'answers'=>$question['answers']
        );
    }
}
$total_length += count($finanzas_questions);
$all_questions['finanzas'] = $finanzas_questions;

if ($form_familiar_questions != null) {
    foreach ($form_familiar_questions as $index => $question){
        $familiar_questions[$index] = array(
            'area'=>'familiar',
            'question'=>$question['question'],
            'answers'=>$question['answers']
        );
    }
}
$total_length += count($familiar_questions);
$all_questions['familiar'] = $familiar_questions;


$tabla_final = get_field('tabla_final','option');

?>