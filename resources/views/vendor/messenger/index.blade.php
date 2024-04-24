@extends('vendor.layouts.master')

@section('title')
    {{$settings->site_name}} || Chat
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-10 col-xxl-10 col-lg-10 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-star"></i> chat list</h3>
                        <div class="wsus__dashboard_review">
                            <div class="row">
                                <div class="col-xl-4 col-md-5">
                                    <div class="wsus__chatlist d-flex align-items-start">
                                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                             aria-orientation="vertical">
                                            <h2>who's online?</h2>
                                            <div class="wsus__chatlist_body">
                                                <button class="nav-link" id="v-pills-home-tab" data-bs-toggle="pill"
                                                        data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                                        aria-selected="true">
                                                    <div class="wsus_chat_list_img">
                                                        <img src="images/dashboard_user.jpg" alt="user" class="img-fluid">
                                                        <span>5</span>
                                                    </div>
                                                    <div class="wsus_chat_list_text">
                                                        <h4>md. sazal ahmed</h4>
                                                        <span class="status active">online</span>
                                                    </div>
                                                </button>
                                                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                                        data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                                                        aria-selected="false">
                                                    <div class="wsus_chat_list_img">
                                                        <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                    </div>
                                                    <div class="wsus_chat_list_text">
                                                        <h4>imtiaz bulbul </h4>
                                                        <span class="status">online</span>
                                                    </div>
                                                </button>
                                                <button class="nav-link active" id="v-pills-messages-tab" data-bs-toggle="pill"
                                                        data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages"
                                                        aria-selected="false">
                                                    <div class="wsus_chat_list_img">
                                                        <img src="images/ts-1.jpg" alt="user" class="img-fluid">
                                                        <span>2</span>
                                                    </div>
                                                    <div class="wsus_chat_list_text">
                                                        <h4>mostofa faruki</h4>
                                                        <span class="status active">online</span>
                                                    </div>
                                                </button>
                                                <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                                        data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings"
                                                        aria-selected="false">
                                                    <div class="wsus_chat_list_img">
                                                        <img src="images/team_4.jpg" alt="user" class="img-fluid">
                                                        <span>10</span>
                                                    </div>
                                                    <div class="wsus_chat_list_text">
                                                        <h4>mahamudul hassan </h4>
                                                        <span class="status">online</span>
                                                    </div>
                                                </button>
                                                <button class="nav-link" id="v-pills-settings-tab1" data-bs-toggle="pill"
                                                        data-bs-target="#v-pills-settings1" type="button" role="tab" aria-controls="v-pills-settings1"
                                                        aria-selected="false">
                                                    <div class="wsus_chat_list_img">
                                                        <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                    </div>
                                                    <div class="wsus_chat_list_text">
                                                        <h4>md. kamrul hasan</h4>
                                                        <span class="status active">online</span>
                                                    </div>
                                                </button>
                                                <button class="nav-link" id="v-pills-settings-tab2" data-bs-toggle="pill"
                                                        data-bs-target="#v-pills-settings2" type="button" role="tab" aria-controls="v-pills-settings2"
                                                        aria-selected="false">
                                                    <div class="wsus_chat_list_img">
                                                        <img src="images/team_2.jpg" alt="user" class="img-fluid">
                                                    </div>
                                                    <div class="wsus_chat_list_text">
                                                        <h4>kibrea munna</h4>
                                                        <span class="status">online</span>
                                                    </div>
                                                </button>
                                                <button class="nav-link" id="v-pills-settings-tab3" data-bs-toggle="pill"
                                                        data-bs-target="#v-pills-settings3" type="button" role="tab" aria-controls="v-pills-settings3"
                                                        aria-selected="false">
                                                    <div class="wsus_chat_list_img">
                                                        <img src="images/ts-3.jpg" alt="user" class="img-fluid">
                                                    </div>
                                                    <div class="wsus_chat_list_text">
                                                        <h4>md. hassan sazal </h4>
                                                        <span class="status active">online</span>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-md-7">
                                    <div class="wsus__chat_main_area">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <div class="wsus__chat_area">
                                                    <div class="wsus__chat_area_header">
                                                        <h2>chat with sazal</h2>
                                                    </div>
                                                    <div class="wsus__chat_area_body">
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Hello. Are You Here?</p>
                                                                <span>10.11 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Yes. I'm available</p>
                                                                <span>10.15 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, consectetur!
                                                                    Lorem ipsum dolor sit.</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wsus__chat_area_footer">
                                                        <form>
                                                            <input type="text" placeholder="Type Message">
                                                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                                 aria-labelledby="v-pills-profile-tab">
                                                <div class="wsus__chat_area">
                                                    <div class="wsus__chat_area_header">
                                                        <h2>chat with sazal</h2>
                                                    </div>
                                                    <div class="wsus__chat_area_body">
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Hello. Are You Here?</p>
                                                                <span>10.11 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Yes. I'm available</p>
                                                                <span>10.15 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, consectetur!
                                                                    Lorem ipsum dolor sit.</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wsus__chat_area_footer">
                                                        <form>
                                                            <input type="text" placeholder="Type Message">
                                                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show active" id="v-pills-messages" role="tabpanel"
                                                 aria-labelledby="v-pills-messages-tab">
                                                <div class="wsus__chat_area">
                                                    <div class="wsus__chat_area_header">
                                                        <h2>chat with sazal</h2>
                                                    </div>
                                                    <div class="wsus__chat_area_body">
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Hello. Are You Here?</p>
                                                                <span>10.11 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Yes. I'm available</p>
                                                                <span>10.15 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, consectetur!
                                                                    Lorem ipsum dolor sit.</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wsus__chat_area_footer">
                                                        <form>
                                                            <input type="text" placeholder="Type Message">
                                                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                                 aria-labelledby="v-pills-settings-tab">
                                                <div class="wsus__chat_area">
                                                    <div class="wsus__chat_area_header">
                                                        <h2>chat with sazal</h2>
                                                    </div>
                                                    <div class="wsus__chat_area_body">
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Hello. Are You Here?</p>
                                                                <span>10.11 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Yes. I'm available</p>
                                                                <span>10.15 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, consectetur!
                                                                    Lorem ipsum dolor sit.</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wsus__chat_area_footer">
                                                        <form>
                                                            <input type="text" placeholder="Type Message">
                                                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-settings1" role="tabpanel"
                                                 aria-labelledby="v-pills-settings-tab1">
                                                <div class="wsus__chat_area">
                                                    <div class="wsus__chat_area_header">
                                                        <h2>chat with sazal</h2>
                                                    </div>
                                                    <div class="wsus__chat_area_body">
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Hello. Are You Here?</p>
                                                                <span>10.11 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Yes. I'm available</p>
                                                                <span>10.15 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, consectetur!
                                                                    Lorem ipsum dolor sit.</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wsus__chat_area_footer">
                                                        <form>
                                                            <input type="text" placeholder="Type Message">
                                                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-settings2" role="tabpanel"
                                                 aria-labelledby="v-pills-settings-tab2">
                                                <div class="wsus__chat_area">
                                                    <div class="wsus__chat_area_header">
                                                        <h2>chat with sazal</h2>
                                                    </div>
                                                    <div class="wsus__chat_area_body">
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Hello. Are You Here?</p>
                                                                <span>10.11 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Yes. I'm available</p>
                                                                <span>10.15 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, consectetur!
                                                                    Lorem ipsum dolor sit.</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wsus__chat_area_footer">
                                                        <form>
                                                            <input type="text" placeholder="Type Message">
                                                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-settings3" role="tabpanel"
                                                 aria-labelledby="v-pills-settings-tab3">
                                                <div class="wsus__chat_area">
                                                    <div class="wsus__chat_area_header">
                                                        <h2>chat with sazal</h2>
                                                    </div>
                                                    <div class="wsus__chat_area_body">
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Hello. Are You Here?</p>
                                                                <span>10.11 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Yes. I'm available</p>
                                                                <span>10.15 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, consectetur!
                                                                    Lorem ipsum dolor sit.</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_1.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor</p>
                                                                <span>12.45 pm</span>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__chat_single single_chat_2">
                                                            <div class="wsus__chat_single_img">
                                                                <img src="images/team_3.jpg" alt="user" class="img-fluid">
                                                            </div>
                                                            <div class="wsus__chat_single_text">
                                                                <p>Lorem ipsum dolor sit amet</p>
                                                                <span>12.59 pm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wsus__chat_area_footer">
                                                        <form>
                                                            <input type="text" placeholder="Type Message">
                                                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
