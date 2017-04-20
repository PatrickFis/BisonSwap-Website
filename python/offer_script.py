import pyrebase
import time

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

# Read the items database
db = firebase.database()
items = db.child("items").get()

# Check which items should be removed
# Time since the Unix epoch
epoch_time = int(time.time()) * 1000
for item in items.each():
    # Get the item key
    item_key = item.key()
    try:
        # Get the offer using the item key
        offer = db.child("items").child(item_key).child("offer").child().get()
        #print(offer.val()[list(offer.val())[0]]['date'])
        # Get the time that the offer was submitted
        date_ref = offer.val()[list(offer.val())[0]]['date']
        # Skip the deletion if the offer was accepted
        accepted = offer.val()[list(offer.val())[0]]['accepted']
        if(int(accepted) == 1):
            continue
        # Remove the offer if it is older than 3 days
        if(epoch_time - int(date_ref)) > 259200000:
            db.child("items").child(item_key).child("offer").child().remove()
    except TypeError:
        print("No offers")
    except KeyError:
        print("No offers")
    except AttributeError:
        print("No offers")
