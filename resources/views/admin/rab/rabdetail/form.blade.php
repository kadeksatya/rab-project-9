@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-8">
        <div class="card">

            <div class="card-body">
                <form action="{{ $data == null ? '/admin/rab/rabs/rabsdetail' : '/admin/rab/rabs/rabsdetail/'.$data->id.'/update' }}" method="POST">
                @csrf

                @if ($data == null)
                    @method('POST')
                @else
                    @method('PUT') 
                @endif

                
                <input type="hidden" name="rab_id" value="{{$rab_id}}">
                
                @if ($data != null)
                <div class="form-group mb-2 work_category">
                    <label for="">Jenis Pekerjaan</label>
                    <select name="work_category_id" id="WorkCategory" class="select2 work_category_input" style="width: 100%">
                        <option value="" selected disabled></option>
                        @foreach ($workcategory as $item)
                            <option value="{{$item->id}}" {{$item->id == $data->work_category_id ? 'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- work Get Dats --}}

                <div class="form-group mb-2 work">
                    <label for="">Nama Pekerjaan</label>
                    <select name="work_id" id="WorkName" class="select2 work_input" style="width: 100%">
                        <option value="" selected disabled></option>
                        @foreach ($work as $item)
                            <option value="{{$item->id}}" data-category_id="{{$item->work_category_id}}" data-price="{{$item->total_amount}}" data-unit="{{$item->unit}}" {{$item->id == $data->work_id ? 'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                @else
                <div class="form-group mb-2 work_category">
                    <label for="">Jenis Pekerjaan</label>
                    <select name="work_category_id" id="WorkCategory" class="select2 work_category_input" style="width: 100%">
                        <option value="" selected disabled></option>
                        @foreach ($workcategory as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- work Get Dats --}}

                <div class="form-group mb-2 work">
                    <label for="">Nama Pekerjaan</label>
                    <select name="work_id" id="WorkName" class="select2 work_input" style="width: 100%">
                        <option value="" selected disabled></option>
                        @foreach ($work as $item)
                            <option value="{{$item->id}}" data-category_id="{{$item->work_category_id}}" data-price="{{$item->total_amount}}" data-unit="{{$item->unit}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                
                

                <div class="form-group mb-2">
                    <label for="">Volume</label>
                    <input type="text" required class="form-control volume" name="volume" value="{{$data->volume ?? ''}}" placeholder="ex. pcs">
                </div>

                <div class="form-group mb-2">
                    <label for="">Satuan</label>
                    <input type="text" required class="form-control unit" name="unit" value="{{$data->unit ?? ''}}" placeholder="ex. pcs">
                </div>
                <div class="form-group mb-2">
                    <label for="">Harga</label>
                    <input type="number" required readonly step="any" class="form-control price" name="price" value="{{$data->work->total_amount ?? 0}}" placeholder="ex. 0">
                </div>
                <div class="form-group mb-2">
                    <label for="">Sub Total</label>
                    <input type="number" readonly step="any" class="form-control sub_amount" name="sub_amount" value="{{($data->work->total_amount ?? 0) * ($data->volume ?? 0 )}}" placeholder="ex. 0">
                </div>
            </div>
        </div>
        <div class="card-footer">
            @include('components.btnactionform', [
                'url_back' => '/admin/rab/rabs/'.$rab_id.'/detail'
            ])
        </div>
    </form>
    </div>
</div>
@endsection

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css" />

@endpush

@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js"></script>

@if ($data != null)
<script>
        $(document).ready(function () {
        $(".select2").select2();
    })


    $(function() {
        let unit = $(".unit");
        let price = $(".price");

        var $select1 = $('#WorkCategory'),
        $select2 = $('#WorkName'),
        $options = $select2.find('option');

    $select1.on('change', function() {
    var size = $(this).find("option:selected").val();
    $select2.html($options.filter('[data-category_id="' + size + '"]'));
    $select2.val($select2.find("option:first").val());

    price.val($select2.find("option:selected").data('price'))
    unit.val($select2.find("option:selected").data('unit'))
    //$select2.val("");
    }).trigger('change');


    $select2.change(function (e) { 
        e.preventDefault();
        price.val($(this).find("option:selected").data('price'))
        unit.val($(this).find("option:selected").data('unit'))
    });



    function subtotal(amount) {
        $(".sub_amount").val(amount * price.val());
        
    }

    $(".volume").on('input', function(){
        let amount = $(this).val()
        console.log(amount);
        subtotal(amount);
    });


    

});
</script>  
@else
<script>
        $(document).ready(function () {
        $(".select2").select2();
    })
    $(function() {
        let unit = $(".unit");
        let price = $(".price");

        var $select1 = $('#WorkCategory'),
        $select2 = $('#WorkName'),
        $options = $select2.find('option');

    $select1.on('change', function() {
    var size = $(this).find("option:selected").val();
    $select2.html($options.filter('[data-category_id="' + size + '"]'));
    $select2.val($select2.find("option:first").val());

    price.val($select2.find("option:selected").data('price'))
    unit.val($select2.find("option:selected").data('unit'))
    //$select2.val("");
    }).trigger('change');


    $select2.change(function (e) { 
        e.preventDefault();
        price.val($(this).find("option:selected").data('price'))
        unit.val($(this).find("option:selected").data('unit'))
    });



    function subtotal(amount) {
        $(".sub_amount").val(amount * price.val());
        
    }

    $(".volume").on('input', function(){
        let amount = $(this).val()
        console.log(amount);
        subtotal(amount);
    });


    

});
</script>  
@endif



@endpush