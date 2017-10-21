<?php
  $word = $_POST["word"];
  $explanation = $_POST["explanation"];
  if ($word != "")
  {
    $link = mysql_connect("localhost", "", "") or die("Could not connect : " . mysql_error());
    mysql_select_db("vocabulary") or die("Could not select database");
    $sql = "SELECT word from word where word=\"$word\"";
    $result = mysql_query($sql);
    $try =  mysql_fetch_array($result)['word'];
    if ($try == "")
    {
      $sql = "INSERT INTO word(word,explaination) VALUES(\"$word\",\"$explanation\")";
      $result=mysql_query($sql);
      if ($result == '1') echo "Insert successfully!";
        else echo "Insert failed!";
    }
    else
    {
      $sql = "UPDATE word SET explaination = \"$explanation\", submission_date = CURRENT_TIMESTAMP WHERE word = \"$word\"";
      $result = mysql_query($sql);
      if ($result == '1') echo "Update successfully!";
        else echo "Update failed!";
    }
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GRE WORD</title>
<style type="text/css">
#apDiv1 {
 position:absolute;
 width:658px;
 height:308px;
 z-index:5;
 left: 100px;
 top: 196px;
}

#apDiv2 {
 position:absolute;
 width:500px;
 height:100px;
 z-index:6;
 left: 100px;
 top: -150px;
 font-size:50px;
 color:#000000;
}
#bj
{
 position:absolute;
 z-index:1;
 width:1345px;
 height:308px;
 left: 2px;
 top: -1px;
}
#result
{
 position:absolute;
 left: 800px;
  top: 50px;
}
</style>
</head>

<body>
<div id="bj">
<div id="apDiv1">

<div id = "poster">
    <form action = "spellword.php" method = "post">
    <table width = "586" border = "1"align="center" boardercolor="#000000">
      <tr>
        <td>Word:</td>
      </tr>
      <tr>
        <td><input type="text" name="word"/></td>
      </tr>
      <tr>
        <td>Explanation:<br>
      </tr>
      <tr>
        <td><textarea cols="65" rows="10" name="explanation"></textarea></td>
      </tr>
      <tr>
        <td><input type="submit" value="submit"/></td>
      </tr>
    </form>
</div>



<form action="spellword.php" method="post">

<table width="586" border="1" align="center" bordercolor="#000000">
  <tr>
    <td colspan="2">
      <center><h2>Please enter search requirements</h2></center>
    </td>
  </tr>
  <tr>
    <td width = "180">
      <h3>Word enter date:</h3>
    </td>
    <td>
      <input type = "text" name = "date" pattern = "(([0-9]{3}[1-9]|[0-9]{2}[1-9][0-9]{1}|[0-9]{1}[1-9][0-9]{2}|[1-9][0-9]{3})-(((0[13578]|1[02])-(0[1-9]|[12][0-9]|3[01]))|((0[469]|11)-(0[1-9]|[12][0-9]|30))|(02-(0[1-9]|[1][0-9]|2[0-8]))))|((([0-9]{2})(0[48]|[2468][048]|[13579][26])|((0[48]|[2468][048]|[3579][26])00))-02-29)" /> format: YYYY-MM-DD
    </td>
  </tr>
  <tr>
    <td>
      <h3>word</h3>
    </td>
    <td>
      <input type="text" name="search_word"/>
    </td>
  </tr>
  <tr>
    <td colspan="2"><center>
      <input type="submit" value="submit"/>
      &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="reset" value="reset"/>
    </center></td>
  </tr>
</table>
</form>
</div>
<div id="apDiv2"><strong>GRE WORD DATABASE</strong></div>
</div>
<div id = "result">
<?php
  $date = $_POST["date"];
  $search_word = $_POST["search_word"];
  if ($date!="")
  {
    echo "Search Result:<br>";
    echo "<pre>";
    $link = mysql_connect("localhost", "", "") or die("Could not connect : " . mysql_error());
    mysql_select_db("vocabulary") or die("Could not select database");
    $date = $date.'%';
    $sql = "SELECT * FROM word WHERE submission_date like \"$date\"";
    $result = mysql_query($sql);
    while($row = mysql_fetch_array($result))
    {
      echo $row['word'];
      echo "<br>&#9;";
      echo $row['explaination'];
      echo "<br>";
    }
  }
  else
  if ($search_word != "")
  {
    echo "Search Result:<br>";
    echo "<pre>";
    $link = mysql_connect("localhost", "", "") or die("Could not connect : " . mysql_error());
    mysql_select_db("vocabulary") or die("Could not select database");
    $sql = "SELECT * FROM word WHERE word = \"$search_word\"";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    echo $row['word'];
    echo "<br>&#9;";
    echo $row['explaination'];
    echo "<br>";
  }else
  {
    echo "Today's work:<br>";
    echo "<pre>";
    $link = mysql_connect("localhost", "", "") or die("Could not connect : " . mysql_error());
    mysql_select_db("vocabulary") or die("Could not select database");
    $today = date("Y-m-d");
    $today = $today.'%';
    $sql = "SELECT * FROM word WHERE submission_date like \"$today\"";
    $result = mysql_query($sql);
    while($row = mysql_fetch_array($result))
    {
      echo $row['word'];
      echo "<br>&#9;";
      echo $row['explaination'];
      echo "<br>";
    }
  }
  echo "</pre>";

?>
</div>
</body>
</html>
