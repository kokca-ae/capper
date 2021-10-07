<div class="col-lg-3">

    <?php if ($this->admin) : ?>

        <?php require($this->getLayout('a_menu')); ?>

    <?php endif ?>

</div>
</div>

</div>
</div><!-- /.container -->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div id="error" style="z-index:-1;">
    <?php if ($this->error) echo $this->error; ?>
</div>

<script>
    var error = document.querySelector('#error');
    if (error.querySelector('.success, .error') != null) {
		
		$('#error').css("opacity","1").css("z-index","100000");
		
        //error.style.opacity = 1;
        //error.style.zIndex = 1000;
        setTimeout(function(){
            error.style.opacity = 0;
        }, 5000);
        setTimeout(function(){
            error.style.zIndex = -1;
        }, 5500);
    }
</script>





</body>
</html>