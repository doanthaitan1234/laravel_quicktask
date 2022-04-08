@extends('layouts.adminLayout')

@section('content')
    <div class="row user">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4>{{ isset($user) ? __('Update') : __('Add') }} {{ __('User') }}</h4>
                    <hr>
                </div>
                <div class="content text-center row">
                    <form name="add-user-form" id="add-user-form" method="post"
                        action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}">
                        @csrf
                        @if (isset($user))
                            @method('PATCH')
                        @endif
                        <div class="col-md-5">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="first_name">{{ __('First Name') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="first_name"
                                        @if (isset($user)) value="{{ old('first_name', $user->first_name) }}" @endif
                                        class="form-control col-6" required>
                                    @error('first_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="last_name">{{ __('Last Name') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="last_name"
                                        @if (isset($user)) value="{{ old('last_name', $user->last_name) }}" @endif
                                        class="form-control" required>
                                    @error('last_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="email">{{ __('Email') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" name="email"
                                        @if (isset($user)) value="{{ old('email', $user->email) }}" @endif
                                        class="form-control" required>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="user_name">{{ __('User Name') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="user_name"
                                        @if (isset($user)) value="{{ old('user_name', $user->user_name) }}" @endif
                                        class="form-control" required>
                                    @error('user_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="password">{{ __('Password') }}</label>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-8">
                                    <input type="password" name="password" class="form-control" @if(!isset($user)) required @endif>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="password_confirmation">{{ __('Confirm password') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="password" name="password_confirmation" class="form-control" @if(!isset($user)) required @endif>
                                    @error('password_confirmation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @if (!isset($user) || $user->id != Auth::user()->id)
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label for="isAdmin">{{ __('Role') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="isAdmin" id="" class="form-control">
                                            <option value="0"
                                                @if (isset($user) && $user->isAdmin == 0) selected @else default @endif>
                                                {{ _('User') }}</option>
                                            <option value="1" @if (isset($user) && $user->isAdmin == 1) selected @endif>
                                                {{ _('Admin') }}</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                            @if (isset($user) && $user->id != Auth::user()->id)
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label for="isActive">{{ __('Role') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="isActive" id="" class="form-control">
                                            <option value="0" @if (isset($user) && $user->isActive == 0) selected @endif>
                                                {{ _('Deactive') }}</option>
                                            <option value="1" @if (isset($user) && $user->isActive == 1) selected @endif>
                                                {{ _('Active') }}</option>
                                        </select>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="isActive" value="1">
                            @endif
                        </div>
                        <div class="col-md-2">
                            <div>
                                <button type="submit"
                                    class="btn btn-primary btn-submit">{{ isset($user) ? __('Update') : __('Add') }}</button>
                            </div>
                            <div>
                                <a href="{{ route('users.index') }}"
                                    class="btn btn-cancel mt-1">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
