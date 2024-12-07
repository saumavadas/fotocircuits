@extends('layouts.master')

@section('content')
<h1>Seller Details</h1>
<p><strong>Phone:</strong> {{ $seller->phone }}</p>
<p><strong>Name:</strong> {{ $seller->name ?? 'Not Provided' }}</p>
<p><strong>Email:</strong> {{ $seller->email ?? 'Not Provided' }}</p>
<p><strong>Verified At:</strong> {{ $seller->otp_verified_at ?? 'Not Verified' }}</p>
@endsection