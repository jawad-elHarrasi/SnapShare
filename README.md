
# Secure Photo & Album Upload Platform

## Description

This project is a web application that allows users to upload and manage their photos and albums securely. The application uses a **public/private key encryption** system for secure data storage, **HTTPS** for encrypted communication, **CAPTCHA** for bot prevention, and is styled with **Bootstrap** for a modern and responsive design.

### Security Features
- **Encrypted Database**: All uploaded photos and albums are stored in a database with encryption to ensure confidentiality.
- **Public/Private Key**: Secure encryption mechanism using a public/private key pair for user authentication and data access.
- **HTTPS**: Ensures that all communications between the user and the server are encrypted and secure.
- **CAPTCHA**: Implements CAPTCHA on the upload page to prevent automated submissions and enhance security.
- **User Sharing**: Allow users to securely share albums with other registered users.

## Technologies Used

- **Laravel**: Backend framework for handling routes, authentication, and database operations.
- **MySQL**: Encrypted database storage for photos and albums.
- **Bootstrap**: Frontend styling framework for a responsive UI.
- **CAPTCHA**: Used to prevent bot submissions during the photo upload process.
- **Public/Private Key Encryption**: Used for secure data storage and authentication.

## Prerequisites

To run or develop this project, you will need:

- **PHP 8.0 or higher**
- **Composer** (Dependency Manager)
- **MySQL** (or any compatible database)
- **OpenSSL** (for generating public/private key pairs)
- **HTTPS** enabled on your server

## Installation

To set up the project locally, follow these steps:

1. **Clone the Repository**

```bash
git clone https://github.com/user/secure-photo-upload.git
cd album_secu
```

2. **Install Dependencies**

```bash
composer install
```

3. **Set Up Environment Variables**

Copy the example environment file and update it with your own settings:

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials and other environment-specific details, such as the public/private key pair for encryption.

4. **Generate Application Key**

Generate a new application key using Artisan:

```bash
php artisan key:generate
```

5. **Run Migrations**

Run the database migrations to create the necessary tables for the application:

```bash
php artisan migrate
```
(Answer `yes` to the prompt if required.)

6. **Install Frontend Dependencies**

Install Node.js dependencies:

```bash
npm install
```

Build the frontend assets:

```bash
npm run build
```
