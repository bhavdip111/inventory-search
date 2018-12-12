<div class="form-group row">
    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}<span class="required" aria-required="true"> * </span></label>
    <div class="col-md-6">
        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{old('title') ? old('title') : ( ($product->title) ? $product->title : '' )}}" required autofocus maxlength="255">
        @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}<span class="required" aria-required="true"> * </span></label>
    <div class="col-md-6">
        <input id="price" type="price" class="form-control price-number {{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{old('price') ? old('price') : ( ($product->price) ? $product->price : '' )}}" required maxlength="10">
        @if ($errors->has('price'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('price') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}<span class="required" aria-required="true"> * </span></label>
    <div class="col-md-6">
        <input id="quantity" type="quantity" class="form-control only-number {{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" value="{{old('quantity') ? old('quantity') : ( ($product->quantity) ? $product->quantity : '' )}}" required maxlength="10">
        @if ($errors->has('quantity'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('quantity') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
    <div class="col-md-6">
        <textarea id="content" class="form-control" name="content">{{ old('content') ? old('content') : ( ($product->content) ? $product->content : '' )}}</textarea>
    </div>
</div>