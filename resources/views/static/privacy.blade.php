<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cabin&family=Tinos&display=swap"
          rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Styles -->
    <script src="https://kit.fontawesome.com/0bb69a1b42.js" crossorigin="anonymous"></script>

    {{--    @livewireStyles--}}
</head>

<body class="font-sans antialiased">
<div class="container mt-5">
    <div class="col-lg-8 col-md-10">

        <h1 class="mb-4">Privacy Policy</h1>
        <p>Welcome to WorkIN, the official job search portal of the Provincial Government of Ilocos Norte. Your privacy
            is important to us. This Privacy Policy outlines how we collect, use, and protect your personal information
            in compliance with Philippine laws, including the <strong>Data Privacy Act of 2012 (RA 10173)</strong>.</p>

        <hr>

        <h3 class="mt-4">1. Information We Collect</h3>
        <ul>
            <li><strong>Personal Information:</strong> Name, contact details (email, phone number), address, and other
                information you provide when creating an account or applying for jobs.
            </li>
            <li><strong>Job Preferences:</strong> Employment history, educational background, skills, and other
                job-related details you provide.
            </li>
            <li><strong>Usage Data:</strong> IP address, browser type, device information, and activity on the portal.
            </li>
        </ul>

        <h3 class="mt-4">2. How We Use Your Information</h3>
        <ul>
            <li>Facilitate your job search and application process.</li>
            <li>Connect you with potential employers.</li>
            <li>Improve and personalize your experience on WorkIN.</li>
            <li>Communicate important updates, job opportunities, or system changes.</li>
        </ul>

        <h3 class="mt-4">3. Legal Basis for Processing</h3>
        <p>We process your personal information in accordance with the <strong>Data Privacy Act of 2012 (RA
                10173)</strong> and other applicable Philippine laws. The collection and use of your data are based on
            your consent, compliance with legal obligations, or legitimate government and organizational interests.</p>

        <h3 class="mt-4">4. Sharing of Information</h3>
        <p>Your personal information may be shared with:</p>
        <ul>
            <li><strong>Employers:</strong> When you apply for a job, your details are shared with the hiring
                organization.
            </li>
            <li><strong>Service Providers:</strong> Third-party services that help us operate the portal, such as
                hosting or analytics tools.
            </li>
            <li><strong>Government Agencies:</strong> When required by law or to comply with legal processes.</li>
        </ul>
        <p>We do not sell or share your personal data with unauthorized third parties.</p>

        <h3 class="mt-4">5. Data Security</h3>
        <p>We implement organizational, physical, and technical security measures as required by the <strong>Data
                Privacy Act of 2012</strong> to protect your information from unauthorized access, alteration, or
            disclosure. However, no system is completely secure, and we cannot guarantee absolute security.</p>

        <h3 class="mt-4">6. Your Rights</h3>
        <p>Under the <strong>Data Privacy Act of 2012</strong>, you have the right to:</p>
        <ul>
            <li>Be informed about how your data is processed.</li>
            <li>Access and update your personal information.</li>
            <li>Request deletion or correction of inaccurate data.</li>
            <li>Withdraw consent for us to process your data.</li>
        </ul>

        <h3 class="mt-4">7. Changes to This Privacy Policy</h3>
        <p>We may update this Privacy Policy from time to time to reflect changes in Philippine laws, our practices, or
            our portal. Changes will be posted on this page, and we encourage you to review it regularly.</p>

        <h3 class="mt-4">8. Contact Us</h3>
        <p>If you have any questions or concerns about this Privacy Policy or your data privacy rights, please contact
            us:</p>
        <ul>
            <li><strong>Provincial Public Employment Services Office</strong></li>
            <li><strong>Email:</strong> ilocosnortepeso2020@gmail.com</li>
            <li><strong>Phone:</strong> +693267084834</li>
        </ul>
        <p class=" mt-4">Thank you for trusting WorkIN with your job search needs.</p>
    </div>
</div>
</body>

</html>

