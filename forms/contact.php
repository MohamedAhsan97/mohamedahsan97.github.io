<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    // Validate the fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Set the recipient email address (change this to your email address)
    $to = "mohamedmam@uni.coventry.ac.uk";
    
    // Set email subject
    $email_subject = "Contact Form: " . $subject;
    
    // Set email message
    $email_message = "You have received a new message from the contact form on your website.\n\n";
    $email_message .= "Name: " . $name . "\n";
    $email_message .= "Email: " . $email . "\n\n";
    $email_message .= "Message:\n" . $message . "\n";
    
    // Set email headers
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Send the email
    if (mail($to, $email_subject, $email_message, $headers)) {
        // Email sent successfully
        echo "Message sent successfully.";
    } else {
        // Email failed to send
        echo "There was an error sending your message. Please try again.";
    }
} else {
    // If the form isn't submitted, redirect to the form page
    header("Location: contact.html");
    exit;
}
?>
