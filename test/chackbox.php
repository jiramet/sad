<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

<style type="text/css">
.tr {background-color:#66CCFF;}
.check {background-color:#CCC;}
</style>

<script type="text/javascript">
$(function(){
	 var trcb = $('.tr :checkbox');
	 //เริ่มต้นกำหนดคลาสให้ตามการติ้ก checkbox
	 trcb.each(function(){
	 	 var tr = $(this).parents('.tr');
		 if ( tr.find(':checkbox:not(:checked)').size() ){
		   tr.removeClass('check');
		 } else {
 		   tr.addClass('check');
		 }
	 });
	 //กำหนด event handler เมื่อมีการคลิ้ก checkbox
	 trcb.click(function(){
		var tr = $(this).parents('.tr');
		 if ( tr.hasClass('check') ){
		   tr.removeClass('check');
		 } else {
 		   tr.addClass('check');
		 }
	 });
	 //กำหนด event ให้กับปุ่ม click all
	 $('.checkall-btn').click(function(){
	 	trcb.not(':checked').trigger('click');
	 });
	 //กำหนด event ให้กับปุ่ม click none
	 $('.checknone-btn').click(function(){
	 	trcb.filter(':checked').trigger('click');
	 });
});
</script>

<button class="checkall-btn">check all</button>
<button class="checknone-btn">check none</button>

<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tr"><td width="50"><input type="checkbox" checked="checked" /></td><td>data1</td></tr>
<tr class="tr"><td width="50"><input type="checkbox"/></td><td>data2</td></tr>
</table>