<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\LoaiTin;
use App\Theloai;
use App\TinTuc;
use App\Comment;

class TinTucController extends Controller
{
    //
    public function getDanhsach(){
       $tintuc = TinTuc::orderBy('id','DESC')->get();
       return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=>$theloai, 'loaitin'=>$loaitin]);
    }

    public function postThem(Request $request){
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
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->DuyetBai = 1;
        $tintuc->SoLuotXem = 0;
        

        if($request->hasFile('Hinh')){
            $file =$request->file('Hinh');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'){
                return redirect('admin/tintuc/them')->with('loi','bạn chỉ có thể chọn file jpg,png,jepg');
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

        return redirect('admin/tintuc/them')->with('thongbao','bạn đã thêm tin thành công');
    }

    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view("admin.tintuc.sua",['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }


    public function postSua(Request $request, $id){
        $tintuc = TinTuc::find($id);
        $this->validate($request,
        [
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3',
            'TomTat'=>'required',
            'NoiDung'=>'required|min:10|max:20000'
        ],
        [
            'LoaiTin.required'=>'Bạn chưa nhập loại tin',
            'TieuDe.required'=>'Bạn chưa nhập Tiêu đề',
            'TieuDe.min'=>'Tiêu đề phải có 3 từ',
            
            'TomTat.required'=>'Bạn chưa nhập tóm tắt',
            'NoiDung.required'=>'Bạn chưa nhập nội dung',
            'NoiDung.min'=>'Nội dung phải có ít nhất 10 từ',
            'NoiDung.max'=>'Nội dung chỉ được khoảng 20000 từ'
        ]);
        
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaitin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->NoiDung = $request->NoiDung;
        

        if($request->hasFile('Hinh')){
            $file =$request->file('Hinh');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'){
                return redirect('admin/tintuc/them')->with('loi','bạn chỉ có thể chọn file jpg,png,jepg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = rand(1, 1000)."_".$name;
            while(file_exists("upload/tintuc".$Hinh)){
                $Hinh = rand(1, 1000)."_".$name;
            }
            

            $file->move("upload/tintuc",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }
        
        
        
        

        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }

    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }

    public function getDuyetdanhsach(){
        $tintuc = TinTuc::where('DuyetBai','0')->get();
       return view('admin.tintuc.Danhsachduyet',['tintuc'=>$tintuc]);
    }

    public function getDuyet($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view("admin.tintuc.duyet",['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postDuyet(Request $request, $id){
        $tintuc = TinTuc::find($id);
        $this->validate($request,
        [
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3',
            'TomTat'=>'required',
            'NoiDung'=>'required|min:10|max:200000'
        ],
        [
            'LoaiTin.required'=>'Bạn chưa nhập loại tin',
            'TieuDe.required'=>'Bạn chưa nhập Tiêu đề',
            'TieuDe.min'=>'Tiêu đề phải có 3 từ',
            
            'TomTat.required'=>'Bạn chưa nhập tóm tắt',
            'NoiDung.required'=>'Bạn chưa nhập nội dung',
            'NoiDung.min'=>'Nội dung phải có ít nhất 10 từ',
            'NoiDung.max'=>'Nội dung chỉ được khoảng 20000 từ'
        ]);
        
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaitin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->DuyetBai = $request->DuyetBai;
        $tintuc->NguoiDuyet = Auth::user()->name;

        if($request->hasFile('Hinh')){
            $file =$request->file('Hinh');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'){
                return redirect('admin/tintuc/them')->with('loi','bạn chỉ có thể chọn file jpg,png,jepg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = rand(1, 1000)."_".$name;
            while(file_exists("upload/tintuc".$Hinh)){
                $Hinh = rand(1, 1000)."_".$name;
            }
            

            $file->move("upload/tintuc",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }
        
        
        
        

        $tintuc->save();
        return redirect('admin/tintuc/duyet/'.$id)->with('thongbao','Bạn đã duyệt bài thành công');
    }
}
