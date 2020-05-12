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

1. Clone the repo
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
* ER Diagram: Schema.mwb and "EER Diagram.pdf" in the root folder

## Steps taken to solve the task

1. Read the document and decided to use Laravel as it suits the task best.
2. Set up virtual host, created database, brought up clean Laravel installation.
3. Drawn an ER diagram by hand on paper.
4. Prepared migrations for all used models.
5. Started working on models.
6. Realized that there is a missing relationship between Purchase and Card, fixed it.
7. Inspected Laravel's authentication mechanism, found it compatible with what I needed.
8. Modified the registration form and the validator so that they complied with the requirements.
9. Decided not to pay attention to proper phone number extraction and validation even though I had my own good implementation.
10. Finished with the models, started working on seeders.
11. Finished the seeders and made sure they worked properly.
12. Implemented the interface (both controller and view) but failed to properly implement text filtering from the first try.
13. Committed the changes as is because it was almost time to finish.
14. Implemented text filter properly and committed the changes.
15. Added automatically generated EER Diagram.
16. Wrote this detailed list.
17. Made some more changes and fixes.
18. Suddenly realized that one purchase may contain more than one kind of items.
19. Solved the problem.
20. Finally, fixed the turnover top calculation logic.

## Feedback from potential employer

1. The only 100% working solution covering all parts of the task.
2. The only candidate who paid attention to documenting the solution and prepared the ER diagram.
3. The cleanest solution with obvious structure and commented code.
4. Existing solutions and prebuilt elements were used where possible.
5. Job offer made.

## Contact me

* +420 720 134 550 (Phone, SMS, Viber, Whatsapp)
* alex@melnikoff.ru
* dobrebydlo@telegram
* callmelnikoff@skype
