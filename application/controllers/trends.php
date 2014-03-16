<?php

/**
 * Our trends page.
 * 
 * controllers/trends.php
 *
 * ------------------------------------------------------------------------
 */
class Trends extends Application {

    var $years;
    
    function __construct() {
        parent::__construct();
        $this->load->model('consumption');
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] .= " Trends";
        $this->data['pagebody'] = 'trends';
        $this->data['headings'] = $this->build_headings();
        $this->data['body'] = $this->build_report();
        $this->render();
    }
    
    function build_headings() {
        $headings = $this->consumption->get_headings();
        $formatted_headings = array();
        $formatted_headings[] = array('heading' => '');
        $this->years = array();
        foreach($headings as $heading) {
            $formatted_headings[] = array('heading' => $heading);
            $this->years[] = $heading;
        }
        $formatted_headings[] = array('heading' => 'Total');
        $params = array('headings' => $formatted_headings);
        return $this->parser->parse('/consumption/_headings', $params, true);
    }

    function build_report() {
        $result = "";
        $categories = $this->consumption->get_alcohol_categories();
        
        
        foreach($categories as $code=>$name) {
            $result .= $this->build_category_report_segment($code, $name);
        }
        
        return $result;
    }
    
    function build_category_report_segment($code, $name) {
        $result = "";
        $provinces = $this->consumption->get_province_names();
        
        $result .= $this->parser->parse('/consumption/_category', array('category' => $name), true);
        
        foreach($provinces as $prov_code=>$prov_name) {
            $result .= $this->build_province_report_segment($code, $prov_code, $prov_name);
        }
        
        return $result;
    }
    
    function build_province_report_segment($category_code, $province_code, $province_name) {
        $result = "";
        
        $data_members = array();
        $data_members[] = array('data' => $province_name);
        
        $elements = $this->consumption->get_province_category($province_code, $category_code);
        
        $total = 0;
        
        foreach($this->years as $heading) {
            
            $value = '-';
            if (array_key_exists($heading, $elements)) {
                $value = $elements[$heading];
            }
            
            $data_members[] = array('data' => $value);
            
            $total += (float)$value;
            
        }
        
        $data_members[] = array('data' => $total);
        $params = array('values' => $data_members);
        
        $result .= $this->parser->parse('/consumption/_reportline', $params, true);
        
        $result .= "";
        
        return $result;
    }
    
    
}