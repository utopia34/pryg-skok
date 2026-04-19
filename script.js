// Массив с данными отзывов
const reviewsData = [
  {
    name: "Анна",
    photo: "img/review/1.jpg",
    text: "Играем всей семьёй каждые выходные! Дети в восторге, правила понятны даже младшим.",
    stars: "★★★★★",
  },
  {
    name: "Дмитрий",
    photo: "img/review/2.jpg",
    text: "Отличный выбор игр. 'Взрывные котята' стали хитом наших посиделок с друзьями!",
    stars: "★★★★★",
  },
  {
    name: "Елена",
    photo: "img/review/3.jpg",
    text: "Заказывала 'Крути роллы' в подарок. Качество печати и компонентов на высоте.",
    stars: "★★★★★",
  },
  {
    name: "Алексей",
    photo: "img/review/4.jpg",
    text: "Быстрая доставка и очень приятные цены. Теперь за настолками только сюда.",
    stars: "★★★★★",
  },
  {
    name: "Мария",
    photo: "img/review/5.jpg",
    text: "Очень атмосферные игры. Раздел 'Преимущества' не врал — ассортимент действительно уникальный.",
    stars: "★★★★★",
  },
];

let currentIndex = 0;

// Элементы DOM
const reviewCard = document.getElementById("reviewCard");
const userNameEl = document.getElementById("userName");
const userPhotoEl = document.getElementById("userPhoto");
const reviewTextEl = document.getElementById("reviewText");
const starsEl = document.querySelector(".stars");
const dots = document.querySelectorAll(".dot");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

//
function updateReview(index) {
  const data = reviewsData[index];

  reviewCard.style.opacity = "0.5";
  reviewCard.style.transition = "opacity 0.15s ease";

  setTimeout(() => {
    userNameEl.textContent = data.name;
    userPhotoEl.src = data.photo;
    reviewTextEl.textContent = data.text;

    if (starsEl) {
      starsEl.textContent = data.stars;
    }

    dots.forEach((dot) => dot.classList.remove("active"));
    if (dots[index]) {
      dots[index].classList.add("active");
    }

    reviewCard.style.opacity = "1";
  }, 150);
}

// Вперед
nextBtn.addEventListener("click", () => {
  currentIndex = (currentIndex + 1) % reviewsData.length;
  updateReview(currentIndex);
});

// Назад
prevBtn.addEventListener("click", () => {
  currentIndex = (currentIndex - 1 + reviewsData.length) % reviewsData.length;
  updateReview(currentIndex);
});

//точки
dots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    currentIndex = index;
    updateReview(currentIndex);
  });
});
