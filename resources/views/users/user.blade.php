@extends('layouts.default')
@extends('layouts.projects-list-sidebar')
@section('content')
    <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
        <li class="nav-item active">
            <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab" aria-controls="home-md"
               aria-selected="true">Карточка сотрудника</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab" aria-controls="profile-md"
               aria-selected="false">Другая инфа</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab" aria-controls="contact-md"
               aria-selected="false">Материалные ценности</a>
        </li>
    </ul>
    <div class="tab-content card pt-5" id="myTabContentMD">
        <div class="tab-pane fade show active in" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">
            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua,
                retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.
                Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry
                richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american
                apparel, butcher voluptate nisi qui.</p>
        </div>
        <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">
            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.
                Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko
                farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip
                jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna
                delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan
                fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry
                richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus
                tattooed echo park.</p>
        </div>
        <div class="tab-pane fade" id="contact-md" role="tabpanel" aria-labelledby="contact-tab-md">
            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo
                retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer,
                iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles
                pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of
                them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
        </div>
    </div>
@stop