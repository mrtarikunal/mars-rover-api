<?php

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Mars Rover API Documentation",
 *     description="You can create and manage plateaus and rovers with RESTful endpoints.",
 *     termsOfService="http://127.0.0.1:8000/api/v1/terms",
 *     @OA\Contact(email="tarikunal3193@gmail.com"),
 *     @OA\License(name="Apache 2.0", url="http://www.apache.org/licenses/LICENSE-2.0.html")
 * )
 */

/**
 * @OA\Server(
 *     description="Laravel Mars Rover API Stage Server",
 *     url="http://127.0.0.1:8000/"
 * )
 */


/**
 * @OA\ExternalDocumentation(
 *     description="Find out more about Laravel Mars Rover API",
 *     url="https://www.tarikunal.com"
 * )
 */

/**
 * @OA\Schema(
 *     title="Plateau",
 *     description="Plateau model",
 *     type="object",
 *     schema="Plateau",
 *     properties={
 *     @OA\Property(property="id", type="integer", format="int64", description="id column"),
 *     @OA\Property(property="x", type="integer", description="x value of plateau"),
 *     @OA\Property(property="y", type="integer", description="y value of plateau")
 *     },
 *     required={"id", "x", "y"}
 * )
 */

/**
 * @OA\Schema(
 *     title="Rover",
 *     description="Rover model",
 *     type="object",
 *     schema="Rover",
 *     properties={
 *     @OA\Property(property="id", type="integer", format="int64", description="id column"),
 *     @OA\Property(property="plateau_id", type="integer", description="the plateau id which rover is currently in"),
 *     @OA\Property(property="x", type="integer", description="x coordinate of rover"),
 *     @OA\Property(property="y", type="integer", description="y coordinate of rover"),
 *     @OA\Property(property="heading", type="enum", description="current heading of rover")
 *     },
 *     required={"id", "plateau_id", "x", "y", "heading"}
 * )
 */

/**
 * @OA\Tag(
 *     name="plateau",
 *     description="plateau endpoints",
 *     @OA\ExternalDocumentation(
 *     description="find out more",
 *     url="https://www.tarikunal.com"
 *           )
 *       )
 */

/**
 * @OA\Tag(
 *     name="rover",
 *     description="rover endpoints",
 *     @OA\ExternalDocumentation(
 *     description="find out more",
 *     url="https://www.tarikunal.com"
 *           )
 *       )
 */

/**
 * @OA\Post(
 *     path="/api/v1/plateau",
 *     tags={"plateau"},
 *     summary="Create a plateau",
 *     operationId="createPlateau",
 *     @OA\RequestBody(
 *     description="create a plateau",
 *     required=true,
 *     @OA\JsonContent(
 *     type="object",
 *     schema="createPlateau",
 *     properties={
 *     @OA\Property(property="x", type="integer", description="x value of plateau"),
 *     @OA\Property(property="y", type="integer", description="y value of plateau")
 *     },
 *     required={"x", "y"}
 * 
 *     )
 *            ),
 *     @OA\Response(
 *     response=201,
 *     description="Plateau created response",
 *     @OA\Schema(
 *     )
 *           ),
 *     @OA\Response(
 *     response="422",
 *     description="Unprocessable Entity",
 *     @OA\JsonContent()
 *           )
 *        )
 */

/**
 * @OA\Get(
 *     path="/api/v1/plateau/{id}",
 *     tags={"plateau"},
 *     summary="Get plateau info for a specific plateau",
 *     operationId="getPlateau",
 *     @OA\Parameter(
 *     name="id",
 *     in="path",
 *     description="The id of the plateau",
 *     required=true,
 *     @OA\Schema(type="integer", format="int32")
 *            ),
 *     @OA\Response(
 *     response=200,
 *     description="plateau details response",
 *     @OA\JsonContent()
 *           ),
 *     @OA\Response(
 *     response=404,
 *     description="Not found",
 *     @OA\JsonContent()
 *           )
 *        )
 */

/**
 * @OA\Post(
 *     path="/api/v1/rover",
 *     tags={"rover"},
 *     summary="Create a rover",
 *     operationId="createRover",
 *     @OA\RequestBody(
 *     description="create a rover",
 *     required=true,
 *     @OA\JsonContent(
 *     type="object",
 *     schema="createRover",
 *     properties={
 *     @OA\Property(property="plateau_id", type="integer", description="the plateau id which rover is currently in"),
 *     @OA\Property(property="x", type="integer", description="x coordinate of rover"),
 *     @OA\Property(property="y", type="integer", description="y coordinate of rover"),
 *     @OA\Property(property="heading", type="enum", description="current heading of rover")
 *     },
 *     required={"plateau_id","x", "y", "heading"}
 * 
 *     )
 *            ),
 *     @OA\Response(
 *     response=201,
 *     description="Rover created response",
 *     @OA\Schema(ref="#/components/schemas/Rover")
 *           ),
 *     @OA\Response(
 *     response="422",
 *     description="Unprocessable Entity",
 *     @OA\JsonContent()
 *           ),
 *     @OA\Response(
 *     response="404",
 *     description="Not Found",
 *     @OA\JsonContent()
 *           )
 *        )
 */

/**
 * @OA\Get(
 *     path="/api/v1/rover/{id}",
 *     tags={"rover"},
 *     summary="Get rover info for a specific rover",
 *     operationId="getRover",
 *     @OA\Parameter(
 *     name="id",
 *     in="path",
 *     description="The id of the rover",
 *     required=true,
 *     @OA\Schema(type="integer", format="int32")
 *            ),
 *     @OA\Response(
 *     response=200,
 *     description="rover details response",
 *     @OA\JsonContent()
 *           ),
 *     @OA\Response(
 *     response=404,
 *     description="Not Found",
 *     @OA\JsonContent()
 *           )
 *        )
 */

/**
 * @OA\Get(
 *     path="/api/v1/rover-state/{id}",
 *     tags={"rover"},
 *     summary="Get rover state for a specific rover",
 *     operationId="getRoverState",
 *     @OA\Parameter(
 *     name="id",
 *     in="path",
 *     description="The id of the rover",
 *     required=true,
 *     @OA\Schema(type="integer", format="int32")
 *            ),
 *     @OA\Response(
 *     response=200,
 *     description="rover state response",
 *     @OA\JsonContent()
 *           ),
 *     @OA\Response(
 *     response=404,
 *     description="Not Found",
 *     @OA\JsonContent()
 *           )
 *        )
 */

/**
 * @OA\Post(
 *     path="/api/v1/move-rover/{id}",
 *     tags={"rover"},
 *     summary="move a rover",
 *     operationId="moveRover",
 *     @OA\Parameter(
 *     name="id",
 *     in="path",
 *     description="The id of the rover",
 *     required=true,
 *     @OA\Schema(type="integer", format="int32")
 *            ),
 *     @OA\RequestBody(
 *     description="move a rover",
 *     required=true,
 *     @OA\JsonContent(
 *     type="object",
 *     schema="moveRover",
 *     properties={
 *     @OA\Property(property="commands", type="string", description="the commands to move the rover")
 *     },
 *     required={"commands"}
 * 
 *     )
 *            ),
 *     @OA\Response(
 *     response=200,
 *     description="Rover current state response",
 *     @OA\Schema(ref="#/components/schemas/Rover")
 *           ),
 *     @OA\Response(
 *     response="422",
 *     description="Unprocessable Entity",
 *     @OA\JsonContent()
 *           ),
 *     @OA\Response(
 *     response="404",
 *     description="Not Found",
 *     @OA\JsonContent()
 *           )
 *        )
 */
