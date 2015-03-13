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
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<hr/>
<h4>Add New User</h4>
<form acton="admin.php" method="POST">
	<label>First Name:</label>
	<input type="text" id="" name="" />
	<label>Middle Name:</label>
	<input type="text" id="" name="" />
	<label>Last Name:</label>
	<input type="text" id="" name="" />
	<label>Userame:</label>
	<input type="text" id="" name="" />
	<label>Password:</label>
	<input type="text" id="" name="" />
	<label>Role:</label>
	
	<button type="submit">Add User</button>
</form>