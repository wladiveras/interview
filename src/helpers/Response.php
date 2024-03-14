<?php

class Response
{
    public static function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => $data ? 'success' : 'error',
            'data' => $data,
        ]);
    }
}