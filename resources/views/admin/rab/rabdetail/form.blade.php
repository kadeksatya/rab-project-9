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

                {{$data}}
                
                <input type="hidden" name="rab_id" value="{{$rab_id}}">

                @if ($data != null) 

                <div class="form-group mb-2 work_category">
                    <label for="">Work Category</label>
                    <select name="work_category_id" id="WorkCategory" class="form-control work_category_input">
                        <option value="" selected disabled></option>
                        @foreach ($workcategory as $item)
                            <option value="{{$item->id}}" {{$data->work_category_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- work Get Dats --}}

                <div class="form-group mb-2 work">
                    <label for="">Name work</label>
                    <select name="work_id" id="WorkName" class="form-control work_input">
                        <option value="" selected disabled></option>
                        @foreach ($work as $item)
                            <option value="{{$item->id}}" data-price="{{$item->total_amount}}" data-unit="{{$item->unit}}" {{$data->work_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>


                @else

                <div class="form-group mb-2 work_category">
                    <label for="">Work Category</label>
                    <select name="work_category_id" id="WorkCategory" class="form-control work_category_input">
                        <option value="" selected disabled></option>
                        @foreach ($workcategory as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- work Get Dats --}}

                <div class="form-group mb-2 work">
                    <label for="">Name work</label>
                    <select name="work_id" id="WorkName" class="form-control work_input">
                        <option value="" selected disabled></option>
                        @foreach ($work as $item)
                            <option value="{{$item->id}}" data-category_id="{{$item->work_category_id}}" data-price="{{$item->total_amount}}" data-unit="{{$item->unit}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>


                @endif 

                <div class="form-group mb-2">
                    <label for="">Volume</label>
                    <input type="text" class="form-control volume" name="volume" value="{{$data->volume ?? ''}}" placeholder="ex. pcs">
                </div>

                <div class="form-group mb-2">
                    <label for="">Unit</label>
                    <input type="text" class="form-control unit" name="unit" value="{{$data->unit ?? ''}}" placeholder="ex. pcs">
                </div>
                <div class="form-group mb-2">
                    <label for="">Price</label>
                    <input type="number" step="0.1" class="form-control price" name="price" value="{{$data->price ?? 0}}" placeholder="ex. 0">
                </div>
                <div class="form-group mb-2">
                    <label for="">Sub Total</label>
                    <input type="number" class="form-control sub_amount" name="sub_amount" value="{{$data->sub_amount ?? 0}}" placeholder="ex. 0">
                </div>
            </div>
        </div>
        <div class="card-footer">
            @include('components.btnactionform', [
                'url_back' => '/admin/rab/work'
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
<script>
        
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

@endpush