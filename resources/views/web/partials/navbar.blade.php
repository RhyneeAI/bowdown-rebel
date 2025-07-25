		<nav class="fh5co-nav" role="navigation">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-3 col-xs-2">
		                <div id="fh5co-logo"><a href="index.html">Bowdown Rebel</a></div>
		            </div>
		            <div class="col-md-5 col-xs-6 text-center menu-1">
		                <ul>
		                    <li><a href="{{ route('home.index') }}">Home</a></li>
		                    <li><a
		                            href="{{ $role != null ? route($role.'.shop.index') : route('shop.index') }}">Shop</a>
		                    </li>
		                    <li><a href="{{ route('about') }}">About</a></li>
		                </ul>
		            </div>
		            <div class="col-md-4 col-xs-4 text-right hidden-xs menu-2">
		                <ul>
							{{-- <li class="search">
								<div class="input-group">
									<input type="text" placeholder="Search..">
		                            <span class="input-group-btn">
										<button class="btn btn-primary" type="button"><i class="icon-search"></i></button>
		                            </span>
		                        </div>
		                    </li> --}}
							@auth('User')
								<li class="has-dropdown">
		                            <i class="icon-user"></i><a href="{{ route($role.'.profile.index') }}">Profile</a>
		                            <ul class="dropdown">
		                                <li><a href="{{ route($role.'.profile.index') }}">{{ auth('User')->user()->nama }}
		                                    </a></li>
		                                <li class="user">
		                                    <form action="{{ route('logout') }}" method="POST"
		                                        style="display: inline;">
		                                        @csrf
		                                        <button type="submit" class="btn-user"
		                                            style="background: none; border: none; padding: 0; cursor: pointer;">
		                                            Logout
		                                        </button>
		                                    </form>
		                                </li>
		                            </ul>
		                        </li>
								<li class="shopping-cart mt-2">
									<a href="{{ route($role.'.cart.index') }}" class="cart">
										<span><small>{{ GetCartCount(auth('User')->user()->id) }}</small><i class="icon-shopping-cart" style="font-size: 1.3em;"></i></span>
									</a>
								</li>
							@endauth	
							@guest('User')
								<li class="user">
									<a href="{{ route('auth.login') }}" class="btn-user">Login</a>
								</li>
								<li class="shopping-cart">
									<a href="{{ $role != null ? route($role.'.cart.index') : route('cart.index') }}" class="cart">
										<span>
											<small>0</small>
											<i class="icon-shopping-cart"></i>
										</span>
									</a>
								</li>
							@endguest
		                </ul>
		            </div>
		        </div>

		    </div>
		</nav>
