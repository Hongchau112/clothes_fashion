<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function loginPost(Request $request){
        $credentials = $request->only('name', 'password');
        $user = Admin::where('name', $request->name)->first();
        if (Auth::guard('admin')->attempt($credentials)) {
            if ($user->status == 0)
            {
                return view('admin.login');
            }else{
                return redirect()->route('admin.index');
            }
        }else{
            return view('admin.login');
        }

    }

    public function index()
    {
        $user = Auth::guard('admin')->user();
        $userList = Admin::all();
        return view('admin.users.index', compact('user'), compact('userList'));
    }

    public function create()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.users.create', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $validated_data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'new_password' => 'required|confirmed',
            'phone' => 'required'

        ]);

        $validated_data['password'] = Hash::make($request->new_password);
        $user = new Admin();
        $user->name = $validated_data['name'];
        $user->email = $validated_data['email'];
        $user->password = $validated_data['password'];
        $user->phone = $validated_data['phone'];
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Tạo tài khoản thành công!');
    }

    public function show($id)
    {
        $user = Auth::guard('admin')->user();
        $userList = Admin::all();
        $user_show = Admin::find($id);
        return view('admin.users.show', ['user' => $user_show]);
    }

    public function edit($id)
    {
        $user = Auth::guard('admin')->user();
        $user_list = Admin::all();
        $user = Admin::find($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::guard('admin')->user();
        {
            $validated_data = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:admins',
                'phone' => 'nullable'
            ]);

            $user = Admin::find($id);
            $user->name = $validated_data['name'];
            $user->email = $validated_data['email'];
            $user->phone = $validated_data['phone'];
            $user->save();

            return redirect()->route('admin.index')->with('success', 'Sửa thông tin tài khoản thành công!');
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
    public function changePassword(Request $request) {
        $user = Auth::guard('admin')->user();
        $userPassword = $user->password; //pass cũ

        $request->validate([
            'password' => 'required',
            'newPassword' => 'required|same:password_confirm|min:6',
            'password_confirm' => 'required',

        ]);
        if(!Hash::check($request->password,$userPassword)){
            return back()->withErrors(['current_password'=>'password not match']);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();
        return redirect()->route('admin.user.show', ['user' => $user])->with('success', 'Thay đổi password thành công!');
    }
    public function block($id)
    {
        $user = Auth::guard('admin')->user();
        $userList = Admin::all();
        $user_lock = Admin::find($id);

        if ($user_lock->status == 0)
        {
            $user_lock->status = 1;
        }else
            {
                $user_lock->status = 0;
            }
        $user_lock->save();
        return view('admin.users.index', compact('user'), compact('userList'));
    }

}
