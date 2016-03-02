<!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->

{!! Html::script('assets/js/vendor/jquery-2.1.3.min.js') !!}
<!-- Bootstrap.js, Jquery plugins and Custom JS code -->
{!! Html::script('//code.jquery.com/ui/1.11.4/jquery-ui.js') !!}

{!! Html::script('assets/js/vendor/bootstrap.min.js') !!}
{!! Html::script('assets/js/app.min.js') !!}
{!! Html::script('assets/js/plugins.js') !!}
{!! Html::script('assets/js/jquery.timepicker.js') !!}
{!! Html::script('assets/js/jquery.datepair.min.js') !!}

{!! Html::script('//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js') !!}

{!! Html::script('assets/js/admin.js') !!}
{!! Html::script('/assets/js/services/AppServices.js') !!}

<script type="text/javascript">
	AppServices.init();
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74638003-1', 'auto');
  ga('send', 'pageview');

</script>



