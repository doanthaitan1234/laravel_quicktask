@extends('layouts.adminLayout')

@section('content')
    <div class="row task">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4>{{ isset($task) ? __('Update') : __('Add') }} {{ __('Task') }}</h4>
                  
                    <hr>
                </div>
                <div class="content text-center row">
                    <form name="add-task-form" id="add-task-form" method="post"
                        action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}">
                        @csrf
                        @if (isset($task))
                            @method('PUT')
                        @endif
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="user_id">{{ __('User') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="user_id" id="" class="form-control">
                                            @if (isset($task))
                                            @foreach (App\Helpers\Custom::getAllUsers() as $user)
                                            <option value="{{ $user->id }}"
                                                @if ($task->user_id == $user->id) selected @endif>
                                                {{ $user->full_name }}</option>
                                                @endforeach
                                            @endif
                                            @if (isset($user_id))
                                            @foreach (App\Helpers\Custom::getAllUsers() as $user)
                                            <option value="{{ $user->id }}"
                                                @if ($user_id == $user->id) selected @endif>
                                                {{ $user->full_name }}</option>
                                                @endforeach
                                            @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="title">{{ __('Title') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="title"
                                        @if (isset($task)) value="{{ old('title', $task->title) }}" @else value="{{ old('title') }}" @endif
                                        class="form-control col-6" required>
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="description">{{ __('description') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="description" class="form-control"
                                        required>{{ isset($task) ? old('description', $task->description) : old('description') }}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="start_time">{{ __('Start Time') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" name="start_time"
                                        @if (isset($task)) value="{{ old('start_time', $task->start_time) }}" @else value="{{ old('start_time') }}" @endif
                                        class="form-control" min="{{ App\Helpers\Custom::getDateNow() }}" required>
                                    @error('start_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="end_time">{{ __('End Time') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" name="end_time"
                                        @if (isset($task)) value="{{ old('end_time', $task->end_time) }}" @else value="{{ old('end_time') }}" @endif
                                        class="form-control" required>
                                    @error('end_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @if (isset($task))
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label for="status">{{ __('Status') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="status" id="" class="form-control">
                                            <option value="0" @if (isset($task) && $task->status == 0) selected @endif>
                                                {{ _('New') }}</option>
                                            <option value="1" @if (isset($task) && $task->status == 1) selected @endif>
                                                {{ _('Inprogress') }}</option>
                                            <option value="1" @if (isset($task) && $task->status == 2) selected @endif>
                                                {{ _('Done') }}</option>
                                        </select>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="status" value="0">
                            @endif
                            <div class="text-right">
                                <button type="submit"
                                    class="btn btn-primary btn-submit me-1">{{ isset($task) ? __('Update') : __('Add') }}</button>
                                <a href="{{ route('users.index') }}" class="btn btn-cancel">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
