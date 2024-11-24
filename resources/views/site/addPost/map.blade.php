@extends('site.layouts.app_without_header')

@section('content')


    <!--========================== Start add post page ==========================-->
    <section class="add-post-page">
        <div class="container">
            <div>
                <a href="javascript:history.back()">
                    <div><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg></div>
                </a>
                <div><span><h3>@lang('site.choose area')</h3></span></div>

                <div class="map">
                    <label class="mb-3">اضف موقعك علي الخريطة</label>
                    <div id="mapid" style="width: 500px; height: 500px;"></div>
                </div>

                <form action="{{url('/')}}/photo/add/post/{{$cat->id}}/{{$area->id}}" enctype="multipart/form-data" method="GET">
                    <input name="lat" id="lat" value="" style="display:none">
        			<input name="lng" id="lng" value="" style="display:none">
                    <button type="submit" class="button  btn-lg btn-success mt-1">@lang('site.sent post')</button>
                </form>
            </div>


        </div>
    </section>

    <!--========================== End add post page ==========================-->



@endsection

@section('script')

<script>
    function initialize() {
    var e = new google.maps.LatLng(24.701925,46.675415), t = {
      zoom: 5,
      center: e,
      panControl: !0,
      scrollwheel: 1,
      scaleControl: !0,
      overviewMapControl: !0,
      overviewMapControlOptions: {opened: !0},
      mapTypeId: google.maps.MapTypeId.terrain
    };
    map = new google.maps.Map(document.getElementById("mapid"), t), geocoder = new google.maps.Geocoder, marker = new google.maps.Marker({
      position: e,
      map: map
    }), map.streetViewControl = !1, infowindow = new google.maps.InfoWindow({content: "(24.701925,46.675415)"}), google.maps.event.addListener(map, "click", function (e) {
      marker.setPosition(e.latLng);
      var t = e.latLng, o = "(" + t.lat().toFixed(6) + ", " + t.lng().toFixed(6) + ")";
      infowindow.setContent(o),
      document.getElementById("lat").value = t.lat().toFixed(6),
      document.getElementById("lng").value = t.lng().toFixed(6)
    })
  }

</script>
{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwqrlZASdsR2P-KqDBBaGQrVFb7Uom2Uk&language=ar&callback=initialize"></script>--}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK34ZyoH4758BkVP05-GxKP0dSmBi4yTo&language=ar&callback=initialize"></script>

@endsection
