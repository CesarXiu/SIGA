<?php

namespace App\Http\Controllers;
/**
* @OA\Info(
*             title="API de SIGA", 
*             version="1.0",
*             description="API REST SIGA: Sistema de Gestión de Accesos",
* )
* @OA\PathItem(path="/api")
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Passport Token",
 *     name="Passport JWT",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="apiAuth",
 * )
*/
abstract class Controller
{
    //
}
