# RESTful Symfony Applications

## Code Challenge 5 - Content Negotiation

### Tasks

- set the correct format option (JSON or XML) of the current Request
- therefore read the Accept request header and negotiate the content-type using Will Durand's negotiation library

### Solution

- require the willdurand/negotiation library: `composer require willdurand/negotiation`
- create an `RequestFormatListener` and subscribe on the `kernel.request` Event (priority: 8)
- adjust the READ workshop controller and use the `Negotiator` class
- use the `Negotiator` class and get the Accept-Header content

```
$negotiator = new Negotiator();
$acceptHeader = $negotiator->getBest($request->getAcceptableContentTypes(), self::ACCEPTED_CONTENT_TYPES);
```
        
- throw an `null` on `"*/*" === $acceptHeader`
- use `$acceptHeader->getSubPart()` to set the request format: $request->setRequestFormat($acceptHeader->getSubPart())
- add  default format json to `@Route` annotation
- update your calls to the serialize method and use `$request->getRequestFormat()` as $format argument: 

```
$serializedData = $serializer->serialize($data, $request->getRequestFormat());
```
