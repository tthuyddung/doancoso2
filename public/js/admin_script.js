let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}

let mainImage = document.querySelector('.update-product .image-container .main-image img');
let subImages = document.querySelectorAll('.update-product .image-container .sub-image img');

subImages.forEach(images =>{
   images.onclick = () =>{
      src = images.getAttribute('src');
      mainImage.src = src;
   }
});


const deleteButtons = document.querySelectorAll('.btn-delete');

deleteButtons.forEach(button => {
    button.addEventListener('click', function(event)   
 {
        if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
            event.preventDefault(); // Ngăn chặn form submit
        }
    });
});


$(document).ready(function() {
   const $app = $('.app');
   const $img = $('.app__img');
   const $pageNav1 = $('.pages__item--1');
   const $pageNav2 = $('.pages__item--2');
   let animation = true;
   let curSlide = 1;
   let scrolledUp, nextSlide;
   
   let pagination = function(slide, target) {
     animation = true;
     if (target === undefined) {
       nextSlide = scrolledUp ? slide - 1 : slide + 1;
     } else {
       nextSlide = target;
     }
     
     $('.pages__item--' + nextSlide).addClass('page__item-active');
     $('.pages__item--' + slide).removeClass('page__item-active');
     
     $app.toggleClass('active');
     setTimeout(function() {
       animation = false;
     }, 3000)
   }
   
   let navigateDown = function() {
     if (curSlide > 1) return;
     scrolledUp = false;
     pagination(curSlide);
     curSlide++;
   }
 
   let navigateUp = function() {
     if (curSlide === 1) return;
     scrolledUp = true;
     pagination(curSlide);
     curSlide--;
   }
 
   setTimeout(function() {
     $app.addClass('initial');
   }, 1500);
 
   setTimeout(function() {
     animation = false;
   }, 4500);
   
   $(document).on('mousewheel DOMMouseScroll', function(e) {
     var delta = e.originalEvent.wheelDelta;
     if (animation) return;
     if (delta > 0 || e.originalEvent.detail < 0) {
       navigateUp();
     } else {
       navigateDown();
     }
   });
 
   $(document).on("click", ".pages__item:not(.page__item-active)", function() {
     if (animation) return;
     let target = +$(this).attr('data-target');
     pagination(curSlide, target);
     curSlide = target;
   });
 });


 function openVideo() {
  const modal = document.getElementById("videoModal");
  const iframe = document.getElementById("youtubeVideo");

  // Chèn URL video YouTube vào src của iframe
  iframe.src = " https://www.youtube.com/embed/nejlAUY5gEw"; // Thay YOUR_VIDEO_ID bằng ID video YouTube

  modal.style.display = "flex"; // Hiển thị modal
}

function closeVideo() {
  const modal = document.getElementById("videoModal");
  const iframe = document.getElementById("youtubeVideo");

  // Dừng video và ẩn modal
  iframe.src = ""; // Đặt lại src để video ngừng phát khi đóng
  modal.style.display = "none";
}


window.addEventListener('scroll', function() {
  const chatButton = document.querySelector('.chat-button');
  if (window.scrollY > 200) {
      chatButton.style.display = 'flex';
  } else {
      chatButton.style.display = 'none';
  }
});

// Mở form
function openModal() {
  document.getElementById('destinationModal').classList.add('active');
}

// Đóng form
function closeModal() {
  document.getElementById('destinationModal').classList.remove('active');
}

// Hàm tìm đường đi
function findRoute() {
  const destination = document.getElementById('destination').value;
  if (destination) {
      const encodedDestination = encodeURIComponent(destination);
      const url = `https://www.google.com/maps/dir/?api=1&destination=${encodedDestination}&travelmode=driving`;
      window.open(url, '_blank');
  } else {
      alert('Vui lòng nhập địa chỉ hợp lệ!');
  }
}

