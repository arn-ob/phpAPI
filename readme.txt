phpAPI

Signin API Hit: //ip//phpAPI/signin.php

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
Signin API Hit: //ip//phpAPI/signup.php

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

Signin API Hit: //ip//phpAPI/verify.php

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
