<form action="teacher.php" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="action" value="addthesis" />
	<label>Thesis Title:</label>
	<input type="text" id="title" name="title" /><br/>
	<label>Abstract:</label>
	<textarea id="abstract" name="abstract"></textarea><br/>
	<label>Scope and Limitation:</label>
	<textarea id="scope" name="scope"></textarea><br/>
	<label>Year:</label>
	<input type="text" id="year" name="year" /><br/>
	<label>Category:</label>
	<select id="add-thesis-cat" name="category"><br/>
		<optgroup label="Select Role">
			<?php foreach($categories as $category) : ?>
				<option value="<?=$category['id']?>"><?=$category['category']?></option>
			<?php endforeach ?>
		</optgroup>
	</select><br/>
	<label>Researcher(s):</label>
	<input type="text" name="researchers[]" />
	<input type="text" name="researchers[]" />
	<input type="text" name="researchers[]" />
	<input type="text" name="researchers[]" /><br/>
	<label>Thesis File (PDF Format):</label>
	<input type="file" id="pdf_file" name="pdf_file" /><br/>
	<label>System File:</label>
	<input type="file" id="sys_file" name="sys_file" /><br/>
	<button type="submit">Add Thesis</button>
</form>