@props(['color'])

<span style="
    background-color: {{ $color }};
    color: white;
    padding: 4px 8px;
    border-radius: 999px;
    font-size: 0.8rem;
";>
    {{ $slot }}
</span>