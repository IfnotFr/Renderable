<img
    @foreach($value as $attr => $value)
        {{ $attr . '=' . '"' . $value . '"' }}
    @endforeach
/>