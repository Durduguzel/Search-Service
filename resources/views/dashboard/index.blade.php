@extends('app')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Contents
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
                        <a href="#tabs-profile-1" class="nav-link active" data-bs-toggle="tab">Content List</a>
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
                                        <label class="form-label">Title</label>
                                        <div>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="title"
                                                value="{{ request()->input('title') }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-2">
                                        <label class="form-label">Type</label>
                                        <div>
                                            <input type="text" name="type" id="type" class="form-control" placeholder="type"
                                                value="{{ request()->input('type') }}">
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
                                <th>tıtle</th>
                                <th>type</th>
                                <th>score</th>
                                <th>publıshed at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contents as $content)
                                <tr>
                                    <td>{{ $content->id }}</td>
                                    <td class="text-secondary">{{ $content->title }}</td>
                                    <td class="text-secondary">{{ $content->type }}</td>
                                    <td class="text-secondary">{{ $content->score }}</td>
                                    <td class="text-secondary">{{ $content->published_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        {{ $contents->appends($_GET)->links() }}
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
            $('#title').val('');
            $('#type').val('');
            location.replace('{{ route("dashboard.index") }}');
        });
    });
</script>
@endsection
