@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Operator Register'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Operator Register</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form role="form" method="POST" action={{ route('operator.create') }}
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">Register Forms</p>
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Submit</button>
                                </div>

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        <strong>Success!</strong> {{ session('status') }}
                                    </div>
                                @endif
                                @error('operator')
                                    <div class="alert alert-danger" role="alert" style="color: white">
                                        <strong>Required!</strong> Nama Operator
                                    </div>
                                @enderror
                                @error('email')
                                    <div class="alert alert-danger" role="alert" style="color: white">
                                        <strong>Required!</strong> Email
                                    </div>
                                @enderror
                                @error('nama-menara')
                                    <div class="alert alert-danger" role="alert" style="color: white">
                                        <strong>Required!</strong> Nama Menara
                                    </div>
                                @enderror
                            </div>

                            <div class="card-body">
                                <p class="text-uppercase text-sm">User Information</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nama Operator</label>
                                            <input class="form-control" type="text" name="operator"
                                            value="{{ old('operator', auth()->user()->operator) }}">
                                        </div> --}}
                                        <label for="example-text-input" class="form-control-label">Nama Operator</label>
                                        <select class="form-control" name="operator" id="choices-button"
                                            placeholder="Choose Operator">
                                            @foreach ($op_master as $opmaster)
                                                <option value="{{ $opmaster->id }}">{{ $opmaster->operator_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nama Menara</label>
                                            <input class="form-control" type="text" name="nama-menara"
                                                value="{{ old('nama-menara') }}">
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">First name</label>
                                            <input class="form-control" type="text" name="firstname"  value="{{ old('firstname', auth()->user()->firstname) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Last name</label>
                                            <input class="form-control" type="text" name="lastname" value="{{ old('lastname', auth()->user()->lastname) }}">
                                        </div>
                                    </div> --}}
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Information Detail</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Company</label>
                                            <input class="form-control" type="text" name="company"
                                                value="{{ old('company', auth()->user()->company) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Address</label>
                                            <input class="form-control" type="text" name="address"
                                                value="{{ old('address', auth()->user()->address) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">City</label>
                                            <input class="form-control" type="text" name="city"
                                                value="{{ old('city', auth()->user()->city) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Country</label>
                                            <input class="form-control" type="text" name="country"
                                                value="{{ old('country', auth()->user()->country) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Postal code</label>
                                            <input class="form-control" type="text" name="postal"
                                                value="{{ old('postal', auth()->user()->postal) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Email</label>
                                            <input class="form-control" type="email" name="email"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Location</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Longtitude</label>
                                            <input class="form-control" type="text" name="longtitude"
                                                value="{{ old('about', auth()->user()->longtitude) }}">
                                            <label for="example-text-input" class="form-control-label">Latitude</label>
                                            <input class="form-control" type="text" name="latitude"
                                                value="{{ old('about', auth()->user()->latitude) }}">
                                        </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Payment</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Paket Harga</label>
                                            <select class="form-control" name="pack_harga" id="choices-button"
                                                placeholder="Choose Package Price">
                                                <option value="1">1 Month / Rp. 100.000</option>
                                                <option value="2" selected="">3 Months / Rp. 280.000</option>
                                                <option value="3">6 Months / Rp. 520.000</option>
                                                <option value="4">1 Year / Rp. 1.000.000</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Payment
                                                Method</label>
                                            <select class="form-control" name="payment_method" id="choices-button"
                                                placeholder="Choose Package Price">
                                                @foreach ($pay_method as $pay)
                                                    <option value="{{ $pay->bank_name }}">{{ $pay->bank_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
