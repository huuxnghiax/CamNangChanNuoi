<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;



class UserController extends Controller
{
    //
    public function getDanhsach(){
       $user = User::all();
       return view('admin.user.danhsach',['user'=>$user]);
    }

    public function getThem(){
        return view('admin.user.them');
    }

    public function postThem(Request $request){
        $this->validate($request,
        [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password'=>'required|min:8|max:20',
            'passwordAgain'=>'required|same:password'
        ],
        [
            'name.requied' => 'bạn chưa nhập tên người dùng',
            'name.min' => 'tên người dùng phải tối thiểu 3 ký tự',
            'email.requied' => 'bạn chưa nhập email',
            'email.unique' => 'email đã tồn tại',
            'password.required' => 'bạn chưa nhập password',
            'password.min' => 'password phải tối thiểu 8 đến 20 ký tự',
            'password.max' => 'password phải tối thiểu 8 đến 20 ký tự',
            'passwordAgain.required' => 'bạn chưa nhập lại password',
            'passwordAgain.same' => 'bạn chưa nhập lại đúng password',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = $request->quyen;
        $user->save();

        return redirect('admin/user/them')->with('thongbao','thêm thành công');
    }

    public function getSua($id){
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }


    public function postSua(Request $request, $id){
        $this->validate($request,
        [
            'name' => 'required|min:3',
            
        ],
        [
            'name.requied' => 'bạn chưa nhập tên người dùng',
            'name.min' => 'tên người dùng phải tối thiểu 3 ký tự'
            
        ]);

        $user = User::find($id);
        $user->name = $request->name;

        if($request->changePassword == "on"){

                $this->validate($request,
                [
                
                'password'=>'required|min:8|max:20',
                'passwordAgain'=>'required|same:password'
                 ],
                 [
                
                'password.required' => 'bạn chưa nhập password',
                'password.min' => 'password phải tối thiểu 8 đến 20 ký tự',
                'password.max' => 'password phải tối thiểu 8 đến 20 ký tự',
                'passwordAgain.required' => 'bạn chưa nhập lại password',
                'passwordAgain.same' => 'bạn chưa nhập lại đúng password',
                ]);
                 $user->password = bcrypt($request->password);
        }
        $user->quyen = $request->quyen;
        $user->save();

        return redirect('admin/user/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }
    

    public function getXoa($id){
        $user = User::find($id);
        $user->delete();

        return redirect('admin/user/danhsach')->with('thongbao','Bạn đã xóa thành công');

    }


    public function getDangnhapAdmin(){
        return view('admin.login');
    }
    

    public function postDangnhapAdmin(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|min:3|max:20'
        ],
        [
            'email.required'=>'Bạn chưa đăng nhập email',
            'password.required' => 'bạn chưa nhập password',
            'password.min' => 'password phải tối thiểu 8 đến 20 ký tự',
            'password.max' => 'password phải tối thiểu 8 đến 20 ký tự'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('admin/theloai/danhsach');
        }
        else{
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }

    public function getDangxuatAdmin(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
