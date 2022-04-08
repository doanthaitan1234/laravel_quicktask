@extends('layouts.adminLayout')

@section('content')
    <div class="row home">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (Auth::user())
                        <h1 class="alert alert-success" role="alert">
                            {{ __('Welcome :name!', ['name' => Auth::user()->full_name]) }}
                        </h1>
                    @else
                        {{ __('You must login!') }}
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
<script>
      $(document).ready(function(){
          $('.menu').removeClass('active');
          $('#profile').addClass('active');
        });
</script>
@endsection
