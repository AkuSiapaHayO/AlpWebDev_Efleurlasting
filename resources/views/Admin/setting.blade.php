@extends('layouts.app')

@section('content')
    <div class="container mt-4 vh-100">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        User Information
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <p>
                            This section provides details about the user, including their username, email, password,
                            name, gender, age, birthdate, phone, address, role, and login status. As an admin, you have
                            access to view all the information related to the users registered on the platform.
                        </p>
                        <p>
                            Please use this section <span class="text-danger">responsibly</span> and ensure the security and
                            privacy of user data.
                        </p>
                        <a href="{{ route('user.view') }}" class="card-link">
                            <button class="btn btn-outline-primary">Manage Users</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Product Information
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <p>
                            Explore and manage your products in this section. View details about various products
                            available
                            on the platform. Add, edit, or remove products as needed to keep the product catalog up to date.
                        </p>
                        <a href="{{ route('products.view') }}" class="card-link">
                            <button class="btn btn-outline-primary">Manage Products</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        All Orders
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <p>
                            Explore and manage all orders placed on your platform. This section provides a comprehensive view
                            of order history, allowing you to track completed orders and those that are still pending. Stay informed
                            about purchasing patterns and user preferences to enhance your admin insights.
                        </p>
                        <a href="{{ route('orders.view') }}" class="card-link">
                            <button class="btn btn-outline-primary">View All Orders</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        Payment Approval
                    </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <p>
                            This section is dedicated to payment approval. Review and approve pending payments, ensuring a
                            smooth
                            and secure financial transaction process. Stay vigilant to prevent fraudulent activities.
                        </p>
                        <a href="{{ route('payment.view') }}"><button class="btn btn-outline-primary">Approve Payment</button></a>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                        Website Information
                    </button>
                </h2>
                <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <p>
                            Admins can use this section to manage the content of the homepage carousel. Edit and update the
                            images
                            and text displayed on the carousel to ensure an engaging and dynamic user experience for
                            visitors.
                        </p>
                        <p>
                            Please review and modify the carousel content responsibly, keeping the website's aesthetics and
                            overall user appeal in mind.
                        </p>
                        <a href="{{ route('carousel.view') }}"><button class="btn btn-outline-primary">Edit
                                Carousel</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
