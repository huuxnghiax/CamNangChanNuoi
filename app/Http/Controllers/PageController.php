<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\User;

class PageController extends Controller
{
    //
    function __construct()
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        view()->share('theloai',$theloai);
        view()->share('loaitin',$loaitin);

        
    }

    function trangchu(){
        return view('pages.trangchu');
    }

    function lienhe(){
        return view('pages.lienhe');
    }

    function loaitin($id){

        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->where('DuyetBai',1)->paginate(3);
        
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
        
    }

    function tintuc($id){
        $tintuc = TinTuc::find($id);
        return view('pages.tintuc',['tintuc'=>$tintuc]);
    }

    function getDangnhap(){
        return view('pages.dangnhap');
    }

    function postDangnhap(Request $request){
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
            return redirect('trangchu');
        }
        else{
            return redirect('dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
        
    }

    function getDangxuat(){
        Auth::logout();
        return redirect('trangchu');
    }

    function getNguoidung(){
        $user = Auth::user();
        return view('pages.nguoidung',['nguoidung'=>$user]);
    }

    function postNguoidung(Request $request){
        $this->validate($request,
        [
            'name' => 'required|min:3',
            
        ],
        [
            'name.requied' => 'bạn chưa nhập tên người dùng',
            'name.min' => 'tên người dùng phải tối thiểu 3 ký tự'
            
        ]);

        $user = Auth::user();
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
       
        $user->save();

        return redirect('nguoidung')->with('thongbao','Bạn đã sửa thành công');
    }


    function getDangky(){
        return view('pages.dangky');
    }

    function postDangky(Request $request){
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
        $user->quyen = 0;
        $user->save();

        return redirect('dangnhap')->with('thongbao','Chúc mừng bạn đã đăng ký thành công');
    }

    function getDangbaiviet(){
        $user = Auth::user();
        if(Auth::check()){
            $theloai = TheLoai::all();
            $loaitin = LoaiTin::all();
            return view('pages.dangbaiviet',['theloai'=>$theloai, 'loaitin'=>$loaitin]);
        }
    }

    function postDangbaiviet(Request $request){
        $this->validate($request,
        [
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required|min:10|max:20000'
        ],
        [
            'LoaiTin.required'=>'Bạn chưa nhập loại tin',
            'TieuDe.required'=>'Bạn chưa nhập Tiêu đề',
            'TieuDe.min'=>'Tiêu đề phải có 3 từ',
            'TieuDe.unique'=>'Tiêu đề đã tồn tại',
            'TomTat.required'=>'Bạn chưa nhập tóm tắt',
            'NoiDung.required'=>'Bạn chưa nhập nội dung',
            'NoiDung.min'=>'Nội dung phải có ít nhất 10 từ',
            'NoiDung.max'=>'Nội dung chỉ được khoảng 20000 từ'
        ]);
        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaitin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = 0;
        $tintuc->DuyetBai = 0;
        $tintuc->SoLuotXem = 0;
        
        $tintuc->NguoiDang = Auth::user()->name;


        if($request->hasFile('Hinh')){
            $file =$request->file('Hinh');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'){
                return redirect('dangbaiviet')->with('loi','bạn chỉ có thể chọn file jpg,png,jepg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = rand(1, 1000)."_".$name;
            while(file_exists("upload/tintuc".$Hinh)){
                $Hinh = rand(1, 1000)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
        }
        else{
            $tintuc->Hinh = "";
        }
       

        $tintuc->save();

        return redirect('dangbaiviet')->with('thongbao','bạn đã thêm tin thành công, hãy đợi admin phê duyệt');
    }

    function Timkiem(Request $request){
        $tukhoa=$request->get('tukhoa');
        $tintuc = TinTuc::where('TieuDe','like','%'.$tukhoa.'%')->orWhere('TomTat','like','%'.$tukhoa.'%')->orWhere('NoiDung','like','%'.$tukhoa.'%')->orWhere('NguoiDang','like','%'.$tukhoa.'%')->orWhere('created_at','like','%'.$tukhoa.'%')->paginate(5);
        return view('pages.timkiem',['tukhoa'=>$tukhoa,'tintuc'=>$tintuc]);

    }
}
