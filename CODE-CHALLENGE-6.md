# RESTful Symfony Applications

## Code Challenge 6 - POST vs. PUT

### Tasks

- implement Controllers for creating and updating Attendees and Workshops
- both should be possible with json and xml

### Solution

- create a `deserializeRequestContent(Request $request, string $type)` method in `ApiController` to handle deserialization for JSON and XML
- introduce a `updateBy($otherEntity)` method in the Workshop and Attendee entity
- use the EntityManager to save the object into the database
- for CREATE: use method `POST`, return a HTTP 201 (Created) Status code and set the Location header with the help of the `UrlGeneratorInterface`
- for UPDATE: use method `PUT`, return a HTTP 204 (No Content) Status code and leave the response body empty
