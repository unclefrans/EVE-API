<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php session_start(); ?>
		<style>
			input {
				display: block;
				width: 400px;
			}
			table, th, td, tr {
				border: 1px solid black;
				border-collapse: collapse;
				text-align: left;
				padding: 2px 5px 0px 5px; 
				margin: 0px;
			}
			table th {
				color: white;
				background-color: black;
			}
			#submitTable {
				display: block;
				border: hidden;
			}
			p {
				margin: 0px 0px 0px 5px;
				padding: 0px;
			}
		</style>	
	</head>

	<body>	
		<table id="submitTable">
			<form action="submit.php" method="GET">
				<th>KeyID:</th> 
				<tr><td>
				<input type="text" name="inputKeyID" id="inputKeyID" value="2586734">
				</td></tr>
				<th>vCode:</th> 
				<tr><td>
				<input type="text" name="inputvCode" id="inputvCode" value="7h8rFneFEUNo9jRx9aQTQwz7TmY8ymsuKZ5EhVwsOgOg5RKOGuyYp5BVrV9wT1d1">
				</td></tr>
				<tr><td>
				<input type="submit" value="Submit">
				</td></tr>			
			</form>
		</table>
		<p>Create your EVE API keys <a href="https://login.eveonline.com/Account/LogOn?ReturnUrl=%2foauth%2fauthorize%3fclient_id%3dwwwEVECommunity%26scope%3duser%2520developers%2520characterSearch%2520mail%26redirect_uri%3dhttps%3a%2f%2fcommunity.eveonline.com%2fSSOCallback.aspx%26response_type%3dcode&client_id=wwwEVECommunity&scope=user%20developers%20characterSearch%20mail&redirect_uri=https://community.eveonline.com/SSOCallback.aspx&response_type=code" target="_blank">here</a>.</p>
	</body>
</html>