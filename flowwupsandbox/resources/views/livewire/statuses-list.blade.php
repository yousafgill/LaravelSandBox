<div class="form-group">
    @foreach($statuses as $st)
    <div class="form-check" >
        <label class="form-check-label font-weight-bold text-{{$st->status_color}}">
            <input type="checkbox" name="statusarray" id="{{$st->id}}" value="{{$st->id}}" wire:change.prevent="$emit('statusselected',{{$st->id}},$event.target.checked)"  class="form-input-styled" data-foucs>
            {{$st->title}} 
        </label>
    </div>
    @endforeach
    
</div>