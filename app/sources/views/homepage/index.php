
<section id="pslideshow" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#pslideshow" data-slide-to="0" class="active"></li>
        <li data-target="#pslideshow" data-slide-to="1"></li>
        <li data-target="#pslideshow" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="<?php echo URL; ?>img/slideshow_1.jpg" height="445px">
            <div class="carousel-caption">
                <div class="pizza-logo">
                    <p><img src="<?php echo URL; ?>img/bomb.png"/></p>
                    <p style="font-size: 30px; margin: 20px;">NEW FEATURE</p>
                    <a href="" class="btn btn-danger">PLAY NOW</a>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo URL; ?>img/slideshow_2.jpg" height="445px">
            <div class="carousel-caption">
                <div class="pizza-logo">
                    <p><img src="<?php echo URL; ?>img/radar.png"/></p>
                    <p style="font-size: 30px; margin: 20px;">NEW FEATURE</p>
                    <a href="" class="btn btn-danger">BUY NOW</a>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo URL; ?>img/slideshow_3.jpg" height="445px">
            <div class="carousel-caption">
                <div class="pizza-logo">
                    <p><img src="<?php echo URL; ?>img/bomb.png"/></p>
                    <p style="font-size: 30px; margin: 20px;">NEW FEATURE</p>
                    <a href="" class="btn btn-danger">TRY IT OUT</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#pslideshow" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#pslideshow" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</section>

<div class="container" style="padding: 30px;">
    <div class="row">
        <div class="col-lg-12">
            <a href="play/chooseMode" class="btn btn-select"> PLAY</a>
        </div>
    </div>
</div>
