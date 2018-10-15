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

[{"status":"true","msg":"User Found","name":"a22ddfsdasdawds","id":"t9sYkoFSA\/bmggCmthBL07zcVPg=",
            "pic":"https:\/\/freedesignfile.com\/upload\/2015\/08\/Beautiful-natural-scenery-and-sun-vector-01.jpg",
            "token":{"iat":90235,"jti":"MDkwMjM1cG0=","exp":93835}}]

=============================================================================================================
Signin API Hit: http://stupidarnob.com/phpAPI/signun.php

JSON:
{
	"username": "a22ddfsdasdawds",
	"password": "aswd",
	"full_name": "wwda",
	"mobile": "21234323"
}

Result

IF not present previous: 

[{"status":"true","msg":"Thank you for signup"}]

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


	


	





















