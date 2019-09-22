# Simple User registration app
[![CircleCI](https://circleci.com/gh/vortrixs/slim-basic-login.svg?style=shield)](https://circleci.com/gh/vortrixs/slim-basic-login)

## Requirements
* PHP 7.2
  * ext-pdo
* MySQL 5.7

### IDE
* Xubuntu (Ubuntu Linux 18.04.2)
* PhpStorm 2019.2.2
* PHP 7.2.19
* MySQL 5.7.27
* Apache 2.4.29

# Intro

This is a simple application that includes the following features:
* User registration
* Login/logout
* Password change
* Administrator users
  * Allows changing password for other users
  * Can grant administrator access to other users

The application uses the Slim 4 Framework as a lightweight base to expand from and the structure is loosely based on the MVC design pattern, but since it's a fairly small app I've decided to simplify it a bit by using Slims "Actions" instead of Controllers.

## Pre-made admin user
- Username: admin
- Password: admin

# File structure

- resources/  [Contains the SQL database dump]
- src/
  - Action/   [Contains all the Actions. Actions renders a view and/or handles data using models]
  - Library/  [Contains the building blocks for the application.]
  - Model/    [Contains the models that gives easy access to the database]
  - View/     [Contains the views that handles rendering the templates]
- templates/  [Contains templates build with HTML & PHP, uses Bootstrap 4 for styling and JS features]
- index.php   [Initializes the application]
- routes.php  [Contains all routes used by the application]
