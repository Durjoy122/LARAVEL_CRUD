<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Psr\Http\Message\ServerRequestInterface;
use App\Traits\RespondsWithHttpStatus;
use App\Models\NurseCategories;
   
class RegisterController extends \Laravel\Passport\Http\Controllers\AccessTokenController
{
    use RespondsWithHttpStatus;
    public function register(Request $request)
    {
        try {
            $attribute = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'c_password' => 'required|same:password',
                'role' => 'required|in:ADMIN,NURSE,PATIENT',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'country' => 'required',
                'password' => 'required',
                'con_password' => 'required|same:password',
                'status' => 'required',
            ];
            /*if ($request->has('role') && $request->role == 'PATIENT') {
                $attribute['consent_terms'] = 'required|numeric';
                $attribute['medical_treatment_auth'] = 'required|numeric';
                $attribute['concent_privecy'] = 'required|numeric';
            }
            else if($request->has('role') && $request->role == 'NURSE'){
                $attribute['consent_terms'] = 'required|numeric';
                $attribute['category_id'] = 'required|numeric';
                $attribute['concent_privecy'] = 'required|numeric';
                $attribute['concent_background_check'] = 'required|numeric';
            }*/

            $validator = Validator::make($request->all(), $attribute); 

            if ($validator->fails()) return $this->sendError('Validation Error.',  $validator->errors());
            

            $input = $request->all();
            if($request->has('role') && $request->role == 'NURSE'){
                $input['category'] = NurseCategories::find($request->category_id)->name;
            }else{
                $input['category_id'] = 0;
            }
            
            $input['password'] = bcrypt($input['password']);
            $profile_pic_data = $request->file('profile_pic');
            $input['profile_pic'] = '/public/profilePicture/noimage.png';

            if(!empty($profile_pic_data))
            {
                $extension = $profile_pic_data->getClientOriginalExtension();
                $destinationPath = public_path('profilePicture');
                $fileName = 'pic'.rand().'.'.$extension; 
                $profile_pic_data->move($destinationPath,$fileName);
                $input['profile_pic'] = '/public/profilePicture/'.$fileName;
            }
            $user = User::create($input);
            $success['name'] = $user->name;
            return $this->sendResponse($success, "User Created Successfully");
        } 
        catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }
   
    public function login(ServerRequestInterface  $request)
    {
        try {
             // Fetching Email from request
            $Ename = $request->getParsedBody()['Email'];
            echo "Ename $Ename\n";
            // Matching Data With Database tabal by the help of model or Fetching the User
            $user = User::where([
                'email' => $Ename,
            ])->first();
            
            echo "User $user\n";

            
            /*print_r($Ename);
            echo "\n";
            print_r($UName);
            echo "\n";
            print_r($PName);*/
            /*$user = User::where('email', $Ename)->first();
            if (empty($user)) {
                throw new Exception('Email is incorrect.', 401);
            }
            $user = User::where('name', $UName)->first();
            if (empty($user)) {
                throw new Exception('Name is incorrect.', 401);
            }
            $user = User::where('password', $PName)->first();
            if (empty($user)) {
                throw new Exception('Password is incorrect.', 401);
            }*/


            if(empty($user)) throw new Exception('Email is Incorrect.', 401);
            if ($user->status == 0) throw new Exception('Your account is not approved yet', 401);
            
            $tokenResponse = parent::issueToken($request);
            $content = $tokenResponse->getContent();
            $data = json_decode($content, true);
            if(isset($data["error"]))
                throw new Exception('The user credentials were incorrect.', 401);
            $userArray = collect();
            $userArray->put('id', $user->id);
            $userArray->put('role',$user->role);
            if ($user->role == 'NURSE') {
                $userArray->put('category',$user->category);
            }
            $userArray->put('name', $user->name);
            $userArray->put('email', $user->email);
            $userArray->put('phone', $user->phone);
            $userArray->put('status', $user->status);
            $userArray->put('profile_pic', $user->profile_pic);
            $userArray->put('access_token', $data['access_token']);
            $userArray->put('expires_in', $data['expires_in']);
            $userArray->put('refresh_token', $data['refresh_token']);
            return $this->sendResponse(array($userArray), "User logged In");
        }
        catch (Exception  $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }
}