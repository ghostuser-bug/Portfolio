<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Gadget Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <!-- Hero Section -->
  <section class="py-5 bg-primary text-white text-center">
    <div class="container">
      <h1 class="display-4">Contact Us</h1>
      <p class="lead">We're here to help! Reach out with any questions or concerns.</p>
    </div>
  </section>

  <!-- Contact Form & Information Section -->
  <section id="contact" class="py-5 bg-light">
    <div class="container">
      <div class="row g-5">
        <!-- Contact Form -->
        <div class="col-lg-6">
          <h2 class="mb-4">Get in Touch</h2>
          <form action="contact_process.php" method="POST">
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="subject" class="form-label">Subject</label>
              <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
          </form>
        </div>

        <!-- Visit Us Section -->
        <div class="col-lg-6">
          <h2 class="mb-4">Visit Us</h2>
          <div class="mb-4">
            <i class="bi bi-geo-alt-fill me-2 text-primary"></i>
            <strong>Address:</strong> Gadget Store My, Setapak, Setapak Center, CA
          </div>
          <div class="mb-4">
            <i class="bi bi-envelope-fill me-2 text-primary"></i>
            <strong>Email:</strong> gadgetstoremy@gmail.com
          </div>
          <div class="mb-4">
            <i class="bi bi-telephone-fill me-2 text-primary"></i>
            <strong>Phone:</strong> +60 123456778
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Q&A Section -->
  <section id="qna" class="py-5">
    <div class="container">
      <h2 class="text-center mb-5">Frequently Asked Questions</h2>
      <div class="accordion" id="faqAccordion">
        <!-- Q1 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              What is the return policy?
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              We offer a 30-day return policy on all our products. For more details, visit our <a href="return_exchange.php">Return and Exchange</a> page.
            </div>
          </div>
        </div>

        <!-- Q2 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Do you offer a warranty?
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              Yes, all our products come with a 1-year warranty. Please check our <a href="warranty_information.php">Warranty Information</a> page for more details.
            </div>
          </div>
        </div>

        <!-- Q3 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Can I track my order?
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              Yes, you can track your order using the tracking ID provided in your order confirmation email. Visit our <a href="order_tracking.php">Order Tracking</a> page.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
