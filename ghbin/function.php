<?php
	// include_once 'db_conn.php';

	function poop(){
		echo 'poop';
	}

	// Connect to the Magma MySQL Database
	function connect_magma(){
		require_once 'db_conn.php';
		$DB_ERROR1 = "Could not connect to our database";
		$DB_ERROR2 = "Could not find selected table";

		// Create connection
		// conn = new mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD) or die ($DB _ERROR1);

		$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die($DB_ERROR1);
		mysqli_select_db($conn,DB_MAGMA) or die ($DB_ERROR2);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		return $conn;
	}

	// Connect to the Joomla MySQL Database
	function connect_joomla(){
		require_once 'db_conn.php';
		$DB_ERROR1 = "Could not connect to our database";
		$DB_ERROR2 = "Could not find selected table";

		// Create connection
		// conn = new mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD) or die ($DB _ERROR1);

		$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die($DB_ERROR1);
		mysqli_select_db($conn,DB_JOOMLA) or die ($DB_ERROR2);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		return $conn;
	}

	// Close the connection to the Magma MySQL Database
	function close_magma(){
		mysqli_close();
	}

	// Close the connection to the Joomla MySQL Database
	function close_joomla(){
		mysqli_close();
	}

	// This function will pull the "veiwSeriesId" out of the URL and return the value.
	function grabSeries(){
		$series = $_GET['viewSeriesId'];

		if ($series == 0){
			$series = "all";
		}
		return $series;
	}

	// This function will pull the "veiwShowId" out of the URL and return the value.
	function grabShow(){
		$show = $_GET['viewShowId'];

		if ($show == 0){
			$show = "all";
		}
		return $show;
	}

	// This function will pull the "shotId" out of the URL and return the value.
	function grabShot(){
		$shot = $_GET['shotId'];
		return $show;
	}

	// This function will pull the "viewDivisionOptionsId" out of the URL and return the value.
	function grabDivision(){
		$division = $_GET['viewDivisionOptionsId'];

		if ($division == 0){
			$division = "all";
		}
		return $division;
	}

	// This function will pull the "viewSkillOptionsId" out of the URL and return the value.
	function grabSkill(){
		$skill = $_GET['viewSkillOptionsId'];

		if ($skill == 0){
			$skill = "all";
		}
		return $skill;
	}

	// This function will pull the "viewArtistId" out of the URL and return the value.	
	function grabArtist(){
		$artist = $_GET['viewArtistId'];

		if ($artist == 0){
			$artist = "all";
		}
		return $artist;
	}

	// This function will pull the "viewAssignmentStatusId" out of the URL and return the value.
	function grabStatus(){
		$status = $_GET['viewAssignmentStatusId'];

		if ($status == 0){
			$status = "all";
		}
		return $status;
	}

	// Function to allow for the updating of the database from all pages on the site.  A passed value defines the operation needed.
	function updateDB($updateDB){
		// updateDB:1 = assignment priority
		// updateDB:2 = assignment status
		// updateDB:3 = skill
		// updateDB:4 = ease
		// updateDB:5 = accept assignment
		// updateDB:6 = release assignment
		// updateDB:7 = complete assignment
		// updateDB:8 = assignment ready for review 
		// updateDB:9 = update assignment description
		// updateDB:10 = update shot description and frame ranges
		// updateDB:11 = update element description
		// updateDB:12 = update existing series
		// updateDB:13 = create new series
		// updateDB:14 = update existing show
		// updateDB:15 = create new show
		// updateDB:15 = update existing shot
		// updateDB:16 = create new shot

		//$updateDB = $_GET['updateDB'];

		// echo "running updateDB";
		if($updateDB > 0){
			$seriesId = $_GET['seriesId'];
			$showId = $_GET['showId'];

			if($updateDB == 1)
			{
				$assignmentId = $_GET['assignmentId'];
				// echo "assignmenId is ". $assignmentId;
				$assignmentPriority = $_GET['assignmentPriority'];
				// echo "assignmentPriority is " . $assignmentPriority;
				$sql = "UPDATE assignmentTable SET assignmentPriority = '$assignmentPriority' WHERE assignmentId = '$assignmentId'";
			} else if($updateDB == 2) {
				$assignmentId = $_GET['assignmentId'];
				// echo "assignmenId is ". $assignmentId;
				$assignmentStatusId = $_GET['assignmentStatusId'];
				// echo "assignmentStatusId is " . $assignmentStatusId;
				if ($assignmentStatusId == 0){
					$sql = "UPDATE assignmentTable SET assignmentStatusId = '$assignmentStatusId', assignmentPriority = 100 WHERE assignmentId = '$assignmentId'";
				} else {
					$sql = "UPDATE assignmentTable SET assignmentStatusId = '$assignmentStatusId' WHERE assignmentId = '$assignmentId'";
				}
			} else if($updateDB == 3) {
				$assignmentId = $_GET['assignmentId'];
				// echo "assignmenId is ". $assignmentId;
				$skillOptionsId = $_GET['skillOptionsId'];
				// echo "skillOptionsId is " . $skillOptionsId;
				$sql = "UPDATE assignmentTable SET skillOptionsId = '$skillOptionsId' WHERE assignmentId = '$assignmentId'";
			} else if($updateDB == 4) {
				$assignmentId = $_GET['assignmentId'];
				// echo "assignmenId is ". $assignmentId;
				$easeOptionsId = $_GET['easeOptionsId'];
				// echo "easeOptionsId is " . $easeOptionsId;
				$sql = "UPDATE assignmentTable SET easeOptionsId = '$easeOptionsId' WHERE assignmentId = '$assignmentId'";
			} else if($updateDB == 5) {
				$assignmentId = $_GET['assignmentId'];
				// echo "assignmenId is ". $assignmentId;
				$sessionUserId = $_GET['sessionUserId'];
				// echo "sessionUserId is " . $sessionUserId;
				$sql = "UPDATE assignmentTable SET userId = '$sessionUserId', assignmentStatusId = 2 WHERE assignmentId = '$assignmentId'";
			} else if($updateDB == 6) {
				$assignmentId = $_GET['assignmentId'];
				echo "assignmenId is ". $assignmentId;
				$sessionUserId = $_GET['sessionUserId'];
				// echo "sessionUserId is " . $sessionUserId;
				$sql = "UPDATE assignmentTable SET assignmentStatusId = 1  WHERE assignmentId = '$assignmentId'";
			} else if($updateDB == 7) {
				$assignmentId = $_GET['assignmentId'];
				echo "assignmenId is ". $assignmentId;
				// $sessionUserId = $_GET['sessionUserId'];
				// echo "sessionUserId is " . $sessionUserId;
				$sql = "UPDATE assignmentTable SET assignmentStatusId = 0,assignmentPriority = 100 WHERE assignmentId = '$assignmentId'";
			} else if($updateDB == 8) {
				$assignmentId = $_GET['assignmentId'];
				echo "assignmenId is ". $assignmentId;
				// $sessionUserId = $_GET['sessionUserId'];
				// echo "sessionUserId is " . $sessionUserId;
				$sql = "UPDATE assignmentTable SET assignmentStatusId = 3 WHERE assignmentId = '$assignmentId'";


			} else if($updateDB == 9) {
				$assignmentId = $_GET['assignmentId'];
				echo "assignmenId is ". $assignmentId;
				$assignmentDescription = $_GET['assignmentDescription'];
				// echo "sessionUserId is " . $sessionUserId;
				$sql = "UPDATE assignmentTable SET assignmentDescription = '$assignmentDescription' WHERE assignmentId = '$assignmentId'";
			} else if($updateDB == 10) {
				# $seriesId = $_GET['seriesId'];
				# $showId = $_GET['showId'];
				$shotId = $_GET['shotId'];
				$shotDescription = $_GET['shotDescription'];
				$startFrame = $_GET['startFrame'];
				$endFrame = $_GET['endFrame'];
				// echo "sessionUserId is " . $sessionUserId;
				$sql = "UPDATE shotTable SET shotDescription = '$shotDescription', startFrame = '$startFrame', endFrame = '$endFrame' WHERE shotId = '$shotId'";
			} else if($updateDB == 11) {
				# $seriesId = $_GET['seriesId'];
				# $showId = $_GET['showId'];
				$elementId = $_GET['elementId'];
				$elementDescription = $_GET['elementDescription'];
				$sql = "UPDATE elementTable SET elementDescription = '$elementDescription' WHERE elementId = '$elementId'";
			} else if($updateDB == 12) {
				$seriesId = $_GET['seriesId'];
				// echo "seriesId is " . $seriesId;
				$seriesTitle = $_GET['seriesTitle'];
				$seriesCode = $_GET['seriesCode'];
				$seriesNumber = $_GET['seriesNumber'];
				$seriesDescription = $_GET['seriesDescription'];
				$seriesCode = $_GET['seriesCode'];
				$resolutionWidth = $_GET['resolutionWidth'];
				$resolutionHeight = $_GET['resolutionHeight'];
				$aspectRatioId = $_GET['aspectRatioId'];
				$framesPerSecondId = $_GET['framesPerSecondId'];
				$unitOfMeasurementId = $_GET['unitOfMeasurementId'];
				$handles = $_GET['handles'];
				$seriesStatus = $_GET['seriesStatus'];
				$sql = "UPDATE seriesTable SET seriesTitle = '$seriesTitle', seriesCode = '$seriesCode', seriesNumber = '$seriesNumber', seriesDescription = '$seriesDescription', resolutionWidth = '$resolutionWidth', resolutionHeight = '$resolutionHeight', aspectRatioId = '$aspectRatioId', framesPerSecondId = '$framesPerSecondId', unitOfMeasurementId = '$unitOfMeasurementId', handles = '$handles', seriesStatus = '$seriesStatus' WHERE seriesId = '$seriesId'";
			} else if($updateDB == 13) {
				$seriesId = "";
				$seriesTitle = $_GET['seriesTitle'];
				$seriesCode = $_GET['seriesCode'];
				$seriesNumber = $_GET['seriesNumber'];
				$seriesDescription = $_GET['seriesDescription'];
				$seriesCode = $_GET['seriesCode'];
				$resolutionWidth = $_GET['resolutionWidth'];
				$resolutionHeight = $_GET['resolutionHeight'];
				$aspectRatioId = $_GET['aspectRatioId'];
				$framesPerSecondId = $_GET['framesPerSecondId'];
				$unitOfMeasurementId = $_GET['unitOfMeasurementId'];
				$handles = $_GET['handles'];
				$seriesStatus = $_GET['seriesStatus'];
				$sql = "INSERT INTO seriesTable (seriesTitle,seriesCode,seriesNumber,seriesDescription,resolutionWidth,resolutionHeight,aspectRatioId,framesPerSecondId,unitOfMeasurementId,handles,seriesStatus) VALUES ('$seriesTitle','$seriesCode',
'$seriesNumber','$seriesDescription','$resolutionWidth','$resolutionHeight','$aspectRatioId','$framesPerSecondId','$unitOfMeasurementId','$handles','$seriesStatus')";
			} else if($updateDB == 14) {
				$seriesId = $_GET['seriesId'];
				$seriesNumber = $_GET['seriesNumber'];
				$showNumber = $_GET['showNumber'];
				$showTitle = $_GET['showTitle'];
				$showDescription = $_GET['showDescription'];
				$showId = $_GET['showId'];
				$sql = "UPDATE showTable SET showTitle = '$showTitle', showNumber = '$showNumber', showDescription = '$showDescription' WHERE showId = '$showId'";
			} else if($updateDB == 15) {
				$seriesId = $_GET['seriesId'];
				$seriesNumber = $_GET['seriesNumber'];
				$showNumber = $_GET['showNumber'];
				$showTitle = $_GET['showTitle'];
				$showDescription = $_GET['showDescription'];
				// $showId = $_GET['showId'];
				$sql = "INSERT INTO showTable (seriesId,seriesNumber,showNumber,showTitle,showDescription) VALUES ('$seriesId','$seriesNumber','$showNumber','$showTitle','$showDescription')";
			} else if($updateDB == 16) {
				$showId = $_GET['showId'];
				$projectName = $_GET['projectName'];
				$shotId = $_GET['shotId'];
				$shotName = $_GET['shotName'];
				$shotDescription = $_GET['shotDescription'];
				$startFrame = $_GET['startFrame'];
				$endFrame = $_GET['endFrame'];
				$projectId = $_GET['projectId'];
				$sql = "UPDATE shotTable SET showId = '$showId', projectName = '$projectName', shotName = '$shotName', shotDescription = '$shotDescription', startFrame = '$startFrame', endFrame = '$endFrame', projectId = '$projectId' WHERE shotId = '$shotId'";
			} else if($updateDB == 17) {
				$showId = $_GET['showId'];
				$projectName = $_GET['projectName'];
				$shotName = $_GET['shotName'];
				$shotDescription = $_GET['shotDescription'];
				$startFrame = $_GET['startFrame'];
				$endFrame = $_GET['endFrame'];
				$projectId = $_GET['projectId'];
				$sql = "INSERT INTO shotTable (showId,projectName,shotName,shotDescription,startFrame,endFrame,projectId) VALUES ('$showId','$projectName','$shotName','$shotDescription','$startFrame','$endFrame','$projectId')";
			} else if($updateDB == 18) {
				$showId = $_GET['showId'];
				$projectName = $_GET['projectName'];
				$elementId = $_GET['elementId'];
				$elementName = $_GET['elementName'];
				$elementDescription = $_GET['elementDescription'];
				$projectId = $_GET['projectId'];
				$sql = "UPDATE elementTable SET showId = '$showId', elementName = '$elementName', elementDescription = '$elementDescription', projectId = '$projectId' WHERE elementId = '$elementId'";
			} else if($updateDB == 19) {
				$showId = $_GET['showId'];
				$projectName = $_GET['projectName'];
				$elementName = $_GET['elementName'];
				$elementDescription = $_GET['elementDescription'];
				$projectId = $_GET['projectId'];
				$sql = "INSERT INTO elementTable (showId,elementName,elementDescription,projectId) VALUES ('$showId','$elementName','$elementDescription','$projectId')";
			}

			$conn = connect_magma();

			if ($conn->query($sql) === TRUE)
			{
				echo "<h3>Database Command Processed!</h3><hr>";
			} else {
				echo "ERROR: " . $sql . "<br>" . $conn->error;
			}

			if($updateDB >= 1 && $updateDB < 5){

				$series = grabSeries();
				$show = grabShow();
				$division = grabDivision();
				$skill = grabSkill();
				$status = grabArtist();
				$status = grabStatus();

				header("Refresh:0; url=http://galaxy.grasshorse.com/index.php/magma?viewSeriesId=" . $series . "&viewShowId=" . $show . "&viewDivisionOptionsId=" . $division . "&viewSkillOptionsId=" . $skill . "&viewArtistId=" . $artist . "&viewAssignmentStatusId=" . $status);
			} else if ($updateDB == 5){
				header("Refresh:0; url=http://galaxy.grasshorse.com/index.php/assignment?assignmentId=" . $assignmentId);
			} else if ($updateDB == 10){
				header("Refresh:0; url=http://galaxy.grasshorse.com/index.php/shot?seriesId=" . $seriesId . "&showId=" . $showId . "&shotId=" . $shotId);
			} else if ($updateDB == 11){
				header("Refresh:0; url=http://galaxy.grasshorse.com/index.php/element?seriesId=" . $seriesId . "&showId=" . $showId . "&elementId=" . $elementId);
			}

			close_magma();

			// echo "database has been updated";
		}
	}

	// This function assigns the input variable $series to a hidden text field.
	function hiddenSeries($series){
		echo "<input type='text' name='viewSeriesId' value='$series' style='display:none'></input>";
	}

	// This function assigns the input variable $show to a hidden text field.
	function hiddenShow($show){
		echo "<input type='text' name='viewShowId' value='$show' style='display:none'></input>";
	}

	// This function assigns the input variable $division to a hidden text field.
	function hiddenDivision($division){
		echo "<input type='text' name='viewDivisionOptionsId' value='$division' style='display:none'></input>";
	}

	// This function assigns the input variable $skill to a hidden text field.
	function hiddenSkill($skill){
		echo "<input type='text' name='viewSkillOptionsId' value='$skill' style='display:none'></input>";
	}

	// This function assigns the input variable $artist to a hidden text field.
	function hiddenArtist($artist){
		echo "<input type='text' name='viewArtistId' value='$artist' style='display:none'></input>";
	}

	// This function assigns the input variable $status to a hidden text field.
	function hiddenStatus($status){
		echo "<input type='text' name='viewAssignmentStatusId' value='$status' style='display:none'></input>";
	}

	// Function returns cellColor when the assignmentStatusId is passed into it.
	function getCellColor($assignmentStatusId){
		if($assignmentStatusId == 0){
			// DONE
			$cellColor = "bgcolor='PaleGreen'";
		} else if ($assignmentStatusId == 1){
			// TODO
			$cellColor = "bgcolor='Tomato'";
		} else if ($assignmentStatusId == 2){
			// In Progress
			$cellColor = "bgcolor='ffd966'";
		} else if ($assignmentStatusId == 3){
			//Ready for Review
			$cellColor = "bgcolor='Plum'";
		} else if ($assignmentStatusId == 4){
			//Needs Revision
			$cellColor = "bgcolor='ff9900'";
		} else if ($assignmentStatusId == 5){
			//In Revision
			$cellColor = "bgcolor='ffd966'";
		} else if ($assignmentStatusId == 6){
			//Omit
			$cellColor = "bgcolor='LightSteelBlue'";
		} else if ($assignmentStatusId == 7){
			//On Hold
			$cellColor = "bgcolor='Silver'";
		} else {
			$cellColor = "bgcolor='SkyBlue'";
		}

		return $cellColor;
	}

	// Function returns seriesNumber when the seriesId is passed into it.
	function getSeriesNumber($seriesId){
		$conn = connect_magma();
		//echo "running getSeriesNumber";

		$sql = "SELECT seriesNumber FROM seriesTable WHERE seriesId = " . $seriesId;
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
			while($row = $result->fetch_assoc()){
				$seriesNumber = sprintf("%04d", $row["seriesNumber"]);
				// echo "seriesNumber is " . $seriesNumber;
			}
		close_magma();
		return $seriesNumber;
	}


	// Function returns seriesCode when the seriesId is passed into it.
	function getSeriesCode($seriesId){

		$conn = connect_magma();
		echo "running getSeriesCode";

		$sql = "SELECT seriesCode FROM seriesTable WHERE seriesId = " . $seriesId;
		$result = $conn->query($sql);


		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$seriesCode = $row["seriesCode"];
				echo "seriesCode is " . $seriesCode;
			}
		}
		close_magma();
		return $seriesCode;
	}

	function getHighestSeriesNumber(){
		$conn = connect_magma();

		$sql = "SELECT MAX(seriesNumber) AS highestSeries FROM seriesTable";
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc()){
			$seriesNumber = sprintf("%04d", $row["highestSeries"]);
			}
		}
		close_magma();
		return $seriesNumber;
	}

	function getHighestShowNumber($seriesId){
		$conn = connect_magma();

		$sql = "SELECT MAX(showNumber) AS highestShow FROM showTable WHERE seriesId = " . $seriesId;
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc()){
			$showNumber = sprintf("%03d", $row["highestShow"]);
			}
		}
		close_magma();
		return $showNumber;
	}

	// Function returns showNumber when the showId is passed into it.
	function getShowNumber($showId){
		$conn = connect_magma();

		$sql = "SELECT showNumber FROM showTable WHERE showId = " . $showId;
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
			while($row = $result->fetch_assoc()){
				$showNumber = sprintf("%03d", $row["showNumber"]);
				// echo "showNumber is " . $showNumber;
			}
		close_magma();
		return $showNumber;
	}

	// Function returns shotName when the shotId is passed into it.
	function getShotName($shotId){
		$conn = connect_magma();

		$sql = "SELECT shotName FROM shotTable WHERE shotId = " . $shotId;
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
			while($row = $result->fetch_assoc()){
				$shotName = $row["shotName"];
				// echo "shotName is " . $shotName;
			}
		close_magma();
		return $shotName;
	}

	// Function returns elementName when the elementId is passed into it.
	function getElementName($elementId){
		$conn = connect_magma();

		$sql = "SELECT elementName FROM elementTable WHERE elementId = " . $elementId;
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
			while($row = $result->fetch_assoc()){
				$elementName = $row["elementName"];
				// echo "elementName is " . $elementName;
			}
		close_magma();
		return $elementName;
	}

	// Function returns divisionName when the divisionOptionsId is passed into it.
	function getDivisionName($divisionOptionsId){
		$conn = connect_magma();

		$sql = "SELECT divisionName FROM divisionOptionsTable WHERE divisionOptionsId = " . $divisionOptionsId;
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
			while($row = $result->fetch_assoc()){
				$divisionName = $row["divisionName"];
				// echo "divisionName is " . $divisionName;
			}
		close_magma();
		return $divisionName;
	}

	// Function returns divisionCode when the divisionOptionsId is passed into it.
	function getDivisionCode($divisionOptionsId){
		$conn = connect_magma();

		$sql = "SELECT divisionCode FROM divisionOptionsTable WHERE divisionOptionsId = " . $divisionOptionsId;
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
			while($row = $result->fetch_assoc()){
				$divisionCode = $row["divisionCode"];
				// echo "divisionCode is " . $divisionCode;
			}
		close_magma();
		return $divisionCode;
	}

	// Function returns skillOptions when the skillOptionsId is passed into it.
	function getSkill($skillOptionsId){
		$conn = connect_magma();

		$sql = "SELECT skillOptions FROM skillOptionsTable WHERE skillOptionsId = " . $skillOptionsId;
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
			while($row = $result->fetch_assoc()){
				$skillOptions = $row["skillOptions"];
				// echo "skillOptions is " . $skillOptions;
			}
		close_magma();
		return $skillOptions;
	}

	// Function returns easeOptions when the easeOptionsId is passed into it.
	function getEase($easeOptionsId){
		$conn = connect_magma();

		$sql = "SELECT easeOptions FROM easeOptionsTable WHERE easeOptionsId = " . $easeOptionsId;
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
			while($row = $result->fetch_assoc()){
				$easeOptions = $row["easeOptions"];
				// echo "easeOptions is " . $easeOptions;
			}
		close_magma();
		return $easeOptions;
	}

	// Function returns assignmentStatus when assignmentStatusId is passed into it.
	function getAssignmentStatus($assignmentStatusId){
		$conn = connect_magma();

		$sql = "SELECT assignmentStatus FROM assignmentStatusOptionsTable WHERE assignmentStatusId = " . $assignmentStatusId;
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
			while($row = $result->fetch_assoc()){
				$assignmentStatus = $row["assignmentStatus"];
				// echo "assignmentStatus is " . $assignmentStatus;
			}
		close_magma();
		return $assignmentStatus;
	}
	
	// Function that returns a user's username when userId is passed into it.
	function getUserName($userId){
		$conn = connect_joomla();
		
		$sql = "SELECT username FROM yoznp_users WHERE id = " . $userId;
		$result = $conn->query($sql);
		
		// $userName = "poop";
				
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$userName = $row["username"];
			}
		}
		
		// echo $userName;
		close_joomla();
		
		return $userName;
	}
	
	// Function that returns the authentication value of a user.
	function getUserAuthentication($userId,$authenticationLevel){
		$conn = connect_joomla();
		
		$sql = "SELECT group_id FROM yoznp_user_usergroup_map WHERE user_id = " . $userId;
		$result = $conn->query($sql);
		
		// echo "<p>Your usedId is " . $userId . "</p>";
		
		// Current User Group Levels
		
		// Public: id=1
		// Registered: id=2
		// Author: id=3
		// Editor: id=4
		// Publisher: id=5
		// Manager:id=6
		// Administrator:id=7
		// Super Users:id=8
		// Guest:id=9

		$authentication = 0;
		
		if ($result->num_rows > 0){
			
			while($row = $result->fetch_assoc()){
				$groupId = $row["group_id"];
				
				// echo ("groupId is " . $groupId . "</p>");
				// echo ("authenticationLevel is " . $authenticationLevel . "</p>");
				if($authenticationLevel <= $groupId && $authenticationLevel < 9){
					$authentication = 1;
					// echo "<p>You are authenticated!</p>";
				}// else {
					//echo "<p>You are not authenticated.</p>";
				//}
			}
			
			// $authentication = 1;
		}
		close_joomla();
		return $authentication;
	}
	
	// This simply prints out the current users user_id
	function getUserId(){
		$user =& JFactory::getUser();
		$user_id = $user->get('id');
		// echo "userId is " . $user_id;
		return $user_id;
	}
	
	// Function returns aspectRatio when passed an aspectRatioId.
	function getAspectRatio($aspectRatioId){
		$conn = connect_magma();
		
		$sql3 = "SELECT * FROM aspectRatioTable";			
		$result3 = $conn->query($sql3);
		
		if ($result3->num_rows > 0) {
			while($row3 = $result3->fetch_assoc()) {
				if ($aspectRatioId == $row3["aspectRatioId"]) {
					$aspectRatio = $row3["aspectRatio"];
				}
			}			
		} else {
			$aspectRatio = "ERROR: Aspect Ratio query has 0 results";
		}
		close_magma();
		return $aspectRatio;
	}
	
	// Function returns framesPerSecond when passed an framesPerSecondId.
	function getFramesPerSecond($framesPerSecondId){
		$conn = connect_magma();
		
		$sql4 = "SELECT * FROM framesPerSecondTable";			
		$result4 = $conn->query($sql4);
		
		if ($result4->num_rows > 0) {
			while($row4 = $result4->fetch_assoc()) {
				if ($framesPerSecondId == $row4["framesPerSecondId"]) {
					$framesPerSecond = $row4["framesPerSecond"];
				}
			}			
		} else {
			$framesPerSecond = "ERROR: Frames Per Second query has 0 results";
		}
		close_magma();
		return $framesPerSecond;
	}
	
	// This is used on the create assignment page.	
	function queueDropdown(){
		$series = grabSeries();
		$show = grabShow();
		$division = grabDivision();
		$skill = grabSkill();
		$status = grabArtist();
		$status = grabStatus();
		
		$conn = connect_magma();
		$conn2 = connect_joomla();
		
		// if ($seriesId > 0)
		// {
		// Series Dropdown
		// echo "seriesId has a value and it is " . $seriesId;
		// } else {
		$sql = "SELECT * FROM divisionOptionsTable WHERE divisionCategoryId = 1 OR divisionCategoryId = 2 OR divisionCategoryId = 13 ORDER BY divisionName ASC";
		$result = $conn->query($sql);
		
		$sql2 = "SELECT * FROM skillOptionsTable ORDER BY skillOptionsId ASC";
		$result2 = $conn->query($sql2);
		
		$sql3 = "SELECT * FROM assignmentStatusOptionsTable ORDER BY assignmentStatus ASC";
		$result3 = $conn->query($sql3);
		
		$sql4 = "SELECT * FROM yoznp_users ORDER BY username ASC";
		$result4 = $conn2->query($sql4);
		
		$sql5 = "SELECT * FROM seriesTable ORDER BY seriesTitle ASC";
		$result5 = $conn->query($sql5);
		
		if ($series == 'all'){
			$sql6 = "SELECT * FROM showTable ORDER BY showTitle ASC";
		} else {
			$sql6 = "SELECT * FROM showTable WHERE seriesId = " . $series . " ORDER BY showTitle ASC";			
		}
		$result6 = $conn->query($sql6);
		
		// echo "<form action='./magma?divisionName=1'>";
		// echo "<select name='divisionOptionsId' onchange='this.form.submit()';>";
		
		echo "<table><tr>";
		echo "<td><h5>Series</h5></td>";
		echo "<td><h5>Show</h5></td>";
		echo "<td></td><td></td></tr>";
		
		
		// Series Select
		echo "<td><form action='./magma?viewSeriesId=1'><select name='viewSeriesId' onchange='this.form.submit()'>";
		echo "<option value='all'>All</option>";
		while($row5 = $result5->fetch_assoc()) {
			$seriesId = $row5['seriesId'];
			if ($series == $seriesId){
				echo "<option selected='selected' value='" . $seriesId . "'>";
			} else {
				echo "<option value='" . $seriesId . "'>";
			}
			echo $row5['seriesTitle'] . "</option>";
		}
		echo "</select>";
		// Hidden Values
		
		hiddenShow($show);
		hiddenDivision($division);
		hiddenSkill($skill);
		hiddenArtist($artist);
		hiddenStatus($status);

		echo "</form></td>";
		
		// Show Select
		echo "<td><form action='./magma?viewShowId=1'><select name='viewShowId' onchange='this.form.submit()'>";
		echo "<option value='all'>All</option>";
		while($row6 = $result6->fetch_assoc()) {
			$showId = $row6['showId'];
			if ($show == $showId){
				echo "<option selected='selected' value='" . $showId . "'>";
			} else {
				echo "<option value='" . $showId . "'>";
			}
			echo $row6['showTitle'] . "</option>";
		}
		echo "</select>";
		// Hidden Values
		
		hiddenSeries($series);
		// hiddenShow($show);
		hiddenDivision($division);
		hiddenSkill($skill);
		hiddenArtist($artist);
		hiddenStatus($status);

		echo "</form></td>";
		
		
		echo "</tr><tr>";
		
		echo "<td><h5>Division</h5></td>";
		echo "<td><h5>Skill</h5></td>";
		echo "<td><h5>Artist</h5></td>";
		echo "<td><h5>Status</h5></td></tr>";
		
		// Division Select
		echo "<td><form action='./magma?viewDivisionOptionsId=1'><select name='viewDivisionOptionsId' onchange='this.form.submit()'>";
		// "<select style=width:110px name='easeOptionsId' onchange='this.form.submit()'>";
		echo "<option value='all'>All</option>";
		while($row = $result->fetch_assoc()) {
			$divisionOptionsId = $row['divisionOptionsId'];
			if ($division == $divisionOptionsId){
				echo "<option selected='selected' value='" . $divisionOptionsId . "'>";
			} else {
				echo "<option value='" . $divisionOptionsId . "'>";
			}
			echo $row['divisionName'] . "</option>";
		}
		echo "</select>";
		// Hidden Values
		hiddenSeries($series);
		hiddenShow($show);
		hiddenSkill($skill);
		hiddenArtist($artist);
		hiddenStatus($status);

		echo "</form></td>";
		
		// Skill Select
		echo "<td><form action='./magma?viewSkillOptionsId=1'><select name='viewSkillOptionsId' onchange='this.form.submit()'>";
		echo "<option value='all'>All</option>";
		while($row2 = $result2->fetch_assoc()) {
			$skillOptionsId = $row2['skillOptionsId'];
			if ($skill == $skillOptionsId){
				echo "<option selected='selected' value='" . $skillOptionsId . "'>";
			} else {
				echo "<option value='" . $skillOptionsId . "'>";
			}
			echo $row2['skillOptions'] . "</option>";
		}
		echo "</select>";
		
		// Hidden Values
		hiddenSeries($series);
		hiddenShow($show);
		hiddenDivision($division);
		hiddenArtist($artist);
		hiddenStatus($status);
		echo "</form></td>";
		
		
		// Artist Select
		echo "<td><form action='./magma?viewArtistId=1'><select name='viewArtistId' onchange='this.form.submit()'>";
		echo "<option value='all'>All</option>";
		while($row4 = $result4->fetch_assoc()) {
			$artistId = $row4['id'];
			if ($artist == $artistId){
				echo "<option selected='selected' value='" . $artistId . "'>";
			} else {
				echo "<option value='" . $artistId . "'>";
			}
			echo $row4['username'] . "</option>";
		}
		
		echo "</select>";
		// Hidden Values
		hiddenSeries($series);
		hiddenShow($show);
		hiddenDivision($division);
		hiddenSkill($skill);
		hiddenStatus($status);
		echo "</form></td>";
		
		
		// AssignmentStatus Select
		echo "<td><form action='./magma?viewAssignmentStatusId=1'><select name='viewAssignmentStatusId' onchange='this.form.submit()'>";
		echo "<option value='all'>All</option>";
		while($row3 = $result3->fetch_assoc()) {
			$assignmentStatusId = $row3['assignmentStatusId'];
			if ($assignmentStatusId == $status){
				echo "<option selected='selected' value='" . $assignmentStatusId . "'>";
			} else {
				echo "<option value='" . $assignmentStatusId . "'>";
			}
			echo $row3['assignmentStatus'] . "</option>";
		}
		echo "</select>";
		// Hidden Values
		hiddenSeries($series);
		hiddenShow($show);
		hiddenDivision($division);
		hiddenSkill($skill);
		hiddenArtist($artist);
		echo "</form></td></tr></table>";
		
		echo "<br>";

		close_magma();
		close_joomla();
	}
	
	/// Generic Dropdown lists ///
	
	// Function lists all of the series.
	function seriesList(){
		// $seriesId = $_GET['seriesId'];
		
		$conn = connect_magma();
		
		$sql = "SELECT * FROM seriesTable ORDER BY seriesNumber DESC";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<h2>Series List</h2><br><table border='2' cellpadding='10'><tr><th align='center'>Number</th><th align='left'>Title</th></tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$seriesNumber = sprintf("%04d", $row["seriesNumber"]);
				$seriesId = $row["seriesId"];
				$seriesTitle = $row["seriesTitle"];

				echo "<tr><td align='center'><a href='./index.php/magma/series?seriesId=" . $seriesId . "'>". $seriesNumber ."</a></td><td align='left'>". $seriesTitle ."</td></tr>";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}
		
		close_magma();
	}

	// Function lists all of the shows for a given series when passes a seriesId.	
	function showList($seriesId){
		// $seriesId = $_GET['seriesId'];
		
		$conn = connect_magma();
		
		$sql2 = "SELECT * FROM showTable WHERE seriesId=". $seriesId ."";			
		$result2 = $conn->query($sql2);

		if ($result2->num_rows > 0) {
			echo "<h2>Show List</h2><br><table border='2' cellpadding='10'><tr><th width='15%' align='center'>Number</th><th width='35%' align='left'>Title</th><th width='50%' align='left'>Description</th></tr>";
			
			// output data of each row	
			while($row2 = $result2->fetch_assoc()) {
				$showId = $row2["showId"];
				$showNumber = sprintf("%03d", $row2["showNumber"]); 
				$showTitle = $row2["showTitle"];
				$showDescription = $row2["showDescription"];		

				echo "<tr><td align='center'><a href='./show?seriesId=" . $seriesId . "&" . "showId=" . $showId . "'>". $showNumber ."</a></td><td align='left'>". $showTitle ."</td><td align='left'>". $showDescription ."</td></tr>";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}
				
		close_magma();
	}
	
	// Function lists all of the shots and elements on the Show page.
	function shotList($showId){
		$conn = connect_magma();
		
		$sql = "SELECT * FROM showTable WHERE showId=". $showId .""; 
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			
			// output data of each row	
			while($row = $result->fetch_assoc()) {
				$seriesId = $row["seriesId"];
				$seriesNumber = getSeriesNumber($seriesId);
				// $seriesNumber = sprintf("%04d", $row["seriesNumber"]);
				$showNumber = getShowNumber($showId);
				// $showNumber = sprintf("%03d", $row["showNumber"]); 
				$projectNumber = $seriesNumber . "_" .$showNumber;
				$projectId = $seriesNumber . $showNumber;
			}
		} else {
			echo "0 results";
		}
		
		$sql2 = "SELECT * FROM shotTable WHERE projectId='". $projectId ."' ORDER BY shotName";
		$result2 = $conn->query($sql2);

		if ($result2->num_rows > 0) {
			echo "<h3>Shot List</h3><table width=100% border='2' cellpadding='10'><tr><th width='15%' align='center'>Name</th><th width='50%' align='left'>Description</th></tr>";
			
			// output data of each row	
			while($row2 = $result2->fetch_assoc()) {
				$shotId = $row2["shotId"];
				$shotName = $row2["shotName"];
				$shotDescription = $row2["shotDescription"]; 
				$startFrame = $row2["startFrame"];
				$endFrame = $row2["endFrame"];		

				echo "<tr><td align='center'><a href='./shot?seriesId=" . $seriesId . "&" . "showId=" . $showId . "&" . "shotId=" . $shotId . "'>" . $projectNumber . "_" . $shotName . "</a></td><td align='left'>". $shotDescription ."</td></tr>";
			}
			echo "</table>";
		} else {
			echo "<h4>0 shots returned</h4>";
		}

		$sql3 = "SELECT * FROM elementTable WHERE projectId='". $projectId ."' ORDER BY elementName";
		$result3 = $conn->query($sql3);

		if ($result3->num_rows > 0) {
			echo "<h4>Element List</h4><br><table width=100% border='2' cellpadding='10'><tr><th width='30%' align='center'>Name</th><th width='70%' align='left'>Description</th></tr>";
			
			// output data of each row	
			while($row3 = $result3->fetch_assoc()) {
				$elementId = $row3["elementId"];
				$elementName = $row3["elementName"];
				$elementDescription = $row3["elementDescription"]; 
			
				echo "<tr><td align='left'><a href='./element?seriesId=" . $seriesId . "&" . "showId=" . $showId . "&" . "elementId=" . $elementId . "'>" . $projectNumber . "_" . $elementName . "</a></td><td align='left'>". $elementDescription ."</td></tr>";
			}
			echo "</table>";
		} else {
			echo "<h4>0 elements returned</h4>";
		}

		close_magma();
	}
	
	// Assignment Pages and Tools ///	
	
	function getAssignment($assignmentId){
		$conn = connect_magma();
		
		$updateDB = $_GET['updateDB'];
		
		if($updateDB > 0){
			updateDB($updateDB);
		}
		
		
		if ($assignmentId > 0){
			$sql = "SELECT * FROM assignmentTable WHERE assignmentId = " . $assignmentId;
			$result = $conn->query($sql);
									
			while($row = $result->fetch_assoc()){
								
				$seriesId = $row["seriesId"];
				$seriesNumber = getSeriesNumber($seriesId);
				getSeriesData($seriesId);

				$showId = $row["showId"];
				$showName  = getShotName($showId);
				getShowData($showId);
				
				$shotId = $row["shotId"];
				$shotName = getShotName($shotId);
				getShotData($shotId,1);
				
				$elementId = $row["elementId"];
				$elementName = getElementName();
				getElementData($elementId,1);
				
				$divisionOptionsId = $row["divisionOptionsId"];
				$divisionName = getDivisionName($divisionOptionsId);
				$divisionCode = getDivisionCode($divisionOptionsId);
				
				$skillOptionsId = $row["skillOptionsId"];
				$skillOptions = getSkill($skillOptionsId);
				
				$easeOptionsId = $row["easeOptionsId"];
				$easeOptions = getEase($easeOptionsId);
				
				$assignmentDescription = $row["assignmentDescription"];
				
				$assignmentCreationDate = $row["assignmentCreationDate"];
				$tempDate = strtotime($assignmentCreationDate);
				$assignmentCreationDateFormatted = date ("m-d-y", $tempDate);
				
				$assignmentDueDate = $row["assignmentDueDate"];
				$tempDate = strtotime($assignmentDueDate);
				$assignmentDueDateFormatted = date ("m-d-y", $tempDate);
				
				$assignmentPriority = $row["assignmentPriority"];
				
				$assignmentStatusId = $row["assignmentStatusId"] ; 
				$assignmentStatus = getAssignmentStatus($assignmentStatusId);
				
				$userId = $row["userId"];
				$userName = getUserName($userId);
				
				echo "<table width='100%' border=2 cellpadding=10%><tr><td>";
				echo "<h3>Assignment Information</h3>";
				echo "<table width='100%' border=1 cellpadding=10%>";
				echo "<tr><th align='left'>Priority: " . $assignmentPriority . "</th><th align='left'>Status: " . $assignmentStatus . "</th><th align='left'>Creation Date: " . $assignmentCreationDateFormatted . "</th><th align='left'>Due Date: " . $assignmentDueDateFormatted . "</th></tr>";
				echo "<tr><th align='left' >Division: " . $divisionName . "</th><th align='left'>Skill: " . $skillOptions . "</th><th align='left'>Ease: " . $easeOptions . "</th><th align='left'>Artist: " . $userName . "</th></tr>";
				
				echo "<th align='left' colspan=4>";
				echo "<form action='./assignment?assignmentId=1'>";
				
				// Hidden Values
				echo "<input type='text' name='assignmentId' value='$assignmentId' style='display:none'></input>";
				echo "<input type='text' name='updateDB' value=9 style='display:none'></input>";
				echo "<input type='text' name='sessionUserId' value='$sessionUserId' style='display:none'></input>";
				
				// echo "Description: " . $assignmentDescription;
				echo "Description:<br><textarea name='assignmentDescription' rows='10' cols='150' style=width:800px>" . $assignmentDescription . "</textarea>";
				echo "<br><br><input type='submit' value='Update'>";
				echo "</form>";	
				echo "</th></tr>";		
				
				echo "</table>";
				echo "</td></tr></table>";
			}
			
			
			
			$sessionUserId = getUserId();
			$userAuthenticated = getUserAuthentication($sessionUserId,2);
			$managerAuthenticated = getUserAuthentication($sessionUserId,6);
			
			// If the user is authenticated and the assignment status is "To Do"
			if($userAuthenticated == 1){
				
				if($assignmentStatusId == 1 OR $assignmentStatusId == 4){
					// If this button is puched the assignment will be changed to the status of "In Progress" 
					echo "<br><form action='./assignment?assignmentId=1'>";
					// Hidden Values
					echo "<input type='text' name='assignmentId' value='$assignmentId' style='display:none'></input>";
					echo "<input type='text' name='updateDB' value=5 style='display:none'></input>";
					echo "<input type='text' name='sessionUserId' value='$sessionUserId' style='display:none'></input>";
					
					// NOTE: Eventually we need to set it up where the user has to be a certain level to accept assignments of
					// a certain level of complexity and scope.  For now, disregard.
					// echo "<select name='divisionOptionsId' onchange='this.form.submit()';>";
			
					echo "<input type='submit' value='Accept'>";
					echo "</form>";	
				// This means that the shot is currently "in progress"	
				} else if ($assignmentStatusId == 2){
					echo "<table cellpadding=10%><tr><td>";
					//If this button is pushed, the assignment will be set as "ready for review"
					echo "<br><form action='./assignment?assignmentId=1'>";
					
					// Hidden Values
					echo "<input type='text' name='assignmentId' value='$assignmentId' style='display:none'></input>";
					echo "<input type='text' name='updateDB' value=8 style='display:none'></input>";
					echo "<input type='text' name='sessionUserId' value='$sessionUserId' style='display:none'></input>";
					
					// NOTE: Eventually we need to set it up where the user has to be a certain level to accept assignments of
					// a certain level of complexity and scope.  For now, disregard.
					// echo "<select name='divisionOptionsId' onchange='this.form.submit()';>";
			
					echo "<input type='submit' value='Ready for Review'>";
					echo "</form>";
					
					echo "</td><td>" ;
					
					// If this button is pushed, the assignment will be "released" and the status will be changed to "Todo"
					echo "<br><form action='./assignment?assignmentId=1'>";
					
					// Hidden Values
					echo "<input type='text' name='assignmentId' value='$assignmentId' style='display:none'></input>";
					echo "<input type='text' name='updateDB' value=6 style='display:none'></input>";
					echo "<input type='text' name='sessionUserId' value='$sessionUserId' style='display:none'></input>";
					
					// NOTE: Eventually we need to set it up where the user has to be a certain level to accept assignments of
					// a certain level of complexity and scope.  For now, disregard.
					// echo "<select name='divisionOptionsId' onchange='this.form.submit()';>";
			
					echo "<input type='submit' value='Release'>";
					echo "</form>";
					
					echo "</td><td>" ;
										
					//If this button is pushed, the assignment will be set as "completed"
					echo "<br><form action='./assignment?assignmentId=1'>";
					
					// Hidden Values
					echo "<input type='text' name='assignmentId' value='$assignmentId' style='display:none'></input>";
					echo "<input type='text' name='updateDB' value=7 style='display:none'></input>";
					echo "<input type='text' name='sessionUserId' value='$sessionUserId' style='display:none'></input>";
					
					// NOTE: Eventually we need to set it up where the user has to be a certain level to accept assignments of
					// a certain level of complexity and scope.  For now, disregard.
					// echo "<select name='divisionOptionsId' onchange='this.form.submit()';>";
			
					echo "<input type='submit' value='Completed'>";
					echo "</form>";
					
					echo "</td></tr></table>";
				}					
			}	
		}
	}

	// NOTE: and showDropdown should be combined into one function.  Something like createAssignment()
	// This is used on the create assignment page.	
	function seriesDropdown(){
		$seriesId = $_GET['seriesId'];
		
		$userId = getUserId();
		
		$conn = connect_magma();
		
		if ($seriesId > 0)
		{
			// Series Dropdown
			// echo "seriesId has a value and it is " . $seriesId;
			$sql = "SELECT * FROM seriesTable WHERE seriesId = " . $seriesId;
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()) {
				$seriesNumber = sprintf("%04d", $row['seriesNumber']);
				echo "<h5><a href='./create-assignment'>Reset Series</a></h5>";
				
				echo "<h4>Series Title: " . $row['seriesTitle'] . "</h4>";
				echo "<h4>Series Number: " . $seriesNumber . "</h4>";
			}
		} else {
			$sql = "SELECT * FROM seriesTable WHERE seriesStatus = 1 ORDER BY seriesTitle ASC ";
			$result = $conn->query($sql);
			echo "<form action='create-assignment?seriesId=1'>";
			echo "<select name='seriesId' onchange='this.form.submit()';>";
			echo "<option value='0'>Select Series</option>";
			while($row = $result->fetch_assoc()) {
				echo "<option value='" . $row['seriesId'] . "'>";
				echo $row['seriesTitle'] . "</option>";
			}
			echo "</select>";
			echo "</form>";
		}
		close_magma();
	}
	
	// Aspect Ratio Dropdown created for the Series Management Page.
	// This function must be embedded in a FORM.
	function aspectRatioDropdown($selectedAspectRatioId){
		
		$conn = connect_magma();
		
		if ($selectedAspectRatioId >= 0){
			$sql = "SELECT * FROM aspectRatioTable ORDER BY aspectRatioId ASC";
			$result = $conn->query($sql);
				
			echo "<h5>Aspect Ratio</h5>";
			echo "<select name='aspectRatioId' style='width: 75px';>";
			while($row = $result->fetch_assoc()) {
				$aspectRatioId = $row["aspectRatioId"];
				$aspectRatio = $row["aspectRatio"];
				echo "<option value='" . $aspectRatioId . "'";
				// Code to autoselect either the default or saved value
				if($selectedAspectRatioId == $aspectRatioId){
					echo " selected='selected'";
				}
				echo ">";
				echo $aspectRatio . "</option>";
			}
			echo "</select>";
		}
		close_magma();
	}
	
	// Frames Per Second Dropdown created for the Series Management Page.
	// This function must be embedded in a FORM.
	function framesPerSecondDropdown($selectedFramesPerSecondId){
		
		$conn = connect_magma();
		if ($selectedFramesPerSecondId >= 0){
			$sql = "SELECT * FROM framesPerSecondTable ORDER BY framesPerSecondId ASC";
			$result = $conn->query($sql);
				
			echo "<h5>Frames Per Second</h5>";
			echo "<select name='framesPerSecondId' style='width: 85px';>";
			while($row = $result->fetch_assoc()) {
				$framesPerSecondId = $row["framesPerSecondId"];
				$framesPerSecond = $row["framesPerSecond"];
					
				echo "<option value='" . $framesPerSecondId . "'";
				// Code to autoselect either the default or saved value
				if($selectedFramesPerSecondId == $framesPerSecondId){
					echo " selected='selected'";
				}
				echo ">";
				echo $framesPerSecond . "</option>";
			}
			echo "</select>";
		}
		close_magma();
	}
	
	// Unit of Measurement Dropdown created for the Series Management Page.
	// This function must be embedded in a FORM.
	function unitOfMeasurementDropdown($selectedUnitOfMeasurementId){
		
		$conn = connect_magma();
		if ($selectedUnitOfMeasurementId >= 0){
			$sql = "SELECT * FROM unitOfMeasurementTable ORDER BY unitOfMeasurementId ASC";
			$result = $conn->query($sql);
				
			echo "<h5>Unit of Measurement</h5>";
			echo "<select name='unitOfMeasurementId' style='width: 115px';>";
			while($row = $result->fetch_assoc()) {
				$unitOfMeasurementId = $row["unitOfMeasurementId"];
				$unitOfMeasurementName = $row["unitOfMeasurementName"];
					
				echo "<option value='" . $unitOfMeasurementId . "'";
				// Code to autoselect either the default or saved value
				if($selectedUnitOfMeasurementId == $unitOfMeasurementId){
					echo " selected='selected'";
				}
				echo ">";
				echo $unitOfMeasurementName . "</option>";
			}
			echo "</select>";
		}
		close_magma();
	}
			
	// This is used on the create assignment page.	
	function showDropdown(){
		// pull series number out of the URL
		$seriesId = $_GET['seriesId'];
		
		// make a connection to the magam database
		$conn = connect_magma();
		
		if ($seriesId > 0)
		{
			$sql = "SELECT * FROM showTable WHERE seriesId = " . $seriesId . " ORDER BY showTitle ASC";
			$result = $conn->query($sql);
			echo "<form action='create-assignment-2?seriesId=" . $seriesId . "&showId=1'>";
			echo "<select name='showId' onchange='this.form.submit()';>";
			echo "<option value='0'>Select Show</option>";
			while($row = $result->fetch_assoc()) {
				$showId = $row["showId"];
				echo "<option value='" . $showId . "'>";
				echo $row['showTitle'] . "</option>";
			}
			echo "</select>";
			echo "</form>";
		}
		close_magma();
	}
	
	function createAssignment2(){

		$showId = $_GET['showId'];
		
		$conn = connect_magma();
		
		if ($showId > 0)
		{
			echo "<h5><a href='./create-assignment'>Reset Series</a></h5>";
			
			echo "<h3>Create an Assignment</h3>";
			
			$sql = "SELECT * FROM showTable WHERE showId = " . $showId;
			$result = $conn->query($sql);
			
			while($row = $result->fetch_assoc()) {
				$seriesId = $row["seriesId"];
				$seriesNumber = sprintf("%04d", $row["seriesNumber"]);
				$showNumber = sprintf("%03d", $row["showNumber"]);
				$showTitle = $row["showTitle"];
				$showDescription = $row["showDescription"];
				$projectNumber = $seriesNumber . "_" . $showNumber;
				$projectId = $seriesNumber . $showNumber;
			}
		}
		
		if ($projectId > 0)
		{
			// Start the form.
			echo "<form action='process-assignment?projectId=" . projectId . " method='get'>";
			
			// Hidden values
			echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
			echo "<input type='text' name='seriesNumber' value='$seriesNumber' style='display:none'></input>";
			echo "<input type='text' name='showId' value='$showId' style='display:none'></input>";
			echo "<input type='text' name='showNumber' value='$showNumber' style='display:none'></input>";
			echo "<input type='text' name='projectId' value='$projectId' style='display:none'></input>";
			echo "<input type='text' name='processAssignment' value='create' style='display:none'></input>";
			
			// Visible values
			echo "<h4>Show Title</h4>";
			echo "<input type='text' name='showTitle' value='$showTitle' readonly></input><br>";
			echo "<h4>Show Desription</h4>";
			echo "<textarea name='showDescription' rows='10' cols='10' readonly>$showDescription</textarea><br>";
			echo "<h4>Project Number</h4>";
			echo "<input type='text' name='projectNumber' value='$projectNumber' readonly></input><hr>";
			echo "<input type='text' name='projectNumber' value='$projectNumber' readonly></input><hr>";
			
			//Shot Name Dropdown			
			$sql = "SELECT * FROM shotTable WHERE projectId = " . $projectId . " ORDER BY shotName ASC";
			$result = $conn->query($sql);
			
			echo "<h5>Shot Name</h5>";
			echo "<select name='shotId';>";
			echo "<option value=0>None</option>";
			
			while($row = $result->fetch_assoc()) {
				$shotId = $row["shotId"];
				$shotName = $row["shotName"];			
				echo "<option value='" . $shotId . "'>";
				// This should likely use the variable, and not pull from the array again.
				echo $row['shotName'] . "</option>";
			}
			echo "</select>";
			
			// Element Name Dropdown
			$sql2 = "SELECT * FROM elementTable WHERE showId = " . $projectId . " ORDER BY elementName ASC";
			$result2 = $conn->query($sql2);
			
			echo "<h5>Element Name</h5>";
			echo "<select name='elementId';>";
			echo "<option value=0>None</option>";
			while($row2 = $result2->fetch_assoc()) {
				$showId = $row2["showId"];
				$elementId = $row2["elementId"];
				$elementName = $row2["elementName"];
				
				echo "<option value='" . $elementId . "'>";
				// This should likely use the variable, and not pull from the array again.
				echo $row2['elementName'] . "</option>";
			}
			echo "</select>";
			
			// Division Name Dropdown
			$sql3 = "SELECT * FROM divisionOptionsTable ORDER BY divisionName ASC";
			$result3 = $conn->query($sql3);
			
			echo "<h5>Division Name</h5>";
			echo "<select name='divisionOptionsId';>";
			while($row3 = $result3->fetch_assoc()) {
				// $divisionCategoryId = $row3["divisionCategoryId"];
				$divisionOptionsId = $row3["divisionOptionsId"];
				$divisionName = $row3["divisionName"];
				// $divisionCode = $row3["divisionCode"];
				// $phaseid = $row3["phaseId"];
				
				echo "<option value='" . $divisionOptionsId . "'>";
				// This should likely use the variable, and not pull from the array again.
				echo $row3['divisionName'] . "</option>";
			}
			echo "</select>";
			
			// Skill Options Dropdown
			$sql5 = "SELECT * FROM skillOptionsTable ORDER BY skillOptionsId ASC";
			$result5 = $conn->query($sql5);
			
			echo "<h5>Skill Level</h5>";
			echo "<select name='skillOptionsId';>";
			while($row5 = $result5->fetch_assoc()) {
				$skillOptionsId = $row5["skillOptionsId"];
				$skillOptions = $row5["skillOptions"];
				
				echo "<option value='" . $skillOptionsId . "'>";
				// This should likely use the variable, and not pull from the array again.
				echo $row5['skillOptions'] . "</option>";
			}
			echo "</select>";
			
			// Ease Options Dropdown
			$sql6 = "SELECT * FROM easeOptionsTable ORDER BY easeOptionsId ASC";
			$result6 = $conn->query($sql6);
			
			echo "<h5>Ease Level</h5>";
			echo "<select name='easeOptionsId';>";
			while($row6 = $result6->fetch_assoc()) {
				$easeOptionsId = $row6["easeOptionsId"];
				$easeOptions = $row6["easeOptions"];
				
				echo "<option value='" . $easeOptionsId . "'>";
				// This should likely use the variable, and not pull from the array again.
				echo $row6['easeOptions'] . "</option>";
			}
			echo "</select>";
			
			// Assignment Description
			echo "<h5>Description</h5>";
			echo "<textarea name='assignmentDescription' rows='10' cols='150'>Enter assignment description.</textarea>";
			
			// Assignment Due Date
			echo "<h5>Due Date</h5>";
			echo "<input type = 'date' name = 'assignmentDueDate'>";
			
			// Assignment Priority
			echo "<h5>Priority</h5>";
			$row8 = 1;
			echo "<select name='assignmentPriority';>";
			while($row8 <= 100){
				echo "<option value='" . $row8 . "'>";
				echo $row8 . "</option>";
				$row8++;
			}
			echo "</select><br>";
			
			// Assignment Status Dropdown
			$sql4 = "SELECT * FROM assignmentStatusOptionsTable ORDER BY assignmentStatus ASC";
			$result4 = $conn->query($sql4);
			
			echo "<h5>Status</h5>";
			echo "<select name='assignmentStatusId';>";
			while($row4 = $result4->fetch_assoc()) {
				$assignmentStatusId = $row4["assignmentStatusId"];
				$assignmentStatus = $row4["assignmentStatus"];
				
				echo "<option value='" . $assignmentStatusId . "'>";
				echo $row4['assignmentStatus'] . "</option>";
			}
			echo "</select>";
			echo "<br>";
			
			
			echo "<input type='submit' value='Submit'>";
			echo "</form>";
			
		}
		close_magma();
	}
	
	function processAssignment(){
		$seriesId = $_GET['seriesId'];
		$seriesNumber = $_GET['seriesNumber'];
		$showId = $_GET['showId'];
		$showNumber = $_GET['showNumber'];
		$showTitle = $_GET['showTitle'];
		$showDescription = $_GET['showDescription'];
		$projectId = $_GET['projectId'];
		$projectNumber = $_GET['projectNumber'];
		$shotId = $_GET['shotId'];
		$elementId = $_GET['elementId'];	
		$divisionOptionsId = $_GET['divisionOptionsId'];
		$skillOptionsId = $_GET['skillOptionsId'];
		$easeOptionsId = $_GET['easeOptionsId'];
		$assignmentDescription = $_GET['assignmentDescription'];
		$assignmentDescription = mysql_real_escape_string($assignmentDescription);
		// $assignmentCreationDate = date();
		$assignmentDueDate = $_GET['assignmentDueDate'];
		$assignmentPriority = $_GET['assignmentPriority'];
		$assignmentStatusId = $_GET['assignmentStatusId'];
		$userId = 0;
		$processAssignment = $_GET['processAssignment'];
		
		$conn = connect_magma();
		
		// determine if the action to be taken is to create a new record of update an existing record. 
		if ($processAssignment == "create")
		{
			$sql = "INSERT INTO assignmentTable (seriesId, showId, shotId, elementId, divisionOptionsId, skillOptionsId, easeOptionsId, assignmentDescription, assignmentCreationDate, assignmentDueDate, assignmentPriority, assignmentStatusId, userId) VALUES ('$seriesId', '$showId', '$shotId', '$elementId', '$divisionOptionsId', '$skillOptionsId', '$easeOptionsId', '$assignmentDescription', Now(), '$assignmentDueDate', '$assignmentPriority', '$assignmentStatusId', '$userId')";
			
			if ($conn->query($sql) === TRUE)
			{
				//echo "<h3>Assignment Created!</h3><hr>";
			} else {
				echo "ERROR: " . $sql . "<br>" . $conn->error;
			}
			
			echo "<p>Assignment has been created!</p>";

			echo "<form action='http://galaxy.grasshorse.com'>";
			echo "<input type='submit' value='Goto Main Page'>";
			echo "</form>";
		}
		else if ($processAssignment == "update")
		{
			echo "Assignment Updated!";
			$assignmentId = $_GET['assignmentId'];
			$sessionUserId = getUserId();
		}
		else if ($processAssignment == "revise")
		{
			echo "Assignment Updated!";
			$assignmentId = $_GET['assignmentId'];
		}
		else
		{
			echo "ERROR";
		}
	}
	
/// Queue Page and Tools ///

	function queue(){

		$updateDB = $_GET['updateDB'];

		if($updateDB > 0){
			updateDB($updateDB);
		}

		// Setup pagination variables.
		$rowsPerPage = 10;

		$startRow = $_GET['startRow'];

		if ($startRow == 0){
			$startRow = 0;
		}

		$endRow = $startRow + $rowsPerPage;


		// What column to order by
		$orderBy = $_GET['orderBy'];

		if ($orderBy == 0){
			$orderBy = "shotId";
			// echo "orderBy is " . $orderBy;
		}

		// should the columns data be ascending or descending?
		$orderByType = $_GET['orderByType'];

		if ($orderByType == 0){
			$orderByType = "ASC";
			// echo "orderByType is " . $orderByType;
		}

		$series = grabSeries();
		$show = grabShow();
		$division = grabDivision();
		$skill = grabSkill();
		$artist = grabArtist();
		$status = grabStatus();
		
		// Second pass at making a better MySQL statement
		// Series Statement
		if ($series == "all"){
			$seriesStatement = "";
			// echo "<p>in the series all statement</p>";
		} else {
			if ($show == "all"){
				// echo "<p>in the show all statement</p>";
				$seriesStatment = " WHERE seriesId = " . $series;
			} else {
				// echo "<p>in the specific series and show statement</p>";
				$seriesStatment = " WHERE seriesId = " . $series . " AND showId = ". $show; 
			}
		}

		// Division Statement
		if ($series== "all" && $division == "all"){
			$divisionStatement = "";
		} else if ($series != "all" && $division == "all"){
			$divisionStatement = "";
		} else if ($series == "all" && $division != "all"){
			$divisionStatement = " WHERE divisionOptionsId = " . $division;
		} else if ($series != "all" && $division != "all"){
			$divisionStatement = " AND divisionOptionsId = " . $division;
		}

		// Skill Statement
		if ($series== "all" && $skill == "all"){
			$skillStatement = "";
		} else if ($series != "all" && $skill == "all"){
			$skillStatement = "";
		} else if ($series == "all" && $division == "all" && $skill != "all"){
			$skillStatement = " WHERE skillOptionsId = " . $skill;
		} else if ($series != "all" && $skill != "all"){
			$skillStatement = " AND skillOptionsId = " . $skill;
		}

		// Artist Statement
		if ($series== "all" && $artist == "all"){
			$artistStatement = "";
		} else if ($series != "all" && $artist == "all"){
			$artistStatement = "";
		} else if ($series == "all" && $division == "all" && $skill == "all" && $artist != "all"){
			$artistStatement = " WHERE userId = " . $artist;
		} else if ($series != "all" && $artist != "all"){
			$artistStatement = " AND userId = " . $artist;
		}

		// Status Statement
		if ($series== "all" && $status == "all"){
			$statusStatement = "";
		} else if ($series != "all" && $status == "all"){
			$statusStatement = "";
		} else if ($series == "all" && $division == "all" && $skill != "all" && $artist == "all" && $status != "all"){
			$statusStatement = " WHERE assignmentStatusId = " . $status;
		} else if ($series != "all" && $status != "all"){
			$statusStatement = " AND assignmentStatusId = " . $status;
		}

		// Final WHERE Statement
		if ($series == "all" && $division == "all" && $skill == "all" && $artist == "all" && $status == "all"){
			$whereStatement = "";
			echo "<p>Where statement is " . $whereStatement . "</p>";
		} else {
			$whereStatement = $seriesStatment . "" . $divisionStatement . "" . $skillStatement . "" . $artistStatement . "" . $statusStatement;
			echo "<p>Where statement is " . $whereStatement . "</p>";
		}

			
		echo "<table><tr><td>" . queueDropdown() . "</td></td></table>";
		echo "<hr>";
		
		$conn = connect_magma();
		
		$sql1 = "SELECT * FROM assignmentTable" . $whereStatement . " ORDER BY assignmentPriority";
		echo "sql1 is " . $sql1;
		$result1 = $conn->query($sql1);
		

		$recordCount = $result1->num_rows;

		$sql = "SELECT * FROM assignmentTable" . $whereStatement . " ORDER BY assignmentPriority LIMIT " . $startRow . "," . $rowsPerPage;
		$result = $conn->query($sql);

		// $recordCount = $result->num_rows;

		// Setup Skill Options Dropdown Array
		$sql2 = "SELECT * FROM skillOptionsTable";
		// $result2 = $conn->query($sql2);
		$result2 = $conn->query($sql2);

		$skillOptionsResult = array();

		if ($result2->num_rows > 0){
			while($row2 = $result2->fetch_assoc())
			{
				$skillOptionsResult[] = $row2;
			}
		}

		// Setup Ease Options Dropdown Array
		$sql3 = "SELECT * FROM easeOptionsTable";
		$result3 = $conn->query($sql3);

		$easeOptionsResult = array();

		if ($result3->num_rows > 0){
			while($row3 = $result3->fetch_assoc())
			{
				$easeOptionsResult[] = $row3;
			}
		}

		// Setup Status Options Dropdown Array
		$sql4 = "SELECT * FROM assignmentStatusOptionsTable";
		$result4 = $conn->query($sql4);

		$assignmentStatusOptionsResult = array();

		// echo "result 4 is " . $result4->num_rows;

		if ($result4->num_rows > 0){
			while($row4 = $result4->fetch_assoc())
			{
				$assignmentStatusOptionsResult[] = $row4;
			}
		}

		if ($result->num_rows > 0){
			echo "<table witdh='1000%' border=2 cellpadding = 10>";
			echo "<tr>";
			echo "<td style=width:30px><h5>Pri</h5></td>";
			echo "<td style=width:30px><h5>Proj. No.</h5></td>";
			echo "<td style=width:30px><h5>Shot</h5></td>";
			echo "<td style=width:30px><h5>Element</h5></td>";
			echo "<td style=width:30px><h5>Division</h5></td>";
			echo "<td style=width:30px><h5>Skill</h5></td>";
			echo "<td style=width:10px><h5>Ease</h5></td>";
			echo "<td style=width:100px><h5>Due</h5></td>";
			echo "<td style=width:30px><h5>Artist</h5></td>";
			echo "<td style=width:30px><h5>Status</h5></td>";
			echo "<td style=width:30px><h5>View</h5></td></tr>";

			while($row = $result->fetch_assoc()){

				$seriesId = $row["seriesId"];
				$seriesNumber = getSeriesNumber($seriesId);

				$showId = $row["showId"];
				$showNumber = getShowNumber($showId);

				$projectNumber = $seriesNumber . "_" . $showNumber;
				$projectId = $seriesNumber . $showNumber;

				$shotId = $row["shotId"];
				$shotName = getShotName($shotId);

				$elementId = $row["elementId"];
				$elementName = getElementName($elementId);

				$divisionOptionsId = $row["divisionOptionsId"];
				$divisionCode = getDivisionCode($divisionOptionsId);

				$skillOptionsId = $row["skillOptionsId"];
				$skillOptions = getSkill($skillOptionsId);

				$assignmentId = $row["assignmentId"];

				$easeOptionsId = $row["easeOptionsId"];
				$easeOptions = getEase($easeOptionsId);

				$assignmentDueDate = $row["assignmentDueDate"];
				$tempDate = strtotime($assignmentDueDate);
				$assignmentDueDateFormatted = date ("m-d-y", $tempDate);

				$assignmentPriority = $row["assignmentPriority"];

				$userId = $row["userId"];
				$userName = getUserName($userId);

				$sessionUserId = getUserId();
				$authenticated = getUserAuthentication($sessionUserId,6);

				$assignmentStatusId = $row["assignmentStatusId"];
				$assignmentStatus = getAssignmentStatus($assignmentStatusId);

				$userId = $row["userId"];
				echo "<tr>";
				if ($authenticated == 1){
					//  put a dropdown list/form that on change will update the database and update the dropdown list.
					$assignmentPriority = $row["assignmentPriority"];
					echo "<td " . getCellColor($assignmentStatusId) . ">";
					getPriorityList($assignmentId,$assignmentPriority);
					echo "</td>";
				} else {
					$assignmentPriority = $row["assignmentPriority"];
					echo "<td " . getCellColor($assignmentStatusId) . ">$assignmentPriority</td>";
				}
				echo "<td " . getCellColor($assignmentStatusId) . ">$projectNumber</td>";
				echo "<td " . getCellColor($assignmentStatusId) . ">$shotName</td>";
				echo "<td " . getCellColor($assignmentStatusId) . ">$elementName</td>";
				echo "<td " . getCellColor($assignmentStatusId) . ">$divisionCode</td>";

				if ($authenticated == 1){
					//  put a dropdown list/form that on change will update the database and update the dropdown list.
					$skillOptionsId = $row["skillOptionsId"];
					echo "<td " . getCellColor($assignmentStatusId) . ">";
					getSkillList2($assignmentId,$skillOptionsId,$skillOptionsResult);
					echo "</td>";
				} else {
					$skillOptionsId = $row["skillOptionsId"];
					echo "<td " . getCellColor($assignmentStatusId) . ">" . getSkill2($skillOptionsId,$skillOptionsResult) . "</td>";
				}

				//if ($authenticated == 1){
				//  put a dropdown list/form that on change will update the database and update the dropdown list.
				$easeOptionsId = $row["easeOptionsId"];
				echo "<td " . getCellColor($assignmentStatusId) . ">";
				getEaseList2($assignmentId,$easeOptionsId,$easeOptionsResult);
				echo "</td>";
				echo "<td " . getCellColor($assignmentStatusId) . ">$assignmentDueDateFormatted</td>";
				echo "<td " . getCellColor($assignmentStatusId) . ">$userName</td>";

				if ($authenticated == 1){
					//  put a dropdown list/form that on change will update the database and update the dropdown list.
					$assignmentStatusId = $row["assignmentStatusId"];
					echo "<td " . getCellColor($assignmentStatusId) . ">";
					getStatusList2($assignmentId,$assignmentStatusId,$assignmentStatusOptionsResult);
					echo "</td>";
				} else {
					$easeOptionsId = $row["easeOptionsId"];
					echo "<td " . getCellColor($assignmentStatusId) . ">" . getAssignmentStatus($assignmentStatusId) . "</td>";
				}

				echo "<td " . getCellColor($assignmentStatusId) . "><a href='./assignment?seriesId=" . $seriesId . "&showId=" . $showId . "&assignmentId=" . $assignmentId . "'><strong>View</strong></a></td>";
				echo "</tr>";
			}
			echo "</table>";
			// echo "</form>";

			// The Previous and Next Buttons
			echo "<table style=width:100%><tr><td style=width:50% align=left>";
			// Previous Button
			if($startRow > 0)
			{
				echo "<br><form action='./magma?assignmentId=1'>";

				$startRow = $startRow - $rowsPerPage;

				// Hidden Values
				echo "<input type='text' name='viewDivisionOptionsId' value='$division' style='display:none'></input>";
				echo "<input type='text' name='viewSkillOptionsId' value='$skill' style='display:none'></input>";
				echo "<input type='text' name='viewAssignmentStatusOptionsId' value='$status' style='display:none'></input>";
				echo "<input type='text' name='startRow' value='$startRow' style='display:none'></input>";

				// NOTE: Eventually we need to set it up where the user has to be a certain level to accept assignments of
				// a certain level of complexity and scope.  For now, disregard.
				// echo "<select name='divisionOptionsId' onchange='this.form.submit()';>";

				echo "<input type='submit' value='Previous'>";
				echo "</form>";

			}
			echo "</td><td style=width:50% align=right>";
			// Next Button
			if($recordCount > $endRow)
			{
				echo "<br><form action='./magma?assignmentId=1'>";

				// Hidden Values
				echo "<input type='text' name='viewDivisionOptionsId' value='$division' style='display:none'></input>";
				echo "<input type='text' name='viewSkillOptionsId' value='$skill' style='display:none'></input>";
				echo "<input type='text' name='viewAssignmentStatusOptionsId' value='$status' style='display:none'></input>";
				echo "<input type='text' name='startRow' value='$endRow' style='display:none'></input>";

				// NOTE: Eventually we need to set it up where the user has to be a certain level to accept assignments of
				// a certain level of complexity and scope.  For now, disregard.
				// echo "<select name='divisionOptionsId' onchange='this.form.submit()';>";

				echo "<input type='submit' value='Next'>";
				echo "</form>";
			}
			echo "</td></tr></table>";
		
		}
		
		close_magma();
	}

	function getSkillList2($assignmentId,$skillOptionsId,$skillOptionsResult){
		echo "<form action='magma/?skillOptionsId=1' method='get'>";

		$series = grabSeries();
		$show = grabShow();
		$division = grabDivision();
		$skill = grabSkill();
		$status = grabArtist();
		$status = grabStatus();

		// Hidden values
		echo "<input type='text' name='assignmentId' value='$assignmentId' style='display:none'></input>";
		echo "<input type='text' name='updateDB' value=3 style='display:none'></input>";
		echo "<input type='text' name='viewSeriesId' value='$series' style='display:none'></input>";
		echo "<input type='text' name='viewShowId' value='$show' style='display:none'></input>";
		echo "<input type='text' name='viewDivisionOptionsId' value='$division' style='display:none'></input>";
		echo "<input type='text' name='viewSkillOptionsId' value='$skill' style='display:none'></input>";
		echo "<input type='text' name='viewArtistId' value='$artist' style='display:none'></input>";
		echo "<input type='text' name='viewAssignmentStatusId' value='$status' style='display:none'></input>";

		$skillId = 0;

		if (count($skillOptionsResult) > 0)
		{
			// Skill Select
			echo "<select style=width:65px name='skillOptionsId' onchange='this.form.submit()'>";

			foreach($skillOptionsResult AS $skill){
				$skillOptions = $skillOptionsResult[$skillId];

				if ($skillId == $skillOptionsId){
					echo "<option selected='selected' value='" . $skillId . "'>";
				} else {
					echo "<option value='" . $skillId . "'>";
				}
				echo $skillOptions["skillOptions"] . "</option>";
				$skillId++;
			}
			echo "</select>";
		} else {
			echo "no skills were passed";
		}
		echo "</form>";
	}
	
	// Return skill without pinging the database.
	function getSkill2($skillOptionsId,$skillOptionsResult){
		$skillId = 0;
		
		if(count($skillOptionsResult) > 0)
		{
			foreach($skillOptionsResult AS $skill)
			{
				if ($skillId == $skillOptionsId)
				{
					$skillOptions = $skillOptionsResult[$skillId];
					return $skillOptions["skillOptions"];
				}
				$skillId++;
			}
		}
	}
	
	function getEaseList2($assignmentId,$easeOptionsId,$easeOptionsResult){
		echo "<form action='magma/?easeOptionsId=1' method='get'>";
		
		$series = $_GET['viewSeriesId'];
		
		if ($series == 0){
			$series = "all";
		}
		
		$show = $_GET['viewShowId'];
		
		if ($show == 0){
			$show = "all";
		}
		
		$division = $_GET['viewDivisionOptionsId'];
		
		if ($division == 0){
			$division = "all";
			// echo "division is " . $division;
		}
		
		$skill = $_GET['viewSkillOptionsId'];
		
		if ($skill == 0){
			$skill = "all";
			// echo "skill is " . $skill;
		}
		
		$status =  $_GET['viewAssignmentStatusId'];
		
		if ($status == 0){
			$status = "all";
			// echo "status is " . $status;
		}
		
		$artist = $_GET['viewArtistId'];
		
		if ($artist == 0){
			$artist = "all";
		}
		
		// Hidden values
		echo "<input type='text' name='assignmentId' value='$assignmentId' style='display:none'></input>";
		echo "<input type='text' name='updateDB' value=4 style='display:none'></input>";
		echo "<input type='text' name='viewSeriesId' value='$series' style='display:none'></input>";
		echo "<input type='text' name='viewShowId' value='$show' style='display:none'></input>";
		echo "<input type='text' name='viewDivisionOptionsId' value='$division' style='display:none'></input>";
		echo "<input type='text' name='viewSkillOptionsId' value='$skill' style='display:none'></input>";
		echo "<input type='text' name='viewArtistId' value='$artist' style='display:none'></input>";
		echo "<input type='text' name='viewAssignmentStatusId' value='$status' style='display:none'></input>";

		$easeId = 0;
		
		if (count($easeOptionsResult) > 0)
		{
			// Skill Select
			echo "<select style=width:50px name='easeOptionsId' onchange='this.form.submit()'>";
			
			foreach($easeOptionsResult AS $ease){			
				$easeOptions = $easeOptionsResult[$easeId];
				
				if ($easeId == $easeOptionsId){
					echo "<option selected='selected' value='" . $easeId . "'>";
				} else {
					echo "<option value='" . $easeId . "'>";
				}
				echo $easeOptions["easeOptions"] . "</option>";
				$easeId++;
			}
			echo "</select>";
		} else {
			echo "no skills were passed";
		}
		echo "</form>";
	}
	
	function getPriorityList($assignmentId,$assignmentPriority){
		echo "<form action='magma/?priority=1' method='get'>";
		
		$series = $_GET['viewSeriesId'];
		
		if ($series == 0){
			$series = "all";
		}
		
		$show = $_GET['viewShowId'];
		
		if ($show == 0){
			$show = "all";
		}
		
		$division = $_GET['viewDivisionOptionsId'];
		
		if ($division == 0){
			$division = "all";
			// echo "division is " . $division;
		}
		
		$skill = $_GET['viewSkillOptionsId'];
		
		if ($skill == 0){
			$skill = "all";
			// echo "skill is " . $skill;
		}
		
		$status =  $_GET['viewAssignmentStatusId'];
		
		if ($status == 0){
			$status = "all";
			// echo "status is " . $status;
		}
		
		$artist = $_GET['viewArtistId'];
		
		if ($artist == 0){
			$artist = "all";
		}
		
		// Hidden values
		echo "<input type='text' name='assignmentId' value='$assignmentId' style='display:none'></input>";
		echo "<input type='text' name='updateDB' value=1 style='display:none'></input>";
		echo "<input type='text' name='viewSeriesId' value='$series' style='display:none'></input>";
		echo "<input type='text' name='viewShowId' value='$show' style='display:none'></input>";
		echo "<input type='text' name='viewDivisionOptionsId' value='$division' style='display:none'></input>";
		echo "<input type='text' name='viewSkillOptionsId' value='$skill' style='display:none'></input>";
		echo "<input type='text' name='viewArtistId' value='$artist' style='display:none'></input>";
		echo "<input type='text' name='viewAssignmentStatusId' value='$status' style='display:none'></input>";
		
		// Priority Select
		echo "<select style=width:60px name='assignmentPriority' onchange='this.form.submit()'>";
		$row = 1;
		while($row <= 100){
		// while($row = $result->fetch_assoc()) {
			// $divisionOptionsId = $row['divisionOptionsId'];
			if ($row == $assignmentPriority){
				echo "<option selected='selected' value='" . $row . "'>";
			} else {
				echo "<option value='" . $row . "'>";
			}
			echo $row . "</option>";
			$row++;
		}
		echo "</select>";	
		echo "</form>";
	}

	function getStatusList2($assignmentId,$assignmentStatusId,$assignmentStatusOptionsResult){
		echo "<form action='magma/?assignmentStatusOptionsId=1' method='get'>";
		
		$series = $_GET['viewSeriesId'];
		
		if ($series == 0){
			$series = "all";
		}
		
		$show = $_GET['viewShowId'];
		
		if ($show == 0){
			$show = "all";
		}
		
		$division = $_GET['viewDivisionOptionsId'];
		
		if ($division == 0){
			$division = "all";
			// echo "division is " . $division;
		}
		
		$skill = $_GET['viewSkillOptionsId'];
		
		if ($skill == 0){
			$skill = "all";
			// echo "skill is " . $skill;
		}
		
		$status =  $_GET['viewAssignmentStatusId'];
		
		if ($status == 0){
			$status = "all";
			// echo "status is " . $status;
		}
		
		$artist = $_GET['viewArtistId'];
		
		if ($artist == 0){
			$artist = "all";
		}
		
		// Hidden values
		echo "<input type='text' name='assignmentId' value='$assignmentId' style='display:none'></input>";
		echo "<input type='text' name='updateDB' value=2 style='display:none'></input>";
		echo "<input type='text' name='viewSeriesId' value='$series' style='display:none'></input>";
		echo "<input type='text' name='viewShowId' value='$show' style='display:none'></input>";
		echo "<input type='text' name='viewDivisionOptionsId' value='$division' style='display:none'></input>";
		echo "<input type='text' name='viewSkillOptionsId' value='$skill' style='display:none'></input>";
		echo "<input type='text' name='viewArtistId' value='$artist' style='display:none'></input>";
		echo "<input type='text' name='viewAssignmentStatusId' value='$status' style='display:none'></input>";

		$statusId = 0;
		
		if (count($assignmentStatusOptionsResult) > 0)
		{
			// Skill Select
			echo "<select style=width:110px name='assignmentStatusId' onchange='this.form.submit()'>";
			
			foreach($assignmentStatusOptionsResult AS $status){			
				$statusOptions = $assignmentStatusOptionsResult[$statusId];
				
				
				if ($statusId == $assignmentStatusId){
					echo "<option selected='selected' value='" . $statusId . "'>";
				} else {
					echo "<option value='" . $statusId . "'>";
				}

				echo $statusOptions["assignmentStatus"] . "</option>";
				
				$statusId++;
			}
			echo "</select>";
		} else {
			echo "no skills were passed";
		}
		echo "</form>";
	}


	// This is a function that is used on the Series, Show, Shot and Element pages.
	function getSeriesData($seriesId){
		$conn = connect_magma();
		
		$sql = "SELECT * FROM seriesTable WHERE seriesId=". $seriesId ."";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			
			// output data of each row	
			while($row = $result->fetch_assoc()) {
				$seriesId = $row["seriesId"];
				$seriesNumber = sprintf("%04d", $row["seriesNumber"]);
				$seriesTitle = $row["seriesTitle"];
				$seriesDescription = $row["seriesDescription"];
				$resolutionWidth = $row["resolutionWidth"];
				$resolutionHeight = $row["resolutionHeight"];
				$aspectRatioId = $row["aspectRatioId"];
				$framesPerSecondId = $row["framesPerSecondId"];
				$unitOfMeasurementId = $row["unitOfMeasurementId"];
				$handles = $row["handles"];
								
				$aspectRatio = getAspectRatio($aspectRatioId);
				$framesPerSecond = getFramesPerSecond($framesPerSecondId);
				echo "<table width='100%' border=2 cellpadding=10%><tr><td>";
				echo "<h3>Series Information</h3>";
				echo "<table width='100%'><tr>";
				echo "<th align='left'>Number: ". $seriesNumber ."</th>";
				echo "<th align='right'>Title: ". $seriesTitle ."</th>";
				echo "</tr></table><br>";
				echo "<h5>Description:</h5><p>". $seriesDescription ."</p><hr>";
				
				echo "<table width='100%' border=1 cellpadding=10%>";
				echo "<tr><td align='left'>Resolution: ".$resolutionWidth."x".$resolutionHeight."</td>";
				echo "<td align='left'> Aspect Ratio: ".$aspectRatio."</td>";
				echo "<td align='left'> FPS: ".$framesPerSecond."</td>";
				echo "<td align='left'> Handles: ".$handles."</td></tr></table>";
				echo "</td></tr></table>";
				echo "<br>";
			}
			// echo "</table>";
		} else {
			echo "query 1 has 0 results";
		}
		close_magma();
	}

	// This is a function that is used on the Series, Show, Shot and Element pages.
	// SHOW INFORMATION	
	function getShowData($showId){
		
		$conn = connect_magma();

		$sql2 = "SELECT * FROM showTable WHERE showId=". $showId .""; 
		$result2 = $conn->query($sql2);

		if ($result2->num_rows > 0) {
			
			// output data of each row	
			while($row2 = $result2->fetch_assoc()) {
				$showId = $row2["showId"];
				$seriesNumber = sprintf("%04d", $row2["seriesNumber"]);
				$showNumber = sprintf("%03d", $row2["showNumber"]); 
				$showTitle = $row2["showTitle"];
				$showDescription = $row2["showDescription"];
				$projectNumber = $seriesNumber . "_" .$showNumber;
				$projectId = $seriesNumber . $showNumber;
				
				echo "<table width='100%' border=2 cellpadding=10%><tr><td>";
				echo "<h3>Show Information</h3>";
				echo "<table width='100%'><tr>";
				echo "<th align='left'>Project Number: ". $projectNumber ."</th>";
				echo "<th align='right'>Title: ". $showTitle ."</th>";
				echo "</tr></table>";
				echo "<h5>Description:</h5><p>". $showDescription ."</p><hr>";
				echo "</td></tr></table>";
				echo "<br>";
			}
		} else {
			echo "0 results";
		}
		close_magma();
		return $projectNumber;
	}
	
	// This is a function that is used on the Series, Show, Shot and Element pages.
	// SHOT INFORMATION
	function getShotData($shotId,$pagetype){
		$conn = connect_magma();
		
		$sql = "SELECT * FROM shotTable WHERE shotId='". $shotId ."'";
		$result = $conn->query($sql);
		
		$sessionUserId = getUserId();
		$seriesId = $_GET['seriesId'];
		$showId = $_GET['showId'];
		$assignmentId = $_GET['assignmentId'];
		// $shotId = $_GET['shotId'];
		$updateDB = $_GET['updateDB'];
		
		if($updateDB > 0){
			updateDB($updateDB);
		}

		if ($result->num_rows > 0) {

			while($row = $result->fetch_assoc()) {
				$projectName = $row["projectName"];
				#$projectName = $row5["showName"];
				$shotId = $row["shotId"];
				$shotName = $row["shotName"];
				$shotDescription = $row["shotDescription"]; 
				$startFrame = $row["startFrame"];
				$endFrame = $row["endFrame"];

				echo "<table width='100%' border=2 cellpadding=10%><tr><td>";
				echo "<h3>Shot Information</h3>";
				echo "<p>Name: " . $shotName . "</p>";
							
				if ($pageType==1){
					echo "<form action='./assignment?assignmentId=1'>";
					echo "<input type='text' name='assignmentId' value='$assignmentId' style='display:none'></input>";
				} else {
					echo "<form action='./shot?shotId=1'>";
				}

				echo "Description:<br><textarea name='shotDescription' rows='10' cols='150' style=width:800px>" . $shotDescription . "</textarea>";
				
				// Hidden Values
				echo "<input type='text' name='sessionUserId' value='$sessionUserId' style='display:none'></input>";
				echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
				echo "<input type='text' name='showId' value='$showId' style='display:none'></input>";
				echo "<input type='text' name='shotId' value='$shotId' style='display:none'></input>";
				echo "<input type='text' name='updateDB' value=10 style='display:none'></input>";
	
				echo "<br><table style='width:300px' border=2 cellpadding=10%><tr>";
				echo "<th align ='left'>Start Frame:</th>";
				echo "<td align='left'><input type='text' name='startFrame' value='". $startFrame . "'></td>";
				echo "<th align ='left'>End Frame:</th>";
				echo "<td align='left'><input type='text' name='endFrame' value='". $endFrame . "'></td></tr>";
				echo "</table><br>";
				
				echo "<input type='submit' value='Update Shot Information'>";

				echo "</td></tr></table><br>";

				echo "</form>";
			}
		} else {
			echo "<table width='100%' border=2 cellpadding=10%><tr><td>";
			echo "<h3>Shot Information</h3>";
			echo "Query of shot table returned no results";
			echo "</td></tr></table><br>";
		}
		close_magma();
	}
	
	// This is a function that is used on the Series, Show, Shot and Element pages.	
	// ELEMENT INFORMATION
	function getElementData($elementId,$pagetype){
		$conn = connect_magma();
		
		$sql = "SELECT * FROM elementTable WHERE elementId='". $elementId ."'";
		$result = $conn->query($sql);
		
		$sessionUserId = getUserId();
		$seriesId = $_GET['seriesId'];
		$showId = $_GET['showId'];
		$assignmentId = $_GET['assignmentId'];
		// $shotId = $_GET['shotId'];
		$updateDB = $_GET['updateDB'];
		
		if($updateDB > 0){
			updateDB($updateDB);
		}

		if ($result->num_rows > 0) {

			while($row = $result->fetch_assoc()) {
				# $projectName = $row["projectName"];
				$elementId = $row["elementId"];
				$elementName = $row["elementName"];
				$elementDescription = $row["elementDescription"]; 

				if ($pageType==1){
					echo "<form action='./assignment?assignmentId=1'>";
					echo "<input type='text' name='assignmentId' value='$assignmentId' style='display:none'></input>";
				} else {
					echo "<form action='./element?elementId=1'>";
				}
				
				// Hidden Values
				echo "<input type='text' name='sessionUserId' value='$sessionUserId' style='display:none'></input>";
				echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
				echo "<input type='text' name='showId' value='$showId' style='display:none'></input>";
				echo "<input type='text' name='elementId' value='$elementId' style='display:none'></input>";
				echo "<input type='text' name='updateDB' value=11 style='display:none'></input>";
				
				echo "<table width='100%' border=2 cellpadding=10%><tr><td>";
				echo "<h3>Element Information</h3>";
				echo "<p>Name: " . $elementName . "</p>";
				echo "Description:<br><textarea name='elementDescription' rows='10' cols='150' style=width:800px>" . $elementDescription . "</textarea>";
				echo "<br>";
				echo "<input type='submit' value='Update Element Information'>";
				echo "</td></tr></table><br>";
				echo "</form>";
			}
		} else {
			echo "<table width='100%' border=2 cellpadding=10%><tr><td>";
			echo "<h3>Element Information</h3>";
			echo "Query of element table returned no results";
			echo "</td></tr></table><br>";
		}
			
		close_magma();
	}
	
	// XXXXXXXXX SERIES BUILDER XXXXXXXXX
	
	function seriesManagement(){
		$seriesId = $_GET['seriesId'];

		$sessionUserId = getUserId();
		$userAuthenticated = getUserAuthentication($sessionUserId,6);
		
		if($userAuthenticated == 1){
			$conn = connect_magma();
			
			// Default Values
			// 1 == Create
			$databaseAction = 1;
			$seriesTitle = "Enter Series Title";
			$seriesCode = "enterSeriesCode";
			$newSeriesNumber = getHighestSeriesNumber() + 0001;
			$seriesNumber = sprintf("%04d",$newSeriesNumber);
			$seriesDescription = "128 Character Max.";
			$resolutionWidth = 1920;
			$resolutionHeight = 1080;
			$aspectRatioId = 4;
			$framesPerSecondId = 1;
			$unitOfMeasurementId = 5;
			$handles = 4;
			$seriesStatus = 1;
			
			// Forms should direct the content to a create/update series page.
			
			if ($seriesId > 0)
			{
				//  A series has been selected so a MySQL Query needs to be run to return the series data and update the variables.
				// echo "seriesId has a value and it is " . $seriesId;
				
				$sql = "SELECT * FROM seriesTable WHERE seriesId = " . $seriesId;
				$result = $conn->query($sql);
				
				while($row = $result->fetch_assoc()) {
					// 0 == Update
					$databaseAction = 0;
					$seriesTitle = $row['seriesTitle'];
					$seriesCode = $row['seriesCode'];
					$seriesNumber = sprintf("%04d", $row['seriesNumber']);
					$seriesDescription = $row['seriesDescription'];
					$resolutionWidth = $row['resolutionWidth'];
					$resolutionHeight = $row['resolutionHeight'];
					$aspectRatioId = $row['aspectRatioId'];
					$framesPerSecondId = $row['framesPerSecondId'];
					$unitOfMeasurementId = $row['unitOfMeasurementId'];
					$handles = $row['handles'];
					$seriesStatus = $row['seriesStatus'];
					
					echo "<h5><a href='./series-management'>Reset Series</a></h5>";
				}
				
			} else {
				$sql = "SELECT * FROM seriesTable ORDER BY seriesTitle ASC ";
				$result = $conn->query($sql);
				echo "<h1>Existing Series</h1>";
				echo "<form action='series-management?seriesId=1'>";
				echo "<select name='seriesId' onchange='this.form.submit()';>";
				echo "<option value='0'>Select Series Title</option>";
				while($row = $result->fetch_assoc()) {
					echo "<option value='" . $row['seriesId'] . "'>";
					echo $row['seriesTitle'] . "</option>";
				}
				echo "</select>";
				echo "</form>";
			}
			
			echo "<br><h1>New Series</h1>";
			echo "<form action='../process-series?seriesId=1'>";
			
			// Hidden Text 
			echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
			echo "<input type='text' name='databaseAction' value='$databaseAction' style='display:none'></input>";
			
			// Visible Text - Read Only
			// echo "<input type='text' name='projectNumber' value='$projectNumber' readonly></input><hr>";
			
			echo "<h4>Series Title</h4>";
			echo "<input type='text' name='seriesTitle' value='$seriesTitle'></input><br>";
			echo "<h4>Series Code - 16 char max. camelCased</h4>";
			echo "<input type='text' name='seriesCode' value='$seriesCode'></input><br>";
			echo "<h4>Series Number - </h4>";
			echo "<input type='text' name='seriesNumber' value='$seriesNumber' maxlength='4' style='width: 35px;'></input><br>";
			echo "<h4>Series Desription</h4>";
			echo "<textarea name='seriesDescription' rows='10' cols='10'>$seriesDescription</textarea><br>";
			echo "<h4>Resolution</h4>";
			echo "<input type='text' name='resolutionWidth' value='$resolutionWidth' maxlength='4' style='width: 35px;'></input>";
			echo " ";
			echo "<input type='text' name='resolutionHeight' value='$resolutionHeight' maxlength='4' style='width: 35px;'></input><br>";
			aspectRatioDropdown($aspectRatioId);	
			framesPerSecondDropdown($framesPerSecondId);
			unitOfMeasurementDropdown($unitOfMeasurementId);
			echo "<h4>Handles</h4>";
			echo "<input type='text' name='handles' value='$handles' maxlength='1' style='width: 10px;'></input><br>";
			
			echo "<h4>Series Status</h4>";
			
			echo "<input type='radio' name='seriesStatus' value='1'";
			if ($seriesStatus==1){
				echo " checked='checked'";
			}
			echo "> Active<br>";
			
			echo "<input type='radio' name='seriesStatus' value='0'";
			if ($seriesStatus==0){
				echo " checked='checked'";
			}
			echo "> Inactive<br>";
			
			if ($seriesId > 0){
				echo "<br><br><input type='submit' value='Update'>";
			}else{
				echo "<br><br><input type='submit' value='Create'>";
			}
		
			echo "</form>";
			
			close_magma();
		} else {
			echo "This page requires a user with project management level of permissions to correctly function.";
		}
	}
	
	// This function makes folders on the fileserver for the series that was just created. 
	function processSeries(){
		
		
		// Pull in the data from the URL
		$databaseAction = $_GET['databaseAction'];
		
		//$seriesTitle = $_GET['seriesTitle'];
		$seriesNumber = $_GET['seriesNumber'];

		$seriesCode = $_GET['seriesCode'];

		$conn = connect_magma();
		
		// Check to see if we are going to Update or a Create the Series
		if ($databaseAction == 0){
			// Update Series in Database
			updateDB(12);
			echo "<h3>Series has been updated</h3>";
		} else if ($databaseAction == 1){
			// Create Series in Database and build filesystem
			updateDB(13);
			echo "<h3>Series has been created</h3>";
		}

		// system('net use M: "\\\\192.168.254.4\\Projects" !Abundance00 /user:php.user /persistent:no>nul 2>&1');
		$projectPath = '/media/projects/' . $seriesNumber . '/';
		makeFolders($projectPath);
		// system('net use N: "\\\\192.168.254.4\\Production" !Abundance00 /user:php.user /persistent:no>nul 2>&1');
		$productionPath = '/media/production/' . $seriesNumber . "_" . $seriesCode . '/';
		makeFolders($productionPath);
		
		/*
		// Check to see if the folder already exists.
		if(file_exists($projectPath)){
			echo "Didn't make project directory.  It already existed.<br>";
		} else {
			if(mkdir($projectPath,0777)){
				echo "Series directory on projects has been created.<br>";
			} else {
				echo "Failed to create Series directory on projects.<br>";
			}
		}
		
		if(file_exists(productionPath)){
			echo "Didn't make production directory. It already existed.<br>";
		} else {
			if(mkdir($productionPath,0777)){
				echo "Series directory on production has been created.<br>";
			} else {
				echo "Failed to create Series directory on production.<br>";
			} 
		}
		*/
	}
	
	function showManagement(){
		
		$seriesId = $_GET['seriesId'];
		$showId = $_GET['showId'];

		$sessionUserId = getUserId();
		$userAuthenticated = getUserAuthentication($sessionUserId,6);
		
		if($userAuthenticated == 1){
			$conn = connect_magma();
			
			// Default Values
			// 1 == Create
			$databaseAction = 1;
			# $database2Action = 1;
			// NOTE: I don't think the values below are not currently being returned.
			$seriesNumber = $_GET['seriesNumber'];
			// $showNumber = $_GET['showNumber'];
			//$showId = $_GET['showId;'];
			$showTitle = "Enter new Show Title";
			$showDescription = "Enter Show Description";
			
			// Forms should direct the content to a create/update series page.
			
			if ($seriesId > 0)
			{
				//  A series has been selected so a MySQL Query needs to be run to return the series data and update the variables.
				// echo "seriesId has a value and it is " . $seriesId;
				
				$seriesCode = getSeriesCode($seriesId);
				
				// This select statement will hopefully pull back only one record.
				$sql = "SELECT * FROM seriesTable WHERE seriesId = " . $seriesId;
				$result = $conn->query($sql);
				
				while($row = $result->fetch_assoc()) {
					// 0 == Update
					# $databaseAction = 0;
					$seriesTitle = $row['seriesTitle'];
					$seriesNumber = sprintf("%04d", $row['seriesNumber']);

					echo "<h5><a href='./show-management'>Reset Series</a></h5>";

					// NOTE: This is a good spot to put the shotTable stuff since it only runs if it knows what the series number is, which is kinda required.
					echo "<h4>Series Title: $seriesTitle</h4>";
					echo "<h4>Series Number: $seriesNumber</h4>";

					if ($showId > 0)
					{
						// This select statement will hopefully pull back only one record.
						$sql2 = "SELECT * FROM showTable WHERE showId = " . $showId;
						$result2 = $conn->query($sql2);
						
						// Populate variables to be displayed below.
						while($row2 = $result2->fetch_assoc()) {
							$databaseAction = 0;
							$showNumber = sprintf("%03d", $row2['showNumber']);
							$showTitle = $row2['showTitle'];
							$showDescription = $row2['showDescription'];
						}
					} else {
						// No showId must have been provided.  So let's look for the available shows for a selected series.
						$sql2 = "SELECT * FROM showTable WHERE seriesId = " . $seriesId . " ORDER BY showTitle ASC ";
						$result2 = $conn->query($sql2);
											
						echo "<h4>Select Show</h4>";
						echo "<form action='show-management?seriesId=1&showId=1'>";

						// Hidden Value
						echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
						echo "<input type='text' name='seriesCode' value='$seriesCode' style='display:none'></input>";
						
						echo "<select name='showId' onchange='this.form.submit()';>";
						echo "<option value='0'>Select an existing Show Title</option>";
						while($row2 = $result2->fetch_assoc()) {
							echo "<option value='" . $row2['showId'] . "'>";
							echo $row2['showTitle'] . "</option>";
						}
						echo "</select>";

						$nextShowNumber = (getHighestShowNumber($seriesId) + 1);
						$showNumber = sprintf("%03d", $nextShowNumber);
						
						echo "</form>";
					}
				}
				// echo "<br><h1>New Show</h1>";
				echo "<form action='../process-show?seriesId=1&showId=1'>";

				// Hidden Text
				echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
				echo "<input type='text' name='seriesNumber' value='$seriesNumber' style='display:none'></input>";
				echo "<input type='text' name='showId' value='$showId' style='display:none'></input>";
				echo "<input type='text' name='databaseAction' value='$databaseAction' style='display:none'></input>";
				# echo "<input type='text' name='database2Action' value='$database2Action' style='display:none'></input>";

				echo "<h4>Show Title</h4>";
				echo "<input type='text' name='showTitle' value='$showTitle'></input><br>";
				echo "<h4>Show Number</h4>";
				if ($showId > 0){
					// A showId already exists.  We are updating an existing show.
					echo "<input type='text' name='showNumber' value='$showNumber' maxlength='3' style='width: 35px;' readonly></input><br>";
				} else {
					// A showId does not exist.
					echo "<input type='text' name='showNumber' value='$showNumber' maxlength='3' style='width: 35px;'></input><br>";
				}
				echo "<h4>Show Desription</h4>";
				echo "<textarea name='showDescription' rows='10' cols='10'>$showDescription</textarea><br>";

				if ($showId > 0){
					echo "<br><br><input type='submit' value='Update'>";
				}else{
					echo "<br><br><input type='submit' value='Create'>";
				}
				echo "</form>";
			} else {
				$sql = "SELECT * FROM seriesTable ORDER BY seriesTitle ASC ";
				$result = $conn->query($sql);
				echo "<h3>Select a Series</h3>";
				echo "<form action='show-management?seriesId=1'>";
				echo "<select name='seriesId' onchange='this.form.submit()';>";
				echo "<option value='0'>Select a Series Title</option>";
				while($row = $result->fetch_assoc()) {
					echo "<option value='" . $row['seriesId'] . "'>";
					echo $row['seriesTitle'] . "</option>";
				}
				echo "</select>";
				echo "</form>";
			}
			close_magma();
		} else {
			echo "This page requires a user with project management level of permissions to correctly function.";
		}
	}

	// This function makes folders on the fileserver for the show that was just created. 
	function processShow(){

		$seriesNumber = $_GET['seriesNumber'];
		$seriesCode = $_GET['seriesCode'];
		$showNumber = $_GET['showNumber'];

		// Pull in the data from the URL
		$databaseAction = $_GET['databaseAction'];
		// $database2Action = $_GET['database2Action'];

		$conn = connect_magma();

		// Check to see if we are going to Update or a Create the Series
		if ($databaseAction == 0){
			// Update Show in Database
			updateDB(14);
			echo "<h3>Show has been updated</h3>";
		} else if ($databaseAction == 1){
			// Create Show in Database
			updateDB(15);
		}

		// Build filesystem
		$phaseSql = "SELECT * FROM phaseTable";
		$phaseResult = $conn->query($phaseSql);

		// Loop through each phase and make a folder in the show directory.
		while($row = $phaseResult->fetch_assoc()) {

			$phasePath = "/media/projects/" . $seriesNumber . "/" . $showNumber . "/" . $row['phaseName'] . "/";
			makeFolders($phasePath);

			$phaseId = $row['phaseId'];
			# echo "<p>phaseId = ". $phaseId . "</p>";
			if ($phaseId != 2)
			{
				// Loop through each division and make a folder in the path directory.
				$divisionSql = "SELECT * FROM divisionOptionsTable WHERE phaseId = " . $phaseId;
				$divisionResult = $conn->query($divisionSql);

				while($row2 = $divisionResult->fetch_assoc()) {
					$divisionPath = $phasePath . $row2['divisionCode'] . "/";
					makeFolders($divisionPath);
				}
			}
		}

		$productionPath = "/media/production/" . $seriesNumber . "_" . $seriesCode . "/" . $showNumber . "/";
		makeFolders($productionPath);
		echo "<h3>Show has been created</h3>";
	}

	function shotManagement(){
		echo '<h1>Shot Management</h1>';

		$seriesId = $_GET['seriesId'];
		$showId = $_GET['showId'];
		$shotId = $_GET['shotId'];

		$sessionUserId = getUserId();
		$userAuthenticated = getUserAuthentication($sessionUserId,6);

		if($userAuthenticated == 1){

			$conn = connect_magma();

			// Default Values
			// 1 == Create
			// $seriesDatabaseAction = 1;
			// $showDatabaseAction = 1;
			$databaseAction = 1;

			$shotName = "0000A";
			$shotDescription = "Enter new Shot Description";
			$startFrame = 1;
			$endFrame = 250;

			// Check to see if seriesId is in the URL
			if ($seriesId > 0) {

				// if a seriesId is greater than 0, a series has been selected and the show information may be preseted.
				// This select statement will hopefully pull back only one record.
				$sql = "SELECT * FROM seriesTable WHERE seriesId = " . $seriesId;
				$result = $conn->query($sql);

				while($row = $result->fetch_assoc()) {
					// 0 == Update
					// $databaseAction = 0;
					$seriesTitle = $row['seriesTitle'];
					$seriesNumber = sprintf("%04d", $row['seriesNumber']);

					// Show link to reset series
					echo "<h5><a href='./shot-management'>Reset Series</a></h5>";

					// NOTE: This is a good spot to put the shotTable stuff since it only runs if it knows what the series number is, which is kinda required.
					echo "<h4>Series Title: $seriesTitle</h4>";
					echo "<h4>Series Number: $seriesNumber</h4>"; 

					// Check to see if the showId is in the URL
					if ($showId > 0) {
						// if a shotID is greater than 0, a show has been selected and the shot information may be presented.
						// This select statement will hopefully pull back only one record.
						$sql2 = "SELECT * FROM showTable WHERE showId = " . $showId;
						$result2 = $conn->query($sql2);

						// Populate variables to be displayed below.
						while($row2 = $result2->fetch_assoc()) {
							$showNumber = sprintf("%03d", $row2['showNumber']);
							$showTitle = $row2['showTitle'];
							// $showDescription = $row2['showDescription'];
						}

						echo "<h4>Show title: $showTitle</h4>";
						echo "<h4>Show Number: $showNumber</h4>";
						$projectId = $seriesNumber . $showNumber ;

						if ($shotId > 0){
							// A shot has been selected.  Populate the variables.
							$sql3 = "SELECT * FROM shotTable WHERE shotId = " . $shotId;
							$result3 = $conn->query($sql3);
							// Populate variables to be displayed below.
							while($row3 = $result3->fetch_assoc()) {
								$projectName = $row3['projectName'];
								$shotId = $row3['shotId'];
								$shotName = $row3['shotName'];
								$shotDescription = $row3['shotDescription'];
								$startFrame = $row3['startFrame'];
								$endFrame = $row3['endFrame'];
								$projectId = $row3['projectId'];
							}
							$databaseAction = 0;
						} else {
							// A shot has not been selected. Present a dropdown box.
							$sql3 = "SELECT * FROM shotTable WHERE projectId = " . $projectId . " ORDER BY shotName ASC ";
							$result3 = $conn->query($sql3);
							echo "<h4>Select Shot</h4>";
							echo "<form action='shot-management?seriesId=1&showId=1&shotId=1'>";

							// Hidden Value
							echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
							echo "<input type='text' name='showId' value='$showId' style='display:none'></input>";

							// Shot Dropdown
							echo "<select name='shotId' onchange='this.form.submit()';>";
							echo "<option value='0'>Select an existing Shot Name</option>";

							while($row3 = $result3->fetch_assoc()) {
								echo "<option value='" . $row3['shotId'] . "'>";
								echo $row3['shotName'] . "</option>";
							}
							echo "</select>";
							echo "</form>";

						}
						echo "<form action='../process-shot?seriesId=1&showId=1&shotId=1'>";

						// Hidden Value
						echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
						echo "<input type='text' name='showId' value='$showId' style='display:none'></input>";
						echo "<input type='text' name='projectName' value='$projectName' style='display:none'></input>";
						echo "<input type='text' name='projectId' value='$projectId' style='display:none'></input>";
						echo "<input type='text' name='databaseAction' value='$databaseAction' style='display:none'></input>";
						echo "<input type='text' name='shotId' value='$shotId' style='display:none'></input>";

						// Shot Name
						echo "<input type='text' name='shotName' value='$shotName' maxlength='5' style='width: 50px;'></input><br>";

						// Shot Description
						echo "<textarea name='shotDescription' rows='10' cols='10'>$shotDescription</textarea><br>";

						// Start Frame
						echo "<input type='text' name='startFrame' value='$startFrame' maxlength='5' style='width: 50px;'></input><br>";

						// End Frame
						echo "<input type='text' name='endFrame' value='$endFrame' maxlength='5' style='width: 50px;'></input><br>";

						if ($shotId > 0){
							echo "<br><br><input type='submit' value='Update'>";
						}else{
							echo "<br><br><input type='submit' value='Create'>";
						}

						echo "</form>";


					} else {
						// No showId must have been provided.  So let's look for the available shows for a selected series.
						$sql2 = "SELECT * FROM showTable WHERE seriesId = " . $seriesId . " ORDER BY showTitle ASC ";
						$result2 = $conn->query($sql2);

						echo "<h4>Select Show</h4>";
						echo "<form action='shot-management?seriesId=1&showId=1'>";

						// Hidden Value
						echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";

						echo "<select name='showId' onchange='this.form.submit()';>";
						echo "<option value='0'>Select an existing Show Title</option>";
						while($row2 = $result2->fetch_assoc()) {
							echo "<option value='" . $row2['showId'] . "'>";
							echo $row2['showTitle'] . "</option>";
						}
						echo "</select>";

						// $nextShowNumber = (getHighestShowNumber($seriesId) + 1);
						// $showNumber = sprintf("%03d", $nextShowNumber);

						echo "</form>";
					}
				}
			} else {
				$sql = "SELECT * FROM seriesTable ORDER BY seriesTitle ASC ";
				$result = $conn->query($sql);
				echo "<h3>Select a Series</h3>";
				echo "<form action='shot-management?seriesId=1'>";
				echo "<select name='seriesId' onchange='this.form.submit()';>";
				echo "<option value='0'>Select a Series Title</option>";
				while($row = $result->fetch_assoc()) {
					echo "<option value='" . $row['seriesId'] . "'>";
					echo $row['seriesTitle'] . "</option>";
				}
				echo "</select>";
				echo "</form>";
			}

			close_magma();
		} else {
			echo "This page requires a user with project management level of permissions to correctly function.";
		}
	}

	// This function makes folders on the fileserver for the show that was just created. 
	function processShot(){

		// Pull in the data from the URL
		$seriesId = $_GET['seriesId'];
		$seriesNumber = getSeriesNumber($seriesId);
		// $seriesNumber = $_GET['seriesNumber'];
		$showId = $_GET['showId'];
		$showNumber = getShowNumber($showId);
		// $showNumber = $_GET['showNumber'];
		$projectName = $_GET['projectName'];
		$shotId = $_GET['shotId'];
		$shotName = $_GET['shotName'];
		$projectShotName = $seriesNumber . "_" . $showNumber . "_" . $shotName;

		$databaseAction = $_GET['databaseAction'];
		// $database2Action = $_GET['database2Action'];

		$conn = connect_magma();

		// Check to see if we are going to Update or a Create the Series
		if ($databaseAction == 0){
			// Update Shot in Database
			updateDB(16);
			echo "Shot has been updated";
		} else if ($databaseAction == 1){
			// Create Shot in Database
			updateDB(17);
		}

		// create zip and rend buckets both locally on the network, as well as on Amazon AWS
		$zipName = $projectShotName . "_zip";
		makeBucket($zipName);
		$rendName = $projectShotName . "_rend";
		makeBucket($rendName);

		$phaseSql = "SELECT * FROM phaseTable";
		$phaseResult = $conn->query($phaseSql);

		// Loop through each phase and make a folder in the show directory.
		while($row = $phaseResult->fetch_assoc()) {


			$phasePath = "/media/projects/" . $seriesNumber . "/" . $showNumber . "/" . $row['phaseName'] . "/";

			// Phase folders have been already made.
			//makeFolders($phasePath);

			$phaseId = $row['phaseId'];

			// This is to test if we are in the prod phase.  prod == 2
			if ($phaseId == 2)
			{
				for ($i = 1; $i <= 2; $i++){
					// Loop through each division for a specified category and make a folder in the division directory.

					// Anim Folder structure.
					if ($i == 1){
						$divisionCategoryCode = "2d";
					}else if ($i == 2){
						$divisionCategoryCode = "3d";
					}

					// divisionCategoryId of 1 == 2danim
					$animSql = "SELECT * FROM divisionOptionsTable WHERE phaseId = " . $phaseId . " AND divisionCategoryId = " . $i;
					$animResult = $conn->query($animSql);

					while($row2 = $animResult->fetch_assoc()) {
						$animPath = $phasePath . $projectShotName . "/" .$divisionCategoryCode . "/" . $row2['divisionCode'] . "/";
						makeFolders($animPath);
					}

					$folderSql = "SELECT * FROM folderTable WHERE phaseId = ". $phaseId ;
					$folderResult = $conn->query($folderSql);
					while($row3 = $folderResult->fetch_assoc()) {
						$folderPath = $phasePath . $projectShotName . "/" . $row3['folderName'] . "/";
						makeFolders($folderPath);
					}
				}
			
			}
		}
		// $productionPath = "/media/production/" . $seriesNumber . "/" . $showNumber . "/";
		// makeFolders($productionPath);
	}
		
	function elementManagement(){
		echo '<h1>Element Management</h1>';
		
		$seriesId = $_GET['seriesId'];
		$showId = $_GET['showId'];
		$projectName = $_GET['projectName'];
		$elementId = $_GET['elementId'];

		$sessionUserId = getUserId();
		$userAuthenticated = getUserAuthentication($sessionUserId,6);
		
		if($userAuthenticated == 1){

			$conn = connect_magma();
			
			// Default Values
			// 1 == Create
			// $seriesDatabaseAction = 1;
			// $showDatabaseAction = 1;
			$databaseAction = 1;
			
			$elementName = "";
			$elementDescription = "Enter new Element Description";
			#$startFrame = 1;
			#$endFrame = 250;
			
			// Check to see if seriesId is in the URL
			if ($seriesId > 0) {
				
				// if a seriesId is greater than 0, a series has been selected and the show information may be preseted.
				// This select statement will hopefully pull back only one record.
				$sql = "SELECT * FROM seriesTable WHERE seriesId = " . $seriesId;
				$result = $conn->query($sql);
				
				while($row = $result->fetch_assoc()) {
					// 0 == Update
					// $databaseAction = 0;
					$seriesTitle = $row['seriesTitle'];
					$seriesNumber = sprintf("%04d", $row['seriesNumber']);

					// Show link to reset series
					echo "<h5><a href='./shot-management'>Reset Series</a></h5>";

					// NOTE: This is a good spot to put the shotTable stuff since it only runs if it knows what the series number is, which is kinda required.
					echo "<h4>Series Title: $seriesTitle</h4>";
					echo "<h4>Series Number: $seriesNumber</h4>"; 
			
					// Check to see if the showId is in the URL
					if ($showId > 0) {
						// if a shotID is greater than 0, a show has been selected and the shot information may be presented.
						// This select statement will hopefully pull back only one record.
						$sql2 = "SELECT * FROM showTable WHERE showId = " . $showId;
						$result2 = $conn->query($sql2);
							
						// Populate variables to be displayed below.
						while($row2 = $result2->fetch_assoc()) {
							$showNumber = sprintf("%03d", $row2['showNumber']);
							$showTitle = $row2['showTitle'];
							// $showDescription = $row2['showDescription'];
						}
						
						echo "<h4>Show title: $showTitle</h4>";
						echo "<h4>Show Number: $showNumber</h4>";
						
						$projectId = $seriesNumber . $showNumber ;

						if ($elementId > 0){
							// An element has been selected.  Populate the variables.
							$sql3 = "SELECT * FROM elementTable WHERE elementId = " . $elementId;
							$result3 = $conn->query($sql3);
								
							// Populate variables to be displayed below.
							while($row3 = $result3->fetch_assoc()) {
								$projectName = $row3['projectName'];
								$elementId = $row3['elementId'];
								$elementName = $row3['elementName'];
								$elementDescription = $row3['elementDescription'];
								#$startFrame = $row3['startFrame'];
								#$endFrame = $row3['endFrame'];
								$projectId = $row3['projectId'];
							}
							
							$databaseAction = 0;
							
						} else {
							
							// An element has not been selected. Present a dropdown box.
							$sql3 = "SELECT * FROM elementTable WHERE projectId = " . $projectId . " ORDER BY elementName ASC ";
							$result3 = $conn->query($sql3);
												
							echo "<h4>Select Element</h4>";
							
							echo "<form action='element-management?seriesId=1&showId=1&elementId=1'>";

							// Hidden Value
							echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
							echo "<input type='text' name='showId' value='$showId' style='display:none'></input>";

							// Element Dropdown
							echo "<select name='elementId' onchange='this.form.submit()';>";
							echo "<option value='0'>Select an existing Element Name</option>";
							
							while($row3 = $result3->fetch_assoc()) {
								echo "<option value='" . $row3['elementId'] . "'>";
								echo $row3['elementName'] . "</option>";
							}
							
							echo "</select>";

							echo "</form>";

						}
						echo "<form action='../process-element?seriesId=1&showId=1&elementId=1'>";

						// Hidden Value
						echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
						echo "<input type='text' name='showId' value='$showId' style='display:none'></input>";
						echo "<input type='text' name='projectName' value='$projectName' style='display:none'></input>";
						echo "<input type='text' name='projectId' value='$projectId' style='display:none'></input>";
						echo "<input type='text' name='databaseAction' value='$databaseAction' style='display:none'></input>";
						echo "<input type='text' name='elementId' value='$elementId' style='display:none'></input>";

						// Element Name
						echo "<input type='text' name='elementName' value='$elementName' maxlength='8' style='width: 50px;'></input><br>";

						// Element Description
						echo "<textarea name='elementDescription' rows='10' cols='10'>$elementDescription</textarea><br>";

						// Start Frame
						# echo "<input type='text' name='startFrame' value='$startFrame' maxlength='5' style='width: 50px;'></input><br>";

						// End Frame
						# echo "<input type='text' name='endFrame' value='$endFrame' maxlength='5' style='width: 50px;'></input><br>";

						if ($elementId > 0){
							echo "<br><br><input type='submit' value='Update'>";
						}else{
							echo "<br><br><input type='submit' value='Create'>";
						}

						echo "</form>";

					} else {
						// No elementId must have been provided.  So let's look for the available shows for a selected series.
						$sql2 = "SELECT * FROM showTable WHERE seriesId = " . $seriesId . " ORDER BY showTitle ASC ";
						$result2 = $conn->query($sql2);

						echo "<h4>Select Show</h4>";
						echo "<form action='element-management?seriesId=1&showId=1'>";

						// Hidden Value
						echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";

						echo "<select name='showId' onchange='this.form.submit()';>";
						echo "<option value='0'>Select an existing Show Title</option>";
						while($row2 = $result2->fetch_assoc()) {
							echo "<option value='" . $row2['showId'] . "'>";
							echo $row2['showTitle'] . "</option>";
						}
						echo "</select>";

						// $nextShowNumber = (getHighestShowNumber($seriesId) + 1);
						// $showNumber = sprintf("%03d", $nextShowNumber);

						echo "</form>";
					}
				}
			} else {
				$sql = "SELECT * FROM seriesTable ORDER BY seriesTitle ASC ";
				$result = $conn->query($sql);
				echo "<h3>Select a Series</h3>";
				echo "<form action='element-management?seriesId=1'>";
				echo "<select name='seriesId' onchange='this.form.submit()';>";
				echo "<option value='0'>Select a Series Title</option>";
				while($row = $result->fetch_assoc()) {
					echo "<option value='" . $row['seriesId'] . "'>";
					echo $row['seriesTitle'] . "</option>";
				}
				echo "</select>";
				echo "</form>";
			}

			close_magma();
		} else {
			echo "This page requires a user with project management level of permissions to correctly function.";
		}
	}

	// This function makes folders on the fileserver for the show that was just created. 
	function processElement(){

		// Pull in the data from the URL
		$seriesId = $_GET['seriesId'];
		$seriesNumber = getSeriesNumber($seriesId);
		$showId = $_GET['showId'];
		$showNumber = getShowNumber($showId);
		$projectName = $_GET['projectName'];
		$elementId = $_GET['elementId'];
		$elementName = $_GET['elementName'];
		$projectElementName = $seriesNumber . "_" . $showNumber . "_" . $elementName;

		$databaseAction = $_GET['databaseAction'];

		$conn = connect_magma();

		// Check to see if we are going to Update or a Create the Series
		if ($databaseAction == 0){
			// Update Element in Database
			updateDB(18);
			echo "Element has been updated";
		} else if ($databaseAction == 1){
			// Create Element in Database
			updateDB(19);
		}

		// create zip and rend buckets both locally on the network, as well as on Amazon AWS
		$zipName = $projectElementName . "_zip";
		makeBucket($zipName);
		$rendName = $projectElementName . "_rend";
		makeBucket($rendName);

		$phaseSql = "SELECT * FROM phaseTable";
		$phaseResult = $conn->query($phaseSql);

		// Loop through each phase and make a folder in the show directory.
		while($row = $phaseResult->fetch_assoc()) {


			$phasePath = "/media/projects/" . $seriesNumber . "/" . $showNumber . "/" . $row['phaseName'] . "/";

			// Phase folders have been already made.
			// makeFolders($phasePath);

			$phaseId = $row['phaseId'];

			// This is to test if we are in the prod phase.  prod == 2
			if ($phaseId == 2)
			{
				for ($i = 1; $i <= 2; $i++){
					// Loop through each division for a specified category and make a folder in the division directory.

					// Anim Folder structure.
					if ($i == 1){
						$divisionCategoryCode = "2d";
					}else if ($i == 2){
						$divisionCategoryCode = "3d";
					}

					// divisionCategoryId of 1 == 2danim
					$animSql = "SELECT * FROM divisionOptionsTable WHERE phaseId = " . $phaseId . " AND divisionCategoryId = " . $i;
					$animResult = $conn->query($animSql);

					while($row2 = $animResult->fetch_assoc()) {
						$animPath = $phasePath . $projectElementName . "/" .$divisionCategoryCode . "/" . $row2['divisionCode'] . "/";
						makeFolders($animPath);
					}

					$folderSql = "SELECT * FROM folderTable WHERE phaseId = ". $phaseId ;
					$folderResult = $conn->query($folderSql);
					while($row3 = $folderResult->fetch_assoc()) {
						$folderPath = $phasePath . $projectShotName . "/" . $row3['folderName'] . "/";
						makeFolders($folderPath);
					}
				}
			}
		}
	}

	// I'm an admin and I need to run this function.
	function ghops($params){
		echo $params;
		$output = exec($params);
		return $output;
	}

	function tplShow(){

		// See if the seriesId, showId or projectName was specified.  If it has been the project has been selected and can process.
		// If not we will need to supply a drop down list for the series, and then the show.

		$seriesId = $_GET['seriesId'];
		$showId = $_GET['showId'];
		$step = $_GET['step'];

		if ($step < 1){
			$step = 1;
		}

		// $projectName = $_GET['projectName'];

		$sessionUserId = getUserId();
		$userAuthenticated = getUserAuthentication($sessionUserId,6);

		if($userAuthenticated == 1){


		$conn = connect_magma();

		echo"<h1>Please note</h1><p>This command will over-write all .tpl files FOR THE SHOW YOU ARE ABOUT TO SELECT.  These files are located at...</p><p>/media/gh/ghprojects/</p><p>If you have any questions please let Steve know.</p>";

		echo "<form action='tplShow?step=1'>";
		// Hidden Fields
		echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
		echo "<input type='text' name='showId' value='$showId' style='display:none'></input>";
		echo "<p>Step <input type='text' name='step' value='$step' maxlength='1' style='width: 15px;'></input></p>";
		echo "<input type='submit' value='Update'>";
		echo "</form>";

			// Check to see if seriesId is in the URL
			if ($seriesId > 0) {

				// if a seriesId is greater than 0, a series has been selected and the show information may be preseted.
				// This select statement will hopefully pull back only one record.
				$sql = "SELECT * FROM seriesTable WHERE seriesId = " . $seriesId;
				$result = $conn->query($sql);

				while($row = $result->fetch_assoc()) {
					$seriesTitle = $row['seriesTitle'];
					$seriesNumber = sprintf("%04d", $row['seriesNumber']);

					// Show link to reset series
					echo "<h5><a href='./tplShow'>Reset Series</a></h5>";

					// NOTE: This is a good spot to put the shotTable stuff since it only runs if it knows what the series number is, which is kinda required.
					echo "<h4>Series Title: $seriesTitle</h4>";
					echo "<h4>Series Number: $seriesNumber</h4>"; 

					// Check to see if the showId is in the URL
					if ($showId > 0) {

						echo "<h4>Show Number: $showNumber</h4>"; 
						$seriesNumber = getSeriesNumber($seriesId);
						$showNumber = getShowNumber($showId);
						$projectName = $seriesNumber . "_" . $showNumber;
						$projectId = $seriesNumber . $showNumber;
						echo "<h4>Project Name: $projectName</h4>"; 
						echo "<h4>Project Id: $projectId</h4>"; 

						/*
						// Loop through all the elements
						$elementsSql = "SELECT projectName,elemntName,startFrame,endFrame FROM elementTable WHERE projectName = " . $projectName;
						$elementsResult = $conn->query($elementsSql);
						*/

						// $folderSql = "SELECT * FROM folderTable WHERE phaseId = ". $phaseId ;
						// $folderResult = $conn->query($folderSql);


						// if a showID is greater than 0, a show has been selected and the tplShow can run.
						// Loop through all the shots
						$shotsSql = "SELECT * FROM shotTable WHERE projectId = " . $projectId ;
						$shotsResult = $conn->query($shotsSql);
						// while($row3 = $folderResult->fetch_assoc()) {
						while($row1 = $shotsResult->fetch_assoc()) {
							// This is the location to the file we need output.


							$shotName = $row1['shotName'];
							$startFrame = $row1['startFrame'];
							$endFrame = $row1['endFrame'];
							$tplFile = "/media/gh/ghprojects/" . $projectName . "_" . $shotName . ".tpl";
							$zipFolder = $projectName . "_" . $shotName . "_zip";
							$rendFolder =  $projectName . "_" . $shotName . "_rend";

							// Check to see if safe mode is on.
							if( ini_get('safe_mode') ){
								// safe mode is on
								echo "<p>safe_mode is on.</p>";
							}else{
								$tplData = "shotName='_" . $shotName . "'\nstart='" . $startFrame . "'\nend='" . $endFrame . "'\nstep='" . $step . "'";
								echo "<p>Adding '" . $tplData . "' to " . $tplFile . "</p>";
								// // file_put_contents($tplFile, $tplData, FILE_APPEND | LOCK_EX);
								file_put_contents($tplFile, $tplData);
								makeBucket($zipFolder);
								makeBucket($rendFolder);
							}
						}

						// Loop through all the elements
						$elementsSql = "SELECT * FROM elementTable WHERE projectId = " . $projectId ;
						$elementsResult = $conn->query($elementsSql);

						while($row2 = $elementsResult->fetch_assoc()) {
							// This is the location to the file we need output.


							$elementName = $row2['elementName'];
							$startFrame = $row2['startFrame'];
							$endFrame = $row2['endFrame'];
							$tplFile = "/media/gh/ghprojects/" . $projectName . "_" . $elementName . ".tpl";
							$zipFolder = $projectName . "_" . $elementName . "_zip";
							$rendFolder =  $projectName . "_" . $elementName . "_rend";

							// Check to see if safe mode is on.
							if( ini_get('safe_mode') ){
								// safe mode is on
								echo "<p>safe_mode is on.</p>";
							}else{
								$tplData = "shotName='_" . $elementName . "'\nstart='" . $startFrame . "'\nend='" . $endFrame . "'\nstep='" . $step . "'";
								echo "<p>Adding '" . $tplData . "' to " . $tplFile . "</p>";
								// // file_put_contents($tplFile, $tplData, FILE_APPEND | LOCK_EX);
								file_put_contents($tplFile, $tplData);
								makeBucket($zipFolder);
								makeBucket($rendFolder);
							}
						}

					} else {
						// No elementId must have been provided.  So let's look for the available shows for a selected series.
						$sql2 = "SELECT * FROM showTable WHERE seriesId = " . $seriesId . " ORDER BY showTitle ASC ";
						$result2 = $conn->query($sql2);

						echo "<h4>Select Show</h4>";
						echo "<form action='tplShow?seriesId=1&showId=1'>";

						// Hidden Value
						echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
						echo "<input type='text' name='step' value='$step' style='display:none'></input>";

						echo "<select name='showId' onchange='this.form.submit()';>";
						echo "<option value='0'>Select an existing Show Title</option>";
						while($row2 = $result2->fetch_assoc()) {
							echo "<option value='" . $row2['showId'] . "'>";
							echo $row2['showTitle'] . "</option>";
						}
						echo "</select>";

						// $nextShowNumber = (getHighestShowNumber($seriesId) + 1);
						// $showNumber = sprintf("%03d", $nextShowNumber);

						echo "</form>";
					}
				}
			} else {
				$sql = "SELECT * FROM seriesTable ORDER BY seriesTitle ASC ";
				$result = $conn->query($sql);
				echo "<h3>Select a Series</h3>";
				echo "<form action='tplShow?seriesId=1'>";
				// Hidden Value
				echo "<input type='text' name='step' value='$step' style='display:none'></input>";
				echo "<select name='seriesId' onchange='this.form.submit()';>";
				echo "<option value='0'>Select a Series Title</option>";
				while($row = $result->fetch_assoc()) {
					echo "<option value='" . $row['seriesId'] . "'>";
					echo $row['seriesTitle'] . "</option>";
				}
				echo "</select>";
				echo "</form>";
			}

			close_magma();

		} else {
			echo "<h1>You must be logged in to view this page</h1>";
		}
	}

function submitRender(){

		// See if the seriesId, showId or projectName was specified.  If it has been the project has been selected and can process.
		// If not we will need to supply a drop down list for the series, and then the show.

		$seriesId = $_GET['seriesId'];
		$showId = $_GET['showId'];
		$shotId = $_GET['shotId'];
		$settingsId = $_GET['settingsId'];
 		$step = $_GET['step'];

		if ($step < 1){
                        $step = 1;
                }

		$sessionUserId = getUserId();
		$userAuthenticated = getUserAuthentication($sessionUserId,6);

		if($userAuthenticated == 1){

		$conn = connect_magma();

		echo"<h3>NOTE: You must copy your zip to the G: drive prior to running this operation!</h3><br>";
		echo"<h1>Submit Render</h1>";
		echo"<p>This command will create a .cfg files for the shot that you are submitting to the render farm.</p>";

		//echo "<form action='submit-render?seriesId=1'>";
		// Hidden Fields
		//echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
		//echo "<input type='text' name='showId' value='$showId' style='display:none'></input>";
		//echo "<input type='text' name='shotId' value='$shotId' style='display:none'></input>";
                //echo "<p>Step <input type='text' name='step' value='$step' maxlength='1' style='width: 15px;'></input></p>";
		//echo "<input type='submit' value='Update'>";
		//echo "</form>";

			// Check to see if seriesId is in the URL
			if ($seriesId > 0) {

				// if a seriesId is greater than 0, a series has been selected and the show information may be preseted.
				// This select statement will hopefully pull back only one record.
				$sql = "SELECT * FROM seriesTable WHERE seriesId = " . $seriesId;
				$result = $conn->query($sql);

				while($row = $result->fetch_assoc()) {
					$seriesTitle = $row['seriesTitle'];
					$seriesNumber = sprintf("%04d", $row['seriesNumber']);

					// Show link to reset series
					echo "<h5><a href='./submit-render'>Reset Series</a></h5>";

					// NOTE: This is a good spot to put the shotTable stuff since it only runs if it knows what the series number is, which is kinda required.
					echo "<h4>Series Title: $seriesTitle</h4>";
					echo "<h4>Series Number: $seriesNumber</h4>";

					// Check to see if the showId is in the URL
					if ($showId > 0) {

						echo "<h4>Show Number: $showNumber</h4>";
						$seriesNumber = getSeriesNumber($seriesId);
						$showNumber = getShowNumber($showId);
						$projectName = $seriesNumber . "_" . $showNumber;
						$projectId = $seriesNumber . $showNumber;
						echo "<h4>Project Name: $projectName</h4>";
						echo "<h4>Project Id: $projectId</h4>";

						if ($shotId > 0){
							$sql3 = "SELECT * FROM shotTable WHERE shotId = " . $shotId;
							$result3 = $conn->query($sql3);
							while($row3 = $result3->fetch_assoc()) {
								$shotName = $row3['shotName'];
								$startFrame = $row3['startFrame'];
								$endFrame = $row3['endFrame'];
							}

                                                        if ($settingsId > 0){
								// A shot has been selected.  Populate the variables.
                                                        	$sql4 = "SELECT * FROM settingsTable WHERE settingsId = " . $settingsId;
								// $sql3 = "SELECT * FROM settingsTable WHERE shotId = " . $shotId . " AND divisionId = 1 ORDER BY versionNumber DESC";  
                                                        	$result4 = $conn->query($sql4);
                                                        	// Populate variables to be displayed below.
                                                        	while($row4 = $result4->fetch_assoc()) {
                                                        	        // $projectName = $row4['projectName'];
                                                        	        //$shotId = $row4['shotId'];
                                                        	        //$shotName = $row4['shotName'];
                                                        	        //$projectId = $row4['projectId'];
	                                                	        $versionNumberPadded = "v" . sprintF("%03d", $row4["versionNumber"]);
									// $frameNumberPadded = sprintF("%04d", $currentFrame);
									// $shotName = getShotName($shotId);
									$zipFolder = $projectName . "_" . $shotName . "_zip";
									$zipPath = "/media/gh/" . $zipFolder . "/";
									$rendFolder =  $projectName . "_" . $shotName . "_rend";
									$rendPath = "/media/gh/" . $rendFolder . "/";
									$fileName = $projectName . "_" . $shotName . "_3danim_" . $versionNumberPadded;
									$zipName = $fileName . ".zip";
									$blendName = $fileName . ".blend";
									$currentFrame = $startFrame;

									while($currentFrame <= $endFrame){
										// Do this nonsense
                                                                        	// Check to see if safe mode is on.
                                                                        	if( ini_get('safe_mode') ){
                                                                        	        // safe mode is on
                                                                        	        echo "<p>safe_mode is on.</p>";
                                                                        	}else{
											$frameNumberPadded = sprintF("%04d", $currentFrame);
											$frameName = $fileName . "." . $frameNumberPadded;
                                                                        	        $tplFile = $rendPath . $projectName . "_" . $shotName . "_3danim_" . $versionNumberPadded . "." . $frameNumberPadded . ".cfg";
											$tplData = "zipBucket='" . $zipPath . "'\nrendBucket='" . $rendPath . "'\nzip='" . $zipName . "'\nblend='" . $blendName . "'\nfileName='" . $fileName . "'\nframeName='" . $frameName . "'\nstart='" . $frameNumberPadded . "'\nend='" . $frameNumberPadded . "'\nstep='1'";
                                                                        	        echo "<p>Adding '" . $tplData . "' to " . $tplFile . "</p>";
                                                                        	        file_put_contents($tplFile, $tplData);
                                                                        	        // makeBucket($zipFolder);
                                                                        	        // makeBucket($rendFolder);
                                                                        	}

										// When you are all done, increment.
										$currentFrame = $currentFrame + $step;
									}

								}
                                                        } else {
								// Code to select from all of the different versions.
								$sql4 = "SELECT * FROM settingsTable WHERE shotId = " . $shotId . " AND divisionId = 1 ORDER BY versionNumber DESC";
		                                                $result4 = $conn->query($sql4);
                	                                        echo "<h4>Select Version</h4>";
                	                                        echo "<form action='submit-render?seriesId=1&showId=1&shotId=1'>";

        	                                                // Hidden Value
        	                                                echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
        	                                                echo "<input type='text' name='showId' value='$showId' style='display:none'></input>";
                                                                echo "<input type='text' name='shotId' value='$shotId' style='display:none'></input>";
								echo "<input type='text' name='step' value='$step' style='display:none'></input>";
        	                                                // Version Dropdown
        	                                                echo "<select name='settingsId' onchange='this.form.submit()';>";
        	                                                echo "<option value='0'>Select an existing version</option>";

        	                                                while($row4 = $result4->fetch_assoc()) {
        	                                                        echo "<option value='" . $row4['settingsId'] . "'>";
        	                                                        echo $row4['versionNumber'] . "</option>";
        	                                                }
        	                                                echo "</select>";
        	                                                echo "</form>";
							}

						} else {
                                                        // A shot has not been selected. Present a dropdown box.
                                                        $sql3 = "SELECT * FROM shotTable WHERE projectId = " . $projectId . " ORDER BY shotName ASC ";
                                                        $result3 = $conn->query($sql3);
                                                        echo "<h4>Select Shot</h4>";
                                                        echo "<form action='submit-render?seriesId=1&showId=1&shotId=1'>";

                                                        // Hidden Value
                                                        echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
                                                        echo "<input type='text' name='showId' value='$showId' style='display:none'></input>";
							echo "<input type='text' name='step' value='$step' style='display:none'></input>";

                                                        // Shot Dropdown
                                                        echo "<select name='shotId' onchange='this.form.submit()';>";
                                                        echo "<option value='0'>Select an existing Shot Name</option>";

                                                        while($row3 = $result3->fetch_assoc()) {
                                                                echo "<option value='" . $row3['shotId'] . "'>";
                                                                echo $row3['shotName'] . "</option>";
                                                        }
                                                        echo "</select>";
                                                        echo "</form>";
                                                }


					} else {
						// No elementId must have been provided.  So let's look for the available shows for a selected series.
						$sql2 = "SELECT * FROM showTable WHERE seriesId = " . $seriesId . " ORDER BY showTitle ASC ";
						$result2 = $conn->query($sql2);

						echo "<h4>Select Show</h4>";
						echo "<form action='submit-render?seriesId=1&showId=1'>";

						// Hidden Value
						echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
						echo "<input type='text' name='step' value='$step' style='display:none'></input>";

						echo "<select name='showId' onchange='this.form.submit()';>";
						echo "<option value='0'>Select an existing Show Title</option>";
						while($row2 = $result2->fetch_assoc()) {
							echo "<option value='" . $row2['showId'] . "'>";
							echo $row2['showTitle'] . "</option>";
						}
					}
					echo "</select>";

					// $nextShowNumber = (getHighestShowNumber($seriesId) + 1);
					// $showNumber = sprintf("%03d", $nextShowNumber);

					echo "</form>";
				}
			} else {
				$sql = "SELECT * FROM seriesTable ORDER BY seriesTitle ASC ";
				$result = $conn->query($sql);
				echo "<h3>Select a Series</h3>";
				echo "<form action='submit-render?seriesId=1'>";
				// Hidden Value
				echo "<input type='text' name='step' value='$step' style='display:none'></input>";
				echo "<select name='seriesId' onchange='this.form.submit()';>";
				echo "<option value='0'>Select a Series Title</option>";
				while($row = $result->fetch_assoc()) {
					echo "<option value='" . $row['seriesId'] . "'>";
					echo $row['seriesTitle'] . "</option>";
				}

				echo "</select>";
				echo "</form>";
			}

	                echo "<form action='submit-render?seriesId=1'>";
	                // Hidden Fields
	                echo "<input type='text' name='seriesId' value='$seriesId' style='display:none'></input>";
	                echo "<input type='text' name='showId' value='$showId' style='display:none'></input>";
	                echo "<input type='text' name='shotId' value='$shotId' style='display:none'></input>";
			echo "<h3>Step <input type='text' name='step' value='$step' maxlength='1' style='width: 15px;'></input></h3>";
	                echo "<input type='submit' value='Update'>";
	                echo "</form>";

			close_magma();

		} else {
			echo "<h1>You must be logged in to view this page</h1>";
		}
	}

	function makeBucket($bucketName){
		// echo "makeBucket";
		$processFile="/media/process/toProcess.sh";

		// Check to see if safe mode is on.
		if( ini_get('safe_mode') ){
			// safe mode is on
			echo "<p>safe_mode is on.</p>";
		}else{
			/*
			echo "<p>safe_mode is off.</p>";
			$output = exec('whoami');
			echo "whoami? I am " .$output;
			*/

			/*
			if (is_writable("/media/process/")){
				echo "<p>the directory is writable.</p>";
			} else {
				echo "<p>the directory is not writable.</p>";
			}
			*/

			$command2Process = "mkdir -p /media/gh/" . $bucketName . " ;\n";
			echo "<p>Adding '" . $command2Process . "' to " . $processFile . "</p>";
			file_put_contents($processFile, $command2Process, FILE_APPEND | LOCK_EX);

			// $output = exec($command2Process);

			// $tempPath = "/media/process/poop/";
			// echo "<p>tempPath is " . $tempPath . "</p>"; 
			// mkdir($tempPath,0777);

		}
		// code to make buckets both locally and on Amazon AWS.
		// It is a requirement that the function check to see if the buckets exist.  If the buckets exist, the make bucket commands should not be run.
	}

	// This will be a function that we can pass a path to and it will determine if the folders in the path already exist, and if not, create them.
	function makeFolders($filePath){
		// $processPath="/media/process/";
		$processFile="/media/process/toProcess.sh";


		// Check to see if safe mode is on.
		if( ini_get('safe_mode') ){
			// safe mode is on
			echo "<p>safe_mode is on.</p>";
		}else{
			/*
			echo "<p>safe_mode is off.</p>";
			$output = exec('whoami');
			echo "whoami? I am " .$output;
			*/

			/*
			if (is_writable("/media/process/")){
				echo "<p>the directory is writable.</p>";
			} else {
				echo "<p>the directory is not writable.</p>";
			}
			*/

			$command2Process = "mkdir -p " . $filePath . " ;\n";
			echo "<p>Adding '" . $command2Process . "' to " . $processFile . "</p>";
			file_put_contents($processFile, $command2Process, FILE_APPEND | LOCK_EX);

			// $output = exec($command2Process);

			// $tempPath = "/media/process/poop/";
			// echo "<p>tempPath is " . $tempPath . "</p>"; 
			// mkdir($tempPath,0777);

		}

		# Some code external code.
		# ssh call to linux machine and issue batch command that could complete this task.
		// It is requirement the function check to see if files exist.  If files do exist, the make dir command should not be run. 
	}

?>
