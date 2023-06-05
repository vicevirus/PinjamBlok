# PinjamBlok

PinjamBlok is a full-stack application built with Laravel, Truffle, and Express REST API.

## Description

This project serves as a template for developing a full-stack web application. It combines the power of Laravel for the backend, Truffle for smart contract development and Ethereum integration, and Express for building a RESTful API. By leveraging these technologies, you can create a robust and scalable application with ease.

## Features

- Laravel: A powerful PHP framework for building web applications.
- Truffle: A development framework for Ethereum smart contracts.
- Express: A fast and minimalist web application framework for Node.js.
- REST API: Build a scalable and flexible API using Express.

## Prerequisites

Before getting started, make sure you have the following prerequisites installed:

- PHP (&gt;=7.2.5)
- Composer
- Node.js (&gt;=12.x)
- Truffle Framework
- Ganache (or any Ethereum development blockchain)

## Installation

Follow these steps to set up and run the project locally:

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/project-name.git
```

Change to the project directory:bash
```bash
cd project-name
```

Install PHP dependencies:bash
```bash
composer install
```

Install Node.js dependencies:bash
```bash
npm install
```

Set up the environment variables:Laravel: Rename the ```.env.example``` file to ```.env``` and update the necessary variables.Truffle: Update the ```truffle-config.js``` file with your Ethereum network configuration.

Run migrations and seed the database:bash
```bash
php artisan migrate --seed
```

Compile and deploy smart contracts:bash
```bash
truffle migrate
```

Start the Laravel server:bash
```bash
php artisan serve
```

Start the Express server:bash
```bash
npm run start
```

Open your web browser and access the application at ```http://localhost:8000```.UsageAccess the Laravel application by visiting ```http://localhost:8000```.Access the REST API endpoints provided by Express at ```http://localhost:3000/api```.Contributing

Contributions are welcome! If you find any issues or want to enhance the project, feel free to open a pull request.License

This project is licensed under the MIT License.css
```css

Feel free to customize and expand upon this template according to your specific project details and requirements.
```