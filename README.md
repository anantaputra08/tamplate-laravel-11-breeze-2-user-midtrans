<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Setup Instructions

To set up the project after pulling it from GitHub, follow these steps:

1. **Clone the Repository**: 
   ```bash
   git clone https://github.com/anantaputra08/tamplate-laravel-11-breeze-2-user-midtrans.git
   ```

2. **For XAMPP Users**: 
   Move the cloned repository to the `htdocs` directory:

   **For Mac Users**:
   ```bash
   mv tamplate-laravel-11-breeze-2-user-midtrans /Applications/XAMPP/xamppfiles/htdocs/
   ```

   **For Windows Users**:
   ```bash
   move tamplate-laravel-11-breeze-2-user-midtrans C:\xampp\htdocs\
   ```

3. **Navigate to the Project Directory**: 

   **For Mac Users**:
   ```bash
   cd /Applications/XAMPP/xamppfiles/htdocs/tamplate-laravel-11-breeze-2-user-midtrans
   ```

   **For Windows Users**:
   ```bash
   cd C:\xampp\htdocs\tamplate-laravel-11-breeze-2-user-midtrans
   ```

4. **Install Dependencies**: 
   ```bash
   composer install
   npm install
   ```

5. **Update Composer**: 
   ```bash
   composer update
   ```

6. **Set Up Environment File**: 
   ```bash
   cp .env.example .env
   ```

7. **Generate Application Key**: 
   ```bash
   php artisan key:generate
   ```

8. **Run Migrations**: 
   ```bash
   php artisan migrate
   ```

9. **Run Seeders**: 
   ```bash
   php artisan db:seed
   ```

10. **Add Midtrans Configuration**: 
    Open the `.env` file and add the following lines:
    ```bash
    <-- existing .env config -->

        MIDTRANS_SERVER_KEY=your midtrans server key
        MIDTRANS_CLIENT_KEY=your midtrans client key
        MIDTRANS_IS_PRODUCTION=false
        MIDTRANS_IS_SANITIZED=true
        MIDTRANS_IS_3DS=true
    ```

11. **Serve the Application**: 

    **For Mac Users**:
    ```bash
    php artisan serve & npm run dev
    ```

    **For Windows Users**:
    Open a terminal and run the following command:
    ```bash
    start /B php artisan serve && npm run dev
    ```

### Additional Instructions for XAMPP Users

If you are using XAMPP, follow these additional steps:

1. **Start Apache and MySQL**:
   Open the XAMPP Control Panel and start the Apache and MySQL services.

2. **Update `.env` File**:
   Update the database configuration in your `.env` file to match your XAMPP setup:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Access the Application**:
   Open your browser and navigate to `http://localhost:8000`.

If you encounter any issues, please refer to the [Laravel documentation](https://laravel.com/docs) or open an issue on the repository.