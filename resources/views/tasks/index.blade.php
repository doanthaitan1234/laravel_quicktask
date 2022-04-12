@extends('layouts.adminLayout')

@section('content')
    <div class="row task">
        <div class="col-md-12">
            <div class="card">
                <div class="header">

                    <?php
                    if (isset($user_id)) {
                        $routeCreate = route('tasks.create', $user_id);
                    } else {
                        $routeCreate = route('tasks.create', Auth::user()->id);
                    }
                    ?>
                    <a href="{{  $routeCreate }}" class="btn btn-info btn-fill">{{ __('Create') }}
                        {{ __('Task') }}</a>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th class="text-center">{{ __('Action') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td class="text-oneline">{{ $task->description }}</td>
                                    <td>{{ $task->first_name }} {{ $task->last_name }}</td>

                                    @if ($task->status == App\Defines\Define::OPEN)
                                        <td class="bg-success text-center">{{ __('Open') }}</td>
                                    @elseif ($task->status == App\Defines\Define::INPROGRESS)
                                        <td class="bg-warning text-center">{{ __('Inprogress') }}</td>
                                    @else
                                        <td class="bg-primary text-center">{{ __('Done') }}</td>
                                    @endif

                                    <td class="text-center d-flex justify-content-around">
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="me-1"
                                            data-toggle="tooltip" title="{{ __('Edit') }}">
                                            <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                                        <form id="deleteForm" action="{{ route('tasks.destroy', $task->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a class="text-dark border-none bg-none btn-delete" data-toggle="tooltip"
                                                title="{{ __('Remove') }}">
                                                <i class="fa fa-trash fa-lg text-danger" aria-hidden="true"></i></a>
                                        </form>
                                    </td>
                                    {{-- href="{{ route('tasks.destroy', $task->id) }}" --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
