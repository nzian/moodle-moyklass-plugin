Plugin for LMS Moodle MoyKlass
=================================
![PHP](https://img.shields.io/badge/PHP-v7.4%20%2F%208.0-blue.svg)
![Moodle](https://img.shields.io/badge/Moodle-v4.3-orange.svg)
[![GitHub Issues](https://img.shields.io/github/issues/Buda9/moodle-moyklass-plugin.svg)](https://github.com/Buda9/moodle-moyklass-plugin/issues)
[![Contributions welcome](https://img.shields.io/badge/contributions-welcome-green.svg)](#contributing)
[![License](https://img.shields.io/badge/License-GPL%20v3-blue.svg)](#license)

> Unofficial Moodle plugin for synchronizing data with the CRM system "MoyKlass"

## Functionality

The plugin offers several functionalities:

- `Student Synchronization`: Manages the syncing of student data and their statuses with an MoyKlass CRM, ensuring Moodle's student information is up-to-date.
- `Subscription and Class Management`: Automates the synchronization of subscriptions, classes, and lessons, facilitating efficient management of educational resources.
- `Payment Processing`: Integrates payment handling within Moodle, streamlining the financial aspect of course management.
- `Dynamic Student Dashboard`: Presents a personalized dashboard for students, featuring widgets that show essential information like class registrations, remaining classes in subscriptions, and other relevant data.
- `Lesson Cancellation`: Includes capabilities to cancel lessons, providing flexibility in scheduling and management.
- `API Integration`: Incorporates an API service for external communication, enabling seamless data exchange with other systems.
- `Database and User Synchronization`: Ensures consistent data across platforms by synchronizing user details between Moodle and external systems.
- `Email Notifications`: Manages sending email notifications, improving communication with students.
- `Task and Widget Management`: Contains various tasks for data upgrades and widgets for displaying specific content like groups, payments, and invoices on Moodle pages.

Additionally, the plugin likely includes:

- `Customizable Widgets`: Provides widgets in the student dashboard for various functions like managing lessons and viewing invoices. These widgets enhance user interaction and accessibility.
- `Teacher and Manager Integration`: Manages information related to teachers and school managers, potentially allowing for better coordination and communication within the educational environment.
- `Automated Task Execution`: Facilitates automated tasks for updating and maintaining the system, ensuring smooth operation and data integrity.
- `Enhanced User Experience`: Through its various features, the plugin aims to streamline processes and improve the overall user experience on the Moodle platform.

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

- `cancel-lesson.php`: Interface for canceling lessons. (YOURMOODLE/local/moyclass/cancel-lesson.php)
- `index.php`: Main entry point of the plugin. (YOURMOODLE/local/moyclass/index.php)
- `lessons.php`: Manages lesson-related features. (YOURMOODLE/local/moyclass/lessons.php)
- `settings.php`: Plugin configuration settings.
- `subscriptions.php`: Manages subscription-related functionalities.
- `token.php`: Token management features.
- `version.php`: Plugin version information.
