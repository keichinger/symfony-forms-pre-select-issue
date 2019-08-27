# Symfony Form's nested form + FormEvents::POST_SET_DATA reproducer

## Installation
1) `composer install`
2) Set up your `.env.local` and hook it up with a local MySQL installation
3) `symfony doctrine:migrations:migrate` to get some test data
4) Setup a webserver to run this app

## Reproducer
1) Go to `/` to find a super fancy index page that presents you with two links: One to the working form and another to the broken. Click on either link
2) Note the web debug toolbar is dumping `EntityA`
3) Note that, depending on which form you're currently working on, the EntityB dropdown is either pre-selected or empty!
