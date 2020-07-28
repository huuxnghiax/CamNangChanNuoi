@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="space20"></div>

            <div class="col-md">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Thống kê</h2>
	            	</div>

                    <?php
                        use App\TinTuc;

                        $demTinTuc = 0;
                        $demTinLon = 0;
                        $demTinGaVit = 0;
                        $demTinChiaSe = 0;

                        //Khai báo tháng
                        $ngayHienTai = date('Y-m-d'); $demBaiTrongNgay = 0;
                        $th1 = date('Y-01-01'); $demth1 = 0;
                        $th2 = date('Y-02-01'); $demth2 = 0;
                        $th3 = date('Y-03-01'); $demth3 = 0;
                        $th4 = date('Y-04-01'); $demth4 = 0;
                        $th5 = date('Y-05-01'); $demth5 = 0;
                        $th6 = date('Y-06-01'); $demth6 = 0;
                        $th7 = date('Y-07-01'); $demth7 = 0;
                        $th8 = date('Y-08-01'); $demth8 = 0;
                        $th9 = date('Y-09-01'); $demth9 = 0;
                        $th10 = date('Y-10-01'); $demth10 = 0;
                        $th11 = date('Y-11-01'); $demth11 = 0;
                        $th12 = date('Y-12-01'); $demth12 = 0;

                        //foreach
                        foreach($tintuc as $tt){
                            $demTinTuc++;

                            if($tt->idLoaiTin == 28 || $tt->idLoaiTin == 29 || $tt->idLoaiTin == 30){
                                $demTinLon++;
                            }elseif($tt->idLoaiTin == 31){
                                $demTinGaVit++;
                            }elseif($tt->idLoaiTin == 32 || $tt->idLoaiTin == 33){
                                $demTinChiaSe++;
                            }
                            
                            //Lấy ngày đăng bằng ngày tạo tin tức
                            //Đặt theo fomat năm tháng ngày
                            $ngayDang = $tt->created_at->format("Y-m-d");
                            
                            if($ngayDang>$th1 && $ngayDang<$th2){$demth1++;};
                            if($ngayDang>$th2 && $ngayDang<$th3){$demth2++;};
                            if($ngayDang>$th3 && $ngayDang<$th4){$demth3++;};
                            if($ngayDang>$th4 && $ngayDang<$th5){$demth4++;};
                            if($ngayDang>$th5 && $ngayDang<$th6){$demth5++;};
                            if($ngayDang>$th6 && $ngayDang<$th7){$demth6++;};
                            if($ngayDang>$th7 && $ngayDang<$th8){$demth7++;};
                            if($ngayDang>$th8 && $ngayDang<$th9){$demth8++;};
                            if($ngayDang>$th9 && $ngayDang<$th10){$demth9++;};
                            if($ngayDang>$th10 && $ngayDang<$th11){$demth10++;};
                            if($ngayDang>$th11 && $ngayDang<$th12){$demth11++;};
                            if($ngayDang>$th12){$demth12++;};

                            if($ngayDang == $ngayHienTai){$demBaiTrongNgay++;};
                        }
                        //endforeach

                        //Đếm số người dùng
                        $demUser = 0;
                        foreach($user as $us){
                            $demUser++;
                        }
                        
                        //Người đăng nhiều tin nhất
                        $mostUploader = TinTuc::max('NguoiDang');

                        
                    ?>

	            	<div class="panel-body">
	            		<!-- item -->
                        <h3><span class="glyphicon glyphicon-align-left"></span> Thống kê bài viết</h3>
                        <br>
                        <div class="break"></div>

					   	<h4><span class= "glyphicon glyphicon-book"></span> Số bài viết</h4>
                        <p>Có {{$demTinTuc}} bài viết.</p>
                        
                        <br>

                        <h4><span class="glyphicon glyphicon-info-sign"></span> Số bài viết về lợn</h4>
                        <p>Có {{$demTinLon}} bài viết.</p>
                        
                        <br>

                        <h4><span class="glyphicon glyphicon-info-sign"></span> Số bài viết về gà vịt</h4>
                        <p>Có {{$demTinGaVit}} bài viết.</p>
                        
                        <br>

                        <h4><span class="glyphicon glyphicon-info-sign"></span> Số bài viết chia sẻ</h4>
                        <p>Có {{$demTinChiaSe}} bài viết.</p>

                        <br><br>

                        <h3><span class="glyphicon glyphicon-align-left"></span> Thống kê người dùng</h3>
                        <br>
                        <div class="break"></div>

                        <h4><span class="glyphicon glyphicon-user"></span> Số người dùng đăng ký</h4>
                        <p>Có {{$demUser}} người dùng.</p>
                        <br>
                        <h4><span class="glyphicon glyphicon-user"></span> Thành viên đăng bài nhiều nhất</h4>
                        <p>{{$mostUploader}}</p>
                        <br><br>
                        
                        <!--Thống kê bài viết theo ngày tháng-->
                        <div>
                            <h3><span class="glyphicon glyphicon-align-left"></span> Thống kê bài viết theo ngày tháng</h3>
                            <br>
                            <div class="break"></div>
                            <h4><span class="glyphicon glyphicon-calendar"></span> Số bài viết trong ngày</h4>
                            <p>Có {{$demBaiTrongNgay}} bài viết.</p>
                            <br>
                            <h4><span class="glyphicon glyphicon-calendar"></span> Tháng 1</h4>
                            <p>Có {{$demth1}} bài viết.</p>
                            <br>
                            <h4><span class="glyphicon glyphicon-calendar"></span> Tháng 2</h4>
                            <p>Có {{$demth2}} bài viết.</p>
                            <br>
                            <h4><span class="glyphicon glyphicon-calendar"></span> Tháng 3</h4>
                            <p>Có {{$demth3}} bài viết.</p>
                            <br>
                            <h4><span class="glyphicon glyphicon-calendar"></span> Tháng 4</h4>
                            <p>Có {{$demth4}} bài viết.</p>
                            <br>
                            <h4><span class="glyphicon glyphicon-calendar"></span> Tháng 5</h4>
                            <p>Có {{$demth5}} bài viết.</p>
                            <br>
                            <h4><span class="glyphicon glyphicon-calendar"></span> Tháng 6</h4>
                            <p>Có {{$demth6}} bài viết.</p>
                            <br>
                            <h4><span class="glyphicon glyphicon-calendar"></span> Tháng 7</h4>
                            <p>Có {{$demth7}} bài viết.</p>
                            <br>
                            <h4><span class="glyphicon glyphicon-calendar"></span> Tháng 8</h4>
                            <p>Có {{$demth8}} bài viết.</p>
                            <br>
                            <h4><span class="glyphicon glyphicon-calendar"></span> Tháng 9</h4>
                            <p>Có {{$demth9}} bài viết.</p>
                            <br>
                            <h4><span class="glyphicon glyphicon-calendar"></span> Tháng 10</h4>
                            <p>Có {{$demth10}} bài viết.</p>
                            <br>
                            <h4><span class="glyphicon glyphicon-calendar"></span> Tháng 11</h4>
                            <p>Có {{$demth11}} bài viết.</p>
                            <br>
                            <h4><span class="glyphicon glyphicon-calendar"></span> Tháng 12</h4>
                            <p>Có {{$demth12}} bài viết.</p>
                        </div>

					</div>
	            </div>
        	</div>
    </div>
    <!-- end Page Content -->

@endsection