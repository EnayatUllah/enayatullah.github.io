<!DOCTYPE HTML >
<HTML>
   <HEAD>
      <TITLE>URL Shortener</TITLE>
   </HEAD>
   <BODY>
   <div align="center">
      <form action="index.php" method="post">
<b>URL to shorten: </b><input type="text" name="url"><br>
  
  <input type="submit">
</form>
</div>
<?php
$con=mysqli_connect("localhost","root","enayat","url_db");

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$n= $_SERVER['REQUEST_URI'];
$short_url= substr($n,1);
if($short_url==null ||$short_url=='index.php'||$_POST['url']!=null)
{
$to_shorten=$_POST['url'];

if($to_shorten!=null )
{
echo "Url to Shorten:  ".$to_shorten;
$shortened='abc';
echo "<br/>";
echo "Your Shortned Url:  " .$shortened;
mysqli_query($con,"INSERT INTO shorten (l_url,s_url)
VALUES ('$to_shorten','$shortened')");
}
}
else
{
$result = mysqli_query($con,"SELECT * FROM shorten
WHERE s_url='$short_url'");
echo mysqli_num_rows($result) ;
if(mysqli_num_rows($result) ==0)
{
echo "<h2>404 Not Found</h1>";
echo "Generate a new short url";
}
while($row = mysqli_fetch_array($result))
  {
   $long_url=$row['l_url'];
   header("Location: http://$long_url");
   exit();
  	
  }
}
mysqli_close($con);



?>
   </BODY>
</HTML>
