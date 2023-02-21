@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-6">

            <h3>Models List of Site: {{$siteName}}</h3>

            <ul id="tree1">
                @if(!count($models))

                    <h5>No models found or the access info is inappropriate!</h5>

                @endif

                @foreach($models as $model)

                    <li>

                        {{ $model['number'] }} ({{ $model['description'] }})

                        @if(isset($model['children']))

                            @include('airtable.modelChild',['children' => $model['children']])

                        @endif

                    </li>

                @endforeach

            </ul>

        </div>
    </div>


{{--    <script src="{{ asset('js/treeview.js') }}"></script>--}}

@endsection
