# RESTful Services in Symfony

## Jan Schädlich | Software Developer @ SensioLabs Deutschland GmbH

### Workshop am 25.09.2019 auf der SymfonyLive Berlin 2019

> RESTful Apis are everywhere. In diesem Workshop lernt ihr die Grundlagen zu REST und wie Ihr mit Symfony eine RESTful Applikation entwickelt. 
> Vormittags starten wir mit den Basics und werden uns am Nachmittag mit Advanced Themen rund um REST und API Design beschäftigen. 
> Zudem wird es zu jedem Themenbereich kleine Code Challenges geben und ihr könnt das Gelernte somit sofort in die Praxis umsetzen. 
> Um von diesem Workshop wirklich profitieren zu können, solltet ihr bitte eueren eigenen Laptop mit gewohnter Entwicklungsumgebung mitbringen. 
> Neben IDE (oder Texteditor) braucht ihr eine aktuelle Version von PHP und Composer.

Code written for the "RESTful Services in Symfony" workshop at SymfonyLive Berlin 2019.

This is example code that is not production-ready. It is intended for studying and learning purposes.

(c) 2019 Jan Schädlich All rights reserved.

## Präsentation

Die Slides zum Workshop können unter [contact@sensiolabs.de](mailto://contact@sensiolabs.de) angefragt werden. 

## Installation

    # checkout the project
    $ git clone git@github.com:jschaedl/RESTful-Services-in-Symfony.git

    # install all dependencies
    $ composer install
    
    # copy the database file to /var
    $ cp data/data.db var/.
   
## Tools

- Symfony Binary: https://symfony.com/download
- Postman App: https://www.getpostman.com/downloads
  
## Code Challenge

Für eine 2-tägige Konferenz müssen Workshops und Teilnehmer erfasst werden.
Workshops dauern jeweils einen Tag. 
Alle Workshops haben ein Teilnehmerlimit von 25 Personen. 
Jeder Teilnehmer kann jeweils nur an einem Workshop pro Tag teilnehmen. 

Wir werden eine API bauen, mit der man Workshops organisieren kann.
Unsere API soll folgenden grundlegende features bieten:

- Auflisten aller Workshops
- Lesen eines einzelnen Workshops
- Erstellen eines Workshops
- Aktualisieren eines Workshops
- Löschen eines Workshops
- Auflisten aller Teilnehmer
- Lesen eines einzelnen Teilnehmer
- Erstellen eines Teilnehmers
- Aktualisieren eines Teilnehmers
- Löschen eines Teilnehmers
- Hinzufügen eines Teilnehmers zu einem Workskop
- Entfernen eines Teilnehmers aus einem Workshop
- Das Auflisten von Workshops und Teilnehmern soll eine Paginierung unterstützen 
- Die API soll JSON und XML unterstützen

Zudem wollen wir den Zugriff auf unsere API wie folgt beschränken:

- das Auflisten aller Workshops ist für anonyme Benutzer erlaubt
- das Lesen eines einzelnen Workshops ist nur für eingeloggte Benutzer mit der Rolle ROLE_USER erlaubt
- das Erstellen und Aktualisieren eines Workshops ist nur für eingeloggte Benutzer mit der Rolle ROLE_USER erlaubt
- das Löschen eines Workshops ist nur für eingeloggte Benutzer mit der Rolle ROLE_ADMIN erlaubt
- das Auflisten aller Teilnehmers ist für anonyme Benutzer erlaubt
- das Lesen eines einzelnen Teilnehmer ist nur für eingeloggte Benutzer mit der Rolle ROLE_USER erlaubt
- das Erstellen und Aktualisieren eines Teilnehmer ist nur für eingeloggte Benutzer mit der Rolle ROLE_USER erlaubt
- das Löschen eines Teilnehmer ist nur für eingeloggte Benutzer mit der Rolle ROLE_ADMIN erlaubt
- das Hinzufügen/Entfernen eines Teilnehmers zu/aus einem Workshop ist nur für eingeloggte Benutzer mit der Rolle ROLE_USER erlaubt

## Endpoints

### Workshop

HTTP Method | Endpoint
----------- | --------
 GET        | /workshops
 POST       | /workshops
 GET        | /workshops/{workshopId}
 PUT        | /workshops/{workshopId}
 DELETE     | /workshops/{workshopId}
 POST       | /workshops/{workshopId}/attendees/{attendeeId}/add
 POST       | /workshops/{workshopId}/attendees/{attendeeId}/remove

### Attendee

HTTP Method | Endpoint
----------- | --------
 GET        | /attendees
 POST       | /attendees
 GET        | /attendees/{attendeeId}
 PUT        | /attendees/{attendeeId}
 DELETE     | /attendees/{attendeeId}

## Testing

Wir werden zum testen unsere API eine Postman Collection verwenden.

Siehe: restful-services-in-symfony.postman_collection.json