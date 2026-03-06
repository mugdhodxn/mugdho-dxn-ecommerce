@extends('layouts.app')

@section('title', 'Contact Us - Mugdho DXN')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Contact Us</h1>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Get in Touch</h4>
                    
                    <div class="mb-4">
                        <h6><i class="fas fa-phone text-primary"></i> Phone</h6>
                        <p>+880 1XXX-XXXXXX</p>
                    </div>
                    
                    <div class="mb-4">
                        <h6><i class="fas fa-envelope text-primary"></i> Email</h6>
                        <p>info@mugdhodxn.com</p>
                    </div>
                    
                    <div class="mb-4">
                        <h6><i class="fas fa-map-marker-alt text-primary"></i> Address</h6>
                        <p>Dhaka, Bangladesh</p>
                    </div>
                    
                    <div class="mb-4">
                        <h6><i class="fas fa-clock text-primary"></i> Business Hours</h6>
                        <p>Saturday - Thursday: 9:00 AM - 8:00 PM<br>
                        Friday: Closed</p>
                    </div>
                    
                    <div>
                        <h6 class="mb-3">Follow Us</h6>
                        <a href="#" class="btn btn-primary me-2"><i class="fab fa-facebook"></i> Facebook</a>
                        <a href="#" class="btn btn-success me-2"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                        <a href="#" class="btn btn-danger"><i class="fab fa-instagram"></i> Instagram</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Send us a Message</h4>
                    
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" rows="5" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
