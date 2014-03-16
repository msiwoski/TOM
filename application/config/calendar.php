<?php  
/*

-- used for the calendar configuration in CodeIgniter

*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['day_type'] = 'long';
//$config['show_next_prev'] = TRUE;
//$config['next_prev_url'] = '/calendar';


$config['template'] = '
	{table_open}<table class="calendar width-100 table-bordered">{/table_open}
    {heading_row_start}<tr>{/heading_row_start}

    {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
    {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
    {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

    {heading_row_end}</tr>{/heading_row_end}    

	{week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
	{cal_cell_content}<span class="day_listing">{day}</span>&nbsp;&bull; {content}&nbsp;{/cal_cell_content}
	{cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span>&bull; {content}</div>{/cal_cell_content_today}
	{cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
	{cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
';

/* End of file calendar.php */
/* Location: ./application/config/calendar.php */