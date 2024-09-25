<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
class UserController extends Controller
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
     * Get all users.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function index(Request $request, Response $response, array $args): Response
    {
        return $this->success($response, $this->userRepository->getAll());
    }

    /**
     * Create new user.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function store(Request $request, Response $response, array $args): Response
    {
        $userData = $request->getParsedBody();
        $errors = $this->validate($userData, [
            'name' => 'required',
            'email' => 'required',
        ]);

        if (!empty($errors)) {
            return $this->error($response, $errors, 422);
        }

        $user = $this->userRepository->create($userData);
        return $this->success($response, $user, 201);
    }

    /**
     * Delete a user.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function destroy(Request $request, Response $response, array $args): Response
    {
        $userId = $args['id'];
        $this->userRepository->delete($userId);
        return $this->success($response);
    }
}