import os
import pyrebase

config = {
    "apiKey": "AIzaSyA0saZpdhgWuQ5MvD81I3K09M0Wbk31c6Q",
    "authDomain": "bisonswap-a0af2.firebaseapp.com",
    "databaseURL": "https://bisonswap-a0af2.firebaseio.com",
    "projectId": "bisonswap-a0af2",
    "storageBucket": "bisonswap-a0af2.appspot.com",
    "messagingSenderId": "307753783953",
    "serviceAccount": "/home/patrick/bison.json"
}

# Initialize Firebase
firebase = pyrebase.initialize_app(config)

db = firebase.database()
items = db.child("items").get()
uploads = '/var/www/html/uploads/'
storage = firebase.storage()

for item in items.each():
    # Get the reference for the stored image
    img_ref = item.val()['pic_1']
    # Download the image
    print(uploads + img_ref)
    try:
        storage.child(img_ref).download(uploads + img_ref)
    except:
        print("None")

#storage.child("music player.jpg").download(uploads + "downloaded.jpg")
