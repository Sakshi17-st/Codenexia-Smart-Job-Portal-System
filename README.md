 Smart Job Portal System

 1. Problem

Students and job seekers often face difficulty finding suitable job opportunities in one place. Job information such as job title, location, salary, job type, and schedule can be difficult to manage and access. Recruiters or administrators also need a system to manage job postings and user requests efficiently.

 2. Solution

The Smart Job Portal System is a web-based platform that connects job seekers with available job opportunities. Users can create an account, log in, view available jobs, search/filter job opportunities, check job details, apply for jobs, and manage their profiles.

The system also provides an administrator dashboard to manage users, job postings, and application/request information.

 3. Target Users

* Job seekers
* Students
* Fresh graduates
* Recruiters
* System administrators

 4. Why Smart?

The system provides centralized job searching and management instead of requiring users to manually search through different sources. Jobs can be organized based on categories and locations, while users can view important information such as salary, job type, work schedule, and job details before applying.

The current version is mainly a **rule-based/database-driven job portal** rather than an AI-based recommendation system.

 5. Architecture

User → PHP Web Interface → Input Validation → PHP Backend → MySQL Database → Job/User/Application Data → Web Interface

### Admin Flow

Admin → Login Authentication → Admin Dashboard → Manage Jobs → Manage Requests → Database

 6. Technology Stack

* **PHP** – Server-side application development
* **MySQL** – Database management
* **MySQLi** – Database connectivity
* **HTML** – Web page structure
* **CSS** – User interface and responsive styling
* **JavaScript** – Client-side interactions
* **Font Awesome** – Icons
* **Chart.js** – Dashboard visualization support
* **XAMPP** – Local Apache and MySQL environment
* **Git/GitHub** – Version control and project management

7. Data Strategy

The system uses a MySQL database named `jobdb`.

The project contains database-driven information for:

* User accounts
* User profiles
* Job listings
* Job locations
* Salary information
* Job types
* Work schedules
* Job applications/requests
* Administrator information

The job listing data contains fields such as job title, location, salary, job type, schedule, and job image.

8. Main Features

### User Module

* User registration
* User login/logout
* Session-based authentication
* User profile
* Profile editing
* Profile image support

### Job Module

* View latest jobs
* View all available jobs
* Job categories
* Job location information
* Salary information
* Job type
* Work schedule
* Detailed job information
* Apply for jobs

### Admin Module

* Admin authentication
* Admin dashboard
* Total user count
* Total jobs count
* Total request count
* Add new jobs
* Manage job-related requests
* View administrative information

### UI Features

* Responsive web interface
* Dark/light theme toggle
* Navigation menu
* Job cards
* Category-based presentation
* Form validation and status messages

9. Setup

```text
Install XAMPP

Start:
- Apache
- MySQL

Place the project inside:
xampp/htdocs/

Create a MySQL database:
jobdb

Configure the database connection in:
config.php
```

The current configuration connects to MySQL using:

```text
localhost
root
jobdb
```

 10. Run

```text
Start Apache and MySQL from XAMPP.

Open the project through:

http://localhost/Job-Portal-main%20website/The%20RMCS/
```

The exact URL may vary depending on the folder name used inside `htdocs`.

 11. Database/API

The current project uses **PHP and MySQL**, not a separate REST API architecture.

The PHP backend communicates with MySQL using MySQLi.

Example database operations include:

```text
SELECT * FROM jobinfo
SELECT * FROM userinfo
INSERT INTO userinfo (...)
```

The system retrieves job information from the `jobinfo` table and user information from the `userinfo` table.

 12. Testing

The project can be tested manually through the web application.

Important test cases include:

* User registration
* Duplicate user registration
* Login with valid credentials
* Login with invalid credentials
* Logout
* Profile access
* Job listing display
* Job detail viewing
* Job application
* Admin login
* Adding a new job
* Viewing requests
* Dashboard count verification
* Responsive navigation
* Dark/light theme switching

 13. Limitations

* The current system uses traditional database-based job matching.
* It does not currently use an AI/ML recommendation model.
* Job information depends on the data entered by the administrator.
* It does not provide semantic or NLP-based resume-to-job matching.
* The current authentication implementation can be improved using secure password hashing.
* A dedicated REST API is not implemented.
* Real-time external job APIs are not integrated.
* Advanced analytics and personalized recommendations are not currently available.

14. Future Improvements

* Add AI/ML-based job recommendation.
* Add NLP-based resume and job-description matching.
* Add skill extraction from resumes.
* Add semantic search using embeddings.
* Integrate real-time job APIs.
* Add personalized job recommendations.
* Add secure password hashing and stronger authentication.
* Add REST APIs for mobile and external applications.
* Add recruiter accounts and recruiter dashboards.
* Add email notifications for applications.
* Add application status tracking.
* Add advanced search and filtering.
* Add analytics for users, jobs, and applications.
* Deploy the system on AWS or another cloud platform.

 15. Milestones

. Problem identification and solution design
. Website architecture and database design
. HTML/CSS user interface development
. PHP backend development
. MySQL database integration
. User registration and login module
. User profile management
. Job listing and category module
. Job details and application module


16. Project Architecture Summary

```text
                    SMART JOB PORTAL
                           |
          +----------------+----------------+
          |                                 |
       USER MODULE                    ADMIN MODULE
          |                                 |
   +------+------+                  +-------+-------+
   |      |      |                  |       |       |
Register Login Profile           Dashboard Jobs  Requests
   |      |      |                  |       |       |
   +------+------+                  +-------+-------+
          |                                 |
          +---------------+-----------------+
                          |
                    PHP Backend
                          |
                       MySQL
                       Database
                          |
              +-----------+-----------+
              |           |           |
          Users Table  Jobs Table  Requests


