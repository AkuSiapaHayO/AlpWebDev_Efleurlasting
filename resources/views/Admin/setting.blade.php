@extends('layouts.app')

@section('content')
    <div class="container">
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
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Registered Users</h5>
                                <h6 class="card-subtitle mb-3 text-body-secondary">View all registered users</h6>
                                <a href="#" class="card-link">View</a>
                            </div>
                        </div>
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
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Order History
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <p>
                            Review and Explore past order history in this section. Stay informed about the purchasing
                            patterns and preferences of users.
                        </p>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
