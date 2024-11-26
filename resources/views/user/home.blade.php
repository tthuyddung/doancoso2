<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('user.user_header')

<div class="home-bg">
    <div class="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="{{ asset('images/homee.avif') }}" alt="Slide 1">
                    </div>
                    <div class="content">
                        <h3>
                            <span>Chào mừng</span>
                            <span>Bạn đến với website của chúng tôi</span>
                        </h3>
                        <a href="{{ route('shop') }}" class="btn">Vào cửa hàng</a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="{{ asset('images/xe.jpg') }}" alt="Slide 2">
                    </div>
                    <div class="content">
                        <h3>
                            <span>Khám phá</span>
                            <span>Các sản phẩm chất lượng</span>
                        </h3>
                        <a href="{{ route('shop') }}" class="btn">Vào cửa hàng</a>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="{{ asset('images/home.avif') }}" alt="Slide 3">
                    </div>
                    <div class="content">
                        <h3>
                            <span>Giảm giá</span>
                            <span>Đặc biệt cho khách hàng mới</span>
                        </h3>
                        <a href="{{ route('shop') }}" class="btn">Vào cửa hàng</a>
                    </div>
                </div>
            </div>
            <!-- Swiper Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>

</div>



<section class="category">

   <h1 class="heading">Loại xe theo danh mục</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category.php?category=laptop" class="swiper-slide slide">
      <img src="images/icdien.png" alt="">
      <h3>xe điện</h3>
   </a>

   <a href="category.php?category=tv" class="swiper-slide slide">
      <img src="images/icdien.png" alt="">
      <h3>xe máy</h3>
   </a>

   <a href="category.php?category=camera" class="swiper-slide slide">
      <img src="images/icdien.png" alt="">
      <h3>xe ga</h3>
   </a>

   <a href="category.php?category=mouse" class="swiper-slide slide">
      <img src="images/icdien.png" alt="">
      <h3>xe đạp</h3>
   </a>

   <a href="category.php?category=fridge" class="swiper-slide slide">
      <img src="images/icdien.png" alt="">
      <h3>xe côn</h3>
   </a>

   <a href="category.php?category=washing" class="swiper-slide slide">
      <img src="images/icdien.png" alt="">
      <h3>xe ba bánh</h3>
   </a>

   <a href="category.php?category=smartphone" class="swiper-slide slide">
      <img src="images/icdien.png" alt="">
      <h3>xe trẻ em</h3>
   </a>

   <a href="category.php?category=watch" class="swiper-slide slide">
      <img src="images/icdien.png" alt="">
      <h3>xe đôi</h3>
   </a>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>


<section class="home-products">
   <h1 class="heading">Sản phẩm mới nhất</h1>
   <div class="swiper products-slider">
      <div class="swiper-wrapper">
         @if($products->isNotEmpty())
            @foreach($products as $product)
               <div class="slide">
              
               

                  <!-- Form Add to Wishlist -->
                  <form action="{{ route('addToWishlist') }}" method="POST" id="wishlist-form-{{ $product->id }}">
                     @csrf
                     <input type="hidden" name="pid" value="{{ $product->id }}">
                     <input type="hidden" name="name" value="{{ $product->name }}">
                     <input type="hidden" name="price" value="{{ $product->price }}">
                     <input type="hidden" name="image" value="{{ $product->image }}">
                  </form>

                  <a href="javascript:void(0);" onclick="submitWishlistForm({{ $product->id }})" class="fas fa-heart"></a>
                  <a href="{{ route('quick.view', $product->id) }}" class="fas fa-eye"></a>
                  <img src="{{ asset('images/' . $product->image) }}" alt="">
                  <div class="name">{{ $product->name }}</div>

                  <!-- Hidden Details -->
                  <div class="details-box">
                     <p>{{ $product->details }}</p>
                  </div>

                  <!-- Form Add to Cart -->
                  <form action="{{ route('addToCart', $product->id) }}" method="POST" id="form-{{ $product->id }}">
                     @csrf
                     <input type="hidden" name="pid" value="{{ $product->id }}">
                     <input type="hidden" name="name" value="{{ $product->name }}">
                     <input type="hidden" name="price" value="{{ $product->price }}">
                     <input type="hidden" name="image" value="{{ $product->image }}">

                     <div class="flex">
                        <div class="price"><span>$</span>{{ $product->price }}<span></span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                     </div>

                     <div class="button-container">
                        <button type="submit" class="btn">Thêm giỏ hàng</button>
                     </div>
                  </form>

                  

                  <!-- Button Thuê Xe -->
                  <div class="button-container">
                     <a href="{{ route('rentalInfo', $product->id) }}" class="btn btn-rent">Thuê Xe</a>
                  </div>
               </div>
            @endforeach
         @else
            <p class="empty">Không có sản phẩm nào!</p>
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
    <div class="swiper-pagination"></div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<div class="chua">
    <div class="center-image">
        <img src="images/xe.jpg" alt="Hình ảnh chính">
    </div>
    <div class="circle-wrapper">
        <!-- Vòng cung với 6 vòng tròn -->
        <div class="circle" style="transform: translate(-50%, -50%) rotate(0deg) translateY(-150px);">
            <span>An toàn</span>
        </div>
        <div class="circle" style="transform: translate(-50%, -50%) rotate(60deg) translateY(-150px);">
            <span>An toàn</span>
        </div>
        <div class="circle" style="transform: translate(-50%, -50%) rotate(120deg) translateY(-150px);">
            <span>An toàn</span>
        </div>
        <div class="circle" style="transform: translate(-50%, -50%) rotate(180deg) translateY(-150px);">
            <span>An toàn</span>
        </div>
        <div class="circle" style="transform: translate(-50%, -50%) rotate(240deg) translateY(-150px);">
            <span>An toàn</span>
        </div>
        <div class="circle" style="transform: translate(-50%, -50%) rotate(300deg) translateY(-150px);">
            <span>An toàn</span>
        </div>
    </div>
</div>

<style>
  .chua {
    position: relative;
    width: 400px;
    height: 400px;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Hình ảnh ở giữa */
.center-image img {
    width: 100px;
    height: 100px;
    border-radius: 50%; /* Nếu hình ảnh là hình tròn */
    object-fit: cover; /* Đảm bảo hình ảnh không bị méo */
}

/* Khung chứa các vòng tròn */
.circle-wrapper {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* Căn giữa */
    width: 100%;
    height: 100%;
}

.circle {
    position: absolute;
    width: 40px;
    height: 40px;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;

    color: white;
    font-weight: bold; 

    /* Đặt vòng tròn cách đều theo hình tròn */
    transform-origin: 50% 50%; /* Điểm gốc xoay nằm ở trung tâm container */
}


.circle span {
    font-size: 12px;
    text-align: center;
}

</style>



<section class="session">
   <div class="session-content">
      <div class="image">
         <img src="images/xee.png" alt="Image">
         <button class="buttonn" onclick="openVideo()">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="26px">
               <path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z" fill="currentColor"></path>
            </svg>
         </button>
      </div>
      <div class="text">
         <h2>Luôn đồng hành cùng bạn</h2>
         <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore esse aut vero mollitia. Delectus perspiciatis tempora pariatur provident saepe quidem aliquid quia ipsa error, impedit in voluptatem, doloremque corrupti magnam.</p>
         
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


<div id="videoModal" class="modal">
   <div class="modal-content">
      <span class="close" onclick="closeVideo()">&times;</span>
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
    </div>
  
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
  
</div>

<div class="loader" onclick="openModal()"></div>

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



<a href="https://m.me/your_facebook_page" target="_blank" class="chat-button">
    <img src="https://img.icons8.com/ios-filled/50/ffffff/facebook-messenger.png" alt="Messenger">
</a>

@include('user.footer')

  <script>
    $(document).ready(function () {
      if (localStorage.getItem("pageCached")) {
          // Hiển thị nội dung đã cache
          $('#content').html(localStorage.getItem("pageCached"));
      } else {
          // Gọi AJAX tải nội dung từ server
          $.get("/home", function (data) {
              $('#content').html(data);
              localStorage.setItem("pageCached", data);
          });
      }
  });

  </script>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="{{ asset('js/admin_script.js') }}"></script>

  <script>
  var swiper = new Swiper('.home-slider', {
    loop: true, // Lặp slide
    autoplay: {
        delay: 3000, // Thời gian tự chuyển slide
        disableOnInteraction: false, // Không dừng autoplay khi người dùng tương tác
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true, // Cho phép nhấp vào pagination
    },
    on: {
        slideChangeTransitionStart: function () {
            // Xóa hiệu ứng từ tất cả slide
            document.querySelectorAll('.swiper-slide .content h3 span, .swiper-slide .content .btn').forEach(el => {
                el.classList.remove('animate');
            });
        },
        slideChangeTransitionEnd: function () {
            // Kích hoạt hiệu ứng cho slide hiện tại
            const activeSlide = document.querySelector('.swiper-slide-active');
            activeSlide.querySelectorAll('.content h3 span, .content .btn').forEach(el => {
                el.classList.add('animate');
            });
        },
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
         1024: { slidesPerView: 4 },
      },
   });


</script>


  <script>
      document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper('.swiper.anh', {  
      loop: true,
      autoplay: {
        delay: 3000,  
        disableOnInteraction: false,  
      },
      pagination: {
        el: '.swiper-pagination',  
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',  
        prevEl: '.swiper-button-prev',  
      },
    });
  });

    </script>


  <script>
      document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.swiper.sanpham', {
      slidesPerView: 4, 
      spaceBetween: 20, 
      loop: true, 
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
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
