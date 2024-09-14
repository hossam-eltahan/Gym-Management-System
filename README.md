# Gym-Management-System

## Overview

The Gym Management System is a web-based application designed to manage various aspects of a gym, including members, memberships, bills, and renewals. It provides functionalities for tracking member details, managing membership types, processing renewals, and generating reports.

## Features

- **Member Management**: Add, update, and view member details.
- **Membership Types**: Define and manage different membership types.
- **Bill Management**: Generate and manage bills for memberships.
- **Renewals**: Track and process membership renewals.
- **Reports**: Generate reports on new members, total revenue, and more.
- **Search & Filter**: Advanced search and filtering options for members and bills.

## Installation & Setup

### Prerequisites

- **Web Server**: Apache or Nginx
- **Database**: MySQL
- **PHP**: Version 7.4 or higher
- **PHP Extensions**: MySQLi, GD, etc.
- **Composer**: (for managing dependencies if required)

### Steps to Set Up

1. **Clone the Repository**

   ```bash
   git clone https://github.com/yourusername/gym-management-system.git
   cd gym-management-system
   ```

2. **Set Up the Database**

   - **Create a Database**: Create a new database for the Gym Management System using your MySQL client or phpMyAdmin.

   - **Import the Database Schema**:
     - Locate the SQL file (e.g., `database.sql`) in the project directory.
     - Import the SQL file into your newly created database.

     ```bash
     mysql -u yourusername -p yourdatabase < path/to/database.sql
     ```

   - **Configure Database Connection**:
     - Open `includes/config.php`.
     - Update the database connection parameters with your database credentials:

       ```php
       $dbHost = 'localhost'; // or your database host
       $dbUsername = 'yourusername';
       $dbPassword = 'yourpassword';
       $dbName = 'yourdatabase';

       $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
       ```

3. **Configure Web Server**

   - **Place the Project**: Copy the project folder to your web server's root directory (e.g., `htdocs` for XAMPP).

   - **Set Up Virtual Host** (Optional):
     - Configure a virtual host in Apache or Nginx to point to the project directory.

4. **Install Dependencies**

   If your project has any PHP dependencies managed by Composer:

   ```bash
   composer install
   ```

5. **Set File Permissions**

   Ensure that the web server has the appropriate permissions to read and write necessary files and directories.

   ```bash
   chmod -R 755 uploads
   ```

6. **Access the Application**

   - Open a web browser and navigate to the URL where the application is hosted (e.g., `http://localhost/gym-management-system`).

## Usage

- **Login**: Access the system with valid credentials. If you don't have credentials, you may need to create an admin account or update the login configuration.

- **Navigation**: Use the sidebar to navigate through different sections like Members, Membership Types, Bills, and Renewals.

- **Features**:
  - **Members**: Add, edit, delete, and view member details.
  - **Membership Types**: Manage different types of memberships.
  - **Bills**: Create and manage bills, view detailed bill information.
  - **Renewals**: Process and track membership renewals.
  - **Reports**: View reports on new members, revenue, and more.

## Troubleshooting

- **Database Connection Issues**: Verify the database credentials in `includes/config.php` and ensure the MySQL server is running.

- **File Permission Issues**: Ensure that the web server has the appropriate permissions for reading and writing files, especially in the `uploads` directory.

- **Missing Dependencies**: Check for any missing PHP extensions or Composer dependencies.

## Contributing

Contributions are welcome! If you have any improvements or bug fixes, please fork the repository and submit a pull request. For significant changes, open an issue to discuss your proposal first.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contact

For any questions or support, please contact [your-email@example.com](mailto:your-email@example.com).
