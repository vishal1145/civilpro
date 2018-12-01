
<!-- Firebase App is always required and must be first -->
<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-functions.js"></script>

<!-- Comment out (or don't include) services that you don't want to use -->
<!-- <script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-storage.js"></script> -->

<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase.js"></script>
<script>
  // Initialize Firebase
  // TODO: Replace with your project's customized code snippet
    var config = {
			apiKey: "AIzaSyArieJpHL4br9nY_QAFASB8uYcaH-NTCXE",
			authDomain: "civil-pro-tes.firebaseapp.com",
			databaseURL: "https://civil-pro-tes.firebaseio.com",
			projectId: "civil-pro-tes",
			storageBucket: "civil-pro-tes.appspot.com",
			messagingSenderId: "387767897345"
		  };

// Initialize the default app
/* var defaultApp = firebase.initializeApp(defaultAppConfig);

console.log(defaultApp.name);  // "[DEFAULT]"

// You can retrieve services via the defaultApp variable...
var defaultStorage = defaultApp.storage();
var defaultDatabase = defaultApp.database();

// ... or you can use the equivalent shorthand notation
defaultStorage = firebase.storage();
defaultDatabase = firebase.database(); */
	  firebase.initializeApp(config);
      // Get a reference to the Firebase Realtime Database
      var chatRef = firebase.database().ref();
console.log(chatRef);
      // Create an instance of Firechat
     // var chat = new FirechatUI(chatRef, document.getElementById("firechat-wrapper"));

    /*   // Listen for authentication state changes
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          // If the user is logged in, set them as the Firechat user
          chat.setUser(user.uid, "Anonymous" + user.uid.substr(10, 8));
		
        } else {
          // If the user is not logged in, sign them in anonymously
          firebase.auth().signInAnonymously().catch(function(error) {
            console.log("Error signing user in anonymously:", error);
          });
        }
      }); */
</script>
