@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Channels</div>

                <div class="panel-body">
                   <form action="{{ route('channels.store') }}" method="post">
                       {{csrf_field()}}
                       <div class="form-group">
                           <input type="text" name="channel" class="form-control"></input>
                       </div>
                       <div class="form-group">
                           <div class="text-center">
                               <button type="submit" class="btn btn-success">Create Channel</button>
                           </div>
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
