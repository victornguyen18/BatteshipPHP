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
<div class="container">
    <div class="title">PLACE YOUR SHIPS</div>
    <div class="frame" id="frame">
        <div class="board">
            <div class="location-number"></div>
            <div class="location-number">0</div>
            <div class="location-number">1</div>
            <div class="location-number">2</div>
            <div class="location-number">3</div>
            <div class="location-number">4</div>
            <div class="location-number">5</div>
            <div class="location-number">6</div>
            <div class="location-number">7</div>

            <div class="location-number">0</div>
            <div class="location" id="00" rel="00"></div>
            <div class="location" id="01" rel="01"></div>
            <div class="location" id="02" rel="02"></div>
            <div class="location" id="03" rel="03"></div>
            <div class="location" id="04" rel="04"></div>
            <div class="location" id="05" rel="05"></div>
            <div class="location" id="06" rel="06"></div>
            <div class="location" id="07" rel="07"></div>

            <div class="location-number">1</div>
            <div class="location" id="10" rel="10"></div>
            <div class="location" id="11" rel="11"></div>
            <div class="location" id="12" rel="12"></div>
            <div class="location" id="13" rel="13"></div>
            <div class="location" id="14" rel="14"></div>
            <div class="location" id="15" rel="15"></div>
            <div class="location" id="16" rel="16"></div>
            <div class="location" id="17" rel="17"></div>

            <div class="location-number">2</div>
            <div class="location" id="20" rel="20"></div>
            <div class="location" id="21" rel="21"></div>
            <div class="location" id="22" rel="22"></div>
            <div class="location" id="23" rel="23"></div>
            <div class="location" id="24" rel="24"></div>
            <div class="location" id="25" rel="25"></div>
            <div class="location" id="26" rel="26"></div>
            <div class="location" id="27" rel="27"></div>

            <div class="location-number">3</div>
            <div class="location" id="30" rel="30"></div>
            <div class="location" id="31" rel="31"></div>
            <div class="location" id="32" rel="32"></div>
            <div class="location" id="33" rel="33"></div>
            <div class="location" id="34" rel="34"></div>
            <div class="location" id="35" rel="35"></div>
            <div class="location" id="36" rel="36"></div>
            <div class="location" id="37" rel="37"></div>

            <div class="location-number">4</div>
            <div class="location" id="40" rel="40"></div>
            <div class="location" id="41" rel="41"></div>
            <div class="location" id="42" rel="42"></div>
            <div class="location" id="43" rel="43"></div>
            <div class="location" id="44" rel="44"></div>
            <div class="location" id="45" rel="45"></div>
            <div class="location" id="46" rel="46"></div>
            <div class="location" id="47" rel="47"></div>

            <div class="location-number">5</div>
            <div class="location" id="50" rel="50"></div>
            <div class="location" id="51" rel="51"></div>
            <div class="location" id="52" rel="52"></div>
            <div class="location" id="53" rel="53"></div>
            <div class="location" id="54" rel="54"></div>
            <div class="location" id="55" rel="55"></div>
            <div class="location" id="56" rel="56"></div>
            <div class="location" id="57" rel="57"></div>

            <div class="location-number">6</div>
            <div class="location" id="60" rel="60"></div>
            <div class="location" id="61" rel="61"></div>
            <div class="location" id="62" rel="62"></div>
            <div class="location" id="63" rel="63"></div>
            <div class="location" id="64" rel="64"></div>
            <div class="location" id="65" rel="65"></div>
            <div class="location" id="66" rel="66"></div>
            <div class="location" id="67" rel="67"></div>

            <div class="location-number">7</div>
            <div class="location" id="70" rel="70"></div>
            <div class="location" id="71" rel="71"></div>
            <div class="location" id="72" rel="72"></div>
            <div class="location" id="73" rel="73"></div>
            <div class="location" id="74" rel="74"></div>
            <div class="location" id="75" rel="75"></div>
            <div class="location" id="76" rel="76"></div>
            <div class="location" id="77" rel="77"></div>
        </div>
        <div class="ship-area">
            <div class="row" style="width: 200px;">
                <div class="ship-container">
                    <!--SHIP 2-->
                    <div class="draggable ship-2" id="2A" rel="0">
                        <img src="<?php echo URL; ?>img/ship_01.png" alt=""/>
                    </div>
                    <div class="draggable ship-2" id="2B" rel="0">
                        <img src="<?php echo URL; ?>img/ship_01.png" alt=""/>
                    </div>
                    <div class="draggable ship-2" id="2C" rel="0">
                        <img src="<?php echo URL; ?>img/ship_01.png" alt=""/>
                    </div>
                    <div class="draggable ship-2" id="2D" rel="0">
                        <img src="<?php echo URL; ?>img/ship_01.png" alt=""/>
                    </div>
                </div>
                <div class="ship-container">
                    <!--SHIP 3-->
                    <div class="draggable ship-3" id="3A" rel="0">
                        <img src="<?php echo URL; ?>img/ship_01.png" alt=""/>
                    </div>
                    <div class="draggable ship-3" id="3B" rel="0">
                        <img src="<?php echo URL; ?>img/ship_01.png" alt=""/>
                    </div>
                    <div class="draggable ship-3" id="3C" rel="0">
                        <img src="<?php echo URL; ?>img/ship_01.png" alt=""/>
                    </div>
                </div>
                <div class="ship-container">
                    <!--SHIP 4-->
                    <div class="draggable ship-4" id="4A" rel="0">
                        <img src="<?php echo URL; ?>img/ship_01.png" alt=""/>
                    </div>
                    <div class="draggable ship-4" id="4B" rel="0">
                        <img src="<?php echo URL; ?>img/ship_01.png" alt=""/>
                    </div>
                </div>
                <div class="ship-container">
                    <!--SHIP 5-->
                    <div class="draggable ship-5" id="5A" rel="0">
                        <img src="<?php echo URL; ?>img/ship_01.png" alt=""/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-default btn-lg next continue-btn" href="#">Continue</a>
</div>