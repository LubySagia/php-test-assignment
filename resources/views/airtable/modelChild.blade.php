<ul>

    @foreach($children as $child)

        <li>

            {{ $child['number'] }} ({{ $child['description'] }})

            @if(isset($child['children']))

                @include('airtable.modelChild',['children' => $child['children']])

            @endif

        </li>

    @endforeach

</ul>
