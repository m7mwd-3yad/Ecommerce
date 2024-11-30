@extends('layouts.app')

@section('title', 'Edit Shipping Method')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Shipping Method</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('shipping.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <form action="{{ route('shipping.update', $shipping->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">


                            <!-- Amount -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control"
                                        value="{{ old('amount', $shipping->amount) }}" placeholder="Amount">
                                    @error('amount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Country -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="country_id">Country</label>
                                    <select name="country_id" id="country_id" class="form-control">
                                        <option disabled selected>Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ $country->id == old('country_id', $shipping->country_id) ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('shipping.update', $shipping->id) }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection
