<div class="container" style="height: 100px; padding: 0;">
    <img src="<?php echo URL; ?>img/surface.gif" style="height: 100px; width: 100%;" alt="" />
</div>
<?php if(Session::get("result") == 1): ?>
<div class="container">
    <div class="title">YOU WIN</div>
    <img src="<?php echo URL; ?>img/victory.jpg" style="width: 80%;height: auto;" alt=""/>
    <div class="col-lg-12">
        <a href="<?php echo URL; ?>play/battle" class="btn btn-select">PLAY AGAIN</a>
    </div>
</div>
<?php elseif (Session::get("result") == 0): ?>
<div class="container">
    <div class="title">YOU LOSE</div>
    <img src="<?php echo URL; ?>img/sunken2.png" style="width: 80%;height: auto;" alt=""/>
    <div class="col-lg-12">
        <a href="<?php echo URL; ?>play/battle" class="btn btn-select">PLAY AGAIN</a>
    </div>
</div>
<?php endif; ?>
<!--<div class="container">-->
<!--    <div class="title">RESULT</div>-->
<!--    <a class="btn btn-default next" href="#">Continue</a>-->
<!--</div>-->