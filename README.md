| Endpoint                              | Description                                                                                      |
|---------------------------------------|--------------------------------------------------------------------------------------------------|
| POST /login                           | Allows a user to log in to the API by providing their email and password.                        |
|                                       | **Request parameters:** email, password.                                                        |
|                                       | **Response:** A JSON object containing a JWT token that can be used to authenticate future requests.
{
    "status": "success",
    "user": {
        "id": 1,
        "name": "Member 1",
        "email": "xxxxxx@gmail.com",
        "email_verified_at": null,
        "created_at": "2023-02-26T18:18:18.000000Z",
        "updated_at": "2023-02-26T18:18:18.000000Z"
    },
    "authorisation": {
        "token": "xxxxxxxxxxxxxxxxxxxxxxxxxJodHRwOi8vMTI3LjAxxxxxxxxxxxxxx",
        "type": "bearer"
    }
}
 |
| POST /register                        | Allows a user to register for an account on the API by providing their name, email, and password. |
|                                       | **Request parameters:** name, email, password.                                                   |
|                                       | **Response:** A JSON object containing a JWT token that can be used to authenticate future requests. |
| POST /logout                          | Allows a user to log out of the API and invalidate their current JWT token.                      |
|                                       | **Request parameters:** None.                                                                    |
|                                       | **Response:** A JSON object indicating that the user has been logged out.                       |
| POST /refresh                         | Allows a user to refresh their JWT token, which can be useful if their current token is close to expiring. |
|                                       | **Request parameters:** None.                                                                    |
|                                       | **Response:** A JSON object containing a new JWT token that can be used to authenticate future requests. |
| POST /projects/create                 | Allows a user to create a new project.                                                           |
|                                       | **Request parameters:** project name.                                                            |
|                                       | **Response:** A JSON object containing the ID of the newly created project.                      |
| PUT /projects/{projectId}             | Allows a user to update an existing project by providing a new project name.                      |
|                                       | **Request parameters:** project name.                                                            |
|                                       | **Response:** A JSON object indicating whether the project was successfully updated.            |
| PATCH /projects/{projectId}           | Same as PUT /projects/{projectId}.                                                               |
| DELETE /projects/{projectId}          | Allows a user to delete an existing project.                                                     |
|                                       | **Request parameters:** None.                                                                    |
|                                       | **Response:** A JSON object indicating whether the project was successfully deleted.             |
| GET /projects/restore/{projectId}     | Allows a user to restore a previously deleted project.                                           |
|                                       | **Request parameters:** None.                                                                    |
|                                       | **Response:** A JSON object indicating whether the project was successfully restored.            |
| POST /projects/{projectId}/members/add | Allows a user to add a member to a project.                                                       |
|                                       | **Request parameters:** email address of the member to be added.                                 |
|                                       | **Response:** A JSON object indicating whether the member was successfully added.               |
| POST /projects/{projectId}/members/remove | Allows a user to remove a member from a project.                                                |
|                                          | **Request parameters:** email address of the member to be removed.                              |
|                                          | **Response:** A JSON object indicating whether the member was successfully removed.            |
| GET /projects                         | Retrieves a list of all projects.                                                                 |
|                                       | **Request parameters:** None.                                                                    |
|                                       | **Response:** A JSON object containing an array of all projects.                                 |
| GET /projects/paginate/{perPage}      | Retrieves a paginated list of all projects.                                                      |
|                                       | **Request parameters:** number of projects to retrieve per page.                                 |
|                                       | **Response:** A JSON object containing an array of projects on the requested page.              |
| POST /tasks/create                     | Allows a user to create a new task.                                                              |
|                                       | **Request parameters:** task name, project ID.                                                   |
|                                       | **Response:**
