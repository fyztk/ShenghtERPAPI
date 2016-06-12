<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use JWTAuth;

class BaseController extends Controller
{
    // 接口帮助调用
    use Helpers;

    // 请求
    protected $request;

    // 分页数
    protected $perPage;
    
    // 登录用户id
    protected $userId;
    protected $userInfo;

    // 返回错误的请求
    protected function errorBadRequest($message = '')
    {
        return $this->response->array($message)->setStatusCode(400);
    }

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->perPage = $request->get('per_page');
        if($this->request->get('token'))
        {
            try {

                if (! $user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
                }

            } catch (TokenExpiredException $e) {

                return response()->json(['token_expired'], $e->getStatusCode());

            } catch (TokenInvalidException $e) {

                return response()->json(['token_invalid'], $e->getStatusCode());

            } catch (JWTException $e) {

                return response()->json(['token_absent'], $e->getStatusCode());

            }

            // the token is valid and we have found the user via the sub claim
            $this->userId=compact('user')['user']['id'];
            $this->userInfo=compact('user')['user'];
        }
    }
}
