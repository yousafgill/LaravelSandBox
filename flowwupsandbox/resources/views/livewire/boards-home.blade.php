<div class="card">
    <div class="card-header bg-light header-elements-inline">
        <h5 class="card-title">Feedback Boards</h5>
        <div class="header-elements">
            <ul class="nav nav-pills mb-0">
                <li class="nav-item"><a href="{{url('/dashboard/createboard')}}" class="nav-link active"><i class="icon-stack-plus mr-2"></i> Create feedback board</a></li>
            </ul>
            <div class="list-icons">
                <!-- <a class="list-icons-item" data-action="collapse"></a> -->
                <!-- <a class="list-icons-item" data-action="reload"></a> -->
                <!-- <a class="list-icons-item" data-action="remove"></a> -->
            </div>
        </div>
    </div>

    <div class="card-body p-0">
       
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Board</th>
                    <th>Posts</th>
                    <th>Comments</th>
                    <th>Upvotes</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($boards as $b)
                @if($b->deleted_at!=null)
                <tr class="alpha-warning">
                @else
                <tr>
                @endif
                    <td>{{$b->boardname}}
                        <br>
                        <a href="{{route('showboard.public',$b->slug)}}" target="_blank">View Live <i class="icon icon-new-tab"></i></a>
                    </td>
                    <td>{{$b->totalposts}}
                        <br />
                        <a href="#">2 pending </a>
                    </td>
                    <td>8
                        <br />
                        <a href="#">1 pending </a>
                    </td>
                    <td>
                        {{$b->totalvotes}}
                    </td>
                    @if($b->deleted_at!=null)
                    <td class="text-right">
                        <a href="{{ route('dashboard.boardsetting', $b->id ) }}" class="btn btn-success">Restore</a>
                    </td>
                    @else
                    <td class="text-right">
                        <a href="{{ route('dashboard.boardsetting', $b->id ) }}" class="btn btn-primary">Settings</a>
                        <a href="{{ route('dashboard.posts', $b->id ) }}" class="btn btn-warning">Moderate</a>
                        <a href="{{ route('dashboard.shareboard', $b->id )}}" class="btn btn-info">Share</a>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>

</div>