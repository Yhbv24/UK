# US to UK translator

#### Epicodus PHP Week 5 project, 3/06/2017

#### By Sarah Leahy, Ash Laidlaw, Leah Sherell, Felix Oporto

## Description

Translator app that provides definitions for UK and US slang words.

## Setup/Installation Requirements
* See https://secure.php.net/ for details on installing _PHP_.  Note: PHP is typically already installed on Macs.
* See https://getcomposer.org for details on installing _composer_.
* Clone repository
* Open MAMP- see https://www.mamp.info/en/downloads/ for details on installing _MAMP_
* Open localhost:8888/phpmyadmin in browser
* Go to import tab
* Install translator.zip.sql to access database structure
* From project root, run > composer install --prefer-source --no-interaction
* Go to MAMP settings set MAMP>Preferences>Web Server>Document Root to UK/web
* Restart MAMP server
* open localhost:8888 in browser

## Known Bugs
* No known bugs


## Specifications

1. Create files and folders necessary for the web app.
2. Install required dependencies.
3. Create databases for stores, brands, and the join table to connect them.
4. Begin writing tests and methods for classes.

|     Spec     |     Input     |     Output     |
| ------------ | ------------- | -------------- |
| 1. Add constructor for UK_word class. | word, definition, example, region, ID. | Output should ultimately save new instantiation of a new UK_word. |
| 2. Add getters and setters for UK_word. | Get and set word, definition, example, region, ID. | Return information about the word. |
| 3. Add CRUD methods to UK_word. | Create, read, update, and delete words | Display updated/new information about the words. |
| 4. Pass all non-integrated tests | Run tests. | Pass tests. |
| 5. Add constructor for US_word class. | word, definition, example, region, ID. | Output should ultimately save new instantiation of a new US_word. |
| 6. Add getters and setters for US_word. | N/A | N/A |
| 7. Add CRUD methods to US_word. | Create, read, update, and delete words| Display updated/new information about the words. |
| 8. Pass all tests for UK_word and US_word | Run all tests. | Pass all tests. |
| 9. Add basic site UI, with options to add UK and US words. | UK_word information/ US word information. | Be able to save the UK/US word and return it when necessary. |
| 10. Add routing so that a user can update or delete a UK/US word. | UK/US word information. | Be able to update/delete the UK/US word and have it update the database. |

## SQL commands
* CREATE DATABASE translator;
* USE translator;
* CREATE TABLE UK_words(id serial PRIMARY KEY, word VARCHAR(255), definition TEXT, example TEXT, region VARCHAR(255));
* CREATE TABLE US_words(id serial PRIMARY KEY, word VARCHAR(255), definition TEXT, example TEXT, region VARCHAR(255));
* CREATE TABLE UK_US (id serial PRIMARY KEY, UK_id INT, US_id INT);

## Support and contact details
no support

## Technologies Used
* PHP
* Composer
* Silex
* Twig
* HTML
* CSS
* Bootstrap
* Git
* mySQL
* Oxford English Dictionary API - `https://developer.oxforddictionaries.com/`
* Google Maps API - `https://developers.google.com/maps/`

## Copyright (c)
* 2017 By Sarah Leahy, Ash Laidlaw, Leah Sherell, Felix Oporto

## License
* MIT
