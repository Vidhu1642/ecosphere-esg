@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<style>
    .contact-section{
    padding: 80px 0;
    background: #f8faf8;
}

.contact-grid{
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 40px;
    align-items: stretch;
}

.contact-map{
    min-height: 650px;
    overflow: hidden;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,.1);
}

.contact-map iframe{
    width: 100%;
    height: 100%;
    border: 0;
}

.contact-panel{
    background: #fff;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
    display: flex;
    flex-direction: column;
}

.contact-form{
    margin-top: 25px;
}

.form-row{
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 15px;
}

.contact-form input,
.contact-form textarea{
    width: 100%;
    padding: 14px 18px;
    border: 1px solid #dcdcdc;
    border-radius: 10px;
    font-size: 15px;
    outline: none;
}

.contact-form textarea{
    resize: none;
    margin-bottom: 20px;
}

.contact-form button{
    width: 100%;
    background: #198754;
    color: #fff;
    border: none;
    padding: 14px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: .3s;
}

.contact-form button:hover{
    background: #157347;
}

@media(max-width:991px){

    .contact-grid{
        grid-template-columns: 1fr;
    }

    .contact-map{
        height: 400px;
    }

    .form-row{
        grid-template-columns: 1fr;
    }
}
</style>


<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <!-- Google Map -->
            <div class="contact-map">
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15881.26570053876!2d73.26934415729087!3d22.29582197503419!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395fdab258d35d99%3A0x76b6db4f3b69e39!2sAkshar%20Yug%20Society%2C%20Shripore%20Timbi%2C%20Gujarat%20390019!5e1!3m2!1sen!2sin!4v1783855989801!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
            </div>

            <!-- Contact Details + Form -->
            <div class="contact-panel">
                <div class="eyebrow">Get in Touch</div>
                <h2>We'd Love to Hear From You</h2>
    

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Contact Form --}}
                <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                    @csrf

                    <div class="form-row">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name *" required>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address *" required>
                    </div>

                    <textarea name="message" rows="6" placeholder="Write your message..." required>{{ old('message') }}</textarea>

                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>


@endsection