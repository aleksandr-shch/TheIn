<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends ApiController
{
    /**
     * @var Model|Builder|object|null
     */
    protected $client;

    /**
     * AuthController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->client = DB::table('oauth_clients')
            ->where(['password_client' => 1])
            ->first();
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function authenticate(Request $request)
    {
        $request->request->add(
            [
                'username' => $request->get('email'),
                'password' => $request->get('password'),
                'grant_type' => 'password',
                'client_id' => $this->client->id,
                'client_secret' => $this->client->secret,
            ]
        );

        $proxy = Request::create('oauth/token', 'POST');

        return app()->handle($proxy);
    }
}
