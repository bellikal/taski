@extends('layouts.master')

@section('title', 'Contact Us')

@section('content')

    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col">
                <h2>Contact Our Taski Team</h2>
                <p>We're here to assist you. Please feel free to reach out to us with any questions or feedback you may have.</p>
            </div>
        </div>

        {{-- Contact form (inactive) --}}
        <div class="row mb-4">
            <div class="col-md-6">
                <h3>Contact Form</h3>
                <form action="" method="">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
            <div class="col-md-6">
                <h3>Contact Information</h3>
                <p>If you prefer other means of communication, you can reach us at:</p>
                <ul>
                    <li><strong>Email:</strong> contact@taski.com</li>
                    <li><strong>Phone:</strong> +1 (123) 456-7890</li>
                    <li><strong>Address:</strong> 123 Task Street, Taskville, TX 12345, USA</li>
                </ul>
            </div>
        </div>

        {{-- Location Card --}}
        <div class="row">
            <div class="col">
                <h3>Our Location</h3>
                <p>Find us on the map below:</p>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12345.67890!2d-123.456789!3d12.3456789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDA5JzU0LjkiTiAxMjPCsDE2JzI4LjgiRQ!5e0!3m2!1sen!2sus!4v1234567890"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>

@endsection
