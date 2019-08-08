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
- Register ✅, Login ✅, Profile ✅, Edit
- (Extra) Reset Password via Email
2. Route 
- C ✅, R ✅, U 
- View All ✅
- Delete -> make inactive
3. Flight 
- C ✅, R, U
- View Departures/Arrivals ✅
- Search for flight and make a reservation 
- Delete -> make completed
4. Reservation 
- Book, Preview 
- Get Ticket At Email

## Things to check out
- Security:
```
    /**
     * @Security("is_granted('ROLE_USER') 
     * and 
     * is_granted('POST_SHOW', subject="post")")
     * POST_SHOW -> Voter
     */
    public function viewPost()
    {

    }
```
https://symfony.com/doc/3.4/security/voters.html
