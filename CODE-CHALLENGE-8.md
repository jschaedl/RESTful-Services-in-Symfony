# RESTful Symfony Applications

## Code Challenge 8 - Let's implement the missing pieces

### Tasks

Let's implement the missing pieces:

- deleting Attendees and Workshops
- adding/removing an Attendee to/from a Workshop

### Solution

- add a DeleteController for attendees and workshops
- delete the Entity from the database using the EntityManager
- return a HTTP 204 (No Content) Status code and an empty Reponse body

- add a Controller for adding and removing a attendee to/from a workshop
- use the `@ParamConverter` Annotation to have action argument $attendee: `@ParamConverter("attendee", options={"id": "attendee_id"})`
- add a `canAttend(Workshop $workshop): bool` method to Attendee Entity to implement your business logic
