<?php

    namespace App\Http\Controllers\Api;

    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use App\Http\Controllers\Controller;

    class UserController extends Controller
    {
        /**
         * Get valid account types.
         *
         * @return json
         */
        public function getAccountTypes()
        {
            return $this->sendResponse(200, 'success', 'Account types resolved!', [
                    'account_types' => \AppHelper::get('account_types'),
                ]);
        }

        /**
         * Get valid account types.
         *
         * @return json
         */
        public function authenticate()
        {
            $validator = Validator::make(request()->all(), [
                'email'         => ['required', 'string', 'email'],
                'password'      => ['required', 'string'],
            ]);
            // $credentials = $request->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt(['email' => request('email'), 'password' => request('password'), 'status' => 'active'])):
                    return $this->sendResponse(400, 'error', 'User does not exist!', [
                        'error' => 'invalid_credentials',
                    ]);
                endif;
            } catch (JWTException $e) {
                return $this->sendResponse(500, 'error', 'User does not exist!', [
                        'error' => 'could_not_create_token',
                ]);
            }

            return $this->sendResponse(200, 'success', 'User exists!', [
                'user'  => User::where('email', request('email'))->first(),
                'token' => $token
            ]);
        }

        /**
         * Register new user.
         *
         * @return json
         */
        public function register()
        {
            $validator = Validator::make(request()->all(), [
                'first_name'    => ['required', 'string', 'max:255'],
                'last_name'     => ['required', 'string', 'max:255'],
                'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'      => ['required', 'string', 'confirmed'],
                'account_type'  => 'required'
            ]);

            if ($validator->fails()):
                return $this->sendResponse(400, 'error', 'Field validation error!', [
                    $validator->errors()
                ]);
            endif;

            $user = User::create([
                'account_type'  => request('account_type'),
                'first_name'    => request('first_name'),
                'last_name'     => request('last_name'),
                'email'         => request('email'),
                'password'      => Hash::make(request('password')),
            ]);

            $token = JWTAuth::fromUser($user);

            return $this->sendResponse(201, 'success', 'User created!', [
                'token' => $token,
                'user'  => $user
            ]);
        }

        /**
         * Get authenticated user.
         *
         * @return json
         */
        public function getAuthenticatedUser()
        {
            try {
                if (!$user = JWTAuth::parseToken()->authenticate()):
                    return $this->sendResponse(404, 'error', 'User not resolved!', [
                        'error'  => 'user_not_found'
                    ]);
                endif;
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return response()->json(['token_expired'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return response()->json(['token_invalid'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json(['token_absent'], $e->getStatusCode());
            }

            return $this->sendResponse(200, 'success', 'User resolved!', [
                'user'  => $user
            ]);
        }

        /**
         * Edit user.
         *
         * @return json
         */
        public function editUser()
        {
            $validator = Validator::make(request()->all(), [
                'first_name'    => 'required',
                'last_name'     => 'required'
            ]);

            if ($validator->fails()):
                return $this->sendResponse(400, 'error', 'Field validation error!', [
                    $validator->errors()
                ]);
            endif;

            $user = JWTAuth::parseToken()->authenticate();

            if (request('old_password') != null && request('change_password') == true):
                if (Hash::check(request('old_password'), $user->password)):
                    if (request('new_password') === request('password_confirmation')):

                        User::whereId($user->id)->update([
                            'password'  => Hash::make(request('new_password'))
                         ]);
                    else: 
                        return $this->sendResponse(400, 'error', 'Password Mismatch!');
                    endif;
                else:
                    return $this->sendResponse(400, 'error', 'Invalid password!');
                endif;
            endif;

            User::whereId($user->id)->update([
                'first_name' => request('first_name'),
                'last_name'  => request('last_name')
            ]);

            return $this->sendResponse(200, 'success', 'Profile updated!', [
                'user' => User::whereId($user->id)->first(),
            ]);
        }

        /**
         * Delete user.
         *
         * @return json
         */
        public function deleteUser(User $user_id)
        {
            if (!$user_id)
                return $this->sendResponse(400, 'error', 'Invalid user!');

            User::whereId($user_id->id)->update([
                'status' => 'inactive',
            ]);

            return $this->sendResponse(200, 'success', 'User deleted!');
        }

        /**
         * Send response.
         * @param int $statusCode
         * @param string $message
         * @param string $responseType
         * @param mixed $response
         * @return json
         */
        public function sendResponse(int $statusCode, string $message, string $responseType, $response=null)
        {
            return response()->json([
                'statusCode'    => $statusCode,
                'message'       => $message,
                'responseType'  => $responseType,
                'response'      => $response,
            ]);
        }
    }