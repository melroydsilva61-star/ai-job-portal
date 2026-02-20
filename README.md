# 🚀 AI Job Portal

A modern, fully functional AI-powered Job Portal system built using PHP, MySQL, HTML, CSS, and JavaScript.

This platform allows Employers to post jobs, Job Seekers to apply, and Admin to manage the complete system.

---

# 👨‍💻 Developer

**Mohammed Arhan**  
Full Stack Developer & AI/ML Engineer  
Zephyr Technologies  
🎓 MCA Graduate  

---

# 🌟 Project Overview

AI Job Portal is a role-based web application designed to manage recruitment efficiently.

The system supports:

- Admin (Full Control)
- Employer (Post & Manage Jobs)
- Job Seeker (Search & Apply Jobs)

The UI follows a modern SaaS-style glassmorphism design with gradient backgrounds and responsive layout.

---

# 🛠 Tech Stack

- PHP (Core PHP)
- MySQL Database
- HTML5
- CSS3 (Modern UI)
- JavaScript
- XAMPP (Apache + MySQL)

---

# 📂 Project Folder Structure
ai_job_portal/
│
├── admin/
├── employer/
├── jobseeker/
├── includes/
├── assets/
│ ├── css/
│ ├── js/
│ └── images/
├── uploads/
├── index.php
├── login.php
├── register.php
└── README.md


---

# 🔐 Role-Based Features

## 👑 Admin
- Manage Users
- Manage Jobs
- Manage Categories
- Full Dashboard Access

## 🏢 Employer
- Post New Jobs
- Manage Posted Jobs
- View Applications

## 👨‍🎓 Job Seeker
- Search Jobs
- Apply for Jobs
- Upload Resume
- Track Application Status

---

# 🗄 DATABASE SETUP

## Step 1: Create Database

```sql
CREATE DATABASE ai_job_portal;
USE ai_job_portal;

-- ==============================
-- CREATE DATABASE
-- ==============================
CREATE DATABASE ai_job_portal;
USE ai_job_portal;

-- ==============================
-- TABLE 1: users
-- ==============================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','employer','jobseeker') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==============================
-- TABLE 2: categories
-- ==============================
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- ==============================
-- TABLE 3: jobs
-- ==============================
CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employer_id INT NOT NULL,
    category_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(100),
    salary VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employer_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- ==============================
-- TABLE 4: applications
-- ==============================
CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NOT NULL,
    jobseeker_id INT NOT NULL,
    resume VARCHAR(255),
    status VARCHAR(50) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE,
    FOREIGN KEY (jobseeker_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ==============================
-- DEFAULT ADMIN ACCOUNT
-- ==============================
INSERT INTO users (name, email, password, role)
VALUES ('Admin', 'admin@gmail.com', '12345', 'admin');

-- ==============================
-- DEFAULT CATEGORIES
-- ==============================
INSERT INTO categories (name) VALUES
('IT'),
('Marketing'),
('Finance'),
('HR'),
('Sales');`