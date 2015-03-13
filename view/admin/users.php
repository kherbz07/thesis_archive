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