Plugin for LMS Moodle MoyKlass
=================================
![PHP](https://img.shields.io/badge/PHP-v7.4%20%2F%208.0-blue.svg)
![Moodle](https://img.shields.io/badge/Moodle-v4.3-orange.svg)
[![GitHub Issues](https://img.shields.io/github/issues/Buda9/moodle-moyklass-plugin.svg)](https://github.com/Buda9/moodle-moyklass-plugin/issues)
[![Contributions welcome](https://img.shields.io/badge/contributions-welcome-green.svg)](#contributing)
[![License](https://img.shields.io/badge/License-GPL%20v3-blue.svg)](#license)

> Unofficial Moodle plugin for synchronizing data with the CRM system "MoyKlass"

## Functionality

- Synchronization of students and their statuses
- Synchronization of subscriptions, classes, lessons, payments, etc.
- Dashboard for students with widgets for displaying information about registrations for classes, balances of classes in subscriptions and
   etc.

## Folder Structure (what i think it is)

- `classes/`
  - `notifications/`
    - `emails.php`: Manages the creation and formatting of email notifications.
    - `manager.php`: Coordinates notification sending and handling processes.
  - `pages/`
    - `dashboard.php`: Backend logic for the dashboard page.
    - `lessons_page.php`: Handles the lessons page functionality.
    - `subscriptions_page.php`: Manages the subscriptions page.
    - `teacher.php`: Controls teacher-related features.
  - `task/`
    - `upgrade_*.php` files: Each script handles upgrading different aspects of the system, such as classes, client statuses, invoices, etc.
  - `widgets/`
    - `*.php files`: Each provides backend support for different widgets (like groups, invoices, lessons) displayed on the Moodle interface.
  - `actions.php`: Handles lesson-related actions.
  - `api_service.php`: Manages API interactions.
  - `manager_db.php`: Manages database operations.
  - `sync_users.php`: Synchronizes Moodle and external system users.

- `db/`
  - `access.php`: Defines plugin capabilities.
  - `install.php`: Custom install steps.
  - `install.xml`: Database structure definition.

- `lang/`
  - `access.php`: Defines plugin capabilities.
  - `install.php`: Custom install steps.
  - `install.xml`: Database structure definition.

- `lang/`
  - `en/`
    - `local_moyclass.php`: English language strings for the plugin.

- `templates/`
  - `pages/`
    - `dashboard.mustache`: Template for the dashboard page.
    - `lessons.mustache`: Template for the lessons page.
    - `styles.mustache`: Styling templates.
  - `emails/`
    - `welcome.mustache`: Email template for welcome messages.
- `error_alert.mustache`: Mustache template used for displaying error messages or alerts.

- `cancel-lesson.php`: Interface for canceling lessons.
- `index.php`: Main entry point of the plugin.
- `lessons.php`: Manages lesson-related features.
- `settings.php`: Plugin configuration settings.
- `subscriptions.php`: Manages subscription-related functionalities.
- `token.php`: Token management features.
- `version.php`: Plugin version information.
