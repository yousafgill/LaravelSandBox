<div>
    <div class="mb-3 pt-2">
        <h6 class="mb-0 font-weight-semibold">
            Cancel Subscription
        </h6>
    </div>
    <div class="alert alert-danger  alert-styled-left  ">
        <button type="button" class="close" ><span>×</span></button>
        <span class="font-weight-semibold">You are about to cancel your current subscription. this will remove your acces to the system. are you sure ?
            <a href="#" class="btn btn-default mr-3" wire:click.prevent="$emit('handlecancel')"> Yes</a>
            <a href="{{route('dashboard')}}" class="btn btn-default ml-3"> No</a>
        </span>
    </div>



</div>