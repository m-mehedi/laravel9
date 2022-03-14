{{-- @foreach ($users as $user )
    <h4>{{ $user->id }}. {{ $user->name }}</h4>
    <p>{{ $user->address->country }}</p>
@endforeach --}}

{{-- @foreach ($addresses as $address )
<p>{{ $address->country }}</p>
<p>{{ $address->user->name }}</p>
    
@endforeach --}}

@foreach ($tags as $tag)
    <h1>{{ $tag->name }}</h1> 
    <ul>
        @foreach ($tag->posts as $post)
           <li>{{ $post->title }}</li>
        @endforeach
    </ul>
    
@endforeach