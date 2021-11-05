<?php

namespace App\Http\Controllers;

use App\Traits\ApiHelpers;
use App\Traits\GeneralHelpers;
use App\Http\Controllers\Controller;

//?==================================== INFO ====================================¿//

 /**
 * @OA\Info(
 *   title="Inventory",
 *   version="1.0.0",
 * )
 */

 //?==================================== SECURITY ====================================¿//

 /**
 * @OA\SecurityScheme(
 *   type="sanctum",
 *   description="Enter your bearer token in the format <b>Bearer \<token\></b>.",
 *   name="Authorization",
 *   in="header",
 *   securityScheme="bearer"
 * )
 */

 //?==================================== AUTH ====================================¿//

 /**
 * @OA\Post(
 *   path="/login",
 *   summary="Login",
 *   description="Login by username/email and password.",
 *   operationId="authLogin",
 *   tags={"Auth"},
 *   @OA\RequestBody(
 *     required=true,
 *     description="Pass user credentials.",
 *     @OA\JsonContent(
 *       required={"user","password"},
 *       @OA\Property(property="user", type="string", format="user/email", example="user1234/user1234@mail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345")
 *     )
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when login is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/User")
 *     )
 *   ),
 *   @OA\Response(
 *     response=405,
 *     description="Returns when method isn't supported.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="The method isn't supported for this route. Supported method: POST.")
 *     )
 *   ),
 *   @OA\Response(
 *     response=406,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Fail"),
 *       @OA\Property(property="message", type="string", example="Invalid Credentials.")
 *     )
 *   )
 * )
 * @OA\Get(
 *   path="/logout",
 *   summary="Logout",
 *   description="Logout user and invalidate token.",
 *   operationId="authLogout",
 *   tags={"Auth"},
 *   security={{ "bearer": {} }},
 *   @OA\Response(
 *     response=200,
 *     description="Returns when logout is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 **/

 //?==================================== USERS ====================================¿//

 /**
 * @OA\Get(
 *   path="/users",
 *   summary="Get all users.",
 *   description="Get all users.",
 *   operationId="getUsers",
 *   tags={"Users"},
 *   security={{ "bearer": {} }},
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource query is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", example=
 *         {
 *            "current_page" : 1,
 *            "data" : {
 *              {
 *                 "id": 1,
 *                 "firstName": "Earnestine",
 *                 "lastName": "Cummings",
 *                 "username": "tyrell.crist",
 *                 "email": "ewillms@example.org",
 *                 "api_token": null
 *              },
 *              {
 *                 "id": 2,
 *                 "firstName": "Elenora",
 *                 "lastName": "Hoppe",
 *                 "username": "odouglas",
 *                 "email": "herminia.schaefer@example.com",
 *                 "api_token": null
 *              },
 *              {
 *                 "id": 3,
 *                 "firstName": "Urban",
 *                 "lastName": "Effertz",
 *                 "username": "satterfield.aurore",
 *                 "email": "qnitzsche@example.org",
 *                 "api_token": null
 *              },
 *              {
 *                 "id": 4,
 *                 "firstName": "Milton",
 *                 "lastName": "Bogisich",
 *                 "username": "theodora43",
 *                 "email": "okeefe.kiana@example.net",
 *                 "api_token": null
 *              }
 *           },
 *           "first_page_url": "http://server/users?page=1",
 *           "from": 1,
 *           "last_page": 4,
 *           "last_page_url": "http://server/users?page=4",
 *           "links": {
 *             {
 *                "url": null,
 *                "label": "&laquo; Previous",
 *                "active": false
 *             },
 *             {
 *                "url": "http://server/users?page=1",
 *                "label": "1",
 *                "active": true
 *             },
 *             {
 *                "url": "http://server/users?page=2",
 *                "label": "2",
 *                "active": false
 *             },
 *             {
 *                "url": "http://server/users?page=3",
 *                "label": "3",
 *                "active": false
 *             },
 *             {
 *                "url": "http://server/users?page=4",
 *                "label": "4",
 *                "active": false
 *             },
 *             {
 *                "url": "http://server/users?page=2",
 *                "label": "Next &raquo;",
 *                "active": false
 *             }
 *         },
 *         "next_page_url": "http://server/users?page=2",
 *         "path": "http://server/users",
 *         "per_page": 15,
 *         "prev_page_url": null,
 *         "to": 15,
 *         "total": 50
 *       })
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     ),
 *   )
 * )
 * @OA\Get(
 *   path="/users/{id}",
 *   summary="Get single user.",
 *   description="Get single user.",
 *   operationId="getUser",
 *   tags={"Users"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="User id/username/email.",
 *     in="path",
 *     name="id",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource query is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/User")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 * @OA\Post(
 *   path="/users",
 *   summary="Create user.",
 *   description="Create user.",
 *   operationId="createUser",
 *   tags={"Users"},
 *   security={{ "bearer": {} }},
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource creation is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/User")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 * @OA\Put(
 *   path="/users/{id}",
 *   summary="Update user.",
 *   description="Update user.",
 *   operationId="updateUser",
 *   tags={"Users"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="User id/username/email.",
 *     in="path",
 *     name="id",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource update is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/User")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 * @OA\Patch(
 *   path="/users/{id}",
 *   summary="Update user.",
 *   description="Update user.",
 *   operationId="updateUser",
 *   tags={"Users"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="User id/username/email.",
 *     in="path",
 *     name="id",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource query is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/User")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 * @OA\Delete(
 *   path="/users/{id}",
 *   summary="Delete user.",
 *   description="Delete user.",
 *   operationId="deleteUser",
 *   tags={"Users"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="User id/username/email.",
 *     in="path",
 *     name="id",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource query deletion is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/User")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 */

 //?==================================== TASKS ====================================¿//

 /**
 * @OA\Get(
 *   path="/tasks",
 *   summary="Get all tasks.",
 *   description="Get all tasks.",
 *   operationId="getTasks",
 *   tags={"Tasks"},
 *   security={{ "bearer": {} }},
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource query is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", example=
 *         {
 *            "current_page" : 1,
 *            "data" : {
 *              {
 *                 "id": 1,
 *                 "name": "Hallie Padberg IV",
 *                 "description": "Nisi nam est est illum nisi corporis velit. Nobis expedita velit animi debitis eaque. Architecto officiis blanditiis nulla illo. Est consequatur magnam et aliquam eaque a deleniti iure.",
 *                 "user_id": 31
 *              },
 *              {
 *                 "id": 2,
 *                 "name": "Reina Borer",
 *                 "description": "Nihil et cumque tempore tempore consequatur. Placeat minus eum voluptatem ab. Odit est et reprehenderit maxime iure adipisci quae repudiandae.",
 *                 "user_id": 29
 *              },
 *              {
 *                 "id": 3,
 *                 "name": "Terrence Heaney",
 *                 "description": "Nobis mollitia dolores aliquam exercitationem non sed. Non perferendis ab quae voluptatem ullam impedit possimus. Voluptatem et vitae architecto aut aut tenetur et.",
 *                 "user_id": 43
 *              },
 *              {
 *                 "id": 4,
 *                 "name": "Mrs. Alana Heaney IV",
 *                 "description": "Laboriosam sunt maiores consequatur consequatur iure. Placeat asperiores laborum et et nemo vero. Sint molestiae error soluta quisquam culpa labore.",
 *                 "user_id": 33
 *              }
 *           },
 *           "first_page_url": "http://server/tasks?page=1",
 *           "from": 1,
 *           "last_page": 4,
 *           "last_page_url": "http://server/tasks?page=4",
 *           "links": {
 *             {
 *                "url": null,
 *                "label": "&laquo; Previous",
 *                "active": false
 *             },
 *             {
 *                "url": "http://server/tasks?page=1",
 *                "label": "1",
 *                "active": true
 *             },
 *             {
 *                "url": "http://server/tasks?page=2",
 *                "label": "2",
 *                "active": false
 *             },
 *             {
 *                "url": "http://server/tasks?page=3",
 *                "label": "3",
 *                "active": false
 *             },
 *             {
 *                "url": "http://server/tasks?page=4",
 *                "label": "4",
 *                "active": false
 *             },
 *             {
 *                "url": "http://server/tasks?page=2",
 *                "label": "Next &raquo;",
 *                "active": false
 *             }
 *         },
 *         "next_page_url": "http://server/tasks?page=2",
 *         "path": "http://server/tasks",
 *         "per_page": 15,
 *         "prev_page_url": null,
 *         "to": 15,
 *         "total": 50
 *       })
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 * @OA\Get(
 *   path="/tasks/{id}",
 *   summary="Get single task.",
 *   description="Get single task.",
 *   operationId="getTask",
 *   tags={"Tasks"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="Task id",
 *     in="path",
 *     name="id",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource query is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/Task")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 * @OA\Post(
 *   path="/tasks",
 *   summary="Create new task.",
 *   description="Create new task.",
 *   operationId="createTask",
 *   tags={"Tasks"},
 *   security={{ "bearer": {} }},
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource creation is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/Task")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 * @OA\Put(
 *   path="/tasks/{id}",
 *   summary="Update task.",
 *   description="Update task.",
 *   operationId="updateTask",
 *   tags={"Tasks"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="Task id.",
 *     in="path",
 *     name="id",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource update is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/Task")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 * @OA\Patch(
 *   path="/tasks/{id}",
 *   summary="Update task.",
 *   description="Update task.",
 *   operationId="updateTask",
 *   tags={"Tasks"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="Task id.",
 *     in="path",
 *     name="id",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource update is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/Task")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 * @OA\Delete(
 *   path="/tasks/{id}",
 *   summary="Delete task.",
 *   description="Delete task.",
 *   operationId="deleteTask",
 *   tags={"Tasks"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="Task id.",
 *     in="path",
 *     name="id",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource deletion is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/Task")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 */

 //?==================================== USER TASKS ====================================¿//

 /**
 * @OA\Get(
 *   path="/users/{userId}/tasks",
 *   summary="Get all tasks.",
 *   description="Get all tasks for indicated user.",
 *   operationId="getTasks",
 *   tags={"User tasks"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="User id/username/email.",
 *     in="path",
 *     name="userId",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource query is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", example=
 *         {
 *            "current_page" : 1,
 *            "data" : {
 *              {
 *                 "id": 1,
 *                 "name": "Hallie Padberg IV",
 *                 "description": "Nisi nam est est illum nisi corporis velit. Nobis expedita velit animi debitis eaque. Architecto officiis blanditiis nulla illo. Est consequatur magnam et aliquam eaque a deleniti iure.",
 *                 "user_id": 31
 *              },
 *              {
 *                 "id": 2,
 *                 "name": "Reina Borer",
 *                 "description": "Nihil et cumque tempore tempore consequatur. Placeat minus eum voluptatem ab. Odit est et reprehenderit maxime iure adipisci quae repudiandae.",
 *                 "user_id": 29
 *              },
 *              {
 *                 "id": 3,
 *                 "name": "Terrence Heaney",
 *                 "description": "Nobis mollitia dolores aliquam exercitationem non sed. Non perferendis ab quae voluptatem ullam impedit possimus. Voluptatem et vitae architecto aut aut tenetur et.",
 *                 "user_id": 43
 *              },
 *              {
 *                 "id": 4,
 *                 "name": "Mrs. Alana Heaney IV",
 *                 "description": "Laboriosam sunt maiores consequatur consequatur iure. Placeat asperiores laborum et et nemo vero. Sint molestiae error soluta quisquam culpa labore.",
 *                 "user_id": 33
 *              }
 *           },
 *           "first_page_url": "http://server/tasks?page=1",
 *           "from": 1,
 *           "last_page": 4,
 *           "last_page_url": "http://server/tasks?page=4",
 *           "links": {
 *             {
 *                "url": null,
 *                "label": "&laquo; Previous",
 *                "active": false
 *             },
 *             {
 *                "url": "http://server/tasks?page=1",
 *                "label": "1",
 *                "active": true
 *             },
 *             {
 *                "url": "http://server/tasks?page=2",
 *                "label": "2",
 *                "active": false
 *             },
 *             {
 *                "url": "http://server/tasks?page=3",
 *                "label": "3",
 *                "active": false
 *             },
 *             {
 *                "url": "http://server/tasks?page=4",
 *                "label": "4",
 *                "active": false
 *             },
 *             {
 *                "url": "http://server/tasks?page=2",
 *                "label": "Next &raquo;",
 *                "active": false
 *             }
 *         },
 *         "next_page_url": "http://server/tasks?page=2",
 *         "path": "http://server/tasks",
 *         "per_page": 15,
 *         "prev_page_url": null,
 *         "to": 15,
 *         "total": 50
 *       })
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 * @OA\Get(
 *   path="/users/{userId}/tasks/{taskId}",
 *   summary="Get single task.",
 *   description="Get single task for indicated user.",
 *   operationId="getTask",
 *   tags={"User tasks"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="User id/username/email.",
 *     in="path",
 *     name="userId",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Parameter(
 *     description="Task id",
 *     in="path",
 *     name="taskId",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource query is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/Task")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   )
 * )
 * @OA\Post(
 *   path="/users/{userId}/tasks",
 *   summary="Create tasks.",
 *   description="Create new task for indicated user.",
 *   operationId="createTask",
 *   tags={"User tasks"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="User id/username/email.",
 *     in="path",
 *     name="userId",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource creation is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/Task")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   ),
 *   @OA\Response(
 *     response=403,
 *     description="Returns when user is different that logged in. Common at create, update or delete resource from other user different than logged.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Can\'t create tasks for other users.")
 *     )
 *   )
 * )
 * @OA\Put(
 *   path="/users/{userId}/tasks/{taskId}",
 *   summary="Update task.",
 *   description="Update task for indicated user.",
 *   operationId="updateTask",
 *   tags={"User tasks"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="User id/username/email.",
 *     in="path",
 *     name="userId",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Parameter(
 *     description="Task id.",
 *     in="path",
 *     name="taskId",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource update is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/Task")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   ),
 *   @OA\Response(
 *     response=403,
 *     description="Returns when user is different that logged in. Common at create, update or delete resource from other user different than logged.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Can\'t update tasks for other users.")
 *     )
 *   )
 * )
 * @OA\Patch(
 *   path="/users/{userId}/tasks/{taskId}",
 *   summary="Update task.",
 *   description="Update task for indicated user.",
 *   operationId="updateTask",
 *   tags={"User tasks"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="User id/username/email.",
 *     in="path",
 *     name="userId",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Parameter(
 *     description="Task id.",
 *     in="path",
 *     name="taskId",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource update is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/Task")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   ),
 *   @OA\Response(
 *     response=403,
 *     description="Returns when user is different that logged in. Common at create, update or delete resource from other user different than logged.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Can\'t update tasks for other users.")
 *     )
 *   )
 * )
 * @OA\Delete(
 *   path="/users/{userId}/tasks/{taskId}",
 *   summary="Delete task.",
 *   description="Delete task for indicated user.",
 *   operationId="deleteTask",
 *   tags={"User tasks"},
 *   security={{ "bearer": {} }},
 *   @OA\Parameter(
 *     description="User id/username/email.",
 *     in="path",
 *     name="userId",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Parameter(
 *     description="Task id.",
 *     in="path",
 *     name="taskId",
 *     required=true,
 *     @OA\Schema(type="string")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns when resource deletion is success.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="Success"),
 *       @OA\Property(property="data", type="object", ref="#/components/schemas/Task")
 *     )
 *   ),
 *   @OA\Response(
 *     response=401,
 *     description="Returns when user isn't authenticated.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Unauthenticated.")
 *     )
 *   ),
 *   @OA\Response(
 *     response=403,
 *     description="Returns when user is different that logged in. Common at create, update or delete resource from other user different than logged.",
 *     @OA\JsonContent(
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="message", type="string", example="Can\'t delete tasks for other users.")
 *     )
 *   )
 * )
 */



class ApiController extends Controller {

  use GeneralHelpers, ApiHelpers;
}
