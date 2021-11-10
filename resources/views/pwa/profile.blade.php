@extends('layouts.pwa')

@section('body')
    <div class="row">
        <div class="top" style="background-image: url('https://app.kosgoro57.id/assets/pwa/img/kta-top-orange.png'); background-size:cover; background-repeat:no-repeat">
            <div class="container">
                <a class="left white-text menu " href="{{route('pwa.update',['id'    => $data->id])}}">
                    <i class="material-icons sidenav-trigger">assignment_ind</i></a>
                </a>
                <span class="right white-text menu" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="material-icons sidenav-trigger">exit_to_app</i></a>
                    <form id="logout-form" action="{{ route('pwa.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </span>
            </div>
            <img src="https://app.kosgoro57.id/assets/pwa/img/kta-top-white.png" alt="" class="front"/>
            <img src="https://app.kosgoro57.id/assets/pwa/img/logo.png" class="logo-profile"/>
        </div>
        <div class="container card-between">
            <div class="card card-round">
                <div class="card-content">
                    <div class="row">
                        <div class="col s3">
                            <img src="https://app.kosgoro57.id/storage/data_member/{{$data->id}}/{{$data->photo}}" alt="" class="profile-pict"/>
                        </div>
                        <div class="col s9">
                            <span>{{$data->no_member}}</span> <br>
                            <span class="profile-name">{{$data->name}}</span> <br>
                            <span>{{$data->Province['name']}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card card-kta card-round">
                <div class="row" style="background-color:#E4831A; padding:0px; margin-bottom:0px">
                    <img src="https://app.kosgoro57.id/assets/pwa/img/kta-top-white.png" alt="" class="back"/>
                    <div class="col s3">
                        <img class="logo-card" src="https://app.kosgoro57.id/assets/pwa/img/logo.png"><br>
                    </div>
                    <div class="col s8" style="display:block; margin-top:25px;">
                        <span class="card-title white-text" style="line-height: 1px;">KARTU ANGGOTA KOSGORO 1957</span> 
                    </div>
                </div>
                <div class="card-content " style="background-image:url('{{asset('assets/pwa/img/kosgoro-back.png')}}'); background-size:cover; background-position:center; background-repeat:no-repeat;">
                    <div class="row">
                        <div class="col s3" style="max-height: 15vh; overflow:hidden">
                            <img src="https://app.kosgoro57.id/storage/data_member/{{$data->id}}/{{$data->photo}}" alt="" class="profile-card"/>
                        </div>
                        <div class="row" style="margin-bottom:0px">
                            <div class="col s6" style="margin-top: 10px;">
                                <span><b> {{$data->no_member}} </b></span> <br>
                                <span class="profile-name"> <b> {{strtoupper($data->name)}} </b> </span> <br>
                                <span> <b> {{$data->Province['name']}} <b> </span> <br>
                            </div>
                            <div class="col s3 pull-s1">
                                @if($data->status == "1")
                                    <figure >
                                        <img src="{{asset('assets/pwa/img/kosgoro-not-verifikasi.png')}}"  alt="" />
                                        <figcaption style="line-height: 10px"> <small> BELUM DIVERIFIKASI </small> </figcaption>
                                    </figure>
                                @elseif($data->status == "0")
                                    <figure >
                                        <img src="{{asset('assets/pwa/img/kosgoro-verifikasi.png')}}"  alt=""/>
                                        <figcaption  style="text-align: center"> <small> TERVERIFIKASI </small> </figcaption>
                                    </figure>
                                @elseif($data->status == "2")     
                                    <figure >
                                        <img src="{{asset('assets/pwa/img/kosgoro-not-verifikasi.png')}}"  alt="" />
                                        <figcaption><small>DIBLOCKIR</small></figcaption>
                                    </figure>
                                @endif
                                
                            </div>
                        </div>
                        <div class="col s6 offset-s3" style="margin-top: -10%; margin-bottom:0px">
                            <span style="display: block;margin-left: 15%;margin-right: auto; font-size:11px"> Ketua Umum </span>
                            <img src="{{asset('assets/pwa/img/ttd-kosgoro.png')}}" alt="" style="max-width: 50%;display: block;margin-left: auto;margin-right: auto; "/>
                            <span style="display: block;margin-left: auto;margin-right: auto; font-size:12px"> <b>  Dave AF Laksono  </b> </span>
                        </div>
                        <div class="col s3">
                            <img src="https://app.kosgoro57.id/storage/data_member/{{$data->id}}/{{$data->qrcode}}" class="img-left" alt=""   onerror="this.src='https://app.kasgoro57.id/assets/pwa/img/qrcode-default.png'"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="center container">
        <a class="btn-small btn-register btn-large kosgoro-bg btn-print" href="{{route('pwa.download_kta',['id' => $data->id])}}">
            Cetak Kartu Anggota
        </a>
    </div>
@endsection

@push('page-javascript')
    <script>
        var id = "{{$data->id}}";
        $(document).ready(function(){
            $('.side-menu').sidenav();
        })
        @if($data->no_member == null){
            Swal.fire({
                title: "Important",
                text: "Silahkan Lengkapi Profile Anda Terlebih Dahulu",
                showCancelButton: false,
                icon: "warning",
                buttons: true,
                dangerMode: true,
                allowOutsideClick: false,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/pwa/register/'+id;
                }
            });

        }
        @endif

        $(".btn-profile").on('click',function(){

        })
    </script>
@endpush
