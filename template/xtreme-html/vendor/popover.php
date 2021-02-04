<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <div class="container my-4">

    <p class="font-weight-bold">This simple example shows how to place an image within a bootstrap popover. You can
      define if you want to launch the popover on hover or on click.</p>

    <p><strong>Detailed documentation and more examples of Bootstrap grid you can find in our <a href="https://mdbootstrap.com/docs/jquery/javascript/popovers/"
          target="_blank">Bootstrap Popovers Docs</a>.</p>

    <a class="btn btn-primary" data-toggle="popover-hover" data-img="https://mdbootstrap.com/img/logo/mdb192x192.jpg">Hover
      over me</a>
    <a class="btn btn-indigo" data-toggle="popover-click" data-img="https://mdbootstrap.com/img/Others/documentation/img%20(30)-mini.jpg">Click
      me</a>
    <a class="btn btn-dark-green" data-toggle="popover-hover" data-img="//placehold.it/100x50">Hover over me</a>
    <a class="btn btn-purple" data-toggle="popover-click" data-img="//placehold.it/50x50">Click me</a>

  </div>
  <script>    // popovers initialization - on hover
    $('[data-toggle="popover-hover"]').popover({
      html: true,
      trigger: 'hover',
      placement: 'bottom',
      content: function () { return '<img src="' + $(this).data('img') + '" />'; }
    });

    // popovers initialization - on click
    $('[data-toggle="popover-click"]').popover({
      html: true,
      trigger: 'click',
      placement: 'bottom',
      content: function () { return '<img src="' + $(this).data('img') + '" />'; }
    });</script>