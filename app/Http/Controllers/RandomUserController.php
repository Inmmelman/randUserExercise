<?php

namespace App\Http\Controllers;

use App\Http\Requests\FetchUsersRequest;
use App\Services\UserService;
use Spatie\ArrayToXml\ArrayToXml;

class RandomUserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function fetchUsers(FetchUsersRequest $request)
    {
        $limit = $request->input('limit', 10);
        $users = $this->userService->getProcessedUsers($limit);

        $xmlString = ArrayToXml::convert(['user' => $users]);

        return response($xmlString, 200)->header('Content-Type', 'text/xml');
    }
}
