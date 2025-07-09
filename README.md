# Simple Case Web Application

This PHP application lets users log in, add case records, and export them to Excel (CSV). Two roles are supported: normal `user` and `admin`.

## Setup
1. Create a MySQL database named `files` (or change the name in `database.php`).
2. Import `db_schema.sql` to create the required tables.
3. Run `create_admin.php` once to create an initial admin user (`admin` / `adminpass`).

## Usage
- Open `login.php` to log in.
- Normal users can add cases and see only their own entries.
- The admin user can see all cases and export them using the **Export to Excel** link.

Exported data is returned as `cases.csv` which can be opened in Excel.
