@extends('layout.indexCategory')

@section('content')
<!-- Page Content -->
<div class="container">
				<div class="single">
					<div class="blog-to">		
					
						<img class="img-responsive sin-on" src="Upload/tintuc/{{$tintuc->Hinh}}" alt="" />
							<div class="blog-top">
							<div class="blog-left">
								<span>{{$tintuc->created_at}}</span>
								<span>&nbsp; Đăng bởi {{$tintuc->NguoiDang}}</span>
							</div>
							<div class="top-blog">

								<b><a class="fast" href="#">{{$tintuc->TieuDe}}</a></b>
								<p class="sed">{!! $tintuc->TomTat !!}</p>
								<br>
									 <p>{!! $tintuc->NoiDung !!}</p>
							

						<div class="clearfix"> </div>
							</div>
							<div class="clearfix"> </div>
					</div>
					</div>
						
					
				
		<div class="single-middle">

		<h3>Comments</h3>
			@foreach($tintuc->comment as $cm)
		
			
				<div class="media">
				  <div class="media-left">
					<a href="#">
					  <img class="media-object" src="images/co.png" alt="">
					</a>
				  </div>
				  <div class="media-body">
					<h4 class="media-heading"><a href="#">{{$cm->user->name}}</a>&nbsp;<small>{{$cm->created_at}}</small></h4>
						<p>{{$cm->NoiDung}}</p>
				  </div>
				</div>
			@endforeach
			
		</div>
		<!---->
		@if(Auth::User() != null)
		<div class="single-bottom">
		
			<h3>Viết bình luận</h3>
				<form action="comment/{{$tintuc->id}}" method="post">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="col-md-4 comment">
						<input type="text" value="{{Auth::User()->name}}" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='{{Auth::User()->name}}';}" disabled>
						</div>
						<div class="col-md-4 comment">
						<input type="text" value="{{Auth::User()->email}}" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='{{Auth::User()->email}}';}" disabled>
						</div>
						
						<div class="clearfix"> </div>
						<textarea cols="77" rows="6" name="NoiDung" value=" " onfocus="this.value='';" onblur="if (this.value == '') {this.value = 'Bình luận.....';}">Bình luận.....</textarea>
						
							<input type="submit" value="Send" >
						
				</form>
			</div>
		</div>
		@endif
</div>

<!-- end Page Content -->

@endsection