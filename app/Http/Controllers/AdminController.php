<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{
    PasswordRequest,
    ProfileUpdateRequest,
};
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return $this->renderView('admin.index', [

        ]);
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function adminLogin()
    {
        return view('admin.admin_login');
    }

    public function adminProfile()
    {
        $id = Auth::user()->id;
        $profile_data = User::find($id);
        return view('admin.profile', compact('profile_data'));
    }

    public function adminProfileStore(ProfileUpdateRequest $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        $file = $request->file('photo');
        @unlink(public_path('upload/admin/images').$data->photo);
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload/admin/images'), $filename);
        $data['photo'] = $filename;

        $data->save();

        $notification = array(
            'message' => 'Admin profile has been updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function adminChangePassword()
    {
        $id = Auth::user()->id;
        $profile_data = User::find($id);
        return view('admin.admin_chnage_password', compact('profile_data'));
    }

    public function adminUpdatePassword(PasswordRequest $request)
    {
        // Match the Old Password
        if(!Hash::check($request->old_password, auth::user()->password))
        {
            $notification = array(
                'message' => 'Old message does not match',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        // Update the password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    protected function renderView($view, array $withParams = [])
    {
        $params = [
            'page' => 'Administrator',
            'resource' => 'Administrator',
            'translationFromKey' => 'lang.models.admin.fillable',
            'crud' => [
                'create' => 'javascript:void(0)',
            ],
            'breadcrumbs' => array(
                [
                    'name' => 'Administrator',
                    'route' => 'javascript:void(0)',
                    'active' => true,
                ],
            ),
        ];
        return parent::renderView($view, array_merge($withParams, $params));
    }
}
