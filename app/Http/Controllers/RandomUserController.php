<?php

namespace App\Http\Controllers;

use App\Http\Requests\FetchUsersRequest;
use App\Services\UserConverterService;
use App\Services\UserService;
use App\Services\XmlConverterService;

class RandomUserController extends Controller
{
    protected $userService;
    protected $converterService;
    protected $xmlConverterService;

    public function __construct(UserService $userService, UserConverterService $converterService, XmlConverterService $xmlConverterService)
    {
        $this->userService = $userService;
        $this->converterService = $converterService;
        $this->xmlConverterService = $xmlConverterService;
    }

    public function fetchUsers(FetchUsersRequest $request)
    {
        $limit = $request->input('count', 10);
        $users = $this->userService->getProcessedUsers($limit);

        $userArrays = $this->converterService->convertMultipleToArray($users);
        $xmlString = $this->xmlConverterService->convertToXml(['user' => $userArrays]);

        return response($xmlString, 200)->header('Content-Type', 'text/xml');
    }
}
