</div>
</section>
<!--============================
     DASHBOARD PART END
==============================-->


<!--============================
    SCROLL BUTTON START
==============================-->
<div class="wsus__scroll_btn">
    <i class="fas fa-chevron-up"></i>
</div>
<!--============================
    SCROLL BUTTON  END
==============================-->

@php
$setting=App\Setting::first();
@endphp



<!--bootstrap js-->
<script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
<!--font-awesome js-->
<script src="{{ asset('user/js/Font-Awesome.js') }}"></script>
<!--select2 js-->
<script src="{{ asset('user/js/select2.min.js') }}"></script>
<!--counter js-->
<script src="{{ asset('user/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('user/js/jquery.countup.min.js') }}"></script>
<!--slick js-->
<script src="{{ asset('user/js/slick.min.js') }}"></script>
<!--venobox js-->
<script src="{{ asset('user/js/venobox.min.js') }}"></script>
<!--nice-number js-->
<script src="{{ asset('user/js/jquery.nice-number.min.js') }}"></script>
<!--add row js-->
<script src="{{ asset('user/js/add-row.js') }}"></script>


<script src="{{ asset('user/js/main.js') }}"></script>

<script src="{{ asset('toastr/toastr.min.js') }}"></script>

<script src="{{ asset('backend/iconpicker/fontawesome-iconpicker.min.js') }}"></script>

<script>
    @if(Session::has('messege'))
      var type="{{Session::get('alert-type','info')}}"
      switch(type){
          case 'info':
               toastr.info("{{ Session::get('messege') }}");
               break;
          case 'success':
              toastr.success("{{ Session::get('messege') }}");
              break;
          case 'warning':
             toastr.warning("{{ Session::get('messege') }}");
              break;
          case 'error':
              toastr.error("{{ Session::get('messege') }}");
              break;
      }
    @endif
</script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif



<script>
    (function($) {
    "use strict";
    $(document).ready(function () {
        $('.summernote').summernote();
        $('.custom-icon-picker').iconpicker({
            templates: {
                popover: '<div class="iconpicker-popover popover"><div class="arrow"></div>' +
                    '<div class="popover-title"></div><div class="popover-content"></div></div>',
                footer: '<div class="popover-footer"></div>',
                buttons: '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button>' +
                    ' <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
                search: '<input type="search" class="form-control iconpicker-search" placeholder="Type to filter" />',
                iconpicker: '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
                iconpickerItem: '<a role="button" href="javascript:;" class="iconpicker-item"><i></i></a>'
            }
        })
    });

    })(jQuery);
</script>

</body>

</html>
