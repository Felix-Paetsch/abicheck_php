<?php 
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}

	$table_name = $_GET['display'];

	$table_top_result = QuerySQL("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='abicheck' AND `TABLE_NAME`= ?;", [$table_name], "s");

	$table_top = [];
	$table_top_html = "<tr class='first-tr'>";
	while($table_column = mysqli_fetch_assoc($table_top_result)){
		$table_top[] = $table_column['COLUMN_NAME'];
		$table_top_html .= "<th>" . $table_column['COLUMN_NAME'] . "</th>";
	}
	$table_top_html .= "</tr>";

	$table_content_query = "SELECT * FROM " . $table_name;
	$table_content_result = mysqli_query($conn, $table_content_query);
	$table_content_html = "";
	while ($result = mysqli_fetch_assoc($table_content_result)){
		$table_content_html .= "<tr>";
		foreach ($result as $key => $value){
			$table_content_html .= "<th>" . htmlspecialchars($value) . "</th>";
		}
		$table_content_html .= "</tr>";
	}
?>

<style type="text/css">
	.table_name{
		font-size: 35px;
		margin: 30px 0px 20px 0px;
	}

	.first-tr{
		color: #4ecba5;
	}

	table{
		margin-left: -20px;
	}

	table tr th{
		padding-right: 20px;
		padding-left: 20px;
		text-align: left;
	}

	table tr th{
		padding-bottom: 40px;
	}

	.remove{
		margin-top: 100px;
		width: 700px;
		margin-bottom: 200px;
	}

	.top_name{
		margin-top: 40px;
		font-family: 'MuseoModerno', cursive;
		font-size: 25px;
	}

	a.editorlink{
		text-decoration-line: none;
		color: white;
	}

	a.editorlink:hover{
		color: rgb(200,200,200);
		transition-duration: .3s;
	}
</style>

<div class="table_name"><?php echo $table_name?></div>

<table>
	<?php 
		echo $table_top_html;
		echo $table_content_html;
	?>
</table>

<div class="remove">
	<div class="top_name">REMOVE</div>
	<span>DELETE FROM <?php echo $table_name ?> WHERE $id_type = $id<pre style="display: inline;">    </pre>|<pre style="display: inline;">    </pre>
		<a <?php echo 'href="write_mySQL?query=' . 'DELETE FROM ' . $table_name . ' WHERE $id_type = $id"' ;?> class="editorlink">MySQL - Editor</a></span>
</div>

<script type="text/javascript">
	//var tables = document.getElementsByClassName('flexiCol');
var tables = document.getElementsByTagName('table');
for (var i=0; i<tables.length;i++){
 resizableGrid(tables[i]);
}

function resizableGrid(table) {
 var row = table.getElementsByTagName('tr')[0],
 cols = row ? row.children : undefined;
 if (!cols) return;
 
 table.style.overflow = 'hidden';
 
 var tableHeight = table.offsetHeight;
 
 for (var i=0;i<cols.length;i++){
  var div = createDiv(tableHeight);
  cols[i].appendChild(div);
  cols[i].style.position = 'relative';
  setListeners(div);
 }

 function setListeners(div){
  var pageX,curCol,nxtCol,curColWidth,nxtColWidth;

  div.addEventListener('mousedown', function (e) {
   curCol = e.target.parentElement;
   nxtCol = curCol.nextElementSibling;
   pageX = e.pageX; 
 
   var padding = paddingDiff(curCol);
 
   curColWidth = curCol.offsetWidth - padding;
   if (nxtCol)
    nxtColWidth = nxtCol.offsetWidth - padding;
  });

  div.addEventListener('mouseover', function (e) {
   e.target.style.borderRight = '2px solid #0000ff';
  })

  div.addEventListener('mouseout', function (e) {
   e.target.style.borderRight = '';
  })

  document.addEventListener('mousemove', function (e) {
   if (curCol) {
    var diffX = e.pageX - pageX;
 
    if (nxtCol)
     nxtCol.style.width = (nxtColWidth - (diffX))+'px';

    curCol.style.width = (curColWidth + diffX)+'px';
   }
  });

  document.addEventListener('mouseup', function (e) { 
   curCol = undefined;
   nxtCol = undefined;
   pageX = undefined;
   nxtColWidth = undefined;
   curColWidth = undefined
  });
 }
 
 function createDiv(height){
  var div = document.createElement('div');
  div.style.top = 0;
  div.style.right = 0;
  div.style.width = '5px';
  div.style.position = 'absolute';
  div.style.cursor = 'col-resize';
  div.style.userSelect = 'none';
  div.style.height = height + 'px';
  return div;
 }
 
 function paddingDiff(col){
 
  if (getStyleVal(col,'box-sizing') == 'border-box'){
   return 0;
  }
 
  var padLeft = getStyleVal(col,'padding-left');
  var padRight = getStyleVal(col,'padding-right');
  return (parseInt(padLeft) + parseInt(padRight));

 }

 function getStyleVal(elm,css){
  return (window.getComputedStyle(elm, null).getPropertyValue(css))
 }
};
</script>