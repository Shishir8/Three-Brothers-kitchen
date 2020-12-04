<style>
                    @foreach($sliders as $key=>$slider)
                    
                        .owl-carousel .owl-wrapper, .owl-carousel .owl-item:nth-child({{ $key + 1 }}) .item
                        {
                            background: url({{ asset('uploads/slider/'.$slider->image) }});
                            background-size: cover;
                        }
                    @endforeach

                    @foreach($aboutuss as $key=>$aboutus)

                    .about-bg
{
	background: url({{ asset('uploads/aboutus/'.$aboutus->image) }});
	background-repeat: no-repeat;
	background-size: 90%;
  	background-position-x: 15%;
  	background-position-y: 80%;
}
@endforeach
</style>