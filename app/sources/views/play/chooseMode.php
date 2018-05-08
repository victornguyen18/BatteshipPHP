<div class="container" style="height: 100px; padding: 0;">
    <img src="<?php echo URL; ?>img/surface.gif" style="height: 100px; width: 100%;" alt=""/>
</div>
<div class="container" style="padding: 30px;">
    <div class="title"> CHOOSE MODE</div>
    <div class="row">
        <div class="col-lg-12">
            <a href="/play/chooseMode/classic" class="btn btn-select" id="classic"> CLASSIC</a>
        </div>
        <div class="col-lg-12">
            <a href="/play/chooseMode/advanced" class="btn btn-select" id="advanced"> ADVANCED</a>
        </div>
    </div>
</div>
<script>
    $(function () {
        $("#advanced").click(function () {
            alert("Will be available soon!");
            return false;
        });
    })
</script>