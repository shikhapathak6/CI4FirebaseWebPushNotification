importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js');

var firebaseConfig = {
    apiKey: "AIzaSyCgkRfVkuWHOL03eQK4PGxostzq75oVahc",
			authDomain: "babaweb01239.firebaseapp.com",
			projectId: "babaweb01239",
			storageBucket: "babaweb01239.appspot.com",
			messagingSenderId: "805387171653",
			appId: "1:805387171653:web:211db03f58a83b7c47702c",
			measurementId: "G-VFGSLK4GP4"
};

firebase.initializeApp(firebaseConfig);
const messaging=firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
    console.log(payload);
    const notification=JSON.parse(payload);
    const notificationOption={
        body:notification.body,
        icon:notification.icon
    };
    return self.registration.showNotification(payload.notification.title,notificationOption);
});