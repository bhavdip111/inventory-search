@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 error-section">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button class="close" data-close="alert"></button> {!! session('success') !!}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    <button class="close" data-close="alert"></button> {!! session('error') !!}
                </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="float-left" > {{ __('Search Products') }} </span>
                    <a class="btn btn-primary float-right btn-sm" href="{{ route('products.create') }}" title="{{ __('Create Product') }}">{{ __('Create Product') }}</a>
                </div>
                <div class="card-body">
                    <form method="POST" id="search_product" data-action="{{ url('products/search-product') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-3">
                                <input id="search" type="text" class="form-control" name="search" maxlength="20" placeholder="{{ __('Search') }}">
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="search_on">
                                    <option value=""> {{ __('Sort By') }}</option>
                                    <option value="price"> {{ __('Price') }}</option>
                                    <option value="quantity"> {{ __('Quantity') }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="order_by">
                                    <option value=""> {{ __('Order By') }}</option>
                                    <option value="ASC"> {{ __('Asc') }}</option>
                                    <option value="DESC"> {{ __('Desc') }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary" >
                                    {{ __('Search') }}
                                </button>
                                <button type="reset" class="btn btn-defaullt" id="resetButton">
                                    {{ __('Reset') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <br/>
            <div id="records">
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/general.js') }}"></script>
@endsection

