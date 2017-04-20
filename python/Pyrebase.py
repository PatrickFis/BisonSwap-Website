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

# Connect to database and push a test value
#db = firebase.database()
#data = {"name": "TEST PUSH FROM PYTHON"}
#db.child("test").child("python")
#db.child("test").push(data)

# Read the items database
db = firebase.database()
items = db.child("items").get()
for item in items.each():
    # This prints all of the storage paths for uploaded images
    print(item.val()['pic_1'])

storage = firebase.storage()
# Get download URLS
for item in items.each():
    img_ref = item.val()['pic_1']
    #print(storage.child(img_ref).get_url(None))
    url = storage.child(img_ref).get_url(None)
    #print(url)
    db.child("items/" + item.key()).update({"url":url})
