Web 3 - lab test

- time allowed = 110 minutes
- open book - paper and electronic
- bring your laptop and do all your work on your laptop
    - ensure your laptop is setup for PHP work before the test takes place!

to start:

    - download provided Symfony project
    - cd into that folder
    - composer install, to populate /vendor folder
    - vendor\bin\simple-phpunit, to complete simple-phpunit install (and first run)

to finish:

    - delete folders:
        /vendor
        /var/cache
    - ZIP up your work
    - upload to Moodle


NOTES FOR THIS TEST:
--------------------

- the classes relate to a simple Money Exchange system

- the inputs are the amount of money (in Euro) and the currency to change into

- the outputs are the amount in the requested currency, and the commission charge for making the exchange

- some currencies are valid (e.g. 'sterling'), unrecognised currencies are not valid

- an exception will be thrown if the amount is too little (minimum amount of money to exchange is 1 Euro )

- an exception will be thrown if the currency is not valid

- small amounts of money incur a minimum commission change, larger amounts of money are charged at 2.5% of the Euro amount

- exchange rates for this test are:
    Euro 1.0 = Canadian Dollar 1.5
    Euro 1.1 = Sterling 1.0


Question 1: Utility class
--------------------------
1a)
Write a Utility class that passes all the provided tests in directory: /tests/Util
- Some marks are awarded for the quality of your identifiers

1b)
Demonstrate the use of data providers by adding at least 1 methods that takes parameterised input from arrays received from a data provider method.

Your data provider should supply at least 3 sets of data for testing.


Question 2: Controller testing
------------------------------

Write controller tests to confirm that:

2a)
- GET '/exchange' returns a 200 Okay HTTP status code

2b)
- GET '/' displays homepage that contains working link to the exchange input form page

2c)
the results page is displayed after the form submitted with VALID data

2d)
the results page is displayed with the correct COMMISSION after submission of VALID data

2e)
the results page is displayed with the correct NEW CURRENCY AMOUNT after submission of VALID data

2f)
the error message page is displayed with after the form submitted with INVALID currency type or amount too small



Question 3: Code coverage
-------------------------


NOTE - If a trailing "}" at the end of a method is not covered don't worry about it
(so you may not actually be able to acheive 100% coverage without some re-coding)
BUT all logic paths in each method should have been covered by at least one test ...

3a)
Add any additional tests to achieve 100% code coverage for your Utility class

3b)
Add any additional tests to achieve 100% code coverage for the controller classes

You must include your generated coverage reports in your submission


Question 4: PHPDocumentor
-------------------------
Document your class to achieve 0 errors with the PHPDocumentor
- ensure you write meaningful comments, that succinctly summarise each item being documented.
- ensure you include your generated documentation pages in your submission

You must include your generated documentation pages in your submission



GENERAL TEST NOTES:
-------------------

- The data and expected results in the Utility test class methods tell you all you need to know about special values / thresholds for the class you are to write

    - Test-Driven-Development = write code to pass the tests

- delete any automatically generated comments from PHPStorm at the beginning of a class file
(they will mess up the PHPDocumentor)

- some routes may end with a trailing forward slash, so must tested with the URL pattern ending ion '/'
    - e.g. see '/calc/' in route list below

    - while visiting page through a web server may resolve '/calc' to '/calc/', the unit testing framework will not be so lenient if URL does not match route pattern

```
    $ php bin/console debug:router
     ------------------ -------- -------- ------ --------------------------
      Name               Method   Scheme   Host   Path
     ------------------ -------- -------- ------ --------------------------
      calc_home          ANY      ANY      ANY    /calc/
      calc_process       ANY      ANY      ANY    /calc/process
      homepage           ANY      ANY      ANY    /
      about_page         ANY      ANY      ANY    /about
```


Money xchange
Currency
Amount
amount as euro

E.g.
Sterling

Canadian dollar:
€1 = $1.5

Pound Sterling
€1.1 = £1


Euro / Sterling / Can Dollar
22 / 20 / 30
11 / 1 / 15
5.5 / 5.5 / 7.5

