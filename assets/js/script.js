$(function() {
	$('.edit-btn').click(function() {
		$row = $(this).parent().parent();
		$('#edit-ui').val($row.find('td').eq(0).text());
		$('#edit-fn').val($row.find('td').eq(5).text());
		$('#edit-mn').val($row.find('td').eq(6).text());
		$('#edit-ln').val($row.find('td').eq(7).text());
		$('#edit-un').val($row.find('td').eq(1).text());
		$('#edit-pw').val($row.find('td').eq(2).text());
		$('#edit-role').val($row.find('td').eq(3).text());
	});
});