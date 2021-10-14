<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Police Emergency Service System</title>
<link href="style.css" rel="stylesheet" type="text/css">
	
</head>

<body>
	<script>
		function yeojianhong()
		{
			var x=document.forms["frmLogCall"]["callerName"].value;
			if (x==null || x=="")
				
			{
				alert("Caller Name is required.");
				return false;
			}
			
		}
	
	
	</script>
	
	
	
<?php // import nav.php
	require_once 'nav.php';
?>
	
<?php // import db.php
	require_once 'db.php';
	
// Create connection
	$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE );
	// check connection
	if ($mysqli->connect_errno) 
	{
		die("Unable to connect to Database: " .$mysqli->connect_errno);
	}
	
	$sql = "SELECT * FROM incidenttype";
	
	if(!($stmt = $mysqli->prepare($sql)))
	{
		die("command errno: ".$mysqli->errno);
	}
	
	if (!$stmt->execute())
		
	{
		die("cannot run SQL command: ".$stmt->errno);
	}
	
	if(!($resultset = $stmt->get_result())) {
	die("No data in resultset: ".stmt->errno);
	}
	
	$incidentType;
	
	while ($row = $resultset->fetch_assoc()) {
		
$incidentType[$row['incidentTypeId']] = $row['incidentTypeDescription'];
	}
	
	$stmt->close();
	
	$resultset->close();
	
	$mysqli->close();
	
?>
	
	
	<fieldset>
		
	<legend>Log Call</legend>
		
	<form name="frmLogCall" method="post"
		  onSubmit="return yeojianhong();">
	
	<table width="40%" border="1" align="center" cellpadding="4" cellspacing="4">
		
		
	<tr>
	<td width="50%">Caller's Name :</td>
	<td width="50%"><input type="text" name="callerName" id="callerName"></td>
	</tr>
		
	<tr>
	<td width="50%">Contact No :</td>
	<td><input type="text" name="contactNo" id="contactNo"></td>
	</tr>
		
<tr>
	<td width="50%">Location :</td>
	<td><input type="text" name="location" id="location"></td>
	</tr>
		
	<td width="50%">Incident Type :</td>
		<td><select name="IncidentType" id="incidentType"> <?php foreach($incidentType as $key=> $value) {?>
		<option value="<?php echo $key?>" > <?php echo $value ?>
		</option>
			<?php } ?>
	</select>
	</td>
	</tr>
		
	<td width="50%">Description :</td>
		<td width="50%"><textarea name="incidentDesc" id="incidentDesc" cols="45" rows="5"></textarea>
	</td>
	</tr>
<tr>
		<td><input type="reset" name="cancelProcess" id="cancelProcess" value="Reset">
	</td>
	
		<td><input type="submit" name="btnProcessCall" id="btnProcessCall" value="Process Call"></td>
	</tr>
	</table>
	</form>
	</fieldset>
</body>
</html>