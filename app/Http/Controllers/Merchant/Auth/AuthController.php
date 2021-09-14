<?php

namespace App\Http\Controllers\Merchant\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Merchant\Auth\RegisterRequest;
use App\Http\Requests\Merchant\Auth\LoginRequest;
use App\Http\Resources\User as UserResource;

use Validator;
use App\Models\User;
use App\Models\Store;
use App\Constants\UserTypes;
use JWTAuth;
use Hash;

class AuthController extends Controller
{

    /**
    * [Register]
    * @param  Request $request [name,email,password,name_store(stores)]
    * api_url: api/merchant/register  [method:post]
    * route  : auth.register
    * @return [json]           [user data]
    */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        try {
            // Create Store
            $store = Store::create([
                'name' => $data['store_name']
            ]);

            //Create Merchant User
            $data['type']     = 1;
            $data['store_id'] = $store->id;
            $user = User::create($data);
            return sendResponse(trans('message.add_success'),new UserResource($user));
        } catch (\Exception $e) {
            throw new \Exception("Not Expected Error");
        }

    }


      /**
      * [login]
      * @param  Request $request [email,password]
      * api_url: api/merchant/login  [method:post]
      * route  : auth.login
      * @return [json]           [user data with token]
      */
      public function login(LoginRequest $request)
      {
          // attempt to verify the credentials and create a token for the user
          $user = User::where('email', $request->email)->first();
          if (!$user) {
              return sendError(trans('auth.invalid_email')); // Email Not Found
          }
          if (!Hash::check($request->get('password'), $user->password)) {
              return sendError(trans('auth.invalid_password')); // Invalid Password
          }
          //Add link and token to user data
          $user->setAppends([]);
          $token = JWTAuth::fromUser($user);
          $user['token'] = $token;
          // all good so return the token
          return sendResponse(trans('auth.login_success'),$user);
      }


}
