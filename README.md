# 🛫 Plovdiv Airport

Description:
View flights, keep up with the important data and explore new places with Plovdiv Airport's new site. This is my final project powered by Symfony for the PHP Web Module @ SoftUni.

### Used technologies:
- PHP 7
	- Symfony 3.4.30
- Design
	- HTML 5 & CSS 3
- Front-end animations
	- Plain JS
	- The library AOS
- Other technologies
	- OpenWeatherMap API
	- S3 cloud for storing photos
	- SwiftMailer (a part of Symfony) for password reset verification

-----------

# Project Details
## Entities - ```DEFINED AT DB```
### Progress
1. id			
2. event	

### Role
1. id
2. name
3. users (MANY TO MANY)
	
## Entities - ```DEFINED ON DEMAND```
### User
1. id							
2. email									
3. password					
4. fullName					
5. title		
6. image			
7. authentications (ONE TO MANY)
8. flights (MANY TO MANY)	
9. roles (MANY TO MANY)	
	
### Authentication
1. id
2. authString
3. expiryDate
4. user (MANY TO ONE)
	
### Route
1. flightNumber (=id)   		
2. company
3. from 
4. to
5. duration 					
6. seats 						
7. image
8. flights
				
### Flight
1. id						
2. route (MANY TO ONE)	
3. dateTime				
4. terminal				
5. gate					
6. baggageCheckTime		
7. checkInTime				
8. progress (MANY TO ONE)	
9. progressTime			
10. seatsTaken 				
11. price 			

## The ```Abstract``` Controller
To avoid repeating lines of code, I created a function that deals with the persistence of an entity. Also there is a function to verify that an entity is not NULL and finally, we also have got a function that creates a form array for a view.

## The ```Abstract``` Service
Holds the em and the encoder of passwords, as well as two functions to save and update an object.

## Basic idea of the Controllers, Services, Repositories
- Security -> login/logout
- Authentication -> create/reset-pass
- User -> register/profile/starred-flights
- Admin -> admin-panel/promote-to-admin
- Route -> create/edit/view/view-all
- Flight -> create/edit/delete/view/view-all/schedule

## Views (highlights)
- Flight Schedule ```Shows departures and arrivals from the previous day till the next one```
- Reset Password Email ```Sending a well-formated email to reset a password```
- 404 Page ```For production```
- Responsive landing page ```Main things to do in the site```
- A large admin panel ```Things you can do with the app```
- Forms ```Interactive despite not having a SPA Front-end```
