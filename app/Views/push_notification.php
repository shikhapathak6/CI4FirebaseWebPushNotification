<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Push Notification</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico" />
</head>

<body>
	<!-- SCRIPTS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>
	<script type="text/javascript">
		// Initialize the Firebase app in the service worker by passing in
		// Your web app's Firebase configuration
		// For Firebase JS SDK v7.20.0 and later, measurementId is optional
		const firebaseConfig = {
			apiKey: "AIzaSyCgkRfVkuWHOL03eQK4PGxostzq75oVahc",
			authDomain: "babaweb01239.firebaseapp.com",
			projectId: "babaweb01239",
			storageBucket: "babaweb01239.appspot.com",
			messagingSenderId: "805387171653",
			appId: "1:805387171653:web:211db03f58a83b7c47702c",
			measurementId: "G-VFGSLK4GP4"
		};


		// Initialize Firebase
		firebase.initializeApp(firebaseConfig);
		// Retrieve an instance of Firebase Messaging so that it can handle background
		// messages.
		const messaging = firebase.messaging();


		// Get registration token. Initially this makes a network call, once retrieved
		// subsequent calls to getToken will return from cache.
		messaging.getToken({
			vapidKey: 'BHkQLR9RO_ZiQgn1HYudjesQF4YdLqiGqemIb7oTwGz7eotBvGIAdCq7d4cdnAH-r7WGecGHwko2XktPxVX7sIA'
		}).then((currentToken) => {
			if (currentToken) {
				// Send the token to your server and update the UI if necessary
				// ...
				// alert(currentToken);
				//console.log(currentToken);
				$.ajax({
					url: '<?= base_url(); ?>/PushNotification/sendPushNotification',
					data: {
						token: currentToken
					},
					type: "post",
					success: function(data) {
						//alert(data);
					}

				})

			} else {
				// Show permission request UI
				console.log('No registration token available. Request permission to generate one.');
				// ...
			}
		}).catch((err) => {
			console.log('An error occurred while retrieving token. ', err);
			// ...
		});

		function IntitalizeFireBaseMessaging() {
			messaging
				.requestPermission()
				.then(function() {
					console.log("Notification Permission");
					return messaging.getToken();
				})
				.then(function(token) {
					console.log("Token : " + token);
					document.getElementById("token").innerHTML = token;
				})
				.catch(function(reason) {
					console.log(reason);
				});
		}

		messaging.onMessage(function(payload) {
			console.log(payload);
			const notificationOption = {
				body: payload.notification.body,
				icon: payload.notification.icon
			};

			if (Notification.permission === "granted") {
				var notification = new Notification(payload.notification.title, notificationOption);

				notification.onclick = function(ev) {
					ev.preventDefault();
					window.open(payload.notification.click_action, '_blank');
					notification.close();
				}
			}

		});
		messaging.onTokenRefresh(function() {
			messaging.getToken()
				.then(function(newtoken) {
					console.log("New Token : " + newtoken);
				})
				.catch(function(reason) {
					console.log(reason);
				})
		})
		IntitalizeFireBaseMessaging();
	</script>

	<!-- -->
	<h1>
		<center>Hi ! This is Notification Page</center>
	</h1>
</body>

</html>