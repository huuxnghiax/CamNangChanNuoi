<!-- slider -->
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php $i=0; ?>
                    @foreach($slide as $sl)
                        <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" 
                        @if($i == 0)
                            class="active"
                        @endif
                        
                        ></li>
                    <?php $i++; ?>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    <?php $i=0; ?>
                    @foreach($slide as $sl)
                    <div 
                    @if($i == 0)
                        class="item active"
                    @else
                        class="item"
                    @endif

                    >
                    <?php $i++; ?>
                        <img class="slide-image" src="upload/slide/{{$sl->Hinh}}" alt="{{$sl->NoiDung}}">
                    </div>
                    @endforeach
                    
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<br><br>
    <!-- end slide -->