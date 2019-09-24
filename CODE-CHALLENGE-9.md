# RESTful Symfony Applications

## Code Challenge 9 - JSON WEB TOKEN

### Tasks

Let's set up the Authentication/Authorization for our API based on Json Web Token 

1. Implement a Token provider

- configure the security system for basic auth
- add a TokenController to retrieve a token

2. Implement a Guard

- implement a JwtGuardAuthenticator
    
### Solution

- require Symfony SecurityBundle: `composer require security`
- require LexikJWTAuthenticationBundle: `composer require lexik/jwt-authentication-bundle`
- create a private and a public key (https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#getting-started)
- adjust the config and add a TOKEN_TTL

- adjust firewall configuration (firewall for token: basic auth; firewall for api: guard authenticator)
- implement the `JwtTokenAuthenticator` extending the `AbstractGuardAuthenticator`
- configure it on the api firewall (`guard` option)
- add `@IsGranted` annotations to your controllers
- add a Authorization header to your Postman endpoints

Make things shiny:
- use the Serialize to create a nice error response in `JwtTokenAuthenticator::start()` method
- implement the `JwtTokenAuthenticator::onAuthenticationFailure()` and use the Serialize to return a HTTP 401 Unauthorized Response with a nice error message
- adjust the priority of the RequestFormatListener to be executed before the SecurityIsGrantedListener: KernelEvents::REQUEST => [['onKernelRequest', 8],]
