# Task Manager Application

This is a task management application built with Laravel, Livewire, and Bootstrap 5, featuring user authentication, project management, and task tracking.

## Features

-   **User Authentication**: Powered by Laravel Breeze (registration, login, profile management).
-   **Project Management**:
    -   Create, view, update, and delete projects.
    -   List projects with status filtering.
    -   Projects belong to a user (creator).
-   **Task Management**:
    -   CRUD operations for tasks within a project.
    -   Tasks have priority (low/medium/high) and status (todo/in_progress/done).
    -   Tasks can be assigned to other users.
    -   Filter tasks by status and priority.
-   **Livewire Components**:
    -   **TaskBoard**: Displays tasks in columns (Todo, In Progress, Done) with real-time status updates via drag & drop. Includes task counters.
    -   **QuickAddTask**: A form for quickly adding tasks to a project without page reload, with success notifications.
-   **Authorization (Gates & Policies)**:
    -   `ProjectPolicy`: Only the project creator can view, update, or delete their projects.
    -   `TaskPolicy`:
        -   `create`: Project creator can create tasks.
        -   `update`: Project creator or assigned user can update a task.
        -   `delete`: Only the project creator can delete a task.
-   **Responsive Design**: Built with Bootstrap 5 for a mobile-first experience.

## Technical Stack

-   **Laravel**: v12
-   **PHP**: 8.2
-   **Database**: MySQL
-   **Frontend**:
    -   **Laravel Breeze**: For authentication scaffolding.
    -   **Livewire**: v3.6 for dynamic frontend components.
    -   **Bootstrap**: v5 for styling and responsive layout.
-   **Other**: FormRequest validation, Database Seeders.

## Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/haidasse/task-manager.git
    cd task-manager
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install JavaScript dependencies:**
    ```bash
    npm install
    ```

4.  **Create a copy of the `.env.example` file and name it `.env`:**
    ```bash
    cp .env.example .env
    ```

5.  **Generate an application key:**
    ```bash
    php artisan key:generate
    ```

6.  **Configure your database in `.env`:**
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=task_manager
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    (Make sure to create the `task_manager` database in your MySQL server.)

7.  **Run migrations and seed the database:**
    ```bash
    php artisan migrate:fresh --seed
    ```
    This will set up the database schema and populate it with test data (users, projects, tasks).

8.  **Compile frontend assets:**
    ```bash
    npm run dev
    # Or for production:
    # npm run build
    ```

9.  **Start the Laravel development server:**
    ```bash
    php artisan serve
    ```

The application will be accessible at `http://127.0.0.1:8000`.

## Test Accounts

You can log in with the following credentials:

*   **Email**: `test@example.com` / **Password**: `password`
*   **Email**: `test1@example.com` / **Password**: `password`
*   **Email**: `test2@example.com` / **Password**: `password`

## Technical Choices

*   **Laravel Breeze**: Chosen for rapid authentication scaffolding, providing a solid foundation for user management without much boilerplate.
*   **Livewire 3**: Selected for building dynamic frontend components (TaskBoard, QuickAddTask) with a PHP-first approach, reducing the need for extensive JavaScript and simplifying state management between frontend and backend.
*   **Bootstrap 5**: Utilized for its comprehensive set of responsive UI components, allowing for a clean and mobile-friendly interface with minimal custom CSS.
*   **FormRequest Validation**: Ensures robust server-side validation for all forms, separating validation logic from controllers.
*   **Gates & Policies**: Implemented for granular authorization control, ensuring that users can only interact with resources they are permitted to access, aligning with the principle of least privilege.

---

This README provides comprehensive instructions for setting up and understanding the application.
