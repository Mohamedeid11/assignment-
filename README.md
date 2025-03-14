# Project Name

## Description
This project is a Laravel-based application with user authentication and project management capabilities.

---

## Setup Instructions

### Prerequisites:
- PHP 8.2 or later  
- Composer  
- MySQL or PostgreSQL  
- Laravel 12 
- Node.js & npm (for frontend assets)  

### Installation Steps:

1. **Clone the Repository**  
   ```sh
   git clone https://github.com/your-repo/project.git
   cd project
   ```

2. **Install Dependencies**  
   ```sh
   composer install
   npm install
   ```

3. **Configure Environment**  
   Copy `.env.example` to `.env` and update the database credentials:  
   ```sh
   cp .env.example .env
   ```

4. **Generate Application Key**  
   ```sh
   php artisan key:generate
   ```

5. **Run Migrations & Seed Database**  
   ```sh
   php artisan migrate --seed
   ```

6. **Start the Development Server**  
   ```sh
   php artisan serve
   ```

---

## **API Documentation**

### **Authentication API**

#### **1. Register a New User**
**Endpoint:**
```http
POST /api/register
```
**Request Payload:**
```json
{
    "first_name": "Mohamed",
    "last_name": "Eid",
    "email": "mohamed@test.com",
    "password": "password123"
}
```
**Response Example (Success):**
```json
{
    "code": 200,
    "status": true,
    "message": "User registered successfully",
    "data": {
        "id": 4,
        "first_name": "Mohamed",
        "last_name": "Eid",
        "email": "mohamed@test.com",
        "created_at": "2025-03-13T23:29:41.000000Z",
        "updated_at": "2025-03-13T23:29:41.000000Z",
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9..."
    }
}
```
**Response Example (Validation Error):**
```json
{
    "code": 400,
    "status": false,
    "message": "Validation failed",
    "data": {
        "email": ["The email has already been taken."]
    }
}
```

---

#### **2. Login**
**Endpoint:**
```http
POST /api/login
```
**Request Payload:**
```json
{
    "email": "mohamed@test.com",
    "password": "password123"
}
```
**Response Example (Success):**
```json
{
    "code": 200,
    "status": true,
    "message": "Logged-in successfully",
    "data": {
        "id": 4,
        "first_name": "Mohamed",
        "last_name": "Eid",
        "email": "mohamed@test.com",
        "created_at": "2025-03-13T23:29:41.000000Z",
        "updated_at": "2025-03-13T23:29:41.000000Z",
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9..."
    }
}
```
**Response Example (Invalid Credentials):**
```json
{
    "code": 401,
    "status": false,
    "message": "Unauthorised",
    "data": []
}
```

---

#### **3. Logout (Requires Authentication)**
**Endpoint:**
```http
POST /api/logout
```
**Headers:**
```http
Authorization: Bearer {token}
```
**Response Example:**
```json
{
    "code": 200,
    "status": true,
    "message": "Logged out successfully",
    "data": []
}
```
**Response Example (Unauthorized Request - Missing Token):**
```json
{
    "code": 401,
    "status": false,
    "message": "Unauthenticated",
    "data": []
}
```

---

### **User Management API**

#### **The following endpoints are available for managing users:**

#### **1. List All Users**
**Endpoint:**
```http
GET /api/users
```
**Headers:**
```
Authorization: Bearer {token}
```

**Response Example (Success):**
```json
{
    "code": 200,
    "status": true,
    "message": "Users retrieved successfully",
    "data": [
        {
            "id": 1,
            "first_name": "John",
            "last_name": "Doe",
            "email": "john.doe@example.com",
            "created_at": "2025-03-13T23:29:41.000000Z",
            "updated_at": "2025-03-13T23:29:41.000000Z"
        },
        {
            "id": 2,
            "first_name": "Jane",
            "last_name": "Smith",
            "email": "jane.smith@example.com",
            "created_at": "2025-03-13T23:29:41.000000Z",
            "updated_at": "2025-03-13T23:29:41.000000Z"
        }
    ]
}
```

---

#### **2. Create a New User**
**Endpoint:**
```http
POST /api/users
```
**Headers:**
```
Authorization: Bearer {token}
```

**Request Payload:**
```json
{
    "first_name": "Alice",
    "last_name": "Johnson",
    "email": "alice@example.com",
    "password": "password123"
}
```
**Response Example (Success):**
```json
{
    "code": 200,
    "status": true,
    "message": "User created successfully",
    "data": {
        "id": 3,
        "first_name": "Alice",
        "last_name": "Johnson",
        "email": "alice@example.com",
        "created_at": "2025-03-13T23:29:41.000000Z",
        "updated_at": "2025-03-13T23:29:41.000000Z"
    }
}
```

---

#### **3. Retrieve a Specific User**
**Endpoint:**
```http
GET /api/users/{id}
```
**Headers:**
```http
Authorization: Bearer {token}
```
**Response Example:**
```json
{
    "code": 200,
    "status": true,
    "message": "User retrieved successfully",
    "data": {
        "id": 1,
        "first_name": "John",
        "last_name": "Doe",
        "email": "john.doe@example.com",
        "created_at": "2025-03-13T23:29:41.000000Z",
        "updated_at": "2025-03-13T23:29:41.000000Z"
    }
}
```

---

#### **4. Update a User**
**Endpoint:**
```http
PUT /api/users/{id}
```
**Headers:**
```
Authorization: Bearer {token}
```

**Request Payload:**
```json
{
    "first_name": "John",
    "last_name": "Smith",
    "email": "john.smith@example.com"
}
```
**Response Example (Success):**
```json
{
    "code": 200,
    "status": true,
    "message": "User updated successfully",
    "data": {
        "id": 1,
        "first_name": "John",
        "last_name": "Smith",
        "email": "john.smith@example.com",
        "created_at": "2025-03-13T23:29:41.000000Z",
        "updated_at": "2025-03-13T23:29:41.000000Z"
    }
}
```

---


#### **5. Delete a User**
**Endpoint:**
```http
DELETE /api/users/{id}
```
**Headers:**
```http
Authorization: Bearer {token}
```
**Response Example:**
```json
{
    "code": 200,
    "status": true,
    "message": "User deleted successfully",
    "data": []
}
```

---

### **Project Management API**

#### **The following endpoints are available for managing projects:**

#### **1. List All Projects**
**Endpoint:**
```http
GET /api/projects
```
**Headers:**
```
Authorization: Bearer {token}
```
**Query Parameters:**

#### **.``name`` (optional): Filter projects by name.**
#### **.``status`` (optional): Filter projects by status.**
#### **.Custom filters (optional): Additional filters can be applied using the format**
**``attribute[operator]=value``.**

**Response Example (Success):**
```json
{
    "code": 200,
    "status": true,
    "message": "Projects retrieved successfully",
    "data": [
        {
            "id": 1,
            "name": "Project Alpha",
            "status": "active",
            "created_at": "2025-03-13T23:29:41.000000Z",
            "updated_at": "2025-03-13T23:29:41.000000Z",
            "attributes": [
                {
                    "attribute_id": 1,
                    "value": "High"
                }
            ]
        }
    ]
}
```

---

#### **2. Create a New Project**
**Endpoint:**
```http
POST /api/projects
```
**Headers:**
```
Authorization: Bearer {token}
```

**Request Payload:**
```json
{
    "name": "Project Beta",
    "status": "active",
    "attributes": [
        {
            "attribute_id": 1,
            "value": "Medium"
        }
    ]
}
```
**Response Example (Success):**
```json
{
    "code": 200,
    "status": true,
    "message": "Project created successfully",
    "data": {
        "id": 2,
        "name": "Project Beta",
        "status": "active",
        "created_at": "2025-03-13T23:29:41.000000Z",
        "updated_at": "2025-03-13T23:29:41.000000Z",
        "attributes": [
            {
                "attribute_id": 1,
                "value": "Medium"
            }
        ]
    }
}
```

---

#### **3. Retrieve a Specific Project**
**Endpoint:**
```http
GET /api/projects/{id}
```
**Headers:**
```http
Authorization: Bearer {token}
```
**Response Example:**
```json
{
    "code": 200,
    "status": true,
    "message": "Project retrieved successfully",
    "data": {
        "id": 1,
        "name": "Project Alpha",
        "status": "active",
        "created_at": "2025-03-13T23:29:41.000000Z",
        "updated_at": "2025-03-13T23:29:41.000000Z",
        "attributes": [
            {
                "attribute_id": 1,
                "value": "High"
            }
        ]
    }
}
```

---

#### **4. Update a Project**
**Endpoint:**
```http
PUT /api/projects/{id}
```
**Headers:**
```
Authorization: Bearer {token}
```

**Request Payload:**
```json
{
    "name": "Project Alpha Updated",
    "status": "inactive",
    "attributes": [
        {
            "attribute_id": 1,
            "value": "Low"
        }
    ]
}
```
**Response Example (Success):**
```json
{
    "code": 200,
    "status": true,
    "message": "Project updated successfully",
    "data": {
        "id": 1,
        "name": "Project Alpha Updated",
        "status": "inactive",
        "created_at": "2025-03-13T23:29:41.000000Z",
        "updated_at": "2025-03-13T23:29:41.000000Z",
        "attributes": [
            {
                "attribute_id": 1,
                "value": "Low"
            }
        ]
    }
}
```

---

#### **5. Delete a Project**
**Endpoint:**
```http
DELETE /api/projects/{id}
```
**Headers:**
```http
Authorization: Bearer {token}
```
**Response Example:**
```json
{
    "code": 200,
    "status": true,
    "message": "Project deleted successfully",
    "data": []
}
```

---


### **Timesheet Management API**

#### **The following endpoints are available for managing timesheets:**

#### **1. List All Timesheets**
**Endpoint:**
```http
GET /api/timesheets
```
**Headers:**
```
Authorization: Bearer {token}
```

**Response Example (Success):**
```json
{
    "code": 200,
    "status": true,
    "message": "Timesheets retrieved successfully",
    "data": [
        {
            "id": 1,
            "task_name": "Develop API",
            "date": "2025-03-13",
            "hours": 8,
            "user_id": 1,
            "project_id": 1,
            "created_at": "2025-03-13T23:29:41.000000Z",
            "updated_at": "2025-03-13T23:29:41.000000Z",
            "user": {
                "id": 1,
                "first_name": "John",
                "last_name": "Doe",
                "email": "john.doe@example.com"
            },
            "project": {
                "id": 1,
                "name": "Project Alpha",
                "status": "active"
            }
        }
    ]
}
```

---

#### **2. Create a New Timesheet**
**Endpoint:**
```http
POST /api/timesheets
```
**Headers:**
```
Authorization: Bearer {token}
```

**Request Payload:**
```json
{
    "task_name": "Develop API",
    "date": "2025-03-13",
    "hours": 8,
    "user_id": 1,
    "project_id": 1
}
```
**Response Example (Success):**
```json
{
    "code": 200,
    "status": true,
    "message": "Timesheet created successfully",
    "data": {
        "id": 1,
        "task_name": "Develop API",
        "date": "2025-03-13",
        "hours": 8,
        "user_id": 1,
        "project_id": 1,
        "created_at": "2025-03-13T23:29:41.000000Z",
        "updated_at": "2025-03-13T23:29:41.000000Z",
        "user": {
            "id": 1,
            "first_name": "John",
            "last_name": "Doe",
            "email": "john.doe@example.com"
        },
        "project": {
            "id": 1,
            "name": "Project Alpha",
            "status": "active"
        }
    }
}
```

---

#### **3. Retrieve a Specific Timesheet**
**Endpoint:**
```http
GET /api/timesheets/{id}
```
**Headers:**
```http
Authorization: Bearer {token}
```
**Response Example:**
```json
{
    "code": 200,
    "status": true,
    "message": "Timesheet retrieved successfully",
    "data": {
        "id": 1,
        "task_name": "Develop API",
        "date": "2025-03-13",
        "hours": 8,
        "user_id": 1,
        "project_id": 1,
        "created_at": "2025-03-13T23:29:41.000000Z",
        "updated_at": "2025-03-13T23:29:41.000000Z",
        "user": {
            "id": 1,
            "first_name": "John",
            "last_name": "Doe",
            "email": "john.doe@example.com"
        },
        "project": {
            "id": 1,
            "name": "Project Alpha",
            "status": "active"
        }
    }
}
```

---

#### **4. Update a Timesheet**
**Endpoint:**
```http
PUT /api/timesheets/{id}
```
**Headers:**
```
Authorization: Bearer {token}
```

**Request Payload:**
```json
{
    "task_name": "Update API",
    "date": "2025-03-14",
    "hours": 6,
    "user_id": 1,
    "project_id": 1
}
```
**Response Example (Success):**
```json
{
    "code": 200,
    "status": true,
    "message": "Timesheet updated successfully",
    "data": {
        "id": 1,
        "task_name": "Update API",
        "date": "2025-03-14",
        "hours": 6,
        "user_id": 1,
        "project_id": 1,
        "created_at": "2025-03-13T23:29:41.000000Z",
        "updated_at": "2025-03-13T23:29:41.000000Z",
        "user": {
            "id": 1,
            "first_name": "John",
            "last_name": "Doe",
            "email": "john.doe@example.com"
        },
        "project": {
            "id": 1,
            "name": "Project Alpha",
            "status": "active"
        }
    }
}
```

---


#### **5. Delete a Timesheet**
**Endpoint:**
```http
DELETE /api/timesheets/{id}
```
**Headers:**
```http
Authorization: Bearer {token}
```
**Response Example:**
```json
{
    "code": 200,
    "status": true,
    "message": "Timesheet  deleted successfully",
    "data": []
}
```

---

## Test Credentials

| User  | Email                  | Password  |
|-------|------------------------|----------|
| User  | john.doe@example.com   | password |
| User  | jane.smith@example.com | password |

---

## Running Tests

To run the tests, use:

```sh
php artisan test
```

---

## License

This project is licensed under the MIT License.
