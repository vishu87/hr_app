<?php
class UserController extends BaseController {
    protected $layout = 'layout';
    
    public function login(){
        return View::make('login');
    }

    public function postLogin(){
        $cre=["username"=>Input::get('username'),"password"=>Input::get('password'), "active" => 0];
        $cre2=["email"=>Input::get('username'),"password"=>Input::get('password'), "active" => 0];
        
        $rules=['username'=>'required','password'=>'required'];
        
        $validator=Validator::make($cre,$rules);

        if($validator->passes()){
            $remember_me = Input::has('remember_me')?true:false;
            $flag = false;
            if(Auth::attempt($cre, $remember_me)){
                $flag = true;
            } elseif(Auth::attempt($cre2, $remember_me)){
                $flag = true;
            }

            if($flag){
                $user = User::find(Auth::id());

                if(!$remember_me){    
                    $user->remember_token = '';
                    $user->save();
                }

                if($user->api_token == ''){
                    $api_token = Hash::make(Auth::id().strtotime("now"));
                    $user->api_token = $api_token;
                    $user->save();
                }

                Session::set('api_token', $user->api_token);
                
                $data["success"] = true;
                $data["message"] = "successfully logged in";
                $data["api_token"] = $user->api_token;
                $data["privilege"] = $user->privilege; 
                $data["name"] = $user->name;
                $data["success"] = true;
                
                if($user->privilege == 2){
                    $data["redirect_url"] = url("/");
                } else {
                    $data["redirect_url"] = url("/dashboard");
                }
                
            } else {
                $data["success"] = false;
                $data["message"] = 'Invalid username/email or password';
            }
            
        } else {
            $data["success"] = false;
            $data["message"] = 'Please fill all the required fields';
        }

        return Response::json($data, 200, array());
    }


    public function changePassword(){
        $this->layout->sidebar = View::make('sidebar',["mainsidebar"=>"" , "subsidebar"=>"","sidebar"=>""]);
        $this->layout->main = View::make('profile',[]);
    }

    public function updatePassword(){
    
        $cre = ["oldpwd"=>Input::get('oldpwd'),"newpwd"=>Input::get('newpwd'),"conpwd"=>Input::get('conpwd')];
        $rules = ["oldpwd"=>'required',"newpwd"=>'required|min:5',"conpwd"=>'required'];
        $oldpwd = Hash::make(Input::get('oldpwd'));
        $validator = Validator::make($cre,$rules);
        if ($validator->passes()) { 
            if (Hash::check(Input::get('oldpwd'), Auth::user()->password )) {
                if(Input::get('newpwd') === Input::get('conpwd')){
                    $password = Hash::make(Input::get('newpwd'));
                    $user = User::find(Auth::id());
                    $user->password = $password;
                    $user->check_password = Input::get('newpwd');
                    $user->save();
                    return Redirect::back()->withInput()->with('success', 'Password changed successfully ');
                } else return Redirect::back()->withInput()->with('failure', 'New passwords does not match.');
            } else {
                return Redirect::back()->withInput()->with('failure', 'Old password does not match.');
            }
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        return Redirect::back()->with('failure','Unauthorised Access or Invalid Password')->withErrors($validator)->withInput();
    }

    public function postReset(){
        $credentials = [
            'username' => Input::get('username')
        ];
        $rules = [
            'username' => 'required|email'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
            
            $check = User::where('username',Input::get('username'))->count();
            if($check > 0){
                $user = User::where('username',Input::get('username'))->first();
                $password = str_random(8);
                $user->password = Hash::make($password);
                $user->password_check = $password;
                $user->save();
                
                require app_path().'/classes/PHPMailerAutoload.php';
                $mail = new PHPMailer;
                $mail->isMail();
                $mail->setFrom('info@the-aiff.com', 'All India Football Federation');
                $mail->addAddress(Input::get("username"));
                $mail->isHTML(true);
                $mail->Subject = "AIFF - Password Reset";
                $mail->Body = View::make('mail',["type" => 2, "name" => $user->name, "username"=>$user->username, "password"=>$password]);
                $mail->send();

                return Redirect::Back()->with('success', 'Your Password has been reset. Please check your email');
            } else {
                return Redirect::Back()->with('failure', 'No user found with this email');
            }
        } else {
            return Redirect::Back()->withErrors($validator)->withInput();
        }
    }

    public function postRegister() {
        $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            're_password' => Input::get('re_password'),
            'first_name' => Input::get('first_name'),
            'last_name' => Input::get('last_name'),
            'username' => Input::get('username'),
            'type' => Input::get('type')
        ];
        $rules = [
            'email' => 'required',
            'password' => 'required',
            're_password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'type' => 'required'
        ];
        
        if(Input::get('type') == 3){
            $credentials["company_name"] = Input::get('company_name');
            $rules["company_name"] = 'required';
        }

        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {

            $error = '';
            $flag = true;
            
            if(strcmp(Input::get('password'), Input::get('re_password')) != 0){
                $flag = false;
                $error = "Both passwords do not match";
            }

            if(User::where('email',Input::get('email'))->count() > 0){
                $flag = false;
                $error = 'Duplicate email id';
            }

            if(User::where('username',Input::get('username'))->count() > 0){
                $flag = false;
                $error = 'Duplicate username';
            }


            if($flag){
                
                $user = new User;
                
                $user->first_name = Input::get('first_name');
                $user->last_name = Input::get('last_name');
                $user->username = Input::get('username');
                $user->email = Input::get('email');
                $user->password = Hash::make(Input::get('password'));
                $user->password_check = Input::get('password');
                $user->active = 0;
                $user->privilege = Input::get('type');
                $user->group_id = (Input::has('group_id'))?Input::get('group_id'):'';
                $user->save();

                Auth::loginUsingId($user->id);

                $data["success"] = true;
                $data["redirect_url"] = url("/dashboard");

                $data["message"] = "Thank you for signing up. We have sent an email to your registered email. Please verify your email id";
            } else {
                $data["success"] = false;
                $data["message"] = $error;
            }
        } else {
            $data["success"] = false;
            $data["message"] = "Please fill all the fields";
        }
        return json_encode($data);
    }

    public function updateProfile(){

        $user = User::find(Auth::id());
        if(Input::get('field_name') == 'profile_status'){
            if($user->profile_status < Input::get("value")){
                $user[Input::get('field_name')] = Input::get('value');
            }
        } else {
            $user[Input::get('field_name')] = Input::get('value');
        }
        
        $user->save();

        $data["success"] = false;
        return json_encode($data);

    }

    public function advisorInvestorLogin($user_id){
        $user = User::find('user_id');
        Auth::loginUsingId($user_id);
        return Redirect::to('/investor/home');
    }

    public function investorAdvisorLogin(){
        $user = User::find(Session::get('advisor_id'));
        Auth::loginUsingId($user->id);
        return Redirect::to('/broker/dashboard');
    }
}