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

for item in items.each():
    # Get the item key
    item_key = item.key()
    feedbackRef = item.val()['rated']
    # If both you and the offerer have provided feedback, delete the item reference
    if(int(feedbackRef) == 1):
        try:
            # Check the offer key
            offers = db.child("items").child(item_key).child("offer").child().get()
            for offer in offers.each():
                # Check if the item has had feedback given
                offerRated = offer.val()['rated']
                # Delete the item from the database
                if(int(offerRated) == 1):
                    db.child("items").child(item_key).remove()
                    break
        except TypeError:
            print("No offers")
        except KeyError:
            print("No offers")
        except AttributeError:
            print("No offers")
