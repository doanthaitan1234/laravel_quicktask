@extends('layouts.adminLayout')

@section('content')
    <div class="row user">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <a class="btn btn-info btn-fill" href="{{ route('users.create') }}">{{ __('Create') }}
                        {{ __('User') }}</a>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>{{ __('Full Name') }}</th>
                            <th>{{ __('User Name') }}</th>
                            <th class="ps-6">{{ __('Email') }}</th>
                            <th class="text-center">{{ __('Status') }}</th>
                            <th class="text-center">{{ __('Role') }}</th>
                            <th class="text-center">{{ __('Action') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><a href="" class="text-dark">{{ $user->full_name }} </a></td>
                                    <td><a href="" class="text-dark">{{ $user->user_name }} </a></td>
                                    <td>{{ $user->email }}</td>
                                    @if ($user->isAdmin == App\Defines\Define::ADMIN)
                                        <td class="text-center">{{ __('Admin') }}</td>
                                    @else
                                        <td class="text-center">{{ __('User') }}</td>
                                    @endif
                                    @if ($user->isActive == App\Defines\Define::ACTIVE)
                                        <td class="bg-success text-center">{{ __('Active') }}</td>
                                    @else
                                        <td class="bg-danger text-center">{{ __('Deactive') }}</td>
                                    @endif

                                    <td class="text-center d-flex justify-content-around">
                                        <a href="{{ route('tasks.get_tasks_by_user_id', $user->id) }}"
                                            class="text-dark btn-action-custom" data-toggle="tooltip"
                                            title="{{ __('Task') }}">
                                            <i class="fa fa-tasks fa-lg text-success" aria-hidden="true"></i></a>

                                        <a href="{{ route('users.edit', $user->id) }}" class=" me-1"
                                            data-toggle="tooltip" title="{{ __('Edit') }}">
                                            <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                                        <form id="deleteForm" action="{{ route('users.destroy', $user->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a class="text-dark border-none bg-none btn-delete" data-toggle="tooltip"
                                                title="{{ __('Remove') }}">
                                                <i class="fa fa-trash fa-lg text-danger" aria-hidden="true"></i></a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
