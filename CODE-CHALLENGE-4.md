# RESTful Symfony Applications

## Code Challenge 4 - HATEOAS

### Tasks

- introduce HATEOAS links for your read and list representations of Workshops and Attendees
- use the JSON-HAL format

### Solution

- add a `$_links` property to the `PaginatedCollection` class (annotate the getter with `@SerializedName("_links")`)
- introduce a `addlink(string $rel, string $href)` method in the `PaginatedCollection` class
- add a `routeName` argument to the `PaginationFactory::createCollection()` method
- add `UrlGeneratorInterface` as dependency of `PaginationFactory`
- add links to the created `PaginatedCollection` (self, next, prev, first, last)
- update the call of `PaginationFactory::createCollection()` and add the routeName 
- adjust the normalizers and add `$data['_link']['self']['href']` (remember to check for is_array($data))
- adjust the normalizers and add `$data['_link']['collection']['href']` (remember to check for is_array($data))