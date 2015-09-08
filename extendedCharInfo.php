<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<style>
		</style>		
	</head>

<?php
$keyID = 2586734;
$vCode = "7h8rFneFEUNo9jRx9aQTQwz7TmY8ymsuKZ5EhVwsOgOg5RKOGuyYp5BVrV9wT1d1";

//API
$Account = "account/";
$Character = "char/";

//Account
$AccStatus = "AccountStatus.xml.aspx";
//$APIKeyInfo = "APIKeyInfo.xml.aspx";
$Characters = "Characters.xml.aspx";

//Account Status
$url = "https://api.eveonline.com/".$Account.$AccStatus."?keyID=".$keyID."&vCode=".$vCode."";
$xml = simplexml_load_file($url);
//echo ($xml);

echo "<table>";
echo "<tr>";
echo "<th>Current Date:</th>";
echo "<td>";
foreach ($xml->currentTime as $currentTime) {
	echo ($currentTime);
}
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Paid Until:</th>";
echo "<td>";
foreach ($xml->result->paidUntil as $paidUntil) {
	echo ($paidUntil);
}
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Account Creation Date:</th>";
echo "<td>";
foreach ($xml->result->createDate as $createDate) { 
	echo ($createDate);
}
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Times Logged In:</th>";
echo "<td>";
foreach ($xml->result->logonCount as $logonCount) {
	echo ($logonCount);
}
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Minutes Logged In:</th>";
echo "<td>";
foreach ($xml->result->logonMinutes as $logonMinutes) {
	echo ($logonMinutes);
}
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</br>";

//Account API Status
//WE DONT NEED THIS BULLSHIT

//Characters 
$url = "https://api.eveonline.com/".$Account.$Characters."?keyID=".$keyID."&vCode=".$vCode."";
$xml = simplexml_load_file($url);

	echo "<table>";
	echo "<th>Name</th>";	
	echo "<th>Corporation</th>";
	echo "<th>CharacterID</th>";
	echo "<th>CorporationID</th>";
foreach ($xml->result->rowset->row as $row) {
	$nameChar = $row{'name'};
	$nameCorp = $row{'corporationName'};
	$charID = $row{'characterID'};
	$corpID = $row{'corporationID'};
	$url = "https://api.eveonline.com/char/AccountBalance.xml.aspx?keyID=".$keyID."&vCode=".$vCode."&characterID=".$charID;

	echo "<tr>";

	echo "<td>";
	echo "<a href=".$url.">".$nameChar."</a>";
	echo "</td>";

	echo "<td>";
	echo $nameCorp;
	echo "</td>";

	echo "<td>";
	echo $charID;
	echo "</td>";

	echo "<td>";
	echo $corpID;
	echo "</td>";

	echo "</tr>";
}
echo "</table>";
echo "</br>";

$x = 'x';
echo '<a href="extendedCharInfo.php" target="_blank">Click me please</a>';

?>

	<body>	
		<form id="inputAPI">
			<input type="text" id="inputKeyId" value="2586734">
			<input type="text" id="inputVerCod" value="7h8rFneFEUNo9jRx9aQTQwz7TmY8ymsuKZ5EhVwsOgOg5RKOGuyYp5BVrV9wT1d1">
			<input type="submit" id="inputSub" value="Submit" onclick="validateInput(); return false;">
		</form>
		<div id="mydiv">
		</div>

		<script>
			function validateInput() {
				var x = document.getElementById('inputKeyId');
				var y = document.getElementById('inputVerCod');
				// Check the input key id
				if ( x.value != parseInt ( x.value ) ) {
					x.value = 'Key Id has to be digits only!';
					x.style.backgroundColor = "red";
				}
				else {
					if ( x.value.length != 7 ) {
						x.value = "Key Id should be 7 digits!";
						x.style.backgroundColor = "red";
					}
					else {
						x.style.backgroundColor = "green";
						var KeyID = x.value;	
					}
				}	
				// Check the input verification code
				if ( y.value.length != 64 ) {
					y.value = "The verification code should exist out of 64 numbers and letters!";
					y.style.backgroundColor = "red";
				}
				else {
					y.style.backgroundColor = "green";	
					var vCode = y.value;			
				}
				// if everything is cool, open it
				if ( ( x.style.backgroundColor == "green" ) && ( y.style.backgroundColor == "green" ) ) {
					loadPage( x, y );			
				}
				else {
				}
			}
			function loadPage( x, y ) {
				window.open( 'https://api.eveonline.com/account/Characters.xml.aspx?keyID=' + x.value + '&vCode=' + y.value, '_blank' );		
			}
		</script>
	</body>
</html>