# Doctor Appointment System DocAlb

# Introduction
In Albania, the process of booking doctor appointments can be a cumbersome and inefficient process for patients. Many patients have to spend a significant amount of time calling multiple healthcare providers to find availability, and often end up with long wait times or scheduling conflicts. Additionally, healthcare providers may struggle with managing their schedules and keeping track of their patients. To address these issues, our team is developing a Doctor Appointment System that will make it easier for patients to find and book appointments with doctors across the country.

# Purpose
The purpose of this project is to create a user-friendly and efficient platform that connects patients with healthcare providers in Albania. Our goal is to streamline the appointment booking process and make it more accessible to all citizens. We aim to provide a centralized platform that will improve the overall healthcare experience for patients and healthcare providers.

# Objectives
The main objectives of this project are to:
•	Develop a functional Doctor Appointment System that is easy to use and accessible to all.
•	Provide patients with a centralized platform where they can search for doctors and book appointments.
•	Offer healthcare providers a platform to manage their schedules and appointments more efficiently.
•	Improve the overall healthcare experience for Albanian citizens.

# Development model
After reviewing the requirements and objectives of the Doctor Appointment System project, our team has decided to use the incremental model for software development. This model is best suited for our project as it allows us to develop the software in small, iterative cycles. Each cycle focuses on delivering a working module of the software, which is then tested and evaluated by stakeholders. This approach ensures that we receive early feedback and can make necessary changes to the system design. Additionally, the incremental model allows us to prioritize the most critical features of the system, ensuring they are delivered first. This way, we can ensure that the essential functions of the Doctor Appointment System are implemented and thoroughly tested before moving on to the next iteration. Overall, we believe that the incremental model will help us deliver a functional, reliable, and user-friendly Doctor Appointment System that meets the needs of our stakeholders.

# User Requirements
#Administrator Requirements

    -Add new doctors to the system
    -Edit doctors' information in the system
    -Remove doctors from the system
    -Schedule new sessions for doctors
    -Remove sessions for doctors
    -View patient details in the system and remove if necessary
    -View bookings made by patients

# Doctor Requirements

    -View their appointments scheduled in the system
    -View their upcoming sessions scheduled in the system
    -View patient details for their appointments and sessions
    -Edit their account settings in the system

# Patient (Client) Requirements

    -Make appointments online using the system
    -Create accounts themselves in the system
    -View their old booking history in the system
    -Edit their account settings in the system

# Application Specifications
The application consists of three main user interfaces: Administrator, Doctor, and Patient (Client). The Administrator interface allows the administrator to add, edit, and remove doctors from the system, schedule and remove sessions for doctors, view patient details, and view patient bookings. The Doctor interface allows doctors to view their appointments and sessions scheduled in the system, view patient details, delete their account, and edit their account settings. The Patient (Client) interface allows patients to search for doctors based on location, specialty, availability, and ratings, book appointments online, create accounts themselves, view their old booking history, delete their account, and edit their account settings.

The application will be developed by  using the latest versions of HTML, CSS, and PHP. The application is deployed on a reliable and scalable cloud platform to ensure high availability, scalability, and performance.


# Non-Functional Requirements

-Usability: The system should be easy to use, even for users who may not be tech-savvy or familiar with online appointment booking systems. It should have a simple and intuitive user interface, with clear instructions and prompts.

-Security: The system should be secure and protect user data, including personal and medical information. It should comply with data protection regulations and use encryption and authentication to prevent unauthorized access.

-Availability: The system should be available 24/7, allowing users to book appointments at any time of day or night. It should also have backup and disaster recovery systems in place to ensure that it is always operational.

-Accessibility: The system should be accessible to all users, including those with disabilities or limited internet access. It should comply with accessibility standards and offer alternative access methods such as phone or in-person booking.




# Code's Accessability
1.	To open and run the code for the Doctor Appointment System (DocAlb) using XAMPP and hosting it on localhost/phpMyAdmin, you can follow the steps below:
2.	Install XAMPP: Download and install XAMPP from the official Apache Friends website (https://www.apachefriends.org/index.html). Choose the version suitable for your operating system.
3.	Start Apache and MySQL: Launch the XAMPP control panel and start the Apache web server and MySQL database server by clicking on the "Start" button next to their respective modules.
4.	Set up the project directory: Create a new directory for your project, for example, "docalb" under the "htdocs" directory in the XAMPP installation folder (e.g., C:\xampp\htdocs\docalb).
5.	Import the database: Open a web browser and navigate to phpMyAdmin by entering the URL "http://localhost/phpmyadmin" in the address bar. Create a new database named "docalb" and import the provided SQL database file into this database. You can import the SQL file using the "Import" option in phpMyAdmin.
6.	Download the code: Obtain the code for the Doctor Appointment System (DocAlb) and place it inside the project directory you created in step 3.
7.	Configure the database connection: Open the code files and locate the database connection settings. Typically, these settings can be found in a configuration file or at the beginning of the code files. Update the database connection parameters (such as hostname, username, password, and database name) to match your local setup.
8.	Start the application: Open a web browser and enter the URL "http://localhost/docalb" (replace "docalb" with the actual project directory name) to access the Doctor Appointment System. The index.php file should be the entry point of the application and should load the necessary 
