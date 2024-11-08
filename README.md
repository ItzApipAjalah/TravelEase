# API Documentation

## Authentication
Base URL: http://127.0.0.1:8000/api

### Register
POST /register
Request:
{
    "name": "string",
    "email": "string",
    "password": "string",
    "password_confirmation": "string"
}

### Login
POST /login
Request:
{
    "email": "string",
    "password": "string"
}
Response:
{
    "status": true,
    "message": "Login successful",
    "token": "string"
}

### Logout
POST /logout
Headers:
- Authorization: Bearer {token}

## Profile Management

### Update Profile
PUT /profile/update
Headers:
- Authorization: Bearer {token}
Request:
{
    "name": "string",
    "email": "string"
}

### Update Password
PUT /profile/password
Headers:
- Authorization: Bearer {token}
Request:
{
    "current_password": "string",
    "new_password": "string",
    "new_password_confirmation": "string"
}

## Tickets

### Get All Tickets (untuk id dari auth nya)
GET /ticket
Headers:
- Authorization: Bearer {token}

### Create Ticket
POST /tickets
Headers:
- Authorization: Bearer {token}
Request:
{
    "title": "string",
    "description": "string",
    "category_id": "integer"
}

### Update Ticket
PUT /tickets/{ticket_id}
Headers:
- Authorization: Bearer {token}
Request:
{
    "title": "string",
    "description": "string",
    "category_id": "integer"
}

## Ticket Messages

### Get Messages
GET /tickets/{ticketId}/messages
Headers:
- Authorization: Bearer {token}
Response:
{
    "status": true,
    "message": "Messages retrieved successfully",
    "data": {
        "ticket_id": integer,
        "ticket_status": "string",
        "messages": [
            {
                "id": integer,
                "message": "string",
                "created_at": "timestamp",
                "user": {
                    "id": integer,
                    "name": "string",
                    "type": "string"
                }
            }
        ]
    }
}

### Send Message
POST /tickets/{ticketId}/messages
Headers:
- Authorization: Bearer {token}
Request:
{
    "message": "string"
}

## Categories

### Get Categories
GET /categories
Headers:
- Authorization: Bearer {token}

## Conversation Tree (Chatbot)

### Get Initial Nodes
GET /conversation/initial
Response:
{
    "success": true,
    "message": "Initial conversation nodes retrieved successfully",
    "data": {
        "question": "string",
        "nodes": [
            {
                "id": integer,
                "question": "string",
                "button_text": "string",
                "answer": "string"
            }
        ]
    }
}

### Get Child Nodes
GET /conversation/children/{parentId}
Response:
{
    "success": true,
    "message": "Child nodes retrieved successfully",
    "data": {
        "question": "string",
        "parent_answer": "string",
        "nodes": [
            {
                "id": integer,
                "question": "string",
                "button_text": "string",
                "answer": "string"
            }
        ]
    }
}


## Error Responses


401 Unauthorized:
{
    "message": "Unauthenticated"
}

403 Forbidden:
{
    "status": false,
    "message": "Unauthorized access"
}

404 Not Found:
{
    "status": false,
    "message": "Resource not found"
}

422 Validation Error:
{
    "message": "The given data was invalid",
    "errors": {
        "field": [
            "Error message"
        ]
    }
}

500 Server Error:
{
    "status": false,
    "message": "Error message",
    "error": "Detailed error message"
}

## Testing API
1. BUka postman
2. Untuk rute yang diautentikasi, sertakan token Pembawa di header nya (login baru bisa di pakek)
3. Ikuti format body requst/respons sesuai contoh nya
