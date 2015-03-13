<h3>Teacher Home Page</h3>
<a href="login.php?action=logout">Logout</a>

<table border="1">
	<thead>
		<th>Title</th>
		<th>Abstract</th>
		<th>Scope and Limitations</th>
		<th>Academic Year</th>
		<th>Category</th>
		<th>PDF Path</th>
		<th>System Path</th>
		<th>Researchers</th>
		<th colspan="2">Action</th>

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
								<?php echo $researcher['first_name'].' '.$researcher['middle_name'].' '.$researcher['last_name'].' '.$researcher['course'].' '.$researcher['year']; ?>
							</li>
						<?php endforeach; ?>
						</ul>
					</td>
					<td>
						<button>Edit</button>
					</td>
					<td>
						
						<button>Delete</button>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>