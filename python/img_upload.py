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

uploads = '/var/www/html/uploads'

for files in os.walk(uploads):
  for file in files:
    imgs = os.path.join(file)

storage = firebase.storage()

for i in range(0, len(imgs)):
    #storage.child(imgs[i].replace('~', '/')).put(uploads + '/' + imgs[i])
    storage.child(imgs[i]).put(uploads + '/' + imgs[i])

# # Import
# from gcloud import storage
#
# # Initialize
# client = storage.Client()
# bucket = client.get_bucket('bisonswap-a0af2.appspot.com')
#
# # Download
# #blob = bucket.get_blob('remote/path/to/file.txt')
# #print blob.download_as_string()
#
# # Upload
# blob2 = bucket.blob('imgtest.jpg')
# blob2.upload_from_filename(filename='/home/patrick/images~ZxNPU2WLthcretRrOrp0b86bmKc2~car.jpg')
