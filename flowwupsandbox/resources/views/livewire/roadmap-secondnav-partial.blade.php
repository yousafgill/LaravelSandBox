<div class="navbar navbar-expand-md navbar-light">
    <div class="layout-boxed" style="box-shadow:none;">
        <div class="text-center d-md-none w-100">
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-navigation">
                <i class="icon-unfold mr-2"></i>
                Navigation
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{url('/roadmap')}}" class="navbar-nav-link">
                        <i class="icon-stack2 mr-2"></i>
                        Roadmap
                    </a>
                </li>



                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="mi-lightbulb-outline mr-2"></i>
                        {{$this->boardname}}
                    </a>

                    <div class="dropdown-menu" style="min-width:350px;">
                        @foreach($boards as $b)
                        <a href="{{route('showboard.public',$b->slug)}}" class="dropdown-item"> {{$b->name}}
                            <span class="badge alpha-slate align-self-center ml-auto">{{$b->totalposts}}</span>
                        </a>
                        @endforeach

                    </div>
                </li>
            </ul>


        </div>
    </div>
</div>