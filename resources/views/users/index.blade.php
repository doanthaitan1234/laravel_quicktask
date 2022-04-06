@extends('layouts.adminLayout')

@section('content')
<div class="row user">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <a class="btn btn-info btn-fill" href="">{{ __('Create') }} {{ __('User') }}</a>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>{{ __('Full Name') }}</th>
                        <th>{{ __('User Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td><a href="" class="text-dark">{{ $user->full_name }} </a></td>
                            <td><a href="" class="text-dark">{{ $user->username }} </a></td>
                            <td>{{ $user->email }}</td>

                            @if ($user->isActive == App\Defines\Define::ACTIVE)
                                <td class="bg-success">{{ __('Active') }}</td>
                            @else
                                <td class="bg-danger">{{ __('Deactive') }}</td>
                            @endif

                            <td>
                                <a href="{{ route('tasks.get_tasks_by_user_id', $user->id) }}" class="text-dark btn-action-custom" data-toggle="tooltip" title="{{ __('Task') }}">
                                    <i class="fa fa-tasks fa-lg text-success" aria-hidden="true"></i></a>
                                <a href="{{ route('users.edit', $user->id) }}" class="text-dark" data-toggle="tooltip" title="{{ __('Edit') }}">
                                    <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                                <a href="{{ route('users.destroy', $user->id) }}" class="text-dark" data-toggle="tooltip" title="{{ __('Remove') }}">
                                    <i class="fa fa-trash fa-lg text-danger" aria-hidden="true"></i></a>
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
