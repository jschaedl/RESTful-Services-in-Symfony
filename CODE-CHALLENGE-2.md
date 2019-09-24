# RESTful Symfony Applications

## Code Challenge 2 - Serialization

### Tasks

- use the Serialize Component to transform Workshops and Attendees into a JSON string
- use Symfony's `JsonResponse` to return the generated JSON
    
### Solution

- require the serializer component: `composer require serializer`
- inject the Serializer into your Controllers
- serialize your Entity
- create a custom `Normalizer` (implement `ContextAwareNormalizerInterface`) for your Workshop and Attendee Entity
- return a JsonResponse
- remove the `toArray` method in your Entity

### Problem 1: No snake_case property names anymore

```
# config/packages/framework.yaml
framework:
    # ...
    serializer:
        name_converter: 'serializer.name_converter.camel_case_to_snake_case'
```
### Problem 2: Adding an attendee (with ID=1) to a workshop and calling GET /attendees/1 will result in a CircularReferenceException  

```
# php
$defaultContext = [
    AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
        return $object->getFirstname() . ' ' . $object->getLastname();
    },
];

$serializedAttendee = $this->serializer->serialize($attendee, 'json', $defaultContext);
```
