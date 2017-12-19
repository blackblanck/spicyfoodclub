

<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{

echo "<script type='text/javascript'>window.top.location='index.php';</script>";
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>