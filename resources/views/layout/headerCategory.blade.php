<div class="banner banner2">
	 <div class="container">
		 <div class="headr-right">
		 		<form class="search-box" action="timkiem" method="GET">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input class="search-txt" type="text" name="tukhoa" placeholder="Nhập từ khóa tìm kiếm.......">
					<button class="search-btn" type="submit">
						<i class="fa fa-search"></i>
					</button>
				</form>

				<?php
					use App\TinTuc;

					$dataTinTuc = TinTuc::all();
					$demBaiChuaDuyet = 0;

					foreach($dataTinTuc as $tt){
						if($tt->DuyetBai == 0){
							$demBaiChuaDuyet++;
						}
					}
				?>

				<div class="details">
					<ul>
						@if(Auth::User() != null)
							<li><a href="nguoidung"><i class="glyphicon glyphicon-user"></i> {{Auth::User()->name}}</a></li>
							@if(Auth::User()->quyen == 1)
							<li><a href="admin/tintuc/danhsachduyet"> {{$demBaiChuaDuyet}} tin chờ duyệt</a></li>
							@endif
							<li><a href="dangbaiviet"><i class="fa fa-pencil" aria-hidden="true"></i> Đăng bài viết</a></li>
							<li><a href="dangxuat">Đăng xuất</a></li>
						@else
							<li><a href="dangnhap"><i class="glyphicon glyphicon-user"></i> Đăng nhập</a></li>
							<li><a href="dangky">Đăng ký</a></li>
						
						@endif
					</ul>
			  </div>
		 </div>
		@include('layout.menu')
     </div>	
</div> 
