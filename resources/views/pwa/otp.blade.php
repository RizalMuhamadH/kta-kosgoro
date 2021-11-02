@extends('layouts.pwa')

@section('body')
    <div class="container">
        <div class="top-head-button">
            <a href="#" class="waves-effect waves-light" onclick="window.history.back()"><i class="material-icons">arrow_back</i></a>
        </div>
        <h6 class="kosgoro-text text-darken-1"> <b>Masukan 6 digit kode verifikasi yang dikirimkan ke email</b></h6>

        <form class="col s12 form-otp digit-group" data-group-name="digits" action="{{route('member_login')}}" method="POST" id="form_login_pwa">
            @csrf
            <div class="row">
                <input type="text" id="digit-1" name="digit-1" required class="validate col s2 otp" style="max-width:13%; margin-left:4%; margin-right:1%;" />
                <input type="text" id="digit-2" name="digit-2" required class="validate col s2 otp" style="max-width:13%; margin-left:1%; margin-right:1%;"/>
                <input type="text" id="digit-3" name="digit-3"required class="validate col s2 otp" style="max-width:13%; margin-left:1%; margin-right:1%;" />
                <input type="text" id="digit-4" name="digit-4" required class="validate col s2 otp" style="max-width:13%; margin-left:1%; margin-right:1%;"/>
                <input type="text" id="digit-5" name="digit-5"required class="validate col s2 otp" style="max-width:13%; margin-left:1%; margin-right:1%;"/>
                <input type="text" id="digit-6" name="digit-6"required class="validate col s2 otp" style="max-width:13%; margin-left:1%; margin-right:1%;"/>
                <input type="hidden" name="email" id="email" value="{{$email}}">
                <input type="hidden" name="phone_number" id="phone_number">
                <input type="hidden" name="pwa" value="true">
            </div>
            <span>
                <small>
                    Kirim Ulang :
                </small>
            </span>
        </form>
        <div class="center ">
            <button class="bottom btn-small btn-large kosgoro-bg btn_login" type="button">
            Masuk
            </button>
        </div>
    </div>
@endsection

@push('page-javascript')
    <script>
        $(document).ready(function(){
            valid = false;
            $(".btn_login").on('click',function(){
                email = $("#email").val();
                password = "";
                for(i=1;i<=6;i++){
                    password = password + $("#digit-"+i).val();
                }
                if(password.length < 6){
                    Swal.fire("Error!", "OTP Anda Kurang Dari 6 Digit", "error");
                    return false;
                }else{
                    valid = true;
                }
                if(valid){
                    $.ajax({
                        url: "{{route('member_login')}}",
                        data: {
                            email: email,
                            phone_number: null,
                            password: password,
                            pwa: true,
                            _token: "{{csrf_token()}}"
                        },
                        dataType: 'JSON',
                        method: 'POST',
                        success:function(data){
                            if(data.code == "500"){
                                Swal.fire("Error!", data.message, "error");
                            }else{
                                Swal.fire("Succes!",data.message,'success');
                                window.location.href = '/pwa/profile/'+email;
                            }
                        }
                    })
                }
            });

           
            $('.otp').attr('maxlength', 1);
            $('.otp').on('keyup', function(e) {
                    $(this).next().focus();
            });
        })
    </script>
@endpush