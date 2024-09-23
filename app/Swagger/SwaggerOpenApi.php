<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Tuning Factory API Documentation',
    contact: new OA\Contact('Tuning Factory', 'https://tuningfactory.nl', 'info@tuningfactory.nl'),
)]
#[OA\SecurityScheme(
    securityScheme: 'api_token',
    type: 'http',
    description: 'Enter `Bearer` [space] and then your token in the input below',
    name: 'Authorization',
    in: 'header',
    bearerFormat: 'key',
    scheme: 'bearer',
)]
class SwaggerOpenApi {}

#[OA\Get(
    '/api/makes',
    security: [
        ['api_token' => []],
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'OK',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'data',
                        type: 'array',
                        items: new OA\Items(
                            ref: '#/components/schemas/Make'
                        )
                    ),
                ],
                type: 'object'
            )
        ),
        new OA\Response(response: 401, description: 'Unauthorized'),
        new OA\Response(response: 404, description: 'Not Found'),
        new OA\Response(
            response: 429,
            description: 'This error occurs when you either exceed the rate limit, or when you exceed the maximum number of requests allowed in your account',
        ),
        new OA\Response(response: 500, description: 'Internal Server Error'),
    ],
)]
class SwaggerMakesGetAllMakesRoute {}

#[OA\Get(
    '/api/makes/{make}/models',
    security: [
        ['api_token' => []],
    ],
    parameters: [
        new OA\Parameter(
            name: 'make',
            description: 'The ID of the make',
            in: 'path',
            required: true,
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'OK',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'data',
                        type: 'array',
                        items: new OA\Items(
                            ref: '#/components/schemas/MakeModel'
                        )
                    ),
                ],
                type: 'object'
            )
        ),
        new OA\Response(response: 401, description: 'Unauthorized'),
        new OA\Response(response: 404, description: 'Not Found'),
        new OA\Response(
            response: 429,
            description: 'This error occurs when you either exceed the rate limit, or when you exceed the maximum number of requests allowed in your account',
        ),
        new OA\Response(response: 500, description: 'Internal Server Error'),
    ],
)]
class SwaggerMakeModelsGetModelByMakeRoute {}

#[OA\Get(
    '/api/models/{model}/generations',
    security: [
        ['api_token' => []],
    ],
    parameters: [
        new OA\Parameter(
            name: 'model',
            description: 'The ID of model',
            in: 'path',
            required: true,
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'OK',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'data',
                        type: 'array',
                        items: new OA\Items(
                            ref: '#/components/schemas/Generation'
                        )
                    ),
                ],
                type: 'object'
            )
        ),
        new OA\Response(response: 401, description: 'Unauthorized'),
        new OA\Response(response: 404, description: 'Not Found'),
        new OA\Response(
            response: 429,
            description: 'This error occurs when you either exceed the rate limit, or when you exceed the maximum number of requests allowed in your account',
        ),
        new OA\Response(response: 500, description: 'Internal Server Error'),
    ],
)]
class SwaggerGenerationsGetGenerationByModelRoute {}

#[OA\Get(
    '/api/generations/{generation}/engines',
    security: [
        ['api_token' => []],
    ],
    parameters: [
        new OA\Parameter(
            name: 'generation',
            description: 'The ID of the generation',
            in: 'path',
            required: true,
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'OK',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'data',
                        properties: [
                            new OA\Property(property: 'id', type: 'string', format: 'uuid'),
                            new OA\Property(property: 'name', type: 'string'),
                            new OA\Property(property: 'fuel_type', type: 'enum', enum: \App\Enums\FuelType::class),
                        ],
                    ),
                ],
                type: 'object'
            )
        ),
        new OA\Response(response: 401, description: 'Unauthorized'),
        new OA\Response(response: 404, description: 'Not Found'),
        new OA\Response(
            response: 429,
            description: 'This error occurs when you either exceed the rate limit, or when you exceed the maximum number of requests allowed in your account',
        ),
        new OA\Response(response: 500, description: 'Internal Server Error'),
    ],
)]
class SwaggerEnginesGetEngineByGenerationRoute {}

#[OA\Get(
    '/api/engines/{engine}',
    security: [
        ['api_token' => []],
    ],
    parameters: [
        new OA\Parameter(
            name: 'engine',
            description: 'The ID of the engine',
            in: 'path',
            required: true,
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'OK',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'data',
                        type: 'array',
                        items: new OA\Items(
                            ref: '#/components/schemas/Engine'
                        )
                    ),
                ],
                type: 'object'
            )
        ),
        new OA\Response(response: 401, description: 'Unauthorized'),
        new OA\Response(response: 404, description: 'Not Found'),
        new OA\Response(
            response: 429,
            description: 'This error occurs when you either exceed the rate limit, or when you exceed the maximum number of requests allowed in your account',
        ),
        new OA\Response(response: 500, description: 'Internal Server Error'),
    ],
)]
class SwaggerEnginesGetEngineRoute {}
