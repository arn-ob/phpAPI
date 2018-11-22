[ phpAPI ]

IF You Face Any Bug || Req Fix Mail Me.

	arnobxtreme@gmail.com
	or
	me@stupidarnob.com

Thank You.

[ DOC Start ]

Signin API Hit: http://api.valobasha.info/signin.php

JSON:
{
	"username": "asd",
	"password": "adasd"
}

Result:

IF not match : 

[{"status":"false","msg":"Invalid username or password given. Please try again"}]

IF match: 

[
    {
        "status": true,
        "msg": "User Found",
        "user_profile": {
            "name": "asdasd",
            "id": "NTU=",
            "email": "",
            "mobile_number": "223224",
            "pic": "upload_picture/user1.jpg",
            "token": "MDEyMDI1YW0="
        }
    }
]


=============================================================================================================
Signup API Hit: http://api.valobasha.info/signup.php

JSON:
{
	"username": "arnobaxtremsses",
	"password": "adssawsd",
	"full_name": "Asrnob",
	"mobile": "01929311",
	"email": "assdsa@gmail.com"
}

Result

IF not present previous: 

[
    {
        "status": "true",
        "msg": "Thank you for signup",
        "sms": 4419
    }
]

IF present and also verified:

[
    {
        "status": "false",
        "msg":"User already exist with same mobile number or Username"
    }
]

IF present but not verified:

[
    {
        "status": false,
        "error_code": "NOT_VERIFIED",
        "sms_code": "7114"
    }
]

[ IMPORTENT NOTE: If you notice or not, here is a problem with sms code. Some time i send as a string some time i send as a number.
 thats my bad. Sorry for that. please parse/convert all sms code to int or string. it will help u to prevent my stupid mistake.  
]

================================================================================================================

Auth Verify API Hit: http://api.valobasha.info/auth_verify.php

JSON:
{
	"token": "MDcwNDA2cG0="
}

Result:

IF match:

[
    {
        "status": "true",
        "msg": "Token Verified",
        "token": "MDcxNTIycG0="
    }
]

IF not match:
[
	{
		"status":"false",
		"msg":"Token invalied"
	}
]

================================================================================================================
SMS Verify API Hit: http://api.valobasha.info/sms_verify.php

JSON: 
{
  "mobile" : "22232224",
  "sms_code" : "76"
}

IF Match: 
[
    {
        "status": true,
        "msg": "USER_VERIFIED"
    }
]

IF Not Match:
[
    {
        "status": false,
        "msg": "NOT_VERIFIED",
        "error_code": 404
    }
]

IF Verified Previously 
[
    {
        "status": true,
        "msg": "ALREADY_VERIFIED"
    }
]


================================================================================================================
Upload Picture API Hit: http://api.valobasha.info/upload_picture.php

Peramiter of form-data POST methon: 
file  
name
where
mobile
aprt_id

This is the peramiter of form-data. So here, 
file = the image file
name = name of the file including ext. Like: user1.jpg. Without extention the file will not be desplayed. Must be send the ext from 		client end
where = where to upload the file. Here two option
		1. user
		2. aprt
	user for user profile upload
	aprt is apartment pic upload
mobile =  mobile number of the user. this is req for your upload for user. For apartment you can simply set it to null
aprt_id = send the apartment id which apartment you wanted to upload pic. when u upload as a user live it null

[ for user pic u need => file, name, where, mobile ] --- Rest of the field set null
[ for apartment pic u need => file, name, where, aprt_id] --- Rest of the field set null

#################################### NEW WORK ##############################

Rent Work:

rent_api: http://api.valobasha.info/rent.php

Here all rent related task happend in this single link. Here "api" object is a selector. So choose option carefully 

API 1: Insert
 Sending JSON:
 	{
		"api": "insert",
		"title": "asd",
		"details": "asd",
		"apartid": "new",
		"type": "ad",
		"picture": "asd",
		"size": "asd",
		"room_no": "asd",
		"locationid": "new",
		"lat": "asd",
		"long": "asd",
		"location_name": "asd", 
		"nearby": "asd",
		"is_booked": "asd",
		"is_booked_conf": "asd",
		"amount": "asd"
	}
[ Note: Dont look data. Those are dummy entry. I am stupid code u know :D ]	
 
 Receving JSON:
 	[
	    {
		"status": "true",
		"msg": "Apartment Updated",
		"update": "apart"
	    },
	    {
		"status": "true",
		"msg": "Location Updated",
		"update": "location"
	    },
	    {
		"status": "true",
		"msg": "Rent Data Insert",
		"update": "rent"
	    }
	]
	
[NOTE]	
Okiee API looks good but it has a problem. For your future advantage. I did some stupid work. So read carefully. 
Look at the sending api where "apartid": "new" and "locationid": "new". The apartment and location store deferent table. So
Here "new" means you wanted to store new location and apartment. Here "new" means new entry. So you have to provide the location and 
apartment information. If you wanted to store previous location and apartment just give the id insted of new keyword. 
Here a look of the example:

 Sending JSON:
  	{
		"api": "insert",
		"title": "asd",
		"details": "asd",

		"apartid": "asdsa",

		"locationid": "asdssdw",

		"nearby": "asd",
		"is_booked": "asd",
		"is_booked_conf": "asd",
		"amount": "asd"
	}
	
 Receive JSON: 
 	[
	    {
		"status": "true",
		"msg": "Rent Data Insert",
		"update": "rent"
	    }
	]
	
So hope you understand.


API 2: For insert only location.

Sending JSON: 
	
	{
		"api": "location",
		"lat": "asdasd",
		"long": "asd",
		"location_name": "asd"
	}
	
 Receive JSON:
 	
	[
	    {
		"status": "true",
		"msg": "Location Updated",
		"update": "Location"
	    }
	]

IF fail Return
[
    {
        "Problem": "Not POST Method",
        "msg": "Check Request"
    }
]
	
	
API 3: For insert only location.	

Sending JSON: 
	{
		"api": "apartment",
		"type": "dsad",
		"picture": "asd",
		"size": "asd",
		"room_no": "asd"
	}
	
Receive JSON:

	[
	    {
		"status": "true",
		"msg": "Apartment Updated",
		"update": "apart"
	    }
	]


API 4: Search as you expected. [Note] => "api": "searchQ1"

Sending JSON:
	{
		"api": "searchQ1",
		"no" : 10,
		"number_of_item" : 10
	}

Receive JSON: 
	
[
    {
        "rent_details": {
            "no": "15",
            "rent_id": "MTI5NTE=",
            "rent_title": null,
            "rent_details": "asd",
            "location": {
                "lat": "",
                "lon": "",
                "place": ""
            },
            "apartment_type": "ad",
            "rent_amount": "asd",
            "no_of_room": "asd",
            "apartment_size": "asd",
            "booked": "asd",
            "owner_booked": "asd",
            "nearby_places": "asd",
            "rent_pictures": [
                [
                    {
                        "picture_url": "upload_picture/asd"
                    }
                ]
            ]
        }
    },
    {
        "rent_details": {
            "no": "16",
            "rent_id": "NDY0MDk=",
            "rent_title": null,
            "rent_details": "asd",
            "location": {
                "lat": "",
                "lon": "",
                "place": ""
            },
            "apartment_type": "ad",
            "rent_amount": "asd",
            "no_of_room": "asd",
            "apartment_size": "asd",
            "booked": "asd",
            "owner_booked": "asd",
            "nearby_places": "asd",
            "rent_pictures": [
                [
                    {
                        "picture_url": "upload_picture/asd"
                    },
                    {
                        "picture_url": "upload_picture/asd"
                    },
                    {
                        "picture_url": "upload_picture/userr.jpg"
                    }
                ]
            ]
        }
    },
    {
        "rent_details": {
            "no": "17",
            "rent_id": "ODczNjM=",
            "rent_title": null,
            "rent_details": "asd",
            "location": {
                "lat": "",
                "lon": "",
                "place": ""
            },
            "apartment_type": "ad",
            "rent_amount": "asd",
            "no_of_room": "asd",
            "apartment_size": "asd",
            "booked": "asd",
            "owner_booked": "asd",
            "nearby_places": "asd",
            "rent_pictures": [
                [
                    {
                        "picture_url": "upload_picture/asd"
                    },
                    {
                        "picture_url": "upload_picture/asd"
                    },
                    {
                        "picture_url": "upload_picture/userr.jpg"
                    },
                    {
                        "picture_url": "upload_picture/asd"
                    }
                ]
            ]
        }
    },
    ..........
]


[NOTE]
Here you can be see blank array. If your given peramiter search found. API should give return. If face problem let me know.
And for picture u did not told me how u wanted to handle the image. So here i return just one peramiter. And you also said your ref doc
the nearby_places has multiple object. So at my end its sql not nosql so its hard to deal with this kind of data where i dont sure how 
many you tag send. So if you store your nearby place by using separate syntex. Like , or _ any thing you like. Its easy to manage at 
java. Here i give a high length so you can send more then 1000 tag.  


API 5: Search by rent id. [Note] => "api": "searchQ2"

 Sending JSON:
 	{
		"api": "searchQ2",
		"rent_id": "MTI5NTE="
	}
 Receive JSON:
 	[
	    {
		"rent_details": {
		    "no": "22",
		    "rent_id": "NzI1MzU=",
		    "rent_title": null,
		    "rent_details": "asd",
		    "location": {
			"lat": "asd",
			"lon": "asd",
			"place": "asd"
		    },
		    "apartment_type": "ad",
		    "rent_amount": "asd",
		    "no_of_room": "asd",
		    "apartment_size": "asd",
		    "booked": "asd",
		    "owner_booked": "asd",
		    "nearby_places": "asd",
		    "rent_pictures": "asd"
		}
	    }
	]
	
	
[NOTE]
Here All API. I checked many time. Let me know if you face any problem.

[IMPORTANT]
There are lots of dunny variable let know know if you wanted to delete. Those value are for testing.
Before real life testing let me know i will delete all those fancy values


#################################### NEW WORK ##############################

Edit:

Edit API: http://api.valobasha.info/edit.php

Sending JSON:
 	{
	  "user_name" : "samplessfsusername",
	  "full_name" : "samplsefullname",
	  "email" : "sampleemail",
	  "address" : "sample address",
	  "mobile_number": "a"
	}

Here Mobile is the key for updating the json. So u have to send the number for updating the user info. So number is the id


IF True:
Return JSON:
[
    {
        "status": true
    }
]

IF False
Return JSON:
[
    {
        "status": false
    }
]




