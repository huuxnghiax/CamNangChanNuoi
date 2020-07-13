@extends('layout.indexCategory')

@section('content')

<div id="page-wrapper" style="margin-left: 500;">
            <div class="container-fluid" style="margin-left: 500;">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bài viết
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">

                        @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $err)
                                        {{$err}}<br>
                                    @endforeach
                                </div>
                        @endif

                        @if(session('thongbao'))
                                <div class="alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                        @endif
                        <form action="dangbaiviet" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value={{csrf_token()}}>
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    
                                    @foreach($loaitin as $lt)
                                        <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" />
                            </div>
                            
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea id="demo" name="TomTat" class="form-control ckeditor" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" name="NoiDung" class="form-control ckeditor" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="Hinh" class="form-control">
                            </div>
                            
                            <?php
                                $nguoidang = Auth::user()->name;
                            ?>
                            <div class="form-group">
                                <label>Người đăng: </label>
                                <input type="text" id="demo" name="NguoiDang" value="{{$nguoidang}}" disabled>
                            </div>

                            <button type="submit" class="btn btn-default">Đăng bài</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            
            <!-- /.container-fluid -->
</div>


@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#TheLoai").change(function(){
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                   
                    $("#LoaiTin").html(data);
                });
            });
        });
    </script>
@endsection