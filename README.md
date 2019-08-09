# TODO

## Entities and Configurations
- Add documentation - for last (TODO -> README)
- Uploadable annotations for Route/User images - ✅
- Add AWS mappings - ✅
- Add Security - ✅
- Add Authentication & Authorisation
- Repository as a Service - ✅
- Constraints and verifications
- Login, Register -> check if anonymous

## Functionality
0. Home
- Landing - ✅
- Base - ✅
1. User 
- Register ✅, Login ✅, Profile ✅, Edit ✅
- (Extra) Reset Password via Email
2. Route 
- C ✅, R ✅, U ✅ 
- View All ✅
3. Flight 
- C ✅, R ✅, U ✅, D ✅
- View Departures/Arrivals ✅
4. Favourite flight (Many to many User-Flight)
5. Reset Password - Table Authentication:
- Long id (Authentication string), expiry date and user_id (string id put as query)

## Finalisation of the project
- Password Change
- Favorite Flight
- Add labels on forms
- Verify that an entity exists
- Verify that seatsTaken <= seatsAll
- Constraints!!!
- Final checks - be aware of dates, constraints and security
- Improve code quality
- If time, improve form rendering (a lot repeating)
- Split logic into an Admin Controller
- ?USER_EMPLOYEE
- TEST THE SITE WITH: Unauthenticated people, USER_ROLE people and USER_ADMIN