importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js');

var firebaseConfig = {
   			  apiKey: 'api-key',
			  authDomain: 'project-id.firebaseapp.com',
			  databaseURL: 'https://project-id.firebaseio.com',
			  projectId: 'project-id',
			  storageBucket: 'project-id.appspot.com',
			  messagingSenderId: 'sender-id',
			  appId: 'app-id',
			  measurementId: 'G-measurement-id',
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
