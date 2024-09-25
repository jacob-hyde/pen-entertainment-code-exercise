<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;

class Controller
{
    /**
     * Return a success response.
     *
     * @param Response $response
     * @param array $data
     * @param int $status
     * @return Response
     */
    protected function success(Response $response, array $data = [], int $status = 200): Response
    {
        if (!empty($data)) {
            $data = [
                'data' => $data,
            ];
        }

        $response->getBody()->write(json_encode($data));

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }

    /**
     * Return an error response.
     *
     * @param Response $response
     * @param array $errors
     * @param int $status
     * @return Response
     */
    protected function error(Response $response, array $errors, int $status = 400): Response
    {
        $response->getBody()->write(json_encode([
            'errors' => $errors,
        ]));

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }

    /**
     * Basic validation function.
     *
     * @param array $data
     * @param array $rules
     * @return array
     */
    protected function validate(array $data, array $rules): array
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            if ($rule === 'required' && !isset($data[$field])) {
                $errors[$field] = 'The ' . $field . ' field is required.';
            }
        }

        return $errors;
    }
}