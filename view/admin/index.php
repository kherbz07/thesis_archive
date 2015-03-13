<h3>Admin Home Page</h3>
<a href="login.php?action=logout">Logout</a>
<hr/>
<table border=1>
	<thead>
		<tr>
			<th>Id</th>
			<th>Username</th>
			<th>Role</th>
			<th>First Name</th>
			<th>Middle Name</th>
			<th>Last Name</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($users as $user) : ?>
			<tr>
				<td><?= $user['id'] ?></td>
				<td><?= $user['username'] ?></td>
				<td><?= $user['role'] ?></td>
				<td><?= $user['first_name'] ?></td>
				<td><?= $user['middle_name'] ?></td>
				<td><?= $user['last_name'] ?></td>
				<td><button class="edit-btn">Edit</button></td>
			</tr>
		<?php endforeach ?>
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
		<option value="0">--Choose--</option>
		<option value="1">Administrator</option>
		<option value="2">Teacher</option>
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
	<label>New Password:</label>
	<input type="password" id="edit-pw" name="password" /><br/>
	<label>Role:</label>
	<select id="edit-role" name="role">
		<option value="0">--Choose--</option>
		<option value="1">Administrator</option>
		<option value="2">Teacher</option>
	</select><br/>
	<button type="submit">Edit User</button>
</form>
<hr/>
<table border=1>
	<thead>
		<tr>
			<th>Id</th>
			<th>Category</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($categories as $category) : ?>
			<tr>
				<td><?= $category['id'] ?></td>
				<td><?= $category['category'] ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>