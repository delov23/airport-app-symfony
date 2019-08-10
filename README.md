# TODO

## Entities and Configurations
- Add documentation - for last (TODO -> README)
- Uploadable annotations for Route/User images - ✅
- Add AWS mappings - ✅
- Add Security - ✅
- Add Authentication & Authorisation ✅
- Repository as a Service - ✅
- Constraints and verifications
- Login, Register -> check if anonymous ✅

## Functionality
0. Home
- Landing - ✅
- Base - ✅
1. User 
- Register ✅, Login ✅, Profile ✅, Edit ✅
- (Extra) Reset Password via Email ✅
2. Route 
- C ✅, R ✅, U ✅ 
- View All ✅
3. Flight 
- C ✅, R ✅, U ✅, D ✅
- View Departures/Arrivals ✅
4. Favourite flight (Many to many User-Flight) ✅
5. Reset Password - Table Authentication:
- Long id (Authentication string), expiry date and user_id (string id put as query) ✅

## Finalisation of the project
1. Final things to do
- Favorite Flight ✅
- Add labels on forms ✅
- Check if one of the airports is PLV ✅
- Make the fields full names -> PLV to Plovdiv Airport ✅
- UN-star at profile ✅
- Select menus -> selected attr ✅

2. Bonus Functionality
- Password Change ✅

3. Assertion
- Verify that an entity exists ✅
- HTML5 Validator 
- Verify that seatsTaken <= seatsAll ✅
- Constraints!!! - Custom messages ✅

4. Checks
- Final checks - be aware of dates, constraints and security
- TEST THE SITE WITH: Unauthenticated people, USER_ROLE people and USER_ADMIN

5. Code quality
- Improve code quality
- If time, improve form rendering (a lot repeating)
- Functions out of the controller closures <-> callbacks
- Split logic into an Admin Controller ✅

6. Non-code related TODO's:
- Check MIC
- Check Skype
- Add documentation