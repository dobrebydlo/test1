# Test task

Create a database structure and core parts of a simple application for customer database management and customer purchasing behaviour.

* The database contains information about the Customer (Name, Surname, Address, Email, Telephone, Registration date) and his Loyalty Cards (card number, card type - temporary/basic).
* Cards are pre-created in the database and then assigned to customers. Each Card has just one owner.
* In addition, individual purchases are recorded. Each purchase contains information about the used Loyalty Card, Total price, Date of purchase and a List of purchased items that contains information about the Purchased goods, the Number of items and the Price per item.

## What must be implemented

1. Create a database data model (such as ER diagram), create SQL database (such as MySQL, PostgreSQL)
2. Implement parts of the application that are necessary to fulfill the following tasks:
	a) Implement the Customer Registration Interface (Registration form must include all customer data + Loyalty Card assignment)
	b) Implement the Customer Tracking Interface by: Name, Surname and Card number
3. Create Reports:
	a) Number of Customers
	b) Number of assigned Cards
	c) Top 10 Customers by turnover in the last 30 days

## Requirements

* Server part should be implemented in PHP 7.x
* Respect the MVC Design Pattern (if other, please state the reasons)
* Respect the OOP principles
* Created forms should have input data validation implemented on the server side.
* The application draft contains only the basic parts, there is no need to solve complete functionality in a deep detail. Focus on the features you find important. The estimated implementation time is about 0.5 MD.
* An essential part of your solution is a brief description of the application draft and implementation steps.

## Working example online

* Go to https://test1.melnikoff.ru/
* Log in using **admin@admin.com / admin**

## Installation

1. Clone the repo =)
2. Create .env file in project root folder and fill DB params (use .env.example)
3. Keep APP_ENV=local and APP_DEBUG=true to have DebugBar enabled
4. Run composer update (Laravel depends on a number of libraries)
5. Run php artisan key:generate (the app won't work without a key)
6. Run php artisan migrate --seed (create database structure and seed the models, seeding will take some time)
7. Make sure the folders bootstrap/cache, storage, storage/* are writable by php
8. Set virtual host web root to project_root/public

## Where is everything

* Migrations: database/migrations
* Seeders: database/seeds
* Models: app/*.php
* Controllers: app/Http/Controllers
* Views: resources/views
* ER Diagrams: EER Diagram.mwb and EER Diagram.pdf in the root folder

## Timeline

1. At 12:00 I read the document and decided to use Laravel as it suits the task best.
2. Set up virtual host, created database, set up clean Laravel installation.
3. Drawn a ER diagram by hand on a piece of paper.
4. Prepared migrations for all used models.
5. Started working on models.
6. Realized that there is a missing relationship between Purchase and Card, fixed it.
7. Inspected Laravel's authentification mechanism, found it compatible with what I need.
8. Modified the registration form and validator so that they complied with the requirements.
9. Decided not to pay attention to proper phone number extraction and validation even though I have my own good implementation.
10. Finished with models, started working on seeders.
11. Got an unexpected call from manager (I still have a job) and had to spend some 20 minutes for an urgent task.
12. Finished the seeders and made sure they work properly.
13. Implemented the interface (both controller and view) but failed to properly implement text filtering from the first try.
14. Committed the changes as is because it was already 15:58.
15. Implemented text filter the proper way and committed changes.
16. Added automatically generated EER Diagram.
17. Wrote this detailed list.
18. Made some more changes and fixes...
19. Suddenly realized that one purchase may contain more than one kind of items.
20. Solved the problem.

## Contact me

* +420 720 134 550 (Phone, SMS, Viber, Whatsapp)
* alex@melnikoff.ru
* dobrebydlo@telegram
* callmelnikoff@skype
