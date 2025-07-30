# Inventory Management System
A simple inventory management system developed with PHP and MySQL. This project allows you to manage products, categories, clients, and users through a web interface.

## Features

- User authentication (login, registration, logout)
- Category management (create, edit, delete)
- Product management
- Client management
- Responsive interface with Bulma CSS
- Secure session handling and input validation
- AJAX support for dynamic actions

## Requirements

- PHP 7.4 or higher
- MySQL/MariaDB
- Composer (optional, for dependency management)
- Node.js & npm (optional, for frontend assets with Webpack)
- [Laragon](https://laragon.org/) or any local Apache server

## Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/yourusername/your-repo-name.git
   cd your-repo-name
   ```

2. **Import the database:**
   - Create a database named `inventory` in MySQL.
   - Import the provided SQL file (if available) or create the necessary tables.

3. **Configure the database connection:**
   - Edit `db/db.php` and set your MySQL credentials.

4. **Set up your web server:**
   - Point the Apache/Nginx root to the `www/sinventory` folder.
   - If using Laragon, place the project in the `www` directory.

5. **(Optional) Install frontend dependencies:**
   ```sh
   npm install
   npm run build
   ```

## Usage

- Visit `http://localhost/sinventory` in your browser.
- Register a new user and start managing your inventory.

## Folder Structure

```
www/sinventory/
├── db/                # Database connection scripts
├── inc/               # Includes (session, regex, helpers)
├── php/               # Backend logic (login, registration, processing scripts)
├── public/            # Public assets (images, JS, CSS)
├── templates/         # HTML templates
├── views/             # Page views
├── index.php          # Main entry point
```

## Security Notes

- All user input is validated both client-side and server-side.
- Sessions use secure cookie parameters.
- Passwords are stored using `password_hash()`.

## Contributions

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

## License

This project is open source and distributed under the terms of the MIT license.
