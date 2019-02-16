# Test task

## Installation

1. Fill .env (.env.example available in project root)
2. Run composer update (the project depends on a number of libraries)
3. Run php artisan migrate --seed (create database structure and seed the models)
4. Set web root to point to project_root/public

## Timeline
 
1. Prepared boilerplate, created database migrations
2. Described models, added card_number to purchases
3. Modified Laravel's standard registration form to comply with the requirements
4. Created seeders
5. Implemented interface using what was provided with Laravel
6. Implemented customer list filter
7. Added EER diagram


## Timeline in details

1. At 12:00 I read the document and decided to use Laravel as it suits the task best.
2. Set up virtual host, created database, set up clean Laravel installation.
3. Drawn a ER diagram by hand on a piece of paper.
4. Prepared migrations for all used models.
5. Started working on models.
6. Realized that there is a missing relationship between Pruchase and Card, fixed it.
7. Inspected Laravel's stadard authentification mechanism, found it compatible with what I need.
8. Modified the registration form and validator so that they complied with the requirements.
9. Decided not to pay attention to proper phone number extraction and validation even though I have my own good implementation.
10. Started working on seeders.
11. Got an unexpected call from manager (I still have a job) and had to spend some 20 minutes for an urgent task.
12. Finished the seeders and made sure they work properly.
13. Implemented the interface (both controller and view) but failed to properly implement text filtering from the first try.
14. Committed the changes as is because it was already 15:58.
15. Implemented text filter the proper way and committed changes.
16. Added automatically generated EER Diagram.
17. Wrote this detailed list.

