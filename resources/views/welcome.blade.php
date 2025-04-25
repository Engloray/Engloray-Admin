<!-- resources/views/contact_form.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Engloray</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h2>Contact Us</h2>

    <form id="contactForm">
        <input type="text" name="name" placeholder="Your Name" required><br><br>
        <input type="email" name="email" placeholder="Your Email" required><br><br>
        <input type="text" name="phone_no" placeholder="Phone Number"><br><br>
        <textarea name="message" placeholder="Message..."></textarea><br><br>
        <button type="submit">Send</button>
    </form>

    <div id="responseMsg" style="margin-top:20px;"></div>

    <script>
        $(document).ready(function() {
            $('#contactForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route("contact.store") }}', // Define this route in web.php
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#responseMsg').html('<span style="color:green;">' + response.message + '</span>');
                        $('#contactForm')[0].reset();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = '<ul style="color:red;">';
                        $.each(errors, function(key, val) {
                            errorMsg += '<li>' + val[0] + '</li>';
                        });
                        errorMsg += '</ul>';
                        $('#responseMsg').html(errorMsg);
                    }
                });
            });
        });
    </script>

</body>
</html>
