@extends('layout.indexCategory')

@section('content')
<!-- Page Content -->
<div class="container">
	<div class="single">
        <div class="content">

			<?php
				function changeColor($str,$q){
					return str_replace($q, "<span style='color=red;'>$q</span>", $str);
				}
			
			
			?>
            <div class="container">
                 <div class="col-md-8 content-left">
                    <div class="panel-heading" style="background-color:#ffdd57; color:black;">
                            <h4><b>Tìm kiếm : {{$tukhoa}}</b></h4>
                    
                    </div>
                    <br>
                  
                    <div class="games-grids">
                            <div class="games-grids">
                                @foreach($tintuc as $tt)
                                <div class="grid1">
                                    <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><img src="Upload/tintuc/{{$tt->Hinh}}" class="img-responsive" alt=""/></a>
                                    <div class="grid1-info">
                                        <h4><a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">{!! changeColor($tt->TieuDe,$tukhoa) !!}</a></h4>
                                        <p>{!! changeColor($tt->TomTat,$tukhoa) !!}</p>								 
                                    </div>
                                    <div class="more">
                                    <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">Xem thêm</a>
                                    </div>
                                </div>
								@endforeach
								<div style="text-align: center;">
								{{ $tintuc->appends(Request::all())->links() }}
                  					
               					</div>         
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
							$data = TinTuc::where('NoiBat',1)->take(3)->get();
							
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
								$data2 = TinTuc::where('NoiBat',1)->take(3)->get();
							?>
							@foreach($data2 as $tt)
							<div class="game-post">
								<div class="col-md-3 tab-pic">
									<a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><img src="Upload/tintuc/{{$tt->Hinh}}" alt="/" class="img-responsive"></a>
								</div>
								<div class="col-md-9 tab-post-info">
								<h4><a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">{{$tt->TieuDe}}</a></h4>
								<p>Posted By <a href="#">{{$tt->NguoiDung}}</a> &nbsp;&nbsp; {{$tt->created_at}} &nbsp;&nbsp; <a href="#">Comments (10)</a></p>
								</div>
								<div class="clearfix"></div>
							</div>
							@endforeach
                        </div> 
                        <div class="clearfix"></div>                 
			 </div>

                 
       
            </div>
       </div>
      
				
	</div>	
</div>
<!-- end Page Content -->

@endsection