
# Task Management

A Task Management Dashboard is a web application that allows users to efficiently manage and organize tasks. The dashboard typically includes features for creating, updating, retrieving specific details, and deleting tasks. Below is a brief description of each section along with notifications using Vue.js for the frontend and Laravel for the backend.

### Create Task:
Users can easily create new tasks using a user-friendly interface. The dashboard provides a form with fields such as title, description, and status. After entering the required information, users can submit the form. Upon successful creation, a notification appears, confirming the addition of the new task.

### Update Task:
The dashboard allows users to modify existing tasks. By selecting a task from the list, users can access a form with pre-filled information. After making the necessary updates and saving the changes, a notification is displayed, indicating that the task has been successfully updated.

### Get Specific Task:
Users can view detailed information about a specific task by selecting it from the list. This action redirects them to a dedicated page or a modal displaying the task's title, description, status, and other relevant details. In this section as well, notifications can be utilized to confirm the retrieval of task details.

### Delete Task:
To remove a task, users can choose the delete option associated with each task. Upon confirmation, the task is deleted from the system. A notification promptly informs the user that the task has been successfully deleted.

### Notifications:

#### Success Notification:  
Displayed when a task is successfully created, updated, retrieved, or deleted. It provides positive feedback to the user.

#### Error Notification: 
Appears when an operation encounters an error. For instance, if there are validation issues during task creation or if there's an error while retrieving or deleting a task.

Implementing these features involves integrating Vue.js for the frontend to handle dynamic and responsive user interactions. Laravel, as the backend framework, manages data storage, retrieval, and updates. Additionally, Laravel can send appropriate responses to Vue.js, triggering notifications based on the success or failure of the operations.

By combining the strengths of Vue.js and Laravel, you create a seamless and efficient Task Management Dashboard that enhances user productivity and organization.


## Tech Stack

**Client:** VueJs, Store, TailwindCSS

**Server:** Laravel , webpack.mix.js

**Database:** Mysql

**Repository:** GitHub


## Deployment

First get clone using below url

```bash
  git clone https://
```
Now Run 

```bash
  cd task-manager
```

Run below command to install laravel dependencies

```bash
  composer update
```
Then
```bash
  php artisan key:generate
```
Database migration
```bash
  php artisan migrate
```
Add dummy data
```bash
  php artisan db:seed --class=TaskSeeder
```

Run server
```bash
  php artisan serve
```

Run Unit Test Case

```bash
  php artisan test
```

Run below command to install vueJs dependencies

```bash
  npm install
```

Run below commands 

Development purpose
```bash
  npm run dev
```
watch purpose

```bash
  npm run watch
```
Production purpose
```bash
  npm run prod
```
clear node_modules
```bash
  npm run clear
```

## API Reference

#### Get all tasks

```http
  GET /api/tasks
```

#### Store new task

```http
  POST /api/tasks
```

| Body | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `Title`      | `string` | **Required**.|
| `Description`      | `string` | **Required**.|
| `Status`      | `string` | **Required**.|


#### Update existing task

```http
  PUT /api/tasks/{exit_task_id}
```

| Body | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `Title`      | `string` | **Required**.|
| `Description`      | `string` | **Required**.|
| `Status`      | `string` | **Required**.|

#### Get detail of existing task

```http
  GET /api/tasks/{exit_task_id}
```

#### Delete existing task

```http
  Delete /api/tasks/{exit_task_id}
```

#### add(num1, num2)

Takes two numbers and returns the sum.


## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`APP_NAME=Laravel`

`APP_ENV=local`

`APP_KEY=base64:omIlYCSC8sBuErJzylZHNgj71bcyY1IHHSI1j+0IocY=`

`APP_DEBUG=true`

`APP_URL=http://localhost`


`DB_CONNECTION=mysql`

`DB_HOST=127.0.0.1`

`DB_PORT=3306`

`DB_DATABASE=task_manager`

`DB_USERNAME=root`

`DB_PASSWORD=root`