<div class="form-group">
    @foreach($boards as $board)
    <div class="form-check pl-3" x-data>
        <label class="form-check-label">
            <input type="checkbox" wire:change.prevent="$emit('boardselected',{{$board->id}},$event.target.checked)" class="form-input-styled" data-foucus>
            <!-- <input type="checkbox" @click="MyFunction($event,{{$board->id}})" class="form-input-styled" data-foucus> -->
            {{$board->name}}
        </label>
    </div>
    @endforeach
    <div>

    </div>
</div>