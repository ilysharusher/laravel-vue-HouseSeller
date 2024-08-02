<p align="center">
  <a href="http://house-seller.ninja" style="text-decoration: none; color: inherit;">
    <h1 align="center">House Seller</h1>
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Vue-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white" alt="Vue">
  <img src="https://img.shields.io/badge/Inertia.js-5566FF?style=for-the-badge&logo=inertia&logoColor=white" alt="Inertia.js">
  <img src="https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Redis-DC382D?style=for-the-badge&logo=redis&logoColor=white" alt="Redis">
</p>

Welcome to **House Seller**, the ultimate real estate marketplace where sellers and buyers can seamlessly connect, communicate, and close deals. This project leverages the power of Laravel, Vue, Inertia, and Docker to provide a robust and scalable platform.

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [Live Demo](#live-demo)

## Features

- **User Authentication**: Secure login and registration system.
- **Ad Posting**: Sellers can post real estate ads with photos.
- **Personal Dashboard**: Users have a personal account to manage their ads.
- **Notifications**: Real-time notifications for user interactions.
- **Chat System**: Embedded chat for communication between sellers and buyers.
- **Dockerized**: Seamless deployment and development environment with Docker.

## Tech Stack

- **Backend**: [Laravel](https://laravel.com) with Vite
- **Frontend**: [Vue.js](https://vuejs.org) with Inertia.js
- **Database**: [MySQL](https://www.mysql.com)
- **Caching**: [Redis](https://redis.io)
- **Containerization**: [Docker](https://www.docker.com)

## Installation

### Prerequisites

- Docker and Docker Compose installed on your machine.

### Steps

1. **Clone the Repository**
    ```sh
    git clone https://github.com/ilysharusher/laravel-vue-HouseSeller.git
    cd laravel-vue-HouseSeller
    ```

2. **Environment Setup**
   Copy the example environment file and adjust the variables as needed:
    ```sh
    cp .env.example .env
    ```

3. **Build and Run Docker Containers**
   For local development:
    ```sh
    docker compose up -d
    ```

   For production:
    ```sh
    docker compose -f docker-compose.prod.yml up -d
    ```

4. **Run Migrations and Seed Database**
    ```sh
    docker compose exec app php artisan migrate --seed
    ```

5. **Install Frontend Dependencies**
    ```sh
    docker compose exec app npm install
    docker compose exec app npm run build
    ```

## Usage

- Access the application at `http://localhost:8876` for local development.
- Register or log in to start posting ads.
- Use the personal dashboard to manage your ads.
- Chat with potential buyers directly through the platform.

## Live Demo

Check out the live demo at [house-seller.ninja](http://house-seller.ninja).
