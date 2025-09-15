@extends('layouts.app')

@section('title', 'Two-factor challenge')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h4 mb-4">Two-factor authentication</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/two-factor-challenge') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="code" class="form-label">Authentication code</label>
                            <input id="code" class="form-control" type="text" name="code" autocomplete="one-time-code" autofocus />
                        </div>

                        <div class="text-center my-3">or</div>

                        <div class="mb-3">
                            <label for="recovery_code" class="form-label">Recovery code</label>
                            <input id="recovery_code" class="form-control" type="text" name="recovery_code" />
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


