# Polaris LMS

A sleek and modern **Learning Management System** built with Laravel 12 and Tailwind CSS. This app allows teachers to create subjects and tasks, and students to submit solutions. It includes a full evaluation flow, role-based dashboards, and a premium glassmorphism design.

## Features

- Role-based access for **teachers** and **students**
- Teacher dashboard to manage:
  - Subjects
  - Tasks
  - Student submissions
  - Solution evaluation
- Student dashboard to:
  - Join/leave subjects
  - View tasks and submit solutions
- Evaluation system with feedback and grading
- Soft delete functionality for subjects
- Clean routing structure with RESTful resource controllers
- Premium UI with TailwindCSS and smooth navigation

## Built With

- [Laravel 12](https://laravel.com/)
- [Tailwind CSS](https://tailwindcss.com/)
- [SQLite](https://www.sqlite.org/) for lightweight database
- [Blade](https://laravel.com/docs/12.x/blade) templating engine

---

## ⚙️ Installation

1. **Clone the repository:**

```bash
git clone https://github.com/khayrullo-isomiddinov/polarisLMS.git
cd lms

composer install
npm install
npm run dev
php artisan migrate:fresh
php artisan db:seed --class=LmsSeeder
php artisan serve
```
## License

Khayrullo Isomiddinov [MIT license](https://opensource.org/licenses/MIT).

