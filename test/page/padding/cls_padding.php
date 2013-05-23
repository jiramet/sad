<?php
class cls_padding
{
       function padding($sql,$ListPerPage=20) {
               global $page;
                 global $totalpage;

                 $result=mysql_query($sql);
                 if (empty($page))   $page=1;
               $num=mysql_num_rows($result);
               $rt = $num%$ListPerPage;
            
               //หาจำนวนหน้าทั้งหมด
               $totalpage = ($rt!=0) ? floor($num/$ListPerPage)+1 : floor($num/$ListPerPage);
               $goto = ($page-1)*$ListPerPage;

                 $sql .= " LIMIT $goto,$ListPerPage";
                 $result=mysql_query($sql);
                 return $result;
        }//end function

        function show($option="",$align="left") {
                 global $page;
                 global $totalpage;
                 // รูปแบบตัวแปร option คือ $option = "id=$c_id";
                 // ถ้ามีหลายตัวแปรก็จะเป็น  $option = "id=$c_id&name=$myname&action=$action";

                 echo "<table align=center width=100% border=0 bordercolor=black cellspacing=0 cellpadding=2>\n";
                 echo "<tr><td align=$align>\n";
                 echo "<font color=#686898>\n";

                 // สร้าง link เพื่อไปหน้าก่อน-หน้าถัดไป
                 echo "กำลังแสดงหน้าที่  ";
                 if($page>1 && $page<=$totalpage) {
                          $prevpage = $page-1;
                          echo "<a href='".$_SERVER['PHP_SELF']."?page=$prevpage&$option' title='Back'><-</a>\n";
                 }//end if
                 echo " <b>$page/$totalpage</b> ";
                 if($page!=$totalpage) {
                          $nextpage = $page+1;
                          echo "<a href='".$_SERVER['PHP_SELF']."?page=$nextpage&$option' title='Next'>-></a>\n";
                 }//end if
                echo "</font>\n";
                 echo "</td></tr>\n";
                 echo "<tr><td align=$align>\n";
                 // วนลูปแสดงเลขหน้าทั้งหมด แบบเป็นช่วงๆ ช่วงละ 10 หน้า
                 $b=floor($page/10);
                 $c=(($b*10));

                 if($c>1) {
                          $prevpage = $c-1;
                          echo "<a href='".$_SERVER['PHP_SELF']."?page=$prevpage&$option' title='10 หน้าก่อนนี้'><<</a> \n";
                 } else {
                          echo "<<\n";
                 }//end if
                echo " <b>";
                 for($i=$c; $i<$page ; $i++) {
                          if($i>0)
                                    echo "<a href='".$_SERVER['PHP_SELF']."?page=$i&$option'>$i</a> \n";
                 }
                 echo "<font size=2 color=red>$page</font> \n";
                for($i=($page+1); $i<($c+10) ; $i++) {
                          if($i<=$totalpage)
                                     echo "<a href='".$_SERVER['PHP_SELF']."?page=$i&$option'>$i</a> \n";
                 }
                 echo "</b> ";
                 if($c>=0) {
                          if(($c+10)<$totalpage){
                                   $nextpage = $c+10;
                                   echo "<a href='".$_SERVER['PHP_SELF']."?page=$nextpage&$option' title='10 หน้าถัดไป'>>></a> \n";
                          }
                     else
                              echo ">>\n";
                           }
                 else{
                          echo ">>\n";
                 }
                 echo "</td></tr>\n";
                 echo "</table>\n";
        }// end function
}//end class

?>