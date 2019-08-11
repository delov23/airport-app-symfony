# 🛫 Plovdiv Airport

Description:
View flights, keep up with the important data and explore new places with Plovdiv Airport's new site. This is my final project powered by Symfony for the PHP Web Module @ SoftUni.

Used technologies:
PHP 7
- Symfony 3.4.30
Design
- HTML 5 & CSS 3
Front-end animations
- Plain JS
- The library AOS
Other technologies
- OpenWeatherMap API
- S3 cloud for storing photos
- SwiftMailer (a part of Symfony) for password reset verification

# Project Details
## Entities
- DEFINED AT DB
Progress
	id			
	event		
Role
    id
    name
    users (MANY TO MANY)
	
- DEFINED ON-DEMAND
User - done
	id							
	email									
	password					
	fullName					
	title		
	image			
	authentications (ONE TO MANY)
	flights (MANY TO MANY)	
	roles (MANY TO MANY)	
	
Authentications
    id
    authString
    expiryDate
    user (MANY TO ONE)
	
Route
	flightNumber (=id)   		
	company
	from 
	to
	duration 					
	seats 						
	image 		
				
Flight
	id						
	route (MANY TO ONE)	
	dateTime				
	terminal				
	gate					
	baggageCheckTime		
	checkInTime				
	progress (MANY TO ONE)	
	progress_time			
	seatsTaken 				
	price 					

## Basic idea of the Controllers, Services, Repositories
- Security -> login, logout
- Authentication -> create/reset-pass
- User -> register/profile(my trips)
- Admin -> admin-panel/promote-to-admin
- Route -> create/edit/delete/view/view-all
- Flight -> create/edit/delete/view/view-all/schedule

## Views (highlights)
- Flight Schedule ```Shows departures and arrivals from the previous day till the next one```
- Reset Password Email ```Sending a well-formated email to reset a password```
- 404 Page ```For production```
- Responsive landing page ```Main things to do in the site```
- A large admin panel ```Things you can do with the app```
- Forms ```Interactive despite not having a SPA Front-end```