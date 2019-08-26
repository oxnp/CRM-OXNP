<!doctype html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- <script src="/js/left-sidebar/main.js"></script>
      <script src="/js/left-sidebar/util.js"></script>>-->
     <link href="/css/left-sidebar.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7dfad927b2.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <div class="col-md-3">
        @yield('left-sidebar')
    </div>
    <div class="col-md-9">
        @yield('content')
    </div>
    </div>

</div>
</body>
<script>
    var list = document.querySelectorAll('.list');

    function accordion(e) {
        e.stopPropagation();
        if (this.classList.contains('active')) {
            this.classList.remove('active');
        } else
        if (this.parentElement.parentElement.classList.contains('active')) {
            this.classList.add('active');
        } else
        {
            for (i = 0; i < list.length; i++) {
                list[i].classList.remove('active');

            }
            this.classList.add('active');
        }
    }
    for (i = 0; i < list.length; i++) {
        list[i].addEventListener('click', accordion);
    }
</script>
</html>