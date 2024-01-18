# Appointment Reservation System

This is a simple PHP project that allows users to reserve appointments for specific dates and times. The project uses a MySQL database for data storage and PDO for database connectivity.

## Features

- **User Reservation:**
  - Users can select a date and time for an appointment reservation.
  - Once a reservation is made, the reserved slot becomes unavailable for further bookings.

- **Cancellation:**
  - Users can cancel their reservations by clicking on the reserved time slot.

## Technologies Used

- **PHP:**
  - The backend logic and database interactions are implemented in PHP.

- **MySQL:**
  - The project uses a MySQL database to store reservation data.

- **PDO (PHP Data Objects):**
  - PDO is utilized for secure and efficient database connectivity.

- **FullCalendar Library:**
  - The FullCalendar library is integrated for displaying and interacting with the calendar on the frontend.

- **Docker:**
  - Docker is used for containerization, making it easy to set up and run the application.

## Installation

1. **Clone the Repository:**
   ```bash
   https://github.com/Ehsan-Eghbali/Calender.git
    ```

2. **Build and Run Docker Containers:**

    ```bash
    docker-compose up -d
    ```

3. **Access the Application:**

The application will be available at http://localhost:80.

# Project Notes

## Configuration Files

- The `config.php` file contains database connection details and can be customized accordingly.

## Database Initialization

- Use the `init.sql` file to create the necessary appointments table in the MySQL database.

## Calendar Support

- Ensure that the `jalali-moment.browser.js` library is accessible and correctly linked in the `index.php` file for Shamsi (Jalali) calendar support.

## Function Updates

- The `handleReservation` function in `Controller/AppointmentsContrroller.php` has been updated to include a check for existing reservations at the selected time.

- The `isTimeReserved` function in `Controller/AppointmentsContrroller.php` is introduced to check for existing reservations in the database.

## README Updates

- The `README.md` file has been updated to include Docker setup instructions and customization details.
