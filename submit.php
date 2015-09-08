<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<style>
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
		</style>	
	</head>

	<body>
		<?php
			//GETs the KeyID and vCode from input form from previous page.
			$KeyID = $_GET["inputKeyID"];
			$vCode = $_GET["inputvCode"]; 

			//Creates the url to load later to check if it's a proper API Key.
			$url = "https://api.eveonline.com/account/Characters.xml.aspx?keyID=".$KeyID."&vCode=".$vCode."";

			if (!@$xml = simplexml_load_file($url)) {
				echo "FAILED!<br>Make sure you put in the correct API Keys!<br>";
				exit; 
			}
			else {
				echo "<table><tr><th>KeyID</th><td>".$KeyID."</td></tr>";
				echo "<tr><th>vCode</th><td>".$vCode."</td></tr></table><br>";
				//echo $url."<br>";
			}

			//Make table about information of all characters
			echo "<table>";
			echo "<th>Name</th>";
			echo "<th>Corporation</th>";
			echo "<th>CharacterID</th>";
			echo "<th>CorporationID</th>";
			echo "<th>AccountID</th>";
			echo "<th>AccountKey</th>";
			echo "<th>Balance</th>";
			echo "<th>Expires on, at </th>";

			//Step 1.1: Account Characters information; Name, Corp, CharID, CorpID.
			foreach ($xml->result->rowset->row as $row) {
				$nameChar = $row{'name'};
				$nameCorp = $row{'corporationName'};
				$charID = $row{'characterID'};
				$corpID = $row{'corporationID'};

				//Step 1.2: Account Wallet information; AccountID, AccountKey, Balance.
				//Creates the url1 to check for step 1.2 during the loop while it's checking for the characters set on the API key.
				$url1 = "https://api.eveonline.com/char/AccountBalance.xml.aspx?keyID=".$KeyID."&vCode=".$vCode."&characterID=".$charID;
				//echo $url1;

				//Every character gets it's own table row with the information in their own cells (td).
				echo "<tr>"; 

				//Step 1.1: Account Characters information; Name, Corp, CharID, CorpID.
				//Every information gets it's own table data (cell).
				echo "<td><a href=".$url." target='_blank'>".$nameChar."</a></td>"; //Names of character.
				echo "<td>".$nameCorp."</td>"; //Name of Corporation.
				echo "<td>".$charID."</td>"; //ID of character.
				echo "<td>".$corpID."</td>"; //ID of corporation.

				//Step 1.2: Account Wallet information; AccountID, AccountKey, Balance.
				//Checks the url1 if it can load, else it's not full API.
				if (!@$xml = simplexml_load_file($url1)) {
					echo "<td>No Wallet API</td>";
					echo "<td>No Wallet API</td>";
					echo "<td>No Wallet API</td>";
				}
				else {
					foreach ($xml->result->rowset->row as $row) {
						$accountID = $row{'accountID'};
						$accountKey = $row{'accountKey'};
						$balance = $row{'balance'}." ISK";

						//Step 1.2: Account Wallet information; AccountID, AccountKey, Balance.
						//Every information gets it's own table data (cell).				
						echo "<td>".$accountID."</td>";
						echo "<td>".$accountKey."</td>";
						echo "<td>".$balance."</td>";
					}	
				}

				//Step 1.3: Account Status information; CurrentTime, PaidUntil, CreateDate, LogonCount, LogonMinutes.
				//Checks the url2 if it can load, else it's not full API.
				$url2 = "https://api.eveonline.com/account/AccountStatus.xml.aspx?keyID=".$KeyID."&vCode=".$vCode;

				if (!@$xml = simplexml_load_file($url2)) {
					echo "failed!";
					exit;
				}
				else {
					foreach ($xml->result->paidUntil as $paidUntil) {
						echo "<td><a href=".$url2." target='_blank'>".$paidUntil."</a></td>"; 
					}	
					//Ends the row for each character's own information.
					echo "</tr>";
				}

			}
			//End of the table etc.
			echo "</table>";
			echo "</br>";	
		?>
	</body>
</html>