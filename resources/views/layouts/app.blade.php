<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{config('app.name')}} | {{$page_name}}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}">

    <!-- page css -->

    <!-- Core css -->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('style')

</head>

<body>
    <div class="app">
        @foreach ($errors->all() as $item)
            <span class="showError" data-message="{{$item}}"></span>
        @endforeach
        @if (session('message'))
            <span class="showSuccess" data-message="{{session('message')}}"></span>
        @endif
        <div class="layout">
            @include('layouts.header')

            @include('layouts.sidebar')

            <!-- Page Container START -->
            <div class="page-container">
                

                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="page-header">
                        <h2 class="header-title">{{$page_name}}</h2>
                        <div class="header-sub-title">
                            <nav class="breadcrumb breadcrumb-dash">
                                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                                <?php $link = "" ?>
                                @for($i = 1; $i <= count(Request::segments()); $i++)
                                    @if($i < count(Request::segments()) & $i > 0)
                                        <?php $link .= Request::segment($i); ?>
                                        @if ($i == 1)
                                            <a href="<?= $link ?>" class="breadcrumb-item inactive">{{ ucwords(str_replace('-',' ',Request::segment($i)))}}</a>
                                        @else
                                            <a href="" class=" breadcrumb-item inactive">{{ ucwords(str_replace('-',' ',Request::segment($i)))}}</a>
                                        @endif
                                    @else
                                        <a class="breadcrumb-item active">{{ucwords(str_replace('-',' ',Request::segment($i)))}}</a>
                                    @endif
                                @endfor
                            </nav>
                        </div>
                    </div>
                    <!-- Content goes Here -->
                    @yield('content')
                </div>
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                <footer class="footer">
                    <div class="footer-content">
                        <p class="m-b-0">Copyright © 2019 Theme_Nate. All rights reserved.</p>
                        <span>
                            <a href="" class="text-gray m-r-15">Term &amp; Conditions</a>
                            <a href="" class="text-gray">Privacy &amp; Policy</a>
                        </span>
                    </div>
                </footer>
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->
        </div>
    </div>

    
    <!-- Core Vendors JS -->
    <script src="{{asset('assets/js/vendors.min.js')}}"></script>

    <!-- page js -->
    <script src="{{asset('assets/vendors/chartjs/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard-default.js')}}"></script>

    <!-- Core JS -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('script')

    <script>
        $('.showError').show(function(){
            let message = $(this).data('message')

            Swal.fire(
                'Ops..',
                message,
                'error'
            )
        });

        $('.showSuccess').show(function(){
            let message = $(this).data('message')
            Swal.fire(
                'Horey',
                message,
                'success'
            )
        });
        $(document).on('click', '.delete-item', function () {
                var url = $(this).data('url');

                console.log(url);
                Swal.fire({
                    title: 'Warning',
                    text: "Are you sure for delete this ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).data("id");
                        var token = $("meta[name='csrf-token']").attr("content");
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            success: function (data) {
                                Swal.fire(
                                    'Deleted!',
                                    data.message,
                                    'success'
                                )
                                window.location.reload().time(3)
                            }
                        });
                    }
                })
            })
    </script>

</body>

</html>