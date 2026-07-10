<?php

/*
|--------------------------------------------------------------------------
| Site Content Catalog
|--------------------------------------------------------------------------
| Defines every editable text/image on the public site, grouped by page
| and section. Values edited from the admin "Site Settings" screen are
| stored in the site_settings table; anything not edited falls back to
| the defaults below. Image defaults are paths relative to public/.
*/

$text = fn (string $label, string $default) => ['label' => $label, 'type' => 'text', 'default' => $default];
$textarea = fn (string $label, string $default) => ['label' => $label, 'type' => 'textarea', 'default' => $default];
$image = fn (string $label, string $default) => ['label' => $label, 'type' => 'image', 'default' => $default];

$loremService = 'Lorem ipsum dolor sit amet the consectetur adipiscing elit entesque hendrerit elit nisan lacinia feugiat nunc eu aucton.';
$loremTestimonial = 'Lorem posuere in miss drana en the nisan semere sceriun amiss etiam ornare in the miss drana is lorem fermen nunta urnase mauris in the interdum.';
$loremDetail = 'Lorem pretium fermentum quam, sit amet cursus ante sollicitudin velen morbi consesua rana the miss sustion consation porttitor orci sit amet iaculis nisan. Lorem pretium fermentum quam sit amet cursus ante solicitune velention fermen morbinetion consesua the risus the porttiton.';

// Home slider slides
$sliderFields = [];
foreach ([
    1 => ['Bentley Bentayga', '$600', 'assets/img/slider/11.jpg'],
    2 => ['Rolls Royce Cullinan', '$900', 'assets/img/slider/12.jpg'],
    3 => ['Audi RS7 Sportback', '$450', 'assets/img/slider/14.jpg'],
] as $i => [$car, $price, $img]) {
    $sliderFields["home.slider.slide{$i}_subtitle"] = $text("Slide {$i} - Subtitle", '* Premium');
    $sliderFields["home.slider.slide{$i}_title"] = $text("Slide {$i} - Title", 'Rental Car');
    $sliderFields["home.slider.slide{$i}_car"] = $text("Slide {$i} - Car Name", $car);
    $sliderFields["home.slider.slide{$i}_price"] = $text("Slide {$i} - Price (per day)", $price);
    $sliderFields["home.slider.slide{$i}_image"] = $image("Slide {$i} - Background Image", $img);
}

// Home car categories
$categoryFields = [
    'home.categories.subtitle' => $text('Section Subtitle', 'Categories'),
    'home.categories.title' => $text('Section Title', 'Rental'),
    'home.categories.title_colored' => $text('Section Title (colored part)', 'Car Types'),
];
foreach ([
    1 => ['Luxury Cars', 'assets/img/cars/03.jpg'],
    2 => ['Sport Cars', 'assets/img/cars/04.jpg'],
    3 => ['SUV', 'assets/img/cars/02.jpg'],
    4 => ['Convertible', 'assets/img/cars/01.jpg'],
    5 => ['Sedan', 'assets/img/cars/05.jpg'],
    6 => ['Small Cars', 'assets/img/cars/06.jpg'],
] as $i => [$title, $img]) {
    $categoryFields["home.categories.item{$i}_title"] = $text("Category {$i} - Title", $title);
    $categoryFields["home.categories.item{$i}_image"] = $image("Category {$i} - Image", $img);
}

// Home rental process steps
$processFields = [
    'home.process.subtitle' => $text('Section Subtitle', 'Steps'),
    'home.process.title' => $text('Section Title', 'Car Rental'),
    'home.process.title_colored' => $text('Section Title (colored part)', 'Process'),
];
foreach ([
    1 => ['Choose A Car', 'View our range of cars, find your perfect car for the coming days.'],
    2 => ['Come In Contact', 'Our advisor team is ready to help you with the booking process or any questions.'],
    3 => ['Enjoy Driving', 'Receive the key and enjoy your car. We treat all our cars with respect.'],
] as $i => [$title, $body]) {
    $processFields["home.process.step{$i}_title"] = $text("Step {$i} - Title", $title);
    $processFields["home.process.step{$i}_text"] = $textarea("Step {$i} - Text", $body);
}
$processFields['home.process.note'] = $text('Bottom Note', "If you've never rented a car before, we'll guide you through the process.");

// Home blog posts
$blogFields = [
    'home.blog.subtitle' => $text('Section Subtitle', 'Our Blog'),
    'home.blog.title' => $text('Section Title', 'Latest'),
    'home.blog.title_colored' => $text('Section Title (colored part)', 'News'),
];
foreach ([
    1 => ['Rental', 'Documents required for car rental', '29', 'Apr', 'assets/img/blog/3.jpg'],
    2 => ['Sport Cars', 'Rental cost of sport and other cars', '27', 'Apr', 'assets/img/blog/4.jpg'],
    3 => ['Fines', 'Rental cars how to check driving fines?', '25', 'Apr', 'assets/img/blog/5.jpg'],
    4 => ['Airport', 'How to Rent a Car at the Airport Terminal?', '23', 'Apr', 'assets/img/blog/6.jpg'],
    5 => ['Rules', 'Penalties for violating the rules in rental cars', '22', 'Apr', 'assets/img/blog/7.jpg'],
    6 => ['Rental Car', 'How to check a car before renting?', '20', 'Apr', 'assets/img/blog/8.jpg'],
] as $i => [$tag, $title, $day, $month, $img]) {
    $blogFields["home.blog.post{$i}_tag"] = $text("Post {$i} - Tag", $tag);
    $blogFields["home.blog.post{$i}_title"] = $text("Post {$i} - Title", $title);
    $blogFields["home.blog.post{$i}_day"] = $text("Post {$i} - Day", $day);
    $blogFields["home.blog.post{$i}_month"] = $text("Post {$i} - Month", $month);
    $blogFields["home.blog.post{$i}_image"] = $image("Post {$i} - Image", $img);
}

// About page team members
$teamFields = [
    'about.team.subtitle' => $text('Section Subtitle', 'Certified Team'),
    'about.team.title' => $text('Section Title', 'Our Experts Team'),
];
foreach ([
    1 => ['Dan Martin', 'Sales Consultant', 'assets/img/team/1.jpg'],
    2 => ['Emily Arla', 'Sales Consultant', 'assets/img/team/4.jpg'],
    3 => ['Oliva White', 'Sales Consultant', 'assets/img/team/5.jpg'],
    4 => ['Margaret Nancy', 'Sales Department', 'assets/img/team/2.jpg'],
    5 => ['Mia Jane', 'Finance Department', 'assets/img/team/6.jpg'],
    6 => ['Micheal Brown', 'Sales Consultant', 'assets/img/team/3.jpg'],
] as $i => [$name, $role, $img]) {
    $teamFields["about.team.member{$i}_name"] = $text("Member {$i} - Name", $name);
    $teamFields["about.team.member{$i}_role"] = $text("Member {$i} - Role", $role);
    $teamFields["about.team.member{$i}_image"] = $image("Member {$i} - Photo", $img);
}

// Services page "Other Services"
$otherServiceFields = [
    'services.other.subtitle' => $text('Section Subtitle', 'What We Do'),
    'services.other.title' => $text('Section Title', 'Other Services'),
];
foreach ([1 => 'Daily Car Rental', 2 => 'Monthly Car Rental', 3 => 'Annual Car Rental'] as $i => $title) {
    $otherServiceFields["services.other.item{$i}_title"] = $text("Item {$i} - Title", $title);
    $otherServiceFields["services.other.item{$i}_text"] = $textarea("Item {$i} - Text", $loremService);
}

// Service detail FAQs
$serviceFaqFields = [];
foreach ([1 => 'Security and Licensing', 2 => 'Local Currency and Tips', 3 => 'Communication', 4 => 'Accessibility'] as $i => $title) {
    $serviceFaqFields["service_detail.faqs.faq{$i}_title"] = $text("FAQ {$i} - Title", $title);
    $serviceFaqFields["service_detail.faqs.faq{$i}_text"] = $textarea("FAQ {$i} - Text", $loremDetail);
}

// Car detail rental conditions
$conditionFields = [
    'car_detail.conditions.heading' => $text('Section Heading', 'Rental Conditions'),
];
foreach ([
    1 => ['Contract and Annexes', 'In addition to the car rental contract to be signed at the time of delivery, a credit card is required from our individual customers. We request our commercial customers to submit their company documents (tax plate, signature slip, ID photocopy).'],
    2 => ['Driving License and Age', "The tenant must be 25 years of age and have a 5-year local or valid international driver's license for group A, B, C, D vehicles at the time of the rental agreement."],
    3 => ['Prices', 'Prices include maintenance and insurance guarantee against third parties (within legal policy limits). 18% VAT (value added tax) is not included. Fuel belongs to the renter. Chauffeur driven service and translator guide are available upon request.'],
    4 => ['Payments', 'The total rental fee is collected at the time of rental. The shortest rental period is 72 hours, and in case of delay, 1/3 of the fee is charged for each additional hour. Delays exceeding 3 hours in total are calculated as a full day. A deposit is required from a valid credit card.'],
    5 => ['Delivery', 'Delivery is free of charge where our Rent a car company is located. Delivery in these cities is possible with prior notice; hotel, workplace, station, port etc. It can be done in places. For vehicle deliveries and returns in cities where our office is not located, a delivery fee of 0.2 Euro/km is applied, starting from the rented location.'],
    6 => ['Traffic Fines', 'Traffic fines toll and illegal toll fees belong to the customer. If the vehicles are detained by traffic, this period is included in the rental period. In necessary cases, we may change these conditions and information and the vehicle type specified in the reservation without prior notice. Our vehicles cannot be taken abroad.'],
] as $i => [$title, $body]) {
    $conditionFields["car_detail.conditions.item{$i}_title"] = $text("Condition {$i} - Title", $title);
    $conditionFields["car_detail.conditions.item{$i}_text"] = $textarea("Condition {$i} - Text", $body);
}

// Shared services (used on home carousel, services page and service-detail sidebar)
$sharedServiceFields = [];
foreach ([
    1 => ['Corporate Car Rental', 'assets/img/services/1.jpg'],
    2 => ['Car Rental with Driver', 'assets/img/services/2.jpg'],
    3 => ['Airport Transfer', 'assets/img/services/3.jpg'],
    4 => ['Fleet Leasing', 'assets/img/services/4.jpg'],
    5 => ['VIP Transfer', 'assets/img/services/5.jpg'],
    6 => ['Private Transfer', 'assets/img/services/6.jpg'],
] as $i => [$title, $img]) {
    $sharedServiceFields["shared.services.item{$i}_title"] = $text("Service {$i} - Title", $title);
    $sharedServiceFields["shared.services.item{$i}_text"] = $textarea("Service {$i} - Description", $loremService);
    $sharedServiceFields["shared.services.item{$i}_image"] = $image("Service {$i} - Image", $img);
}

// Shared testimonials
$testimonialFields = [
    'shared.testimonials.subtitle' => $text('Section Subtitle', 'Testimonials'),
    'shared.testimonials.title' => $text('Section Title', 'What Clients Say'),
];
foreach ([
    1 => ['Dan Martin', 'assets/img/team/1.jpg'],
    2 => ['Olivia Brown', 'assets/img/team/4.jpg'],
    3 => ['Emily Martin', 'assets/img/team/6.jpg'],
] as $i => [$name, $img]) {
    $testimonialFields["shared.testimonials.item{$i}_text"] = $textarea("Testimonial {$i} - Text", $loremTestimonial);
    $testimonialFields["shared.testimonials.item{$i}_name"] = $text("Testimonial {$i} - Name", $name);
    $testimonialFields["shared.testimonials.item{$i}_role"] = $text("Testimonial {$i} - Role", 'Customer');
    $testimonialFields["shared.testimonials.item{$i}_image"] = $image("Testimonial {$i} - Photo", $img);
}

// Shared client logos
$clientFields = [];
for ($i = 1; $i <= 8; $i++) {
    $clientFields["shared.clients.logo{$i}"] = $image("Client Logo {$i}", "assets/img/clients/{$i}.png");
}

return [

    'pages' => [

        'global' => [
            'label' => 'Global (Navbar & Footer)',
            'sections' => [
                'navbar' => [
                    'label' => 'Navbar',
                    'fields' => [
                        'global.navbar.logo' => $image('Logo', 'assets/Logo_t.png'),
                        'global.navbar.help_text' => $text('Help Text', 'Need help?'),
                        'global.navbar.phone' => $text('Phone Number', '702-336-8078'),
                    ],
                ],
                'footer_contact' => [
                    'label' => 'Footer - Contact Strip',
                    'fields' => [
                        'global.footer.call_title' => $text('Call Box Title', 'Call us'),
                        'global.footer.phone' => $text('Phone Number', '+971 52-333-4444'),
                        'global.footer.email_title' => $text('Email Box Title', 'Write to us'),
                        'global.footer.email' => $text('Email Address', 'info@renax.com'),
                        'global.footer.address_title' => $text('Address Box Title', 'Address'),
                        'global.footer.address' => $text('Address', 'Dubai, Water Tower, Office 123'),
                    ],
                ],
                'footer_about' => [
                    'label' => 'Footer - About & Social',
                    'fields' => [
                        'global.footer.logo' => $image('Footer Logo', 'assets/img/logo-light.png'),
                        'global.footer.about_text' => $textarea('About Text', 'Rent a car imperdiet sapien porttito the bibenum ellentesue the commodo erat nesuen.'),
                        'global.footer.whatsapp_url' => $text('WhatsApp Link', '#'),
                        'global.footer.facebook_url' => $text('Facebook Link', '#'),
                        'global.footer.youtube_url' => $text('YouTube Link', '#'),
                    ],
                ],
                'footer_subscribe' => [
                    'label' => 'Footer - Subscribe',
                    'fields' => [
                        'global.footer.subscribe_title' => $text('Title', 'Subscribe'),
                        'global.footer.subscribe_text' => $textarea('Text', "Want to be notified about our services. Just sign up and we'll send you a notification by email."),
                    ],
                ],
                'footer_bottom' => [
                    'label' => 'Footer - Bottom Bar',
                    'fields' => [
                        'global.footer.copyright' => $text('Copyright Text', '©2026 DuruThemes. All rights reserved.'),
                    ],
                ],
            ],
        ],

        'home' => [
            'label' => 'Home Page',
            'sections' => [
                'slider' => ['label' => 'Hero Slider', 'fields' => $sliderFields],
                'about' => [
                    'label' => 'About Section',
                    'fields' => [
                        'home.about.subtitle' => $text('Subtitle', 'Rentax'),
                        'home.about.title' => $text('Title', 'We Are More Than'),
                        'home.about.title_colored' => $text('Title (colored part)', 'A Car Rental Company'),
                        'home.about.text' => $textarea('Text', 'Car repair quisque sodales dui ut varius vestibulum drana tortor turpis porttiton tellus eu euismod nisl massa nutodio in the miss volume place urna lacinia eros nunta urna mauris vehicula rutrum in the miss on volume interdum.'),
                        'home.about.feature1' => $text('Feature 1', 'Sports and Luxury Cars'),
                        'home.about.feature2' => $text('Feature 2', 'Economy Cars'),
                        'home.about.button_text' => $text('Button Text', 'Read More'),
                        'home.about.image' => $image('Image', 'assets/img/about.jpg'),
                        'home.about.video_url' => $text('Video URL', 'https://youtu.be/1LxcTt1adfY'),
                    ],
                ],
                'services_heading' => [
                    'label' => 'Services Section Heading (items are under Shared Sections)',
                    'fields' => [
                        'home.services.subtitle' => $text('Subtitle', 'What We Do'),
                        'home.services.title' => $text('Title', 'Our'),
                        'home.services.title_colored' => $text('Title (colored part)', 'Services'),
                    ],
                ],
                'booking' => [
                    'label' => 'Booking Section',
                    'fields' => [
                        'home.booking.subtitle' => $text('Subtitle', 'Rent Now'),
                        'home.booking.title' => $text('Title', 'Book Auto Rental'),
                        'home.booking.background' => $image('Background Image', 'assets/img/slider/2.jpg'),
                    ],
                ],
                'fleet' => [
                    'label' => 'Car Fleet Heading (cars come from Cars Management)',
                    'fields' => [
                        'home.fleet.subtitle' => $text('Subtitle', 'Select Your Car'),
                        'home.fleet.title' => $text('Title', 'Luxury'),
                        'home.fleet.title_colored' => $text('Title (colored part)', 'Car Fleet'),
                    ],
                ],
                'categories' => ['label' => 'Car Categories', 'fields' => $categoryFields],
                'process' => ['label' => 'Rental Process', 'fields' => $processFields],
                'blog' => ['label' => 'Blog / Latest News', 'fields' => $blogFields],
            ],
        ],

        'about' => [
            'label' => 'About Page',
            'sections' => [
                'banner' => [
                    'label' => 'Header Banner',
                    'fields' => [
                        'about.banner.subtitle' => $text('Subtitle', 'Rentax'),
                        'about.banner.title' => $text('Title', 'About'),
                        'about.banner.title_colored' => $text('Title (colored part)', 'Us'),
                        'about.banner.image' => $image('Background Image', 'assets/img/slider/3.jpg'),
                    ],
                ],
                'about' => [
                    'label' => 'About Section',
                    'fields' => [
                        'about.about.subtitle' => $text('Subtitle', 'Rentax'),
                        'about.about.title' => $text('Title', 'We Are More Than'),
                        'about.about.title_colored' => $text('Title (colored part)', 'A Car Rental Company'),
                        'about.about.text1' => $textarea('Paragraph 1', 'Car repair quisque sodales dui ut varius vestibulum drana tortor turpis porttiton tellus eu euismod nisl massa nutodio in the miss volume place urna lacinia eros nunta urna mauris vehicula rutrum in the miss on volume interdum.'),
                        'about.about.text2' => $textarea('Paragraph 2', 'Lorem ipsum potenti fringilla pretium ipsum non blandit vivamus eget nisi non mi iaculis iaculis imperie quiseros sevin elentesque habitant farmen.'),
                        'about.about.feature1' => $text('Feature 1', 'We offer multiple services'),
                        'about.about.feature2' => $text('Feature 2', 'Multiple car repair locations'),
                        'about.about.image' => $image('Image', 'assets/img/about.jpg'),
                        'about.about.video_url' => $text('Video URL', 'https://youtu.be/1LxcTt1adfY'),
                    ],
                ],
                'team' => ['label' => 'Team', 'fields' => $teamFields],
            ],
        ],

        'services' => [
            'label' => 'Services Page',
            'sections' => [
                'banner' => [
                    'label' => 'Header Banner',
                    'fields' => [
                        'services.banner.subtitle' => $text('Subtitle', 'What We Do'),
                        'services.banner.title' => $text('Title', 'Our'),
                        'services.banner.title_colored' => $text('Title (colored part)', 'Services'),
                        'services.banner.image' => $image('Background Image', 'assets/img/slider/11.jpg'),
                    ],
                ],
                'booking' => [
                    'label' => 'Booking Section',
                    'fields' => [
                        'services.booking.subtitle' => $text('Subtitle', 'Rent Now'),
                        'services.booking.title' => $text('Title', 'Book Auto Rental'),
                        'services.booking.background' => $image('Background Image', 'assets/img/slider/2.jpg'),
                    ],
                ],
                'other' => ['label' => 'Other Services', 'fields' => $otherServiceFields],
            ],
        ],

        'service_detail' => [
            'label' => 'Service Detail Page',
            'sections' => [
                'banner' => [
                    'label' => 'Header Banner',
                    'fields' => [
                        'service_detail.banner.subtitle' => $text('Subtitle', 'Services'),
                        'service_detail.banner.title' => $text('Title', 'VIP Transfers'),
                        'service_detail.banner.image' => $image('Background Image', 'assets/img/slider/1.jpg'),
                    ],
                ],
                'content' => [
                    'label' => 'Content',
                    'fields' => [
                        'service_detail.content.intro' => $textarea('Intro Paragraph', 'Lorem pretium fermentum quam, sit amet cursus ante sollicitudin velen morbi consesua the miss sustion consation miss orcisition amet iaculis nisan. Lorem pretium fermentum quam sit amet cursus ante sollicitudin velen fermen orbinetion consesua the risus consequation.'),
                        'service_detail.content.heading1' => $text('Heading 1', 'Options for VIP Transfers'),
                        'service_detail.content.text1' => $textarea('Text 1', $loremDetail),
                        'service_detail.content.heading2' => $text('Heading 2', 'Booking in Advance'),
                        'service_detail.content.text2' => $textarea('Text 2', $loremDetail),
                        'service_detail.content.heading3' => $text('Heading 3', 'Luggage Handling'),
                        'service_detail.content.text3' => $textarea('Text 3', 'Lorem pretium fermentum quam, sit amet cursus ante sollicitudin velen morbi consesua the miss sustion consation miss orcisition amet iaculis nisan lorem pretium fermentum quam sit fermen.'),
                        'service_detail.content.feature1' => $text('Checklist Item 1', 'Security and Licensing'),
                        'service_detail.content.feature2' => $text('Checklist Item 2', 'Private Car Services'),
                        'service_detail.content.feature3' => $text('Checklist Item 3', 'Taxi or Rideshare Services'),
                        'service_detail.content.sidebar_title' => $text('Sidebar Title', 'All Services'),
                    ],
                ],
                'faqs' => ['label' => 'FAQs', 'fields' => $serviceFaqFields],
            ],
        ],

        'cars' => [
            'label' => 'Cars Page',
            'sections' => [
                'banner' => [
                    'label' => 'Header Banner',
                    'fields' => [
                        'cars.banner.subtitle' => $text('Subtitle', 'Select Your Car'),
                        'cars.banner.title' => $text('Title', 'Luxury'),
                        'cars.banner.title_colored' => $text('Title (colored part)', 'Car Fleet'),
                        'cars.banner.image' => $image('Background Image', 'assets/img/slider/2.jpg'),
                    ],
                ],
            ],
        ],

        'car_detail' => [
            'label' => 'Car Detail Page',
            'sections' => [
                'info' => [
                    'label' => 'General Information',
                    'fields' => [
                        'car_detail.info.heading' => $text('Heading', 'General Information'),
                        'car_detail.info.feature1' => $text('Checklist Item 1', '24/7 Roadside Assistance'),
                        'car_detail.info.feature2' => $text('Checklist Item 2', 'Free Cancellation & Return'),
                        'car_detail.info.feature3' => $text('Checklist Item 3', 'Rent Now Pay When You Arrive'),
                        'car_detail.info.whatsapp_url' => $text('WhatsApp Link', 'https://api.whatsapp.com/send?phone=8551004444'),
                    ],
                ],
                'conditions' => ['label' => 'Rental Conditions', 'fields' => $conditionFields],
            ],
        ],

        'contact' => [
            'label' => 'Contact Page',
            'sections' => [
                'banner' => [
                    'label' => 'Header Banner',
                    'fields' => [
                        'contact.banner.subtitle' => $text('Subtitle', 'Get in touch'),
                        'contact.banner.title' => $text('Title', 'Contact'),
                        'contact.banner.title_colored' => $text('Title (colored part)', 'Us'),
                        'contact.banner.image' => $image('Background Image', 'assets/img/slider/4.jpg'),
                    ],
                ],
                'boxes' => [
                    'label' => 'Contact Boxes',
                    'fields' => [
                        'contact.boxes.email_title' => $text('Email Box Title', 'Email us'),
                        'contact.boxes.email' => $text('Email Address', 'info@renax.com'),
                        'contact.boxes.address_title' => $text('Address Box Title', 'Our address'),
                        'contact.boxes.address' => $text('Address', 'Dubai, Water Tower, Office 123'),
                        'contact.boxes.hours_title' => $text('Hours Box Title', 'Opening Hours'),
                        'contact.boxes.hours' => $text('Opening Hours', 'Mon-Sun: 8 AM - 7 PM'),
                        'contact.boxes.phone_title' => $text('Phone Box Title', 'Call us'),
                        'contact.boxes.phone' => $text('Phone Number', '+971 52-333-4444'),
                    ],
                ],
                'form' => [
                    'label' => 'Form & Map',
                    'fields' => [
                        'contact.form.title' => $text('Form Title', 'Get in touch'),
                        'contact.map.title' => $text('Map Title', 'Location'),
                        'contact.map.embed_url' => $textarea('Google Maps Embed URL', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1573147.7480448114!2d-74.84628175962355!3d41.04009641088412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25856139b3d33%3A0xb2739f33610a08ee!2s1616%20Broadway%2C%20New%20York%2C%20NY%2010019%2C%20Amerika%20Birle%C5%9Fik%20Devletleri!5e0!3m2!1str!2str!4v1646760525018!5m2!1str!2str'),
                    ],
                ],
            ],
        ],

        'shared' => [
            'label' => 'Shared Sections',
            'sections' => [
                'services' => ['label' => 'Services (Home carousel, Services page & Service Detail sidebar)', 'fields' => $sharedServiceFields],
                'video' => [
                    'label' => 'Promo Video (Home, About & Services pages)',
                    'fields' => [
                        'shared.video.subtitle' => $text('Subtitle', 'Explore'),
                        'shared.video.title' => $text('Title (before colored part)', 'Car'),
                        'shared.video.title_colored' => $text('Title (colored part)', 'Promo'),
                        'shared.video.title_after' => $text('Title (after colored part)', 'Video'),
                        'shared.video.url' => $text('Video URL', 'https://youtu.be/1LxcTt1adfY'),
                        'shared.video.background' => $image('Background Image', 'assets/img/slider/1.jpg'),
                    ],
                ],
                'testimonials' => ['label' => 'Testimonials (Home & About pages)', 'fields' => $testimonialFields],
                'letstalk' => [
                    'label' => '"Interested in Renting?" Banner (all pages)',
                    'fields' => [
                        'shared.letstalk.subtitle' => $text('Subtitle', 'Rent Your Car'),
                        'shared.letstalk.title' => $text('Title', 'Interested in Renting?'),
                        'shared.letstalk.text' => $text('Text', "Don't hesitate and send us a message."),
                        'shared.letstalk.phone' => $text('WhatsApp / Phone Number', '+8001234567'),
                        'shared.letstalk.background' => $image('Background Image', 'assets/img/slider/3.jpg'),
                    ],
                ],
                'clients' => ['label' => 'Client Logos (all pages)', 'fields' => $clientFields],
            ],
        ],

    ],

];
