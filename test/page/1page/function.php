<?php
	function SplitPage($page = 1, $totalpage = 1, $option = "") {
		if ($totalpage <= 1) {

		} else if ($totalpage <= 10) {
			if ($totalpage >= 3) {
				echo '<div><a href="'.$option.'1" target="_self">หน้าแรก</a> << ';
				echo 'ทั้งหมด '.$totalpage.' หน้า ';
				echo '  >> <a href="'.$option.''.$totalpage.'" target="_self"> หน้าสุดท้าย </a> </div>';
			}

			if ($page == 1) {

				echo ' | <span class="tal bold f16">'.$page.'</span> | ';
				for ($l = 2; $l <= $totalpage; $l++) {
					echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
				}

				echo '<a href="'.$option.''.($page + 1).'" target="_self"> </a>';

			} else if ($page == $totalpage) {
				echo '<a href="'.$option.''.($page - 1).'" target="_self"></a> | ';

				for ($l = 1; $l < $totalpage; $l++) {
					echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
				}

				echo '<span class="tal bold f16">'.$page.'</span> | ';

			} else {
				echo '<a href="'.$option.''.($page - 1).'" target="_self"></a> | ';

				for ($l = 1; $l < $page; $l++) {
					echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
				}

				echo '<span class="tal bold f16">'.$page.'</span> |';

				for ($r = $page + 1; $r <= $totalpage; $r++) {
					echo '<a href="'.$option.''.$r.'" target="_self">'.$r.'</a> | ';
				}

				echo '<a href="'.$option.''.($page + 1).'" target="_self"> </a>';

			}
		} else {

			if ($totalpage >= 3) {
				echo '<div><a href="'.$option.'1" target="_self">หน้าแรก</a> << ';
				echo 'ทั้งหมด '.$totalpage.' หน้า';
				echo '  >> <a href="'.$option.''.$totalpage.'" target="_self">หน้าสุดท้าย </a> </div>';
			}

			if ($page == 1) {

				echo ' | <span class="tal bold f16">'.$page.'</span> | ';
				for ($l = 2; $l <= 5; $l++) {
					echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
				}
				echo '... | ';
				for ($r = $totalpage - 4; $r <= $totalpage; $r++) {
					echo '<a href="'.$option.''.$r.'" target="_self">'.$r.'</a> | ';
				}

				echo '<a href="'.$option.''.($page + 1).'" target="_self"></a>';

			} else if ($page == $totalpage) {
				echo '<a href="'.$option.''.($page - 1).'" target="_self"></a> | ';

				for ($l = 1; $l <= 5; $l++) {
					echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
				}
				echo '... | ';
				for ($r = $totalpage - 4; $r < $totalpage; $r++) {
					echo '<a href="'.$option.''.$r.'" target="_self">'.$r.'</a> | ';
				}

				echo '<span class="tal bold f16">'.$page.'</span> | ';

			} else {

				if ($page > 1 and $page < 10) {
					echo '<a href="'.$option.''.($page - 1).'" target="_self"> | ';

					for ($l = 1; $l < $page; $l++) {
						echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
					}

					echo '<span class="tal bold f16">'.$page.'</span> | ';

					for ($r = $page + 1; $r <= 10; $r++) {
						echo '<a href="'.$option.''.$r.'" target="_self">'.$r.'</a> | ';
					}
					echo '... | ';
					echo '<a href="'.$option.''.$totalpage.'" target="_self">'.$totalpage.'</a> | ';

					echo '<a href="'.$option.''.($page + 1).'" target="_self"> </a>';
				} else if ($page >= $totalpage - 8 and $page < $totalpage) {
					echo '<a href="'.$option.''.($page - 1).'" target="_self"></a> | ';
					echo '<a href="'.$option.'1" target="_self">1</a> | ';
					echo '... | ';
					for ($l = $totalpage - 9; $l < $page; $l++) {
						echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
					}
					echo '<span class="tal bold f16">'.$page.'</span> | ';
					for ($r = $page + 1; $r <= $totalpage; $r++) {
						echo '<a href="'.$option.''.$r.'" target="_self">'.$r.'</a> | ';
					}
					echo '<a href="'.$option.''.($page + 1).'" target="_self"> </a>';
				} else {
					echo '<a href="'.$option.''.($page - 1).'" target="_self"></a> | ';
					for ($l = 1; $l <= 3; $l++) {
						echo '<a href="'.$option.''.$l.'" target="_self">'.$l.'</a> | ';
					}
					echo '... | ';
					echo '<a href="'.$option.''.($page - 1).'" target="_self">'.($page - 1).'</a> | ';
					echo '<span class="tal bold f16">'.$page.'</span> | ';
					echo '<a href="'.$option.''.($page + 1).'" target="_self">'.($page + 1).'</a> | ';
					echo '... | ';

					for ($r = $totalpage - 2; $r <= $totalpage; $r++) {
						echo '<a href="'.$option.''.$r.'" target="_self">'.$r.'</a> | ';
					}

					echo '<a href="'.$option.''.($page + 1).'" target="_self"> </a>';
				}
			}
		}
	}
?>