<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title> New Document </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
 </head>

 <body>
  
<table>
<thead>
<tr><td width="50">No.</td><td width="250">Description</td><td width="50">เลือก <input type="checkbox" id="selectingGroupA"  /></td></tr>
</thead>
<tbody class="body1">
<tr><td style="text-align:center">1</td><td>AAAA</td><td><input type="checkbox" name="selectedValueA[]" value="1"  /></td></tr>
<tr><td style="text-align:center">2</td><td>BBBB</td><td><input type="checkbox" name="selectedValueA[]" value="2"  /></td></tr>
<tr><td style="text-align:center">3</td><td>CSCSCAA</td><td><input type="checkbox" name="selectedValueA[]" value="3" /></td></tr>
<tr><td style="text-align:center">4</td><td>AAWERTY</td><td><input type="checkbox" name="selectedValueA[]" value="4" /></td></tr>
</tbody>
<thead>
<tr><td width="50">No.</td><td width="250">Description</td><td width="50">เลือก <input type="checkbox" id="selectingGroupB"  /></td></tr>
</thead>
<tbody class="body2">
<tr><td style="text-align:center">5</td><td>XX</td><td><input type="checkbox" name="selectedValueB[]" value="5"  /></td></tr>
<tr><td style="text-align:center">6</td><td>DSDS</td><td><input type="checkbox" name="selectedValueB[]" value="1"  /></td></tr>
<tr><td style="text-align:center">7</td><td>XLXL</td><td><input type="checkbox" name="selectedValueB[]" value="7" /></td></tr>
<tr><td style="text-align:center">8</td><td>QWERTY</td><td><input type="checkbox" name="selectedValueB[]" value="8" /></td></tr>
</tbody>
<thead>
<tr><td width="50">No.</td><td width="250">Description</td><td width="50">เลือก <input type="checkbox" id="selectingGroupB"  /></td></tr>
</thead>
<tbody class="body2">
<tr><td style="text-align:center">5</td><td>XX</td><td><input type="checkbox" name="selectedValueB[]" value="5"  /></td></tr>
<tr><td style="text-align:center">6</td><td>DSDS</td><td><input type="checkbox" name="selectedValueB[]" value="1"  /></td></tr>
<tr><td style="text-align:center">7</td><td>XLXL</td><td><input type="checkbox" name="selectedValueB[]" value="7" /></td></tr>
<tr><td style="text-align:center">8</td><td>QWERTY</td><td><input type="checkbox" name="selectedValueB[]" value="8" /></td></tr>
</tbody>
</table>

 <script language="javascript">
  
  $("input:checkbox#selectingGroupA").change(function(){
	  $("tbody.body1 input:checkbox").each(function(){
		  $(this).attr('checked',$("input:checkbox#selectingGroupA").is(':checked'));		
	  });
  });

  $("input:checkbox#selectingGroupB").change(function(){
	  $("tbody.body2 input:checkbox").each(function(){
		  $(this).attr('checked',$("input:checkbox#selectingGroupB").is(':checked'));		
	  });
  });
  </script>
 </body>
</html>
