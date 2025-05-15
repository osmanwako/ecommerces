# Simple E-Commerce Website

This is a PHP-based e-commerce website that supports two types of users: **Customers** and **Companies**. It allows companies to post products for sale and customers to browse and place orders.

## 🌐 Technologies Used

- HTML5
- CSS3
- JavaScript (Vanilla)
- PHP (Procedural or OOP)
- MySQL Database
- WAMP/XAMPP for local development

## 📦 Features

### ✅ General
- Home page with company info and sign-in / sign-up options
- Separate dashboards for Customers and Companies

### 🛒 Customer Role
- Register and log in
- Browse available products
- Place orders for products

### 🏭 Company Role
- Register and log in
- Add products for sale
- View customer orders for their products

## 🗃️ Database Entities

The MySQL database includes the following core entities:

- `Customer`: Stores customer data
- `Company`: Stores company account info
- `Product`: Stores product details listed by companies
- `Sales` (or `Orders`): Stores customer orders and sales records

## 🛠️ Setup Instructions

1. Install [XAMPP](https://www.apachefriends.org/) or [WAMP](https://www.wampserver.com/) on your local machine.
2. Clone or download this repository into your web server root (`htdocs/` or `www/`).
3. Import the provided SQL file (or create manually) into your MySQL server.
4. Update the database connection settings in `config.php`.
5. Start Apache and MySQL via your local server (WAMP/XAMPP).
6. Open `http://localhost/ecommerces` in your browser.

## 📄 License

This project is licensed under the [MIT License](./LICENSE).

## 👤 Author

- Your Name — **Osman Wako Wario**


