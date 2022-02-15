@extends('layouts.host')


@section('content')
    <h1>Apartments</h1>
    <a name="" id="" class="btn btn-primary text-white float-end" style="margin-right: 150px;"
        href="{{ route('host.apartments.create') }}" role="button">Create
        apartment</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cover</th>
                <th>Title</th>
                <th>Body</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tslug>
            @foreach ($apartments as $apartment)
                <tr>
                    <td scope="row">{{ $apartment->id }}</td>
                    <td><img width="100" src="{{ $apartment->image }}" alt=""></td>
                    <td class="col-3">{{ $apartment->title }}</td>
                    <td class="text-truncate" style="max-width: 300px;">{{ $apartment->description }}</td>
                    <td class="col-2">
                        <a href="{{ route('host.apartments.show', $apartment->id) }}"><i
                                class="fas fa-eye fa-lg fa-fw "></i></a>
                        <a href="{{ route('host.apartments.edit', $apartment->id) }}"> <i
                                class="fas fa-pencil-alt fa-lg fa-fw"></i></a>

                        <!-- Button trigger modal -->
                        <a data-bs-toggle="modal" data-bs-target="#delete{{ $apartment->id }}">
                            <i class="fas fa-trash fa-lg fa-fw text-danger"></i>
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="delete{{ $apartment->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modal-{{ $apartment->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete apartment {{ $apartment->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Vuoi davvero cancellare l'appartmento?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('host.apartments.destroy', $apartment->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tslug>
    </table>
    {{ $apartments->links() }}
@endsection
