@extends('layout.index')

@section('content')

<div class="content">
	 <div class="container">
		  <div class="col-md-8 content-left">
			 
			 <div class="games-grids">
					<div class="game-grid-left">
					<?php
						use App\TheLoai;

						$half = TheLoai::skip(0)->take(2)->get();
					?>

						@foreach($half as $tl)

						@if(count($tl->loaitin)>0)
							<?php
								$data = $tl->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(4);
								$tin1= $data->shift();
							?>
						<div class="grid1">
							<h5 class="act"><a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">{{$tl->Ten}}</a></h5>
							@if(isset($tin1))
								<a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html"><img src="Upload/tintuc/{{$tin1['Hinh']}}" class="img-responsive" alt=""/></a>
							
								<div class="grid1-info">
							
								<h4><a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">{{$tin1['TieuDe']}}</a></h4>
								<p>{!! $tin1['TomTat'] !!}</p>	
							@endif							 
							</div>
							<div class="more">
							<a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">Xem thêm</a>
							</div>
						</div>
						@endif
						@endforeach
					 </div>
					 
					 <div class="game-grid-right">
					 <?php
							$half2 = TheLoai::skip(2)->take(2)->get();
						?>
						 @foreach($half2 as $tl)
						 	
							 @if(count($tl->loaitin)>0)
							 		<?php
										$data = $tl->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(5);
										$tin1= $data->shift();
									?>
								<div class="grid3">
									<h5 class="sport"><a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">{{$tl->Ten}}</a></h5>
									@if(isset($tin1))
										<a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html"><img src="Upload/tintuc/{{$tin1['Hinh']}}" class="img-responsive" alt=""/></a>
									
									<div class="grid1-info">
										<h4><a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">{{$tin1['TieuDe']}}</a></h4>
										<p>{!! $tin1['TomTat'] !!}</p>								 
									</div>
									@endif
									<div class="more">
									<a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">Xem thêm</a>
									</div>
								</div>
							 @endif
						 @endforeach
					 </div>
					 <div class="clearfix"></div>
				 </div>
		  </div>
		  <div class="col-md-4 content-right">
			  <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav2" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Tin nổi bật</a></li>
                    <li role="presentation" ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Tin mới</a></li>
                    </ul>
               <!-- Tab panes -->
			   <div class="tab-content">
						<div role="tabpanel" class="tab-pane active re-pad2" id="home">
						<?php
							use App\TinTuc;
							$data = TinTuc::where('NoiBat',1)->take(5)->get();
							
						?>
							@foreach($data as $tt)
								<div class="game1">
									<div class="col-md-3 tab-pic">
										<a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><img src="Upload/tintuc/{{$tt->Hinh}}" alt="/" class="img-responsive"></a>
									</div>
									<div class="col-md-9 tab-pic-info">
									<h4><a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">{{$tt->TieuDe}}</a></h4>
									<p>{!! $tt->TomTat !!}</p>
									</div>
									<div class="clearfix"></div>
								</div>
							@endforeach
							
						</div>
						<div role="tabpanel" class="tab-pane re-pad2" id="profile">

							
							<?php
								$data2 = TinTuc::orderBy('created_at','desc')->take(5)->get();
								use App\Comment;
								$dataComment = Comment::pluck('idTinTuc');
							?>
							@foreach($data2 as $tt)
							<?php
								$demComment = 0;

								foreach($dataComment as $cm){
									if($cm == $tt->id){
										$demComment++;
									}
								}
							?>
							<div class="game-post">
								<div class="col-md-3 tab-pic">
									<a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><img src="Upload/tintuc/{{$tt->Hinh}}" alt="/" class="img-responsive"></a>
								</div>
								<div class="col-md-9 tab-post-info">
								<h4><a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">{{$tt->TieuDe}}</a></h4>
								<p>Posted By <a href="">{{$tt->NguoiDang}}</a> &nbsp;&nbsp; {{$tt->created_at}} &nbsp;&nbsp; <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">Comments ({{$demComment}})</a></p>
								</div>
								<div class="clearfix"></div>
							</div>
							@endforeach
						</div>                  
			 </div>
			 <!---->
			 
			
		  </div>
		  <div class="clearfix"></div>
	 </div>
</div>
@endsection