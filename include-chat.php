<?php 
	$server_root = $_SERVER['DOCUMENT_ROOT'];
	include($server_root."/civilpro/config/config.php");
	$obj = new connection();
	$con = $obj->connect(); 

	$get_email = "SELECT * FROM employee  where empl_id=".$_GET['id'];   //where user_id=".$_GET['id']
	$email_result = mysqli_query($con,$get_email);
$row = $email_result->fetch_assoc();
?>
<html>
	<head>
	<meta charset="utf-8" />

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/3.3.0/firebase.js"></script>

    <!-- Firechat -->
    <link rel="stylesheet" href="https://cdn.firebase.com/libs/firechat/3.0.1/firechat.min.css" />
    <script src="https://cdn.firebase.com/libs/firechat/3.0.1/firechat.min.js"></script>

    <!-- Custom CSS -->
    <style>
      #firechat-wrapper {
        height: 475px;
        max-width: 325px;
        padding: 10px;
        border: 1px solid #ccc;
        background-color: #fff;
        margin: 50px auto;
        text-align: center;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: 0 5px 25px #666;
        -moz-box-shadow: 0 5px 25px #666;
        box-shadow: 0 5px 25px #666;
      }
    </style>
  </head>

  <!--
    Example: Anonymous Authentication

    This example uses Firebase Simple Login to create "anonymous" user sessions in Firebase,
    meaning that user credentials are not required, though a user has a valid Firebase
    authentication token and security rules still apply.

    Requirements: in order to use this example with your own Firebase, you'll need to do the following:
      1. Apply the security rules at https://github.com/firebase/firechat/blob/master/rules.json
      2. Enable the "Anonymous" authentication provider in Forge
      3. Update the URL below to reference your Firebase
      4. Update the room id for auto-entry with a public room you have created
   -->
  <body>
    <div id="firechat-wrapper"></div>
    <script type="text/javascript">
		// Initialize Firebase SDK
		/* test Account Details
		var config = {
			apiKey: "AIzaSyArieJpHL4br9nY_QAFASB8uYcaH-NTCXE",
			authDomain: "civil-pro-tes.firebaseapp.com",
			databaseURL: "https://civil-pro-tes.firebaseio.com"
		}; 
		*/
	
		var config	=	{
							apiKey: "AIzaSyADHIkJzTFzSI2xVvmG8mpAXyojkQ9XCRc",
							authDomain: "civil-pro-ace33.firebaseapp.com",
							databaseURL: "https://civil-pro-ace33.firebaseio.com",
							projectId: "civil-pro-ace33",
						};
	  
	  
      firebase.initializeApp(config);

      // Get a reference to the Firebase Realtime Database
      var chatRef = firebase.database().ref();

      // Create an instance of Firechat
      var chat = new FirechatUI(chatRef, document.getElementById("firechat-wrapper"));

      // Listen for authentication state changes
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
		var email = user.email;
		console.log(user.email);
          // If the user is logged in, set them as the Firechat user
		  //console.log(chat);
          chat.setUser(user.uid, user.email.substr(0, 7));
        } else {
         // If the user is not logged in, sign them in anonymously
         
		   var email = '<?php echo $row['email']; ?>';
           var password = '<?php echo $row['password']; ?>';
		  
				firebase.auth().createUserWithEmailAndPassword(email,password).catch(function(error) {
				// Handle Errors here.
				var errorCode = error.code;
				var errorMessage = error.message;

				});	
        }
      });
    </script>
  </body>
</html>

 
