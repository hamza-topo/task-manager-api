## API Task Manager

This repository contains the source code for the API Task Manager. In order to test the API endpoints, you can download the Postman collection file from the `Api-task-manager.postman_collection.json` file in the root directory. Import this file in your Postman app and you will have access to all the API endpoints.

| Endpoint                                  | Description                                                                                                        |
| ----------------------------------------- | ------------------------------------------------------------------------------------------------------------------ |
| POST /login                               | Allows a user to log in to the API by providing their email and password.                                          |
|                                           | **Request parameters:** email, password.                                                                           |
|                                           | **Response:** A JSON object containing a JWT token that can be used to authenticate future requests.            |
| POST /register                            | Allows a user to register for an account on the API by providing their name, email, and password.                  |
|                                           | **Request parameters:** name, email, password.                                                                     |
|                                           | **Response:** A JSON object containing a JWT token that can be used to authenticate future requests.               |
| POST /logout                              | Allows a user to log out of the API and invalidate their current JWT token.                                        |
|                                           | **Request parameters:** None.                                                                                      |
|                                           | **Response:** A JSON object indicating that the user has been logged out.                                          |
| POST /refresh                             | Allows a user to refresh their JWT token, which can be useful if their current token is close to expiring.         |
|                                           | **Request parameters:** None.                                                                                      |
|                                           | **Response:** A JSON object containing a new JWT token that can be used to authenticate future requests.           |
| POST /projects/create                     | Allows a user to create a new project.                                                                             |
|                                           | **Request parameters:** project name.                                                                              |
|                                           | **Response:** A JSON object containing the newly created project.                                                  |
| PUT /projects/{projectId}                 | Allows a user to update an existing project by providing a new project name.                                       |
|                                           | **Request parameters:** project id,name,(status,description:optional).                                             |
|                                           | **Response:** A JSON object indicating whether the project was successfully updated and return the updated object. |
| PATCH /projects/{projectId}               | Same as PUT /projects/{projectId}.                                                                                 |
| DELETE /projects/{projectId}              | Allows a user to delete an existing project.                                                                       |
|                                           | **Request parameters:** Project id.                                                                                |
|                                           | **Response:** A JSON object indicating whether the project was successfully deleted.                               |
| GET /projects/restore/{projectId}         | Allows a user to restore a previously deleted project.                                                             |
|                                           | **Request parameters:** project Id.                                                                                |
|                                           | **Response:** A JSON object indicating whether the project was successfully restored.                              |
| POST /projects/{projectId}/members/add    | Allows a user to add a member to a project.                                                                        |
|                                           | **Request parameters:** list of memebers ids                                                                       |
|                                           | **Response:** A JSON object indicating whether the member(s) was successfully added.                               |
| POST /projects/{projectId}/members/remove | Allows a user to remove a member from a project.                                                                   |
|                                           | **Request parameters:** email address of the member(s) to be removed.                                              |
|                                           | **Response:** A JSON object indicating whether the member was successfully removed.                                |
| GET /projects                             | Retrieves a list of all projects.                                                                                  |
|                                           | **Request parameters:** None.                                                                                      |
|                                           | **Response:** A JSON object containing an array of all projects.                                                   |
| GET /projects/paginate/{perPage}          | Retrieves a paginated list of all projects.                                                                        |
|                                           | **Request parameters:** number of projects to retrieve per page.                                                   |
|                                           | **Response:** A JSON object containing an array of projects on the requested page.                                 |

### Tasks Endpoints

| Endpoint                      | Description                                                                                                        |
| ----------------------------- | ------------------------------------------------------------------------------------------------------------------ |
| POST /tasks/create            | Allows a user to create a new task.                                                                                |
|                               | **Request parameters:** task name, description, status.                                                            |
|                               | **Response:** A JSON object containing the newly created task.                                                     |
| GET /tasks/{taskId}           | Retrieves a single task by ID.                                                                                     |
|                               | **Request parameters:** Task ID.                                                                                   |
|                               | **Response:** A JSON object containing the task data.                                                              |
| PUT /tasks/{taskId}           | Allows a user to update an existing task by providing new data.                                                    |
|                               | **Request parameters:** Task ID, task name, description, status.                                                   |
|                               | **Response:** A JSON object indicating whether the task was successfully updated and returning the updated object. |
| PATCH /tasks/{taskId}         | Same as PUT /tasks/{taskId}.                                                                                       |
| DELETE /tasks/{taskId}        | Allows a user to delete an existing task.                                                                          |
|                               | **Request parameters:** Task ID.                                                                                   |
|                               | **Response:** A JSON object indicating whether the task was successfully deleted.                                  |
| GET /tasks/restore/{taskId}   | Allows a user to restore a previously deleted task.                                                                |
|                               | **Request parameters:** Task ID.                                                                                   |
|                               | **Response:** A JSON object indicating whether the task was successfully restored.                                 |
| GET /tasks                    | Retrieves a list of all tasks.                                                                                     |
|                               | **Request parameters:** None.                                                                                      |
|                               | **Response:** A JSON object containing an array of all tasks.                                                      |
| GET /tasks/paginate/{perPage} | Retrieves a paginated list of all tasks.                                                                           |
|                               | **Request parameters:** number of tasks to retrieve per page.                                                      |
|                               | **Response:** A JSON object containing an array of tasks on the requested page.                                    |
| GET /tasks/status/{status}    | Retrieves a list of tasks by status.                                                                               |
|                               | **Request parameters:** Task status (open, in progress, completed).                                                |
|                               | **Response:** A JSON object containing an array of tasks with the requested status.                                |

### Technical Notes

To secure user authentication, JWT (JSON Web Tokens) was implemented as a method of authentication. In addition, Docker and Postgres were used for the database to ensure efficient and reliable data storage.

To keep the code organized and modular, Enums were used to define constants and improve code readability. Moreover, Observers were utilized to simplify the process of executing code before or after specific events, such as saving or deleting data.

To maintain good coding practices, the business logic was separated into a services namespace. This allows for better code organization and easier maintenance.