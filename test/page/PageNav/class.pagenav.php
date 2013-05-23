<?php
Class PageNav
{	
	private $querystring;
	private $pagename;	
	private $numpages;
	private $minpage;
	private $maxpage;
	private $param = array();
	
	public $numrows;
	public $rowsperpage;
	public $pagepergroup;
	public $currentpage;
	public $varname;

	// set stylesheet
	public $globalclass;
	public $currentclass;
	public $linkclass;

	const _DEFAULTSTRING = "PageNav : {prevgroup:<b>&lt;&lt;</b>} {prev:<b>&lt;Prev</b>} | {loop:begin}{page}{seperate: - }{loop:end} | {next:<b>Next&gt;</b>} {nextgroup:<b>&gt;&gt;</b>} <br /> {first:First Page} | {last:Last Page} | Total : <b>{total}</b> pages";

	public function PageNav($numrows = 0 , $currentpage = 1 , $rowsperpage = 0 , $pagepergroup = 0 , $pagefile = "" , $queryparam = array() , $pagevarname = "page")
	{
		if($numrows > 0) {
			$this->init($numrows , $currentpage , $rowsperpage , $pagepergroup , $pagefile , $queryparam , $pagevarname);
		}
	}

	public function init($numrows = 0 , $currentpage = 1 , $rowsperpage = 0 , $pagepergroup = 0 , $pagefile = "" , $queryparam = array() , $pagevarname = "page")
	{
		$this->numrows = $numrows;
		$this->rowsperpage = ($rowsperpage == 0)? $numrows : $rowsperpage;		
		$this->currentpage = ($currentpage == "")? 1 : $currentpage;
		$this->param = $queryparam;
		$this->pagename = $pagefile;
		$this->varname = $pagevarname;
		$this->numpages = ceil($this->numrows/$this->rowsperpage);
		$this->pagepergroup = ($pagepergroup == 0)? $this->numpages : $pagepergroup;
	
		
		$this->_buildQueryString();
	}

	private function _buildQueryString()
	{
		$qs = "";
		if(count($this->param) > 0) {
			foreach($this->param as $key => $value) {
				$qs .= $key . "=" . $value . "&";
			}
			$this->querystring = $qs;
		}
	}

	private function _buildgroup($style = "default") {
		switch ($style) {
			case "currentcenter":

				if($this->numpages > $this->pagepergroup) {

					$min = $this->currentpage - floor($this->pagepergroup / 2);
					$this->minpage = ($min < 1)? 1 : $min;
					$max = $this->minpage + $this->pagepergroup - 1;

					if($max > $this->numpages) {
						$this->maxpage = $this->numpages;
						$this->minpage = $this->maxpage - $this->pagepergroup + 1;
					} else {
						$this->maxpage = $max;
					}
				} else {
					$this->minpage = 1;
					$this->maxpage = $this->numpages;
				}
				
				break;
			case "currentposition":

				if($this->numpages > $this->pagepergroup) {

					$group = floor(($this->currentpage - 1) / $this->pagepergroup);

					$min = ($group * $this->pagepergroup) + 1;
					$this->minpage = $min;
					$max = ($group * $this->pagepergroup) + $this->pagepergroup;

					if($max > $this->numpages) {
						$this->maxpage = $this->numpages;
						$this->minpage = $this->maxpage - $this->pagepergroup + 1;
					} else {
						$this->maxpage = $max;
					}
				} else {
					$this->minpage = 1;
					$this->maxpage = $this->numpages;
				}
				
				break;
			default:
				$this->minpage = 1;
				$this->maxpage = $this->numpages;

		}

	}

	public function getPageNav($string = self::_DEFAULTSTRING , $style = "default")
	{		
		$string = ($string == "")? self::_DEFAULTSTRING : $string;
		return $this->_buildText($string , $style);
	}

	private function _buildText($string , $style) {

		$stringBeforeLoop = "";
		$stringAfterLoop = "";

		$qs = $this->querystring;

		mb_regex_encoding("UTF-8");
		mb_ereg_search_init($string);
		mb_ereg_search("{loop:begin}([\W\S\s\w]+){loop:end}");
		$match = mb_ereg_search_getregs();

		if($match[1] != "") {
			
			$this->_buildgroup($style);

			for($i = $this->minpage; $i <= $this->maxpage; $i++) {

				$loopstr = $match[1];

				if($this->currentpage == $i) {
					$str .= mb_ereg_replace("{page}","<span class=\"" . $this->currentclass . "\">" . $i . "</span>",$loopstr);
				} else {					
					$qsa = $qs . $this->varname . "=" . $i;
					$str .= mb_ereg_replace("{page}","<a href=\"" . $this->pagename . "?" . $qsa . "\" class=\"" . $this->linkclass . "\">" . $i . "</a>",$loopstr);					
				}	
				

				if($i != $this->maxpage) {
					$str =  mb_ereg_replace("{seperate:([\W\S\s\w]+)}","\\1",$str);
				} else {
					$str =  mb_ereg_replace("{seperate:([\W\S\s\w]+)}","",$str);
				}
			}

		}

		$string  = mb_ereg_replace("{loop:begin}([\W\S\s\w]+){loop:end}",$str,$string);	

		$string =  mb_ereg_replace("{total}" , $this->numpages , $string);	
		
		$qsa = $qs . $this->varname . "=" . $this->numpages;
		$string =  mb_ereg_replace("{last:([^}]*)}","<a href=\"" . $this->pagename . "?" . $qsa . "\" class=\"" . $this->linkclass . "\">\\1</a>",$string);

		$qsa = $qs . $this->varname . "=" . 1;
		$string =  mb_ereg_replace("{first:([^}]*)}","<a href=\"" . $this->pagename . "?" . $qsa . "\" class=\"" . $this->linkclass . "\">\\1</a>",$string);

		//--------------------Previous
		
		if(intval($this->currentpage) > 1) {
			$qsa = $qs . $this->varname . "=" . (intval($this->currentpage) - 1);
			$string =  mb_ereg_replace("{prev:([^}]*)}","<a href=\"" . $this->pagename . "?" . $qsa . "\" class=\"" . $this->linkclass . "\">\\1</a>",$string);
		} else {
			$string =  mb_ereg_replace("{prev:([^}]*)}","<span class=\"" . $this->currentclass . "\">\\1</span>",$string);
		}

		//--------------------Next

		if(intval($this->currentpage) < intval($this->numpages)) {
			$qsa = $qs . $this->varname . "=" . (intval($this->currentpage) + 1);
			$string =  mb_ereg_replace("{next:([^}]*)}","<a href=\"" . $this->pagename . "?" . $qsa . "\" class=\"" . $this->linkclass . "\">\\1</a>",$string);
		} else {
			$qsa = $qs . $this->varname . "=" . $this->numpages;
			$string =  mb_ereg_replace("{next:([^}]*)}","<span class=\"" . $this->currentclass . "\">\\1</span>",$string);
		}

		//--------------------Previous Group
		$pagegroup = intval($this->currentpage) - $this->pagepergroup;
		$pagegroup = ($pagegroup > 1)? $pagegroup : 1;
		$pagegroup = ($this->currentpage != 1)? $pagegroup : 0;
		if($pagegroup >= 1) {
			$qsa = $qs . $this->varname . "=" . $pagegroup;
			$string =  mb_ereg_replace("{prevgroup:([^}]*)}","<a href=\"" . $this->pagename . "?" . $qsa . "\" class=\"" . $this->linkclass . "\">\\1</a>",$string);
		} else {
			$string =  mb_ereg_replace("{prevgroup:([^}]*)}","<span class=\"" . $this->currentclass . "\">\\1</span>",$string);
		}

		//--------------------Next Group
		$pagegroup = intval($this->currentpage) + $this->pagepergroup;
		$pagegroup = ($pagegroup < $this->numpages)? $pagegroup : $this->numpages;
		$pagegroup = ($this->currentpage != $this->numpages)? $pagegroup : $this->numpages + 1;
		if($pagegroup <= intval($this->numpages)) {
			$qsa = $qs . $this->varname . "=" . $pagegroup;
			$string =  mb_ereg_replace("{nextgroup:([^}]*)}","<a href=\"" . $this->pagename . "?" . $qsa . "\" class=\"" . $this->linkclass . "\">\\1</a>",$string);
		} else {
			$qsa = $qs . $this->varname . "=" . $this->numpages;
			$string =  mb_ereg_replace("{nextgroup:([^}]*)}","<span class=\"" . $this->currentclass . "\">\\1</span>",$string);
		}

		$string = "<span class=\""  .$this->globalclass . "\">" . $string . "</span>";

		return $string;
	}
}
?>