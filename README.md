# Inventory Management System

A simple inventory management system built with PHP and MySQL. This project allows you to manage products, categories, clients, and users with a web interface.

## Features

- User authentication (login, registration, logout)
- Category management (create, edit, delete)
- Product management
- Client management
- Responsive UI with Bulma CSS
- Secure session handling and input validation
- AJAX support for dynamic actions

## Requirements

- PHP 7.4 or higher
- MySQL/MariaDB
- Composer (optional, if you want to manage dependencies)
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
   - Import the provided SQL file (if available) or create tables as needed.

3. **Configure database connection:**
   - Edit `db/db.php` and set your MySQL credentials.

4. **Set up your web server:**
   - Point your Apache/Nginx root to the `www/sinventory` folder.
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
├── php/               # Backend logic (login, register, process scripts)
├── public/            # Public assets (images, JS, CSS)
├── templates/         # HTML templates
├── views/             # Page views
├── index.php          # Main entry point
```

## Security Notes

- All user input is validated both client-side and server-side.
- Sessions use secure cookie parameters.
- Passwords are hashed using `password_hash()`.

## Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

## License

This project is open source and