CSS: myStyle.css

# flutter_application_1

A new Flutter project.


# API Create User

<mark style="background-color: #49cc90; color: #fff; padding: 5px; border-radius: 3px; font-size: 18px; font-weight: 700px">**POST**</mark> api/create <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/lock.svg" width="15" height="15" style="float:right;"> 
    
### API Request
    {

        "name":"traveler",
        "email":"traveler@gmail.com",
        "location":"USA"
    }


### API Respond 

    {
        
        "$id": "1",
        "id": 7076,
        "name": "traveler",
        "email": "traveler@gmail.com",
        "profilepicture": "https://www.adequatetravel.com/ATMultimedia//Images/userimageicon.png",
        "location": "USA",
        "createdat": "2021-10-14T12:05:59.7235182Z"
        
    }

# Get All User
This API returns all users in the organization

<mark style="background-color: #61affe; color: #fff; padding: 5px; border-radius: 3px; font-size: 18px; font-weight: 700px">**GET**</mark> api/list <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/solid/lock.svg" width="15" height="15" style="float:right;"> 



### API Response

<div style="background:#fff;overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.2em .6em;height:400px">
    
    {
    "$id": "1",
    "page": 1,
    "per_page": 10,
    "totalrecord": 2812,
    "total_pages": 282,
    "data": [
        {
            "$id": "2",
            "id": 1,
            "name": "ashish thapliyal",
            "email": "Ashulive6123@gmail.com",
            "profilepicture": "https://www.adequatetravel.com/ATMultimedia/Images/1a30600f-3b07-4797-b883-981b455f2e84.png",
            "location": "USA",
            "createdat": "2020-04-26T12:21:05.7103885"
        },
        {
            "$id": "3",
            "id": 2,
            "name": "Anand Prakash",
            "email": "prak.anand95@gmail.com",
            "profilepicture": "https://www.adequatetravel.com/ATMultimedia//Images/userimageicon.png",
            "location": "USA",
            "createdat": "2020-04-26T12:21:42.8669234"
        },
        {
            "$id": "4",
            "id": 3,
            "name": "Anand Prakash",
            "email": "1661677300651859",
            "profilepicture": "https://www.adequatetravel.com/ATMultimedia//Images/userimageicon.png",
            "location": "USA",
            "createdat": "2020-04-26T12:23:38.8303108"
        },
        {
            "$id": "5",
            "id": 5,
            "name": "Neeraj Singh",
            "email": "neirajsingh101@gmail.com",
            "profilepicture": "https://www.adequatetravel.com/ATMultimedia/Images/c1c163c4-5972-42df-b128-c535ca3c1035.png",
            "location": "USA",
            "createdat": "2020-04-26T14:32:19.2965268"
        },
        {
            "$id": "6",
            "id": 6,
            "name": "Vikash Kumar Shah",
            "email": "adktest12@gmail.com",
            "profilepicture": "https://www.adequatetravel.com/ATMultimedia//Images/userimageicon.png",
            "location": "USA",
            "createdat": "2020-04-26T15:02:16.6330683"
        },
        {
            "$id": "7",
            "id": 7,
            "name": "Raju Prasad",
            "email": "raju.nsit@gmail.com",
            "profilepicture": "https://www.adequatetravel.com/ATMultimedia/Images/5e914f8f-7eb7-4895-838f-09e0fe4afda1.png",
            "location": "Delhi Noida Direct Flyway, New Friends Colony, New Delhi, Delhi 110024, India",
            "createdat": "2020-04-26T15:44:01.3315904"
        },
        {
            "$id": "8",
            "id": 8,
            "name": "Adequate Infosoft",
            "email": "contact@adequateinfosoft.com",
            "profilepicture": "https://www.adequatetravel.com/ATMultimedia//Images/userimageicon.png",
            "location": "USA",
            "createdat": "2020-04-26T17:17:15.2711201"
        },
        {
            "$id": "9",
            "id": 9,
            "name": "Ashok Patel",
            "email": "ashokpatel457@gmail.com",
            "profilepicture": "https://www.adequatetravel.com/ATMultimedia/UserProfileCover/9/11ee4354-89d5-48c2-8edc-900e0d5fa93f.png",
            "location": "Noida, Uttar Pradesh, India",
            "createdat": "2020-04-26T17:17:47.4475925"
        },
        {
            "$id": "10",
            "id": 10,
            "name": "Vikash Shah",
            "email": "1564091363743796",
            "profilepicture": "https://www.adequatetravel.com/ATMultimedia//Images/userimageicon.png",
            "location": "USA",
            "createdat": "2020-04-26T17:31:22.4311495"
        },
        {
            "$id": "11",
            "id": 11,
            "name": "Brigette Jewell",
            "email": "brigettejewell.90897@gmail.com",
            "profilepicture": "https://www.adequatetravel.com/ATMultimedia//Images/userimageicon.png",
            "location": "USA",
            "createdat": "2020-04-26T18:42:50.4394587"
        }
    ]
    }
</div>   

# MYSQL Script

### SQL script
    Create table user (
        id   int NOT NULL AUTO_INCREMENT,
        name nvarchar (100) NOT NULL,
        email nvarchar (100) NOT NULL ,
        picture nvarchar (100) ,
        location nvarchar (100) ,
        createdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) ;   

### Create Index
    create unique index user_idx on user (email);
    

