<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload/admin/images'), $filename);
        $data['photo'] = $filename;

        $data->save();

        return redirect()->back();
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
