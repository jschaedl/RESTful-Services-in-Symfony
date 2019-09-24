# RESTful Symfony Applications

## Code Challenge 3 - Pagination

### Tasks

- add pagination to your Workshop and Attendee list actions using a `page` and `size` query parameter

### Solution

- require the PagerFantaBundle: `composer require white-october/pagerfanta-bundle`
- add a `getQueryBuilder` method to repository
- create DoctrineORMAdapter and a PagerFanta object
- introduce query params `page` and `size`
- update the response and add the properties `items`, `total` and `count`
- make things re-usable and create a `PaginatedCollection` object and a `PaginationFactory` to encapsulate your pagination logic
