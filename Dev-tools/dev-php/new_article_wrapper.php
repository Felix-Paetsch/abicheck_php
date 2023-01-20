<div class = "new_article_wrapper">
		<div class="add">
			<div class="top_name">ADD</div>
			<form action="articles.php?what=meta" method="POST">
				<div>
					<label for="article_name">Article - Name:</label><br>
					<textarea name="article_name" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
				</div>
				<div>
					<label for="sub_name">Sub - Name:</label><br>
					<textarea name="sub_name" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
				</div>
				<div>
					<label for="article_meta">Article - Meta:</label><br>
					<textarea name="article_meta" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
				</div>
				<div>
					<label for="article_style">Article - Style:</label><br>
					<textarea name="article_style" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
				</div>
				<div>
					<label for="übungen_style">Übungen - Style:</label><br>
					<textarea name="übungen_style" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
				</div>
				<div>
					<input class="submit_go submit_new" type="submit" name="add_new_article" value="Add"/>
				</div>
			</form> 
		</div>
	</div>
</div>