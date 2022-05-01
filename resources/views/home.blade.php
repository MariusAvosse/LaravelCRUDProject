@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div class="row">
            <div class="col md-9">
            <h1>Todos</h1>
             <hr>
        
            <h2>Add new todo</h2>
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            
            <form action="{{  url('/todos')  }}" method="POST">
                @csrf
                <input type="text" class="form-control" name="todo" placeholder="Add new todo"/>
                <br>
                <input type="date" class="form-control" name="due_date"/>
                <br>   
                <button class="btn btn-primary" type="submit"> Store</button>
            </form>
            <br>
            @isset($todos)
            @foreach($todos as $todo)
            <li class="list-group-item">
                {{ $todo->todo }}
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">
                    Edit
                </button>
                <form action="{{ url('todos/'.$todo->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>

                <div class="collapse mt-2" id="collapse-{{ $loop->index }}">
                    <div class="card card-body">
                        <form action="{{ url('todos/'.$todo->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="todo" value="{{ $todo->todo }}">
                            <button class="btn btn-secondary" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </li>
            @endforeach
            @endisset
            <hr>

            <h2>Pending todos</h2>
            @if (session('status'))
            <div class="alert alert-sucess">
                    {{ session ('status')}}
            </div>
            @endif
            <ul class="list-group">
            @isset($todos)
            @foreach($todos as $todo)
                <li class="list-group-item">{{ $todo->todo }}</li>
            @endforeach
            @endisset
            </ul>
            <hr>

            <h2>Completed todos</h2>

                </div>
            
            </div>
    </div>
@endsection