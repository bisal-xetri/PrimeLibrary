# Library Management System

This is a Library Management System built using PHP and MySQL that allows students to request and issue books while maintaining proper records. Users can borrow books, track issued books, and return them.

## Features

- **User Authentication:** Students can log in and access their accounts.
- **Book Requests:** A student can request up to 3 books.
- **Book Issuance:** A student can have up to 3 issued books at a time.
- **Automatic Book Stock Management:** When a book is requested, the number of available copies decreases by 1.
- **Book Return:** Students can return issued books, removing them from the issued list.
- **Fine Management:** Fine is calculated based on return date.

## Technologies Used

- **Frontend:** HTML, CSS
- **Backend:** PHP, MySQL
- **Database:** MySQL

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/library-management-system.git
   ```
2. Navigate to the project directory:
   ```bash
   cd library-management-system
   ```
3. Import the database:
   - Create a MySQL database.
   - Import the provided `library.sql` file into your database.
4. Configure the database connection:
   - Update `include/db.php` with your MySQL database credentials.
5. Start the local server using XAMPP or WAMP and place the project inside the `htdocs` folder.

## Usage

- **Login** as a student to request or issue books.
- Click on **Request** to borrow a book (up to 3 books allowed).
- Click on **Return** to return an issued book.
- Admin can manage books and student records.

## Folder Structure
```
project-folder/
│── include/           # Contains header, footer, database connection
│── student/           # Student-specific pages (issue, return books)
│── admin/             # Admin panel for managing books and users
│── images/            # Book cover images
│── index.php          # Home page
│── request.php        # Handles book request logic
│── return.php         # Handles book return logic
│── issued_books.php   # Shows issued books for a student
│── library.sql        # Database schema
│── README.md          # Project documentation
```

## Contributing

If you wish to contribute, feel free to fork the repository and submit a pull request with improvements.

## License

This project is open-source and free to use.

## Author

**Bishal Dhakal**

For any queries, contact me at **dhakalbishal42@gmail.com**.

