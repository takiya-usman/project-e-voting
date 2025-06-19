 <!-- ======= Header ======= -->
 <header id="header" class="fixed-top">
     <div class="container d-flex align-items-center justify-content-between">

         <h1>E-VOTING</a></h1>
         @if (Auth::check())
             <nav id="navbar" class="navbar">
                 <ul>
                     <li><a class="nav-link scrollto" href="#about">Home</a></li>
                     <li><a class="nav-link scrollto" href="#team">Voting</a></li>
                     <li class="dropdown"><a href="#"><span>{{ Auth::guard('web')->user()->name }}</span> <i
                                 class="bi bi-chevron-down"></i></a>
                         <ul>
                             <td>
                                 <a href="{{ route('user.logout') }}"
                                     onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                 <form action="{{ route('user.logout') }}" method="post" class="d-none"
                                     id="logout-form">
                                     @csrf
                                    </form>
                             </td>
                         </ul>
                     </li>

                 </ul>
                 <i class="bi bi-list mobile-nav-toggle"></i>
             </nav><!-- .navbar -->
         @endif
     </div>
 </header>
