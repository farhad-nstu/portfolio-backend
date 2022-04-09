<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
A person whose email address is {{ $data->email }} has interested to contact with you. Please let him to know about your timeline. <br>
He wrote this message to you "<span>{{ $data->message }}</span>"
<br>
Thank you!
</body>
</html>