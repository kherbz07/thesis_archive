<h3>Admin Home Page</h3>
<a href="login.php?action=logout">Logout</a>
<hr/>
<table border=1>
	<thead>
		<tr>
			<th>Id</th>
			<th>Username</th>
			<th>Password</th>
			<th>Role</th>
			<th>First Name</th>
			<th>Middle Name</th>
			<th>Last Name</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($users != NULL) : ?>
			<?php foreach($users as $user) : ?>
				<tr>
					<td><?= $user['id'] ?></td>
					<td><?= $user['username'] ?></td>
					<td><?= $user['password'] ?></td>
					<td style="display:none;"><?= $user['role']['id'] ?></td>
					<td><?= $user['role']['role'] ?></td>
					<td><?= $user['first_name'] ?></td>
					<td><?= $user['middle_name'] ?></td>
					<td><?= $user['last_name'] ?></td>
					<td>
						<button class="edit-btn">Edit</button>
						<button class="del-btn">Delete</button>
					</td>
				</tr>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</tbody>
</table>
<hr/>
<h4>Add New User</h4>
<form acton="admin.php" method="POST">
	<input type="hidden" name="action" value="adduser" />
	<label>First Name:</label>
	<input type="text" id="firstname" name="firstname" /><br/>
	<label>Middle Name:</label>
	<input type="text" id="middlename" name="middlename" /><br/>
	<label>Last Name:</label>
	<input type="text" id="lastname" name="lastname" /><br/>
	<label>Username:</label>
	<input type="text" id="username" name="username" /><br/>
	<label>Password:</label>
	<input type="password" id="passsword" name="password" /><br/>
	<label>Role:</label>
	<select id="role" name="role">
		<optgroup label="Select Role">
			<?php foreach($roles as $role) : ?>
				<option value="<?=$role['id']?>"><?=$role['role']?></option>
			<?php endforeach ?>
		</optgroup>
	</select><br/>
	<button type="submit">Add User</button>
</form>
<hr/>
<h4>Edit User</h4>
<form acton="admin.php" method="POST">
	<input type="hidden" name="action" value="edituser" />
	<input type="hidden" id="edit-ui" name="user_id" value="0" />
	<label>First Name:</label>
	<input type="text" id="edit-fn" name="firstname" /><br/>
	<label>Middle Name:</label>
	<input type="text" id="edit-mn" name="middlename" /><br/>
	<label>Last Name:</label>
	<input type="text" id="edit-ln" name="lastname" /><br/>
	<label>Username:</label>
	<input type="text" id="edit-un" name="username" /><br/>
	<label>Password:</label>
	<input type="password" id="edit-pw" name="password" /><br/>
	<label>Role:</label>
	<select id="edit-role" name="role">
		<optgroup label="Select Role">
			<?php foreach($roles as $role) : ?>
				<option value="<?=$role['id']?>"><?=$role['role']?></option>
			<?php endforeach ?>
		</optgroup>
	</select><br/>
	<button type="submit">Edit User</button>
</form>
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
<h4>Theses</h4>
<table border=1>
	<thead>
		<tr>
			<th>Id</th>
			<th>Title</th>
			<th>Researchers</th>
			<th>Abstract</th>
			<th>Scope and Limitation</th>
			<th>Academic Year</th>
			<th>Category Id</th>
			<th>Category</th>
			<th>PDF Path</th>
			<th>System Path</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($theses != NULL) : ?>
			<?php foreach($theses as $thesis) : ?>
				<tr>
					<td><?=$thesis['id']?></td>
					<td><?=$thesis['title']?></td>
					<td>
						<?php foreach ($thesis['researchers'] as $researcher) : ?>
							<?=$researcher['first_name'] . $researcher['middle_name'] . $researcher['last_name']?><br/>
						<?php endforeach ?>
					</td>
					<td><?=$thesis['abstract']?></td>
					<td><?=$thesis['scope']?></td>
					<td><?=$thesis['year']?></td>
					<td><?=$thesis['category']['id']?></td>
					<td><?=$thesis['category']['category']?></td>
					<td><?=$thesis['pdf_path']?></td>
					<td><?=$thesis['system_path']?></td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</tbody>
</table>
<hr/>
<form action="admin.php" method="POST" enctype="multipart/data">
	<input type="hidden" name="action" value="addthesis" />
	<label>Thesis Title:</label>
	<input type="text" id="title" name="title" />
	<label>Abstract:</label>
	<textarea id="abstract" name="abstract"></textarea>
	<label>Scope and Limitation:</label>
	<textarea id="scope" name="scope"></textarea>
	<label>Year:</label>
	<input type="text" id="year" name="year" />
	<label>Category:</label>
	<input type="text" id="" name="" />
	<label>Thesis File (PDF Format):</label>
	<input type="file" id="" name="" />
	<label>System File:</label>
	<input type="file" id="" name="" />
</form>