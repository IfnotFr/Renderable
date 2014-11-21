<img
    @foreach(json_decode($value, true) as $attr => $value)
        {{ $attr . '=' . '"' . $value . '"' }}
    @endforeach
/>