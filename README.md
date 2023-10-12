## Mortgage Loan Calculator App

Mortgage Loan Calculator App is a web application that allow users to input loan details such as loan amount, interest rate, and loan
term. The mortgage loan should allow for fixed terms and extra repayments. The application should generate an amortization schedule that shows the monthly payment breakdown, including the principal and interest components, for the entire loan term, along with a header displaying the loan setup details and the effective interest rate. Additionally, the application should also generate a schedule that shows the recalculated, shortened loans due to extra payments made by the borrower, also with a header displaying the loan setup details and the effective interest rate

## About the Developer
This is a Coding Solution for Mortgage Loan Calculation of Kieffer John M. Navarro.

## How to install the app locally
- Make sure Composer, Node.js and XAMPP is installed on your local device.
- Clone the repository using this link [https://github.com/kjmnavarro/mortgate-loan-app.git](https://github.com/kjmnavarro/mortgate-loan-app.git)

```

git clone https://github.com/kjmnavarro/mortgate-loan-app.git

```

- Open the folder of the newly cloned code repo to a command prompt of GitBash
- You need to install composer and npm before running other Laravel scripts.

```

composer install
npm install

```

- After installing composer and npm you can now run npm script for processing the front end packages

```

npm run dev

```

- You need to create a .env file and input details such as APPNAME and DBNAME. (You may refer to the .env example as guide)
- You need to run these Laravel artisan scripts

```

php artisan key:generate
php artisan migrate
php artisan config:clear

```

- After running the Laravel artisan scripts, you can now run the APP locally using this Laravel artisan script

```

php artisan serve

```