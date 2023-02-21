@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>Change Credentials for Site: {{ $site->name }}</h3></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{URL::route('sites.store-credentials')}}" method="post">
                            {{ csrf_field() }}
                            <input
                                type="hidden"
                                value={{$site->id}}
                                id="siteId"
                                name="siteId"
                            >
                            <div class="form-group">
                                <label for="baseId">Site Base ID:</label>
                                <input
                                    type="text"
                                    value="{{$site->base_id}}"
                                    class="form-control"
                                    id="baseId"
                                    name="baseId"
                                >
                            </div>
                            <div class="form-group">
                                <label for="accessKey">Site Access Key:</label>
                                <input
                                    type="text"
                                    value="{{$site->access_key}}"
                                    class="form-control"
                                    id="accessKey"
                                    name="accessKey"
                                >
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
