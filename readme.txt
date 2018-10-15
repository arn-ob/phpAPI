phpAPI

Signin API Hit: http://stupidarnob.com/phpAPI/signin.php

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
        "status": "true",
        "msg": "User Found",
        "name": "arnobxtreme",
        "id": "MjI=",
        "pic": "https://freedesignfile.com/upload/2015/08/Beautiful-natural-scenery-and-sun-vector-01.jpg",
        "token": {
            "iat": 44346,
            "jti": "MDQ0MzQ2cG0=",
            "exp": 47946
        }
    }
]

=============================================================================================================
Signin API Hit: http://stupidarnob.com/phpAPI/signup.php

JSON:
{
	"username": "arnobxtremes",
	"password": "adasd",
	"full_name": "Arnob",
	"mobile": "01991"
}

Result

IF not present previous: 

[{"status":"true","msg":"Thank you for signup","sms":"Verification Code 7114"}]

IF present:

[{"status":"false","msg":"User already exist with same mobile number or Username"}]

================================================================================================================

Signin API Hit: http://stupidarnob.com/phpAPI/verify.php

JSON:
{
	"token":{
		"iat":802320,
		"jti":"MDgwMzIwcG0=",
		"nbf":80330,
		"exp":80390
		}
}

Result:

IF match:

[{"status":"true","msg":"Token Verified","token":{"iat":50628,"jti":"MDUwNjI4cG0=","exp":54228}}]

IF not match:

[{"status":"false","msg":"Token invalied"}]

#################################### NEW WORK ##############################

Rent Work:

rent_api: http://stupidarnob.com/phpAPI/rent.php

Here all rent related task happend in this single link. Here "api" object is a selector. So choose option carefully 

API 1: 
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
		"no_of_item": "2",
		"start": "1",
		"end": "20",
		"order": "ASC"
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
		    "rent_pictures": "asd"
		}
	    },
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
		    "rent_pictures": "asd"
		}
	    }
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












