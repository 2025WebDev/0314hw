<?php

require_once("core/api.php");

askForLogin();

?>
<html>
<head></head>

<body bgcolor="#4ACAD5">
<font face="微軟正黑體">
<?php renderHeader(); ?>
<form action="info.php" method="GET">

Please input your name:<input type="text" name="uName"><br>
Please input your password:<input type="password" name="uPwd"><br>
Please input your email:<input type="email" name="uEmail"><br>
Please select your color: <input type="color" name="uColor"><br>
Please select your age: <input type="number" name="uAge" min="25" max="60"><br>
Please select your birthday: <input type="date" name="uBirth"><br>
Please select how you like the webpage: <input type="range" name="uLike"><br>
<input type="hidden" name="uSecret" value="hahaha"><br>

Please select your gender:Male<input type="radio" name="uGender" value="male">
Female<input type="radio" name="uGender" value="female"><br>

Please select your interests:
Study<input type="checkbox" name="uInterest[]" value="study">
Sleep<input type="checkbox" name="uInterest[]" value="sleep">
Game<input type="checkbox" name="uInterest[]" value="game">
<br>
Please select your city:
<select name="uCity">
<option value="taipei">Taipei</option>
<option value="taichung">Taichung</option>
<option value="kaohsiung">Kaohsiung</option>
</select>
Please input your comments:
<textarea cols="30" rows="10" name="uComment">
</textarea>

<br><input type="submit"><input type="reset">


</form>
</font>
</body>
</html>