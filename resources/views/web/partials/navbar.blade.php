		<nav class="fh5co-nav" role="navigation">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-3 col-xs-2">
		                <div id="fh5co-logo"><a href="index.html">Bowdown Rebel</a></div>
		            </div>
		            <div class="col-md-5 col-xs-6 text-center menu-1">
		                <ul>
							<li><a href="{{ route('home') }}">Home</a></li>
		                    <li><a href="{{ route('shop') }}">Shop</a></li>

		                    <li class="has-dropdown">
								<a href="services.html">Categories</a>
		                        <ul class="dropdown">
									<li><a href="{{ route('shop') }}">Jaket</a></li>
		                            <li><a href="{{ route('shop') }}">T-Shirt</a></li>
		                            <li><a href="{{ route('shop') }}">Shoes</a></li>
		                            <li><a href="{{ route('shop') }}">Accessories</a></li>
		                        </ul>
		                    </li>
							<li><a href="{{ route('about') }}">About</a></li>
		                </ul>
		            </div>
		            <div class="col-md-4 col-xs-4 text-right hidden-xs menu-2">
		                <ul>
							<li class="search">
								<div class="input-group">
									<input type="text" placeholder="Search..">
		                            <span class="input-group-btn">
										<button class="btn btn-primary" type="button"><i class="icon-search"></i></button>
		                            </span>
		                        </div>
		                    </li>
							<li class="login">
								<a class="btn-login" href="#">Login</a>
							</li>
		                    <li class="shopping-cart"><a href="{{ route('cart') }}" class="cart"><span><small>0</small><i
								class="icon-shopping-cart"></i></span></a></li>
		                </ul>
		            </div>
		        </div>

		    </div>
		</nav>
