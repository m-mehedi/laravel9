{{-- @foreach ($users as $user )
    <h4>{{ $user->id }}. {{ $user->name }}</h4>
    <p>{{ $user->address->country }}</p>
@endforeach --}}

{{-- @foreach ($addresses as $address )
<p>{{ $address->country }}</p>
<p>{{ $address->user->name }}</p>
    
@endforeach --}}

@foreach ($posts as $post)
    <h1>{{ $post->title }}</h1>
    <p> {{ optional($post->user)->name }} </p>
    {{-- <p> {{ $post->user->name }} </p> --}}
    
@endforeach