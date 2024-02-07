@extends('layouts.master')

@section('title', 'About Us')

@section('content')

    {{-- About Us Section --}}
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col">
                <h2>About Taski</h2>
                <p>We are dedicated to providing you with a powerful and user-friendly task management solution.</p>
            </div>
        </div>

        {{-- Team Section --}}
        <div class="row mb-4">
            <div class="col">
                <h3>Our Team</h3>
                <p>Meet the team behind the application:</p>
                <ul>
                    <li><strong>John Doe</strong> - Founder and CEO</li>
                    <li><strong>Belgüzar Kal</strong> - Lead Developer</li>
                    <li><strong>Mary Johnson</strong> - UX Designer</li>
                    <li><strong>David Brown</strong> - Marketing Specialist</li>
                </ul>
            </div>
        </div>

        {{-- Mission and Vision Section --}}
        <div class="row">
            <div class="col">
                <h3>Our Mission</h3>
                <p>Our mission is to help individuals and teams achieve greater productivity and organization by providing a reliable task management solution.</p>
                <h3>Our Vision</h3>
                <p>We envision a world where everyone can efficiently manage their tasks, collaborate seamlessly, and accomplish their goals.</p>
            </div>
        </div>
    </div>

@endsection
