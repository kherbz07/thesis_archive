<form action="admin.php" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="action" value="addthesis" />
	<label>Thesis Title:</label>
	<input type="text" id="title" name="title" value="<?php echo $thesis['title']; ?>" /><br/>
	<label>Abstract:</label>
	<textarea id="abstract" name="abstract">
		<?php echo $thesis['abstract']; ?>
		</textarea><br/>
	<label>Scope and Limitation:</label>
	<textarea id="scope" name="scope">
		<?php echo $thesis['scope']; ?>
	</textarea><br/>
	<label>Year:</label>
	<input type="text" id="year" name="year" value="<?php echo $thesis['year']; ?>"/><br/>
	<label>Category:</label>
	<select id="add-thesis-cat" name="category"><br/>
		<optgroup label="Select Role">
			<?php foreach($categories as $category) : ?>
				<option value="<?=$category['id']?>"><?=$category['category']?></option>
			<?php endforeach ?>
		</optgroup>
	</select><br/>
	<label>Researcher(s):</label>
	<input type="text" name="res_fn[]" />
	<input type="text" name="res_mn[]" />
	<input type="text" name="res_ln[]" />
	<select name="res_course[]">
		<optgroup label="Select Course">
			<?php foreach($courses as $course) : ?>
				<option value="<?=$course['id']?>"><?=$course['course']?></option>
			<?php endforeach ?>
		</optgroup>
	</select>
	<select name="res_year[]">
		<optgroup label="Select Year">
			<?php foreach($years as $year) : ?>
				<option value="<?=$year['id']?>"><?=$year['year']?></option>
			<?php endforeach ?>
		</optgroup>
	</select>
	<br/>
	<input type="text" name="res_fn[]" />
	<input type="text" name="res_mn[]" />
	<input type="text" name="res_ln[]" />
	<select name="res_course[]">
		<optgroup label="Select Course">
			<?php foreach($courses as $course) : ?>
				<option value="<?=$course['id']?>"><?=$course['course']?></option>
			<?php endforeach ?>
		</optgroup>
	</select>
	<select name="res_year[]">
		<optgroup label="Select Year">
			<?php foreach($years as $year) : ?>
				<option value="<?=$year['id']?>"><?=$year['year']?></option>
			<?php endforeach ?>
		</optgroup>
	</select>
	<br/>
	<label>Thesis File (PDF Format):</label>
	<input type="file" id="pdf_file" name="pdf_file" /><br/>
	<label>System File:</label>
	<input type="file" id="sys_file" name="sys_file" /><br/>
	<button type="submit">Add Thesis</button>
</form>