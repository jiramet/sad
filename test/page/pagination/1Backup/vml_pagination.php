<?php
/**
* pagination
* author: mr.v automatic
* ทำหน้าที่แบ่งหน้า เช่น ข้อมูลจากฐานข้อมูลแสดงผลมีจำนวนมาก ก็ใช้การแบ่งหน้านี้
*/

class vml_pagination {
	// first, previous, next, last สามารถกำหนดเป็นไฟล์ภาพได้ เช่น <img src="file.jpg"> โดยกำหนดขณะเรียก class  เช่น $pagination->first = "<img src=\"file.jpg\">"; เป็นต้น
	public $first = "First";
	public $previous = "Previous";
	public $next = "Next";
	public $last = "Last";
	
	/**
	* render1($totalpages,$paginate_limit='',$querys='')
	* แสดงหน้าที่ถูกแบ่งทั้งหมด เช่น 1 2 3 4 5 6 7 8 9 10 และหากทั้งหมดมีเกิน (จำนวนหน้าที่แสดงทั้งหมด) เมื่อคลิกที่เกินครึ่งของเลขหน้าที่แสดง ตัวเลขจะเลื่อนอัตโนมัติ เช่น คลิกที่ 6 จะแสดงผลเป็น 2 3 4 5 6 7 8 9 10 11
	* $paginate_limit คือระบุตัวเลขหน้าที่จะแสดงทั้งหมด เช่น 10 ก็แสดงหน้าที่แบ่งครั้งละ 10 หน้า
	* $links ควรส่งมาเป็นค่าที่รับ $_GET ต่างๆ(ถ้ามี)มาแล้วให้เรียบร้อย เช่น page.php?orders=price&orderby=asc ก็ให้ระบุเป็น ?orders=price&orderby=asc& โดยต้องมี & ตามท้ายเพื่อให้ pageno ทำหน้าที่ต่ออย่างถูกต้อง หรือ
	* $links หากไม่มี $_GET ก็กำหนดมาแค่ ? เท่านั้น หรือ
	* $links หากต้องการให้ pageno แสดงเป็น seo friendly เช่น page.php/price/asc/10 (กำลังแสดงหน้าที่ 10) ก็ให้ระบุเป็น page.php/price/asc/ เพื่อให้การแสดงเลขหน้าต่อจาก / ได้ทันที
	* หากไม่เข้าใจเกี่ยวกับ $link ให้ลองกำหนดตามตัวอย่างแล้วดูผลลัพธ์ที่แสดงออกมาเป็นเลขแบ่งหน้าและลิ้งค์ของมัน
	*/
	public function render1($totalpages,$paginate_limit='',$links='') {
		$pageno = (isset($_GET['pageno']) ? $_GET['pageno'] : "1");
		if (empty($paginate_limit)) {$paginate_limit = "10";}//10 = แสดง 10 หน้า < 1 2 3 4 .. to 10 >
		if ($totalpages <= 1) {return "";}//มีหน้าเดียวก็ไม่ต้องทำ ส่งกลับไปเลย
		//หาค่า get ก่อนหน้า
		if (substr($links, (1*-1)) == "/") {
			$allget = $links;
		} else {//$links = "?"; or $links = "?q=v&";
			$allget = $links."pageno=";
		}
		// เรียกใช้ html class
		$html = new html();
		//ลูกศรกลับไปอันแรกสุด
		$output = $html->span($html->a($this->first,$allget."1"),array("class"=>"page-first"));
		//ลูกศรไปอันก่อนหน้า
		if (($pageno-1) <= "0") {
			$output .= " ".$html->span($html->a($this->previous,$allget."1"),array("class"=>"page-prev"));
		} else {
			$output .= " ".$html->span($html->a($this->previous,$allget.($pageno-1).""),array("class"=>"page-prev"));
		}
		// ไล่แสดงหน้า
		if ($pageno == "1") {// คลิกอยู่ที่หน้าแรก
			if ($totalpages < $paginate_limit) {$paginate_limit = $totalpages;} else {$paginate_limit = $paginate_limit;}
			for ($ipage = 1;$ipage <= $paginate_limit;$ipage++) {
				if ($ipage == $pageno) {
					$output .= " ".$html->span($ipage,array("class"=>"pages-selected"));//หน้าที่ถูกเลือกอยู่
				} else {
					$output .= " ".$html->span($html->a($ipage,$allget.$ipage),array("class"=>"pages"));
				}
			}
		} elseif ($pageno <= ($paginate_limit/2)) {//หน้าที่คลิกน้อยกว่าหรือเท่ากับครึ่งหนึ่งของหน้าทั้งหมดที่แสดง (แสดง 10 หน้า ในเงื่อนไขนี้คือหน้า 1-5)
			for ($ipage = 1;$ipage <= $paginate_limit;$ipage++) {
				if ($ipage <= $totalpages) {
					if ($ipage == $pageno) {
						$output .= " ".$html->span($ipage,array("class"=>"pages-selected"));//หน้าที่ถูกเลือกอยู่
					} else {
						$output .= " ".$html->span($html->a($ipage,$allget.$ipage),array("class"=>"pages"));
					}
				}
			}
		} elseif ($pageno == $totalpages || $pageno == ($pageno+($paginate_limit/2))) {//หน้าที่คลิกเท่ากับหน้าทั้งหมด หรือ หน้าที่คลิกเท่ากับหน้าที่คลิก+ครึ่งหนึ่งของหน้าทั้งหมด
			for ($ipage = ($totalpages-$paginate_limit)+1;$ipage <= $totalpages;$ipage++) {
				if ($ipage > 0) {
					if ($ipage == $pageno) {
						$output .= " ".$html->span($ipage,array("class"=>"pages-selected"));//หน้าที่ถูกเลือกอยู่
					} else {
						$output .= " ".$html->span($html->a($ipage,$allget.$ipage),array("class"=>"pages"));
					}
				}
			}
		} else {
			for ($ipage = (($pageno-$paginate_limit/2)+1);$ipage <= ($pageno-1);$ipage++) {
				$output .= " ".$html->span($html->a($ipage,$allget.$ipage),array("class"=>"pages"));
			}
			for ($ipage = $pageno;$ipage <= $pageno+($paginate_limit/2);$ipage++) {
				if ($ipage <= $totalpages) {
					if ($ipage == $pageno) {
						$output .= " ".$html->span($ipage,array("class"=>"pages-selected"));//หน้าที่ถูกเลือกอยู่
					} else {
						$output .= " ".$html->span($html->a($ipage,$allget.$ipage),array("class"=>"pages"));
					}
				}
			}
			
		}
		//จบการไล่แสดงหน้า
		//ลูกศรไปอันถัดไป
		if (($pageno+1) < $totalpages) {
			$output .= " ".$html->span($html->a($this->next,$allget.($pageno+1).""),array("class"=>"page-next"));
		} else {
			$output .= " ".$html->span($html->a($this->next,$allget.$totalpages),array("class"=>"page-next"));
		}
		//ลูกศรกลับไปอันสุดท้าย
		$output .= " ".$html->span($html->a($this->last,$allget.$totalpages),array("class"=>"page-last"))."\n";
		return $output;
	}// render1
	
	/**
	* แสดงหน้าแบบ first previous next last
	* การอ้างอิงค่าต่างๆใช้งานเหมือน render1()
	*/
	public function render2($totalpages,$paginate_limit='',$links='') {
		$pageno = (isset($_GET['pageno']) ? $_GET['pageno'] : "1");
		if (empty($paginate_limit)) {$paginate_limit = "10";}//10 = แสดง 10 หน้า < 1 2 3 4 .. to 10 >
		if ($totalpages <= 1) {return "";}//มีหน้าเดียวก็ไม่ต้องทำ ส่งกลับไปเลย
		//หาค่า get ก่อนหน้า
		if (substr($links, (1*-1)) == "/") {
			$allget = $links;
		} else {//$links = "?"; or $links = "?q=v&";
			$allget = $links."pageno=";
		}
		// เรียกใช้ html class
		$html = new html();
		//ลูกศรกลับไปอันแรกสุด
		$output = $html->span($html->a($this->first,$allget."1"),array("class"=>"page-first"));
		//ลูกศรไปอันก่อนหน้า
		if (($pageno-1) <= "0") {
			$output .= " ".$html->span($html->a($this->previous,$allget."1"),array("class"=>"page-prev"));
		} else {
			$output .= " ".$html->span($html->a($this->previous,$allget.($pageno-1).""),array("class"=>"page-prev"));
		}
		//ลูกศรไปอันถัดไป
		if (($pageno+1) < $totalpages) {
			$output .= " ".$html->span($html->a($this->next,$allget.($pageno+1).""),array("class"=>"page-next"));
		} else {
			$output .= " ".$html->span($html->a($this->next,$allget.$totalpages),array("class"=>"page-next"));
		}
		//ลูกศรกลับไปอันสุดท้าย
		$output .= " ".$html->span($html->a($this->last,$allget.$totalpages),array("class"=>"page-last"))."\n";
		return $output;
	}// render2
	
	/**
	* แสดงการแบ่งหน้าแบบ previous next
	* การอ้างอิงค่าต่างๆใช้งานเหมือน render1()
	*/
	public function render3($totalpages,$paginate_limit='',$links='') {
		$pageno = (isset($_GET['pageno']) ? $_GET['pageno'] : "1");
		if (empty($paginate_limit)) {$paginate_limit = "10";}//10 = แสดง 10 หน้า < 1 2 3 4 .. to 10 >
		if ($totalpages <= 1) {return "";}//มีหน้าเดียวก็ไม่ต้องทำ ส่งกลับไปเลย
		//หาค่า get ก่อนหน้า
		if (substr($links, (1*-1)) == "/") {
			$allget = $links;
		} else {//$links = "?"; or $links = "?q=v&";
			$allget = $links."pageno=";
		}
		// เรียกใช้ html class
		$html = new html();
		$output = "";
		//ลูกศรไปอันก่อนหน้า
		if (($pageno-1) <= "0") {
			$output .= $html->span($html->a($this->previous,$allget."1"),array("class"=>"page-prev"));
		} else {
			$output .= $html->span($html->a($this->previous,$allget.($pageno-1).""),array("class"=>"page-prev"));
		}
		//ลูกศรไปอันถัดไป
		if (($pageno+1) < $totalpages) {
			$output .= " ".$html->span($html->a($this->next,$allget.($pageno+1).""),array("class"=>"page-next"));
		} else {
			$output .= " ".$html->span($html->a($this->next,$allget.$totalpages),array("class"=>"page-next"));
		}
		return $output;
	}// render3
	
}

?>