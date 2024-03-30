@extends('admin.dashboard')

@section('content')
    <!-- Blade view file -->
<form action=""{{ url('/admin/vloodgroup') }}" method="GET">
    @csrf
    <button type="submit">Go to Genotype Route</button>
</form>

<form action=""{{ url('/admin/genotype') }}" method="GET">
    @csrf
    <button type="submit">Go to Blood Group Route</button>
</form>

@endsection
