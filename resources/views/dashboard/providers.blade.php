@extends('app')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Providers
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">

            <div class="col-md-12">
                @if(count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            <div class="text-muted">{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                      <li class="nav-item">
                        <a href="#tabs-profile-1" class="nav-link active" data-bs-toggle="tab">Provider List</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active show" id="tabs-profile-1">
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-2">
                                        <label class="form-label">Name</label>
                                        <div>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="name"
                                                value="{{ request()->input('name') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="button" id="clear_filter" class="btn btn-warning">Clear</button>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">

                        <table class="table table-vcenter card-table table-striped">
                        <thead>
                            <tr>
                                <th>ıd</th>
                                <th>name</th>
                                <th>base_url</th>
                                <th>format</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($providers as $provider)
                                <tr>
                                    <td>{{ $provider->id }}</td>
                                    <td class="text-secondary">{{ $provider->name }}</td>
                                    <td class="text-secondary">{{ $provider->base_url }}</td>
                                    <td class="text-secondary">{{ $provider->format }}</td>
                                    @if($provider->enabled == 1)
                                        <td class="text-secondary">Active</td>
                                    @else
                                        <td class="text-secondary">Passive</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        {{ $providers->appends($_GET)->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footerJs')
<script>
    $(document).ready(function(){
        //alert('>hi! from footer js');
        $('#clear_filter').click(function(){
            $('#name').val('');
            location.replace('{{ route("dashboard.providers") }}');
        });
    });
</script>
@endsection
