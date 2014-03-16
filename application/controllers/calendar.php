<?php

/*
 * Calendar model
 */
class Calendar extends Application {

     // Constructor
    function __construct() {
         parent::__construct();
    }
    
	function index()
	{
        $this->data['title'] .= "Calendar";
      
		$data = array(
				17 => 'St. Augustines Cask Night',
				21 => 'Bridge Brewing Cask Day & Parallel 49 Cask Day'
		);

		$this->load->library('calendar');
		$this->data['calendar'] = $this->calendar->generate('', '', $data);
        $this->data['pagebody'] = 'calendar';
        $this->render();
	}
}
