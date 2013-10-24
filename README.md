Scrum Manager Web
=================

Open-source, cross-platform application for handling Scrum within a team.

How to collaborate?
===================

If you would like to collaborate to the development of the project, you're very much free to do so. Please make sure to follow the *installation instructions* below and the *milestone rules*. There are also some specifics related to branching below.

### Branching

Each individual issue needs to be solved within the context of a ticket - every ticket denotes an individual remote feature branch, which is deleted when merged.

We use powerful continuous integration and QA software to ensure that the project is of the highest quality, so make sure to always check with our remote solutions in order to validate your work, **before merging back into master via GitHub's pull request mechanism** 

Remember to rebase often and to squash your commits before merging a branch, so that our stable snapshots are in fact, actually stable, and not just intermediate development points.

### Branching example

Let's say you're working on Issue 42, which indicates: _Fix code coverage for UserAccount class_. We would go ahead and create a remote feature branch named: _i42-code-coverage-useraccount_, and we would look at solving the code coverage problem for the class.

When we're done with development, we would commit with the following commands:

* git commit -am "Fixes #42: Fix code coverage for UserAccount class"
* git push -u origin i42-code-coverage-useraccount

The set of commands above would trigger _Travis CI, Scrutinizer and Coveralls_ builds for our remote branch which can validate/invalidate our solution. If we made a mistake and didn't actually completly cover the UserAccount class, we can implement our solution, and then rebase:

* git commit -am "Solved code coverage issue for getId() method"
* git rebase -i HEAD~2
* git push -f

Finally, when we're ready, we just open a new pull request on GitHub and optionally ask somebody to do a code review for us. Once the pull request is done, all of the QA systems above will be triggered again, and we can validate that what's been merged into master does validate our solution. Our ticket will also be closed when merging the PR.

Milestones
==========

Milestones are used as ticket buckets, so that we have better control over our release schedule and ticket organisation. If you come across a bug or a ticket that **can be assigned to one of the existing milestones**, make sure you do that. If you find several tickets that **could be grouped under a common milestone**, create one for it, and if you encounter a general purpose ticket, add it to the list of issues, but **don't specify a milestone**.

Installation
============

In order to install the project and contribute to it, you need to follow the steps below. Please make sure you have access to *Composer* for dependency management, and to *Git* for version control management.

Source code management
----------------------

1. Clone the GitHub repository via the following command: **https://github.com/globesoft/scrum-manager-web**
2. To install all of the dependencies required for the project, go into the root of the project and run: **composer install**

* The command above will also ask you about the initial setup of your project, so please make sure to specify **your own database connectivity details**.

3. Set up permissions for Symfony by running the [installation commands](http://symfony.com/doc/current/book/installation.html#configuration-and-setup) or by simply applying the operations below in the root dir of the project checkout:

* APACHEUSER=`ps aux | grep -E '[a]pache|[h]ttpd' | grep -v root | head -1 | cut -d\  -f1`
* sudo setfacl -R -m u:$APACHEUSER:rwX -m u:`whoami`:rwX app/cache app/logs
* sudo setfacl -dR -m u:$APACHEUSER:rwX -m u:`whoami`:rwX app/cache app/logs

Database management
-------------------

We run two separate databases which always need to be maintained - one is applicable for the development environment where active data can be stored and used, and one for the test environment, where integration tests can be run; please be aware that **no stable data should ever be kept on the test database** since it will always be destroyed when running integration tests.

In order to configure database management, there are two sets of operations that need to be performed - first-time database setup, and continous database maintenance.

### First time database setup

In order to set up the database, you simply need to run:

* php app/console doctrine:database:create
* php app/console doctrine:database:create --env=test

The commands above will set up the project for the **dev** and **test** environments.

### Continous database maintenance

Database changes are handled via [Doctrine Migrations](http://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html), and in order to apply all of the migrations at once, please run the following commands:

* php app/console doctrine:mig:mig
* php app/console doctrine:mig:mig --env=test

The commands above guarantee that your database structure will pass through all of the stable states and be set to the latest version.
