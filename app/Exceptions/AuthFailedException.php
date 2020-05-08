<?php

namespace App\Exceptions;

use Exception;

class AuthFailedException extends Exception
{
    public function render() {
        return response()->json([
            'message' => 'Ces informations d`identification ne correspondent pas à nos enregistrements.'
        ], 422);
    }
}
