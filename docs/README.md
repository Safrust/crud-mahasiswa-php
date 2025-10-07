# Documentation

## Screenshots

Add screenshots of your application here:

### Dashboard

![Dashboard](screenshots/dashboard.png)

### Create Student Form

![Create Form](screenshots/create-form.png)

### Edit Student Form

![Edit Form](screenshots/edit-form.png)

### Student Details

![Student Details](screenshots/student-details.png)

### Responsive Design

![Mobile View](screenshots/mobile-view.png)

## Installation Guide

Detailed installation instructions can be found in the main [README.md](../README.md).

## API Documentation

This application uses direct PHP-MySQL interaction. No REST API endpoints are currently implemented.

## Database Schema

```sql
CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(8) UNIQUE NOT NULL,
    tanggal_lahir DATE NOT NULL,
    alamat TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Development Notes

- PHP 8.2+ recommended
- MySQL 8.0+ or MariaDB 10.4+
- Bootstrap 5.1.3 for responsive design
- Font Awesome 6.0 for icons
