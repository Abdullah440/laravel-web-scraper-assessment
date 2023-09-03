<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## : Task 1: Web Scraping Setup

Set up a new Laravel project called "WebScraper".
Create a new route /scrape that triggers a controller method for web scraping
## : Task 2: Web Scraping and Database Insertion

Write a function in the controller that performs the following:
- Scrapes the details of the top 10 movies from IMDb's [https://www.imdb.com/chart/top](https://www.imdb.com/chart/top).
- Extracts details such as title, year, rating, and URL.
- Stores the scraped movie details in a MySQL database using Eloquent ORM.
- Handle any exceptions that might occur during scraping or database insertion.

## : Task 3: Database Validation
- Implement validation to ensure that only unique movies are inserted into the database.

## : Task 4: Scheduler and Queue for Scraping

- Implement a scheduler that runs the scraping task daily at 12:00 PM using Laravel's task
scheduling.
- Integrate a queue to handle the scraping process asynchronously using Laravel's queue
system.

## Task 5: Route for Viewing Movie List
- Create a new route /movies that triggers a controller method to retrieve and display the
list of scraped movies from the database.

## Task 6: Error Handling
- Enhance your code to gracefully handle connectivity issues while scraping IMDb's
website.

## Task 7: Unit Testing
- Write unit tests to ensure the correctness of the web scraping and database
insertion logic.
- Mock the scraping process to simulate fetching data from IMDb's chart.
- Ensure proper handling of exceptions and validation.

## Developed By

-  [Abdullah Bhatti](https://www.linkedin.com/in/abdullahbhatti/).
