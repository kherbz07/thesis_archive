<h3>Admin Home Page</h3>
<a href="login.php?action=logout">Logout</a>
<hr/>
<table border=1>
	<thead>
		<tr>
			<th>Id</th>
			<th>Category</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($categories != NULL) : ?>
			<?php foreach($categories as $category) : ?>
				<tr>
					<td><?= $category['id'] ?></td>
					<td><?= $category['category'] ?></td>
					<td>
						<button class="edit-cat-btn">Edit</button>
						<button class="del-cat-btn">Delete</button>
					</td>
				</tr>
			<?php endforeach ?>
		<?php endif	?>
	</tbody>
</table>
<hr/>
<h4>Add New Category</h4>
<form action="admin.php" method="POST">
	<input type="hidden" name="action" value="addcategory" />
	<label>Category: </label>
	<input type="text" id="category" name="category" />
	<button type="submit">Add Category</button>
</form>
<hr/>