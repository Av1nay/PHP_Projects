<?php
session_start();
?>
<html>
<head>
    <title>Please Login</title>
</head>
<body>
<?php include 'header.php' ?>
    <form method="post" action="movie1.php">
        <p>Enter Your Username:<input type="text" name="user"/> </p>
        <p>Enter Your Password:<input type="password" name="pass"/> </p>
        <p><input type="submit" name="submit" value="submit"/> </p>
    </form>
<?php include 'dev_info.php' ?>
</body>
</html>
