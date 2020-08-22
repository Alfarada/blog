@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card">
                        <div class="card-header text-center">
                            <h5 class="card-title mb-0"> Indice de categorías
                                <a  class="btn btn-primary float-right"
                                    href=" {{ route('categories.create') }}">crear</a></h5>
                        </div>
                        <div class="card-body">
                            
                                <table class="table table-light">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="10px">ID</th>
                                            <th>Nombre</th>
                                            <th colspan="3">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td with="10px">
                                                <a  href=" {{ route('categories.show', $category->id) }}"
                                                    class="btn  btn-sm btn-light">
                                                    ver
                                                </a>
                                            </td>
                                            <td with="10px">
                                                <a  href=" {{ route('categories.edit', $category->id) }}"
                                                    class="btn btn-sm btn-light">
                                                    editar
                                                </a>
                                            </td>
                                            <td with="10px">
                                                {!! Form::open(['route' => ['categories.destroy',$category->id],
                                                    'method' => 'DELETE'])!!}

                                                    <button class="btn  btn-sm  btn-danger">
                                                        eliminar
                                                    </button>

                                                {!! Form::close() !!}
                                            </td>
                                        </tr>    
                                        @endforeach
                                        
                                    </tbody>
                                </table>

                            {{ $categories->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection