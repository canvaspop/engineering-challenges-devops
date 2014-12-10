# WorkshopX Engineering Challenges - DevOps

This engineering challenge is used as part of the devops interview process at WorkshopX.  There are a number of steps involved in this challenge, outlined below.

## Initial Setup

The app in this repo is currently installed on a single EC2 node in AWS.  The app loads all resources locally on the single instance.  The public address of the machine and AWS
account credentials will be provided to you during the interview.

## Requirements

Modify this environment to support scale.  At a minimum:

* the database should not be hosted locally on the machine
* the memcached instance should not be hosted locally on the machine
* the CSS and javascript should not be hosted locally on the machine
* there should be more than one node, behind an ELB

The environment of the system is set using an environment variable in the default vhost:

```SetEnvIf ^ .* APPLICATION_ENV=local```

This value should be changed to `production`, which will load the site configuration via `config/config.production.php` instead of `config/config.local.php`.  The values in
`config/config.production.php` will need to be updated appropriately to the environment you create.

Use best practices when making changes to the environment.  Set it up as if it was a production environment that you were required to maintain.

You have 24 hours to complete this challenge.  Any other modifications above and beyond the requirements are welcome.  Show us what you can do!

## Tips

The application is written in PHP, and uses composer for dependency management.  To install the composer dependencies, run this from the root of the project:

``php composer.phar install``

The application uses MySQL as the database backend.  There is a convenience SQL script (`migration.sql`) for creating and populating the database, located at the root of the project.
