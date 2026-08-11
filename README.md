# Block Scholar — Scholarship Distribution System

An academic demonstration of a scholarship distribution workflow built with Laravel: students apply to scholarships listed by organizations/providers, providers review and approve applications, and approved disbursements are recorded as a blockchain transaction on the Ethereum Sepolia **test** network.

This is a portfolio/academic project — not a live scholarship program. See [`/privacy`](resources/views/privacy.blade.php), [`/terms`](resources/views/terms.blade.php), and [`/how-it-works`](resources/views/how-it-works.blade.php) once running for full details, and [CASE_STUDY.md](CASE_STUDY.md) for the project write-up.

## Installation Instructions
- Download PHP 8.1+ from the official PHP site
- Download the latest Composer and install it
- Clone this repository:
  ```
  git clone https://github.com/anjhonhulguin02-blip/Scholarship-Distribution-System.git
  ```
- Go to the cloned repository directory:
  ```
  cd Scholarship-Distribution-System
  ```
- Run `composer install`
- If you encounter errors, enable required PHP extensions by running `php --ini`, opening the listed `php.ini` in a text editor, and removing the leading `;` before:
  ```
  exif, gd2, pdo_mysql, fileinfo
  ```
  Save, then rerun `php --ini` to confirm, and rerun `composer install`.
- Run `npm install`
- Run `npm run build` (or `npm run dev` while developing)
- Copy `.env.example` to `.env` and fill in your database credentials
- Run `php artisan key:generate` if `APP_KEY` is empty
- Run `php artisan migrate`
- Run `php artisan storage:link`

## Running the server
- `php artisan serve --port 8443`, then open `http://localhost:8443`
- Or run `start_service.bat`

## Troubleshooting PHP extensions
- Open your `php.ini` file
- Search for `extension=`
- Remove the leading `;` to enable the extension you need
- Save and rerun `php --ini` to confirm
