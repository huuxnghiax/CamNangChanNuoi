<div class="banner_head_top">
						 
                         <div class="logo">
                             <h1><a href="trangchu">Cẩm nang <span>Chăn nuôi</span></a></h1>
                     </div>	
                          <div class="top-menu">	 
                              <div class="content white">
                                  <nav class="navbar navbar-default">
                                    <div class="navbar-header">
                                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                      </button>				
                                    </div>
                                      <!--/navbar header-->		
                                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                        <ul class="nav navbar-nav">
                                          @foreach($theloai as $tl)
                                            <li class="dropdown">
                                              <a href="#" class="scroll dropdown-toggle" data-toggle="dropdown">{{$tl->Ten}}<b class="caret"></b></a>
                                              <ul class="dropdown-menu">
                                                @foreach($tl->loaitin as $lt)
                                                  <li><a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html">{{$lt->Ten}}</a></li>
                                                @endforeach
                                              </ul>
                                            </li>					
                                          @endforeach
                                        </ul>
                                      </div>
                                       <!--/navbar collapse-->
                                  </nav>
                                   <!--/navbar-->
                              </div>
                                  <div class="clearfix"></div>
                                 <script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
                           </div>
                              <div class="clearfix"></div>
                       </div>
</div>