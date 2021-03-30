<div class="card">
    <div class="card-header bg-light header-elements-inline">
        <h5 class="card-title">Share your feedback boards</h5>
        <div class="header-elements">
            <ul class="nav nav-pills mb-0">
                <li class="nav-item"><a href="{{url('/dashboard/boards')}}" class="nav-link active"><i class="icon-stack mr-2"></i> Feedback boards</a></li>
            </ul>
            <div class="list-icons">
           
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="form-group">
            <label class="control-label">This is the public link to your feedback board: </label>
            <div class="input-group">
                <input type="text" wire:model="boardslug" class="form-control" placeholder="https://">
                <span class="input-group-append">
                    <button class="btn btn-light" type="button">Copy</button>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Share your feedback board on social media: </label>
            <div class="input-group">
                <button type="button" class="btn bg-facebook btn-float mr-2"><i class="icon-facebook"></i></button>
                <button type="button" class="btn bg-twitter btn-float mr-2"><i class="icon-twitter"></i></button>
                <button type="button" class="btn bg-linkedin btn-float mr-2"><i class="icon-linkedin2"></i></button>
            </div>
        </div>
    </div>

</div>