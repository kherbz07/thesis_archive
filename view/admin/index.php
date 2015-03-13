<div class="wrapper-container">
	<div class="tbl-div-container">
		<h3 class="tacenter">Thesis Record</h3>
		<table border="1" id="thesis-tbl" class="table-container">
			<thead>
				<tr>
					<th>Title</th>
					<th>Abstract</th>
					<th>Scope and Limitations</th>
					<th>Academic Year</th>
					<th>Category</th>
					<th>PDF Path</th>
					<th>System Path</th>
					<th>Researchers</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if($theses != null): ?>
					<?php foreach($theses as $index => $thesis): ?>
						<tr>
							<td><?php echo $thesis['title']; ?></td>
							<td><?php echo $thesis['abstract']; ?></td>
							<td><?php echo $thesis['scope']; ?></td>
							<td><?php echo $thesis['year']; ?></td>
							<td><?php echo $thesis['category']['category']; ?></td>
							<td><?php echo $thesis['pdf_path']; ?></td>
							<td><?php echo $thesis['system_path']; ?></td>
							<td>
								<ul>
								<?php foreach($thesis['researchers'] as $researcher):  ?>
									<li>
										<?php echo $researcher['first_name'].' '.$researcher['middle_name'].' '.$researcher['last_name'].' '.$researcher['course'].' '.$researcher['year']['year']; ?>
									</li>
								<?php endforeach; ?>
								</ul>
							</td>
							<td>
								<button class="form-button vote-btn">Edit</button>
							</td>
							<td>
								
								<button class="form-button vote-btn">Delete</button>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<form action="admin.php" method="POST" enctype="multipart/form-data">
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