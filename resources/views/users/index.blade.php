{{-- @foreach ($users as $user )
    <h4>{{ $user->id }}. {{ $user->name }}</h4>
    <p>{{ $user->address->country }}</p>
@endforeach --}}

@foreach ($addresses as $address )
<p>{{ $address->country }}</p>
<p>{{ $address->user->name }}</p>
    
@endforeach