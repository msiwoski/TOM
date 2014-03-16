<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function makeTextField($text, $id, $value = "", $keep = TRUE) {
    $CI = &get_instance();
    $params = array(
        'label' => $text,
        'id' => $id,
        'value' => $value
    );
    return $CI->parser->parse('fields/textfield', $params, $keep);
}

function makePasswordField($text, $id, $keep = TRUE) {
    $CI = &get_instance();
    $params = array(
        'label' => $text,
        'id' => $id
    );
    return $CI->parser->parse('fields/passwordfield', $params, $keep);
}

function makeHiddenField($text, $id, $keep = TRUE) {
    $CI = &get_instance();
    $params = array(
        'label' => $text,
        'id' => $id
    );
    return $CI->parser->parse('fields/hiddenfield', $params, $keep);
}

function makeBigButtonField($text, $id, $keep = TRUE) {
    $CI = &get_instance();
    $params = array(
        'label' => $text,
        'id' => $id,
        'css' => 'btn2'
    );
    return $CI->parser->parse('fields/buttonfield', $params, $keep);
}

function makeNormalButtonField($text, $id, $link = null, $keep = TRUE) {
    $CI = &get_instance();
    $params = array(
        'label' => $text,
        'id' => $id,
        'href' => ($link != null  ? 'href="$link"' : '')
    );
    return $CI->parser->parse('fields/submitbuttonfield', $params, $keep);
}

function makeComboboxField($text, $id, $options, $value = "", $keep = TRUE) {
    $CI = &get_instance();
    $params = array(
        'label' => $text,
        'id' => $id
    );

    $choices = array();
    foreach ($options as $val => $display) {
        $row = array(
            'value' => $val,
            'selected' => ($val == $value) ? 'selected="true"' : '',
            'text' => htmlentities($display)
        );
        $choices[] = $row;
    }
    $params['options'] = $choices;
    return $CI->parser->parse('fields/comboboxfield', $params, $keep);
}

function makeEditableComboboxField($text, $id, $options, $selected = '', $keep = TRUE) {
    $CI = &get_instance();
    $params = array(
        'label' => $text,
        'id' => $id,
        'value' => $selected
    );

    $choices = array();
    foreach ($options as $display) {
        $row = array(
            'text' => htmlentities($display)
        );
        $choices[] = $row;
    }
    $params['options'] = $choices;
    return $CI->parser->parse('fields/editablecomboboxfield', $params, $keep);
}

function makeEditorField($name, $id, $text = '', $keep = TRUE) {
    $CI = &get_instance();
    $CI->caboose->needed('editor', $name);
    $params = array(
        'id' => $id,
        'text' => $text,
    );
    return $CI->parser->parse('fields/editorfield', $params, $keep);
}

function makeImageUpload($label, $id, $name, $filename = '', $src = '', $keep = TRUE) {
    $CI = &get_instance();
    $CI->caboose->needed('image', $name);
    $params = array(
      'label' => $label,
      'id' => $id,
      'src' => $src,
      'filename' => $filename
    );
    return $CI->parser->parse('fields/imageuploadfield', $params, $keep);
}

function makeNumericField($text, $id, $min, $max, $value = 0, $keep = TRUE) {
    
    $CI = &get_instance();
    
    if ($value < $min)
        $value = $min;
    
    if ($value > $max)
        $value = $max;
    
    if ($min > $max)
        $min = $max;
    
    $params = array(
        'label' => $text,
        'id' =>$id,
        'min' => $min,
        'max' => $max,
        'value' => $value
    );
    
    return $CI->parser->parse('fields/numericfield', $params, $keep);
    
}

function makeDateTimeField($text, $id, $keep = TRUE) {
    $CI = &get_instance();
    
    $params = array(
        'label' => $text,
        'id' => $id
    );
    return $CI->parser->parse('fields/datetimefield', $params, $keep);
}