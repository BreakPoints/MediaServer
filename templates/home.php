<?php
	use google\appengine\api\cloud_storage\CloudStorageTools;
	$options = ['gs_bucket_name' => $my_bucket];
	$upload_url = CloudStorageTools::createUploadUrl('/upload/handler', $options);
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
		<title>Media Server</title>
	</head>
	<body>
		<h1>Media Server</h1>
		
		{% if user %}
		<p>
			Welcome, {{ user.email() }}!
			You can <a href="{{ logout_url }}">sign out</a>.
		</p>
		
		<div id="explorer">
			{% include 'explorer.html' %}
		</div>
		
		<form action="{{ upload_url }}" enctype="multipart/form-data" method="post">
			Files to upload: <br>
			<input type="file" name="uploaded_files" size="40">
			<input type="submit" value="Send">
		</form>
		
		{% else %}
		<p>
			Welcome!
			<a href="{{ login_url }}">Sign in or register</a> to customize.
		</p>
		{% endif %}
		<p>The time is: {{ current_time }}</p>
	</body>
</html>
