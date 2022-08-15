@php
    $footer_contact=App\ContactUs::first();
    $setting=App\Setting::first();
    $contactInfo=App\ContactInformation::first();
    $footer_banner=App\BannerImage::find(22);
    $navigations=App\Navigation::all();
    $websiteLang=App\ManageText::all();
@endphp



@if ($setting->live_chat==1)
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='{{ $setting->livechat_script }}';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>

@endif


@php
    $modalConsent=App\ModalConsent::first();

@endphp

@if ($modalConsent->status==1)
<script src="{{ asset('user/js/cookieconsent.min.js') }}"></script>

<script>
window.addEventListener("load",function(){window.wpcc.init({"border":"{{ $modalConsent->border }}","corners":"{{ $modalConsent->corners }}","colors":{"popup":{"background":"{{ $modalConsent->background_color }}","text":"{{ $modalConsent->text_color }} !important","border":"{{ $modalConsent->border_color }}"},"button":{"background":"{{ $modalConsent->btn_bg_color }}","text":"{{ $modalConsent->btn_text_color }}"}},"content":{"href":"{{ route('privacy-policy') }}","message":"{{ $modalConsent->message }}","link":"{{ $modalConsent->link_text }}","button":"{{ $modalConsent->btn_text }}"}})});
</script>
@endif


    <!--============================
          FOOTER PART END
    ==============================-->
    <footer style="background-image:url({{ url($footer_banner->image) }})">
        <div class="wsus__footer_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-md-12 col-lg-4">
                        <div class="wsus__footer_text">
                            <a class="wsus__footerlogo" href="{{ route('home') }}"><img src="{{ url($setting->logo) }}" alt=""></a>

                            <p>{{ $contactInfo->about }}</p>
                            <form id="subscribeForm">
                                <input type="email" placeholder="Email *" name="email">
                                <button id="subscribeBtn" class="common_btn_2" type="submit"> <i id="subscribe-spinner" class="loading-icon fa fa-spin fa-spinner d-none"></i> {{ $websiteLang->where('lang_key','subscribe')->first()->custom_text }}</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-3 col-lg-2">
                        <div class="wsus__footer_text">
                            <h5>{{ $websiteLang->where('lang_key','short_link')->first()->custom_text }}</h5>
                            <ul class="wsus__short_link">
                                @php
                                    $about_menu=$navigations->where('id',4)->first();
                                @endphp
                                @if ($about_menu->status==1)
                                <li><a href="{{ route('about.us') }}">{{ $about_menu->navbar }}</a></li>
                                @endif
                                @php
                                    $all_property_menu=$navigations->where('id',3)->first();
                                @endphp
                                @if ($all_property_menu->status==1)
                                <li><a href="{{ route('properties',['page_type' => 'list_view']) }}">{{ $all_property_menu->navbar }}</a></li>
                                @endif

                                @php
                                    $blog_menu=$navigations->where('id',7)->first();
                                @endphp
                                @if ($blog_menu->status==1)
                                <li class="nav-item">
                                    <li><a href="{{ route('blog') }}">{{ $blog_menu->navbar }}</a></li>
                                </li>
                                @endif

                                @php
                                    $pricing_menu=$navigations->where('id',5)->first();
                                @endphp
                                @if ($pricing_menu->status==1)
                                    <li><a href="{{ route('pricing.plan') }}">{{ $pricing_menu->navbar }}</a></li>
                                @endif



                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-lg-2">
                        <div class="wsus__footer_text">
                            <h5>{{ $websiteLang->where('lang_key','help_link')->first()->custom_text }}</h5>
                            <ul class="wsus__short_link">
                                @php
                                    $terms_and_condition=$navigations->where('id',15)->first();
                                @endphp
                                @if ($terms_and_condition->status==1)
                                <li><a href="{{ route('terms-and-conditions') }}">{{ $terms_and_condition->navbar }}</a></li>
                                @endif

                                @php
                                    $privacy_policy=$navigations->where('id',16)->first();
                                @endphp
                                @if ($privacy_policy->status==1)
                                <li><a href="{{ route('privacy-policy') }}">{{ $privacy_policy->navbar }}</a></li>
                                @endif


                                @php
                                    $faq_menu=$navigations->where('id',17)->first();
                                @endphp
                                @if ($faq_menu->status==1)
                                <li><a href="{{ route('faq') }}">{{ $faq_menu->navbar }}</a></li>
                                @endif

                                @php
                                    $contact_menu=$navigations->where('id',8)->first();
                                @endphp
                                @if ($contact_menu->status==1)
                                <li class="nav-item">
                                    <li><a href="{{ route('contact.us') }}">{{ $contact_menu->navbar }}</a></li>
                                </li>
                                @endif


                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-5 col-lg-4">
                        <div class="wsus__footer_text">
                            <h5>{{ $websiteLang->where('lang_key','follow_us')->first()->custom_text }}</h5>

                            <ul class="wsus__social_link">
                                @if ($footer_contact->facebook)
                                    <li><a href="{{ $footer_contact->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if ($footer_contact->twitter)
                                <li><a href="{{ $footer_contact->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                @endif
                                @if ($footer_contact->linkedin)
                                <li><a href="{{ $footer_contact->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                @endif
                                @if ($footer_contact->instagram)
                                <li><a href="{{ $footer_contact->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                @endif
                                @if ($footer_contact->youtube)
                                <li><a href="{{ $footer_contact->youtube }}"><i class="fab fa-youtube"></i></a></li>
                                @endif

                            </ul>

                            <div class="wsus__footer_address">
                                <p><i class="fal fa-map-marker-alt"></i> {!! nl2br(e($footer_contact->footer_address)) !!}</p>
                                <a href="javascript:;"><i class="fal fa-phone-alt"></i>{!! nl2br(e($footer_contact->footer_phone)) !!}</a>
                                <p><i class="fal fa-envelope"></i>{!! nl2br(e($footer_contact->footer_email)) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wsus_copywrite">
                <p>{{ $contactInfo->copyright }}</p>
            </div>
        </div>
    </footer>
    <!--============================
          FOOTER PART END
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
    <!--imageuploadify js-->
    <script src="{{ asset('user/js/imageuploadify.min.js') }}"></script>
    <!--add row js-->
    <script src="{{ asset('user/js/add-row.js') }}"></script>



    <script src="{{ asset('user/js/main.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>

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
            $("#subscribeBtn").on('click',function(e) {
                e.preventDefault();
                // project demo mode check
                var isDemo="{{ env('PROJECT_MODE') }}"
                var demoNotify="{{ env('NOTIFY_TEXT') }}"
                if(isDemo==0){
                    toastr.error(demoNotify);
                    return;
                }
                // end

                $("#subscribe-spinner").removeClass('d-none')
                $("#subscribeBtn").addClass('custom-opacity')
                $("#subscribeBtn").removeClass('common_btn_2')
                $("#subscribeBtn").attr('disabled',true);

                $.ajax({
                    url: "{{ route('subscribe-us') }}",
                    type:"get",
                    data:$('#subscribeForm').serialize(),
                    success:function(response){
                        if(response.success){
                            $("#subscribeForm").trigger("reset");
                            toastr.success(response.success)

                            $("#subscribe-spinner").addClass('d-none')
                            $("#subscribeBtn").removeClass('custom-opacity')
                            $("#subscribeBtn").addClass('common_btn_2')
                            $("#subscribeBtn").attr('disabled',false);

                        }
                        if(response.error){
                            toastr.error(response.error)
                            $("#subscribeForm").trigger("reset");
                            $("#subscribe-spinner").addClass('d-none')
                            $("#subscribeBtn").removeClass('custom-opacity')
                            $("#subscribeBtn").addClass('common_btn_2')
                            $("#subscribeBtn").attr('disabled',false);
                        }
                    },
                    error:function(response){
                        if(response.responseJSON.errors.email){

                            toastr.error(response.responseJSON.errors.email[0])

                            $("#subscribe-spinner").addClass('d-none')
                            $("#subscribeBtn").removeClass('custom-opacity')
                            $("#subscribeBtn").addClass('common_btn_2')
                            $("#subscribeBtn").attr('disabled',false);

                        }
                    }

                });


            })



        });

        })(jQuery);
    </script>


</body>

</html>
