@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="text" id="search-input" class="form-control"/>
                        </div>
                        <div class="col-sm-2">
                            <button id="search-btn" class="btn btn-main">Search</button>
                        </div>
                    </div>
                    <ul id="product-list" class="list-group">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript">
(function(){
    "use strict";

    var sortData = function(data){
        var $list = $('#product-list');
        $list.html('');
        $.each(data.data, function(key, value){
            var product = '<li class="list-group-item">';
            product += '<h3>' + value.data.name + ' - $' + value.data.price + '</h3>';
            product += '<p>' + value.data.description + '</p>';
            product += '<small>' + value.data.likes + ' likes</small>';
            product += '</li>';
            $list.append(product);
        });
    };

    $(document).ready(function(){
        $("#search-input").on('change', function(){
            var search = $('#search-input').val();
            $.getJSON('/products?search=' + search, sortData);
        });

        $.getJSON('/products', sortData);
    });

})();
</script>
@endpush
