@extends('layouts.userLayout')

@section('title')
    <title>RBG | O nama</title>
@endsection

@section('section_bottom')
    <!--tabs-->
    <div class="section-block">
        <div class="section-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab">O nama</a></li>
                <li role="presentation" ><a href="#whyUs" aria-controls="whyUs" role="tab" data-toggle="tab">Zašto mi?</a></li>
                <li role="presentation"><a href="#questions" aria-controls="updates" role="tab" data-toggle="tab">Najčešća pitanja</a></li>
            </ul>
        </div>
    </div>
    <!--/tabs-->
    <!--tab panes-->
    <div class="section-block">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="about">
                <div class="about-information">
                    <h1 class="section-title">ABOUT LAUNCH</h1>
                    <p>Suspendisse luctus at massa sit amet bibendum. Cras commodo congue urna, vel dictum velit bibendum eget. Vestibulum quis risus euismod, facilisis lorem nec, dapibus leo. Quisque sodales eget dolor iaculis dapibus. Vivamus sit amet lacus ipsum. Nullam varius lobortis neque, et efficitur lacus. Quisque dictum tellus nec mi luctus imperdiet. Morbi vel aliquet velit, accumsan dapibus urna. Cras ligula orci, suscipit id eros non, rhoncus efficitur nisi.</p>
                    <p>Quisque fermentum blandit ex at commodo. Nulla facilisi. Pellentesque porttitor nisi tellus, at gravida mi interdum et. Nulla vestibulum imperdiet libero eget mattis. Vestibulum porttitor, nibh quis sagittis tincidunt, velit orci molestie magna, in congue tortor mauris sit amet eros. Nam dictum gravida tempus.</p>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="questions">
                <div class="update-information">
                    <h1 class="section-title">UPDATES</h1>
                    <!--update items-->
                    <div class="update-post">
                        <h4 class="update-title">We've started shipping!</h4>
                        <span class="update-date">Posted 2 days ago</span>
                        <p>Suspendisse luctus at massa sit amet bibendum. Cras commodo congue urna, vel dictum velit bibendum eget. Vestibulum quis risus euismod, facilisis lorem nec, dapibus leo. Quisque sodales eget dolor iaculis dapibus. Vivamus sit amet lacus ipsum. Nullam varius lobortis neque, et efficitur lacus. Quisque dictum tellus nec mi luctus imperdiet. Morbi vel aliquet velit, accumsan dapibus urna. Cras ligula orci, suscipit id eros non, rhoncus efficitur nisi.</p>
                    </div>
                    <div class="update-post">
                        <h4 class="update-title">Launch begins manufacturing </h4>
                        <span class="update-date">Posted 9 days ago</span>
                        <p>Suspendisse luctus at massa sit amet bibendum. Cras commodo congue urna, vel dictum velit bibendum eget. Vestibulum quis risus euismod, facilisis lorem nec, dapibus leo. Quisque sodales eget dolor iaculis dapibus. Vivamus sit amet lacus ipsum. Nullam varius lobortis neque, et efficitur lacus. Quisque dictum tellus nec mi luctus imperdiet. Morbi vel aliquet velit, accumsan dapibus urna. Cras ligula orci, suscipit id eros non, rhoncus efficitur nisi.</p>
                    </div>
                    <div class="update-post">
                        <h4 class="update-title">Designs have now been finalized</h4>
                        <span class="update-date">Posted 17 days ago</span>
                        <p>Suspendisse luctus at massa sit amet bibendum. Cras commodo congue urna, vel dictum velit bibendum eget. Vestibulum quis risus euismod, facilisis lorem nec, dapibus leo. Quisque sodales eget dolor iaculis dapibus. Vivamus sit amet lacus ipsum. Nullam varius lobortis neque, et efficitur lacus. Quisque dictum tellus nec mi luctus imperdiet. Morbi vel aliquet velit, accumsan dapibus urna. Cras ligula orci, suscipit id eros non, rhoncus efficitur nisi.</p>
                    </div>
                    <!--/update items-->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar_section')
<div class="section-block">
    <div class="window">
        <div class="containerSlider">
            <img class="slider"  src="{{asset('/img/cv1.png')}}">
            <img class="slider"  src="{{asset('/img/profile-img.jpg')}}">

            <img class="slider"  src="{{asset('/img/cv1.png')}}">
        </div>
    </div>
</div>
@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection