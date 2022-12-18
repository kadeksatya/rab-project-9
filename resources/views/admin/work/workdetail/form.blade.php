@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-8">
        <div class="card">

            <div class="card-body">
                <form action="{{ $data == null ? '/admin/rab/work/workdetail' : '/admin/rab/work/workdetail/'.$data->id.'/update' }}" method="POST">
                @csrf

                @if ($data == null)
                    @method('POST')
                @else
                    @method('PUT') 
                @endif

                
                <input type="hidden" name="work_id" value="{{$work_id}}">

                <div class="form-group mb-2">
                    <label for="">Koefisien</label>
                    <input type="number" step="any" class="form-control koefisien" name="koefisien" value="{{$data->koefisien ?? 0}}" placeholder="ex. 0">
                </div>

                @if ($data != null) 

                <div class="form-group mb-2">
                    <label for="">Type Data</label>
                    <select name="type_data" id="getDatas" class="form-control">
                        <option value="" selected disabled></option>
                        <option value="1" {{$data->type_data == 1 ? 'selected':''}}>Bahan</option>
                        <option value="2" {{$data->type_data == 2 ? 'selected':''}}>Alat</option>
                        <option value="3" {{$data->type_data == 3 ? 'selected':''}}>Upah Pekerja</option>
                    </select>
                </div>

                {{-- Material Get Dats --}}

                <div class="form-group mb-2 material {{$data->type_data == 1 ? '':'d-none'}}">
                    <label for="">Nama Bahan</label>
                    <select name="value_id" id="" class="form-control material_input">
                        <option value="" selected disabled></option>
                        @foreach ($material as $item)
                            <option value="{{$item->id}}" data-price="{{$item->price}}" data-unit="{{$item->unit}}" {{$data->value_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tool Get Datas --}}

                <div class="form-group mb-2 tool {{$data->type_data == 2 ? '':'d-none'}}">
                    <label for="">Nama Alat</label>
                    <select name="value_id" id="" class="form-control tool_input">
                        <option value="" selected disabled></option>
                        @foreach ($tool as $item)
                            <option value="{{$item->id}}" data-price="{{$item->price}}" data-unit="{{$item->unit}}" {{$data->value_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Worker Get Datas --}}

                <div class="form-group mb-2 worker {{$data->type_data == 3 ? '':'d-none'}}">
                    <label for="">Name Pekerja</label>
                    <select name="value_id" id="" class="form-control worker_input">
                        <option value="" selected disabled></option>
                        @foreach ($worker as $item)
                            <option value="{{$item->id}}" data-price="{{$item->price}}" data-unit="{{$item->unit}}" {{$data->value_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                @else

                <div class="form-group mb-2">
                    <label for="">Type Data</label>
                    <select name="type_data" id="getDatas" class="form-control">
                        <option value="" selected disabled></option>
                        <option value="1">Bahan</option>
                        <option value="2">Alat</option>
                        <option value="3">Upah Pekerja</option>
                    </select>
                </div>

                <div class="form-group mb-2 material d-none">
                    <label for="">Nama Bahan</label>
                    <select name="value_id" id="" class="form-control material_input">
                        <option value="" selected disabled></option>
                        @foreach ($material as $item)
                            <option value="{{$item->id}}" data-price="{{$item->price}}" data-unit="{{$item->unit}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tool Get Datas --}}

                <div class="form-group mb-2 tool d-none">
                    <label for="">Nama Bahan</label>
                    <select name="value_id" id="" class="form-control tool_input">
                        <option value="" selected disabled></option>
                        @foreach ($tool as $item)
                            <option value="{{$item->id}}" data-price="{{$item->price}}" data-unit="{{$item->unit}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Worker Get Datas --}}

                <div class="form-group mb-2 worker d-none">
                    <label for="">Nama Pekerja</label>
                    <select name="value_id" id="" class="form-control worker_input">
                        <option value="" selected disabled></option>
                        @foreach ($worker as $item)
                            <option value="{{$item->id}}" data-price="{{$item->price}}" data-unit="{{$item->unit}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                @endif 


                <div class="form-group mb-2">
                    <label for="">Satuan</label>
                    <input type="text" class="form-control unit" name="unit" value="{{$data->unit ?? ''}}" placeholder="ex. pcs">
                </div>
                <div class="form-group mb-2">
                    <label for="">Harga</label>
                    <input type="number" step="0.1" class="form-control price" name="price" value="{{$data->price ?? 0}}" placeholder="ex. 0">
                </div>
                <div class="form-group mb-2">
                    <label for="">Sub Total</label>
                    <input type="number" class="form-control sub_total" name="sub_amount" value="{{$data->sub_amount ?? 0}}" placeholder="ex. 0">
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

@push('script')

<script>
    $(document).ready(function () {

        let material = $(".material");
        let tool = $(".tool");
        let worker = $(".worker");

        let material_input = $(".material_input");
        let tool_input = $(".tool_input");
        let worker_input = $(".worker_input");

        let koefisien = $(".koefisien");
        let unit = $(".unit");
        let price = $(".price");
        let sub_total = $(".sub_total");
    

        $("#getDatas").change(function (e) { 
            e.preventDefault();
            let values = $(this).val();

            if(values == 1 ){
                material.removeClass('d-none');
                tool.addClass('d-none');
                worker.addClass('d-none');
                tool_input.val('');
                worker_input.val('');
            }
            if(values == 2){
                material.addClass('d-none');
                tool.removeClass('d-none');
                worker.addClass('d-none');
                material_input.val('');
                worker_input.val('');
            }
            if(values == 3){
                material.addClass('d-none');
                tool.addClass('d-none');
                worker.removeClass('d-none');
                material_input.val('');
                tool_input.val('');
            }

            
        });


        function subtotal(amount) { 
            sub_total.val(amount * koefisien.val());
            console.log(amount);
            console.log(koefisien.val());
        }

        $(material).change(function (e) { 
            e.preventDefault();
            let values_select =  $(this).find(":selected").data('price');
            let values_unit =  $(this).find(":selected").data('unit');
            price.val(values_select);
            unit.val(values_unit);
            subtotal(values_select);
            console.log(values_unit);
            
        });

        $(tool).change(function (e) { 
            e.preventDefault();
            let values_select =  $(this).find(":selected").data('price');
            let values_unit =  $(this).find(":selected").data('unit');
            price.val(values_select);
            unit.val(values_unit);
            subtotal(values_select);
            console.log(values_unit);
            
        });

        $(worker).change(function (e) { 
            e.preventDefault();
            let values_select =  $(this).find(":selected").data('price');
            let values_unit =  $(this).find(":selected").data('unit');
            price.val(values_select);
            unit.val(values_unit);
            subtotal(values_select);
            console.log(values_unit);
            
        });
    });
</script>

@endpush