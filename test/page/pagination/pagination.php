<?php
/**
 * @author mr.v
 * @website http://okvee.
 */

class pagination {


	public $base_url = '';
	public $total_rows = '';
	public $per_page = 10;
	public $num_links = 5;
	
	public $full_tag_open = '';
	public $full_tag_close = '';

	public $first_link = '&lsaquo; First';
	public $first_tag_open = '';
	public $first_tag_close = '&nbsp;';
	
	public $last_link = 'Last &rsaquo;';
	public $last_tag_open = '&nbsp;';
	public $last_tag_close = '';
	
	public $next_link = "&gt;";
	public $next_tag_open = '&nbsp;';
	public $next_tag_close = '&nbsp;';
	
	public $prev_link = "&lt;";
	public $prev_tag_open = '&nbsp;';
	public $prev_tag_close = '';

	public $cur_tag_open = '<strong>';
	public $cur_tag_close = '</strong>';

	public $num_tag_open = '&nbsp;';
	public $num_tag_close = '';

	public $display_pages = true;


	function __construct($config = '') {
		if (count($config) > 0)
		{
			foreach ($config as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
	}// __construct


	function create_links() {
		// จำนวนที่เข้ามา ไม่มีมากกว่า 0
		if ( $this->total_rows == 0 || $this->per_page == 0 ) {return null;}
		// หาค่าหน้าทั้งหมด
		$total_pages = ceil($this->total_rows/$this->per_page);
		//จำนวนหน้าทั้งหมดมีหน้าเดียว ส่งกลับว่างเปล่า
		if ( $total_pages <= 1 ) {return null;}
		// รับค่า per_page
		$per_page = (isset($_GET['per_page']) ? intval($_GET['per_page']) : '0');
		$end_item_of_page = $per_page;
		// number of current page
		$cur_page = (($per_page/$this->per_page)+1);
		// start list pages
		##############################################################
		// full tag open
		$output = $this->full_tag_open;
		// first page
		if ( $this->first_link !== false && $per_page > '0' ) {
			$output .= $this->first_tag_open . "<a href=\"" . $this->base_url . "&per_page=0\">" . $this->first_link ."</a>" . $this->first_tag_close;
		}
		// previous page
		if ( $this->prev_link !== false && $per_page > '0' ) {
			$output .= $this->prev_tag_open . "<a href=\"" . $this->base_url . "&per_page=" . ($per_page-$this->per_page) . "\">" . $this->prev_link . "</a>" . $this->prev_tag_close;
		}
		// number of pages--------------------------------------------------------------------------------#
		if ( $this->display_pages !== false ) {
			// number of links Before
			for ( $i = ($cur_page-$this->num_links);$i<$cur_page;$i++ ) {
				if ( $i > 0 ) {
					$output .= $this->num_tag_open . "<a href=\"" . $this->base_url . "&per_page=" . (($i*$this->per_page)-$this->per_page) . "\">" . $i . "</a>" . $this->num_tag_close;
				}
			}
			// number of link current
			$output .= $this->num_tag_open . $this->cur_tag_open . $cur_page . $this->cur_tag_close . $this->num_tag_close;
			// number of links After
			for ( $i = ($cur_page+1);$i<=($cur_page+$this->num_links);$i++ ) {
				if ( $i <= $total_pages ) {
					$output .= $this->num_tag_open . "<a href=\"" . $this->base_url . "&per_page=" . (($i*$this->per_page)-$this->per_page) . "\">" . $i . "</a>" . $this->num_tag_close;
				}
			}
		}
		// end number of pages--------------------------------------------------------------------------------#
		// next page
		if ( $this->next_link !== false && $per_page < (($total_pages*$this->per_page)-$this->per_page) ) {
			$output .= $this->next_tag_open . "<a href=\"" . $this->base_url . "&per_page=" . ($per_page+$this->per_page) . "\">" . $this->next_link . "</a>" . $this->next_tag_close;
		}
		// last page
		if ( $this->last_link !== false && $per_page < (($total_pages*$this->per_page)-$this->per_page) ) {
			$output .= $this->last_tag_open . "<a href=\"" . $this->base_url . "&per_page=" . (($total_pages*$this->per_page)-$this->per_page) . "\">" . $this->last_link . "</a>" . $this->last_tag_close;
		}
		// full tag close
		$output .= $this->full_tag_close;
		return $output;
	}// create_links


}

?>