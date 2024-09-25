<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserPointController extends Controller
{
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    private UserRepository $userRepository;
    public function __construct(){
        $this->userRepository = new UserRepository();
    }

    /**
     * Add points to a user.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function earn(Request $request, Response $response, array $args): Response
    {
        $userData = $request->getParsedBody();
        $userId = $args['id'];

        $errors = $this->validate($userData, [
            'points' => 'required',
            'description' => 'required',
        ]);

        if (!empty($errors)) {
            return $this->error($response, $errors, 422);
        }

        $user = $this->userRepository->earn($userId, $userData);
        return $this->success($response, $user);
    }

    /**
     * Redeem points from a user.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function redeem(Request $request, Response $response, array $args): Response
    {
        $userData = $request->getParsedBody();
        $userId = $args['id'];

        $errors = $this->validate($userData, [
            'points' => 'required',
            'description' => 'required',
        ]);

        if (!empty($errors)) {
            return $this->error($response, $errors, 422);
        }

        $user = $this->userRepository->redeem($userId, $userData);
        return $this->success($response, $user);
    }
}