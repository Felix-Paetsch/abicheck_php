<?php 
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}?>

<div class="show_tg">
	<div class="remove">
		<div class="top_name">REMOVE</div>
		<span>DELETE FROM rechner WHERE rechner_id = $rechner_id<pre style="display: inline;">    </pre>|<pre style="display: inline;">    </pre><a href="write_mySQL?query=DELETE FROM rechner WHERE rechner_id = $rechner_id" class="editorlink">MySQL - Editor</a></span>
	</div>
	<table class="tg_table">
		 	<tr>
		    	<th>rechner_id</th>
		    	<th>rechner_name</th>
		    	<th>article_name</th>
		    	<th>view rechner</th>
		 	</tr>
			<?php echo $echo_rechner ?>
	</table>
</div>