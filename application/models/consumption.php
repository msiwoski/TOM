<?php
/*
 * consumption model (deal with the table for trends)
 */

class Consumption extends CI_Model {
    
    var $root;
    
    function __construct() {
        parent::__construct();
        $this->root = simplexml_load_file(XML_FOLDER . 'percapitaconsumption.xml');
    }
    
    function get_headings() {
        $headings = array();
        
        for($s = 0; $s < count($this->root->sources); $s++) {
            for($a = 0; $a < count($this->root->sources[$s]->alcohol); $a++) {
                foreach ($this->root->sources[$s]->alcohol[$a]->sold as $sold) {
                    if (!in_array((string)$sold['year'], $headings)) {
                        $headings[] = (string)$sold['year'];
                    }
                }
            }
        }
        
        return $headings;
    }
    
    function get_alcohol_categories() {
        $categories = array();
        
        foreach($this->root->categories->category as $category) {
            $categories[(string)$category['code']] = (string)$category;
        }
        
        ksort($categories);
        return $categories;
    }
    
    function get_province_names() {
        $provinces = array();
        
        foreach($this->root->provinces->province as $prov) {
            $provinces[(string)$prov['code']] = (string)$prov;
        }
        
        ksort($provinces);
        return $provinces;
    }
    
    function get_province_category($prov, $category) {
        
        $params = array();
        
        
        foreach($this->root->sources as $source) {
            
            if ($source['province'] == $prov) {
                foreach($source as $alcohol) {

                    if ($alcohol['type'] == $category) {
                        foreach ($alcohol as $sold) {

                            $year = (string)$sold['year'];
                            
                            $params[$year] = (string)$sold;
                            
                        }
                    }

                }
            }
            
        }
        
        return $params;
    }
    
    
}