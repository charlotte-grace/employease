# Employease (WIP)

Employease is a web application built using Laravel and Sail that allows you to perform CRUD (Create, Read, Update, Delete) operations on employees.

## Project Status

Employease is a project that was started three days ago, and is therefore still a work in progress. Due to limited capacity I have not been able to focus fully on the implementation. So ,at this stage the application is incomplete and some features may be missing or not fully functional.

## Installation (May or may not work!?)

Clone this repository

```
git clone git@github.com:charlotte-grace/employease.git
```

Navigate to the project directory

```
cd src
```

Copy the .env.example file to .env
```

cp .env.example .env
```

Start the Docker containers

```
./vendor/bin/sail up -d
```

Install Composer dependencies

```
./vendor/bin/sail composer install
```

Run database migrations

```
./vendor/bin/sail artisan migrate
```

Seed the one table

```
./vendor/bin/sail artisan db:seed --class=SkillLevelsTableSeeder
```

Visit http://localhost in your browser to see the application

## At Least There Are Some Tests Though...

Employease comes with a suite of automated tests to ensure that the application is functioning correctly. To run the tests, follow these steps:

```
./vendor/bin/sail artisan test
```

The tests will automatically run and output the results to your terminal.

Sidenote: surprisingly they all pass... yaaay

## You are never too old to f&$k Up and Learn a Lesson or Two

During the development of Employease, I learned an important lesson about managing workload and priorities. I took on multiple projects simultaneously while trying to secure employment, which resulted in a lack of focus and limited progress on each project.

As a result, I realized the importance of prioritizing tasks and managing workload effectively. Moving forward, I will ensure that I allocate enough time and resources to each project to achieve desired outcomes.

I hope that this lesson will be helpful to others who are juggling multiple responsibilities and trying to balance their workload effectively. By focusing on priorities and managing your time effectively, you can achieve success and avoid the pitfalls of spreading yourself too thin.

Word!
