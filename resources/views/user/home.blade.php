<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('user.user_header')

<div class="home-bg">
<section class="home">
   <div class="swiper home-slider">
      <div class="swiper-wrapper">
         <!-- Repeat this block for each slide -->
         <div class="swiper-slide slide">
            <div class="image">
               <img src="{{ asset('images/xe1.png') }}" alt="">
            </div>
            <div class="content">
               <span>upto 50% off</span>
               <h3>latest car</h3>
               <a href="{{ route('shop') }}" class="btn">shop now</a>
            </div>
         </div>
      </div>
      <div class="swiper-pagination"></div>
   </div>
</section>
</div>
<section class="home-products">
   <h1 class="heading">latest products</h1>
   <div class="swiper products-slider">
      <div class="swiper-wrapper">
         @if($products->isNotEmpty())
            @foreach($products as $product)
               <div class="slide">
                  @csrf
                  <input type="hidden" name="pid" value="{{ $product->id }}">
                  <input type="hidden" name="name" value="{{ $product->name }}">
                  <input type="hidden" name="price" value="{{ $product->price }}">
                  <input type="hidden" name="image" value="{{ $product->image }}">
                  <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                  <a href="{{ route('quick.view', $product->id) }}" class="fas fa-eye"></a>
                  <img src="{{ asset('images/' . $product->image) }}" alt="">
                  <div class="name">{{ $product->name }}</div>
                  <div class="flex">
                     <div class="price"><span>$</span>{{ $product->price }}<span>/-</span></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                  </div>
                  
                  <!-- Nút "thuê xe" -->
                  <div class="btn-group">
                     <form method="GET" action="{{ route('checkout', $product->id) }}">
                        @csrf
                        <input type="submit" value="thuê xe" class="btn" name="rent_car">
                     </form>

                     <!-- Nút "thêm vào giỏ hàng" -->
                     <form method="GET" action="{{ route('cart.index', $product->id) }}">
                        @csrf
                        <input type="submit" value="thêm vào giỏ hàng" class="btn btn-cart" name="add_to_cart">
                     </form>
                  </div>
               </div>
            @endforeach
         @else
            <p class="empty">no products added yet!</p>
         @endif
      </div>
      <div class="swiper-pagination"></div>
   </div>
</section>


<section class="home-products">
   <h1 class="heading">latest products</h1>
   <div class="swiper products-slider">
      <div class="swiper-wrapper">
         @if($products->isNotEmpty())
            @foreach($products as $product)
               <div class="slide">
                  @csrf
                  <input type="hidden" name="pid" value="{{ $product->id }}">
                  <input type="hidden" name="name" value="{{ $product->name }}">
                  <input type="hidden" name="price" value="{{ $product->price }}">
                  <input type="hidden" name="image" value="{{ $product->image }}">
                  <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                  <a href="{{ route('quick.view', $product->id) }}" class="fas fa-eye"></a>
                  <img src="{{ asset('images/' . $product->image) }}" alt="">
                  <div class="name">{{ $product->name }}</div>
                  <div class="flex">
                     <div class="price"><span>$</span>{{ $product->price }}<span>/-</span></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                  </div>
                  <input type="submit" value="add to cart" class="btn" name="thuê xe">
               </div>
            @endforeach
         @else
            <p class="empty">no products added yet!</p>
         @endif
      </div>
      <div class="swiper-pagination"></div>
   </div>
</section>



<div class="swiper anh">
    <div class="swiper-wrapper">
    <div class="swiper-slide"><img src="https://images.squarespace-cdn.com/content/v1/63c94d36684e583a7ae37e3b/ece6de05-d8bf-4b36-baeb-962002a385d6/Captain-Electro-Arc-Vector-3+%281%29.jpg" alt="Slide 2"></div>
      <div class="swiper-slide"><img src="https://images.squarespace-cdn.com/content/v1/63c94d36684e583a7ae37e3b/ece6de05-d8bf-4b36-baeb-962002a385d6/Captain-Electro-Arc-Vector-3+%281%29.jpg" alt="Slide 2"></div>
    </div>
    <!-- Pagination -->
    <div class="swiper-pagination"></div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>


<section class="session">
   <div class="session-content">
      <div class="image">
         <img src="images/xee.png" alt="Image">
         <!-- Nút SVG để mở video -->
         <button class="buttonn" onclick="openVideo()">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="26px">
               <path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z" fill="currentColor"></path>
            </svg>
         </button>
      </div>
      <div class="text">
         <h2>Luôn đồng hành cùng bạn</h2>
         <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore esse aut vero mollitia. Delectus perspiciatis tempora pariatur provident saepe quidem aliquid quia ipsa error, impedit in voluptatem, doloremque corrupti magnam.</p>
         
         <!-- Form gửi tin nhắn -->
         <div class="nhan">
         <form action="{{ route('messages.store') }}" method="POST">
            @csrf
            <div class="form-grid">
               <div class="form-group">
                  <input type="text" name="name" class="box" placeholder="Nhập tên của bạn" required>
               </div>
               <div class="form-group">
                  <input type="email" name="email" class="box" placeholder="Nhập email của bạn" required>
               </div>
               <div class="form-group">
                  <input type="text" name="number" class="box" placeholder="Nhập số điện thoại của bạn" required>
               </div>
               <div class="form-group">
                  <textarea name="message" class="box" placeholder="Nhập tin nhắn của bạn" required></textarea>
               </div>
            </div>
            <input type="submit" value="Submit" class="btn">
         </form>
      </div>

      </div>
   </div>
</section>

<!-- Modal chứa video YouTube -->
<div id="videoModal" class="modal">
   <div class="modal-content">
      <!-- Dấu X để đóng video -->
      <span class="close" onclick="closeVideo()">&times;</span>
      <!-- Video YouTube được nhúng -->
      <iframe id="youtubeVideo" width="100%" height="450" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
   </div>
</div>

  <div class="quotes">
    <div class="card">
      <div class="box box1">
        <p>The first step toward success is taken when you refuse to be a captive of the environment in which you first find yourself. </p>
        <h2>Mark Caine</h2>
      </div>
      <div class="bg"></div>
    </div>
    <div class="card">
      <div class="box box2">
        <p>Your smile will give you a positive countenance that will make people feel comfortable around you. </p>
        <h2>Les Brown</h2>
      </div>
      <div class="bg"></div>
    </div>
    <div class="card">
      <div class="box box3">
        <p>Before anything else, preparation is the key to success. </p>
        <h2>Alexander Graham Bell</h2>
      </div>
      <div class="bg"></div>
    </div>
  </div>


<div class="chua">
    <div class="swiper sanpham">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="images/hinh1.png" alt="Product 1" class="product-image">
        <h3 class="product-name">Sản phẩm 1</h3>
        <p class="product-price">Giá: 500,000 VND</p>
        <button class="btn-rent">Thuê</button>
      </div>
      <div class="swiper-slide">
        <img src="path_to_image_2.jpg" alt="Product 2" class="product-image">
        <h3 class="product-name">Sản phẩm 2</h3>
        <p class="product-price">Giá: 400,000 VND</p>
        <button class="btn-rent">Thuê</button>
      </div>
      <div class="swiper-slide">
        <img src="path_to_image_3.jpg" alt="Product 3" class="product-image">
        <h3 class="product-name">Sản phẩm 3</h3>
        <p class="product-price">Giá: 600,000 VND</p>
        <button class="btn-rent">Thuê</button>
      </div>
      <!-- Thêm các slide khác nếu cần -->
    </div>
  
    <!-- Phân trang và điều hướng -->
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
  
</div>

<div class="loader" onclick="openModal()"></div>

<!-- Form nhập địa chỉ -->
<div class="modol" id="destinationModal">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <div class="modol-header">Nhập địa chỉ bạn muốn tới:</div>
    <input type="text" id="destination" placeholder="Nhập địa chỉ hoặc tên địa điểm" />
    <button onclick="findRoute()">Tìm đường</button>
</div>



<!-- <div class="wrapper">
  <div class="candles">
    <div class="light__wave"></div>
    <div class="candle1">
      <div class="candle1__body">
        <div class="candle1__eyes">
          <span class="candle1__eyes-one"></span>
          <span class="candle1__eyes-two"></span>
        </div>
        <div class="candle1__mouth"></div>
      </div>
      <div class="candle1__stick"></div>
    </div>

    <div class="candle2">
      <div class="candle2__body">
        <div class="candle2__eyes">
          <div class="candle2__eyes-one"></div>
          <div class="candle2__eyes-two"></div>
        </div>
      </div>
      <div class="candle2__stick"></div>
    </div>
    <div class="candle2__fire"></div>
    <div class="sparkles-one"></div>
    <div class="sparkles-two"></div>
    <div class="candle__smoke-one"></div>
    <div class="candle__smoke-two"></div>

    
    <div class="thank-you-message">Cảm ơn bạn đã ủng hộ chúng tôi!</div>
  </div>
  <div class="floor"></div>
</div> -->



<!-- Nút nhắn tin -->
<a href="https://m.me/your_facebook_page" target="_blank" class="chat-button">
    <img src="https://img.icons8.com/ios-filled/50/ffffff/facebook-messenger.png" alt="Messenger">
</a>

<!-- 
<div class="loop-wrapper">
  <div class="mountain"></div>
  <div class="hill"></div>
  <div class="tree"></div>
  <div class="tree"></div>
  <div class="tree"></div>
  <div class="rock"></div>
  <div class="truck"></div>
  <div class="wheels"></div>
</div>  -->


<!-- <div class="container">

<div class="threeholder">
  <div class="threeone">
    <div class="circlepic">

    </div>
    <div class="circleborder">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="-9 -10 80 63" enable-background="new 0 0 40 60" xml:space="preserve">
      <g><path d="M26.53,10.843c-0.014,0.148-0.033,0.294-0.033,0.444c0,3.495,2.713,6.326,6.058,6.326c3.344,0,6.055-2.832,6.055-6.326   c0-0.151-0.021-0.297-0.031-0.444H26.53z"/><path d="M40.253,8.155c-0.396-3.512-2.425-6.392-5.141-7.519v5.403c0,0.32-0.26,0.579-0.579,0.579c-0.32,0-0.579-0.259-0.579-0.579   V0.272c-0.448-0.097-0.908-0.155-1.38-0.155c-0.468,0-0.924,0.059-1.369,0.156v5.766c0,0.32-0.259,0.579-0.578,0.579   c-0.32,0-0.579-0.259-0.579-0.579V0.638c-2.711,1.133-4.753,4.024-5.175,7.517h-2.001V9.66H42.26V8.155H40.253z"/></g><g><path d="M40.712,19.183l-2.604-0.001l-4.02,8.935v-9.111H31.31v9.02l-3.981-8.849l-2.601-0.001c-4.237,0-7.49,3.061-8.182,7.142   L13.21,14.731c-0.081-0.28-0.305-0.495-0.588-0.563l-5.501-1.325c-1.734-0.197-3.134,0.067-4.275,0.81   c-1.344,0.874-2.293,2.117-2.672,3.503c-0.354,1.295-0.161,2.644,0.488,3.865c0.008,0.021,0.005,0.042,0.015,0.063l7.487,16.011   L7.646,37.35c-3.762,1.849-1.076,7.31,2.687,5.459l0.41-0.201l2.608,5.576c0.421,0.902,1.23,1.62,2.219,1.971   c0.465,0.165,0.958,0.246,1.464,0.246c0.776,0,1.583-0.192,2.363-0.573c2.239-1.093,3.236-3.398,2.319-5.363l-0.038-0.08   c0.013-0.106,0.006-0.216-0.025-0.324l-0.547-1.901c0.375-0.492,0.628-1.142,0.628-1.992V28.501h1.697l-0.003,20.775h18.907   l0.007-20.775h1.661v17.825c0,4.065,5.299,4.065,5.288,0V28.07C49.291,23.582,45.966,19.183,40.712,19.183z M2.257,20.593   c-0.618-0.951-0.797-1.992-0.52-3.01c0.273-1.001,0.981-1.914,1.992-2.571c0.825-0.537,1.841-0.714,3.11-0.577l4.944,1.197   l5.686,19.75L9.367,18.054c-0.014-0.03-0.039-0.049-0.056-0.076c-0.1-0.255-0.227-0.504-0.382-0.743   c-1.036-1.593-3.177-2.046-4.772-1.009c-1.349,0.878-1.733,2.69-0.856,4.041C4.055,21.421,5.604,21.749,6.757,21   c0.997-0.65,1.281-1.991,0.634-2.988c-0.122-0.188-0.272-0.35-0.446-0.482c0.245,0.14,0.46,0.337,0.624,0.589   c0.749,1.151,0.422,2.696-0.727,3.443C5.308,22.558,3.252,22.122,2.257,20.593z M18.687,48.371   c-0.895,0.437-1.811,0.524-2.576,0.256c-0.582-0.207-1.053-0.617-1.292-1.129l-2.621-5.605l0.136-0.067   c3.763-1.847,1.077-7.311-2.686-5.458l-0.027,0.014L3.585,23.475c1.352,0.415,2.865,0.273,4.141-0.554   c0.619-0.404,1.078-0.954,1.394-1.57L20.247,45.15C20.78,46.292,20.109,47.677,18.687,48.371z"/></g>
      </svg>
      <h4>TITLE 1</h4>
      <p>Esse tenetur nihil voluptas tempora et soluta obcaecati, quod nemo aperiam animi asperiores voluptatibus, ex repellendus praesentium.</p>
    </div>
  </div><div class="threetwo">
    <div class="circlepic">

    </div>
    <div class="circleborder">
  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
viewBox="-32 -30 150 120" style="enable-background:new 0 0 84.351 84.351;"
xml:space="preserve">
<g>
<g>
<path d="M70.391,81.254c-0.228-0.795-0.516-1.755-0.854-2.852c-0.339-1.096-0.705-2.34-1.136-3.684
c-0.432-1.344-0.896-2.8-1.391-4.338c-0.481-1.545-1.045-3.148-1.599-4.822c-0.563-1.667-1.146-3.391-1.737-5.142
c-0.61-1.743-1.232-3.513-1.854-5.282c-0.52-1.494-1.048-2.979-1.575-4.447h3.495v-2.839h-4.521
c-0.381-1.041-0.76-2.071-1.131-3.077c-1.215-3.297-2.373-6.362-3.375-8.986c-1.012-2.62-1.854-4.804-2.445-6.332
c-0.291-0.729-0.491-1.314-0.68-1.709c0.84-1.537,1.317-3.301,1.317-5.174c0-5.177-3.649-9.511-8.513-10.577V0H39.75v11.994
c-4.859,1.066-8.512,5.4-8.512,10.577c0,2.084,0.603,4.027,1.626,5.682c-0.026,0.011-0.055,0.022-0.075,0.039
c-0.195,0.393-0.401,1.004-0.705,1.764c-0.59,1.528-1.434,3.711-2.444,6.331c-1.003,2.624-2.161,5.69-3.376,8.986
c-0.301,0.812-0.604,1.64-0.911,2.477h-4.947v2.84h3.917c-0.602,1.662-1.203,3.352-1.791,5.047
c-0.621,1.771-1.243,3.541-1.854,5.282c-0.591,1.751-1.173,3.476-1.737,5.144c-0.554,1.672-1.116,3.277-1.598,4.82
c-0.495,1.539-0.959,2.994-1.391,4.338c-0.431,1.344-0.797,2.588-1.136,3.685c-0.338,1.097-0.627,2.056-0.854,2.851
c-0.455,1.588-0.717,2.495-0.717,2.495s0.502-0.8,1.378-2.2c0.438-0.699,0.961-1.557,1.548-2.541
c0.589-0.984,1.271-2.088,1.98-3.308c0.709-1.219,1.48-2.539,2.296-3.935c0.825-1.392,1.642-2.883,2.517-4.412
c0.862-1.534,1.756-3.119,2.662-4.73c0.885-1.619,1.786-3.266,2.687-4.912c1.416-2.562,2.796-5.139,4.111-7.623h8.358v5.158h2.58
v-5.158h8.884c1.22,2.299,2.492,4.666,3.793,7.023c0.9,1.646,1.802,3.291,2.687,4.91c0.906,1.611,1.801,3.197,2.662,4.73
c0.875,1.529,1.691,3.021,2.518,4.412c0.814,1.396,1.586,2.717,2.296,3.934c0.71,1.221,1.392,2.322,1.979,3.31
c0.588,0.985,1.109,1.84,1.549,2.54c0.876,1.4,1.378,2.201,1.378,2.201S70.846,82.842,70.391,81.254z M42.072,14.832
c4.266,0,7.738,3.472,7.738,7.739s-3.473,7.738-7.738,7.738c-4.268,0-7.739-3.472-7.739-7.738
C34.333,18.304,37.805,14.832,42.072,14.832z M43.363,47.85V43.98h-2.58v3.869h-6.861c1.482-2.818,2.852-5.468,4.027-7.761
c1.271-2.503,2.331-4.59,3.072-6.05c0.121-0.245,0.233-0.464,0.341-0.67c0.234,0.016,0.471,0.036,0.711,0.036
c0.408,0,0.81-0.027,1.206-0.071c0.018,0.036,0.033,0.067,0.053,0.104c0.741,1.459,1.803,3.546,3.072,6.05
c1.26,2.457,2.734,5.313,4.343,8.361L43.363,47.85L43.363,47.85z"/>
<path d="M42.176,26.494c2.305,0,4.182-1.875,4.182-4.181c0-2.306-1.877-4.181-4.182-4.181s-4.182,1.876-4.182,4.182
C37.994,24.62,39.871,26.494,42.176,26.494z M42.176,18.905c1.878,0,3.408,1.529,3.408,3.408c0,1.879-1.529,3.408-3.408,3.408
c-1.879,0-3.407-1.528-3.407-3.407C38.769,20.435,40.297,18.905,42.176,18.905z"/>
</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>

      <h4>TITLE 2</h4>
      <p>Enim eveniet, asperiores facere, in nulla eos, corrupti iste voluptas nemo consequatur laboriosam veritatis exercitationem.</p>
    </div>

  </div><div class="threethree">
  <div class="circlepic">

    </div>


    <div class="circleborder">

      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
          viewBox="-100 -50 800 600" style="enable-background:new 0 0 592.875 592.875;"
         xml:space="preserve">
      <g>
        <polygon points="66.938,106.688 0,195.936 0,330.604 66.938,297.938  "/>
        <path d="M512.388,238.173L76.5,106.688v188.859l177.461,20.464L424.575,281.3c0.296-0.066,0.593,0.02,0.898,0.02
          c0.307,0,0.612-0.096,0.928-0.038l89.505,16.571L512.388,238.173z M162.562,164.857l86.062,23.906v10.547l-86.062-21.841V164.857z
           M248.625,241.357l-86.062-14.745v-39.273l86.062,21.841V241.357z"/>
        <polygon points="233.086,319.053 72.914,302.318 7.172,332.201 128.692,340.568   "/>
        <path d="M430.312,291.732v44.619v149.835l127.334-15.329h6.541v-0.784l28.688-3.452V321.835l-76.395-14.152L430.312,291.732z
           M449.438,338.551v-1.167l54.182,7.421l3.193,0.43v123.003l-57.375,7V338.551z M583.312,458.904l-19.125,2.333V353.086l19.125,2.62
          V458.904z M554.625,462.404l-38.25,4.666V346.545l38.25,5.24V462.404z"/>
        <polygon points="105.188,356.031 105.188,447.506 200.812,459.22 200.812,380.808 248.625,375.232 248.625,465.082 420.75,486.177 
          420.75,335.242 420.75,291.828 284.57,319.54   "/>
        <path d="M95.625,352.12L95.625,352.12L95.625,352.12z"/>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      </svg>

      <h4>TITLE 3</h4>
      <p>Eum dicta dolore et officia laudantium pariatur deserunt ducimus, impedit, harum magnam veritatis eaque aliquid sit praesentium.</p>
    </div>
    

  </div>
</div> -->




<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="{{ asset('js/admin_script.js') }}"></script>

<script>
   var swiper = new Swiper(".home-slider", {
      loop: true,
      spaceBetween: 20,
      pagination: {
         el: ".swiper-pagination",
         clickable: true,
      },
   });

   var swiper = new Swiper(".category-slider", {
      loop: true,
      spaceBetween: 20,
      pagination: {
         el: ".swiper-pagination",
         clickable: true,
      },
      breakpoints: {
         0: { slidesPerView: 2 },
         650: { slidesPerView: 3 },
         768: { slidesPerView: 4 },
         1024: { slidesPerView: 5 },
      },
   });

   var swiper = new Swiper(".products-slider", {
      loop: true,
      spaceBetween: 20,
      pagination: {
         el: ".swiper-pagination",
         clickable: true,
      },
      breakpoints: {
         550: { slidesPerView: 2 },
         768: { slidesPerView: 2 },
         1024: { slidesPerView: 3 },
      },
   });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
  const swiper = new Swiper('.swiper.anh', {  // Chỉ áp dụng cho phần tử có lớp .swiper.anh
    loop: true,
    autoplay: {
      delay: 3000,  // Thời gian tự động chuyển slide (3 giây)
      disableOnInteraction: false,  // Cho phép autoplay tiếp tục sau khi người dùng tương tác
    },
    pagination: {
      el: '.swiper-pagination',  // Pagination chỉ dành cho .swiper.anh
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',  // Nút chuyển tiếp
      prevEl: '.swiper-button-prev',  // Nút quay lại
    },
  });
});



  </script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
  const swiper = new Swiper('.swiper.sanpham', {
    slidesPerView: 4, // Hiển thị 4 slide mỗi hàng
    spaceBetween: 20, // Khoảng cách giữa các slide
    loop: true, // Cho phép chạy vòng lặp
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      // Đảm bảo responsive
      320: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      640: {
        slidesPerView: 2,
        spaceBetween: 15,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
    },
  });
});

  </script>

</body>
</html> 
