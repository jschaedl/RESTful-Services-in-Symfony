# RESTful Symfony Applications

## Code Challenge 7 - Validation

### Tasks

- introduce validation for the creating and updating Workshops and Attendees

### Solution

- require the symfony validator: `composer require validator`
- add validation constraints to your Entity properties (NotBlank, Email)
- inject the validator service into your `ApiController` and use it in `deserializeRequestContent(Request $request, string $type)` method
- for now throw an `BadRequestHttpException` on validation errors
