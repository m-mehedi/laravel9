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
    
    
        
    <ul>
        @foreach ($post->tags as $tag)
           <li>{{ $tag->name }} ({{$tag->pivot->created_at}})</li>
        @endforeach
    </ul>
    
@endforeach