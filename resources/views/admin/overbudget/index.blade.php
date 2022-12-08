@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="/admin/overbudget" method="get">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="">Find RAB Datas</label>
                            <select name="values" id="" class="select2" style="width: 100%">
                                <option value=""></option>
                                @foreach ($rab as $item)
                                    <option value="{{$item->id}}" {{$item->id == Request::get('values')? 'selected':''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <br>
                            <button type="submit" class="btn btn-primary"><i class="anticon anticon-zoom-in"></i> Find</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

    @if ($datas != null)
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <th>Project Name</th>
                        <th>Project Date</th>
                        <th>Construction Service</th>
                        <th>Real Cost</th>
                        <th>Round Up Cost</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($datas as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{\Carbon\Carbon::parse($item->project_date)->format('d-M-Y')}}</td>
                                <td>{{$item->construction_service}}</td>
                                <td>{{$item->real_cost}}</td>
                                <td>{{$item->rounded_up_cost}}</td>

                                <td>
                                    @include('components.btnactionlist', [
                                        "is_detail" => true,
                                        "is_edit" => false,
                                        "is_print" => true,
                                        "is_delete" => false,
                                        "url_detail" => "/admin/overbudget/".$item->id."/detail",
                                        "url_print" => "/admin/rab/rabs/".$item->id."/print",
                                        "url_edit" => "/admin/overbudget/".$item->id."/edit",
                                        "url_delete" => "/admin/overbudget/".$item->id."/delete",
                                    ])
                                </td>
                            </tr>                            
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
    @endif

</div>
@endsection


@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css" />

@endpush

@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js"></script>
<script>

$(document).ready(function () {
    
    $(".select2").select2({
    });
});

</script>

@endpush