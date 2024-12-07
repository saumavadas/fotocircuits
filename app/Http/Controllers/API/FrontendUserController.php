<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FrontendUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FrontendUserController extends Controller
{
    // Register new user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|max:15|unique:frontend_users',
            'user_type' => 'required|in:seller,customer',
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(10);

        $user = FrontendUser::create([
            'phone' => $request->phone,
            'otp' => $otp,
            'otp_expires_at' => $expiresAt,
            'user_type' => $request->user_type,
        ]);

        $this->sendOtp($user->phone, $otp);


        return response()->json(['message' => 'OTP sent successfully', 'FEUser' => $user->id], 200);
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'u_id' => 'required|exists:frontend_users,id',
            'otp' => 'required|string',
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = FrontendUser::find( $request->u_id );

        if (!$user || $user->otpExpired()) 
        {
            $user = FrontendUser::findOrFail($u_id);
            $user->delete();
            return response()->json(['error' => 'Expired OTP Please try again'], 401);
        } 

        if (!$user || $user->otp !== $request->otp) 
        {
            // $user->otp = null;
            // $user->otp_expires_at =  now();
            // $user->status = "otp non-verified";
            // $user->save();

            return response()->json(['error' => 'Invalid OTP'], 401);
        }        
        else
        {
            $user->otp = null;
            $user->otp_expires_at =  now();
            $user->status = "active";
            $user->save();

            // Generate a Sanctum token
            $token = $user->createToken('frontend_user_token')->plainTextToken;

            return response()->json(['message' => 'OTP verified', 'token' => $token, 'user' => $user->id], 200);        
        }        
    }

    // API frontEnd login 
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|max:15',
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = FrontendUser::where('phone', $request->phone)->first();
        $token = $user->createToken('frontend_user_token')->plainTextToken;
        return response()->json(['message' => 'Login successful', 'token' => $token, 'user' => $user->id], 200);
    }    

    private function sendOtp($phoneNumber, $otp)
    {
        $accountSid = env('TWILIO_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_PHONE_NUMBER');

        $url = "https://api.twilio.com/2010-04-01/Accounts/$accountSid/Messages.json";
        $data = [
            'To' => $phoneNumber,        // Recipient's phone number
            'From' => $twilioNumber,       // Your Twilio phone number
            'Body' =>  env('TWILIO_MSG_TEXT'). ': '. $otp // SMS body
        ];


        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_USERPWD, "$accountSid:$authToken");
        
        $response = curl_exec($ch);

        if (curl_errno($ch)) 
        {
            \Log::info( 'Error:' . curl_error($ch));
        } 
        else
        {
            \Log::info( 'Response:' . $response);
        }
    }

    public function updateProfile(Request $request, $id)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(),[
             'name' => 'nullable|string|max:255',
             'email' => 'nullable|email|max:255|unique:frontend_users,email,' . $id,            
             'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);
        // Find the seller by ID
        $FEuser = FrontendUser::find($id);

        if (!$FEuser) 
        {
            return response()->json(['message' => 'Userler not found'], 404);
        }

        // Update the seller's profile
        $FEuser->name = $request->input('name', $FEuser->name);
        $FEuser->email = $request->input('email', $FEuser->email);
        
        if ($request->hasFile('profile_image')) 
        {
            // Delete the old profile image if it exists
            if ($FEuser->profile_image && Storage::exists($FEuser->profile_image)) {
                Storage::delete($FEuser->profile_image);
            }

            // Store the new image
            $path = $request->file('profile_image')->store('profile_images');
            $FEuser->profile_image = $path;
        }

        // Save changes
        $FEuser->save();

        return response()->json([
            'message' => 'User profile updated successfully',
            'FEuser' => $FEuser,
        ]);
    }
    
    public function viewProfile($id)
    {
        $FEuser = FrontendUser::find($id);
        
        if (!$FEuser) 
        {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json([
            'message' => 'View User profile ',
            'FEuser' => $FEuser,
        ]);
        
    }    


}
