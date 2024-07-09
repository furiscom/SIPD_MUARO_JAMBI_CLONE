# SIPD_MUARO_JAMBI_CLONE

#  Operation with OOP in PHP

This project demonstrates how to perform CRUD (Create, Read, Update, Delete) operations on a MySQL database using Object-Oriented Programming (OOP) in PHP. The database schema includes tables for `urusan`, `bidang urusan`, `program`, `kegiatan`, and `sub kegiatan`.

## Table of Contents

- [Getting Started](#getting-started)
- [Database Schema](#database-schema)
- [File Structure](#file-structure)
- [Contributing](#contributing)
- [License](#license)

## Getting Started

### Prerequisites

- PHP 7.x or higher
- MySQL 5.x or higher
- Web server (e.g., Apache, Nginx)

### Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/furiscom/SIPD_MUARO_JAMBI_CLONE.git
    cd yourrepository
    ```

2. Import the database schema into your MySQL database. You can use the following SQL script to create the necessary tables:

    ```sql
    -- Tabel Urusan
    CREATE TABLE urusan (
        id_urusan INT AUTO_INCREMENT PRIMARY KEY,
        nama_urusan VARCHAR(255) NOT NULL
    );

    -- Tabel Bidang Urusan
    CREATE TABLE bidang_urusan (
        id_bidang_urusan INT AUTO_INCREMENT PRIMARY KEY,
        id_urusan INT NOT NULL,
        nama_bidang_urusan VARCHAR(255) NOT NULL,
        FOREIGN KEY (id_urusan) REFERENCES urusan(id_urusan)
    );

    -- Tabel Program
    CREATE TABLE program (
        id_program INT AUTO_INCREMENT PRIMARY KEY,
        id_bidang_urusan INT NOT NULL,
        nama_program VARCHAR(255) NOT NULL,
        FOREIGN KEY (id_bidang_urusan) REFERENCES bidang_urusan(id_bidang_urusan)
    );

    -- Tabel Kegiatan
    CREATE TABLE kegiatan (
        id_kegiatan INT AUTO_INCREMENT PRIMARY KEY,
        id_program INT NOT NULL,
        nama_kegiatan VARCHAR(255) NOT NULL,
        FOREIGN KEY (id_program) REFERENCES program(id_program)
    );

    -- Tabel Sub Kegiatan
    CREATE TABLE sub_kegiatan (
        id_sub_kegiatan INT AUTO_INCREMENT PRIMARY KEY,
        id_kegiatan INT NOT NULL,
        nama_sub_kegiatan VARCHAR(255) NOT NULL,
        FOREIGN KEY (id_kegiatan) REFERENCES kegiatan(id_kegiatan)
    );
    ```

3. Update the database connection settings in `db.php` file:

    ```php
    <?php
    class Database {
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "nama_database"; // Change this to your database name
        public $conn;

        public function __construct() {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }

        public function __destruct() {
            $this->conn->close();
        }
    }
    ?>
    ```

4. Start your web server and open `index.php` in your browser to see the CRUD operations in action.

## Database Schema

The database schema consists of the following tables:

- `urusan`: Stores the main categories.
- `bidang_urusan`: Stores subcategories related to `urusan`.
- `program`: Stores programs related to `bidang_urusan`.
- `kegiatan`: Stores activities related to `program`.
- `sub_kegiatan`: Stores sub-activities related to `kegiatan`.

## File Structure

```
/path/to/your/project/
|-- db.php
|-- Urusan.php
|-- BidangUrusan.php
|-- Program.php
|-- Kegiatan.php
|-- SubKegiatan.php
|-- index.php
```


## Contributing

Contributions are welcome! Please submit a pull request or open an issue to discuss any changes.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.


