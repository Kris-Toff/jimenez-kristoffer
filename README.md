Technical Aptitude Test : Easy Round

Brief Solution:
    - Configuring hours: I created a simple dashboard for updating bakery opening hours, lunch time and the every other week option. To access the dashboard I also created a login page with basic email and password fields. You will be able to access the login page by manualy typing the "/login" in the address bar.
    
    - Realtime Store Status:  I created a reusable component for displaying bakery store status (open/close). The HomepageController@index will get the current date time (based on your timezone) and check in the business_hours table if the current day is open based on the configured time. If the store is closed, getting the next opening date, I created a function ( getNextOpenDay ) that iterates and add 1 day to the current date and check if in the business_hours DB if the store is open.
    
    - Date Picker for Visitors: I created a component with a datepicker with a button that checks if the bakery is open or close on that specific date. I created a function that checks the if a specific date is open similar to the HomepageController@index but the date is based on the datepicker. If the store is closed the checker will return a date on when is the next open date ( this is using similar function: getNextOpenDay ). In the frontend side, the next open date is being processed to a human readable format. I created a composable ( useDateFormatting.js ) to change the date.

Setup & Installation:
    - This is my setup, I am using Laravel 12 + Docker + Sail + Inertia + Vuejs 3 and MySQL in a Windows Machine
    
    - These steps are based on the Laravel documentation: https://laravel.com/docs/12.x/installation
    - Install PHP, Composer, Laravel, Node and NPM
    - If you have PHP and Composer Installed run : composer global require laravel/installer to install laravel installer

    - Pull from the repository: https://github.com/Kris-Toff/jimenez-kristoffer.git
    - Enter "cd jimenez-kristoffer"
    - Run npm install && npm run build
    - Run composer run dev

    - Start docker
    - Open a new terminal
    - Run composer install
    - Run ./vendor/bin/sail up ( this will start the server, do not close )
    - Open a new terminal
    - Run ./vendor/bin/sail artisan migrate
    - Run ./vendor/bin/sail artisan db:seed
  
    - Open http://localhost in browser
    - Go to http://localhost/login to access dashboard page
    - Using these credentials: email: admin@mail.com, password: admin

Challenges faced:
    - One challenge I encountered before working on this is how to have one repository for both frontend and backend. I had to use Inertia to solve this problem.
    - For the every other week opening, I had to create a check box to toggle if this day will open every other week, and provide a date picker as a starting date and used as a reference if it is open or close this week.