<!DOCTYPE html>
<html lang="en">

<head>
    @include('web.partials.header')
</head>

<body>
    <div class="fh5co-loader"></div>
    <div id="page">
        @include('web.partials.navbar')

        <header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner"
            style="background-image:url(assets/web/images/news.png);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <div class="display-t">
                            <div class="display-tc animate-box" data-animate-effect="fadeIn">
                                <h1>About Us</h1>
                                <h2>Far far away, behind the word mountains</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div id="fh5co-about">
            <div class="container">
                <div class="about-content">
                    <div class="row animate-box">
                        <div class="col-md-6">
                            <div class="desc">
                                <h3>Company History</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse quo est quis mollitia
                                    ratione magni assumenda repellat atque modi temporibus tempore ex. Dolore facilis ex
                                    sunt ea praesentium expedita numquam?</p>
                                <p>Quos quia provident consequuntur culpa facere ratione maxime commodi voluptates id
                                    repellat velit eaque aspernatur expedita. Possimus itaque adipisci rem dolorem
                                    nesciunt perferendis quae amet deserunt eum labore quidem minima.</p>
                            </div>
                            <div class="desc">
                                <h3>Mission &amp; Vission</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse quo est quis mollitia
                                    ratione magni assumenda repellat atque modi temporibus tempore ex. Dolore facilis ex
                                    sunt ea praesentium expedita numquam?</p>
                                <p>Quos quia provident consequuntur culpa facere ratione maxime commodi voluptates id
                                    repellat velit eaque aspernatur expedita. Possimus itaque adipisci rem dolorem
                                    nesciunt perferendis quae amet deserunt eum labore quidem minima.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img class="img-responsive" src="{{ asset('assets') }}/web/images/img_bg_1.png" alt="about">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('web.partials.footer')
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    </div>
</body>

</html>
