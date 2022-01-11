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
                <input type="text" id="shareurl" wire:model="boardurl" class="form-control" readonly="readonly" >
                <span class="input-group-append">
                    <button class="btn btn-light" @click="handleClick($event, $dispatch)" id="btncopy" type="button">Copy</button>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Share your feedback board on social media: </label>
            <div class="input-group">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{$boardurl}}" target="_blank" class="btn bg-facebook btn-float mr-2"><i class="icon-facebook"></i></a>
                <a href="https://twitter.com/intent/tweet?text={{$boardurl}}" target="_blank" class="btn bg-twitter btn-float mr-2"><i class="icon-twitter"></i></a>
                <a href="https://www.linkedin.com/shareArticle?url={{$boardurl}}" target="_blank" class="btn bg-linkedin btn-float mr-2"><i class="icon-linkedin2"></i></a>
            </div>
        </div>
    </div>
</div>

<script>
    var cpbtn = document.getElementById('btncopy');
    cpbtn.addEventListener("click", function(e) {
        document.getElementById("shareurl").select();
        document.execCommand('copy');
    });
 </script>