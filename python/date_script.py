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
    date_ref = item.val()['date']
    acceptedOffer = 0
    # Delete the item if it's older than 14 days
    if(epoch_time - int(date_ref)) > 1210000000:
        try:
            # Check if the item has an accepted offer
            offers = db.child("items").child(item_key).child("offer").child().get()
            for offer in offers.each():
                # Check if any of the offers have been accepted
                accepted = offer.val()['accepted']
                #print(accepted)
                if(int(accepted) == 1):
                    acceptedOffer = 1
            if(acceptedOffer == 1):
                continue
            else:
                db.child("items").child(item_key).remove()
        except TypeError:
            print("No offers")
        except KeyError:
            print("No offers")
        except AttributeError:
            print("No offers")
