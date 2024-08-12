{{--<x-guest-layout>--}}
{{--    <form method="POST" action="{{ route('password.store') }}">--}}
{{--        @csrf--}}

{{--        <!-- Password Reset Token -->--}}
{{--        <input type="hidden" name="token" value="{{ $request->route('token') }}">--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}
{{--            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />--}}
{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                                type="password"--}}
{{--                                name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <x-primary-button>--}}
{{--                {{ __('Reset Password') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}


@extends('frontend.layout.master')

@section('title')
    {{$settings->site_name}} || Reset-Password
@endsection
@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>change password</h4>
                        <ul>
                            <li><a href="{{ route('login') }}">login</a></li>
                            <li><a href="#">change password</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CHANGE PASSWORD START
    ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-7 m-auto">
                    <form method="post" action="{{route('password.store')}}">
                        @csrf
                        <div class="wsus__change_password">
                            <h4>change password</h4>
                            <input type="hidden" name="token" value="{{$request->route('token')}}">
                            <div class="wsus__single_pass">
                                <label>email</label>
                                <input type="text" name="email" id="email" value="{{old('email',$request->email)}}" placeholder="Current Password">
                            </div>
                            <div class="wsus__single_pass">
                                <label>new password</label>
                                <input type="text" name="password" id="password" placeholder="New Password">
                            </div>
                            <div class="wsus__single_pass">
                                <label>confirm password</label>
                                <input type="text" name="password_confirmation" placeholder="Confirm Password">
                            </div>
                            <button class="common_btn" type="submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CHANGE PASSWORD END
    ==============================-->
@endsection
