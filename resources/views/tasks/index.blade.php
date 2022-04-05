@extends('layouts.adminLayout')

@section('content')
<div class="row task">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <a class="btn btn-info btn-fill">{{ __('Create') }} {{ __('Task') }}</a>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td class="text-oneline">{{ $task->description }}</td>

                            @if ($task->status == App\Defines\Define::OPEN)
                                <td class="bg-success">{{ __('Open') }}</td>
                            @elseif ($task->status == App\Defines\Define::INPROGRESS)
                                <td class="bg-warning">{{ __('Inprogress') }}</td>
                                @else
                                <td class="bg-primary">{{ __('Done') }}</td>
                            @endif

                            <td class="w-25" style="width: 15%">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-dark" data-toggle="tooltip" title="{{ __('Edit') }}">
                                    <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                                <a href="{{ route('tasks.destroy', $task->id) }}" class="text-dark" data-toggle="tooltip" title="{{ __('Remove') }}">
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
