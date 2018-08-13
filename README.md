## Run with Docker
- Install [Docker](https://docs.docker.com/engine/installation)
- Run the installation script "bash ./dshell.sh install"
- This will build the docker image
- It will also run the unit tests
- It will start the application container

## How to Run Unit Tests
- Run "bash ./dshell.sh phpunit"

## To Post a Ping Request
- curl -X POST \
  http://localhost:9999/ping \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/xml' \
  -d '<?xml version="1.0" encoding="UTF-8"?>
<ping_request>
  <header>
    <type>ping_request</type>
    <sender>VOICEWORKS</sender>
    <recipient>DEMO</recipient>
    <reference>ping_request_12345</reference>
    <timestamp>2013-12-19T16:45:10.950+01:00</timestamp>
  </header>
  <body>
    <echo>Ping Request Test!</echo>
  </body>
</ping_request>
'

## To Post a Reverse Request
- curl -X POST \
  http://localhost:9999/reverse \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/xml' \
  -d '<?xml version="1.0" encoding="UTF-8"?>
<reverse_request>
  <header>
    <type>reverse_request</type>
    <sender>VOICEWORKS</sender>
    <recipient>DEMO</recipient>
    <reference>reverse_request_12345</reference>
    <timestamp>2013-12-19T16:45:10.950+01:00</timestamp>
  </header>
  <body>
    <string>Reverse Request Test!</string>
  </body>
</reverse_request>
'

## Notes
- Everything regarding the application requirements is my own code
- What is not mine is the Micro Framework PHP Slim and the Dependency Injection Container
- Most of the logic can be found inside the XML directory and the Middleware directory
- The interface bindings to the container are in the definitions.php file inside the config directory