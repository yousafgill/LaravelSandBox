<div class="form-group-feedback form-group-feedback-right">
    <select class="select2 form-control " wire:model="selectedCategoryId" wire:change.prevent="$emit('FilterCategoryChanged',$event.target.value)" name="categories" id="categories">
        @foreach($categories as $cat)
        <option value="{{$cat->id}}" {{$cat->id==$selectedCategory->id ? 'selected': ''}}>{{$cat->title}}</option>
        @endforeach
    </select>
</div>