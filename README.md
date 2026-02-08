# Symfony 6 + Vue 3 – Multi‑step User Wizard

## 📌 Project description

This project implements a **3‑step registration wizard** using **Symfony 6.4 (API backend)** and **Vue 3 (frontend)**.

The goal is to:

* collect user data in multiple steps,
* validate it on **frontend and backend**,
* store it in the database,
* and display submitted data after successful save.

The project follows **clean architecture principles**:

* DTOs for input validation
* Services for business logic
* Composables & validators on frontend

---

## 🧩 Functional requirements (fulfilled ✅)

### Frontend (Vue 3)

✔ 3‑step wizard with free navigation between steps

**Step 1 – Basic info**

* First name (required)
* Last name (required)
* Birthday (YYYY‑MM‑DD, must be < today)

**Step 2 – Contact info**

* Email (required, valid format)
* Phone (required, regex validation)

**Step 3 – Work experience**

* Dynamic list (add/remove rows)
* Company (required)
* Position (required)
* Date from / date to
* Validation: dateFrom ≤ dateTo

✔ Frontend validation
✔ Backend validation
✔ Errors shown **next to fields**
✔ Data sent to backend API
✔ Display submitted data after success

---

### Backend (Symfony 6.4)

✔ REST API endpoint `/api/user`
✔ DTOs for request structure
✔ Symfony Validator constraints
✔ 3 Doctrine entities:

* User
* Contact
* WorkExperience

✔ Data persisted only if valid
✔ Errors returned in structured format:

```json
{
  "user.name": ["This value should not be blank."],
  "contact.email": ["This value is not a valid email address."],
  "workExperiences.0.dateFrom": ["Start date cannot be after end date"]
}
```

---

## Project Setup (Docker)

### 1. Copy environment file:

From the project root:

```bash
   cp .env.example .env
```
### 2. Build and start containers

From the project root:

```bash
docker compose up -d --build
```

This will:

* build PHP, Nginx, PGAdmin and PostgreSQL containers
* start all required services

### 3. Wait for the download

You need to wait for all dependencies to load. You can check the "php-fpm2" container logs to determine whether the download is complete. If there are no errors, you should see the message "Starting application..."

---
## 🧪 Validation rules

### Frontend

* Required fields
* Email regex
* Phone regex: `^\+?[0-9]{9,15}$`
* Date comparisons

### Backend

* `NotBlank`
* `Email`
* `Regex`
* `Callback` for date comparison

✔ Frontend = UX
✔ Backend = data integrity

---


## API Usage

### 1. Create user profile

Creates a new user profile with basic information, contact details and work experience.

**Endpoint:**

```
POST /api/user
```

**Body:**

```json
{
  "url": "https://example.com",
  "alias": "optional-alias",
  "expire": "1h",
  "isPublic": false
}
```

**Notes:**

* `alias` is optional (auto-generated if missing)
* `expire` can be: `1h`, `1d`, `1t`
* private URLs require authentication to access stats
* Rate limit: max 10 links / minute / session
  
**Request body:**

```json
{
  "user": {
    "name": "Jan",
    "surname": "Kowalski",
    "birthday": "1990-05-12"
  },
  "contact": {
    "email": "test@gmail.com",
    "phone": "123456789"
  },
  "workExperiences": [
    {
      "company": "Google",
      "position": "CEO",
      "fromDate": "2015-01-01",
      "toDate": "2020-12-31"
    }
  ]
}
```

Validation rules:
* all fields are required
* birthday must be a valid date earlier than today
* email must be a valid email address
* phone must be a valid phone number
* fromDate must not be later than toDate

**Success response (200):**

```json
{
  "First name": "Jan",
  "Second name": "Kowalski",
  "Birth date": "1990-05-12",
  "email": "test@gmail.com",
  "phone'": "123456789",
  "Work Experiences'": {
    "company": "Google",
    "position": "CEO",
    "From date": "2015-01-01",
    "To date": "2020-12-31"
  }
}
```

**Validation error response (422):**

```json
{
  "errors": {
    "contact.email": [
      "This value is not a valid email address."
    ],
    "workExperiences.0.fromDate": [
      "This date cannot be later than end date."
    ]
  }
}
```
---
## 🔌 External libraries used
**Frontend (Vue):**
* Vue 3 — core framework
* Axios — HTTP communication with backend
* Tailwind CSS — UI styling
* Symfony Webpack Encore — asset bundling

**Backend (Symfony):**
* Doctrine ORM — database persistence
* Symfony Validator — backend validation
* Symfony Serializer — request/response mapping
* Symfony Webpack Encore Bundle — frontend integration

All used libraries are listed explicitly in package.json and composer.json.

---
## ✅ Status

**All task requirements are fully implemented.**

The solution matches real‑world production patterns for Symfony + Vue applications.
