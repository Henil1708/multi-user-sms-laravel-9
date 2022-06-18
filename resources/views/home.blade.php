@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Send SMS') }}</div>

                <div class="card-body">

                     @if( session( 'success' ) )
                        <div class="alert alert-success">
                            {{ session( 'success' ) }}
                        </div>
                    @endif
                    <form action="{{ url('sms') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="numbers">Phone Numbers <span class="text-danger">( comma separated values)</span> </label>
                            <input type="text" id="numbers" name="numbers" class="form-control" >
                            @error('numbers')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-4">
                            <label for="message">Message </label>
                            <textarea  id="message" rows="5" name="message" class="form-control" ></textarea>
                             @error('message')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="submit" value="Send" class=" btn-lg  btn-primary mt-4">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
